---
title: 우분투에서 http 요청의 header 보기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/512
aktt_notify_twitter:
  - yes
daumview_id:
  - 36972967
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
오늘 <a href="/archives/478" target="_blank">에일루러스</a> 팁을 봤는데 재밌는 거였다. http의 헤더를 보는 것.

우리는 웹브라우저를 통해 웹페이지를 읽기 때문에 모르지만, 서버와 웹브라우저는 헤더를 주고받으면서 서로의 정체를 파악한다. 그 헤더 정보를 우분투 터미널에서 볼 수 있는 명령어가 바로 오늘 에일루러스가 준 팁이다.

명령어는 아래와 같다.

<pre class="brush:plain">w3m -dump_head http://example.com</pre>

위와 같이 명령어를 치면 아래와 같은 응답을 볼 수 있다.

<pre class="brush:plain">Received cookie: PHPSESSID=d34911cf41b645df1f22f9e72d407b8b
HTTP/1.1 200 OK
Date: Fri, 16 Apr 2010 01:16:38 GMT
Server: Apache/2.0.59 (Unix) PHP/4.4.7
Vary: User-Agent
X-Powered-By: PHP/4.4.7
Set-Cookie: PHPSESSID=d34911cf41b645df1f22f9e72d407b8b; path=/
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-cache,must-revalidate
Pragma: no-cache
P3P: CP=&#039;CAO PSA CONi OTR OUR DEM ONL&#039;
Connection: close
Content-Type: text/html; charset=UTF-8
</pre>

늘 쓸모있는 것은 아니겠지만, 언젠가 쓸모가 있을 것이라고 생각한다.