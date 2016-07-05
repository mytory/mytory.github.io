---
title: '[우분투] MySql 원격 접속 허용하기 &#8211; PhpMyAdmin 사용'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2372
aktt_notify_twitter:
  - yes
daumview_id:
  - 36615591
categories:
  - 서버단
tags:
  - MySQL
---
콘솔에서 하는 방법은 검색하면 나온다. 나는 phpmyadmin 을 이용하는 방법을 설명한다.

방법이 좀 간단해서 민망한데, 사용자 권한에서 원격 접속을 허용할 사용자를 아래처럼 설정한다.

<img alt="" src="/uploads/legacy/mysql_%EC%9B%90%EA%B2%A9%EC%A0%91%EC%86%8D_%EC%82%AC%EC%9A%A9%EA%B6%8C%ED%95%9C.jpg" width="456" height="48" />

호스트를 보통은 localhost로 하는데, 그렇게 하지 않고 IP주소로 적어 주면 된다. 위에 적은 것은 19.168.10으로 시작하는 모든 IP를 허용하는 것이다. 로컬에서 연결돼 있는 한 컴의 DB를 공유하며 개발하기 위해 저렇게 세팅한 거다.

## MySql 설정 변경

<pre>sudo nano /etc/mysql/my.cnf</pre>

nano든 vim이든 gedit든 사용해서 my.cnf를 수정한다.

<pre>bind-address           = 127.0.0.1</pre>

이 부분을 찾아서, #을 맨 앞에 붙인다. 주석처리하라는 말이다. 아래처럼 말이다.

<pre>#bind-address           = 127.0.0.1</pre>

bind-address 는 127.0.0.1 에서만 접속을 허용한다는 뜻 같다. 아무리 방화벽을 해제하고 사용사 권한 설정에서 접속 가능한 IP를 변경해 줘도 이놈을 수정하지 않으면 소용이 없다.

혹시 모르니 mysql을 재시작해 보자.

<pre>sudo /etc/init.d/mysql restart</pre>

## 방화벽 허용

이래도 안 되면 바화벽을 풀어 본다. 우분투에서 방화벽을 제어하는 놈은 ufw라는 프로그램이다. 아마도 기본설치가 돼 있을 텐데, 설치가 안 돼 있으면 아래 명령어로 설치한다.

<pre>sudo apt-get install ufw</pre>

그리고 이렇게 해 본다.

<pre>sudo ufw allow mysql</pre>

그러면 mysql 서비스가 방화벽 허용에 추가된다. 추가한 걸 다시 막으려면 아래처럼 쓰면 된다고 한다.

<pre>sudo ufw deny mysql</pre>

포트 전체를 허용할 수도 있다.

<pre>sudo ufw allow 3306</pre>

mysql의 포트는 3306이니까 그걸 허용한 거다. 그런데 아마 이미 허용돼 있어서 패스한다고 나올 거다.

이렇게 했는데도 안 되면? 모르겠다. 그럼 뭔가 사용자 권한 설정 문제거나 프로그램쪽에서 오타가 있거나 할 수 있다. 그걸 찾아 보는 게 나을 거다.