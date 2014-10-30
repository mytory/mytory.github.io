---
title: '[링크] 젠장할 자바스크립트'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/376
aktt_notify_twitter:
  - yes
daumview_id:
  - 37014414
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<a href="http://firejune.com/1554" target="_blank">http://firejune.com/1554</a>

자바스크립트의 오류 모음인지 아니면 알아 둬야 할 것인지 모르겠으나 여튼간에 내 실력에서 볼 때 황당무게 무궁무진함.

<pre class="brush:js">NaN === NaN // false
 
Number.MIN_VALUE&gt; 0;
// true? really? wtf.
// It turns out that MIN_VALUE is the smallest number
// GREATER THAN ZERO, which of course totally makes sense.
 
parseInt(&#039;06&#039;); // 6
parseInt(&#039;08&#039;); // 0
// remember to pass in the radix!
 
typeof null // object
null === Object // false

(x=[].reverse)() === window // true

NaN === &#039;number&#039; // true
Infinity === 1/0 // true
0.1 + 0.2 === 0.3 // false

("foo" + + "bar") === "fooNaN" // true

alert(111111111111111111111); // alerts 111111111111111110000
</pre>

원본 출처는 <http://wtfjs.com/>라고 함. 아예 이런 코드 모아놓는 사이트라고.

<meta http-equiv="content-type" content="text/html; charset=utf-8" />