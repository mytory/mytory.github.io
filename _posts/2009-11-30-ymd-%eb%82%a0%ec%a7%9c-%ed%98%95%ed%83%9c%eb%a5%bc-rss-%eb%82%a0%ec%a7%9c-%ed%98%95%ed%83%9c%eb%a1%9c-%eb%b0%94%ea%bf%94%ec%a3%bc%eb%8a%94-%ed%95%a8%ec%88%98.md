---
title: Ymd 날짜 형태를 rss 날짜 형태로 바꿔주는 함수
author: 안형우
layout: post
permalink: /archives/107
aktt_notify_twitter:
  - yes
daumview_id:
  - 37217059
categories:
  - 서버단
tags:
  - PHP
---
아래 함수는 앞서 설명한 <a href="http://mytory.net/archives/105" target="_blank">Ymd 형태 date를 timestamp로 변환하는 php 코드</a> 와 <a href="http://mytory.net/archives/106" target="_blank">타임스탬프(Timestamp) 형태를 rss 날짜 형태로 바꾸는 코드 구현</a> 을 종합해서 만든 겁니다. 간단하죠.

그냥 긁어서 사용하십시오.

20091010 형태로 돼 있는 날짜를 RSS 형태로 변환해 주는 함수입니다. 코드 보시면 알겠지만 당연히 맨 마지막 함수를 사용하셔야겠죠? ^^

<pre class="brush:php">//Ymd를 타임스탬프 형태로 바꿔주는 함수
function Ymd2timestamp($Ymd){
//mktime(int hour, int minute, int second, int month, int day, int year );
//20091010
//01234567
    return mktime(&#39;9&#39;,&#39;0&#39;,&#39;0&#39;,substr($Ymd, 4, 2),substr($Ymd, 6, 2),substr($Ymd, 0, 4));
}
//타임스탬프를 rss 형태로 바꿔주는 함수
function timestamp2rss( $timestamp ){
    return gmdate(&#39;D, d M Y H:i:s&#39;, $timestamp).&#39; +0900&#39;;
}
//위의 두 함수를 이용해서 Ymd를 rss 형태로 변환해 주는 함수
function Ymd2rss($Ymd){
    return timestamp2rss(Ymd2timestamp($Ymd));
}
</pre>

&nbsp;