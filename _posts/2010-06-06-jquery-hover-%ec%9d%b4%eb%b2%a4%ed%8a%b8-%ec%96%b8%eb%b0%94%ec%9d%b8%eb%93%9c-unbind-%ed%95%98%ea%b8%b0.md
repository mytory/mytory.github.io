---
title: '[jQuery] hover 이벤트 언바인드 unbind 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/660
aktt_notify_twitter:
  - yes
daumview_id:
  - 36870549
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
`jQuery`에서 <a href="http://api.jquery.com/hover/" target="_blank"><code>hover</code> 이벤트(혹은 함수)</a>는 꽤 유용하다. 인자값을 funtion 두 개 받는데, 마우스를 올리면 앞의 것이, 마우스를 빼면 뒤의 것이 실행된다. 말 그대로 `hover` 효과를 내는 것이다.

그러나 이걸 `unbind`할 때는 골치가 아프다. `$(obj).unbind('hover')` 라고 써도 작동하지 않는다. 이 때는

<pre class="brush:js">$(obj).unbind(&#039;mouseenter mouseleave&#039;);</pre>

라고 써야 작동한다. 아래는 이를 바탕으로 구성한 예제다. 긁어서 html 만들고 브라우저에서 열면 작동할 거다.

<pre class="brush: xml; gutter: true; first-line: 1">&lt;script src="scripts/jquery.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;
$(document).ready(function(){
  $(&#039;.test&#039;).hover(function(){
    $(this).css(&#039;background&#039;,&#039;yellow&#039;);
  }, function(){
    $(this).css(&#039;background&#039;,&#039;gray&#039;);
  });
  $(&#039;.unbind_hover&#039;).click(function(){
    $(&#039;.test&#039;).unbind(&#039;hover&#039;);
  });
  $(&#039;.unbind_mouse&#039;).click(function(){
    $(&#039;.test&#039;).unbind(&#039;mouseenter mouseleave&#039;);
  });
});
&lt;/script&gt;
&lt;style&gt;
.test{
  width: 200px;
  height: 200px;
  background: gray;
}
&lt;/style&gt;
&lt;div class="test"&gt;

&lt;/div&gt;
&lt;input type="button" class="unbind_hover" value="unbind hover!"/&gt;
&lt;input type="button" class="unbind_mouse" value="unbind mouse!"/&gt;</pre>