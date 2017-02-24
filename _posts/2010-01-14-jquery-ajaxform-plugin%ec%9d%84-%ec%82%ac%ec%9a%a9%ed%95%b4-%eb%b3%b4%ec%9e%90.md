---
title: jQuery ajaxForm plugin을 사용해 보자
author: 안형우
layout: post
permalink: /archives/223
aktt_notify_twitter:
  - yes
daumview_id:
  - 37139086
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
jQuery는 정말 짱이다.

어떤 사람들은 jQuery를 화려한 애니메이션 효과를 줄 수 있는 라이브러리라고 생각할 지도 모르겠다. 뭐, 틀린 말은 아니고, 처음에 그렇게 jQuery에 열광하는 것도 나쁜 일은 아니다. 그러나 jQuery에서 애니메이션이 차지하는 것은 아주 적다고 나는 생각한다.

내가 관리하는 사이트도 jQuery를 사용하고 있지만, 애니메이션 효과는 거의 사용하지 않는다. 속도가 중요한 사이트에서 화려한 UI는 옵션이지 필수가 아니다. 어쩌면 화려한 UI는 플래시가 더 잘 제공할 수도 있다.

내 생각에 jQuery의 가장 강력한 부분은 바로 각종 HTML 요소들을 아주아주 쉽고 자유자재로 사용할 수 있도록 해 주는 부분이다.

뭐, jQuery에 대해서는 이 정도만 말하고, `ajaxForm`이 뭔지부터 알아 보자.

`form`을 `ajax`로 처리하는 게 편하겠다는 생각을 개발자라면 한 번쯤 생각해 봤을 법하다.

그런데 `ajaxForm plugin`은 이걸 완빵에 처리해 준다. 다음 코드를 보자.

<pre class="brush:html">&lt;form action="destination.php" enctype="multipart/form-data" method="post" name="myForm" id="myForm" &gt;
&lt;label for="myInput"&gt;입력하세요 : &lt;/label&gt;&lt;input type="text" name="myInput" id="myInput"&gt;
&lt;label for="myFile"&gt;파일선택 : &lt;/label&gt;&lt;input type="file" name="myFile" id="myFile"&gt;
&lt;input type="submit" value="확인"&gt;
&lt;/form&gt;</pre>

위의 예시에서는 enctype을 multipart/form-data로 했는데, 심지어 파일전송까지 완빵에 해결할 수 있다는 것을 보여 준 것이지, 꼭 저렇게 옵션을 줘야 한다는 뜻은 아니다. enctype을 설정하지 않고, 파일전송 없이 사용해도 잘 작동한다.

위 폼이 있는 문서에서 javascript 코드로 head 부분에 아래처럼 써 주는 것만으로 ajax 처리가 완벽하게 된다.

<pre class="brush:js">$(function(){
  $(&#039;#myForm&#039;).ajaxForm();
});</pre>

이렇게 쓰면 `action`값과 `method`를 `form`에 지정된 대로 사용하게 된다. `submit` 버튼 누르면 `ajax` 처리가 된다.

정말 짱이다 ㅡㅡ;;

더 구체적인 API는 당연이 <a href="http://jquery.malsup.com/form/#api" target="_blank"><code>ajaxForm</code> plugin의 API</a>를 보면 된다.

## `ajax` 응답을 받은 후 처리를 넣으려면?

응답 받은 후 처리를 넣는 것도 간단하다.

아래 코드를 보자.

<pre class="brush:js">$(function(){
  $(&#039;#myForm&#039;).ajaxForm({
    success: function(data){
      alert(data);
    }
  });
});</pre>

위와 같은 코드를 사용하면, 응답받은 메시지를 `alert`으로 띄우게 된다. 정말 짱이다.

## 응답받은 후 폼을 조작하려면

<pre class="brush: bash; gutter: true; first-line: 1">$(function(){
  $(&#039;#myForm&#039;).ajaxForm({
    success: function(responseText, statusText, xhr, $form){
      alert(responseText);
      $form.css(&#039;background&#039;,&#039;red&#039;);
    }
  });
});</pre>

위 코드를 참고하면 알겠지만, `success` 옵션 항목에 넣는 `function`에 네 번째 인자값으로 `$form` 이라는 놈을 설정한다. (알겠지만 인자값의 이름은 아무거나 쓰면 된다. `$form` 으로 안 하고 `asdf`로 해도 된다는 거다.) 그게 바로 원래 폼의 jQuery 객체다. 이걸 바탕으로 조작을 가하면 되겠다.

## 옵션 구조

옵션의 구조를 살짝 설명하자. `ajaxForm` 안에는 `json` `object`를 인자값으로 넣을 수 있는 것이다. jQuery 자체뿐 아니라 거의 모든 jQuery 플러그인에서 이런 식으로 옵션을 집어넣는다.

알겠지만 `javascript`의 `object` 구조는 아래처럼 쓴다.(기본적으로 이건 `json` 구조다.)

