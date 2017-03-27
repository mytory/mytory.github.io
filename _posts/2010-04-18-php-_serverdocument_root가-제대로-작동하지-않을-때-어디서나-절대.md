---
title: "[PHP] $_SERVER['DOCUMENT_ROOT']가 제대로 작동하지 않을 때 어디서나 절대경로 제대로 구하기"
author: 안형우
layout: post
permalink: /archives/519
aktt_notify_twitter:
  - yes
daumview_id:
  - 36968111
categories:
  - 서버단
tags:
  - PHP
---
PHP에서 서버 루트의 절대경로는 `$_SERVER['DOCUMENT_ROOT']`다. 그런데 얘가 엉뚱한 결과를 리턴하는 경우가 있다. 그럴 때는 아래처럼 구할 수 있다. 내가 만든 건데 오류가 있으면 지적해 주기 바란다.

<pre class="brush:php">$_SERVER[&#039;DOCUMENT_ROOT&#039;] = str_replace($_SERVER[&#039;PHP_SELF&#039;],&#039;&#039;,$_SERVER[&#039;SCRIPT_FILENAME&#039;]);
</pre>

파일명까지 포함한 절대경로에서 URL 이하 폴더와 파일명을 빼 버린 것이다.

<a href="http://php.net/manual/en/reserved.variables.server.php" target="_blank">PHP의 $_SERVER 변수 매뉴얼</a>이나 내 글 <a href="http://mytory.textcube.com/entry/SERVER-%EB%B3%80%EC%88%98-%EB%AA%A8%EC%9D%8C" target="_blank">$_SERVER[] 변수 구하기</a>를 참고하면 도움이 될 것이다.

단, 이게 어디서나 제대로 작동할 거라고 장담할 수는 없다. 이거 땜에 졸라 고생했다. 쌍.