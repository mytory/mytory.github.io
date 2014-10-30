---
title: jQuery 확장집합 form reset하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/365
aktt_notify_twitter:
  - yes
daumview_id:
  - 37024183
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
jQuery에서 다음과 같은 코드는 에러가 난다.

<pre class="brush:js">$(&#039;#myfomr&#039;).reset()</pre>

분명히 <a target="_blank" href="http://www.w3schools.com/jsref/met_form_reset.asp">reset()은 표준 메서드</a>인데 말이다.

아마도 확장집합이 배열처럼 취급되는 데 원인이 있는 듯하다.

이렇게 쓰면 해결된다.

<pre class="brush:js">$(function(){
  //방법1 - 하나만 리셋
  $(&#039;#myForm&#039;)[0].reset();
  //방법2 - 문서에 있는 모든 form을 리셋
  $(&#039;form&#039;).each(function(){
    this.reset();
  });
});
</pre>

간단한 해결책이 있었다. 이거 땜에 심심찮게 고생했었는데. 역시 구글링이 힘이다.

(혹시 확장집합이란 말이 생소한 사람을 위해 말하자면, jQuery in Action의 번역본 &#8216;프로그래밍 jQuery&#8217;에서 $(&#8216;#myId&#8217;) 처럼 $로 감싼 애들을 부르는 말(뭔지는 모른다;;)을 번역한 단어다.)