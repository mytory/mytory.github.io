---
title: '[MySql] 마지막으로 Insert한 놈의 ID값 받아 오기 mysql_insert_id()'
author: 안형우
layout: post
permalink: /archives/2085
aktt_notify_twitter:
  - yes
daumview_id:
  - 36655307
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush:php">foreach( $array as $arr ){
	$query = "INSERT INTO test (`id`, `name`, `content`) VALUES (null, &#039;{$arr[&#039;name&#039;]}&#039;, &#039;$arr[&#039;name&#039;]&#039;)";
	if( mysql_query($query) ){
		echo "입력했습니다.";
		echo "\n";
	}else{
		echo mysql_error();
		echo "\n";
	}
}
$last_id = mysql_insert_id();</pre>

나는 저걸 구하려고 늘 SELECT 문을 날렸었다. 그런데 얼마 전에야 저 함수가 있다는 걸 알게 됐다. 역시 왠만한 건 이미 다 나와 있구나.