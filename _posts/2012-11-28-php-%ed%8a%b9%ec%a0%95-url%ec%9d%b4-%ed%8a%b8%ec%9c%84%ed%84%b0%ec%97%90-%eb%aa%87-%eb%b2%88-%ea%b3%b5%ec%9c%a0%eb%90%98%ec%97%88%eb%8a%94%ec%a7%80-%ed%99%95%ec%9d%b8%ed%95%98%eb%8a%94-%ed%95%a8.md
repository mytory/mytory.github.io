---
title: '[PHP] 특정 URL이 트위터에 몇 번 공유되었는지 확인하는 함수 예제'
author: 안형우
layout: post
permalink: /archives/8647
daumview_id:
  - 37142643
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush: php; gutter: true">//트위터에서 값을 받아오기 위해 필요한 함수다. cURL 라이브러리 필요.
function curl_get_content($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $content = curl_exec($ch);
  curl_close($ch);
  return $content;
}

function get_twitter_share_count($url) {
  $json = curl_get_content("http://urls.api.twitter.com/1/urls/count.json".
       "?callback=?&url=".urlencode($url));
  $info = (array)json_decode($json);
  return $info[&#039;count&#039;];
}

echo get_twitter_share_count("http://your-url.com/");</pre>

PHP 출력시 트위터 공유 카운트를 세도록 하면 트위터 서버의 상태에 따라 블로그의 성능이 왔다갔다 하게 될 수 있다. 따라서 외부 서버 의존적인 정보를 표시할 때는 `ajax`를 사용하는 편이 나을 거다. 검색엔진에 반드시 색인돼야 하는 정보를 표시하는 것이 아니라면 말이다.

또 하나, 위에서 내가 제시해 준 `curl_get_content()` 함수 대신 PHP 기본 함수인 `file_get_contents()` 함수를 사용해도 된다. 물론 `file_get_contents()` 함수가 활성화돼 있는 경우에만 그럴 수 있다. 대부분의 호스팅 회사들은 `file_get_contents()` 함수를 막아 두는 것 같다.