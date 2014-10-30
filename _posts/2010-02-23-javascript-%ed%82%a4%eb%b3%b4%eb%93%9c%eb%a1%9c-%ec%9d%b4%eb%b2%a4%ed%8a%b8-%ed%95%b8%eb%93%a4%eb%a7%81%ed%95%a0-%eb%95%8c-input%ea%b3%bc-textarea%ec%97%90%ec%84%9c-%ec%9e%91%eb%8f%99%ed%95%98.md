---
title: '[javascript/jQuery] 키보드로 이벤트 핸들링할 때 input과 textarea에서 작동하지 않도록 만들기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/324
aktt_notify_twitter:
  - yes
daumview_id:
  - 37057893
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
좀 노가다를 하는 방법은 input과 textarea에 들어갈 때마다 이벤트를 해제하는 것인 듯하다.

## jQuery event.target 객체를 사용하기

두 번째 방법은 jQuery를 사용할 경우 쓸 수 있는 방법인 듯하다.

[jQuery에서 event.target 객체][1]를 제공하는 것 같다.

그러면 이런 식으로 코드를 사용할 수 있다.(크롬, 파폭, IE7에서 각각 테스트했다.)

<pre class="brush:js">$(document).keydown(function(e){
	if(e.target.nodeName.toLowerCase() == 'input'
		|| e.target.nodeName.toLowerCase() == 'textarea'){
		//input과 textarea에서는 아무것도 하지 않는다.
	}else{
		$('body').prepend(123);
	}
});</pre>

## 플래인 자바스크립트의 경우

플래인 자바스크립트를 이용하는 경우, 다음 코드를 참고할 수도 있을 듯하다.(이 코드는 파폭에서 작동하지 않는다.)

<pre class="brush:js">var key = new Array();
key['a'] = "이동할 주소";
key['b'] = "이동할 주소";
key['c'] = "이동할 주소";
key['d'] = "이동할 주소";

function getKey(keyStroke) {
    if ( (event.srcElement.tagName != 'INPUT') && (event.srcElement.tagName != 'TEXTAREA') ) {
        isNetscape=(document.layers);
        eventChooser = (isNetscape) ? keyStroke.which : event.keyCode;
        which = String.fromCharCode(eventChooser).toLowerCase();
        for (var i in key)
            if (which == i) window.location = key[i];
    }</pre>

[출처] 라이프인사이드 &#8211; 출처 바로 가기(링크 사라짐)

 [1]: http://api.jquery.com/event.target/