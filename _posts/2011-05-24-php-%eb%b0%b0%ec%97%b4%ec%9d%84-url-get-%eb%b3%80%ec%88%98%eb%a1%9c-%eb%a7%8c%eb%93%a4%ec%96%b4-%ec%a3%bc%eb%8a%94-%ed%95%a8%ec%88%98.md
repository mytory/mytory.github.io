---
title: '[PHP] 배열을 URL GET 변수로 만들어 주는 함수 http_build_query'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1279
aktt_notify_twitter:
  - yes
daumview_id:
  - 36713905
categories:
  - 서버단
tags:
  - PHP
---
이런 자잘한 함수를 알면 시간이 절약되고 코드가 깔끔해 진다. 특히 자잘한 함수들에 자잘하게 신경쓸 게 많은 경우 그렇다.

코드를 한 번 보자.

<pre>&lt;a target="_blank" href="http://twitter.com/share?text=&lt;?php echo urlencode(&#039;[맑시즘 2011]&#039;.$page_title)?&gt;&url=http://&lt;?php echo $_SERVER[&#039;HTTP_HOST&#039;].$_SERVER[&#039;REQUEST_URI&#039;]?&gt;&via=marxismTwit" title="트위터로 퍼가요"&gt;</pre>

이걸 이렇게 만들 수 있다.

<pre class="brush:php">$twitter_query_array = array(
	&#039;text&#039;=&gt;&#039;[맑시즘 2011]&#039;.$page_title,
	&#039;url&#039;=&gt;&#039;http://&#039;.$_SERVER[&#039;HTTP_HOST&#039;].$_SERVER[&#039;REQUEST_URI&#039;],
	&#039;via&#039;=&gt;&#039;marxismTwit&#039;
);
$twitter_query = http_build_query($twitter_query_array);</pre>

<pre>&lt;a target="_blank" href="http://twitter.com/share?&lt;?php echo $twitter_query?&gt;" title="트위터로 퍼가요"&gt;</pre>

GET 변수를 직접 쓰는 방식이 아니라 array로 만든 후 `<a href="http://kr.php.net/manual/kr/function.http-build-query.php">http_build_query</a>` 함수를 이용해 변환하는 방식을 사용하면 장점이 있다.

일단, 위에서 볼 수 있는대로 URL 길이가 줄어든다.

다음으로, 변수와 값의 쌍이 1줄에 1개씩 들어가는 것으로 관리되므로, SVN 같은 버전관리 시스템에서 관리하기 용이하다.

알아보기 쉬움은 물론이다.

마지막으로 한글이나 특수문자가 들어가는 경우 `<a href="http://kr.php.net/manual/kr/function.urlencode.php">urlencode</a>` 함수를 사용해 줘야 하는데 알아서 변환해 준다.