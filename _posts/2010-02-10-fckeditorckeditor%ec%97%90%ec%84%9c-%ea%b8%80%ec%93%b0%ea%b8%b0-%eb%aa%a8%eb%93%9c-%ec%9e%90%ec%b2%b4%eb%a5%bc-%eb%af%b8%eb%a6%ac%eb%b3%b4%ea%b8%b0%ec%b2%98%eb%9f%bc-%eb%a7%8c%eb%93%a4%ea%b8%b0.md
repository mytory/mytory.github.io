---
title: fckeditor/ckeditor에서 글쓰기 모드 자체를 미리보기처럼 만들기(커스텀 CSS)
author: 안형우
layout: post
permalink: /archives/264
aktt_notify_twitter:
  - no
daumview_id:
  - 37102754
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
많은 사람들이 글쓰기 모드와 실제 보이는 게 같기를 바란다. ckeditor에서는 그렇게 할 수 있다. 물론 fckeditor에서도 할 수 있다.

## config 파일 설정

기본적으로 아래에 나오는 코드를 ckeditor 폴더에 있는 config.js에 써 주면 된다. 그럼 이게 기본 설정이 된다. 아래 코드를 참고하라.

<pre class="brush:js">/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	//여기에 설정 코드를 써 주면 된다.
};</pre>

자신이 만든 커스텀 설정 파일을 사용하고 싶다면 [CKeditor Docs의 customConfig 항목][1]을 참고하면 된다. 본문에서 ckeditor를 생성할 때, 설정 코드를 넣어 줘야 한다.

## ckeditor의 경우

<a href="http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html#.contentsCss" target="_blank">CKeditor Docs의 Content CSS 항목</a>과 <a href="http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html#.bodyClass" target="_blank">Body Class 항목</a>을 참고하면 된다.

일단 에디터에 사용할 css 파일을 아래 코드처럼 지정해 준다. ckeditor의 예제를 그대로 가져왔다.

<pre class="brush:js">//이건 css 파일이 하나일 때
config.contentsCss = &#039;/css/내_스타일.css&#039;;
//이건 css 파일이 두 개일 때
config.contentsCss = [&#039;/css/내_스타일.css&#039;, &#039;/css/또다른_스타일.css&#039;];</pre>

설정을 따로 쓰지 않을 경우 ckeditor 폴더의 contents.css가 기본 스타일이 된다.

그런데 css에는 보통 레이아웃을 위한 class나 id가 함께 있다. 아래 같은 식이라는 것이다.

<pre class="brush:css">.view p { font-size:14px; margin: 20px; }</pre>

하지만 ckeditor에는 view라는 클래스가 들어가있지 않다.

그걸 위해 Body Class 항목이 존재한다. 아래처럼 써 주면 ckeditor의 class가 view가 되므로 실제 보이는 데서 사용하는 css를 그대로 가져다가 ckeditor용으로 사용할 수 있다. class뿐 아니라 id도 가능하다.

<pre class="brush:js">CKEDITOR.config.bodyClass=&#039;view&#039;;
CKEDITOR.config.bodyId=&#039;viewId&#039;;</pre>

## fckeditor의 경우

fckeditor 폴더의 fckconfig.js에서 아래 항목을 찾아서 css파일을 써 주면 된다.

<pre class="brush:js">FCKConfig.EditorAreaCSS = &#039;/css/내_css_파일.css&#039; ;</pre>

ckeditor처럼 fckeditor도 body id와 class를 지정할 수 있다.

마찬가지로 fckconfig.js에서 아래 항목을 채워 주면 된다.

<pre class="brush:js">FCKConfig.BodyId = &#039;bodyIdName&#039; ;
FCKConfig.BodyClass = &#039;bodyClassName&#039; ;</pre>

 [1]: http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html#.customConfig