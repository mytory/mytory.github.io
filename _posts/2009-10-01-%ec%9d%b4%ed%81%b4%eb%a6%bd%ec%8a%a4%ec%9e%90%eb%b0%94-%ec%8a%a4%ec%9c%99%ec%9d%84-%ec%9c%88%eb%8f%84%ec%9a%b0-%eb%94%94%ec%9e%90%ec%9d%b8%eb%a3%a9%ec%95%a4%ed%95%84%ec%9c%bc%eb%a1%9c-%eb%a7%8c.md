---
title: '[이클립스]자바 스윙을 윈도우 디자인(룩앤필)으로 만드는 방법'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/64
aktt_notify_twitter:
  - yes
daumview_id:
  - 37253204
categories:
  - 개발 툴
tags:
  - Eclipse
---
자바의 룩앤필보다 윈도우의 룩앤필이 더 낫다고 생각할 때는 다음과 같이 설정한다.  
<span style="font-weight: bold;">이클립스 버전은 3.5.1</span>이다.  
이클립스 메뉴바 &#8211; Run &#8211; Run Configurations 으로 들어간다. 아래 그림 참고.  
<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile22.uf.110952494D4BC86C2E1226.png" class="aligncenter" width="580" height="510" alt="" />그리고 Arguments의 VM arguments에 아래 그림처럼 적어준다. 적어줄 말은,  
<span style="font-weight: bold; color: rgb(255, 0, 0);">-Dswing.defaultlaf=com.sun.java.swing.plaf.windows.WindowsLookAndFeel</span>  
<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile9.uf.196A5C5A4D4BC86C2ECC19.png" class="aligncenter" width="580" height="464" alt="" />