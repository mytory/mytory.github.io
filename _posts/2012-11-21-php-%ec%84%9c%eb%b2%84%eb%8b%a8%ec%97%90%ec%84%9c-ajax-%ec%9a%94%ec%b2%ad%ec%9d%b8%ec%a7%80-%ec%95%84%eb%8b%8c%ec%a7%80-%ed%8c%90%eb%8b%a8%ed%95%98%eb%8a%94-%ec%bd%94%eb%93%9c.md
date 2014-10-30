---
title: '[PHP] 서버단에서 ajax 요청인지 아닌지 판단하는 코드'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/8595
daumview_id:
  - 36846319
categories:
  - 서버단
tags:
  - PHP
---
스매싱 매거진의 [How To Use AJAX In WordPress(워드프레스에서 아작스 사용하는 방법)][1]를 보다가 알게 된 코드다.

<pre class="brush: php; gutter: true; first-line: 1; highlight: []; html-script: false">if(!empty($_SERVER[&#039;HTTP_X_REQUESTED_WITH&#039;]) && 
strtolower($_SERVER[&#039;HTTP_X_REQUESTED_WITH&#039;]) == &#039;xmlhttprequest&#039;) {
   $result = json_encode($result);
   echo $result;
}
else {
   header("Location: ".$_SERVER["HTTP_REFERER"]);
}</pre>

AJAX 요청인 경우에 `$_SERVER['HTTP_X_REQUESTED_WITH']` 슈퍼 변수가 `xmlhttprequest`라는 값으로 자동 세팅되나보다.

 [1]: http://wp.smashingmagazine.com/2011/10/18/how-to-use-ajax-in-wordpress/