---
title: '[링크]이미지 파일이 서버에 있는지를 확인하려면?'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/425
aktt_notify_twitter:
  - yes
daumview_id:
  - 36996359
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<http://okjungsoo.textcube.com/7953638>

내가 관리하는 사이트에는 오래된 글에 이미지가 없는 경우가 있다. 이 경우에는 엑박이 떠서 별로다.

자바스크립트로 처리할 방법이 없을까 찾다가 발견한 글이다.

<pre class="brush:html">&lt;img src="..." onerror="handleError();"&gt;</pre>

이 방법과

<pre class="brush:js">var img = new Image();
img.onabort = this.handleAbort();
img.onerror = this.handleError();
img.onload = this.handleLoad();
</pre>

이 방법을 소개하고 있었다.

이걸 응용하면 어떻게 할 수 있을지도 모르겠다.