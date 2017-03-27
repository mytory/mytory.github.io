---
title: '[아파치] (98)Address already in use: make_sock: could not bind to address [::]:80 에러 발생시'
author: 안형우
layout: post
permalink: /archives/1797
aktt_notify_twitter:
  - yes
daumview_id:
  - 36674283
categories:
  - 서버단
tags:
  - apache
---
오늘 서버를 돌리려고 하니까 아래와 같은 에러 메세지가 떴다.

<pre>(98)Address already in use: make_sock: could not bind to address [::]:80</pre>

좀 헤맸는데 해결책은 간단했다. 그러나 근본적 처방인지는 모르겠다.

<pre>netstat -nlp</pre>

ssh로 접속해 이 명령을 친다.

그러면 현재 실행중인 프로세스가 나온다. 아래처럼 나올 거다.

<pre class="brush:shell;highlight:[4,5,8]">Active Internet connections (only servers)
Proto Recv-Q Send-Q Local Address           Foreign Address         State       PID/Program name
tcp        0      0 127.0.0.1:3306          0.0.0.0:*               LISTEN      947/mysqld
tcp        0      0 0.0.0.0:8080            0.0.0.0:*               LISTEN      2180/apache2
tcp        0      0 0.0.0.0:80              0.0.0.0:*               LISTEN      2180/apache2
tcp        0      0 0.0.0.0:22              0.0.0.0:*               LISTEN      697/sshd
tcp        0      0 127.0.0.1:631           0.0.0.0:*               LISTEN      942/cupsd
tcp        0      0 0.0.0.0:443             0.0.0.0:*               LISTEN      2180/apache2
tcp6       0      0 :::5900                 :::*                    LISTEN      1198/vino-server
tcp6       0      0 :::22                   :::*                    LISTEN      697/sshd
tcp6       0      0 ::1:631                 :::*                    LISTEN      942/cupsd
udp        0      0 0.0.0.0:49724           0.0.0.0:*                           740/avahi-daemon: r
udp        0      0 0.0.0.0:68              0.0.0.0:*                           826/dhclient
udp        0      0 0.0.0.0:5353            0.0.0.0:*                           740/avahi-daemon: r
Active UNIX domain sockets (only servers)
Proto RefCnt Flags       Type       State         I-Node   PID/Program name    Path
unix  2      [ ACC ]     STREAM     LISTENING     3114     1/init              @/com/ubuntu/upstart
unix  2      [ ACC ]     STREAM     LISTENING     4934     947/mysqld          /var/run/mysqld/mysqld.sock
unix  2      [ ACC ]     STREAM     LISTENING     5009     822/gdm-simple-slav @/tmp/gdm-session-yPXnypLE
unix  2      [ ACC ]     STREAM     LISTENING     4424     740/avahi-daemon: r /var/run/avahi-daemon/socket
(후략...)</pre>

그 중에 apache 라고 써 있는 놈이 4,5,8번 줄에 있는 놈인데, 2180/apache2 라고 써 있다. 2180이 프로세스 번호다.

이 놈들을 죽이면 된다.

<pre>kill -9 2180</pre>

이라고 쓰고 엔터. 그러면 apache2가 싹 죽는다.

이제 실행하면 잘 된다.

그런데 도대체 이해가 안 되는 건 왜 이런 일이 발생하냐 하는 거다.

아시는 분이 있다면 댓글로 알려 주시면 고맙겠다.