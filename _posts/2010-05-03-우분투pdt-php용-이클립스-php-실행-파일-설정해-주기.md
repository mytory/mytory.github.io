---
title: '[우분투:PDT] php용 이클립스, php 실행 파일 설정해 주기'
author: 안형우
layout: post
permalink: /archives/556
aktt_notify_twitter:
  - yes
daumview_id:
  - 36959134
categories:
  - 개발 툴
tags:
  - Eclipse
---
<http://www.ibm.com/developerworks/kr/library/tutorial/os-eclipse-europa2/section4.html> 에 나온 것 중, 실행 파일 환경 설정에 관한 부분이다.

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile24.uf.123E4C4E4D4BC8F434FB5E.png" alt="" width="496" height="384" />

wndow > preferences 에서 PHP > PHP Executables 로 간다. 거기서 위 그림처럼 Add를 누르면 PHP 실행파일을 설정하는 부분이 나온다.

아래처럼 설정하면 된다. 아래는 우분투의 PHP 실행파일 경로다. 찾느라 헤맸다.

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile21.uf.150EEB564D4BC8F42B094A.png" alt="" width="580" height="446" />

Name은 아무거나 자신이 알아볼 수 있는 것으로 하면 되고&#8230;

Executable path 는 /usr/bin/php 혹은 /usr/bin/php5 다. (이 파일들은 php-cli 를 설치해 주면 생기는 파일들이다. php5-common만 설치한 경우 실행파일이 어딨는지 찾을 수가 없었다;; 따라서 내 설명이 맞다고 확신할 수 없다.

PHP ini file(optional)은 해도 되고 안 해도 되는데 하려면 php.ini 경로를 잡아 주면 된다.

경로는 /etc/php5/apache2/php.ini다.