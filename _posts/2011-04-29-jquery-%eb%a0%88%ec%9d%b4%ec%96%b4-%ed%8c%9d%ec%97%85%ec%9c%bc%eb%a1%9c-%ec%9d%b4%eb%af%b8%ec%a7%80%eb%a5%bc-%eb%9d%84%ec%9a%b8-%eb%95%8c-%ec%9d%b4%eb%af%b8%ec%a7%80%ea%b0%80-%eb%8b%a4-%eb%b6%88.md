---
title: '[jQuery] 레이어 팝업으로 이미지를 띄울 때 이미지가 다 불러진 다음 이미지 사이즈를 계산해서 화면 정 중앙에 오게 하기'
author: 안형우
layout: post
permalink: /archives/1174
aktt_notify_twitter:
  - yes
daumview_id:
  - 36734301
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
**요약: `$('.certainImage').bind('load', functionName);` 형식의 코드를 사용하면 된다.**

[fancybox 라이브러리][1]는 강력한 이미지 갤러리 기능을 갖추고 있다.

그런데 ie6~8에서 화면이 로드되고 약 1~2초 정도 얼어 버리는 (프리징) 현상이 관찰됐다.

어차피 이미지를 확대해 보여 주는 기능밖에 없었기 때문에 fancybox를 제거하고 날코딩을 하기로 결정했다.

소요될 거라 생각한 시간은 대략 1시간이었다. 그러나 역시 3시간이 걸렸다.

일단 [화면을 덮는 반투명 검은 막(black mask)][2] 역시 내가 예전에 만들어 둔 코드를 사용했다.

그리고 [콘텐트를 불러 와서 화면 한 가운데 박는 코드][3]도 내가 예전에 만들어 둔 코드를 사용했다.

그런데 문제가 생겼다! 이런 젠장! 이미지가 완전히 로드되기 전에 박스 너비와 높이를 계산하기 때문에 높이와 너비 모두 0으로 처리 되는 버그가 발견됐다.

이미지가 전부 로드될 때까지 기다렸다가 높이 너비를 계산해야 이미지가 화면의 정 가운데 뜰 수 있는데 말이다.

이것 때문에 한참을 헤맸다. 그리고 결국 해법을 발견했다.

javacript에는 onLoad 라는 이벤트 핸들러가 있다. 이놈이 바로, 이미지까지 완전히 로딩이 끝난 후 어떤 걸 실행하라는 이벤트 핸들러다.

jQuery에서 이벤트를 붙일 때는 접두어 on을 빼고 사용한다.

그래서 아래와 같은 코드로 해결했다.

<pre class="brush:js">function loadLargeImage(href){

	if($(&#039;.large-image-box img&#039;).length == 0){
		//href를 받아서 이미지 객체를 만든다.
		var $img = $(&#039;&lt;img alt="" /&gt;&#039;,{
			&#039;src&#039;: href,
			&#039;style&#039;: &#039;border: 10px solid white;&#039;
		});

		//박스 안에 이미지를 박는다
		$(&#039;.large-image-box&#039;).append($img);

		//이미지가 완전히 로드되면 이미지 너비와 높이를 변수로 화면 정 중앙 위치를 계산하고 페이드인 한다.
		$img.bind(&#039;load&#039;, function(){

			$(&#039;.large-image-box&#039;).css({
				&#039;left&#039;: ( $(window).scrollLeft() + ($(window).width() - $(this).width())/2 ) + &#039;px&#039;,
				&#039;top&#039;: ( $(window).scrollTop() + ($(window).height() - $(this).height())/2 ) + &#039;px&#039;
			}).fadeIn();	
		});

	}else{

		$(&#039;.large-image-box&#039;).css({
			&#039;left&#039;: ( $(window).scrollLeft() + ($(window).width() - $(this).width())/2 ) + &#039;px&#039;,
			&#039;top&#039;: ( $(window).scrollTop() + ($(window).height() - $(this).height())/2 ) + &#039;px&#039;
		}).fadeIn();

	}	

}</pre>

유익한 것을 배운 시간이었다.

이제 반투명 검은 막과 함께 레이어 팝업을 띄우는 걸 능숙하게 할 수 있다. 물론, 내가 저장해 둔 코드를 긁어야겠지만 말이다.

 [1]: http://mytory.net/archives/599 "꽤 괜찮아 보이는 jQuery 이미지 확대 라이브러리 – 뭐, 갤러리도 되고, 대화박스도 되고 등등"
 [2]: http://mytory.net/archives/783 "[jQuery]레이어 팝업(modal window) 띄울 때 전체를 덮는 반투명 검은 막(black mask) 만들기"
 [3]: http://mytory.net/archives/812 "[jQuery] 레이어 팝업 박스를 화면 정 가운데 위치시키기(ie든 파폭이든 크롬이든 다 되는 거)"