---
title: PHP 실행중 register_globals=On 으로 해야 한다면?
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/11227
daumview_id:
  - 50216998
categories:
  - 서버단
tags:
  - PHP
  - TIP
---
로컬에서 개발 환경을 갖추고 개발할 때, `register_globals=Off`로 해 놓고 작업한다. 그렇게 습관을 들여야 한다고 생각하기 때문이다.

그런데 이미 그렇게 작업해 놔서 `register_globals=On`으로 해야만 수정작업을 할 수 있는 경우가 있다. 완전히 편법이고 권장하지 않아야 마땅한 방법이지만, 그럴 때는 이렇게 하면 해결된다.

<pre>extract($_REQUEST);</pre>

알겠지만, `extract`는 배열의 값들을 다 꺼내 주는 함수고, `$_REQUEST`는 `$_GET`값과 `$_POST`값을 모두 갖고 있는 배열이다. 모든 페이지의 맨 앞에 `include`하는 파일에다가 위 코드를 넣으면 `php.ini` 파일을 건드릴 필요 없이 `register_globals`를 `On`으로 만든 것과 동일한 효과를 낼 수 있다.

물론 나는 절대로 권장하지 않는다. 불가피할 때만 쓰고 반드시 작업이 끝난 다음에는 코드를 삭제해야 한다. 뜻대로 되진 않겠지만 말이다. 최소한 아래처럼이라도 써야 한다.

<pre>if($_SERVER['REMOTE_ADDR'] == 127.0.0.1){
  extract($_REQUEST);
}</pre>

이상이다.