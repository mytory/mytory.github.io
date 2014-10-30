---
title: '[eclipse] 우분투 11.04/11.10의 Unity에서 이클립스 실행중 아이콘이 사라지는 경우'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1956
aktt_notify_twitter:
  - yes
daumview_id:
  - 36664874
categories:
  - 기타
tags:
  - Ubuntu Family
---
왜 그런지는 나도 모르겠다.

[Eclipse RCP menus and the new Natty Unity][1]에서 실마리를 찾았다.

이클립스 디렉토리에서 아무 텍스트 파일이나 만든다. 이름도 적당히 붙인다. 나는 run_eclipse 라고 붙였다.

그리고 아래 내용으로 채운다.

<pre class="brush:shell">#!/bin/bash
export UBUNTU_MENUPROXY=0
./eclipse</pre>

저장하고 나와서 이 파일에 실행권한을 준다.

파일 속성 > 권한(Permission) 에 가면 실행할 수 있게 한다는 체크박스가 있다. 그걸 체크하면 된다.

그리고 만든 파일을 더블클릭하자. 그러면 터미널에서 실행, 실행, 보기 뭐 이런 게 나오는데, 그냥 &#8216;실행(Excute)&#8217;을 선택해 준다.

그러면 Unity에 아이콘이 생기고, 그 아이콘은 사라지지 않는다. 다만, 아이콘 모양이 물음표라서 좀 짜증난다;;

&nbsp;

 [1]: http://stackoverflow.com/questions/6169895/eclipse-rcp-menus-and-the-new-natty-unity