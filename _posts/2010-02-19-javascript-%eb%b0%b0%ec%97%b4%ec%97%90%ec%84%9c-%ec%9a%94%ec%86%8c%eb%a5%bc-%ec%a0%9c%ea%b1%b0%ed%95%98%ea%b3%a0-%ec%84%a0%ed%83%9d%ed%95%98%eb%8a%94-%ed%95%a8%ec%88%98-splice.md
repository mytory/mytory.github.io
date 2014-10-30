---
title: '[javascript] 배열에서 요소를 제거하고 선택하는 함수 splice()'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/308
aktt_notify_twitter:
  - yes
daumview_id:
  - 37062742
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
일단 splice() 함수의 설명에 대해 보자.

<a target="_blank" href="http://www.w3schools.com/jsref/jsref_splice.asp">w3schools.com : JavaScript splice() Method</a>

아래 코드를 보자.

<pre class="brush:js">var a = new Array(0,1,2,3,4,5);
//일단 배열 만들고
var b = a.splice(2,3);
//2번 배열부터 3개 제거.
document.write(a);
//결과 : [0,1,5]
document.write(b);
//결과 : [2,3,4]
</pre>

즉, splice 당한 배열에서 지정된 범위 안에 있는 요소들을 빼서, return하는 함수가 splice다.