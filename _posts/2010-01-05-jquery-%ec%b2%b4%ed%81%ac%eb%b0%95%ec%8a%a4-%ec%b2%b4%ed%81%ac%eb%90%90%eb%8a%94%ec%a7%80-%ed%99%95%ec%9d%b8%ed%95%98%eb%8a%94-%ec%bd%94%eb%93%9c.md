---
title: jQuery 체크박스 체크됐는지 확인하는 코드
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/193
aktt_notify_twitter:
  - yes
daumview_id:
  - 37161237
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
오늘 <a href="http://bassistance.de/jquery-plugins/jquery-plugin-validation/" target="_blank">jQuery Form validate plugin (jQuery plugin: Validation)</a>을 좀 연구하다가 재밌는 코드를 발견해 갈무리해 둔다.

<pre class="brush:js">$(&#039;#newsletter&#039;).is(":checked");</pre>

위 코드처럼 쓰면 해당 오브젝트가 체크됐는지 안 됐는지 확인해 true나 false를 리턴하는 것 같다. 플러그인 함수가 아니라 jQuery 기본 함수다.

<a href="http://jquery.bassistance.de/validate/demo/" target="_blank">위 플러그인의 데모 페이지</a>에 가서 소스보기하면 사용 예제를 볼 수 있다.

jQuery API 사이트에서 [`.is()` 함수 API][1]를 보면 더 자세한 사용법을 알 수 있다.

 [1]: http://api.jquery.com/is/