---
title: '[번역] 아름답게 jQuery 엘리먼트 생성하기 Beautiful Element Creation with jQuery'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/829
aktt_notify_twitter:
  - yes
daumview_id:
  - 36764036
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
원문은 <a href="http://www.thenerdary.net/post/20965430596/beautiful-element-creation-with-jquery" target="_blank">Beautiful Element Creation with jQuery</a> 입니다.

엘리먼트(요소), 파라미터(매개 변수), 어트리뷰트(속성), 오브젝트(객체)는 그냥 번역하지 않고 사용했습니다.

<pre class="brush:html">&lt;div class="thisClass"&gt;&lt;/div&gt;</pre>

위 코드에서 `div`를 엘리먼트라고 합니다. class가 어트리뷰트고, `thisClass`는 value라고 하죠.

파라미터는 변수예요. 변수 모르시는 분은 없겠죠? `var name = "철수"` 할 때 `name`이 변수죠.

오브젝트는 흔히 객체라고 번역하는데 썩 좋은 번역은 아니라고 생각합니다. 이미 굳어진 단어니 어쩔 수 없이 사용해야 하긴 합니다만. 뭔지는 아시죠? 설명하기엔 역량이 달려서 패스합니다.

괄호()는 번역에 자신이 없을 때 원문을 넣는 용도로 사용했습니다. 꺽쇠괄호[]는 이해를 돕기 위해 넣은 것입니다.

&#8212;&#8212;- 번역 시작 &#8212;&#8212;

<img class="aligncenter" src="/uploads/legacy/old-images/1/cfile27.uf.203A6C444D4C0D6F2EB4D6.png" alt="" width="268" height="268" />

jQuery의 새(로운 것 같은) 엘리먼트 생성 문법은 리본을 떨구는 것 같은 문법이다.(jQuery&#8217;s new(ish) element creation syntax drops &#8216;bows.) 모르는 사람들을 위해 &#8211; 난 약간 기대하고 있는데 &#8211; jQuery는 당신들이 엘리먼트를 만들게 하고, 거기에 파라미터를 추가하게 한다. 엘리먼트와 엘리먼트의 어트리뷰트를 생성하기 위해 그 파라미터들을 사용할 것이다.

<pre class="brush:js">//Charles the alcoholic div
$(&#039;&lt;div /&gt;&#039;, {
	id: "charles"
});</pre>

옛 버전의 jQuery에서 여러분은 이렇게 썼을 것이다:

<pre class="brush:js">$(&#039;&lt;div id="charles"&gt;&lt;/div&gt;&#039;)</pre>

현명하게 들리는 이 방법은 두 번째 옵션이 더 명확하게 드러난다. 그리고 만약 여러분이 id를 가진 간단한 div를 만들고 있는 거라면 이건 훌륭한 해법이다.(Now, volume-wise it appears that the second option is clearer and if you&#8217;re creating a simple div with an ID, this is an excellent solution.) [그러나] 내 생각에 오브젝트 스타일로 [엘리먼트를] 생성하는 것에는 아주 많은 장점이 있다.

## 오브젝트에 이벤트를 붙일 수 있다.

아마 이런 식의 오브젝트 생성에서 가장 큰 특징은 이벤트를 붙일 수 있다는 점일 거다. 그냥 또 하나의 파라미터로 넣으면 된다.

<pre class="brush:js">$(&#039;&lt;div /&gt;&#039;, {
	id: &#039;charles&#039;,
	click: function(e){
		e.preventDefault();
		$(this).animate({opacity: 0.7}); 
	}
});</pre>

위에서 봤듯이, 우리 알콜중독 div인 charles는 점점 더 뚱뚱해질 거다.

## Git[버전관리 시스템]에서 버전 간 차이[diff]를 잘 볼 수 있다

[버전관리 시스템인] Git의 특별한 관점 중 하나는 라인별로 관리를 한다는 점이다. 만약 한 줄에서 일부를 고쳤다면, Git는 줄 전체가 바뀐 것으로 보여 준다. 자바스크립트는 아주 수정이 잦은(tempestuous-소란한,광포한) 언어기 때문에, 라인별로 [파라미터를 넣은 것에] 기반해 만든 엘리먼트는 미묘한 변화를 알아채기 좋다.

## 마구 복사[clone]할 수 있다

이런 오브젝트는 다른 jQuery 오브젝트처럼 작동해서 좋다.

<pre class="brush:js">var anchor = $(&#039;&lt;a /&gt;&#039;, {
	className: &#039;awesome&#039;,
	href: &#039;#&#039;,
	text: "This is an anchor ",
	click: function(e){
	 	e.preventDefault();
		$(this).parent().slideToggle();
	}
});

$("li").each(function(){
	$(this).prepend(anchor.clone());
});</pre>

이렇게 일단 값을 세팅하고, 필요할 때 언제든 복사할 수 있다. 물론 예전 문법으로 생성한 엘리먼트로도 이렇게 할 수 있다. 하지만 얼마나 \_\_아름다운지\_\_ 봐라. [생성한 오브젝트를] 그냥 사용하지 않고 복사(clone)하는 이유는 값이 저 하나의 엘리먼트를 참조하기 때문이다. 만약 복사하지 않는다면, 하나의 엘리먼트를 페이지에 넣으면 된다.

이것이 새로운 소식(hotness)이다. 더 알고 싶다면 <a href="http://api.jquery.com/jQuery/#jQuery2" target="_blank">이 문서</a>를 보면 된다.

&#8212;&#8212;&#8212;-

[역자 주] 단, 이렇게 하실 때는 반드시 className이라고 쓰셔야 합니다. class라고 쓰면 사파리에서 작동을 안 합니다. 물론 key값을 따옴표로 둘러쳐서 &#8220;class&#8221;라고 적으면 사파리에서도 잘 작동합니다. 저는 그냥 따옴표를 치는 쪽을 선호합니다. 귀찮거든요.

또한, 객체 안에 객체를 넣고 싶은 경우에는 append 같은 메서드를 사용해야 합니다. 이 방식으로 객체를 생성할 때 {}에 들어갈 수 있는 요소는 attributes, events, and methods to call이라고 정의돼 있습니다. 즉, object는 없는 거죠.