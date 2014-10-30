---
title: '[CSS3] 아이폰/아이패드 한글 폰트에 볼드 적용하는 트릭'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1843
aktt_notify_twitter:
  - yes
daumview_id:
  - 36670603
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - CSS3
---
네이버 널리 블로그에서 좋은 트릭을 발견했다.

<a href="http://html.nhncorp.com/blog/42270" rel="bookmark">▶[개발일지] HTML5/CSS3를 활용한 모바일 검색 개편</a>

위 글에서 &#8216;(4) 아이폰에서 지원안되는 한글BOLD 적용&#8217; 항목을 살펴 보면 나온다.

원하는 데다 아래처럼 css를 적용해 주면 된다.

<pre class="brush:css">strong {
  font-weight:normal;
  -webkit-text-stroke-width:.02em
}
</pre>

그러면 CSS3가 지원되는 웹킷 계열 브라우저에서는 <span style="-webkit-text-stroke-width:.02em">이렇게 굵게</span> 표시된다.