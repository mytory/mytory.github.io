---
title: 'jQuery, 객체를 바꿔치기하는 replaceWith() 함수 &#8211; 태그 바꿀 때도 사용 가능'
author: 안형우
layout: post
permalink: /archives/183
aktt_notify_twitter:
  - yes
daumview_id:
  - 37163611
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
이것도 오늘 사용하다가 메모해야겠다고 생각한 건데, 의외로 많이 사용하는 함수다. 그런데 설명돼 있는 곳은 잘 없는 함수다.

예컨대, <p>인 객체를 <h2>로 바꾸고 싶다면?

감싸는 건 .wrap(&#8216;h2&#8242;)라고 하면 된다. 그럼 바꿔치기는 어떻게 할까?

일단 객체가 필요하다. 그리고 바꿔치기할 객체도 필요하다.

<pre class="brush:html">&lt;p id="원본"&gt;원본객체의 텍스트&lt;/p&gt;</pre>

위를 원복객체라고 하자.

그리고 js 코드는 이렇다고 하자.

<pre class="brush:js">var 새객체="&lt;h2 id=&#039;새객체&#039;&gt;새객체의 텍스트&lt;/h2&gt;";
$(&#039;#원본&#039;).replaceWith(새객체);
</pre>

위 코드처럼 하면 원본객체가 새객체로 바뀐다.

원본객체의 텍스트를 유지하고 싶다면 아래처럼 쓰면 된다.

<pre class="brush:js">var 원본텍스트 = $(&#039;#원본&#039;).text();
var 새객체="&lt;h2 id=&#039;새객체&#039;&gt;"+ 원본텍스트 +"&lt;/h2&gt;";
$(&#039;#원본&#039;).replaceWith(새객체);
</pre>

이러면 당연히 원본텍스트가 유지되면서 태그만 교체될 것이다.