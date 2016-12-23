---
title: '[java] split 메서드 사용시 실수하기 쉬운 것'
author: 안형우
layout: post
permalink: /archives/285
aktt_notify_twitter:
  - yes
daumview_id:
  - 37076975
categories:
  - 서버단
tags:
  - JAVA
---
split는 문자열을 나누는 메서드다.

<pre class="brush:java">String 문자열 = "가:나:다:가나다";
String[] 나눈배열 = 문자열.split(":");
//나눈배열 : {"가", "나", "다", "가나다"}
System.out.println(나눈배열[0]);
//결과 : 가
System.out.println(나눈배열[나눈배열.length-1]);
//결과 : 가나다
</pre>

그런데 아래처럼 쓰면 작동을 안 한다.

<pre class="brush:java">String 문자열 = "가.나.다.가나다";
String[] 나눈배열 = 문자열.split(".");
</pre>

이렇게 써야 한다.

<pre class="brush:java">String 문자열 = "가.나.다.가나다";
String[] 나눈배열 = 문자열.split("\\.");
</pre>

그래야 작동한다.

이건 split의 인자로 들어가는 String 토큰이 regex 정규식이기 때문이다. 정규식에서 .은 무작위의 한 글자를 의미한다. 그러면 모든 문자가 토큰이 되기 때문에 배열에 남는 게 없게 되는 것이다.

따라서 이스케이프 문자를 앞에 붙여 줘야 한다. 그런데 String 안에 이스케이프 문자인 \를 써 주려면 \\라고 써 줘야 한다. 따라서 \\라고 쓰는 것이다. 그래서 \\.이라고 쓰면 정규식 쪽에서는 \.라고 인식을 하고 실제 .을 찾게 되는 것이다.

아악&#8230; 머리아프다. 여튼 기억하라. 기호를 써서 split를 쓸 때 뭔가 작동을 안 하면 \\을 붙여 보라.

참, 그냥 \라고만 붙여야 하는 것도 있는데, 아래 애들이다.

\b \t \n \f \r \&#8221; \&#8217; \\

참고하면 될 것이다.