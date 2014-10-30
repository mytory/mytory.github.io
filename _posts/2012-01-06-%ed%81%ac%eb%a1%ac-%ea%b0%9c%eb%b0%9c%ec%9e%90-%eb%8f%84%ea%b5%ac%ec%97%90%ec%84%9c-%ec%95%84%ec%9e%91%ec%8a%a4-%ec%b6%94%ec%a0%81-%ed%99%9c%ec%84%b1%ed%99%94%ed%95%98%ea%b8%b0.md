---
title: '[크롬] 개발자 도구에서 아작스 추적 활성화하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2043
aktt_notify_twitter:
  - yes
daumview_id:
  - 36660426
categories:
  - 기타
tags:
  - TIP
---
Ctrl + Shift + J 를 누르거나

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/chrome-inspect-element.png" alt="" width="226" height="280" />
</p>

마우스 우클릭한 후 &#8216;요소 검사&#8217;를 선택하면 디버깅 툴이 나온다. 자바스크립트 코드를 콘솔에 치면 실행되는 것을 볼 수 있다.

그런데 이 콘솔에서 기본으로는 아작스 추적이 안 된다. 살펴 봤더니 옵션을 활성화해야 아작스를 추적할 수 있다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/chrome-log-ajax.png" alt="" width="295" height="240" />

위 그림처럼 콘솔창에서 마우스 우클릭을 한 후, &#8216;Log XMLHttpRequests&#8217;를 선택해 준다.

그러면 그 때부터 아작스 통신을 추적할 수 있다. 어떤 데이터를 넘겼는지, 어떤 응답이 왔는지 등을 알 수 있다.