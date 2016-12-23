---
title: '[PHP] 문자열 자르고 말줄임표 붙이는 함수'
author: 안형우
layout: post
permalink: /archives/1036
aktt_notify_twitter:
  - yes
daumview_id:
  - 36757206
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush:php">function text_dot($text, $len){
	$text = strip_tags($text);
	if(strlen($text)&lt;=$len) {
		return $text;
	} else {
		$text = htmlspecialchars_decode($text);
		$text = mb_strcut($text, 0, $len, &#039;utf-8&#039;);
		$text = htmlspecialchars($text);
		return $text."…";
	}
}</pre>

위 함수를 사용하면 글자를 자른 후 말줄임표를 붙인다.

## 특징1 &#8211; `htmlspecialchars_decode` 함수

일단 [`htmlspecialchars_decode` 함수][1]를 사용했다.

HTML에서 <나 >를 표현하려면 < 이나 > 같은 형태로 써 줘야 한다.

자, <한겨레> 라는 문자열이 있다고 생각해 보자. 앞에서부터 7바이트를 자른다고 생각하자. 그러면 &#8216;<한겨&#8217; 라고 나올 것이라고 생각할 것이다. 그러나 아니다. 함수는 아마도 &#8216;<한&#8217; 만 리턴할 것이다. (UTF-8일 때 영문은 1바이트, 한글은 3바이트 처리된다.)

즉, HTML에서 사용하는 특수문자의 문자열이 잘리는 경우를 염두에 둬야 하는 것이다.

그래서 DB 등에 저장된 문자열 형태인 &#8216;<한겨레>&#8217;를 `htmlspecialchars_decode()` 를 이용해서 &#8216;<한겨레>&#8217;로 만든 다음 문자열을 자르는 것이다.

## 특징2 -`mb_strcut` 함수

보통 문자열을 자를 때 `substr`을 사용할 거다. 그러나 이건 알파벳에 최적화된 놈이다. 이걸로 한글을 자르면 글자가 깨지는 경우가 생긴다.

그래서 `mb_strcut`이나 `mb_substr`이라는 함수가 새로 나왔다. (새로 나왔다지만 이미 PHP 4.0.6 부터 있었던 것 같다;; 이 두 함수는 다른 방법으로 같은 역할을 수행한다. 단, mb\_substr은 인자값에서 1이 글자수고, mb\_strcut은 바이트수다.) 이들 함수의 mb는 multi-byte의 약자다.

이 함수를 사용하면 한글도 깨지지 않고 잘 잘린다.

## 예제

아래와 같이 test.php 따위의 파일을 만들어서 실행해 보면 함수를 잘 이해할 수 있을 것이다.

<pre class="brush:php">&lt;meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /&gt;
&lt;?
$str="abc와!!!";
echo "원래 문자열: $str &lt;br/&gt;";
$after_substr4=substr($str,0,4);
$after_substr5=substr($str,0,5);
$after_substr6=substr($str,0,6);
$after_substr7=substr($str,0,7);
$after_substr8=substr($str,0,8);
$after_substr9=substr($str,0,9);
echo "after substr 4: $after_substr4 &lt;br/&gt;";
echo "after substr 5: $after_substr5 &lt;br/&gt;";
echo "after substr 6: $after_substr6 &lt;br/&gt;";
echo "after substr 7: $after_substr7 &lt;br/&gt;";
echo "after substr 8: $after_substr8 &lt;br/&gt;";
echo "after substr 9: $after_substr9 &lt;br/&gt;";

$after_mb_strcut4 = mb_strcut($str,0,4, "UTF-8" );
$after_mb_strcut5 = mb_strcut($str,0,5, "UTF-8" );
$after_mb_strcut6 = mb_strcut($str,0,6, "UTF-8" );
$after_mb_strcut7 = mb_strcut($str,0,7, "UTF-8" );
$after_mb_strcut8 = mb_strcut($str,0,8, "UTF-8" );
$after_mb_strcut9 = mb_strcut($str,0,9, "UTF-8" );
echo "after mb_strcut 4: $after_mb_strcut4 &lt;br/&gt;";
echo "after mb_strcut 5: $after_mb_strcut5 &lt;br/&gt;";
echo "after mb_strcut 6: $after_mb_strcut6 &lt;br/&gt;";
echo "after mb_strcut 7: $after_mb_strcut7 &lt;br/&gt;";
echo "after mb_strcut 8: $after_mb_strcut8 &lt;br/&gt;";
echo "after mb_strcut 9: $after_mb_strcut9 &lt;br/&gt;";

/*결과 -
원래 문자열: abc와!!!
after substr 4: abc�
after substr 5: abc�
after substr 6: abc와
after substr 7: abc와!
after substr 8: abc와!!
after substr 9: abc와!!!
after mb_strcut 4: abc
after mb_strcut 5: abc
after mb_strcut 6: abc와
after mb_strcut 7: abc와!
after mb_strcut 8: abc와!!
after mb_strcut 9: abc와!!!
*/
?&gt;</pre>

`substr`로 4바이트나 5바이트를 잘랐을 때 한글이 깨지는 것을 알 수 있다. 특수문자와 영문은 1바이트, 한글은 3바이트 처리된다는 것도 알 수 있다.

 [1]: http://mytory.net/archives/247 "< 따위 글자를 원래대로 돌려주는 php함수 – htmlspecialchars_decode.php 구현함수"