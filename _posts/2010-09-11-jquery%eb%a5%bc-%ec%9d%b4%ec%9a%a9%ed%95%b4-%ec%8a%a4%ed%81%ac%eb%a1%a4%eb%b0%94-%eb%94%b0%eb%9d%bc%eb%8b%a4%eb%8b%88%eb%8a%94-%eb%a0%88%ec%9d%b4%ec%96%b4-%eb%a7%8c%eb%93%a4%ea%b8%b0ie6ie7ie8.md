---
title: jQuery를 이용해 스크롤바 따라다니는 레이어 만들기(IE6,IE7,IE8,크롬,사파리,파폭)
author: 안형우
layout: post
permalink: /archives/761
aktt_notify_twitter:
  - yes
daumview_id:
  - 36813727
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
<span style="line-height: 1.5em;">이 문제에 관한 토론은 여기서 볼 수 있다 : </span><a style="line-height: 1.5em;" href="http://forum.standardmag.org/viewtopic.php?id=513">떠다니는 레이어, 그 표준은?</a>

아래는 내가 구현한 것이다.

<pre class="brush:js">$(document).ready(function(){
    var currentPosition = parseInt($(".float").css("top"));
    $(window).scroll(function() {
        var position = $(window).scrollTop(); // 현재 스크롤바의 위치값을 반환합니다.
        if(position&gt;600){
        	if($.browser.msie && $.browser.version &lt; 7){
        		$(".float").stop().animate({"top":position+currentPosition-600+"px"},1000);
        	}else{
        		$(".float").css({'position':'fixed', 'top':'20px'});
        	}
        }else{
        	$('.float').attr('style','');
        }
    });
});</pre>

위 코드는 어느 정도까지는 `fixed`돼 있지 않다가 스크롤을 좀 내리면 `fixed` 시키는 코드다. 이를 위해서 꼭 알아야 할 매서드는 <a href="http://api.jquery.com/scrollTop/" target="_blank"><code>scrollTop()</code></a> 이다. jQuery의 매서드다.

`$(window).scrollTop()` : 현재 스크롤바의 위치를 반환한다. 정수값을 반환하게 된다.

`$(window).scroll(function(){ /*함수 구현부*/ })` : 이 코드는 웹브라우저가 스크롤될 때 실행할 함수를 써 주는 부분이다. 위에서 보면 알겠지만 모든 함수 구현부가 바로 이 안에 인수로 들어가 있다.

`function(){/*함수 구현부*/}` 형식의 인수는 익명함수라고 한다. 특별한 함수 이름 없이 즉각 함수를 인자값처럼 넘길 수 있는 방식이다. 자바스크립트의 특징이라고 알고 있다.

위 코드가 jQuery쪽 코드고, HTML 쪽에는

<pre class="brush:html">&lt;div class="float"&gt;나는 떠다니는 레이어&lt;/div&gt;</pre>

이런 놈을 넣어 주면 되겠다.

msie 버전 6 이하에서는 `position: fixed`를 사용할 수 없기 때문에 jQuery의 `animate` 매서드를 이용해서 처리한다. 1000이라고 써 있는 부분은 동작이 일어나는 시간이다. 1000이 1초다. 이 시간을 늘리면 느리게 움직이고, 줄이면 빠르게 움직이다. 0으로 하면 순간이동을 하는데, 좋지가 않다.

`position`이 600보다 작을 때는 `$('.float').attr('style','')` 이라고 코드를 써 놨는데, 요소 스타일을 제거해 버리는 코드다. 그러면 jQuery를 이용해 임의로 매긴 스타일이 모두 사라진다. 단, 이를 위해서는 기본 스타일은 모두 css 파일에 담아 두어야 한다. 그렇지 않으면 기본 스타일로 박아 놓은 것도 함께 날아갈 테니 말이다.

시간이 없어서 친절한 설명을 하지 못해 아쉽다. 하지만 코드를 잘 분석하면 충분히 이해할 수 있을 거라 생각한다.