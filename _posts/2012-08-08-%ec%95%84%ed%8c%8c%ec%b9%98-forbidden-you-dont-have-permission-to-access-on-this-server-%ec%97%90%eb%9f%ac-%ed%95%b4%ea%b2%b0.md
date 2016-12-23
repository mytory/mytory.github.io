---
title: '아파치 Forbidden  You don&#8217;t have permission to access / on this server. 에러 해결'
author: 안형우
layout: post
permalink: /archives/3143
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36574561
categories:
  - 서버단
tags:
  - apache
---
[맥북에서 아파치 가상호스트 설정][1]에 성공했는데 이번에는 `Forbidden` 에러를 뿜었다.

<pre>Forbidden
 You don&#039;t have permission to access / on this server.</pre>

에러 로그를 보면 아래처럼 생겨먹었다.

<pre>client denied by server configuration : 폴더 경로</pre>

이런 에러가 나오는 이유는 apache 설정에서 `/` 하위에 접속하는 걸 전부 막아 뒀기 때문이다. `/` 하위를 모두 막고, 열어둘 곳만 지정하는 형식이다. 그래서 나는 `/etc/apache2/extra/vhost.conf`에 아래와 같은 설정을 추가했다.

만약 가상호스트를 사용하지 않는다면 `/etc/apache2/httpd.conf`에 넣으면 된다.

<pre class="brush: xml; gutter: true; first-line: 1">&lt;Directory /Users/mytory/workspace&gt;
   Options FollowSymLinks
   AllowOverride None
   Order deny,allow
   Allow from all
&lt;/Directory&gt;</pre>

나는 `/Users/mytory/workspace`의 하위 폴더들에서 작업을 하기 때문에 이렇게 쓴 거고, 각자 적당히 써 주면 된다.

## 퍼미션

에러 로그를 봤는데 퍼미션이 없다고 나오면 퍼미션을 주면 된다. 나는 로컬에서 작업할 용도로 설정한 것이기 때문에 아무 걱정없이 아래처럼 명령을 내렸다.

<pre class="brush: bash; gutter: true; first-line: 1">sudo chomd -R 755 .</pre>

하지만 서버를 실제로 돌린다면 모든 파일의 퍼미션은 기본으로 `644`(소유자는 읽기/쓰기 가능, 그룹은 읽기 가능, 게스트 읽기 가능)여야 할 거다 아마.

이렇게 하고 아파치를 재시작하면 끝!

<pre class="brush: bash; gutter: true; first-line: 1">sudo apachectl restart</pre>

 [1]: http://mytory.net/archives/3135 "맥북 아파치 가상호스트 활성화를 위해선 ‘웹 공유’를 켜야 한다"