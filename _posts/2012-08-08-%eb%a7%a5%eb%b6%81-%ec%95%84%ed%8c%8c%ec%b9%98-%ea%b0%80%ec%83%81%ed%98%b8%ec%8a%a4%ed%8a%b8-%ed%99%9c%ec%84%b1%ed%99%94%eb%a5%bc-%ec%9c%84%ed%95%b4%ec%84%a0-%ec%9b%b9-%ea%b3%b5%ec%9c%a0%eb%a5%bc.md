---
title: '맥북 아파치 가상호스트 활성화를 위해선 &#8216;웹 공유&#8217;를 켜야 한다'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3135
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36574688
categories:
  - 기타
tags:
  - Mac
---
맥에는 PHP와 아파치가 기본 설치돼 있다. 추가로 MySQL은 설치해야 한다. 물론, apache와 PHP도 연동을 해 줘야 한다.

이것은 &#8220;[맥북에어 아파치, PHP, MySQL 세팅..][1]&#8220;을 참고했다. MySQL은 다운받아 설치하면 되는데, [구글에서 Download MySQL Community Server로 검색][2]해서 맨 위에 뜨는 페이지에 들어가서 다운을 받으면 되겠다.

여튼 뭐 위 글 보고 따라하면 된다. 단, MySQL 캐릭터셋 설정 부분이 5.5 버전 이후부터는 바뀌었으니 그 부분만 아래처럼 추가하면 된다.

<pre>[client]
...
default-character-set=utf8

[mysqld]
...
character-set-server=utf8

[mysqldump]
...
default-character-set=utf8

[mysql]
...
default-character-set=utf8</pre>

## 가상 호스트 설정

그런데 졸라 짜증났던 게 가상호스트 문제였다. 아무리 설정을 해도 되지 않았다. `httpd.conf`에 들어가서 `vhost.conf` 인클루드하는 부분 주석처리 #도 지웠는데 작동하지 않았다. 아무리 `sudo apachectl restart`를 명령해 봐야 별 소용없었다.

결국, [Where are the Apache Configuration files on Mac? – `httpd.conf`][3] 에서 실마리를 찾을 수 있었는데, &#8216;시스템 환경설정&#8217;에 들어가서 &#8216;공유 > 웹 공유&#8217;를 활성화해야 하는 것이었다. 아래 그림을 참고하면 된다.

<img class="aligncenter" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/macbook-web-sharing-1.png" width="782" height="675" />

<div style="width: 706px" class="wp-caption aligncenter">
  <img class=" " alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/macbook-web-sharing-2.png" width="696" height="578" /><p class="wp-caption-text">
    이렇게 웹 공유를 활성화하면 그 때부터 버추얼호스트 설정이 적용되기 시작한다.
  </p>
</div>

그러면 이 때부터 작동을 시작한다.

작동을 시작한 후 `Forbidden` 에러가 뜬다면 [내가 쓴 해결책][4]을 보면 된다.

 [1]: http://madchick.egloos.com/3662494 "맥북에어 아파치, PHP, MySQL 세팅.."
 [2]: https://www.google.co.kr/#q=Download+MySQL+Community+Server
 [3]: http://smartwebdeveloper.com/mac/httpd-conf-location-mac
 [4]: http://mytory.local/archives/3143 "아파치 Forbidden  You don’t have permission to access / on this server. 에러 해결"