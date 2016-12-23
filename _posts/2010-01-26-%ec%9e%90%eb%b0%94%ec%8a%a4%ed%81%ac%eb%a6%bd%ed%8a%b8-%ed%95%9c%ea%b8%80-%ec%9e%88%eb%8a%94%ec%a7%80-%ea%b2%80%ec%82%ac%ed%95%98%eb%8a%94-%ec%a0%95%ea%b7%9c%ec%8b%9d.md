---
title: 자바스크립트 한글 있는지 검사하는 정규식
author: 안형우
layout: post
permalink: /archives/238
aktt_notify_twitter:
  - yes
daumview_id:
  - 37117170
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
출처는 여기다 : <a href="http://blog.daum.net/osban/14691815" target="_blank">http://blog.daum.net/osban/14691815</a>

<pre class="brush:js">/정규식/.test(문자열)</pre>



정규식은 /와 / 사이에 쓴다. 아래처럼 말이다.

<pre class="brush:js">str = "test한글";
check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
if(check.test(str)) alert!("한글이 있습니다.");
</pre>

위 코드는 앞서 출처라고 적은 곳에 있던 코드다. 문자열에 한글이 포함돼있는지 체크하는 코드를 애타게 찾고 있었는데 큰 도움을 받았다. 이렇게 간단한 메서드가 있었다니 말이다.

핵심은 

<pre class="brush:plain">/[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/</pre>

이거다. 이게 정규식(정규식 종류는 모르겠다.)에서 모든 한글을 표현하는 것이다. 알아 두면 좋을 것이다. 분석해 보면 의외로 간단하다. |는 &#8216;또는&#8217;을 의미하는 것이다. []는 안에 있는 놈들을 묶어 주는 역할을 한다. &#8211; 는 당연히 어디부터 어디까지를 의미한다.

그래서, ㄱ부터 ㅎ이나 ㅏ부터 ㅣ, 가부터 힣 사이에 있는 놈들이 있냐? 하고 묻는 거다.

이해를 직관적으로 돕기 위해 날코딩을 해 보자.

<pre class="brush:js">alert( /a/.test("aaa") );
</pre>

이렇게 쓰면 얼럿 창에 true가 뜬다.

당연히 W3C Schools의 설명을 참고하면 도움이 된다 :

<a href="http://www.w3schools.com/jsref/jsref_regexp_test.asp" target="_blank">http://www.w3schools.com/jsref/jsref_regexp_test.asp</a>