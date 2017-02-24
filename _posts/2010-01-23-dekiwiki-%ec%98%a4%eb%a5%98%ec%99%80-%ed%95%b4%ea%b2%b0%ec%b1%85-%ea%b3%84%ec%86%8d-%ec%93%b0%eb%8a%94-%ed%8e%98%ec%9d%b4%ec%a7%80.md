---
title: dekiwiki 오류와 해결책 계속 쓰는 페이지
author: 안형우
layout: post
permalink: /archives/233
aktt_notify_twitter:
  - yes
daumview_id:
  - 37125825
categories:
  - 기타
tags:
  - TIP
---
내가 관리하는 오픈소스 <a href="http://www.mindtouch.com/products/download" target="_blank">dekiwiki 게시판</a>(페이지에서 core가 오픈소스다). 알아둘 기본 사항을 적는다.

dekiwiki의 버전은 9.08.1, 서버 운영체제는 우분투 9.10이다.

## 기본 명령어

리스타트 명령 : /etc/init.d/dekiwiki restart

스타트 명령 : /etc/init.d/dekiwiki start

스톱 명령 : /etc/init.d/dekiwiki stop

설정 파일 : /etc/dekiwiki/mindtouch.deki.startup.xml

## 오류와 해결

스타트가 안 됨 : 하루종일 애먹었는데 설정 파일의 권한 때문이었다는 거. 설정 파일이 읽지도 못하게 돼 있었다는;; 설정을 적어도 664로 해야

SITE SETTINGS COULD NOT BE LOADED 라는 메세지와 함께 디버깅 메세지로 http status code 0 이 뜸 : 리스타트하자 해결됨

검색이 안 됨 : [dekiwiki 검색이 안 될 때 해결책][1]

## 오류는 아니지만 문제와 해결책

phpmyadmin을 설치했는데 안 들어가지고 phpmyadmin이라는 제목의 글을 편집하는 페이지로 넘어가는 문제 해결 : [우분투 패키지로 phpmyadmin 설치했는데 안 들어가질 때][2]를 참고하라

 [1]: https://mytory.net/archives/1763 "dekiwiki, Sharing violation on path /var/www/dekiwiki/bin/cache/luceneindex/default-queue/data_1.bin"
 [2]: https://mytory.net/archives/1711 "우분투 패키지로 phpmyadmin 설치했는데 안 들어가질 때"