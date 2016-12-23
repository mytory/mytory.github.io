---
title: '[PHP] Ymd 형태 date를 timestamp로 변환'
author: 안형우
layout: post
permalink: /archives/105
aktt_notify_twitter:
  - yes
daumview_id:
  - 37217437
categories:
  - 서버단
tags:
  - PHP
---
PHP 기본 함수인 `strtotime`을 사용하면 된다.

<pre class="brush: php; gutter: true; first-line: 1">echo time();
echo &#039;&lt;br&gt;&#039;;
echo strtotime(date(&#039;Ymd&#039;));
echo &#039;&lt;br&gt;&#039;;
echo strtotime(date(&#039;Ymd H:i:s&#039;));
echo &#039;&lt;br&gt;&#039;;
echo strtotime(date(&#039;Y-m-d&#039;));
echo &#039;&lt;br&gt;&#039;;
echo strtotime(date(&#039;Y-m-d H:i:s&#039;));</pre>

위 코드를 테스트해 보면 사용법을 금세 알 수 있을 것이다. 즉,

<pre class="brush: php; gutter: true">strtotime(&#039;2012-10-23&#039;);
strtotime(&#039;2012-10-23 19:13:25&#039;);</pre>

이런 식으로 사용할 수 있다는 말이다. 더 자세한 내용은 [PHP 매뉴얼의 strtotime][1]을 참고하라.

이 아래 것은 예전에 설명해 둔 함수인데, 지금은 쓸모없어졌다.

<pre class="brush:php">function Ymd2timestamp($Ymd){
//mktime(int hour, int minute, int second, int month, int day, int year );
//20091010
//01234567
    return mktime(&#039;9&#039;,&#039;0&#039;,&#039;0&#039;,substr($Ymd, 4, 2),substr($Ymd, 6, 2),substr($Ymd, 0, 4));
}</pre>

20091010 형태로 출력되는 날짜를 유닉스 타임스탬프(unix timestamp) 형태로 바꿔야할 때가 있습니다. 금세 만들 수 있지만 긁어서 사용하는 것보다 빠르지는 않겠죠. 빠른 작업을 위해 코드 붙여놓습니다.

hour에 변수를 9로 집어넣어 놓은 이유는, 그렇게 하면 우리 시간으로 0시를 가리키게 되기 때문입니다. 표준시간에 +9를 해야 우리나라 시간이 되죠.

 [1]: http://php.net/manual/kr/function.strtotime.php