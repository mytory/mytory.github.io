---
title: jQuery ajaxForm plugin을 사용해 보자
author: 안형우
layout: post
permalink: /archives/223
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
date_modified: 2017-03-30 23:40
---

`form`을 `ajax`로 처리해야 하는 경우가 있다. ajaxForm 플러그인을 사용하면 복잡한 js 코딩 없이 html의 폼 정보를 바탕으로 이것을 간단하게 처리해 준다. 나온지 오래된 플러그인이지만 여전히 사랑받는 플러그인이다. 

    <form action="destination.php" enctype="multipart/form-data" method="post" name="myForm" id="myForm" >
        <label for="myInput">입력하세요 : </label><input type="text" name="myInput" id="myInput">
        <label for="myFile">파일선택 : </label><input type="file" name="myFile" id="myFile">
        <input type="submit" value="확인">
    </form>

위의 예시에서는 `enctype`을 `multipart/form-data`로 했는데, 예시에 파일전송을 넣으려고 쓴 것이다. ajaxForm 플러그인과는 무관하다.

위 폼이 있는 문서에서 javascript 코드로 `head` 부분에 아래처럼 써 주는 것만으로 ajax 처리가 완벽하게 된다.

    $(function(){
      $('#myForm').ajaxForm();
    });

이렇게 쓰면 `action`값과 `method`를 `form`에 지정된 대로 사용하게 된다. `submit` 버튼 누르면 `ajax` 처리가 된다.

