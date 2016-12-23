---
title: 'PHP문서를 압축해서 내보내기 &#8211; ob_start(&#8220;ob_gzhandler&#8221;)'
author: 안형우
layout: post
permalink: /archives/1050
aktt_notify_twitter:
  - yes
daumview_id:
  - 36755229
categories:
  - 서버단
tags:
  - PHP
---
용량을 조금이라도 줄이면 웹사이트 트래픽도 줄일 수 있고, 속도도 개선할 수 있다.

PHP는 간단하게 할 수 있는데 파일의 거의 앞쪽(아마도 첫 문자열이 나오기 전)에 아래 줄을 써 주면 된다.

<pre>ob_start("ob_gzhandler");</pre>

그러면 그 파일은 압축돼 전송된다.

압축돼 전송되는 게 맞는지 확인은 [HTTP Compression Test][1] 에서 해 보면 된다.

[JS와 CSS를 압축하는 방법은 다른 글을 참고][2]하면 된다.

 [1]: http://www.whatsmyip.org/http_compression/
 [2]: http://mytory.net/archives/1048 "[minify] js, css 압축 – 웹사이트 속도 증가, 트래픽 감소"