---
title: 현재 커서가 있는 Object의 태그네임 구하기
author: 안형우
layout: post
permalink: /archives/539
aktt_notify_twitter:
  - yes
daumview_id:
  - 36963928
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
맞는지 모르겠는데 심상정 블로그에서 자바스크립트 코드를 목격하고 잽싸게 긁었다.

이 코드가 필요한 이유는 웹브라우저에서 키보드로 뭔가를 조작하게 할 때, input, textarea 등에 커서가 위치할 때는 키보드 이벤트 실행을 막아야 하기 때문이다.

<pre class="brush:js">$(document).keydown( function(event) {
	if (event.altKey || event.ctrlKey)
		return;
	switch (event.target.nodeName) {
		case "INPUT":
		case "SELECT":
		case "TEXTAREA":
			return;
	}		
	switch (event.keyCode) {
		case 81: //Q
			window.location = "/now/admin";
		break;
		case 65: //A	
			alert("이전 페이지가 없습니다.");
		break;
		case 83: //S
			window.location = "./?page=2";
		break;
	}
});
</pre>

이제 제대로 작동하길 바란다.