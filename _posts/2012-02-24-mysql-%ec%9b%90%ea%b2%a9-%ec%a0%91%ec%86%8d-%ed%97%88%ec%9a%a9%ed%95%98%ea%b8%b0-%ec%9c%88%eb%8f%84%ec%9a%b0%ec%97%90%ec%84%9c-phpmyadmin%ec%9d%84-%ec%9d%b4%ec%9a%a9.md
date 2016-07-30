---
title: '[윈도우] MySql 원격 접속 허용하기 &#8211; PhpMyAdmin 사용'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2303
aktt_notify_twitter:
  - yes
daumview_id:
  - 36622855
categories:
  - 서버단
tags:
  - MySQL
---
콘솔에서 하는 방법은 검색하면 나온다. 나는 phpmyadmin 을 이용하는 방법을 설명한다.

방법이 좀 간단해서 민망한데, 사용자 권한에서 원격 접속을 허용할 사용자를 아래처럼 설정한다.

<img class="aligncenter" src="/uploads/legacy/mysql_%EC%9B%90%EA%B2%A9%EC%A0%91%EC%86%8D_%EC%82%AC%EC%9A%A9%EA%B6%8C%ED%95%9C.jpg" alt="" width="456" height="48" />

호스트를 보통은 localhost로 하는데, 그렇게 하지 않고 IP주소로 적어 주면 된다. 위에 적은 것은 19.168.10으로 시작하는 모든 IP를 허용하는 것이다. 로컬에서 연결돼 있는 한 컴의 DB를 공유하며 개발하기 위해 저렇게 세팅한 거다.

## 방화벽 해제

자, 그런데 이렇게 해도 안 되는 경우가 있다. 방화벽 때문이다.

윈도우7이라면 아래처럼 방화벽을 해제하면 된다.

<img class="aligncenter" src="/uploads/legacy/mysql_%EC%9B%90%EA%B2%A9%EC%A0%91%EC%86%8D_%EB%B0%A9%ED%99%94%EB%B2%BD.jpg" alt="" width="675" height="590" />

방화벽에서 허용되는 프로그램 항목에 들어가서 mysql deamon을 추가해 줘야 한다.

APM_Setup을 사용하고 있다면, 데몬의 경로는 아래와 같다.

<pre>C:\APM_Setup\Server\MySQL5\bin\mysqld.exe</pre>

이놈을 수동으로 골라 주면 된다. 그러면 원격 접속이 가능해진다.