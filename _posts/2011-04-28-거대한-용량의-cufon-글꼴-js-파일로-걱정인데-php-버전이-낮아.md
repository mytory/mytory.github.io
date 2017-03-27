---
title: 거대한 용량의 Cufon 글꼴 js 파일로 걱정인데 php 버전이 낮아 minify를 사용하지 못하는 사람을 위한 편법
author: 안형우
layout: post
permalink: /archives/1161
aktt_notify_twitter:
  - yes
daumview_id:
  - 36737738
categories:
  - 서버단
tags:
  - PHP
---
오늘, 작업중인 웹사이트에 [Cufon][1]으로 나눔고딕을 [적용][2]했다. 그런데 아무래도 1.3메가바이트나 되는 [나눔고딕 Cufon][3]은 트래픽에 부담. 그래서 minify 라이브러리를 이용해 압축 전송을 시도했다. 결과는 좌절.

내가 작업하는 서버는 PHP4였는데 [minify 라이브러리][4]의 최소 사양은 5.1.6이었던 것! 이런 젠장. 그럼 포기?

집에 돌아왔다가 깜짝 아이디어가 떠올랐다.

서버에 부하는 좀 주겠지만 트래픽 부하보다야 낫겠지! 하는 생각으로 떠올린 아이디어.

일단 NanumGothic.php 파일을 만들고, NanumGothic.js 에 있는 내용을 모두 복사한다.

파일 용량이 1.3메가바이트나 되니 메모장 따위로는 열 수 없다. 드림위버나 이클립스도 힘들어할 거다. 에디트플러스가 짱이다.

자자, 복사를 했다면, NanumGothic.php 맨 위에 그냥 아래와 같이 적어 준다.

<pre>&lt;?ob_start("ob_gzhandler");?&gt;</pre>

그러면 [php가 알아서 자신을 압축][5]한다.

그리고 아래쪽에 NanumGothic.js 의 내용 전체를 붙여 넣는다.(물론 `echo file_get_contents('NanumGothic.js');` 같은 걸로 처리해도 된다.

붙여 넣고 저장할 때 &#8220;인코딩 다른 거 고르셈&#8221; 뭐 이런 안내문 뜨는데 무시해라. 다른 거 고르지 말라는 말이다. 그냥 저장해라.

그리고 Cufon을 사용해야 하는 곳에서, 아래처럼 불러오면 그만이다.

<pre>&lt;script type="text/javascript" src="NanumGothic.php"&gt;&lt;/script&gt;</pre>

저런 식으로 사용할 수도 있는 거다.

[Web Page Content Compression Verification][6] 에 가서 검사를 해 보면 압축됐다고 나오는 것을 확인할 수 있고, 또한 작동도 잘 되는 것을 볼 수 있다. 만세!

내가 예시는 Cufon으로 들었지만 이 방법을 사용하면 다양한 응용을 할 수 있다.

물론 이 방법은 한계가 있다. 한 파일만 압축할 수 있다는 거다. 그러나 대용량 파일 하나를 확실히 잠재울 수 있다는 장점은 있다. 그리고 저런 방식으로 아예 변수를 받아 출력해 버리는 php 파일을 만들 수도 있을 것이다.

## 모든 js와 css 압축해서 내보내는 스크립트 만들기

자, 한 번 아이디어를 구현해 보자.

우선 아래와 같은 php 파일을 만든다. 경로는 편의상 /php-lib/gzip.php 로 하자.

<pre class="brush:php">ob_start("ob_gzhandler");
echo file_get_contents($_SERVER[&#039;DOCUMENT_ROOT&#039;] . $_GET[&#039;f&#039;]);</pre>

이렇게 만들고, 최상위 경로에 있는 `.htaccess` 파일을 연다.

그리고 거기에 이거 한 줄을 넣어 준다.

<pre>RewriteRule ^(.*\[^wp-admin].(css|js))$ /php-lib/gzip.php?f=$1 [L]</pre>

그러면 모든 것이 성공적으로 완료된다.

[웹페이지가 압축됐는지 검사][6]해 보면 잘 돼 있는 것을 확인할 수 있다.

이렇게 하면 굳이 src=&#8221;/php-lib/gzip.php?f=jquery.js&#8221; 이런 식으로 적어 주지 않아도 .htaccess 가 \*.js, \*.css로 들어온 요청을 알아서 gzip.php 에 통과시킨다.

단, 위 방법이 보안상 어떤 문제를 낳을지 난 잘 모르겠다. ㅋ

 [1]: https://github.com/sorccu/cufon/wiki/
 [2]: http://hhomm.com/hhomm_356
 [3]: http://hhomm.com/hhomm_367
 [4]: http://code.google.com/p/minify/
 [5]: http://www.php.net/manual/kr/function.ob-gzhandler.php
 [6]: http://www.whatsmyip.org/http_compression/