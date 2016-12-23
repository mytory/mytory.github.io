---
title: javascript 함수의 개념
author: 안형우
layout: post
permalink: /archives/69
aktt_notify_twitter:
  - yes
daumview_id:
  - 37251049
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
《프로그래밍 jQeury》의 부록A(appendix A)를 읽고 메모한 것이다.

## 자바스크립트는 함수를 변수 취급한다.

다음 세 코드는 동일한 내용이다.

<pre title="code" class="brush: jscript;">function wow(){
  alert(&#039;wow!&#039;);
}

var wow=function() {
  alert(&#039;wow!&#039;);
}

window.wow = function() {
  alert(&#039;wow!&#039;);
}</pre>

## 다른 객체 지향 언어와 달리 자바 스크립트에서 함수는 어떤 객체의 메서드가 아니다

이렇게 표현하는 편이 정확하다고 한다.

> 함수 f를 호출할 때 함수 콘텍스트로 객체 o가 제공되면 f는 o의 메서드 역할을 한다.

이와 관련한 코드는 다음과 같다.

<pre title="code" class="brush: jscript;">var o1 = {handle:&#039;o1&#039;};
var o2 = {handle:&#039;o2&#039;};
var o3 = {handle:&#039;o3&#039;};
window.handle = &#039;window&#039;;

function whoAmI() {
return this.handle;
}

o1.identifyMe = whoAmI;

alert(whoAmI());
alert(o1.identifyMe());
alert(whoAmI.call(o2));
alert(whoAmI.apply(o3));</pre>

《프로그래밍 jQuery》의 예제를 그대로 넣은 것이다.

`call()`과 `apply()`는 위에서 whoAmI라는 함수의 콘텍스트로 객체2(o2)와 객체3(o3)을 제공하는 역할을 한다. `call()`과 `apply()`는 바로 그런 역할을 하는 함수다.

위의 코드를 찬찬히 뜯어보면, 자바 등의 객체지향 언어의 메서드와 자바스크립트의 함수가 어떻게 다른지 알 수 있을 것이다.