---
title: '[PHP] cURL로 웹사이트 읽어 오기 &#8211; 간단한 예제 함수'
author: 안형우
layout: post
permalink: /archives/8643
daumview_id:
  - 37144433
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush: php; gutter: true">function curl_get_content($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $content = curl_exec($ch);
  curl_close($ch);
  return $content;
}</pre>