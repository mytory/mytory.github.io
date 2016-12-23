---
title: jQuery.log(msg) 플러그인을 만들어 봤다
author: 안형우
layout: post
permalink: /archives/2107
aktt_notify_twitter:
  - yes
daumview_id:
  - 36651554
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
자바스크립트 디버깅을 할 때 가장 많이 사용하는 것은 `alert()` 이다. 그러나 `alert()` 은 확인을 눌러야 하는 번거로움이 있다. 확인을 누르고 나면 내용이 사라져서 여러 개의 alert이 뜰 때는 비효율적인 경우도 있다.

그냥 로그를 뿌려 주는 함수가 있으면 좋을 것 같다는 생각을 하고 검색을 해 봤다. 역시나 나왔다.

jQuery.log(), Logging plugin for jQuery 라는 글[지금은 사라졌다 2012-06-30]에는 어떻게 log 함수를 만드는지 친절하게 설명돼 있다. (저 영어 글에 있는 로그 함수를 갖다 쓰면, `$.log.log(msg)`, `$.log.info(msg)` 형식으로 써야 한다.)

그런데 위 글에서 재밌는 함수를 발견했다. `console.log(msg)` 함수다. 크롬에서 해 보니까 크롬의 자바스크립트 콘솔(Ctrl+Shift+J)에 msg가 찍히는 걸 확인할 수 있었다. 이럴 수가. log 함수를 굳이 만들 필요가 없었던 건가;;

여튼 이 글을 참고해서 내가 플러그인을 만들어 봤다.

<pre class="brush:js">/* jquery.log.mytory.js ver 1.0 */
(function($) {
	$.log = function(message) {
		if( debug == true )
		{
			//if(&#039;console&#039; in window && &#039;log&#039; in window.console)
			if (typeof window.console != &#039;undefined&#039; && typeof window.console.log != &#039;undefined&#039;) {
				console.log(message);
			}

			var messageHTML =
				&#039;&lt;pre class="jquery-log-mytory" style="background-color:#000; color:#00ff00; padding:10px; font-size:16px; font-family: 나눔고딕코딩"&gt;&#039;
				+ &#039;&lt;span class="jquery-log-mytory-number" style="margin-right: 10px;"&gt;1&lt;/span&gt;&#039;
				+ message
				+ &#039;&lt;/pre&gt;&#039;;

			$logDiv = $(&#039;.jquery-log-mytory&#039;);

			if( $logDiv.length &gt; 0 )
			{
				var number = parseInt( $(&#039;.jquery-log-mytory-number:last&#039;).text() ) + 1;
				$logDiv.append("\n" + &#039;&lt;span class="jquery-log-mytory-number" style="margin-right: 10px;"&gt;&#039; + number + &#039;&lt;/span&gt;&#039; + message);
			}
			else
			{
				$(&#039;body&#039;).prepend(messageHTML);
			}
		}
	}
})(jQuery);</pre>

기능은 단순하다. 일단 자바스크립트 콘솔이 있는 경우에는 콘솔에도 메세지를 뿌려 준다. 그리고 HTML 페이지의 맨 위에 까만 바탕에 초록색 글자로 로그를 찍어 준다. 각 로그에는 번호가 붙어 있다. 끝이다.

코드가 가장 깔끔한 건 아닌데 뭐 성능이 엄청 필요하고 그런 플러그인이 아니니까 별 상관 없다고 생각한다. 쓰면서 개선하면 되겠지.

## console.log() 를 사용할 때 주의점

내가 소개한 영어 글을 보면 console.log 를 사용할 때 아래처럼 조건문으로 감싸져 있다.

<pre class="brush:js">if (typeof window.console != &#039;undefined&#039; && typeof window.console.log != &#039;undefined&#039;) {
	console.log(message);
}</pre>

이유가 있다. 몰랐는데 양파 님이 [댓글][1]로 말해 줘서 알았다.

> 참고로 console 객체는 IE8 이상, 크롬, 파이어폭스, 사파리 모두 지원합니다. 파이어버그나 크롬개발자도구, IE개발자도구(F12) 등등
> 
> console.log() 이외에 dir(), info(), error() 등 여러 내장메소드가 존재해서 디버깅시에 유용합니다.
> 
> 다만 console 객체 사용시 IE에서는 개발자도구를 켜지 않은 상태에서 console 객체를 사용하거나 IE7 이하에서 사용하게 되면 스크립트 에러가 나오니 주의해서 사용해야 합니다.

 [1]: #comment-2529