---
title: "리눅스 php-fpm 최적화 - pm.max_children 개수 결정" 
layout: post
tags: 
  - 리눅스
  - php
description: 여유 메모리와, php-fpm 프로세스당 메모리를 파악해서 자식 프로세스 개수를 늘렸다. process manager는 static 방식으로 했다.
date_modified: 2020-12-28
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

관련해 자세한 튜닝 방법을 알고 싶다면 [Setting MaxClients in Apache/prefork MPM](http://www.inetservicescloud.com/knowledgebase/setting-maxclients-in-apacheprefork-mpm/)을 참고하라.


## 메모리 사용량을 파악하는 가장 좋은 방법

(2020-12-28에 추가한 내용이다.)

위에서 소개한 명령어들을 사용할 필요 없이 파이썬의 [`ps_mem` 패키지](https://github.com/pixelb/ps_mem/)를 사용하는 게 가장 속편할 수 있다. 아래처럼 깔끔하게 프로세스별 메모리 사용량을 알려 준다.

~~~ plain
 Private  +   Shared  =  RAM used       Program

212.0 KiB +   0.5 KiB = 212.5 KiB       uuidd
232.0 KiB +   0.5 KiB = 232.5 KiB       lvmetad
240.0 KiB +   1.5 KiB = 241.5 KiB       atd
292.0 KiB +   1.0 KiB = 293.0 KiB       agetty [updated] (2)
300.0 KiB +   0.5 KiB = 300.5 KiB       gpg-agent
340.0 KiB +  33.5 KiB = 373.5 KiB       cron
532.0 KiB +  50.5 KiB = 582.5 KiB       master
524.0 KiB + 121.5 KiB = 645.5 KiB       less
672.0 KiB +  58.5 KiB = 730.5 KiB       qmgr
636.0 KiB + 101.5 KiB = 737.5 KiB       systemd-timesyncd
  1.1 MiB + 180.5 KiB =   1.3 MiB       systemd-resolved
  1.3 MiB +  20.5 KiB =   1.3 MiB       systemd-networkd
  1.3 MiB +  48.5 KiB =   1.4 MiB       systemd-udevd
952.0 KiB + 481.0 KiB =   1.4 MiB       su (2)
  1.5 MiB + 200.5 KiB =   1.7 MiB       dbus-daemon [updated]
  1.5 MiB + 202.5 KiB =   1.7 MiB       pickup
  1.5 MiB + 480.5 KiB =   1.9 MiB       systemd-logind
  1.1 MiB + 863.0 KiB =   2.0 MiB       sudo (2)
  2.0 MiB +  38.5 KiB =   2.0 MiB       rsyslogd
  2.0 MiB + 346.5 KiB =   2.4 MiB       (sd-pam)
  2.2 MiB + 182.5 KiB =   2.4 MiB       htop
  2.6 MiB +  88.5 KiB =   2.7 MiB       polkitd
  2.8 MiB +  35.5 KiB =   2.9 MiB       lxcfs
  3.1 MiB +  36.5 KiB =   3.1 MiB       accounts-daemon
  3.9 MiB + 881.0 KiB =   4.7 MiB       systemd (2)
  7.6 MiB +   0.5 KiB =   7.6 MiB       networkd-dispat
  7.8 MiB +   0.5 KiB =   7.8 MiB       unattended-upgr
  3.1 MiB +   5.7 MiB =   8.9 MiB       sshd (7)
 10.0 MiB +  96.5 KiB =  10.1 MiB       do-agent
 10.1 MiB +   2.0 MiB =  12.0 MiB       zsh (5)
 16.5 MiB + 194.5 KiB =  16.7 MiB       fail2ban-server
 26.7 MiB +   5.9 MiB =  32.6 MiB       systemd-journald
266.7 MiB + 128.9 MiB = 395.5 MiB       apache2 (15)
425.4 MiB + 412.5 KiB = 425.9 MiB       mysqld
---------------------------------
                        954.2 MiB
=================================
~~~

