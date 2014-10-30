---
title: 우분투 저장소 바꾸기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/619
aktt_notify_twitter:
  - yes
daumview_id:
  - 36914184
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
간단하다.

일단 터미널.

<pre class="brush:plain">sudo gedit /etc/apt/sources.list</pre>

여기서 변경하면 된다.

보통은 http://kr.archive.ubuntu.com/ubuntu 를 모두 http://ftp.daum.net/ubuntu 으로 변경한다.

메뉴에서는, <span style="font-weight: bold;">시스템>관리>소프트웨어 소스</span>(이 메뉴명은 코분투 10.04 기준이다)

여기서는 다운로드 위치에서 기타를 선택한 후 원하는 서버를 선택하면 된다.

일일이 손으로 바꾸기 귀찮은 분들을 위해서 내 소스를 올려 둔다. 이 소스는 10.04 기준이다. 다른 분들은 받으면 곤란할 거다.

<a href="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile10.uf.126C7A504D4BC94812606D.list" class="aligncenter" />cfile10.uf.126C7A504D4BC94812606D.list</a> 한국 기본 서버인 카이스트 서버가 자주 죽는다는 소리가 있어서 다음 서버로 변경하곤 한다. 나도 방금 그런 일을 겪어서 이 글을 쓰게 된 것이다.

다음 서버의 주소는 http://ftp.daum.net/ubuntu 다. http://kr.archive.ubuntu.com/ubuntu 가 공식 한국 저장소인데 자주 뻗는다는 말씀. 안정적인 다음이 낫겠지.

속도는 거기서 거기인 듯하다. 오늘 새벽 6시 반에 다음 저장소도 속도 100kb/s 내외였다.