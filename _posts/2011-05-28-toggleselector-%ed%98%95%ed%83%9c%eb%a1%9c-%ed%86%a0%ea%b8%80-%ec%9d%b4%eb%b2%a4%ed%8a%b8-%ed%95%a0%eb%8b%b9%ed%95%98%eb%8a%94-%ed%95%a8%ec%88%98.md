---
title: toggle:selector 형태로 토글 이벤트 할당하는 함수
author: 안형우
layout: post
permalink: /archives/1306
aktt_notify_twitter:
  - yes
daumview_id:
  - 36712989
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
접었다 폈다 하는 기능을 만드는 건 귀찮은 일을 수반한다.

하나쯤 만드는 건 간편하다. jQuery에는 `slideToggle` 이라는 강력한 메서드가 있다.

그런데 여러 개를 만들다 보면 좀 귀찮다. 코드가 반복된다.

그래서 간단하게, 버튼을 만들고, 거기다 타겟 이름을 적어 주면, 타겟을 접었다 폈다 하게 만드는 그런 이벤트 핸들러를 만들었다.

이렇게 하는 데 기본 아이디어는 코드 신택스 하이라이트에서 얻었다.

함수는 아래와 같다.

<pre class="brush:js">function bindToggleToToggleClass(){
	$(&#039;[class*="toggle:"]&#039;).each(function(){
		var className = $(this).attr(&#039;class&#039;);
		classArray = className.split(&#039; &#039;);
		var toggleTarget;
		for( i = 0 ; i &lt; classArray.length ; i++){
			if(classArray[i].indexOf(&#039;toggle:&#039;) != -1){
				toggleTarget = classArray[i].replace(/toggle:/,&#039;&#039;);
			}
		}
		$(this).css({
			&#039;cursor&#039;: &#039;pointer&#039;
		}).click(function(){
			$(toggleTarget).slideToggle();
		});
		$(toggleTarget).hide();
	})
}</pre>

그리고 html 쪽에서는 이렇게 써 주면 된다.

<pre class="brush:html">&lt;input type="button" value="열기" class="toggle:#targetId"/&gt;
&lt;div style="padding:20px;border:1px solid #ddd" id="targetId"&gt;
여기는 타겟 아이디입니다.
&lt;/div&gt;</pre>

그러면 아래처럼 된다. 예제에서는 id를 사용했지만, class를 사용할 수도 있다. `toggle:.targetClass` 이런 형식으로 적으면 된다.  
<!-- 예제 시작 -->

  
  


<input class="toggle:#targetId" type="button" value="열기" />

<div id="targetId" style="padding: 20px; border: 1px solid #ddd;">
  여기는 타겟 아이디입니다.
</div>

  
<!-- 예제 끝 -->