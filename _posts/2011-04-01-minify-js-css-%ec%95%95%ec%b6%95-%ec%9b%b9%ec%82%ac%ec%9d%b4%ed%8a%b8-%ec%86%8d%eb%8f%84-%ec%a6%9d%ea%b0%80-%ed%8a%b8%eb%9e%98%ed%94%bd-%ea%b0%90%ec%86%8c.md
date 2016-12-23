---
title: '[minify] js, css 압축 &#8211; 웹사이트 속도 증가, 트래픽 절약'
author: 안형우
layout: post
permalink: /archives/1048
aktt_notify_twitter:
  - yes
daumview_id:
  - 36756165
categories:
  - 서버단
tags:
  - PHP
---
[cufon][1]을 사용하는데, 나눔고딕 js는 1.3MB다. 금세 트래픽이 닳아 버렸다.

그래선 안 되겠다 싶어서 압축 방법을 찾았다. 예전에 [도아님이 rss를 압축해서 내보냈다][2]는 것을 본 적이 있기 때문이다.

그러다 찾은 게 바로 [minify 라이브러리][3]다. [Minify로 CSS/자바스크립트 전송량 줄이기][4]라는 글을 참고해서 했다.

일단 이놈은 js와 css의 불필요한 공백을 제거해 준다. 그리고 gzip으로 압축해서 보낸다. 두 개를 한꺼번에 처리해 주는 좋은 녀석인 것이다.

**단, 알아야 할 점은 PHP 최소 사양이다. PHP 5.1.6. 이다. **PHP 버전때문에 좌절스런 분들은 약간의 [편법][5]을 이용해도 될 거다.

압축 풀면 있는 놈들 중 /min 폴더에 있는 놈들이 실제 사용하는 놈이라는 점, 그리고 `config.php` 의 `$min_cachePath` 와 `$min_documentRoot` 를 채워 넣어야 한다는 점을 일단 알아야 한다.

그 다음, 사용법은

<pre>http://example.com/min/index.php?f=myStyleFile.css,mySecondStyleFile.css</pre>

형식이다.

물론, .htaccess 파일을 수정해서 사용하면 마크업에 들어가 있는 css 파일 주소는 수정하지 않아도 minify를 거친 놈들이 출력되게 할 수 있다.

아래 줄을 추가해 준다.

<pre>RewriteEngine On
RewriteRule ^(.*\.(css|js))$ /min/index.php?f=$1 [L]</pre>

루트에 있는 .htaccess 만 수정해 주면 하위 폴더까지 다 먹는다.(파일명 자체가 .htaccess 다. 유닉스에서는 .으로 시작하면 숨김파일/폴더다.)

RewriteEngine On 은 맨 위에 써 있는 경우도 있다. 그러면 또 써 줄 필요는 없다.

텍큐의 경우는 난 잘 모르니 위에 내가 참고한 블로그에 가서 보면 된다.

잘 작동하는지 테스트는 [HTTP Compression Test][6]에서 해 보면 된다. 압축된 놈은 초록색, 안 된 놈은 빨간색이 뜬다. 온라인 주소여야 가능한 건 당연하다.

워드프레스 사용자들은 [Better WordPress Minify 라는 플러그인][7]을 설치하면 된다. 사용법은 자세히 말하지 않겠다.

[PHP 자체를 압축하는 방법][8]도 있다.

 [1]: http://cufon.shoqolate.com/
 [2]: http://offree.net/2116
 [3]: http://code.google.com/p/minify/
 [4]: http://pat.im/657
 [5]: http://mytory.net/archives/1161 "거대한 용량의 Cufon 글꼴 js 파일로 걱정인데 php 버전이 낮아 minify를 사용하지 못하는 사람을 위한 편법"
 [6]: http://www.whatsmyip.org/http_compression/
 [7]: http://wordpress.org/extend/plugins/bwp-minify/
 [8]: http://mytory.net/archives/1050 "PHP문서를 압축해서 내보내기 – ob_start(“ob_gzhandler”)"