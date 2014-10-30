---
title: "[이클립스] &#8216;현재 줄의 색깔'(Highlight current line)이 이상하게 변했다면?"
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2039
aktt_notify_twitter:
  - yes
daumview_id:
  - 36661159
categories:
  - 개발 툴
tags:
  - Eclipse
---
이클립스를 사용하고 있는데, 현재 줄을 알려 주는 Highlight current line 이 검정색으로 변했다. OTL;; 글자가 보이지 않았다.

여기저기 뒤져서 다행히 금세 찾아 냈다.

**Window > Preferences > General > Editors > Text Editors** 에 가면 찾을 수 있다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/eclipse-current-line-highlight.png" alt="" width="635" height="734" />

위 그림에서 아래쪽에 보면 **Current line highlight** 가 파랗게 선택돼 있다. 오른쪽의 **Color 부분**에서 원하는 색을 골라 주면 된다.