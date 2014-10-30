---
title: '$_SERVER[] 변수 내용을 보는 방법 세 가지'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/626
aktt_notify_twitter:
  - yes
daumview_id:
  - 36908166
categories:
  - 서버단
tags:
  - PHP
---
이건 PHP 아는 사람을 위한 겁니다.  
아래 코드를 파일에 넣고 실행해 보세요. 그러면 다양한 $_SERVER변수를 알 수 있습니다. 방법은 세 가지입니다.

## 1)print_r을 사용한다.

위아래를 pre 태그로 감싸는 걸 잊지 마세요.

<pre class="brush:php">&lt;pre&gt;
&lt;?php
print_r ($_SERVER);
?&gt;
&lt;/pre&gt;
</pre>

## 2)foreach를 사용한다

이 방법은 <a href="#comment6663601" target="_self">개미 님이 댓글</a>로 알려 주신 것입니다.

<pre class="brush:php">foreach( $_SERVER as $key =&gt; $value ){
echo "{$key} =&gt; {$value} &lt;br /&gt;";
}
</pre>

이 방법은 배열의 볼 때 널리 사용하는 방법인 것 같아요.

## 3)일일이 쓴다

다음은 무식한 방법입니다. 이 방법의 장점은, 세팅되지 않은 server 변수로 무엇이 있는지도 알 수 있다는 것이겠네요. ^^

<div>
  출처는 <a target="_blank" href="http://us3.php.net/manual/en/reserved.variables.server.php#91080">http://us3.php.net/manual/en/reserved.variables.server.php#91080</a> 입니다.
</div>

<pre class="brush:php">echo "&lt;table border=\"1\"&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;argv&#039;] ."&lt;/td&gt;&lt;td&gt;argv&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;argc&#039;] ."&lt;/td&gt;&lt;td&gt;argc&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;GATEWAY_INTERFACE&#039;] ."&lt;/td&gt;&lt;td&gt;GATEWAY_INTERFACE&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SERVER_ADDR&#039;] ."&lt;/td&gt;&lt;td&gt;SERVER_ADDR&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SERVER_NAME&#039;] ."&lt;/td&gt;&lt;td&gt;SERVER_NAME&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SERVER_SOFTWARE&#039;] ."&lt;/td&gt;&lt;td&gt;SERVER_SOFTWARE&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SERVER_PROTOCOL&#039;] ."&lt;/td&gt;&lt;td&gt;SERVER_PROTOCOL&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;REQUEST_METHOD&#039;] ."&lt;/td&gt;&lt;td&gt;REQUEST_METHOD&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;REQUEST_TIME&#039;] ."&lt;/td&gt;&lt;td&gt;REQUEST_TIME&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;QUERY_STRING&#039;] ."&lt;/td&gt;&lt;td&gt;QUERY_STRING&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;DOCUMENT_ROOT&#039;] ."&lt;/td&gt;&lt;td&gt;DOCUMENT_ROOT&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_ACCEPT&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_ACCEPT&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_ACCEPT_CHARSET&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_ACCEPT_CHARSET&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_ACCEPT_ENCODING&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_ACCEPT_ENCODING&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_ACCEPT_LANGUAGE&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_ACCEPT_LANGUAGE&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_CONNECTION&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_CONNECTION&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_HOST&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_HOST&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_REFERER&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_REFERER&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTP_USER_AGENT&#039;] ."&lt;/td&gt;&lt;td&gt;HTTP_USER_AGENT&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;HTTPS&#039;] ."&lt;/td&gt;&lt;td&gt;HTTPS&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;REMOTE_ADDR&#039;] ."&lt;/td&gt;&lt;td&gt;REMOTE_ADDR&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;REMOTE_HOST&#039;] ."&lt;/td&gt;&lt;td&gt;REMOTE_HOST&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;REMOTE_PORT&#039;] ."&lt;/td&gt;&lt;td&gt;REMOTE_PORT&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SCRIPT_FILENAME&#039;] ."&lt;/td&gt;&lt;td&gt;SCRIPT_FILENAME&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SERVER_ADMIN&#039;] ."&lt;/td&gt;&lt;td&gt;SERVER_ADMIN&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SERVER_PORT&#039;] ."&lt;/td&gt;&lt;td&gt;SERVER_PORT&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SERVER_SIGNATURE&#039;] ."&lt;/td&gt;&lt;td&gt;SERVER_SIGNATURE&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;PATH_TRANSLATED&#039;] ."&lt;/td&gt;&lt;td&gt;PATH_TRANSLATED&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;SCRIPT_NAME&#039;] ."&lt;/td&gt;&lt;td&gt;SCRIPT_NAME&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;REQUEST_URI&#039;] ."&lt;/td&gt;&lt;td&gt;REQUEST_URI&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;PHP_AUTH_DIGEST&#039;] ."&lt;/td&gt;&lt;td&gt;PHP_AUTH_DIGEST&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;PHP_AUTH_USER&#039;] ."&lt;/td&gt;&lt;td&gt;PHP_AUTH_USER&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;PHP_AUTH_PW&#039;] ."&lt;/td&gt;&lt;td&gt;PHP_AUTH_PW&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;tr&gt;&lt;td&gt;" .$_SERVER[&#039;AUTH_TYPE&#039;] ."&lt;/td&gt;&lt;td&gt;AUTH_TYPE&lt;/td&gt;&lt;/tr&gt;";
echo "&lt;/table&gt;"
</pre>