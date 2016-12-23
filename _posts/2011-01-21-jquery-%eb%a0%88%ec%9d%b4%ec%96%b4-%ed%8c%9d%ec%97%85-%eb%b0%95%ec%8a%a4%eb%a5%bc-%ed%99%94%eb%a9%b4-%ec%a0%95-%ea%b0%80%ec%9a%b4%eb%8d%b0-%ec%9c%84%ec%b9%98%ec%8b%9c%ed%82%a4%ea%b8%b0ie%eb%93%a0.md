---
title: '[jQuery] 레이어 팝업 박스를 화면 정 가운데 위치시키기(ie든 파폭이든 크롬이든 다 되는 거)'
author: 안형우
layout: post
permalink: /archives/812
aktt_notify_twitter:
  - yes
daumview_id:
  - 36769270
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
레이어 팝업을 불러온 후 자바스크립트로 박스의 css를 아래처럼 해 준다. 물론 박스의 position 값은 absolute일 것이다. 레이어팝업의 width와 height는 미리 css에 정의해 두는 게 좋다. 아래 코드를 그대로 사용하려면 반드시 정의해 둬야 한다.

<div style="width: 560px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile23.uf.174DD24F4D4BC96E2AA333.png" alt="" width="550" height="363" /><p class="wp-caption-text">
    △정보를 띄워 줄 때 위처럼 화면 한 가운데 레이어 팝업을 띄우는 경우가 있다.
  </p>
</div>

<pre class="brush: javascript; gutter: true; first-line: 1">var $layerPopupObj = $(&#039;.layerPopupBox&#039;);
var left = ( $(window).scrollLeft() + ($(window).width() - $layerPopupObj.width()) / 2 );
var top = ( $(window).scrollTop() + ($(window).height() - $layerPopupObj.height()) / 2 );
$layerPopupObj.css({&#039;left&#039;:left,&#039;top&#039;:top, &#039;position&#039;:&#039;absolute&#039;});
$(&#039;body&#039;).css(&#039;position&#039;,&#039;relative&#039;).append($layerPopupObj);</pre>

<a title="[http://api.jquery.com/scrollTop/]로 이동합니다." href="http://api.jquery.com/scrollTop/" target="_blank">jQuery의 .scrollLeft() 함수</a>는 좌우로 스크롤된 화면이 왼쪽부터 몇 px인지 구하는 함수다. 보통은 0일 거다.

<a title="[http://api.jquery.com/scrollTop/]로 이동합니다." href="http://api.jquery.com/scrollTop/" target="_blank">jQuery의 .scrollTop() 함수</a>는 스크롤된 화면이 맨 위에서부터 몇 px인지 구하는 함수다.

<a title="[http://api.jquery.com/width/]로 이동합니다." href="http://api.jquery.com/width/" target="_blank">jQuery의 .width() 함수</a>는 너비를 구하는 함수인데, $(window).width() 를 하면 현재 화면의 너비를 구한다. 윈도우를 전체화면으로 하지 말고 사이즈를 줄여 놓고 값을 구해 보면 전체 가로 사이즈보다 작게 나오는 것을 알 수 있다.

<a title="[http://api.jquery.com/height/]로 이동합니다." href="http://api.jquery.com/height/" target="_blank">jQuery의 .height() 함수</a> 역시 마찬가지인데, $(window).height() 라고 하면 윈도우에서 메뉴바 같은 것들을 빼고 실제 사용되는 부분의 높이만 구해 준다. 나는 높이 800px 화면의 노트북을 사용한데, 실제 사용되는 영역은 675px이었다.

그리고 수학식은 굳이 설명할 필요 없을 거라 생각한다.