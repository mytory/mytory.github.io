---
title: 이클립스 SDK에 tomcat plugin과 EclipseHTMLEditor plugin 설치하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/963
aktt_notify_twitter:
  - yes
daumview_id:
  - 36762517
categories:
  - 개발 툴
tags:
  - Eclipse
---
일단 이건 설치법이다. 사용법은 다른 글에서 쓰겠다.

## 이클립스 톰캣 플러그인

<a href="http://www.eclipsetotale.com/tomcatPlugin.html#A3" target="_blank">이클립스 톰캣 플러그인 다운로드 페이지</a>에서 최신 버전을 다운받는다.

<a href="http://www.eclipsetotale.com/tomcatPlugin.html#A4" target="_blank">공식 홈페이지의 설치 방법</a>을 참고하는 게 가장 정확할 거다.

설치법엔 아래와 같이 써 있다.

&#8211; Eclipse_Home/dropins for Eclipse 3.4, 3.5 and 3.6

&#8211; Eclipse_Home/plugins for Eclipse 2.1, 3.0, 3.1, 3.2 and 3.3

즉, 이클립스 3.4~3.6는 이클립스 홈 폴더의 dropins 폴더에 폴더를 통째로 복사해 넣으면 설치 완료다.

이클립스 2.1, 3.0~3.3은 이클립스 홈 폴더의 plugins 폴더에 폴더를 통째로 복사해 넣으면 설치 완료다.

## EclipseHTMLEditor 플러그인

이놈은 이클립스에 HTML 에디터를 붙여 주는 놈이다.

<a href="http://sourceforge.jp/projects/amateras/releases/#package-2853" target="_blank">EclipseHTMLEditor 다운로드 페이지</a>에서 다운받는다.

위 페이지에는 여러 프로그램들이 있는데 그 중에 EclipseHTMLEditor 항목을 잘 찾아서 해야 한다. 아래 그림 참고.

<p style="text-align: center;">
  <img class=" aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/eclipse-html-editor-plugin/eclipse-html-editor-location.png" alt="" width="620" height="663" />
</p>

역시 위와 같은 기준으로 dropins 나 plugins 폴더에 넣어 주면 된다.

## 우분투에 있는 패키지로 이클립스를 설치한 경우

아래처럼 /usr/share/eclipse 폴더에 dropins 폴더를 만들고 거기 넣으면 된다.

<p style="text-align: center;">
  <img class="  aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/eclipse-html-editor-plugin/eclipse-folder.png" alt="" width="800" height="550" />
</p>

모든 게 완료되면 dropins 폴더는 아래처럼 생겨먹게 될 것이다.

<p style="text-align: center;">
  <img class=" aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/eclipse-html-editor-plugin/dropins-folder.png" alt="" width="573" height="288" />
</p>