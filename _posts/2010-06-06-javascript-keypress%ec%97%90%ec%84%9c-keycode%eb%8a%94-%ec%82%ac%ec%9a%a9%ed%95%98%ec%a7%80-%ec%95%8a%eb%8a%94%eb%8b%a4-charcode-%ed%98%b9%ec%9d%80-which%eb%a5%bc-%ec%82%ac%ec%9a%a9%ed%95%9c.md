---
title: '[javascript] keypress에서 keyCode는 사용하지 않는다. charCode 혹은 which를 사용한다.'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/658
aktt_notify_twitter:
  - yes
daumview_id:
  - 36871779
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
예컨대 영문 키들은 그냥 키코드가 0으로 나온다. 즉, 설정돼 있지 않은 거다. <div>
  keypress를 사용한다면, event.charCode나 event.which 를 사용해야 한다.
</div>

<div>
  keypress는 입력 자체를 막아야 할 때 사용한다. keyup으로 입력을 검사한다면 이미 입력된 후일 테니까 말이다.<br />아래 코드를 긁어서 테스트해 보면 될 거다. 숫자가 아니면 입력을 막는 코드다.
</div>

<pre class="brush:html">&lt;script src="scripts/jquery.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;
$(function(){
	$(&#039;.quantity input&#039;).keypress(function(event) {
	alert(event.charCode);
	  if (event.which && (event.which &lt; 48 || event.which &gt; 57)) {
		event.preventDefault();
	  }
	})
});
&lt;/script&gt;

&lt;div class="quantity"&gt;
  &lt;input type="text"/&gt;
&lt;/div&gt;
</pre>