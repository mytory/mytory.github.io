---
title: jQuery 슬라이드 뷰어 혹은 슬라이드 쇼(사진 갤러리)
author: 안형우
layout: post
permalink: /archives/112
aktt_notify_twitter:
  - yes
daumview_id:
  - 37216145
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
(슬라이드 관련 링크들은 <a title="[링크] jQuery 이미지 슬라이드 갤러리/뷰어 모음" rel="bookmark" href="http://mytory.net/archives/410">[링크] jQuery 이미지 슬라이드 갤러리/뷰어 모음</a> 으로 모으고 있다. 거기 가면 유용한 정보를 좀더 얻을 수 있을 거다. 이 글에 나와 있는 내용과 겹치지는 않기 때문에 이 글도 보면 유용하기는 할 거다.)

링크 보고 소스 보면 아주 직관적이기 때문에 바로 알 수 있을 것이다.

<http://www.gcmingati.net/wordpress/wp-content/lab/jquery/imagestrip/imageslide-plugin.html>

## 커스터마이징

나는 이 소스를 바탕으로 슬라이드 팝업을 만들었다.

요구사항 중, 번호를 클릭하면 슬라이드되는 게 아니라 마우스만 올려놓으면 슬라이드되게 해 달라는 게 있었다. 라이브러리를 뜯어서 고쳐야 하나 고민하다가 다음 코드로 해결했다.

<pre class="brush:js">$(&#039;.stripTransmitter li a&#039;).mouseover(function(){
	$(this).click();
});</pre>

IE에서는 그림 일부가 잘린다. 웹표준에 맞지 않는 MS 익스플로러의 박스 모델 때문이고, 가장 구체적으로는 border 때문이다. 따라서 아래 코드를 삽입해 줘야 IE에서 그림이 잘리지 않는다.

<pre class="brush:js">//IE에서 width height 조정
if($.browser.msie){
	var w = $(&#039;#slide_popup&#039;).css(&#039;width&#039;);
	var h = $(&#039;#slide_popup&#039;).css(&#039;height&#039;);
	$(&#039;#slide_popup&#039;).css({
		&#039;width&#039;: parseFloat(w)+10+&#039;px&#039;,
		&#039;height&#039;: parseFloat(h)+10+&#039;px&#039;
	});
}</pre>