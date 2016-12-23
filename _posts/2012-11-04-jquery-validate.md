---
title: 'jquery.validate.js 폼 검증 플러그인 &#8211; 체크박스/라디오 버튼 검증과 에러메시지 위치 지정하기'
author: 안형우
layout: post
permalink: /archives/4904
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
[2013-09-27 추가 : 최근에 새로 발견한 폼 검증 플러그인으로 [Parsley.js][1]가 있는데, 이게 더 좋아 보인다. 문서도 잘 돼 있다. 단, IE6를 지원하지 않는다. 따라서 한국에서는 당분간 쓰기 힘들 것 같다. 아니면, 서버단 밸리데이션을 반드시 하면서 js를 보조적으로만 활용할 때 Parsley.js를 사용하면 되겠다. (사실 당연한 이야기긴 하지만 말이다.)]

[jQuery 폼 검증 플러그인 간단 사용법][2]은 아주 예전에 쓴 적이 있다. 오늘은 두 가지를 추가로 설명할 생각이다. 나도 그 때보다 많이 실력이 늘었다. 하나는 체크박스나 라디오 버튼 검증, 다른 하나는 메시지를 원하는 위치에 띄우는 방법이다. 데모부터 보고 싶은 사람은 아래 링크로 데모를 보면 되겠다.

[▶데모 보기][3]

## 체크박스나 라디오 버튼 검증

체크박스나 라디오 버튼의 공통점은 같은 `name`을 가지는 여러 개의 `input`이 있다는 거다. 이 때 사용법은 간단한데, 여러 개의 `input`들 중 맨 앞에 있는 `input`에 `required` 클래스를 부여하는 것이다.

## HTML5 문법

`HTML5` 문법을 사용할 수도 있다. 자바스크립트가 켜져 있다면 `jquery.validate.js` 플러그인이 처리해 줄 테고, 자바스크립트가 꺼져 있다면 브라우저에서 처리해 줄 거다. `HTML5` 문법에서 체크박스나 라디오를 필수로 만들려면 모든 `input`에 `required="required"`라고 써 준다. (혹은 `required` 라고만 써 주거나 `required=""` 라고 써 줘도 된다. 그러나 `required="true"` 이런 건 안 된다.)

## 메시지를 원하는 위치에 띄우기

`jquery.validate.js` 플러그인인 `input` 요소의 바로 뒤에 `label.error` 요소를 생성해서 에러메시지를 띄운다.

라디오 버튼과 체크박스는 `input` 요소가 여러개다. 그런데 맨 처음 요소에만 `required` 클래스를 넣어 준다. 그래서 따로 처리를 안 해 주면 에러 메시지가 뜰 때 첫 번째 `input`의 바로 뒤에 뜨게 된다. 아래처럼 말이다.

![][4]

이 때 `label.error` 태그를 명시해 주면 에러 메시지를 자동으로 삽입하지 않고, 이미 있는 `label.error` 요소를 사용하게 된다.

<pre class="brush: xml; gutter: true; first-line: 1">&lt;p&gt;고장 내용을 설명해 주시겠습니까?&lt;/p&gt;
&lt;p&gt;
  &lt;label for="고장내용" class="error"&gt;필수입니다.&lt;/label&gt;
&lt;/p&gt;
&lt;p&gt;
  &lt;input required="required" type="checkbox" name="고장내용" id="고장내용1" value="얼음성형 안 됨" /&gt;
  &lt;label for="고장내용1"&gt;얼음성형 안 됨&lt;/label&gt;
  &lt;input required="required" type="checkbox" name="고장내용" id="고장내용2" value="얼음이 안 떨어짐" /&gt;
  &lt;label for="고장내용2"&gt;얼음이 안 떨어짐&lt;/label&gt;
  &lt;input required="required" type="checkbox" name="고장내용" id="고장내용3" value="전원이 안 들어옴" /&gt;
  &lt;label for="고장내용3"&gt;전원이 안 들어옴&lt;/label&gt;
&lt;/p&gt;</pre>

유의점은 한 가지다. **`label.error` 요소의 `for` 속성은 `input`의 `name`으로 해야 한다.**

또한 CSS 수준에서 `display:none`을 해 주는 것도 잊지 말자. 안 그러면 에러 메시지가 늘 보이게 된다. 이 때 `.error`에 속성을 부여하지 말고 `label.error`에 속성을 부여해야 한다. `validate` 플러그인이 에러를 표시할 때 `input`에도 `error` 클래스를 매기기 때문에 `.error`에만 `display:none` 속성을 부여하면 에러 발생시 `input`도 함께 사라지게 된다.

이상이다. 나머지는 데모를 보고 알아서 탐구하면 되겠다.

[▶데모 보기][3]

 [1]: http://parsleyjs.org/
 [2]: http://mytory.net/archives/195 "jQuery Form Validation Plugin 폼 검증 플러그인 간단 사용법"
 [3]: https://dl.dropboxusercontent.com/u/15546257/code/jquery-validate-demo.html
 [4]: /uploads/legacy/jquery-validate-js-error-msg-position.png