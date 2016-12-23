---
title: 숫자를 원하는 양식으로 바꾸기
author: 안형우
layout: post
permalink: /archives/17
aktt_notify_twitter:
  - yes
daumview_id:
  - 37269421
categories:
  - 서버단
tags:
  - PHP
---
sprint 함수를 사용하면 된다. 기본적인 것은 아래와 같다.

<pre class="brush:php">$data = 1;
echo sprintf("%04d",$data);
//0001로 나옴
</pre>

이런 식으로 할 수도 있다.

<pre class="brush:php">$data = 1;
printf("%04d",$data);
//역시 0001로 나옴
</pre>

더 자세한 설명은 php 레퍼런스를 참고하시길.[http://kr2.php.net/sprintf][1], [http://kr2.php.net/printf][2]

 [1]: http://kr.php.net/sprintf
 [2]: http://kr.php.net/printf