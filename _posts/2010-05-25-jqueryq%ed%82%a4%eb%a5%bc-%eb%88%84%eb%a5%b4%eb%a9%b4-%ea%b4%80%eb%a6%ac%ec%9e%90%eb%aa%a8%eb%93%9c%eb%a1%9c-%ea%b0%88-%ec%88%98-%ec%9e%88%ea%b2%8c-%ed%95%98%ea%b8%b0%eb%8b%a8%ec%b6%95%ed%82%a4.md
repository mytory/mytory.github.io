---
title: '[jQuery]Q키를 누르면 관리자모드로 갈 수 있게 하기(단축키 이용 이동 자바스크립트)'
author: 안형우
layout: post
permalink: /archives/616
aktt_notify_twitter:
  - yes
daumview_id:
  - 36916022
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
이건 뭐 그냥 코드 모음이라 할 수 있다. 코드를 일단 써놓고, 설명을 간단하게 붙이겠다.

일단 코드.(처음 코드엔 오류가 좀 있었다. 아래 코드는 익스6, 파폭3.6, 크롬4에서 모두 테스트를 마친 코드다.)

<pre class="brush:js">var master_shortcut = &#039;/admin&#039;;
var current_href = location.href;

$(document).keyup(function (e) {
	var Qkey = 81;    
	if(e.keyCode == Qkey){                
		if($.browser.msie){            
			var nodeName = e.srcElement.tagName;        
		}else{
			var nodeName = e.target.nodeName;
		}        
		nodeName = nodeName.toLowerCase();            
		if(nodeName == &#039;input&#039; || nodeName == &#039;textarea&#039;){            
			//현재 위치가 input이나 textarea라면 작동하지 않게.        
		}else{            
			//alert(master_shortcut+&#039;?backlink=&#039;+current_href);            
			location.href=master_shortcut+&#039;?backlink=&#039;+current_href;        
		} 
	}
});</pre>

## input과 textarea에서 단축키 작동 막기

여기서 중요해 보이는 건, input과 textarea에서는 이 단축키가 작동하지 않게 만드는 거다.

그러면 현재 포커스가 가 있는 객체의 태그 이름을 알아내야 한다.

이게 나를 좀 헤매게 했다. ie와 타 브라우저들이 이놈을 알아내는 데 서로 다른 변수를 사용하기 때문이다.(아마 ie가 표준을 안 지킨 거겠지!)

일단 ie는 이렇다.

<pre class="brush:js">event.srcElement.tagName</pre>

그리고 다른 브라우저들은 이렇다.

<pre class="brush:js">event.target.nodeName</pre>

그래서 위 코드에 보면 알겠지만, if($.browser.msie)라서 써서 익스플로러일 때만 변수를 다르게 넣도록 만들었다.

<a href="http://api.jquery.com/jQuery.browser/" target="_blank">$.browser.msie</a>는 jQuery에서 브라우저가 마이크로소프트 인터넷 익스플로러인지 알려주는 함수다. 익스플로러라면 true를 반환한다. 만약 <a href="http://jquery.com/" target="_blank">jQuery</a>를 사용하지 않고 단축키를 제대로 사용하고 싶다면 <a href="http://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=qna_html&wr_id=166666&page=18" target="_blank">PHP School의 이 글</a>을 보면 된다. BiHon의 댓글을 보면 해답이 있다.

## backlink를 함께 보내기

로그인한 다음 관리자모드로 바로 보내버릴 거라면 모르겠지만, Q 버튼을 누를 때 있던 바로 그 페이지로 다시 돌아오게 만들려면 현재 페이지 정보를 저장해 놓은 채 로그인화면으로 보내야 할 거다.

그러기 위해서 backlink라는 변수에 location.href를 저장했다. location.href에는 현재 페이지의 주소가 담겨있다. 이건 모든 브라우저 공통이다.

그래서 나는 location.href를 GET방식으로 backlink란 변수에 담아서 로그인페이지로 보낸 것이다.

이 backlink를 활용하는 것은 로그인 페이지에서 프로그래밍적으로 처리를 해야 할 거다.

아마 보통은, 로그인 페이지에서 hidden input에 이놈을 담은 다음, 로그인 정보와 함께 login_action으로 보내야 할 거다. 로그인에 ajax를 사용한다면 그럴 필요는 없을 것이고.

## nodeName을 소문자로 만들기

이건 꼭 필요한 일은 아닐 텐데, 혹시 몰라서 조치를 해 둔 것이다.

브라우저에 따라 태그이름을 대문자로 돌려주는 경우도 있도, 소문자로 돌려주는 경우도 있을 것이다. 소문자로 돌려주든 대문자로 돌려주든 잘 대응할 수 있게 하기 위해서 그냥 돌려받은 이름을 <a href="http://www.w3schools.com/jsref/jsref_tolowercase.asp" target="_blank">toLowerCase()</a> 함수를 이용해서 죄다 소문자로 만들어버린 후 if문으로 비교를 했다.

## 키보드 번호 알아내기

Q키의 번호는 81이다. Q키가 아닌 다른 놈을 사용하고 싶은 경우도 당연히 있을 거다. 이런 경우 내 블로그의 <a href="http://mytory.textcube.com/entry/eventkeyCode-%EB%AA%A9%EB%A1%9D" target="_blank">키보드 번호 알아내기 글</a>을 참고하면 도움이 될 거다. 이 글에서는 키보드를 누르면 번호를 돌려주니까 훨씬 빠르게 찾을 수 있다.