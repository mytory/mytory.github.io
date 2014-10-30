---
title: '[jQuery] 플러그인 만들기 (1)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/661
aktt_notify_twitter:
  - yes
daumview_id:
  - 36870114
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
아래 구현을 참고하면 도움이 될 거다.<PRE class=brush:html><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

  
<script type="text/javascript">  
$(function(){  
//플러그인 구현부  
$.fn.alertThisText = function(){  
alert(this.text());  
}

//플러그인 테스트  
$('.alertThisText').click(function(){  
$('.test').alertThisText();  
});

});  
</script>  
<style>  
.test{ width: 200px; height: 200px; text-align: center; padding-top: 50px; background: #eee;}  
</style>  
<div class="test">  
abcdefg  
</div>  
<input type="button" class="alertThisText" value="test"/>  
</PRE>  
&nbsp;

  
코드는 간단하다. $.fn.플러그인함수이름 = function(){} 형식이다. 파라미터를 받도록 할 셈이면 아래처럼 쓴다.<PRE class=brush:js>$.fn.플러그인함수이름 = function(파라미터){

  
//구현부. this는 함수를 호출한 jQuery객체가 된다.  
}  
</PRE>  
참 쉽다.