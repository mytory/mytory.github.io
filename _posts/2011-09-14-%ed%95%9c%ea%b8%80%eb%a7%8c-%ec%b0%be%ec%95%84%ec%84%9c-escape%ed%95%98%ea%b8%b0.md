---
title: '한글만 찾아서 escape하기 &#8211; javascript replace 함수 사용'
author: 안형우
layout: post
permalink: /archives/1790
aktt_notify_twitter:
  - yes
daumview_id:
  - 36674917
categories:
  - 기타
tags:
  - TIP
---
iceScrum이라고 스크럼 프로젝트 관리 툴이 있다. 오픈소스다.

그런데 한글 언어팩이 없다. 그래서 까짓거 번역해야지 생각했다.

그런데 그냥 한글을 입력한다고 되는 게 아니었다. `escape`를 해 줘야 했다. 아래처럼 해 주면 된다.

<pre>alert(escape(&#039;안녕하세요!&#039;))</pre>

그러면 이렇게 결과가 나온다.

> %uC548%uB155%uD558%uC138%uC694%21

자, 그런데 iceScrum 언어팩에서는 영문과 특수문자는 `escape`하지 않고 사용해야 한다.

즉, 한글만 `escape` 해 줘야 하는 것이다.

또한, `%uC548` 에서 `%`를 `\`로 변경해 줘야 했다. 정리하면 아래와 같다.

1.  한글만 골라서 `escape`한다.
2.  `%`를 `\`로 변경한다.

그래서 짠 코드가 아래 코드다.  
일일이 `escape`하지 않고, 일단 찾기 바꾸기로 언어 파일을 아래와 같이 만들었다. 브라우저로 보면 언어 파일 형식대로 보일 수 있도록 말이다. 브라우저에서 아래 html 파일을 열어서 언어 파일에 붙여 넣기 하면 된다.

<pre class="brush:xml">#General messages&lt;br/&gt;
is.shortname=&lt;b&gt;iS&lt;/b&gt;&lt;br/&gt;
is.welcome=&lt;b&gt;안녕하세요! iceScrum 입니다.&lt;/b&gt;&lt;br/&gt;
is.denied=&lt;b&gt;You don&#039;t have the required authority to perform this action.&lt;/b&gt;&lt;br/&gt;
is.error=&lt;b&gt;An error has occurred&lt;/b&gt;&lt;br/&gt;
is.logout=&lt;b&gt;Logout&lt;/b&gt;&lt;br/&gt;</pre>

그리고 b 태그 안에 있응 아이들을 escape하도록 jQuery로 코드를 짰다.

코드는 아래와 같다. 핵심은 7번째 라인이다.

<pre class="brush:js;highlight:7">$(document).ready(function(){
	escapeMessage();
});
function escapeMessage(){
	$(&#039;b&#039;).each(function(){
		text=$(this).text();
		$(this).text(text.replace(/([가-힣])/g, escapeThis));
	});
}
function escapeThis(str){
	return escape(str).replace(/\%/g,"\\");
}</pre>

여기서 한참 헤맨 것은, 7라인에서 `replace` 함수 안에 들어 가는 두 번째 인자값이다. 이놈을 함수로 하는 방법을 찾으라 애먹었다.

## 찾은 문자열을 활용하기

일단, 정규식을 사용하는 경우에는 &#8220;와우 $1 입니다.&#8221; 이런 식으로 사용을 할 수도 있다.

<pre class="brush:js">var text = "안녕하세요. 저는 녹풍입니다.";
var replaceText = text.replace(/(녹풍)/,"이 블로그를 운영하는 $1");
alert(replaceText);</pre>

위 코드의 결과는 `"이 블로그를 운영하는 녹풍입니다."` 이다.

`replace` 함수에서 첫 번째 인자값을 `/`로 둘러싸게 되는데, 이건 정규식을 사용하기 때문이다.

`(녹풍)`이라고 한 건 녹풍을 찾으라는 걸 정규식으로 표현한 것이다.

그래서 두 번째 인자값의 따옴표 안에 들어간 `$1`은 정규식에서 괄호 안에 있는 첫 번째 놈을 가리키게 된다.

## 찾은 문자열을 함수로 가공하기

함수로 가공할 수도 있고, 이게 바로 7번 라인에서 사용한 방법이다. 이건 예제를 뜯어 보면 알 수 있을 것이므로 패스한다.

내가 가공하고 있는 html 파일을 첨부하겠다. 이걸 뜯어 보면 도움이 될 거다.

[iceScrum 한국어 언어파일 1 (번역중)][1] | [iceScrum 한국어 언어파일 2 (번역중)][2]

 [1]: http://mytory.net/uploads/share/icescrum-messages-ko.html
 [2]: http://mytory.net/uploads/share/icescrum-report-ko.html