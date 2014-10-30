---
title: '[javascript] 아이폰, 아이팟 감지하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/768
aktt_notify_twitter:
  - yes
daumview_id:
  - 36811140
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
출처는 <a href="http://davidwalsh.name/detect-iphone" target="_blank">http://davidwalsh.name/detect-iphone</a>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />


<pre class="brush:js">if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) { 
  //원하는 코드
}
</pre>

위에 보면 알겠지만 navigator.userAgent 는 브라우저 쪽에서 서버쪽에 자신이 누구인지 알려 주는 문자열이다. 여기에 iPhone이나 iPod 이라는 문자열이 포함돼 있으면 아이폰이나 아이팟이다.

<a href="http://mytory.local/archives/769" target="_blank">PHP쪽도 마찬가지 문자열로 이를 감지</a>할 수 있다.