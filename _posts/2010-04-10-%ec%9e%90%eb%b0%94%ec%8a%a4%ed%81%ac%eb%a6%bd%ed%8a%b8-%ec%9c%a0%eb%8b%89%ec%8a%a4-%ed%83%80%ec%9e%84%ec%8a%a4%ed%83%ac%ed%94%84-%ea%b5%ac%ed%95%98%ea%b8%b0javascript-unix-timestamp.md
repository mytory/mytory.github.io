---
title: 자바스크립트, 유닉스 타임스탬프 구하기(javascript unix timestamp)
author: 안형우
layout: post
permalink: /archives/489
aktt_notify_twitter:
  - yes
daumview_id:
  - 36981021
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
자바스크립트에서 유닉스 타임스탬프(유닉스 타임스탬프는 1970년 1월 1일 0시부터 지금까지 시각을 초로 환산한 놈이다. 각종 시간 수치의 기본형으로 활용하기 편하다. 다양한 놈으로 변환해 사용할 수 있기 때문이다.)를 구해야 할 일이 생겼다. php는 time() 함수를 사용하면 쉽게 구할 수 있다. 그런데 자바스크립트는 쉽게 구해 주는 게 없는 듯했다. 그래서 검색했더니 관련 내용이 나왔다.

<a href="http://tutorials.yaxay.com/showthread.php?t=45778" target="_blank">http://tutorials.yaxay.com/showthread.php?t=45778</a>에서 처음 접한 함수 모양은 아래에서 주석처리한 부분이다.

그런데 역시, 아즈키님이 <a target="_self" href="#comment8894084">댓글로 다른 의견</a>을 주셨는데, 아주 배울만한 내용이다. 그래서 아즈키님이 알려 주신 내용으로 코드를 수정했다.

<pre class="brush:js">fetch_unix_timestamp = function()
{
	//return parseInt(new Date().getTime().toString().substring(0, 10));
	return Math.floor(new Date().getTime() / 1000);
}

timestamp = fetch_unix_timestamp();
</pre>

코드 설명을 하겠다.

parseInt 는 정수가 아닌 놈을 정수로 바꾸는 함수다.

원래 코드에서는 new Date()로 오늘 날짜 정보를 담은 객체를 생성한 후 getTime() 함수로 Unix timestamp 밀리세컨드를 구한 것이다. 즉, unix timestamp를 1000분의 1초 단위로 구한 것. 그 후 toString 함수를 사용해 문자열로 바꿔 10자리를 끊었다. 이러면 맨 뒤의 세자리가 사라지니까 unix timestamp를 초단위로 구할 수 있게 된다.(현재 시간을 구하면 unix timestamp는 10자리의 숫자를 돌려 준다. 예컨대, 내가 지금 글을 쓰는 이 시각은 1270975817 다.) 자, toString으로 만든 후 10자리를 끊었으므로 이놈은 문자열 자료형이 된다.이놈을 정수로 바꾸기 위해 사용한 것으로 보인다.

아즈키님이 알려 준 새 코드는 이렇다.

<pre class="brush:js">new Date().getTime() / 1000</pre>

원리는 간단하다. subString을 사용해서 10자리를 끊으면 안 된다는 것이다. 현재 시각이 1270975817초이므로 아마 앞으로 8000000000초 미래까지는 유닉스 타임스탬프의 시각이 계속 10자리일 것이다. 그리고 과거 270000000초 전까지는 아마 10자리일 것이다. 

자, 오류를 발견할 수 있다. 무슨 말이냐? 2001년 1월 14일의 유닉스 타임스탬프 수치를 보자. 밀리세컨드까지 구하면 979462925793이다. 아즈키 님이 준 코드를 사용하면 979462925이 나온다. 그런데 원래 코드를 사용하면 열 자리를 끊으므로 9794629257이 나온다. 

즉, unxi timestamp 초가 10자리 미만으로 떨어지는 <span style="font-weight: bold;">몇 년 전 시간을 다루게 되면 원래의 함수는 오류를 내게 된다.</span>

함수는 생각할 거리를 많이 준다.

올바른 코드 활용법을 알려 주시는 아즈키 님께 감사! ^^