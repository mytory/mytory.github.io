---
title: '[php] ftp로 안 지워지는 폴더 지우기'
author: 안형우
layout: post
permalink: /archives/395
aktt_notify_twitter:
  - yes
daumview_id:
  - 37008931
categories:
  - 서버단
tags:
  - PHP
---
<div>
  내 생각엔, FTP의 퍼미션과 웹에서 실행하는 놈의 퍼미션이 달라서 생기는 문제로 보인다. (웹 서버로 올린 파일의 소유주는 www-data인 것 같다.)
</div>

<pre class="brush:php">exec(&#039;rm -Rf /myfolder/targetfolder/&#039;);</pre>

php 파일에 위 형식으로 적는다. 그리고 실행해 준다.

exec는 서버의 운영체제에 직접 명령을 내려 주는 명령어다.

즉, 위 명령은 유닉스(리눅스 아마) 서버일 때 가능한 명령어다.