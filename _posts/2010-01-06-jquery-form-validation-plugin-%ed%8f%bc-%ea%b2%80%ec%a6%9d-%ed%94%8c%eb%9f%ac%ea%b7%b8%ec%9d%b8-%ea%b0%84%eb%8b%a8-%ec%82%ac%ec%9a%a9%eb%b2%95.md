---
title: jQuery Form Validation Plugin 폼 검증 플러그인 간단 사용법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/195
aktt_notify_twitter:
  - yes
daumview_id:
  - 37159427
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
[2013-09-27 추가 : 최근에 새로 발견한 폼 검증 플러그인으로 [Parsley.js][1]가 있는데, 이게 더 좋아 보인다. 문서도 잘 돼 있다. 단, IE6를 지원하지 않는다. 따라서 한국에서는 당분간 쓰기 힘들 것 같다. 아니면, 서버단 밸리데이션을 반드시 하면서 js를 보조적으로만 활용할 때 Parsley.js를 사용하면 되겠다. (사실 당연한 이야기긴 하지만 말이다.)]

<a href="http://jqueryvalidation.org/" target="_blank">jQuery의 validation(검증) 플러그인</a>이다. 일단 데모 페이지부터 보면 어떤 건지 알 수 있을 것이다.

<a href="http://jquery.bassistance.de/validate/demo/" target="_blank">validation 플러그인 데모 페이지</a>

사용법은 사실 데모 페이지 긁어와서 이름만 고치는 정도로도 알 수 있을 텐데, 몇 가지 써 보자.

몊 가지 방법으로 사용할 수 있다. 첫 번째는 심플한 방법이다.

## 첫 번째 방법

이 방법은 위 데모 페이지에서 위쪽에 있는 예시에 사용된 방법이다.

<div style="width: 554px" class="wp-caption aligncenter">
  <img alt="" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile25.uf.134E474C4D4BC87D299B56.png" width="544" height="330" /><p class="wp-caption-text">
    △이 첫 번째 방법은 javascript 코드가 간단하다는 장점이 있는 반면, 메시지가 영어로 나오고, html 코드에 들어갈 게 많아진다는 단점이 있다. 비표준 어트리뷰트가 사용된다는 점도 단점이다.
  </p>
</div>

<pre class="brush:js">$(function(){
  // submit 시켰을 때 #form을 검증합니다.
  $("#form").validate();
});</pre>

javascript 코드에는 위와 같이 쓰고(물론 jquery.js를 위 코드 전에 호출해야 하는 건 당연하다.) html에는 이렇게 적는 것이다.

<pre class="brush:html">&lt;form id="form" method="get" action=""&gt;
  &lt;fieldset&gt;
    &lt;legend&gt;잘 적어 주세요&lt;/legend&gt;
    &lt;p&gt;
      &lt;label for="cname"&gt;이름 (필수, 최소 2글자)&lt;/label&gt;
      &lt;input id="cname" name="name" class="required" minlength="2" /&gt;
    &lt;p&gt;
      &lt;label for="cemail"&gt;E-Mail (필수)&lt;/label&gt;
      &lt;input id="cemail" name="email" class="required email" /&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;label for="curl"&gt;URL (선택)&lt;/label&gt;
      &lt;input id="curl" name="url" class="url" value="" /&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;label for="ccomment"&gt;남기실 말씀 (필수)&lt;/label&gt;
      &lt;textarea id="ccomment" name="comment" class="required"&gt;&lt;/textarea&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;input class="submit" type="submit" value="Submit"/&gt;
    &lt;/p&gt;
  &lt;/fieldset&gt;
&lt;/form&gt;</pre>

위 코드에서 볼 수 있는 것처럼, html코드에 적어 주면 된다. 정리하면 다음과 같다.

*   필수요소인 경우 `required="required"` 라고 쓴다. (`required`만 써도 된다.) 이것은 HTML5 문법이다. 그런데 이 플러그인이 알아서 처리한다. 라디오나 체크박스는 모든 `input`에 써 주면 된다.
*   class로 써도 된다. 이 경우  `class="required"` 라고 쓴다. 라디오나 체크박스는 맨 처음 `input`에 써 주면 된다.
*   email 검증을 해야 하는 경우 `class="email"`이라고 쓴다.
*   필수이면서 이메일 검증을 해야 하는 경우에는 복수 클래스 병기하는 방법을 따라 `class="required email"` 이라고 적으면 되고 나머지도 마찬가지다. 혹은 `required` 속성을 주고 `class="email"`이라고 써 줄 수도 있다.
*   최소 글자수가 있는 경우 `minlength="숫자"` 형태로 적는다.

