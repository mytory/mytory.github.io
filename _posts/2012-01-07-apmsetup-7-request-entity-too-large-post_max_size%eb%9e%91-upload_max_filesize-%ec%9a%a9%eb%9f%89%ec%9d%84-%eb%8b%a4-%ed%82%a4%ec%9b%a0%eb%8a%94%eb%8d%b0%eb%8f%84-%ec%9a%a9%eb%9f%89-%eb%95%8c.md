---
title: '[APMSETUP 7] Request Entity Too Large &#8211; post_max_size랑 upload_max_filesize 용량을 다 키웠는데도 용량 때문에 업로드가 안 된다고 나올 때'
author: 안형우
layout: post
permalink: /archives/2051
aktt_notify_twitter:
  - yes
daumview_id:
  - 36659738
categories:
  - 서버단
tags:
  - apache
---
**Request Entity Too Large**

<pre>The requested resource
 /folder/
 does not allow request data with POST requests, or the amount of data provided in the request exceeds the capacity limit.</pre>

<img class="aligncenter" src="http://mytory.net/uploads/legacy/Request-Entity-Too-Large.png" alt="" width="515" height="230" />

용량이 별로 크지도 않은 파일을 업로드시켰는데 위와 같은 에러 메세지가 떴다. 분명히 php.ini 에서 post\_max\_size랑 upload\_max\_filesize 의 용량을 늘렸는데도 그랬다.

문제는 php가 아니라 apache였다.

해법은 &#8220;Request Entity Too Large 에러 메세지&#8221;에서 찾았다.

## 해법 1. 설정 용량을 늘린다

<pre>C:\APM_Setup\Server\Apache\conf\extra\httpd-modsecurity.conf</pre>

위 파일을 메모장이나 텍스트 편집기로 열어서 아래 문구를 찾는다.

<pre>SecRequestBodyLimit 131072</pre>

숫자를 늘린다.

그런데 왜인지는 모르겠지만, 이 방법은 추천하지 않는다고 한다. 이유는 모른다. 알아서 판단하라.

## 해법2. modsecurity를 비활성화한다

<pre>C:\APM_Setup\Server\Apache\conf\httpd.conf</pre>

위 파일을 연다. 그리고 아래 부분을 찾는다.

<pre>Include conf/extra/httpd-modsecurity.conf</pre>

이걸 이렇게 고친다.

<pre>#Include conf/extra/httpd-modsecurity.conf</pre>

앞에 #만 붙여 주면 되는 거다.