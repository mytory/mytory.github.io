---
title: '[jQuery]레이어 팝업(modal window) 띄울 때 전체를 덮는 반투명 검은 막(black mask) 만들기'
author: 안형우
layout: post
permalink: /archives/783
aktt_notify_twitter:
  - yes
daumview_id:
  - 36793579
mytory_md_path:
  -
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
**들어가기 전에 : 이 글과 함께 [레이어 팝업을 화면 정 가운데 위치시키는 방법][1], [이미지가 늦게 로딩되어 정 가운데 위치 계산이 틀리는 것을 방지하는 방법][2]을 보면 좋다.**

항상 궁금했다. modal box를 띄우는 방법은 궁금하지 않았다. 뒷면을 다 덮는 검은 반투명 막을 어떻게 만드는지가 궁금했다.

답은 간단했다. <a href="http://www.queness.com/post/77/simple-jquery-modal-window-tutorial" target="_blank">jQuery modal window를 만드는 튜토리얼</a>에서 그 방법을 발견했다. 우리가 해왔던 방식하고 크게 다르지 않았다. 이것만 가지고 플러그인을 만들어 볼까 하는 생각도 들었다.

자, 반투명 검은 막을 만드는 방법은 간단하다.(예제부터 보길 바라면 아래 파일을 사용하면 된다.)

*   [반투명 검은 막 데모 1 &#8211; 검은 막을 클릭하거나 터치하면 꺼진다.][3]
*   [반투명 검은 막 데모 2 &#8211; 검은 막을 클릭하면 꺼지지만, 터치하면 안 꺼진다.][4]

일단, HTML의 어딘가에 아래 코드를 끼워 넣는다. 어디든 별 상관 없지만 찾기 편한 곳에 둬야 할 거다.

<pre class="brush:html">&lt;div id="mask"&gt;&lt;/div&gt;</pre>

다음은 CSS인데 아래처럼 해 준다.

<pre class="brush:css">#mask {  
  position:absolute;  
  left:0;
  top:0;
  z-index:9000;  
  background-color:#000;  
  display:none;  
}</pre>

마지막으로 jQuery 코드를 짜 보자.

<pre class="brush:js">function wrapWindowByMask(){
        //화면의 높이와 너비를 구한다.
        var maskHeight = $(document).height();  
        var maskWidth = $(window).width();  

        //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
        $('#mask').css({'width':maskWidth,'height':maskHeight});  

        //애니메이션 효과
        $('#mask').fadeIn(1000);      
        $('#mask').fadeTo("slow",0.8);    
}</pre>

자, 위 함수를 사용하면 반투명의 검은 마스크가 나타날 것이다. 그럼 어떻게 닫을까?

두 가지가 있을 것이다.

1.  modal window의 닫기 버튼을 눌렀을 때
2.  반투명 검은 막을 눌렀을 때

두 경우 모두를 지원하기 위해서 click할 때 일어나는 이벤트를 두 군데 걸어야겠다.

이건 원본에서 그냥 긁어 온 코드다. `.window`는 검은 막 위에 뜬 modal window다.

<pre class="brush:js">//닫기 버튼을 눌렀을 때
$('.window .close').click(function (e) {  
    //링크 기본동작은 작동하지 않도록 한다.
    e.preventDefault();  
    $('#mask, .window').hide();  
});       

//검은 막을 눌렀을 때
$('#mask').click(function () {  
    $(this).hide();  
    $('.window').hide();  
});</pre>

위 코드들은 당연히 `jQuery(document).ready(function(){ /\*코드 넣는 부분\*/ })` 으로 감싸 줘야 한다.

완성된 코드는 아래와 같다. (주의! DTD 선언을 하지 않으면 IE에서 깨진다! 아마 쿽스모드로 렌더링하기 때문일 것이다.)

<pre class="brush:js; html-script: true">&lt;!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"&gt;
&lt;html&gt;
&lt;head&gt;
	&lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8"&gt;
	&lt;style&gt;
	#mask {  
	  position:absolute;  
	  z-index:9000;  
	  background-color:#000;  
	  display:none;  
	  left:0;
	  top:0;
	}
	.window{
	  display: none;
	  position:absolute;  
	  left:100px;
	  top:100px;
	  z-index:10000;
	}
	&lt;/style&gt;
	&lt;script src="https://code.jquery.com/jquery-latest.js"&gt;&lt;/script&gt; 
	&lt;script&gt;
	function wrapWindowByMask(){
		//화면의 높이와 너비를 구한다.
		var maskHeight = $(document).height();  
		var maskWidth = $(window).width();  

		//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
		$('#mask').css({'width':maskWidth,'height':maskHeight});  

		//애니메이션 효과 - 일단 1초동안 까맣게 됐다가 80% 불투명도로 간다.
		$('#mask').fadeIn(1000);      
		$('#mask').fadeTo("slow",0.8);    

		//윈도우 같은 거 띄운다.
		$('.window').show();
	}

	$(document).ready(function(){
		//검은 막 띄우기
		$('.openMask').click(function(e){
			e.preventDefault();
			wrapWindowByMask();
		});

		//닫기 버튼을 눌렀을 때
		$('.window .close').click(function (e) {  
		    //링크 기본동작은 작동하지 않도록 한다.
		    e.preventDefault();  
		    $('#mask, .window').hide();  
		});       

		//검은 막을 눌렀을 때
		$('#mask').click(function () {  
		    $(this).hide();  
		    $('.window').hide();  
		});      
	});
	&lt;/script&gt;
