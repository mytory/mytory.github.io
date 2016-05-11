---
title: '[eclipse] PHP Development Tools(PDT) 플러그인 설치하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/784
aktt_notify_twitter:
  - yes
daumview_id:
  - 36791699
categories:
  - 개발 툴
tags:
  - Eclipse
---
원래 PDT 2.1.2까지는 zip파일을 다운로드받아서 했는데 오늘 이클립스 최신버전인 헬리오스를 다운받아서 해당 zip 파일에서 플러그인을 설치하려고 하니까 아래처럼 에러 메시지가 나오면서 되지 않았다.

PHP Development Tools (PDT) Runtime Feature 2.1.2.v20090826-1027-7L7979F8NcJKhKRU19TmWA (org.eclipse.php.feature.group 2.1.2.v20090826-1027-7L7979F8NcJKhKRU19TmWA) requires &#8216;org.eclipse.dltk.core.feature.group [1.0.0,2.0.0)&#8217; but it could not be found

뭔 일인가 싶어 검색하다가 쉬운 방법을 찾게 됐다.(<a href="http://wiki.eclipse.org/PDT/Installation#From_Update_Site" target="_blank">업데이트 사이트를 통해 PDT 설치하기(영문)</a>)

**Help > Install new Software** 메뉴에서 PDT를 찾아서 그냥 설치하면 되는 것이었다. 

아래 그림을 참고하면 쉽다.

<img src="/uploads/legacy/old-images/1/cfile25.uf.114EB24C4D4BC9682C3E25.png" class="aligncenter" width="580" height="729" alt="" />

참 쉽다.

물론 위 그림을 따라하지 않고 PDT 업데이트 사이트에서 2.2 버전을 다운로드해서 로컬 아카이브 파일로 설치해도 된다. 헬리오스라면 반드시 2.2를 다운받아야 한다는 점을 숙지하기 바란다.