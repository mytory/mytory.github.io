---
title: javascript 배열에 새 요소 추가하기
author: 안형우
layout: post
permalink: /archives/230
aktt_notify_twitter:
  - yes
daumview_id:
  - 37130922
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
간단하다.

<pre class="brush:js">var 배열 = new Array();
배열.push(&#039;끝&#039;);
배열.unshift(&#039;처음&#039;);</pre>

push는 배열 끝에 새 요소를 추가하고, unshift는 배열의 처음에 새 요소를 추가한다.