---
title: 'PHP 버그? 세션 변수 값을 일반 변수가 덮어 쓰는 문제 &#8211; 아마 register_globals 때문인 듯'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/810
aktt_notify_twitter:
  - yes
daumview_id:
  - 36771079
categories:
  - 서버단
tags:
  - PHP
---
<div style="width: 410px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile2.uf.19425A4E4D4BC96D321E28.png" width="400" height="210" alt="" filename="cfile2.uf.19425A4E4D4BC96D321E28.png" filemime="" /><p class="wp-caption-text">
    △ PHP, 느슨해서 배우기 쉽지만 그만큼 제멋대로 작동하는 경우도 종종 있는 것 같다.
  </p>
</div>

오늘 어이없는 현상을 발견했다. 환경은 PHP&nbsp;5.2.8 이었고, `register_globals = On` 이었다.

`register_globals = Off`인 경우에는 이런 문제가 발생하지 않는 듯하다.

오늘 사용자 정보를 세션에 저장했다가 마지막 페이지에 가서 뿌려주는 페이지를 구현하고 있었다. 

<pre class="brush:php">session_start();
echo &#039;&lt;pre&gt;&#039;;
$_SESSION[&#039;foo&#039;] = &#039;세션 푸&#039;;
$foo = &#039;그냥 푸&#039;;
echo "세션 푸를 찍어 보자 : ".$_SESSION[&#039;foo&#039;];
echo "\n";
echo "그냥 푸를 찍어 보자 : ".$foo;
echo "\n";
echo &#039;&lt;/pre&gt;&#039;;
</pre>

위 예제를 보면 좀 도움이 될 것이라고 본다.

어떤 결과가 나올 거라고 예상하는가? 당연히 아래와 같은 결과가 논리적이다.</p> 

<pre class="brush:plain">세션 푸를 찍어 보자 : 세션 푸
그냥 푸를 찍어 보자 : 그냥 푸
</pre>

세션에 처음 변수를 할당했을 때의 화면은 위와 같이 정상적으로 나온다.

그런데 F5를 누른다면? 아래와 같이 나온다.

<pre class="brush:plain">세션 푸를 찍어 보자 : 그냥 푸
그냥 푸를 찍어 보자 : 그냥 푸
</pre>

즉, 그냥 변수의 내용이 세션 변수를 덮어 써버리는 것이었다. 

완전 황당 그 자체였다.

이걸 깨닫지 못했기 때문에, 나는 대체 어디서 정보가 유실된 거야 하면서 한참을 찾아야 했다.

게다가 나의 로컬 테스트 환경은 `register_globals = Off`였기 때문에, 로컬에서 모든 테스트를 마치고 서버에 파일을 올렸다가 낭패를 봐야 했다.

이건 도대체 뭔 문제 때문인지 설명 가능하신 분 없는지 궁금하다.

여튼간에 `register_globals = On` 인 경우 SESSION 변수를 사용할 때 주의하자. SESSION 변수와 이름이 같은 변수명을 사용하면 SESSION 정보가 날아가 버릴 수도 있다. 심지어 환경에 따라서 선택적으로 말이다.