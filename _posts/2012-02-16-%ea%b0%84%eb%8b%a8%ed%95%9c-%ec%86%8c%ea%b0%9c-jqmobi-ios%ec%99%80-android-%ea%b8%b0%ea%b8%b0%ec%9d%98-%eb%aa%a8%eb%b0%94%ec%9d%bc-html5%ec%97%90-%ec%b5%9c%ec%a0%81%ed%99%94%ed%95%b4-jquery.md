---
title: '[번역]  jqMobi &#8211; iOS와 Android 기기의 모바일 HTML5에 최적화해 jQuery를 다시 작성해 만든 모바일 프레임워크 README'
author: 안형우
layout: post
permalink: /archives/2257
aktt_notify_twitter:
  - yes
daumview_id:
  - 36624335
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
jqMobi는 인텔이 인수해서 [App Framework][1]라는 걸로 개편한 모양이다.

이제 아래 번역은 별 소용은 없게 된 것 같다.

&#8212;&#8212;

아이폰에서 돌려 봤는데 확실히 반응이 jQuery Mobile보다 빠르다. 근데 이게 지속 가능해야 할 텐데. 지금 섣불리 적용했다가 나중에 jQuery Mobile 성능이 열라 좋아지면 어쩌지? 물론, jQuery Mobile은 훨씬 넓은 기기에 적용하는 걸 목적으로 하는 터라 그렇게 되진 않을 지도 모르지만 말이다.

여튼간에 갈무리해 둔다. 속도가 맘에 든다.

대충 살펴 봤는데 함수와 HTML 구조는 많이 비슷한 것 같다.(jQuery 기본 함수는 당연히 다 쓸 수 있을 것이고, 내부구조를 덮어 쓴 것일 터다.) 그렇다면 어느 정도 이전하는 게 쉽겠다는 생각이 든다. 그러나 1분 정도 살펴 본 것이기 때문에 섣불리 내 말을 믿고 결정을 내리진 않기 바란다. (jQuery Mobile로 만든 프로젝트에서 js만 jq.mobi로 바꾸는 걸 해봤는데 js만 바꾸는 걸로는 안 되고 나름의 문법 수정을 거쳐야 하는 듯하다.)

아래는 jqMobi, jQuery Mobile, Sencha Touch를 비교한 jqMobi 측의 영상이다.

<div class="video-container">
  <div class="video-container__inner">
  </div>
</div>

## readme.md

아래는 jqMobi를 다운받으면 포함돼 있는 [readme.md 파일][2] 내용을 그대로 옮기고 일부 번역한 것이다. 도움이 될 거다. 영어라는 점만 빼면  OTL;;

## jqMobi &#8211; HTML5를 타겟으로 한 자바스크립트 프레임워크

jqMobi는 HTML5 브라우저를 타겟으로 한 자바스크립트 프레임워크다. W3C 쿼리를 지원하는 번개처럼 빠른 쿼리 셀렉터 라이브러리를 사용한다.

이것은 세 부분으로 구성돼 있다.

1) jqMobi &#8211; 쿼리 셀렉터 라이브러리

2) jqUi &#8211; 웹킷 브라우저[크롬, 사파리, 안드로이드 기본 브라우저 등 - 녹풍]에서 돌아가는 모바일 어플리케이션을 위한 UI/UX 라이브러리. Kitchen Sink 폴더에 가서 데모를 보라.

3) jqPlugins &#8211; 웹킷 브라우저에서 돌아가는 모바일 어플리케이션을 위한 플러그인들.

## jqMobi에 대해

모바일 개발을 하면서, 우리는 유명한 쿼리 셀렉터 라이브러리들에 만족할 수가 없다는 것을 금세 알게 됐다. 그것들은 때로 성능이 별로였고, 용량이 컸고, 구식 데스크톱 브라우저(인터넷 익스플로러 6)를 지원했다. 모바일 개발을 타겟으로 하는 새로운 라이브러리가 몇 개 있었지만, 스피드 테스트를 해 보면 실제로는 느렸다.

우리는 우리 개발 커뮤니티에서 이야기를 시작했고, 그들에게 뭘 원하는지 물었다. 핵심은 다음과 같았다.

1.  빨라야 한다. ( Fast performance)
2.  코드가 적어야 한다. (Small code base)
3.  실제로 필요한 명령만 지원하면 된다. (Only needs to support a small subset of commands)

