---
title: '[Google Analytics] pageTracker is not defined 라는 메세지는 무엇일까?'
author: 안형우
layout: post
permalink: /archives/2088
aktt_notify_twitter:
  - yes
daumview_id:
  - 36654129
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
구글 아날리틱스에서 사용하는 자바스크립트 변수는 pageTracker 라는 놈이다.

그런데 새 버전의 아날리틱스 추적 함수에서는 이 변수를 사용하지 않는다. _gaq라는 변수를 사용한다. 따라서 최신 추적 코드를 적용한 사이트라면, PDF 다운로드 같은 것을 추적하려면 다른 방식의 코드를 사용해야 한다.

전통적인 추적 코드는 아래와 같다.

<pre class="brush:js">&lt;a href="http://mydomain.com/myPdf.pdf" onClick="javascript:pageTracker._trackPageview(&#039;/myPdf.pdf&#039;);"&gt;myPdf 다운로드&lt;/a&gt;</pre>

그런데 새 버전의 추적코드를 사용하는 사이트에선 이게 안 먹는다는 거다. 위 코드에 대한 설명은 구글 공식 도움말 사이트에서도 사라졌다. 즉, 지금은 더이상 작동하지 않는 코드다. (새로운 방식의 코드를 설명하고 있는 도움말 페이지는 [외부 링크][1]라는 문서다. 그걸 참고할 수도 있을 거다.)

위 코드와 같은 일을 하는 코드는 아래와 같다.

<pre class="brush:js">&lt;a href="http://mydomain.com/myPdf.pdf" onClick="_gaq.push([&#039;_trackPageview&#039;, &#039;/myPdf.pdf&#039;])"&gt;myPdf 다운로드&lt;/a&gt;</pre>

mail 링크를 클릭하거나 하는 건 이벤트로 추적하는 게 더 나으므로 이메일 주소를 몇 번이나 클릭했는지를 확인하려면 아래처럼 코드를 쓰면 된다고 한다. 내 생각에 트위터 퍼가기 등을 추적할 때 쓰면 도움이 될 것 같다.

<pre class="brush:js">&lt;a href="mailto:hello@mydomain.com" onclick="_gaq.push([&#039;_trackEvent&#039;, &#039;name&#039;, value]);"&gt;hello@mydomain.com&lt;/a&gt;</pre>

외부 링크에 적용하려면 아래처럼 쓰면 될 것 같다.

<pre class="brush:js">jQuery(&#039;.recommand-left21-link&#039;).click(function(){
	_gaq.push([&#039;_trackEvent&#039;, &#039;레프트21 추천&#039;, &#039;클릭&#039;]);
});</pre>

<pre class="brush:html">&lt;a class=&#039;recommand-left21-link&#039; href=&#039;http://left21.com&#039;&gt;레프트21은 제가 강추하는 진보 언론입니다.&lt;/a&gt;</pre>

단, 위 코드는 내가 실제 적용해 본 코드는 아니다. 오늘 적용해서 실험을 시작했고, [Google Analytics pageTracker is not defined?][2] 에서 본 내용을 바탕으로 쓴 거다.

소셜 네트워크 반응 관련 추적 함수는 따로 있다. `<a href="http://code.google.com/intl/ko-KR/apis/analytics/docs/gaJS/gaJSApiSocialTracking.html#_gat.GA_EventTracker_._trackSocial">_trackSocial()</a>`이라는 함수다.

 [1]: https://support.google.com/analytics/bin/answer.py?hl=ko&answer=1136920&topic=1136919&ctx=topic
 [2]: http://stackoverflow.com/questions/3503511/google-analytics-pagetracker-is-not-defined