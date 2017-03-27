---
title: '[jQuery] ajax 통신 결과를 받아서 그 다음 작업 수행하기'
author: 안형우
layout: post
permalink: /archives/9807
daumview_id:
  - 42155450
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
[jqXHR &#8211; jQuery.ajax() | jQuery API Documentation][1].

새로 알게 됐다. `jQuery.ajax()`, `jQuery.get()`, `jQuery.post()` 메서드는 `jqXHR`이라는 객체를 리턴하며, 아래처럼 코드를 작성할 수 있다고 한다. 아래는 jQuery 공식 문서에 나오는 예제 코드다. 번역을 붙였는데 자신이 없어서 원문을 병기했다.

<pre>// 요청을 생성한 즉시 핸들러를 할당한다. (Assign handlers immediately after making the request,)
// 그리고 이 요청에 대한 jqxhr 객체를 기억한다. (and remember the jqxhr object for this request)
var jqxhr = $.ajax( "example.php" )
.done(function() { alert("success"); })
.fail(function() { alert("error"); })
.always(function() { alert("complete"); });
// 여기서 다른 작업을 한다. (perform other work here ...)
// 위의 요청이 성공했을 때 작업할 또다른 함수를 세팅한다. (Set another completion function for the request above)
jqxhr.always(function() { alert("second complete"); });</pre>

위와 같은 방식의 코드는 jQuery 1.8 이상부터 사용할 수 있다. 그 이전 버전에는 다른 방식으로 사용할 수 있는 것 같으니 실망하지 말고 문서를 확인해 보기 바란다.

근데 나도 실사용을 해 본 건 아니라서 내가 생각하는대로 작동할 지는 사용을 해 봐야 알 것 같다.

 [1]: http://api.jquery.com/jQuery.ajax/#jqXHR