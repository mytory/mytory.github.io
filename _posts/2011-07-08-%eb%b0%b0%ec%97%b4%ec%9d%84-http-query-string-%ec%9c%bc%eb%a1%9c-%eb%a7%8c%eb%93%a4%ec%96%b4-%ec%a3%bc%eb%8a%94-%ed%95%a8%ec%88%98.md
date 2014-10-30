---
title: 배열을 http Query String 으로 만들어 주는 함수
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1437
aktt_notify_twitter:
  - yes
daumview_id:
  - 36701960
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush:php">function http_parse_query( $array = NULL, $convention = &#039;%s&#039; ){
	if( count( $array ) == 0 ){
		return &#039;&#039;;
	} else {
		if( function_exists( &#039;http_build_query&#039; ) ){
			$query = http_build_query( $array );
		} else {
			$query = &#039;&#039;;
			foreach( $array as $key =&gt; $value ){
				if( is_array( $value ) ){
					$new_convention = sprintf( $convention, $key ) . &#039;[%s]&#039;;
					$query .= http_parse_query( $value, $new_convention );
				} else {
					$key = urlencode( $key );
					$value = urlencode( $value );
					$query .= sprintf( $convention, $key ) . "=$value&";
				}
			}
			$query = substr($query, 0, mb_strlen($query)-1);
		}
		return $query;
	}
}</pre>

URL을 분석해서 쿼리스트링을 뽑아낼 수 있는 함수인 parse\_url , 쿼리 스트링을 배열로 변환해 주는 함수인 parse\_str 과 함께 섞어서 아래처럼 활용할 수 있다.

언어를 변경해 주는 파일이고, 세션과 URL에 언어 정보를 넣어서 한글이면 영어로 영어면 한글로 전환해 준다.

굳이 URL에 lang=en 같은 정보를 넣는 이유는 검색엔진에 대응하기 위해서다.

<pre class="brush:php">if($_SESSION[&#039;language&#039;]==&#039;en&#039;){
	$_SESSION[&#039;language&#039;]=&#039;ko&#039;;
}else{
	$_SESSION[&#039;language&#039;]=&#039;en&#039;;
}
$parse = parse_url($_SERVER[&#039;HTTP_REFERER&#039;]);
$query_array = array();
if(isset($parse[&#039;query&#039;])){
	parse_str($parse[&#039;query&#039;], $query_array);
}
$query_array[&#039;lang&#039;]=$_SESSION[&#039;language&#039;];
$query_string = http_parse_query($query_array);
header(&#039;location: &#039;.$parse[&#039;path&#039;].&#039;?&#039;.$query_string);</pre>