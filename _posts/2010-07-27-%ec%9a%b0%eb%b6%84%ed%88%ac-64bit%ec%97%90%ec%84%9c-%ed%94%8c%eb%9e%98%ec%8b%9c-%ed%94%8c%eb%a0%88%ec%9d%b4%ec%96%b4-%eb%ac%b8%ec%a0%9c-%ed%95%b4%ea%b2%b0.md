---
title: 우분투 64bit에서 플래시 플레이어 문제 해결
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/710
aktt_notify_twitter:
  - yes
daumview_id:
  - 36835149
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투 64bit를 설치했다. 플래시가 제대로 작동하지 않았다. 

구글링해 보니 해결책을 찾을 수 있었다. 

일단 우분투 트윅을 설치한다. 터미널에서 다음 명령을 입력하거나 시냅틱 패키지 관리자에서 ubuntu-tweak을 찾아서 설치한다.

<pre class="brush:plain">sudo apt-get install ubuntu-tweak</pre>

그리고 나서 실행한다.

<div style="width: 481px" class="wp-caption aligncenter">
  <img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile9.uf.124BC34E4D4BC95723F06C.png" width="471" height="446" alt="" /><p class="wp-caption-text">
    △우분투 트윅의 위치다.
  </p>
</div>

<span style="font-weight: bold;">소스 센터 > Multimedia</span> 를 선택하고 <span style="font-weight: bold;">&#8216;잠금 풀기&#8217;</span> 버튼을 누른 후, <span style="font-weight: bold;">Adobe Flash PPA(x86-64)</span>에 체크하고 새로 고침을 누른다.(처음부터 얘가 켜져 있었는지를 모르겠다. 만약 화면에 암 것도 없다면 동기화를 한 번 눌러 준다.)

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile25.uf.111727594D4BC957153637.png" class="aligncenter" width="580" height="322" alt="" />

그리고 나서 <span style="font-weight: bold;">프로그램 센터</span>로 간다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile5.uf.1759A44F4D4BC95718B0C0.png" class="aligncenter" width="580" height="322" alt="" />

<span style="font-weight: bold;">프로그램 센터 > Other</span> 에서 <span style="font-weight: bold;">Flashplugin64-installer</span> 를 선택하고 <span style="font-weight: bold;">&#8216;적용&#8217;</span>을 누른다. 이놈이 없으면 역시 <span style="font-weight: bold;">&#8216;동기화&#8217;</span>를 먼저 눌러 준다.

그러면 완료된다. 이후로는 크롬, 오페라, 파이어폭스에서 모두 플래시가 잘 작동한다.