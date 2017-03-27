---
title: '[PHP] 배열 합치기 함수 _ array_merge'
author: 안형우
layout: post
permalink: /archives/628
aktt_notify_twitter:
  - yes
daumview_id:
  - 36906213
categories:
  - 서버단
tags:
  - PHP
---
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<http://php.net/manual/kr/function.array-merge.php> <div>
  한글화된 매뉴얼이다.
</div>

<div>
  나는 이 함수를 $_POST와 $_GET을 합치는 데 사용했다. ㅋㅋ 아래처럼 말이다.
</div>

<div>
  <pre class="brush:php">$_POST = array_merge($_POST, $_GET);</pre>
</div>

<div>
  단, 문자열 키값이 동일한 놈이 있으면, 즉, $_POST[name]이랑 $_GET[name] 이 동시에 있다면 말이다, 뒤에 써 준 놈 것으로 덮어쓴다고 한다.(위 코드 예제에서는 $_GET값으로 덮어쓸 것이다.) 키값이 숫자인 경우는 상관없다.
</div>

<div>
</div>