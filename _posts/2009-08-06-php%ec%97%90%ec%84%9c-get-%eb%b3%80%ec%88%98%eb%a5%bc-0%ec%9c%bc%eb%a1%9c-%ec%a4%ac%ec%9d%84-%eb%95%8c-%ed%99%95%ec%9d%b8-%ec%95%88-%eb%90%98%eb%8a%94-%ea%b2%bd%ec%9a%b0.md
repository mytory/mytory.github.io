---
title: php에서 GET 변수를 0으로 줬을 때 확인 안 되는 경우
author: 안형우
layout: post
permalink: /archives/14
aktt_notify_twitter:
  - yes
daumview_id:
  - 37271509
categories:
  - 서버단
tags:
  - PHP
---
GET 방식으로 변수를 보냈다. 주소값은 다음과 같았다.

**ActionFactory.php?<span style="color: rgb(255, 0, 0);"><font class="Apple-style-span">deleteno=0</font></span>**

그리고, ActionFactory.php에는 이런 구문이 있었다.

<pre class="brush: php;" title="code">if($_GET[&#039;deleteno&#039;]){
  echo $_GET[&#039;deleteno&#039;];
}</pre>

그런데 여기 안 걸리는 것 아닌가! 분명 0이 아닐 때는 모두 if문에 걸렸단 말이지.

그래서 이렇게 변경하니 잘 됐다.

<pre title="code" class="brush: php;">if(isset($_GET[&#039;deleteno&#039;])==true){
  echo $_GET[&#039;deleteno&#039;];
}</pre>

위에 <a href="http://kr.php.net/isset" target="_blank">isset 함수</a>가 보일 것이다. isset은 변수가 세팅돼있는지 확인하는 함수다. 세팅돼 있으면 true, 아니면 false를 리턴한다.

나는 보통 **if($변수)**라고 써서 확인했었는데, 그러면 안 되나보다.

그리고 사실, **isset($변수)==true**는 안 적어 줘도 된다. 어차피 <a href="http://kr.php.net/manual/kr/control-structures.if.php" target="_blank">if($변수)는 $변수가 참이면 실행하고, 거짓이면 실행하지 말라는 뜻</a>이기 때문이다.

## 작동하지 않았던 이유는?

간단하다. 0은 false로 처리되기 때문이다.(<a href="http://kr.php.net/manual/kr/language.types.boolean.php#language.types.boolean.casting" target="_blank">참고 : false값인 사례들</a>)

**기타**

isset 말고 unset이란 함수도 있다. 이건 변수를 비우는 함수다.

**isset($변수1, $변수2)** 이렇게 쓰면, $변수1과 $변수2가 모두 세팅돼 있을 때만 참을 리턴한다.