다른 라이브러리를 개선하려고 노력하기보다는, 다른 프레임워크 밖에서 우리가 새로 짓는 게 낫다는 것을 알게 됐다. but recognizing the groundwork other frameworks laid out. 이렇게 함으로써, 우리는 속도를 향상시킬 수 있는 간단한 방법을 찾았다. 우리 테스트를 보면, 단순 반복 작업에서 2배 이상 빠르다는 것을 알 수 있다.

그룹작업에서도 비슷했다.

## jqMobi 사용하기

jqMobi를 쓰려면, html 파일에 script를 포함해야 한다. 미리 마련해 둔, 용량을 최소화시킨 버전을 사용할 수 있다.

<pre class="brush: xhtml; gutter: true; first-line: 1">&lt;script src="jq.mobi.min.js"&gt;&lt;/script&gt;</pre>

이것은 작업을 할 수 있는 객체 두 개를 만들 것이다. 이것은 이미 있는 $ 객체를 덮어쓰지 **않는다.**

<pre class="brush: javascript; gutter: true; first-line: 1">$("#main")
jq("#main")</pre>

## 쿼리 셀렉터 Query Selector

W3C에서 지정한 쿼리를 지원한다. 이게 의미하는 바는 다음과 같은 방식을 사용할 수 있다는 거다.

<pre class="brush: javascript; gutter: true; first-line: 1">$("input[type='text']")</pre>

다음과 같이 사용할 수는 **없다.** 브라우저에서 지원하지 않는 것은 jq.mobi도 지원하지 않는다.

<pre class="brush: javascript; gutter: true; first-line: 1">$("input:text")</pre>

몇몇 함수에서는 셀렉터를 몇 개 더 사용할 수 있다. 이것은 문자열, 배열 혹은 jqMobi 객체가 될 수 있다. 우리는 현재 함수를 지원하지는 않는다.

## 문법:

기본적인 호출

<pre class="brush: javascript; gutter: true; first-line: 1">$("#id").hide()</pre>

돔 엘리먼트, 셀렉터, 노드 목록, 혹은 HTML 문자열을 특정할 수도 있다.

<pre>$("span").bind("click",function(){console.log("clicked");});
 // -&gt; 모든 span 엘리먼트를 찾아서 click 이벤트를 건다.</pre>

HTML 문자열을 넘겨 주면 그러면 객체를 만들어 준다.

<pre class="brush: javascript; gutter: true; first-line: 1">var myDiv=$("&lt;div id='foo'&gt;") //Creates a div object and returns it</pre>

## jqMobi API 함수들

[아래 함수들은 jQuery 사용자라면 알 만한 것들이라서 번역하다가 말았다.]

<pre class="brush: javascript; gutter: true; first-line: 1">.length() // 선택한 모든 엘리먼트의 개수를 리턴한다.
 .find() // 인자값에 넣은 셀렉터에 맞는 자식 엘리먼트를 리턴. $('#myId').find('span.myClass') 하는 식으로 쓴다.
 .html() // .innerHTML을 리턴.
 .html('new html') // 내부의 내용을 new html로 바꿔치기한다.
 .text() // 내부의 텍스트를 반환한다. .innerTEXT 와 같다.
 .text('new text') // 내부의 텍스트를 new text로 바꿔치기한다.
 .css('property') //Gets the first elements desired css property
 .css('property','value') //Sets the elements css property to value
 .empty() //Sets the elements .innerHTML to an empty string
 .hide() //Sets the elements display css attribute to "none"
 .show() //Sets the elements display css attribute to "block"
 .toggle() //Toggles the elements display css attribute
 .val() //Gets the first elements value property
 .val("value") //Sets the elements value property
 .attr("attribute")// Gets the first elements desired attribute
 .attr("attribute","value") //Sets the elements attribute with the value
 .removeAttr("attribute") //Removes the attribute from the elements
 .remove() //Remove an element from the Dom
 .addClass("className") //Adds the css clas name to the selected elements
 .removeClass("className") //Removes a css class from the selected elements
 .hasClass("className") //Checks the first element to see if the css class exists
 .hasClass("className",_element) //Checks the passed in element to see if the css class exists
 .bind("event",function(){}) //Binds a function to the event listener selected to the selected elements
 .unbind("event") //Unbinds a function to the event listener selected to the selected elements
 .trigger("event",data) //Trigger an event on the selected elements and pass in optional data
 .append(element) //Appends an element to the selected elements
 .prepend() //Prepends an element to the selected elements
 .get() //Returns the first element from the selected elements
 .get(2) //Returns the third element from the selected elements
 .offset() //셀렉터로 선택한 놈들 중 첫 번째 놈의, 화면에서의 위치를 구해 준다. [참고 : &lt;a href="http://api.jquery.com/offset/"&gt;jQuery .offset&lt;/a&gt; - 녹풍]
 .data(param,value)// data-* 형식의 어트리뷰트를 세팅한다.
 .data(param) //data-* 형식의 어트리뷰트를 가져온다.
 .parent(selector) //Returns the parent nodes based off selector
 .children(selector) //Returns the children of the elements
 .siblings(selector) //Returns the siblings the elemnts
 .filter(selector) //Filters the elements based off selector
 .not(selector) //Filters the elements based off the selector. Returns matches that do NOT match the selector
 .end() //Used in conjuction with filtered results to get the previous jqMobi object
 .isArray(param) //Returns true/false if param is an array
 .isFunction(param) //Returns true/false if param is a function
 .isObject(param) //Returns true/false if param is an object</pre>

