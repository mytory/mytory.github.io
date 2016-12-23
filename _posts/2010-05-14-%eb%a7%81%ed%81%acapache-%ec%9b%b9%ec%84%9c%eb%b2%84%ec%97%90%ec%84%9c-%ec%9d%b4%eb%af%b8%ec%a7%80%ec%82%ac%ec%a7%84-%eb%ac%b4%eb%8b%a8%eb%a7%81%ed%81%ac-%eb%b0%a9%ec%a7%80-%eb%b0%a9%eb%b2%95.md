---
title: '[링크]Apache 웹서버에서 이미지(사진) 무단링크 방지 방법'
author: 안형우
layout: post
permalink: /archives/596
aktt_notify_twitter:
  - yes
daumview_id:
  - 36924303
categories:
  - 기타
tags:
  - TIP
---
http://blog.innorix.com/77 원본 글이 사라졌습니다. 하지만 [구글로 검색][1]을 해 보면 많은 글이 나옵니다.

.htaccess를 만들어 적용하기 원하는 폴더에 둔다. 물론 그 전에 .htaccess가 아파치 서버에서 활성화돼 있어야 한다.(<a href="http://mytory.textcube.com/entry/%EC%95%84%ED%8C%8C%EC%B9%98-rewrite-module-%EC%BC%9C%EC%84%9C-htaccess-%ED%99%9C%EC%84%B1%ED%99%94%ED%95%98%EA%B8%B0%EC%9A%B0%EB%B6%84%ED%88%AC-%EA%B8%B0%EC%A4%80" target="_blank">rewrite module 활성화하기</a>)

<pre class="brush:plain">RewriteEngine On
RewriteCond %{REQUEST_FILENAME} .*jpg$|.*gif$|.*png$|.*jpeg$ [NC]
RewriteCond %{HTTP_REFERER} !^$
RewriteCond %{HTTP_REFERER} !{url에 포함된 문자열}\. [NC]
RewriteRule (.*) access_denied.png</pre>

그리고 {url에 포함된 문자열}은 말 그대로 변경해 주면 된다.{} 안에 쓰지 말고 아래처럼 써야 한다.

<pre class="brush:plain">RewriteCond %{HTTP_REFERER} !mytory\. [NC]</pre>

mytory가 들어가는 url 말고는 어디서도 가져가지 말라는 거다.

 [1]: http://www.google.co.kr/search?sourceid=chrome&ie=UTF-8&q=Apache+%EC%9B%B9%EC%84%9C%EB%B2%84%EC%97%90%EC%84%9C+%EC%9D%B4%EB%AF%B8%EC%A7%80+%EB%AC%B4%EB%8B%A8%EB%A7%81%ED%81%AC+%EB%B0%A9%EC%A7%80+%EB%B0%A9%EB%B2%95