<pre class="brush:js">{
  beforeSubmit: function(){ 
    alert(&#039;서브밋 직전입니다!&#039;); 
  }, 
  success: function(){ 
    alert(&#039;전송 성공!&#039;); 
  } 
}</pre>

대충 뭔지 이해가 가시는지.

그래서 아래와 같은 코드로 활용할 수도 있다.

<pre class="brush:js">var option = {
  beforeSubmit : function() {
    alert(&#039;서브밋 직전입니다!&#039;);
  },
  success : function() {
    alert(&#039;전송 성공!&#039;);
  }
};
$(&#039;#myForm&#039;).ajaxForm(option);</pre>

대충 이해가 가셨으리라 생각한다.

`javascript`의 이런 구조에 대해서 나는 《프로그래밍 jQuery》의 부록을 보고 많이 배웠다. 이 책은 강추니 도서관에서 빌려 보든 사 보든 jQuery를 공부하려는 생각이 있는 사람은 꼭 한 번 보기 바란다.

여튼, 이 정도면 대충 사용하는 데는 무리가 없을 것이라고 생각하는데, 만약 좀더 알기를 바란다면 <a href="http://jquery.malsup.com/form/#options-object" target="_blank">jQuery <code>ajaxForm</code> plugin 사이트의 option 탭</a>을 보면 된다.

## dataType 옵션

`option` 중 알아 두면 좋은 것은 `dataType` 옵션인데, 설명이 아래처럼 돼 있다. 부족한 영어실력이지만 대충 번역해 본다.

> <span style="color: #c00000;"><strong>dataType</strong></span>
> 
> 응답받을 data type. `null`, &#8216;`xml`&#8216;, &#8216;`script`&#8216;, &#8216;`json`&#8216; 중 하나를 쓰면 된다. `dataType`은 서버에서 받은 응답을 어떻게 처리할 지 알려 주는 역할을 한다. 이 옵션은 `jQuery.httpData` 메서드에 직접 맵핑된다.(이건 뭔 말인지 모르겠다. 맵핑(maps)된다는 게 정확히 뭘 의미하는지도 모르겠고, `httpData` 메서드는 jQuery 기본 메서드가 아닌 듯한데 `jQuery.httpData`라고 써 놨으니. 역시 영어실력 부족인가&#8230; OTL;;) 다음 값을 지원한다.
> 
> **&#8216;`xml`&#8216;**: 만약 `dataType` == &#8216;`xml`&#8216; 이면 서버의 응답은 `xml`로 취급된다. 만약 &#8216;`success`&#8216; 콜백 메서드가 지정돼 있다면 `responseXML` 값을 전달받게 될 것이다.
> 
> **&#8216;`json`&#8216;**: 만약 `dataType` == &#8216;`json`&#8216; 이면 서버 응답이 성공한 것으로 평가된 것이고, 만약 지정돼 있다면 콜백 메서드도 실행될 것이다.(if `dataType == 'json'` the server response will be evaluted and passed to the &#8216;`success`&#8216; callback, if specified _ 이거 번역 어렵다;; 맞게 번역했는지 모르겠음.)
> 
> **&#8216;`script`&#8216;**: 만약 `dataType == 'script'` 이면, 서버 응답은 global context(이게 뭔지 모르겠다. 해 보면 알겠지.)로 취급될 것이다.
> 
> [`dataType`을 설정하지 않았을 때의] **기본값**: `null`

헉헉;; 괜히 번역을 시도한 것 같다. 어쨌든,  위에서 `dataType`의 변수로 들어갈 값들은 따옴표로 둘러싸인 문자열값이어야 한다는 사실을 잊지 않았으면 한다.

나머지는 정말로, API 참조해서 잘 하기 바란다. 나도 더 사용해 보게 되면 더 쓰겠다. 이상.

## 주의할 점

[덧] `dataType`을 `json`으로 설정했다면, 조심할 게 있다. 예컨대

<pre class="brush:js">{result: 1, msg: "성공!"}</pre>

이런 식으로 쓰면 안 된다. json은 key값도 따옴표를 붙여야 하기 때문이다. 위처럼 응답을 주도록 쓰고 `dataType`을 `json`으로 쓰면 처리가 실패한 것으로 간주되 아무 일도 안 일어난다,

<pre class="brush:js">{"result": 1, "msg": "성공!"}</pre>

이렇게 써야 `json`으로 인식한다. 절대로 이것 때문에 삽질하지 말자.

만약 PHP를 사용한다면, 배열을 만든 다음 아래 코드처럼 json_encode 함수를 사용하면 된다.

<pre class="brush: php; gutter: true; first-line: 1">$arr = array(&#039;a&#039;=&gt;&#039;에이&#039;, &#039;b&#039;=&gt;&#039;비&#039;);
echo json_encode($arr);</pre>

[덧2] 응답이 아무것도 없으면 아무 일도 안 일어난다.(즉, `success`에 `function`을 넣어 놔도 작동하지 않는다.) 테스트할 때 응답하는 쪽 파일에 아무거라도 출력하도록 하고 테스트를 해야 한다.

[2012-02-21 추가] [validate 플러그인과 동시에 사용하려면 `beforeSubmit` 옵션을 사용한다.][1]

 [1]: https://mytory.net/archives/2292 "[jQuery] ajaxForm 플러그인과 validate 플러그인 동시에 사용하기"