위와 같은 방법으로 했을 때의 최대 단점은 메시지가 영어로 나온다는 점이다. 필수 요소인데 안 적은 경우 &#8216;This field is required.&#8217;라는 메세지가 뜬다. 메세지를 한국어로 하고 싶다면 두 번째 방법을 사용하거나 [내가 만든 한국어 확장 파일을 사용][2]하면 된다. 한국어 확장의 코드는 아래와 같다.

<pre class="brush:js">/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: KO
 * Filename: messages_ko.js
 */
jQuery.extend(jQuery.validator.messages, {
	required: "반드시 입력해야 합니다.",
	remote: "수정 바랍니다.",
	email: "이메일 주소를 올바로 입력하세요.",
	url: "URL을 올바로 입력하세요.",
	date: "날짜가 잘못 입력됐습니다.",
	dateISO: "ISO 형식에 맞는 날짜로 입력하세요.",
	number: "숫자만 입력하세요.",
	digits: "숫자(digits)만 입력하세요.",
	creditcard: "올바른 신용카드 번호를 입력하세요.",
	equalTo: "값이 서로 다릅니다.",
	accept: "승낙해 주세요.",
	maxlength: jQuery.validator.format("{0}글자 이상은 입력할 수 없습니다."),
	minlength: jQuery.validator.format("적어도 {0}글자는 입력해야 합니다."),
	rangelength: jQuery.validator.format("{0}글자 이상 {1}글자 이하로 입력해 주세요."),
	range: jQuery.validator.format("{0}에서 {1} 사이의 값을 입력하세요."),
	max: jQuery.validator.format("{0} 이하로 입력해 주세요."),
	min: jQuery.validator.format("{0} 이상으로 입력해 주세요.")
});</pre>

다른 단점도 있다. minlength 라는 어트리뷰트는 웹표준 검증기를 통과하지 못한다. 표준 점수를 깎아먹을 수 있다는 것이다. 그게 사용성보다 중요한 요소는 아니지만, 웹을 잘 모르는 상관들에게는 중요할지 모른다.

## 두 번째 방법

<img class="aligncenter" alt="" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile26.uf.1712D8594D4BC87E19C9D2.png" width="540" height="460" />

이 방법은 모든 요소를 javascript 단에서 처리하기 때문에 가장 깔끔한 코드를 생산할 수 있다.

일단 코드를 보자.

<pre class="brush:js">$(function(){
  // validate signup form on keyup and submit
  $("#signupForm").validate({
    rules: {
      name: "required",
      password: {
        required: true,
        minlength: 8
      },
      confirm_password: {
        required: true,
        minlength: 8,
        equalTo: "#password"
      },
      email: {
        required: true,
        email: true
      },
      topic: {
        required: "#newsletter:checked",
        minlength: 2
      },
      agree: "required"
    },
    messages: {
      name: "이름을 입력해 주세요",
      password: {
        required: "암호를 입력해 주세요",
        minlength: "암호는 8자 이상이어야 합니다."
      },
      confirm_password: {
        required: "암호를 한 번 더 입력해 주세요",
        minlength: "암호는 8자 이상이어야 합니다.",
        equalTo: "암호가 일치하지 않습니다."
      },
      email: "형식에 맞는 이메일을 입력해 주세요.",
      agree: "정책 동의에 체크해 주세요"
    }
  });
});</pre>

위에서 눈여겨 볼 점은 validate 안에 들어있는 {} 안쪽 부분이다. 여기 옵션이 들어간다.

이 옵션 중 핵심적으로 사용된 것인 rules 옵션이다.

<pre class="brush:js">rules: {옵션오브젝트}</pre>

이런 형식으로 사용된다. 옵션 오브젝트는 어떻게 구성되는지 보자.

<pre class="brush:js">{name: "required"}</pre>

이렇게 씌인 게 있다. 이것은 name이 &#8220;name&#8221;인 놈은 필수라는 뜻이다. 다른 방식으로 적용할 수도 있는데 한 input(혹은 textarea)에 여러 개의 옵션을 걸 때다.

<pre class="brush:js">email: {required: true, email: true}</pre>

이런 식으로 들어가는데, 이 때 email: true 항목은 당연히 이메일형식 검증을 하겠다는 뜻이다.

rules 옵션 아래쪽에 있는 message 옵션은 rules에 대응되는 메시지들을 적어주면 된다. 위 형식을 참고하면 될 것이므로 굳이 일일이 설명하지 않겠다.

다음 html 코드를 보자.

