---
title: '[jQuery] 플러그인 만들기 (2) 기본값 설정'
author: 안형우
layout: post
permalink: /archives/662
aktt_notify_twitter:
  - yes
daumview_id:
  - 36869809
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
플러그인을 만들 때 파라미터를 맵 형태(혹은 객체 형태)로 받으면 제어하기 편하다.

  
일단 파라미터가 각각 뭘 의미하는지 헷갈리지 않아도 된다. 맵 형태는 key값이 있기 때문이다.(혹은 레이블이라고도 말하더라.) 또한, 파라미터 순서 때문에 골치아플 일도 없다.

  
자, 한 번 해 보자.<PRE class=brush:html><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

  
<script type="text/javascript">  
$(function(){  
jQuery.fn.customFn = function(opt){  
return this.each(function(){  
$(this).css({  
position : opt.position,  
zIndex: opt.zIndex,  
opacity: opt.opacity  
});  
});  
}

var option = {  
position : 'relative',  
zIndex : 0,  
opacity: 0.5  
};

$('.test').click(function(){  
$('#log').customFn(option);  
});  
});  
</script>  
<style>  
#log{  
background: black;  
color: white;  
position: absolute;  
left: 20px;  
top: 100px;  
padding: 20px;  
}  
</style>  
<div id="log">  
wow!!!  
</div>  
<input type="button" class="test" value="test"/>  
</PRE>  
이번에는 기본값을 만들어 보자. 기본값 역시 객체 형태로 function 안에 넣는다. 만약 기본값을 변경하기 쉽게 할 생각이라면 function 밖으로 빼도 무방할 것이다.

<pre class="brush:html">&lt;script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;
$(function(){
	jQuery.fn.customFn = function(opt){
	  return this.each(function(){
	    $(this).css({
	      position : opt.position,
	      zIndex: opt.zIndex,
	      opacity: opt.opacity
	    });
	  });
	}

	var default = {
		postion : &#039;relative&#039;,
		zIndex: 2,
		opacity: 0.1
	};

	var option = {
		position : &#039;relative&#039;,
		zIndex : 0,
		opacity: 0.5
	};

	var opt = $.extend(default, option);

	$(&#039;.test&#039;).click(function(){
		$(&#039;#log&#039;).customFn(option);
	});
});
&lt;/script&gt;
&lt;style&gt;
#log{
	background: black;
	color: white;
	position: absolute;
	left: 20px;
	top: 100px;
	padding: 20px;
}
&lt;/style&gt;
&lt;div id="log"&gt;
	wow!!!
&lt;/div&gt;
&lt;input type="button" class="test" value="test"/&gt;
</pre>

이상이다.