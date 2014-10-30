---
title: 윈도우에서 기본 프로그램으로 sublime text를 선택할 수 없을 때 조치법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/11417
daumview_id:
  - 50501531
categories:
  - 기타
tags:
  - Program
---
64비트 sublime text를 설치한 뒤부터 sublime text를 기본 프로그램으로 선택할 수가 없었다.

귀찮아 하고 있다가 검색해서 해결책을 찾았다.

1.  `Window+R`을 누른 뒤 `regedit`라고 쓰고 엔터. 그럼 레지스트리 에디터가 실행된다.
2.  `컴퓨터\HKEY_CLASSES_ROOT\Applications\`에 들어간 뒤 `sublime_text.exe`를 찾아서 지운다.

그럼 다시 지정을 할 수 있게 된다.

근데 그냥 지웠다가 다시 깔아도 된다고 하긴 하더라.