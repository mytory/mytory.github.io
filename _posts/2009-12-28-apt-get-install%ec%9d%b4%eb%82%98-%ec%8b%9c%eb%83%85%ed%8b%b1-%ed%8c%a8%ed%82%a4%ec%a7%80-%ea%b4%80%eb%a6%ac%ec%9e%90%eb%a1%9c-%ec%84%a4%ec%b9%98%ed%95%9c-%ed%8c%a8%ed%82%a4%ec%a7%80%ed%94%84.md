---
title: apt-get install이나 시냅틱 패키지 관리자로 설치한 패키지(프로그램)의 deb 설치 파일은 어디에 있나
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/170
aktt_notify_twitter:
  - yes
daumview_id:
  - 37166675
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
apt-get install이나 시냅틱 패키지 관리자로 설치한 프로그램 설치 파일을 찾고 싶다면,(혹은 설치 파일만 다운로드했다면.(apt-get에서 install을 빼거나 시냅틱 패키지 관리자에서 프로그램 설치시 &#8216;패키지 파일만 내려받기&#8217;에 체크하면 설치는 안 되고 deb 파일만 다운 받습니다.)) 다음 경로로 가면 된다.

/var/cache/apt/archives

여기 가면 설치한 패키지(프로그램)들의 deb 파일이 다 있다.

[덧]아래 그림처럼 &#8216;패키지 설치 파일만 내려 받기&#8217;에 체크하면 설치는 안 되고 위 경로에 설치 파일만 내려 받게 된다.

<img src="/uploads/legacy/old-images/1/cfile29.uf.19211E484D4BC87A332255.png" class="aligncenter" width="492" height="414" alt="" />