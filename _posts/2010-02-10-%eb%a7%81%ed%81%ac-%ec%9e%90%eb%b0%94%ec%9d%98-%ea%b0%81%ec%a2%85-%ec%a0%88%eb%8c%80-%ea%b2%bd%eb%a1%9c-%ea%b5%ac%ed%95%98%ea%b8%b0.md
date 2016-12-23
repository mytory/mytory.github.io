---
title: '[링크] 자바의 각종 절대 경로 구하기'
author: 안형우
layout: post
permalink: /archives/263
aktt_notify_twitter:
  - yes
daumview_id:
  - 37103627
categories:
  - 서버단
tags:
  - JAVA
---
코딩 하다 보면 절대경로를 구할 필요가 느껴질 때가 있다. 파일을 업로드할 때다. URL이나 서버가 바뀐다고 업로드할 폴더명이 있는 String을 일일이 찾아 고치는 건 삽질이니까.

아래 링크에 잘 소개돼 있다.

<a target="_blank" href="http://www.mungchung.com/xe/protip/5436">http://www.mungchung.com/xe/protip/5436</a>

그런데 위 글에서 예제 중 이건 작동을 잘 안 한다.

<pre class="brush:java">this.getClass().getResource("/com/test/config/config.properties").getPath(); 
// classes 폴더에서부터 시작하여 해당파일까지의 절대 경로</pre>

String에 제대로 된 경로를 넣어야 하는 게 아닌가 싶은데, 더 탐구해 보는 게 좋겠다. <a target="_blank" href="http://java.sun.com/j2se/1.5.0/docs/api/java/lang/Class.html#getResource%28java.lang.String%29">getResource의 API를 참고</a>해 보자.