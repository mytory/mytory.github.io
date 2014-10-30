---
title: ajax로 불러온 html 코드에 이벤트를 bind하고 싶다면? jquery live() 메서드
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/129
aktt_notify_twitter:
  - yes
daumview_id:
  - 37202970
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
일단 <font class="Apple-style-span" color="#FF0000"><b>주의사항</b></font> : jQuery의 버전을 확인하라. 내가 확인한 바로는 1.2.6에는 이 메서드가 없다. **<font class="Apple-style-span" color="#FF0000">1.3.2 버전</font>**에는 있었다. 왠만하면 jQuery 최신버전으로 업데이트하자.

**!! live() 메서드에 오류가 있어서 delegate, undelegate 메서드가 1.4.2에서 새로 나왔다. **<a href="http://www.learningjquery.com/2010/03/using-delegate-and-undelegate-in-jquery-1-4-2" target="_blank"><b>소개한 글</b></a>**인데 영어다. 기회 되면 번역해 보고 싶지만 시간은 없다.**

다음 코드를 보자.

<pre class="brush:html">&lt;ul&gt;
  &lt;li&gt;목록1 &lt;span class="loadChildList"&gt;+&lt;/span&gt;&lt;/li&gt;
  &lt;li&gt;목록2&lt;/li&gt;
  &lt;li&gt;목록3&lt;/li&gt;
&lt;/ul&gt;
</pre>

에서 목록1 옆에 있는 + 기호를 클릭했을 때 ajax로 하위 목록을 불러온다고 가정하자. 그럼 아래와 같은 목록이 나타날 수 있을 것이다.

<pre class="brush:html">&lt;ul&gt;
  &lt;li&gt;목록1 &lt;span class="loadChildList"&gt;+&lt;/span&gt;&lt;/li&gt;
    &lt;ul&gt;
      &lt;li&gt;하위목록1&lt;/li&gt;
      &lt;li&gt;하위목록2 &lt;span class="loadChildList"&gt;+&lt;/span&gt;&lt;/li&gt;
    &lt;/ul&gt;
  &lt;li&gt;목록2&lt;/li&gt;
  &lt;li&gt;목록3&lt;/li&gt;
&lt;/ul&gt;
</pre>

자, 위에서 하위목록2의 옆에 또 + 기호가 나타나 있는 것을 알 수 있는데&#8230; 저 + 기호를 클릭했을 때 또 하위목록을 ajax로드해야 한다.

물론 아래와 같은 코드를 사용한다면 쉬울 것이다.

<pre class="brush:html">&lt;li&gt;하위목록2 &lt;span class="loadChildList" onclick="loadChildList()"&gt;+&lt;/span&gt;&lt;/li&gt;
</pre>

ajax로 코드를 불러올 때 이렇게 처리해 두면 당연히 + 기호를 클릭했을 때 또 하위목록을 불러올 수 있을 것이다.

그러나 저렇게 html 코드 안에 onclick 같은 것을 사용하지 않고, html에는 오직 html만 넣고 싶은 순수주의 코더들은 어떻게 해야 할 것인가? 이것을 해결해 주는 게 jQuery의 live 메서드다.

사용법은 간단하다.

<pre class="brush:js">$(function(){
  $(&#039;.loadChildList&#039;).live(&#039;click&#039;, loadChildList);
});
</pre>

위와 같이 쓰면 loadChildList class를 가진 html 요소를 클릭했을 때 loadChildList 함수를 실행하게 된다. 그리고 ajax로 새로 불러온 요소에도 자동으로 이벤트가 bind된다.

(그냥 bind 함수를 사용하면, 이미 페이지에 로드돼 있던 요소에만 이벤트가 할당(bind)되고, ajax로 새로 불러온 요소에는 할당(bind)되지 않는다.)

live 메서드의 사용법을 더 잘 알고 싶다면 <a href="http://api.jquery.com/" target="_blank">jQuery API 사이트</a>에서 live로 검색을 해 보시라. 용법 자체는 bind 함수와 똑같으니 bind 함수의 용법을 참고하면 될 것이다.