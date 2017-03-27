---
title: jQuery each() 함수-여러 객체에 같은 함수를 모두 적용해야 할 때
author: 안형우
layout: post
permalink: /archives/182
aktt_notify_twitter:
  - yes
daumview_id:
  - 37163856
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
each() 함수를 아는지 모르겠다. 일단 <a href="http://api.jquery.com/" target="_blank">jQuery의 API</a>를 찾아 보시면 도움이 될 거라 생각한다.

이건 한마디로 말해서, &#8216;모든 애들에게 적용하라!&#8217; 라는 함수다. 어려울 수 있으니 예제를 함께 보자.

오늘 내가 직면한 문제였는데,

<pre class="brush:html">&lt;p class="소제목"&gt;나는야 소제목이다&lt;/p&gt;
</pre>

를

<pre class="brush:html">&lt;h2&gt;나는야 소제목이다&lt;/h2&gt;
</pre>

로 모두 바꿔야 했다. javascript를 이용해서 말이다. 추가로, 저런 소제목의 개수는 약 100개라고 생각하자.

효과적인 방법은 each() 함수를 사용하는 것이다.

<pre class="brush:js">$(&#039;p.소제목&#039;).each(function(){ 
  //class가 소제목인 p 전부에 아래 함수를 적용한다.
  //일단 text만 뽑아낸다.
  var text=$(this).text(); 
  //현재 통과중인 객체($(this))를 &#039;&lt;h2&gt;&#039;+text+&#039;&lt;/h2&gt;&#039;로 바꿔치기
  $(this).replaceWith(&#039;&lt;h2&gt;&#039;+text+&#039;&lt;/h2&gt;&#039;); 
});
</pre>

뭐, 쉽게 설명하지는 못한 것 같은데, 일단 each() 함수의 쓰임 정도는 간략히 알아볼 수 있었다고 생각한다.

요약하자면 이렇게 기억하면 된다. 객체들 전부에 뭔가 복잡한 함수를 적용하고 싶다면? each() 함수를 떠올려라. 긴 코드가 간단하게 줄어들 것이다. 이상.