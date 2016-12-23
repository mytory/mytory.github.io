---
title: '[jQuery] input에 숫자만 입력받기'
author: 안형우
layout: post
permalink: /archives/697
aktt_notify_twitter:
  - yes
daumview_id:
  - 36857092
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
**[알림] jQuery 플러그인도 있더라. [iMask라는 놈][1]이다. (2011-08-19 추가)**

정확히 아래 코드를 복사해서 사용하면 된다. 이건 뭐, 열라 헤매다가 이 코드를 만나니 허무해 진다.

단, 주의할 점이 있다. 한글은 입력이 된다 ㅡㅡ;; 그래서 내 경우 <a href="http://mytory.net/archives/763" target="_blank">isNaN 함수</a>로 최종 검사를 한 번 더 수행해 줬다.

<pre class="brush:js">&lt;script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;
$(function(){
$('.quantity').keypress(function(event){
  //alert(event.which);
  if (event.which && (event.which  &gt; 47 && event.which  &lt; 58 || event.which == 8)) {
    //alert('숫자임!');
  } else {
    //alert('숫자아님!');
    event.preventDefault();
  }
});
});
&lt;/script&gt;
&lt;div class="quantity"&gt;
  &lt;input type="text"/&gt;
&lt;/div&gt;</pre>

일단 keyup 이벤트 핸들러를 사용하면 안 된다. 왜냐면, keyup이 호출될 시점이면 이미 숫자 아닌 다른 글자가 입력된 상태기 때문이다.

그니깐, key 관련 이벤트는 아래처럼 된다.

**keypress 혹은 keydown → 키의 기능 실행(엔터면 엔터, 숫자입력이면 숫자입력 등) → keyup**

(<a href="http://celdee.tistory.com/185" target="_blank">keypress, keydown, keyup 의 차이</a>를 알고 싶은 사람들은 <a href="http://celdee.tistory.com/185" target="_blank">여기에 들어가 보면 된다.</a>)

그러니 keyup으로 호출하면 이미 늦은 것이다. 그래서 keypress가 딱 들어오면 이놈이 숫자키냐 아니냐를 판단해야 한다.

<a href="http://mytory.textcube.com/entry/eventkeyCode-%EB%AA%A9%EB%A1%9D" target="_blank">숫자키는 48번부터 57번</a>이다. 그 사이인 놈들이 눌렸으면 그냥 지나간다. 그리고 8번은 백스페이스다. 숫자를 지울 수는 있게 해야 한다.

keypress 이벤트의 경우 event.keyCode로 키값을 알아내는 게 아니라 event.charCode 혹은 event.which로 알아내야 한다. 이 코드에서는 event.which를 사용했다.

그리고 event.which는 글자 입력에만 적용되는 놈이라고 한다. 즉, 엔터나 탭은 자유롭게 사용할 수 있다.

또한 event.preventDefault() 도 재밌는 함수도. 이 함수는 함수 이름 그대로 &#8216;기본을 막는다&#8217;. 키가 눌렸을 때의 기본 기능은 키에 해당하는 글자를 입력하는 것이다. 그런데 숫자가 아닌 경우에는 preventDefault 함수가 호출됐다. 그러면 기본 기능이 막힌다. 즉, 키 입력이 안 되는 것이다.

링크를 click했을 때 이 놈을 호출하면 링크 이동을 막는다. 문자든 숫자든 입력하는 키를 눌렀을 때 이놈을 호출하면 입력을 막아버린다. 폼에서 엔터를 눌렀을 때 이놈을 호출하면 submit을 안 할 것이다. 여튼 그런 놈이다.

그럼 해설 끝!

 [1]: https://github.com/cwolves/jQuery-iMask