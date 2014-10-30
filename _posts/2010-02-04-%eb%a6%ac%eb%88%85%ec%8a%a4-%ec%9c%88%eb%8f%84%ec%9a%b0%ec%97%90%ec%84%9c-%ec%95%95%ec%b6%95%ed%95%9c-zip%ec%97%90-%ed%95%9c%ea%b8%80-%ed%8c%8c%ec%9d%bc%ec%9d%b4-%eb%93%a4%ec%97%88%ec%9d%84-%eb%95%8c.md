---
title: 리눅스, 윈도우에서 압축한 zip에 한글 파일이 들었을 때 파일명 깨지는 문제 해결하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/250
aktt_notify_twitter:
  - yes
daumview_id:
  - 37113165
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
여기 간단한 해결책이 있다 : <a href="http://ubuntu.or.kr/viewtopic.php?p=40719#p40719" target="_blank">http://ubuntu.or.kr/viewtopic.php?p=40719#p40719</a>

저 해결책대로 하는 방법을 요약하면 이렇다.

일단 이 파일을 다운받는다.

<a href="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile6.uf.1645C44A4D4BC88525EB68.zip" class="aligncenter" />cfile6.uf.1645C44A4D4BC88525EB68.zip</a>

Alt+F2를 눌러서 실행 창을 열고 여기에

<pre class="brush:plain">gksu nautilus</pre>

라고 쳐서 관리자 모드로 파일 탐색기를 연다.

방금 다운받은 파일의 압축을 풀면 kozip이라는 파일이 나오는데, 얘를 /usr/local/bin 에 집어넣어 준다.

그럼 끝!

<pre class="brush:plain">kozip 압축파일명.zip</pre>

위와 같은 방식으로 압축을 풀면 게임 끝!

[덧] 우분투 사용자들의 경우 처음부터 <a href="http://ubuntu.or.kr/viewtopic.php?p=48979" target="_blank">cobuntu</a>를 설치했다면 이미 kozip이 포함돼 있기 때문에 성가시게 위 과정을 거칠 필요가 없다. 그냥 kozip 사용하면 된다.