## jqMobi Ajax 호출

<pre class="brush: javascript; gutter: true; first-line: 1">.get(url,callback)
//Makes an Ajax request to the URL and executes the callback funtion with the result

.post(url,data,callback,dataType) 
//Makes an Ajax POST request to the URL with the data and executes the callback with the result. An optional dataType can be passed in, as some webservices require the header

.getJSON(url,data,callback) 
//Makes an ajax request with the data and executes callback function passing in a JSON object from the Ajax response into the callback function.</pre>

좀더 제어하는 게 필요하면 다음과 같이 사용할 수 있다.

<pre class="brush: javascript; gutter: true; first-line: 1">.ajax {
   type:'POST', //defaults to GET
   url:'/api/getinfo', //defaults to window.location
   contentType:'application/json', //defaults to application/x-www-form-urlencoded
   headers:{},
   dataType:'application/json', //defaults to text/html
   data:{username:foo}, //Can be a Key/Value pair string or object.  If it's an object, $.serialize is called to turn it into a Key/Value pair string
   success:function(data){}, //function to call on successful Ajax request
   error:function(data){}, //function to call when an error exists in the Ajax request
}</pre>

URL에 =? 패턴이 있으면, jsonP request가 만들어질 거다. 이런 것들은 **오직** GET request만 된다.

## jqMobi Helper 호출

<pre class="brush: javascript; gutter: true; first-line: 1">.param() //Serialize a JSON object into KVP for a querystring
 .parseJSON(string) //Backwards compatability JSON parsing call. Uses the browsers native JSON parser
 .parseXML(string) //Parses a string and returns a XML document version</pre>

jqMobi OS 체크 기능

<pre class="brush: javascript; gutter: true; first-line: 1">$.os.webkit //True if webkit found in the user agent
 $.os.android //True if anroid useragent
 $.os.ipad //True if iPad useragent
 $.os.iphone //True if iPhone user agent
 $.os.webos //True if WebOS detected
 $.os.touchpad //True if WebOS and Touchpad user agent
 $.os.ios //True if iPad or iPhone
 $.os.blackberry //True if Blackberry PlayBook or OS &gt;=6</pre>

## 플러그인

jqMobi는 플러그인을 붙일 수 있도록 확장성있게 만들어졌다. 플러그인을 만들기 위해 대부분이 하는 것처럼 메인 jqMobi 객체의 레퍼런스에 보내서 $.fn을 확장하면 된다.

<pre class="brush: javascript; gutter: true; first-line: 1">(function($){
  $.fn['foo']=function(){
     alert("bar");
  }
})(jq);</pre>

## Contribute

누구나 코드를 받아서 코어 코드에 기여할 수 있다. 그리고 코드를 요청할 수 있다. 우리가 일회성 기능을 추가하고 싶어하지 않는다는 것을 명심하라.이것은 플러그인으로 잘 다뤄질 것이다.

## Bugs

버그를 찾았을 때 보고하기 위해 github를 이용해 주기 바란다.그리고 다음 것들을 알려 달라.

1.  Any error messages from the console
2.  Line numbers of offending code
3.  Test cases
4.  Description of the Error
5.  Expected result
6.  Browser/Device you are testing on

## License

jqMobi is is licensed under the terms of the MIT License, see the included license.txt file.

 [1]: http://app-framework-software.intel.com/
 [2]: https://github.com/appMobi/jQ.Mobi/blob/master/README.md