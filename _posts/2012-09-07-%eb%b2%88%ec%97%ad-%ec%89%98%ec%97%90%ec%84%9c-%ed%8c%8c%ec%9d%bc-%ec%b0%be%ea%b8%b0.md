---
title: '[번역] 쉘에서 파일 찾기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3242
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36563643
categories:
  - 서버단
tags:
  - shell
---
요약 : `locate 파일명` 혹은 `sudo find /folder -name "filename"` 이런 식으로 쓴다.

GUI로 파일 찾기 같은 걸 하면 느리다. 풀 경로를 보는 것도 성가시다. 쉘에서 간단하게 해결하고 싶었다. 검색을 하니 나왔다. 그걸 그냥 번역한다. 원문은 [Search For Files In Bash][1]다. 여기부터 번역 시작. Bash는 거의 대부분의 터미널에서 사용하는 쉘이다. 그러니까 그런 건 신경쓰지 않아도 된다.

&#8212;&#8212;

Bash 쉘에서 어떻게 파일을 검색할까?

다음 명령어를 사용할 수 있다.

1.  **`locate` 명령어** &#8211; 파일명으로 찾는다. `updatedb` [명령어]로 만들어 둔 데이터베이스에서 패턴에 맞는 파일명을 찾아서 화면에 출력해 준다. 한 줄에 파일 하나다. 12~24시간 이내에 생성된 파일은 찾지 못한다. [데이터베이스에 색인을 12~24시간에 한 번씩 하나 보다. - 형우]
2.  **`find` 명령어 **- 디렉토리를 돌면서 실시간으로 파일을 검색한다.

## `bash` 쉘의 `locate` 명령어

`xorg.conf` 라는 파일을 찾으려면 이렇게 쓴다 :

`locate xorg.conf`

그러면 이런 식으로 나온다 :

<pre>/etc/X11/xorg.conf
/etc/X11/xorg.conf.backup
/etc/X11/xorg.conf.failsafe
/home/vivek/Downloads/xorg.conf.txt
/usr/share/man/man5/xorg.conf.5.gz</pre>

파일명을 출력하는 대신 패턴에 맞는 파일이 몇 개 있는지 숫자를 출력할 수 있다 :

`locate -c xorg.conf`

그러면 이런 식으로 나온다.

<pre>5</pre>

대소문자를 구분하지 않으려면(예컨대, `foo.txt`나 `FOO.TXT`나 `foo.Txt` 같은 걸 다 찾으려면) :

`locate -i filename`

한 번에 파일 하나만 찾으려면 :

`locate -n 1 filename`

한 번에 파일 세 개만 찾으려면 :

`locate -n 3 filename`

완전히 일치하는 파일만 찾으려면 (`NAME`만 찾고 `*NAME*`은 찾지 않는다) :

`locate -b '\FILENAME'`

`updatedb` 명령어로 만들어 둔 현재 데이터베이스의 정보를 보려면

`locate -S`

이런 식으로 나온다 :

<pre>Database /var/lib/mlocate/mlocate.db:
	35,411 directories
	2,79,320 files
	1,96,50,749 bytes in file names
	77,85,226 bytes used to store database</pre>

## `bash` 쉘에서 `find` 명령어

기본 문법은 다음과 같다 :

`find /path/to/dir -name "filename"`

예를 들어 `/etc` 디렉토리에서 `httpd.conf` 파일을 찾으려면 :

`find /etc -name "httpd.conf"`

`/nas/projects` 디렉토리에서 모든 헤더 파일, 즉 `*.h` 파일을 찾으려면 :

`find /nas/projects -name "*.h"`

 [1]: http://www.cyberciti.biz/faq/search-for-files-in-bash/