---
title: '[우분투] 오픈 파이어 제작사에서 만든 메신저 Spark 우분투에 설치하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/4953
daumview_id:
  - 36351998
categories:
  - 기타
tags:
  - Ubuntu Family
---
[오픈파이어는 사내 메신저 서버를 설치할 때 사용할 수 있는 오픈소스 프로그램][1]이다.

오픈파이어는 XMPP(혹은 Jabber)를 지원하기 때문에 다양한 오픈소스 메신저로 접속해서 사용하면 된다. 나는 Pidgin을 사용해 왔다. 그런데 아무래도 오픈파이어의 제작사에서 만든 메신저를 사용하는 게 가장 낫지 않나 하는 생각이 들었다. 몇 가지 편한 점도 있었다. (그룹대화 등의 메뉴를 찾기 편한 점이 있다.)

그래서 [스파크를 다운][2]받으러 들어갔는데 웬걸, 우분투용 설치 파일이 없는 것이었다.

그래서 rpm을 다운받아서 우분투용(데비안용) 설치파일로 전환을 했더니 잘 돌아갔다.

일단 자기 우분투에 rpm to deb(그 역도 가능한 듯) 프로그램인 alien이 설치돼 있는지 확인한다.

<pre>sudo apt-get install alien</pre>

그리고 다운받은 rpm 파일이 있는 폴더로 이동해서 아래 명령어를 친다.

<pre>sudo alien -d spark-2.6.3.rpm</pre>

그러면 deb 파일이 생긴다. 그걸로 설치를 하면 된다.

그런데 설치가 완료돼도 실행 아이콘이 생기지 않는다. 실행 파일은 아래 위치에 있다.

<pre>/usr/share/spark/bin/startup.sh</pre>

이 실행파일로 아이콘을 만들어 사용하면 된다. 사내에서 배포해야 하면 아이콘까지 만들어서 압축해서 배포해 주면 될 거다.

 [1]: http://mytory.local/archives/212 "오픈소스 (사내)메신저 서버 구축, 오픈 파이어(openfire) 설치방법과 세팅(리눅스 기준)"
 [2]: http://www.igniterealtime.org/downloads/index.jsp