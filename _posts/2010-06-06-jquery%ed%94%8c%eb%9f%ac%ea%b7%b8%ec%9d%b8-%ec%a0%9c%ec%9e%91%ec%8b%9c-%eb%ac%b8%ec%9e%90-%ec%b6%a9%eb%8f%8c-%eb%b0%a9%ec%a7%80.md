---
title: '[jQuery]플러그인 제작시 $문자 충돌 방지'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/650
aktt_notify_twitter:
  - yes
daumview_id:
  - 36880910
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
흐음. 그냥 다른 프레임워크랑 쓸 때 충돌 방지하는 것은 간단하다.

<pre class="brush:js">jQuery(function(){
  var $ = jQuery;
  //그리고 여기 코드
});
</pre>

걍 이래 버리면 된다. 물론 책에서는 다른 방법을 소개하던데, 나는 저 방법이 젤 편하다. 외우기 쉽다.

그리고 지금 소개하는 건, 플러그인 제작시 쓰라는 건지, 일반적으로 쓸 수 있는 것인지는 잘 모르겠는데 여튼 갈무리해 둔다. 책에는 플러그인 제작시 사용하는 코드라고 소개돼 있다. 무슨 책이냐면, 《jQuery1.3 &#8211; 작고 강력한 자바스크립트 라이브러리》다. 383p에 있다.

뜸을 많이 들였다. 코드는 아래와 같다.

<pre class="brush:js">(function($) {
  // 여기 코드를 쓴다.
})(jQuery);
</pre>

뭐, 대충 맞겠다. 나중에 플러그인 만들 때 참고해야겠다.