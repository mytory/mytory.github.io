---
title: '[PHP]문자열이 어디있는지 찾을 때 strpos / stripos'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/126
aktt_notify_twitter:
  - yes
daumview_id:
  - 37206060
categories:
  - 서버단
tags:
  - PHP
---
내가 관리하는 사이트에는 7000여 개의 콘텐츠가 있다. 그런데 옛날에 입력된 글들은 코드가 엉망이다. 심지어 글 맨 앞에 <p>가 들어가 있지 않은 경우도 있다. 그래서 프로그래밍을 통해 보완했다. 일일이 다 입력할 수는 없으니까.(나중에는 DB를 직접 다 뜯어고칠 생각인데 아직 시간이 없다.)

<pre class="brush:php">if(strpos($content, &#039;&lt;p&#039;)!==0 &amp;&amp; strpos($content, &#039;&lt;P&#039;)!==0)
 &nbsp;$content = &#039;&lt;p&gt;&#039;.$content;
</pre>

코드 자체는 간단하지만 신경쓸 게 좀 있다.

우선 strpos는 해당 문자열을 찾지 못할 경우 false를 반환하는데, PHP에서는 if 문에서 <a target="_blank" href="http://mytory.textcube.com/entry/php%EC%97%90%EC%84%9C-GET-%EB%B3%80%EC%88%98%EB%A5%BC-0%EC%9C%BC%EB%A1%9C-%EC%A4%AC%EC%9D%84-%EB%95%8C-%ED%99%95%EC%9D%B8-%EC%95%88-%EB%90%98%EB%8A%94-%EA%B2%BD%EC%9A%B0">0도 false처리된다.</a>&nbsp;따라서 <a target="_blank" href="http://kr.php.net/manual/en/language.operators.comparison.php">비교연산자</a>를 ==로 쓰면 안 되고 ===로 써야 한다. 그래서 위 코드에서 !==라고 비교한 것이다.

==는 형 타입까지는 신경쓰지 않는 비교연산자고, ===는 형 타입까지 신경쓰는 비교연산자다.

0==false 는 true지만, 0===false는 true가 아니다.

그래서 php 설명서에서 <a target="_blank" href="http://kr.php.net/manual/kr/function.strpos.php">strpos 항목</a>을 보면 아래와 같은 설명이 있다.

> Warning

> 이 함수는 논리 FALSE를 반환하지만, 0이나 &#8220;&#8221; 등, 논리 FALSE로 취급할 수 있는 다른 값을 반환할 수 있습니다. 자세한 정보는 [논리형][1]&nbsp;섹션을 참고하십시오. 이 함수의 반환값을 확인하려면 [=== 연산자][2]를 이용하십시오.

내 말이랑 같은 말이다. 문자열 위치가 맨 처음일 경우 0이 반환된다는 소리. 그래서 if문이 없다는 의미의 false랑 헷갈릴 수 있으니 꼭 ===연산자를 사용하라는 소리다.

이정도 설명했으면 될 테고.

PHP5부터는 stripos가 나왔다. 이건 대소문자 구분없이 검사할 수 있는 거다. 내가 사용하는 서버는 PHP4로 돼 있어서 stripos를 사용하지 못하고 && 연산자로 묶어서 대소문자를 검사했다.

이상.

 [1]: http://kr.php.net/manual/kr/language.types.boolean.php
 [2]: http://kr.php.net/manual/kr/language.operators.comparison.php