---
title: "리눅스 php-fpm 최적화 - pm.max_children 개수 결정" 
layout: post
tags: 
  - 리눅스
  - php
description: 여유 메모리와, php-fpm 프로세스당 메모리를 파악해서 자식 프로세스 개수를 늘렸다. process manager는 static 방식으로 했다.
---

서버에 문제가 반복됐고, php-fpm log에서 아래 같은 메시지를 발견했다. `pm.max_children`을 늘려야 했다.

~~~ log
[19-Dec-2017 11:51:48] WARNING: [pool www] seems busy (you may need to increase pm.start_servers, or pm.min/max_spare_servers), spawning 8 children, there are 0 idle, and 11 total children
[19-Dec-2017 11:51:49] WARNING: [pool www] server reached pm.max_children setting (12), consider raising it
~~~


## php-fpm 평균 메모리 사용량

우선 php-fpm 평균 메모리 사용량을 재 보자. 아래 명령어를 활용한다.

    ps --no-headers -o "rss,cmd" -C php-fpm7.0 | awk '{ sum+=$1 } END { printf ("%d%s\n", sum/NR/1024,"M") }'

시스템에 따라 `php-fpm7.0`을 변경해서 사용할 것. 제대로 된 프로세스 이름을 알고 싶으면 `ps -e`를 실행해 본다. `top`도 좋고.

명령어 옵션들을 살펴 보자. 

- `--no-headers`: 프로세스 리스트를 볼 때 제목 행은 출력하지 않는다.
- `-o "rss,cmd"`: rss와 cmd 항목만 출력한다. rss는 물리적 메모리 사이즈(resident set size)를 의미한다.[^rss] cmd는 명령어를 뜻한다.
- `-C php-fpm7.0`:  커맨드가 `php-fpm7.0`인 것만 출력한다.

[^rss]: man ps에서 찾아 보면 이렇게 설명돼 있다: "resident set size, the non-swapped physical memory that a task has used (in kiloBytes)."

`awk`는... 생략한다. 메모리 사이즈 평균 MB를 구하는 부분이다.

명령을 실행해 보니 php-fpm7.0의 평균 메모리 사용량이 **45M**로 나왔다. 


## 프리 메모리 사이즈

프리 메모리 사이즈를 재 봤다. `free -h`: available이 300M로 나왔다. 


## 조치

300을 45로 나누면 6.66666...이다. 약간의 여유는 두는 게 나을 테니, +6을 하기로 했다. 

php-fpm 설정은 우분투의 경우 `/etc/php/7.0/fpm/pool.d/www.conf`에서 한다. 

원래 12였으니 `pm.max_children = 18`로 설정했다.


## 참고 - pm = static

`pm = static`으로 설정했다. 참고한 글은 [PHP-FPM tuning: Using ‘pm static’ for max performance][pm-static]다. 성능 차원에서만 보면, 늘상 프로세스를 띄워 두는 게 가장 좋다는 내용이다.

[pm-static]: https://haydenjames.io/php-fpm-tuning-using-pm-static-max-performance/


## 참고 - 서버의 문제를 파악하기

서버 문제를 파악하기 위해 보는 로그들. 아래 방법으로 로그를 보고 error, fatal, kill, out of memoy, oom 같은 단어들을 찾아 보자. (대소문자 구분 없이 찾아야 한다.) 로그 파일명이 반드시 일치하지는 않을 수 있으니 그냥 `/var/log` 폴더에 가서 파일들을 살펴 봐라.

- 시스템: `less /var/log/syslog`, `journalctl -xe`, `dmesg`, `less /var/log/kern.log`
- 아파치: `less /var/log/apache2/error.log`
- php-fpm: `less /var/log/php7.0-fpm.log`

리눅스 문제 파악 방법에 대한 글: [리눅스 서버 60초안에 상황파악하기][linux-analysis](영문: [Linux Performance Analysis in 60,000 Milliseconds][linux-analysis-en])

[linux-analysis]: https://b.luavis.kr/server/linux-performance-analysis
[linux-analysis-en]: https://medium.com/netflix-techblog/linux-performance-analysis-in-60-000-milliseconds-accc10403c55

## 기타: mysqld 메모리 사용 파악

    ps --no-headers -o "rss,cmd" -C mysqld | awk '{ sum+=$1 } END { printf ("%d%s\n", sum/NR/1024,"M") }'

**246M**로 나왔다.


## 기타: nginx 메모리 사용 파악

    ps --no-headers -o "rss,cmd" -C nginx | awk '{ sum+=$1 } END { printf ("%d%s\n", sum/NR/1024,"M") }'

**7M**로 나왔다.


## 기타: apache2 메모리 사용 파악

내 경우는 nginx였지만, 아파치를 사용하는 경우가 더 많을 것이다.

    ps --no-headers -o "rss,cmd" -C apache2 | awk '{ sum+=$1 } END { printf ("%d%s\n", sum/NR/1024,"M") }'


