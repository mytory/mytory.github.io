---
title: 윈도우, 맥에서 IntelliJ 톰캣 로그 한글이 깨질 때
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/13224
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13224-tomcat-log-encoding.md
categories:
  - 개발 툴
  - 서버단
tags:
  - encoding
  - intellij
  - JAVA
---
IntelliJ에서 테스트한 건데, 아마 이클립스도 비슷하지 않을까 싶다.

윈도우랑 맥은 한글 터미널 인코딩이 CP949(혹은 EUC-KR)이다. 그래서 자바는 CP949로 한글을 뿌리는데, IntelliJ는 UTF-8로 인코딩을 해석해서 보여 주기 때문에 한글이 깨지는 것이다. 이런 현상을 방지하기 위한 방법이다.

여튼간에 서버 설정(메뉴 기억 안 난다. 잘 찾아 보시길)에서 VMOptions에 아래처럼 써 준다.

    -Dfile.encoding=UTF-8
    

톰캣을 자바로 시작할 때 붙이는 인자값이니, 적당한 곳에 얼마든 응용할 수 있을 것이다.