---
title: 폰트가 설치돼 있는지 확인해 주는 javascript
author: 안형우
layout: post
permalink: /archives/118
aktt_notify_twitter:
  - yes
daumview_id:
  - 37213809
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
두 가지 종류가 있다. 하나는 <a href="https://github.com/beseku/jquery.font" target="_blank">jqeury를 사용</a>한다.

다른 하나는 <a href="http://remysharp.com/2008/07/08/how-to-detect-if-a-font-is-installed-only-using-javascript/" target="_blank">javascript만 사용</a>한다. 이 기능은 <a href="http://wodory.com/entry/TCDraftPost-1" target="_blank">소개글</a>(한국어)이 재밌어서 링크해 둔다.

## 사용법 : jquery.font.js

사실 간단하다.

일단 <a href="http://jquery.com" target="_blank">jquery 사이트</a>에서 jquery를 다운로드한다.

(min 또는 mini가 붙은 것은 공백 따위를 모두 없애서 용량을 정말 최소한으로 만든 것이다. 없는 것은 사람이 알아볼 수 있는 형태로 코드가 정리돼 있다. 줄바꿈, 들여쓰기 등으로 말이다.)

다음, <a href="http://github.com/beseku/jquery.font/" target="_blank">jquery.font.js를 다운로드</a>한다.(여기서 <a id="64644686a52b4b016421e8f2a511f7937ec9578f" href="http://github.com/beseku/jquery.font/blob/master/jquery.font.mini.js">jquery.font.mini.js</a>를 다운받아도 되고, <a id="36c5a680431f0232d2b37a058371b43753cd4385" href="http://github.com/beseku/jquery.font/blob/master/jquery.font.js">jquery.font.js</a>를 받아도 된다. 클릭하면 소스를 보게 되니, 오른쪽 클릭해서 <span style="font-weight: bold;">다른 이름으로 저장</span>하시라.)

둘 다 script로 페이지에 집어넣고(뭐, 굳이 이런 것까지 설명해야 하나 싶지만;;)

<pre class="brush:js">&lt;script type="text/javascript" src="jquery.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="jquery.font.mini.js"&gt;&lt;/script&gt;</pre>

아래 메서드를 사용하면 true나 false를 반환해 준다.

<pre class="brush:js">$.font.test('맑은 고딕')</pre>

그러니까, 아래와 같은 형태로 활용하면 된다.

<pre class="brush:js">if($.font.test('맑은 고딕'))</pre>

## 사용법 : font.js

이것도 사용법이 아주 간단하다. 위처럼 script 태그로 자기 페이지에 집어넣고,

<pre class="brush:html">&lt;script type="text/javascript" src="font.js"&gt;&lt;/script&gt;</pre>

font.setup() 메서드로 세팅을 한다.

근데 이 setup() 메서드는 페이지가 모두 로드된 다음(정확히 말하면 DOM을 모두 불러온 다음)에 사용해야 하는 것 같다.

따라서 jquery가 제공하는 다음 메서드를 사용하면 좋다.

<pre class="brush:js">$(document).ready(function () {
  font.setup(); // run setup when the DOM is ready
});</pre>

혹은 아래처럼 해도 이미지를 제외한 페이지를 모두 로딩하면 자바스크립트를 실행한다. (이게 더 편하다.)

<pre class="brush:js">$(function () {
  font.setup(); // run setup when the DOM is ready
});</pre>

그리고 나서

<pre class="brush:js">font.isInstalled('맑은 고딕'); // returns true or false</pre>

이렇게 메서드를 사용하면 된다.

그러면 true나 false를 반환해 준다.

그럼 이만.