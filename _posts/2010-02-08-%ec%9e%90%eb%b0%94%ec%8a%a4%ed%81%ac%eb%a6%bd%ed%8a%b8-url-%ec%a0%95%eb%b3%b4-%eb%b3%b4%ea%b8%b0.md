---
title: 자바스크립트 URL 정보 보기
author: 안형우
layout: post
permalink: /archives/259
aktt_notify_twitter:
  - yes
daumview_id:
  - 37107858
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<pre class="brush:js">hostname = window.location.hostname;
href = window.location.href;
host = window.location.host;
port = window.location.port;
pathname = window.location.pathname;
search = window.location.search;
protocoal = window.location.protocol;

document.write(hostname);
document.write(&#039;&lt;br /&gt;&#039;);
document.write(href);
document.write(&#039;&lt;br /&gt;&#039;);
document.write(host);
document.write(&#039;&lt;br /&gt;&#039;);
document.write(port);
document.write(&#039;&lt;br /&gt;&#039;);
document.write(pathname);
document.write(&#039;&lt;br /&gt;&#039;);
document.write(search);
document.write(&#039;&lt;br /&gt;&#039;);
document.write(protocoal);

/**
결과
localhost

http://localhost:8080/article/pageView.jsp?articleNo=34&#038;pageNo=1

localhost:8080
8080
/article/pageView.jsp
?articleNo=34&pageNo=1
http:
*/</pre>

참고 : 자바스크립트로 url 알아내기(http://bluefubu.net/zbxe/220 에서 정보를 얻었는데 지금은 페이지가 사라졌다.)