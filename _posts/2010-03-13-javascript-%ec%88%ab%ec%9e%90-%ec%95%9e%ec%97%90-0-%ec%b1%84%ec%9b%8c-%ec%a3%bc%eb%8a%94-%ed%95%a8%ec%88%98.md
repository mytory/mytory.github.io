---
title: javascript, 숫자 앞에 0 채워 주는 함수
author: 안형우
layout: post
permalink: /archives/393
aktt_notify_twitter:
  - yes
daumview_id:
  - 37010477
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<a target="_blank" href="http://www.okjsp.pe.kr/seq/29044">http://www.okjsp.pe.kr/seq/29044</a>  
역시, 일단 링크 밝혀 둔다.

소스는 아래와 같다.

<pre class="brush:js">function fillzero(obj, len) {
  obj= &#039;000000000000000&#039;+obj;
  return obj.substring(obj.length-len);
} 
//사용법 fillzero(33, 5);
//결과 00033
</pre>

이러면 대충 찰 것이다.

## 또 다른 방법

아즈키 님이 남겨 주신 <a href="http://www.diveintojavascript.com/projects/javascript-sprintf" target="_blank">댓글에 있는 방법</a>이다. 위 방법에 대해 아즈키 님이 &#8220;너무 대충인데요&#8221;라고 했는데 맞는 말이다. 위 함수는 대충 사용할 때 쓰면 된다고 본다.

그 외 제대로 저런 기능을 사용하고 싶다면 아즈키 님이 말해 준 <a href="http://www.diveintojavascript.com/projects/javascript-sprintf" target="_blank">Javascript sprintf</a>를 사용할 수 있다.

근데 나 같은 경우만 해도 이걸 보면 대체 어떻게 써먹으라는 건지 이해가 안 된다.

sprintf라는 함수는 사실 여러 언어에 있는 함수다. 따라서 여러 언어 중 하나의 설명을 보면 javacript sprintf의 사용법을 알 수 있다. 나는 PHP 사용자니 <a href="http://php.net/manual/en/function.sprintf.php" target="_blank">PHP sprinf 예제</a>를 봤다.

앞에 0 붙이는 효과를 사용하려면 PHP의 경우

<pre class="brush:php">echo sprintf("%05d",33);</pre>

라고 쓰면 될 것이다. echo는 출력 명령이다.

(위에서 05가 0을 5자리까지 채우라는 말이 된다.)

자바스크립트는 당연히 알아서 응용해 쓰면 될 일.

js파일을 혹시 모르니 첨부한다. 그러나 위 링크에 가면 설명이 좀 있다.

<a href="/uploads/legacy/old-images/1/cfile27.uf.13414E4A4D4BC8A52F7D69.rar" class="aligncenter" />cfile27.uf.13414E4A4D4BC8A52F7D69.rar</a>