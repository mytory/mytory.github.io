---
title: html 페이지에 anchor 심기(책갈피 만들기)
author: 안형우
layout: post
permalink: /archives/229
aktt_notify_twitter:
  - yes
daumview_id:
  - 37132266
categories:
  - 웹 퍼블리싱
tags:
  - HTML
---
HTML 책갈피(anchor) 기능은 꽤 유용하다. 특히 긴 페이지에서 목차를 만들 때도 유용하고, 블로그에서는 &#8216;댓글 쓰기 바로 가기&#8217; 등에 사용된다.

그런데 오늘 내가 까맣게 모르고 있던 사실을 알았다!

&#8216;id와 class 어떻게 구분해서 사용할까&#8217;의 댓글을 읽다가 안 건데, html의 id 자체가 책갈피로 사용된다는 사실이다.

아래 코드를 보자.

<pre class="brush:html">&lt;div id="there"&gt;저기&lt;/div&gt;</pre>

이래놓고 

<pre class="brush:html">&lt;a href="#there"&gt;저기 가기&lt;/a&gt;</pre>

이러고 <a href="#there" target="_self">저기 가기</a>를 클릭하면 &#8216;저기&#8217;로 가는 것이다.

한 번 위의 링크를 클릭해 보라.













<div id="there">
  <p>
    저기
  </p>
</div>