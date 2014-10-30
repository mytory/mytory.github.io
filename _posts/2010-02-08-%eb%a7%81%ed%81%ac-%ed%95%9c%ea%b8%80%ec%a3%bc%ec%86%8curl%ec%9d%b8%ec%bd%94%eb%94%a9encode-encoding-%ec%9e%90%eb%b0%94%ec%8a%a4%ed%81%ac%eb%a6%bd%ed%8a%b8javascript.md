---
title: '[링크] 한글주소(URL)인코딩(encode, Encoding), 자바스크립트(JavaScript)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/258
aktt_notify_twitter:
  - yes
daumview_id:
  - 37108761
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
항상 익스플로러6가 문제다.

익스플로러6에서는 주소에 한글을 넣으면 에러가 난다.

자바스크립트에서 처리해 줄 경우 아래처럼 코드를 쓰면 된다.

<pre class="brush:js">encodeURI(&#039;문자열&#039;)</pre>

더 자세한 내용은 <a href="http://mwultong.blogspot.com/2006/10/urlencode-encoding-javascript.html" target="_blank">http://mwultong.blogspot.com/2006/10/urlencode-encoding-javascript.html</a>를 참고하면 된다.

[덧1]php는 urlencode(&#8216;String&#8217;) 함수를 사용하면 된다.

[덧2] 자바는 URLEncoder.encode(&#8216;문자열&#8217;,&#8217;UTF-8&#8242;) 형식을 사용한다. 자세한 건 <a href="http://docs.oracle.com/javase/7/docs/api/java/net/URLEncoder.html" target="_blank">URLEncoder 자바 API</a>를 참고.