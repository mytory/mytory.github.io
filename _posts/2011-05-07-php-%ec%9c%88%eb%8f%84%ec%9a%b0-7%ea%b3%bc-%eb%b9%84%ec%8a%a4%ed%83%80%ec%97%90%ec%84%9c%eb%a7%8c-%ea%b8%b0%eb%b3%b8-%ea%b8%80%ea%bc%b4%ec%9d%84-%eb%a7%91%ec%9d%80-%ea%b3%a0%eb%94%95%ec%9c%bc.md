---
title: '[PHP] 윈도우 7과 비스타에서만 기본 글꼴을 맑은 고딕으로 설정하고 XP에서는 안 그러기'
author: 안형우
layout: post
permalink: /archives/1223
aktt_notify_twitter:
  - yes
daumview_id:
  - 36722489
categories:
  - 서버단
tags:
  - PHP
---
head 안에 다음 코드를 삽입하면 간단하게 해결된다.

`$_SERVER['HTTP_USER_AGENT']`는 브라우저가 서버에 알려 준 자신의 신원이다.

Windows NT 6.1은 윈도우 7을 가리키고, Windows NT 6.0은 비스타를 가리킨다.

<pre class="brush:php">function using_good_font_in_vista_and_7(){
	if(
		strstr($_SERVER[&#039;HTTP_USER_AGENT&#039;], &#039;Windows NT 6.1&#039;) or
		strstr($_SERVER[&#039;HTTP_USER_AGENT&#039;], &#039;Windows NT 6.0&#039;)
	){
		echo &#039;&lt;style type="text/css"&gt;body{font-family:"맑은 고딕"}&lt;/style&gt;&#039;;
	}
}

using_good_font_in_vista_and_7();</pre>

## 왜 이런 방식을 사용하는가?

나는 굴림이 정말 싫다.

그러나 무턱대고 맑은 고딕을 완전히 기본 글꼴로 지원할 수는 없다. 클리어타입 조정이 안 된 윈도우XP에서는 맑은 고딕 글꼴이 부옇게 흐려져 나오기 때문이다. 이는 가독성을 십각히 해치는 결과를 낳는다.

그러나 윈도우 비스타와 윈도우 7은 맑은 고딕이 윈도우 자체의 기본 글꼴이고, 클리어타입 조정도 기본으로 돼 있다. 따라서 부담없이 맑은 고딕 글꼴을 사용할 수 있다.

즉, 맑은 고딕이 가독성을 해치지 않는다고 확신할 수 있는 조건일 때만 맑은 고딕을 기본 글꼴로 지정하기 위해 이런 방법을 사용하는 것이다.