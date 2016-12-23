---
title: '[아파치] https로 리디렉트하기'
author: 안형우
layout: post
permalink: /archives/603
aktt_notify_twitter:
  - yes
daumview_id:
  - 36919610
categories:
  - 서버단
tags:
  - apache
---
조만간 &#8216;만들기&#8217;도 쓸 생각인데 일단, 리디렉트부터. <div>
  이건 <a href="http://tylee82.tistory.com/172" target="_blank">여기서 긁은 거</a>다. <a href="http://mytory.textcube.com/entry/%EC%95%84%ED%8C%8C%EC%B9%98-rewrite-module-%EC%BC%9C%EC%84%9C-htaccess-%ED%99%9C%EC%84%B1%ED%99%94%ED%95%98%EA%B8%B0%EC%9A%B0%EB%B6%84%ED%88%AC-%EA%B8%B0%EC%A4%80" target="_blank">.htaccess</a>를 이용한 거다.
</div>

<pre class="brush:plain">RewriteEngine On
RewriteCond %{HTTPS} !=on
RewriteRule .* https://%{SERVER_NAME}%{REQUEST_URI} [R,L]
</pre>

<div>
  이걸 .htaccess란 파일을 만들고 거기 넣는다.
</div>

<div>
  다시 말하지만 .htaccess 라는 파일명이어야 한다. 오타 아니다. .으로 시작하는 파일명은 리눅스에서 숨김파일이라는 의미다.
</div>

<div>
  그러면 https로 리디렉트된다.
</div>

<div>
  물론, https가 제대로 설정돼 있지 않다면 페이지를 찾을 수 없다고 나올 뿐이다.
</div>