<pre class="brush:html">&lt;form id="signupForm" method="get" action=""&gt;
  &lt;fieldset&gt;
    &lt;legend&gt;정보를 입력해 주세요&lt;/legend&gt;
    &lt;p&gt;
      &lt;label for="name"&gt;Lastname&lt;/label&gt;
      &lt;input id="name" name="name" /&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;label for="password"&gt;암호&lt;/label&gt;
      &lt;input id="password" name="password" type="password" /&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;label for="confirm_password"&gt;암호확인&lt;/label&gt;
      &lt;input id="confirm_password" name="confirm_password" type="password" /&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;label for="email"&gt;Email&lt;/label&gt;
      &lt;input id="email" name="email" /&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;label for="agree"&gt;개인정보 보호정책 동의&lt;/label&gt;
      &lt;input type="checkbox" class="checkbox" id="agree" name="agree" /&gt;
    &lt;/p&gt;
    &lt;p&gt;
      &lt;input class="submit" type="submit" value="제출"/&gt;
    &lt;/p&gt;
  &lt;/fieldset&gt;
&lt;/form&gt;</pre>

위 코드는 html 검증을 통과할 수 있는 깔끔한 코드다. <a href="http://www.w3schools.com/tags/att_label_for.asp" target="_blank">label에 있는 for 어트리뷰트</a>는 웹표준에 맞는 어트리뷰트다. 이 라벨이 어떤 인풋에 대한 것인지, 해당 인풋의 id를 써 주는 부분이다.

그러나 jQuery 검증 플러그인의 자바스크립트 코드에서 위 폼을 인식할 때는 name 어트리뷰트를 기준으로 하는 것이므로, name을 신경쓰면 된다. 즉, label은 선택이니 너무 눈 돌아가지 않아도 된다는 말이다.

name을 바탕으로 하므로 checkbox나 radio 같은 것도 검증이 가능하게 된다.

## 필수다! 하는 메시지의 스타일

자, 그럼 required 라고 써준 input에 입력을 안 하고 submit 버튼을 눌렀을 때(이 경우를 &#8216;에러가 났을 때&#8217;라고 표현하자.) 나올 스타일은 어디서 결정할까?

그건 따로 써줘야 한다. 미리 준비된 css는 제공하고 있지 않은 듯하다.

사용되는 페이지의 head 부분에 아래처럼 써 주면 된다.

두 경우를 제공하겠다. 첫 번째 것은 메시지가 input의 오른쪽에 나오는 디자인이다. 두 번째 것은 메시지가 input의 하단에 나오는 디자인이다. 둘 다 input의 테두리가 빨간 점선으로 변하고, 메시지도 빨간 색으로 뜬다. css 지식이 조금만 있다면 수정해서 자신이 원하는대로 사용할 수 있을 것이다.

아래 스타일이 에러메시지를 input 오른쪽 공간에 띄워 주는 스타일이다.

<pre class="brush: css; gutter: true; first-line: 1; html-script: true">&lt;style type="text/css"&gt;
input.error, textarea.error{
  border:1px dashed red;
}
label.error{
  margin-left:10px;
  color:red;
}
&lt;/style&gt;</pre>

아래 스타일은 에러메시지를 input 하단에 띄워 주는 스타일이다.

<pre class="brush: css; gutter: true; first-line: 1; html-script: true">&lt;style type="text/css"&gt;
input.error, textarea.error{
  border:1px dashed red;
}
label.error{
  display:block;
  color:red;
}
&lt;/style&gt;</pre>

## [jQuery Validation Plugin 공식 문서][3]

늘 공식 문서를 참고해야 한다.

[2012-02-21 추가] [ajaxForm플러그인과 동시에 사용하려면 `valid` 함수를 사용한다.][4]

[2012-11-04 추가] [체크박스나 라디오 버튼 검증 방법, 그리고 에러메시지 위치를 사용자가 지정하는 방법을 설명한 글을 올렸다.][5]

 [1]: http://parsleyjs.org/
 [2]: https://docs.google.com/leaf?id=0B1y-xjZYE3AqYTQ3YzdiMzYtNzQ2MC00MzE0LTk5MGQtYjI5MzU5MmUxYTYx&sort=name&layout=list&num=50
 [3]: http://jqueryvalidation.org/documentation/
 [4]: http://mytory.local/archives/2292 "[jQuery] ajaxForm 플러그인과 validate 플러그인 동시에 사용하기"
 [5]: http://mytory.local/archives/4904 "jquery.validate.js 폼 검증 플러그인 – 체크박스/라디오 버튼 검증과 에러메시지 위치 지정하기"