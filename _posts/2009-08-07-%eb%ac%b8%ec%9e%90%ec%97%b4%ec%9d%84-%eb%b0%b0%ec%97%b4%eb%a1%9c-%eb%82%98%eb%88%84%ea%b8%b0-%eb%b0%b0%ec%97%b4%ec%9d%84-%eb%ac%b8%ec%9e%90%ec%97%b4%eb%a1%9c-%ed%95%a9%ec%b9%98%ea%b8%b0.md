---
title: 문자열을 배열로 나누기, 배열을 문자열로 합치기
author: 안형우
layout: post
permalink: /archives/15
aktt_notify_twitter:
  - yes
daumview_id:
  - 37270882
categories:
  - 서버단
tags:
  - PHP
---
explode 함수와 implode함수를 사용하면 된다. 이 두 함수는 서로 짝이다.

**$문자열 = &#8216;2009-03-24&#8242;;**

여기서 $문자열1을 &#8216;2009/03/24&#8217;로 바꾸고 싶다고 치자.

그러면 일단 문자열을 나눠서 배열에 저장한다. 명령어는 다음과 같다.

**$배열 = explode(&#8216;-&#8216;, $문자열);**

이렇게 하면 &#8211; 를 기준으로 문자열이 잘려서 $배열[0] 부터 $배열[2]까지 들어간다.

그다음, 다음과 같이 하면 배열들이 &#8216;2009/03/24&#8217;라는 문자열로 합쳐진다.

**$새문자열 = implode(&#8216;/&#8217;, $배열);**

이 명령은 배열값들 사이에 / 를 넣어서 문자열로 합치라는 이야기다.

자세한 설명은 php 매뉴얼을 참고하라.

**explode : **[**http://kr2.php.net/explode**][1]

**implode : **[**http://kr2.php.net/implode**][2]

 [1]: http://kr.php.net/explode
 [2]: http://kr.php.net/implode