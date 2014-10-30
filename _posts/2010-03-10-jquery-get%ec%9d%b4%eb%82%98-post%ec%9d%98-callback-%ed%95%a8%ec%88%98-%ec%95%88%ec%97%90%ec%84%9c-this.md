---
title: jquery $.get이나 $.post의 callback 함수 안에서 this
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/383
aktt_notify_twitter:
  - yes
daumview_id:
  - 37012496
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
아래 같은 코드였다.

<pre class="brush:js">$(&#039;button.delete&#039;).click(function(){
  $.get(&#039;url&#039;,{a:1,b:2}, function(data){
    $(this).parent().remove(); //문제는 바로 여기
  });
});
</pre>

내가 의도했던 것은 버튼의 부모 객체를 날리는 것이었다. 삭제 버튼이었으므로 말이다. 그런데 안 날아가는 것 ㅠ.ㅠ

한참 헤매다가 파이어버그의 js 디버그 기능을 이용해서 $(this).parent().remove(); 코드가 있는 줄에서 스크립트를 멈추고 객체들을 확인했다.

대충격. this는 ajax에서 사용하는 객체였다. xhr이 그 안에 있는 것으로 보아 xhr은 아닌 것 같고. 아래 그림을 보면 this의 정체를 확인할 수 있다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile23.uf.160C66494D4BC8A4261149.png" class="aligncenter" width="567" height="444" alt="" />

그래서 해결한 방법은, $.get 이 나오기 전에 $(this).parent()를 var widget에 집어넣고 활용했다.

변수를 적게 사용하는 게 능사는 아닌 듯.