더 구체적인 API는 당연이 [ajaxForm plugin의 API](http://jquery.malsup.com/form/#api)를 보면 된다.

## ajax 응답을 받은 후 처리를 넣으려면?

응답 받은 후 처리를 넣는 것도 간단하다.

아래 코드를 보자.

    $(function(){
      $('#myForm').ajaxForm({
        success: function(data){
          alert(data);
        }
      });
    });

위와 같은 코드를 사용하면, 응답받은 메시지를 `alert`으로 띄우게 된다. 정말 짱이다.

## 응답받은 후 폼을 조작하려면

    $(function(){
      $('#myForm').ajaxForm({
        success: function(responseText, statusText, xhr, $form){
          alert(responseText);
          $form.css('background','red');
        }
      });
    });

위 코드를 참고하면 알겠지만, `success` 옵션 항목에 넣는 `function`에 네 번째 인자값으로 `$form` 이라는 놈을 설정한다. (알겠지만 인자값의 이름은 아무거나 쓰면 된다. `$form` 으로 안 하고 `asdf`로 해도 된다는 거다.) 그게 바로 원래 폼의 jQuery 객체다. 이걸 바탕으로 조작을 가하면 되겠다.

## 옵션 구조

옵션의 구조를 살짝 설명하자. `ajaxForm` 안에는 `json` `object`를 인자값으로 넣을 수 있는 것이다. jQuery 자체뿐 아니라 거의 모든 jQuery 플러그인에서 이런 식으로 옵션을 집어넣는다.

알겠지만 `javascript`의 `object` 구조는 아래처럼 쓴다.(기본적으로 이건 `json` 구조다.)

    {
      beforeSubmit: function(){ 
        alert('서브밋 직전입니다!'); 
      }, 
      success: function(){ 
        alert('전송 성공!'); 
      } 
    }

대충 뭔지 이해가 가시는지.

그래서 아래와 같은 코드로 활용할 수도 있다.

    var option = {
      beforeSubmit : function() {
        alert('서브밋 직전입니다!');
      },
      success : function() {
        alert('전송 성공!');
      }
    };
    $('#myForm').ajaxForm(option);

대충 이해가 가셨으리라 생각한다.

`javascript`의 이런 구조에 대해서 나는 《프로그래밍 jQuery》의 부록을 보고 많이 배웠다. 이 책은 강추니 도서관에서 빌려 보든 사 보든 jQuery를 공부하려는 생각이 있는 사람은 꼭 한 번 보기 바란다.

여튼, 이 정도면 대충 사용하는 데는 무리가 없을 것이라고 생각하는데, 만약 좀더 알기를 바란다면 <a href="http://jquery.malsup.com/form/#options-object" target="_blank">jQuery <code>ajaxForm</code> plugin 사이트의 option 탭</a>을 보면 된다.

## dataType 옵션

`option` 중 알아 두면 좋은 것은 `dataType` 옵션인데, 설명이 아래처럼 돼 있다. 부족한 영어실력이지만 대충 번역해 본다.

> **dataType**
> 
> 응답받을 data type. `null`, `'xml'`, `'script'`, `'json'` 중 하나를 쓰면 된다. `dataType`은 서버에서 받은 응답을 어떻게 처리할 지 알려 주는 역할을 한다. 이 옵션은 `jQuery.httpData` 메서드에 직접 맵핑된다.(이건 뭔 말인지 모르겠다. 맵핑(maps)된다는 게 정확히 뭘 의미하는지도 모르겠고, `httpData` 메서드는 jQuery 기본 메서드가 아닌 듯한데 `jQuery.httpData`라고 써 놨으니. 역시 영어실력 부족인가&#8230; OTL;;) 다음 값을 지원한다.
> 
> **`'xml'`**: 만약 `dataType == 'xml'` 이면 서버의 응답은 `xml`로 취급된다. 만약 &#8216;`success`&#8216; 콜백 메서드가 지정돼 있다면 `responseXML` 값을 전달받게 될 것이다.
> 
> **`'json'`**: 만약 `dataType == 'json'` 이면 서버 응답이 성공한 것으로 평가된 것이고, 만약 지정돼 있다면 콜백 메서드도 실행될 것이다.(if `dataType == 'json'` the server response will be evaluted and passed to the &#8216;`success`&#8216; callback, if specified _ 이거 번역 어렵다;; 맞게 번역했는지 모르겠음.)
> 
> **`'script'`**: 만약 `dataType == 'script'` 이면, 서버 응답은 global context(이게 뭔지 모르겠다. 해 보면 알겠지.)로 취급될 것이다.
> 
> [`dataType`을 설정하지 않았을 때의] **기본값**: `null`

헉헉;; 괜히 번역을 시도한 것 같다. 어쨌든,  위에서 `dataType`의 변수로 들어갈 값들은 따옴표로 둘러싸인 문자열값이어야 한다는 사실을 잊지 않았으면 한다.

나머지는 정말로, API 참조해서 잘 하기 바란다. 나도 더 사용해 보게 되면 더 쓰겠다. 이상.

## 주의할 점

### json을 뿌릴 때는 내장 함수나 라이브러리를 이용하자

`dataType`을 `json`으로 설정했다면, 조심할 게 있다. 아래 코드를 보자.

    {result: 1, msg: "성공!"}

이런 식으로 쓰면 안 된다. json은 key값도 따옴표를 붙여야 하기 때문이다. 위처럼 응답을 주도록 쓰고 `dataType`을 `json`으로 쓰면 처리가 실패한 것으로 간주되 아무 일도 안 일어난다,

    {"result": 1, "msg": "성공!"}

이렇게 써야 `json`으로 인식한다. 절대로 이것 때문에 삽질하지 말자.

만약 PHP를 사용한다면, 배열을 만든 다음 아래 코드처럼 json_encode 함수를 사용하면 된다.

    $arr = array('a'=>'에이', 'b'=>'비');
    echo json_encode($arr);

사용하는 언어에 json 관련 함수나 라이브러리가 없을 리 없다. 찾아서 사용하자.

### 응답이 아무 것도 없으면

응답이 아무것도 없으면 아무 일도 안 일어난다.(즉, `success`에 `function`을 넣어 놔도 작동하지 않는다.) 테스트할 때 응답하는 쪽 파일에 아무거라도 출력하도록 하고 테스트를 해야 한다.

## 2012-02-21

[validate 플러그인과 동시에 사용하려면 `beforeSubmit` 옵션을 사용한다.][1]

[1]: https://mytory.net/archives/2292 "[jQuery] ajaxForm 플러그인과 validate 플러그인 동시에 사용하기"