&lt;/head&gt;
&lt;body&gt;
	&lt;div id="mask"&gt;&lt;/div&gt;
	&lt;div class="window"&gt;
		&lt;input type="button" href="#" class="close" value="나는야 닫기 버튼(.window .close)"/&gt;
	&lt;/div&gt;
	&lt;a href="#" class="openMask"&gt;검은 막 띄우기&lt;/a&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>

반투명 검은 막 위로 박스를 띄울 때 박스를 스크롤과 상관없이 화면의 정 중앙에 오도록 하고 싶다면 &#8216;[[jQuery] 레이어 팝업 박스를 화면 정 가운데 위치시키기(ie든 파폭이든 크롬이든 다 되는 거)][1]&#8216;를 참고하면 된다.

## 터치 이벤트(2013-05-31 추가) 처리

터치가 가능한 기기에서 실수로 검은 막을 터치해 레이어를 닫는 경우가 생긴다는 지적이 있었다. 그러나 화면을 움직이거나 확대 축소하면 레이어가 닫히지 않는다. 정확히 터치를 해야 닫힌다. 따라서 혼동을 주지 않을 거라고 나는 생각한다.

그러나 사이트 기획자 입장에서는 선택할 수 있는 옵션이 있는 게 좋을 것이다. 만약 검은 막을 터치하는 경우에는 닫고 싶지 않다면 자바스크립트에 아래 코드를 추가하면 된다. (당연히 `$(document).ready(function(){ ... })` 안에.) &#8216;`touchstart`&#8216; 이벤트를 사용했다.

<pre>// 터치 스크린에서 실수로 레이어를 닫는 경우를 막으려면.
$('#mask').one('touchstart', function () {  
    $(this).unbind('click');
    alert('터치 이벤트일 때는 아무 일도 안 일어난다.');
});</pre>

`one()`은 이벤트에 따른 함수를 한 번만 실행하고 해당 이벤트를 unbind하는 함수다.

 [1]: https://mytory.net/archives/812 "[jQuery] 레이어 팝업 박스를 화면 정 가운데 위치시키기(ie든 파폭이든 크롬이든 다 되는 거)"
 [2]: https://mytory.net/archives/1174 "[jQuery] 레이어 팝업으로 이미지를 띄울 때 이미지가 다 불러진 다음 이미지 사이즈를 계산해서 화면 정 중앙에 오게 하기"
 [3]: https://mytory.net/uploads/code/black-cover.html
 [4]: https://mytory.net/uploads/code/black-cover2.html
