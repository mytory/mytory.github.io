---
title: '[PHP]배열 합치기 &#8211; GET과 POST가 귀찮다, 그냥 다 POST로 받자?!'
author: 안형우
layout: post
permalink: /archives/716
aktt_notify_twitter:
  - yes
daumview_id:
  - 36831909
categories:
  - 서버단
tags:
  - PHP
---
$\_REQUEST 변수를 사용하면 문제가 해결된다고 한다. 여기엔 $\_GET 값과 $_POST 값이 모두 들어 있다.

아래는 예전에 썼던 원문.

&#8212;&#8212;

이번에 개발을 하면서 이런 생각을 했다.

값을 GET으로 받든, POST로 받든간에 무조건 $_POST['key'] 형식으로 받아서 사용할 수 있게 하면 편하지 않을까?

전에 java를 배울 때 선배가 서블릿에서 get으로 받은 request를 모두 post로 넘겨 버리는 걸 본 적이 있었는데 비슷한 방법을 사용하면 되지 싶었다.

그래서? 배열 합치기가 있지 않을까 하고 <a href="http://www.php.net/manual/kr/ref.array.php" target="_blank">PHP.net의 array 함수 목록</a>을 찬찬히 살펴봤다. 있었다! <a href="http://php.net/manual/kr/function.array-merge.php" target="_blank">array_merge</a>.

이 함수를 사용했다. 아래처럼.

<pre class="brush:php">$_POST = array_merge($_GET, $_POST);</pre>

어차피 $\_GET이나 $\_POST나 모두 배열 형태로 값이 들어가 있다. 그래서 배열 합치기 함수를 사용하면 손쉽게 값을 합칠 수 있다.

array\_merge에서 $\_POST를 두 번째 인자값으로 했다. 이유가 있다. 두 배열을 합칠 때 겹치는 key가 있다면 뒤의 인자값으로 받은 배열에 있는 key값을 우선한다. 뭔 말인고?

$\_GET['abc']가 3이고, $\_POST['abc']가 6인데 위 예제처럼 array\_merge를 사용했다고 하자. 즉, $\_POST를 뒤의 인자값으로 넣었다고 하자. 그럼 두 배열을 합친 결과값인 $_POST['abc']의 값은 6이 된다.

array_merge는 배열을 몇 개고 끝없이 합칠 수 있는데, 겹치는 키값이 있을 경우에는 무조건 뒤에 있는 놈의 값이 우선한다.

그리고 PHP5에서는 아래처럼 문자열도 배열로 변환해서 합칠 수 있다고 한다.

<pre class="brush:php">$beginning = &#039;foo&#039;;

$end = array(1 =&gt; &#039;bar&#039;);

$result = array_merge((array)$beginning, (array)$end);

print_r($result);</pre>

참, 궁금한 게 있다. 그런데 $\_GET과 $\_POST를 이런 식으로 합쳐서 써버리면 보안상 위험요소는 없는 것일까? 혹시 아는 분이 있다면 답해 주시기 바란다.