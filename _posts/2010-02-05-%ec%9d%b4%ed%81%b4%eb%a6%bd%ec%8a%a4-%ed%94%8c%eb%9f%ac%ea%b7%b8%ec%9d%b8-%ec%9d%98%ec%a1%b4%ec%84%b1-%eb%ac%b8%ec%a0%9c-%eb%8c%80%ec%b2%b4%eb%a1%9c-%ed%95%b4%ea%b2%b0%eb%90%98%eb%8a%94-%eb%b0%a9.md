---
title: 이클립스 플러그인 의존성 문제 대체로 해결되는 방법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/252
aktt_notify_twitter:
  - yes
daumview_id:
  - 37112696
categories:
  - 개발 툴
tags:
  - Eclipse
---
우분투에서 이클립스 sdk를 설치하고 install new software를 선택하면 WDT나 PDT 같은 툴은 항상 의존성 문제가 걸리면서 설치가 안 됐다. 아주 짜증이 났었다.

그래서 우분투 저장소의 이클립스는 사용하지 않고, 그냥 다운받은 걸로 사용을 했었다.

그런데 오늘 새로운 사실을 알게 됐다.

<pre class="brush:plain">http://download.eclipse.org/releases/galileo/</pre>



Location을 위 주소로 하면 온갖 프로그램이 나온다는 것을 알게 됐다.

위에서 java EE와, WDT, PDT, JDT, WST Server Adapter, JST Server Adapters 를 찾아 설치했다. 간편하게 설치가 완료됐다.