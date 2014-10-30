---
title: 타임스탬프(Timestamp) 형태를 rss 날짜 형태로 바꾸는 코드 구현
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/106
aktt_notify_twitter:
  - yes
daumview_id:
  - 37217218
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush:php">function timestamp2rss( $timestamp ){
    return gmdate(&#039;D, d M Y H:i:s&#039;, $timestamp).&#039; +0900&#039;;
}
</pre>

일단 날짜를 timestamp 형태로 바꾸면 RSS 형태로 만드는 것은 쉽지만, 역시 긁어서 사용하는 것만큼 쉽지는 않겠죠.

20091010(Ymd 형태로 뽑으면 이렇게 되죠.) 형태로 돼 있는 날짜를 유닉스 타임스탬프(Unix Timestamp)로 바꾸는 함수는 제가 쓴 글 <a target="_blank" href="http://mytory.textcube.com/77">Ymd 형태 date를 timestamp로 변환하는 php 코드</a>를 보시면 됩니다.

## +0900에 대해

RSS가 인식하는 date format(날짜 형태)은 <a target="_blank" href="http://feedvalidator.org/docs/error/InvalidRFC2822Date.html">RFC-822 포맷</a>이라고 하네요. 그리니치 표준 시간대에서 한국 날짜로 하려면 9시간을 더해 줘야 하는 것 같습니다. 그래서&nbsp; 마지막 부분에 +0900가 붙는 것이지요.