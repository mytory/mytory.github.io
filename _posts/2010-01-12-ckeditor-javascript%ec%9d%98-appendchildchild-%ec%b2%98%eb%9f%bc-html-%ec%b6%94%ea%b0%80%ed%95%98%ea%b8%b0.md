---
title: ckeditor, javascript의 appendChild(child) 처럼 html 추가하기
author: 안형우
layout: post
permalink: /archives/218
aktt_notify_twitter:
  - yes
daumview_id:
  - 37147977
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
<a href="http://mytory.textcube.com/entry/ckeditor-%EC%9E%90%EB%B0%94%EC%8A%A4%ED%81%AC%EB%A6%BD%ED%8A%B8%EB%A1%9C-%EB%82%B4%EC%9A%A9-%EC%A7%91%EC%96%B4%EB%84%A3%EA%B8%B0%EC%A0%84%EC%B2%B4-%EB%82%B4%EC%9A%A9-%EB%B0%94%EA%BE%B8%EA%B8%B0" target="_blank">ckeditor, 자바스크립트로 내용 집어넣기(전체 내용 바꾸기)</a>에서 전체 내용을 바꾸지 않고 html을 추가하는 방법이 궁금하다고 썼는데, API만 뒤지다가 삽질한 것 같다. ckeditor를 다운로드하면 기본으로 제공하는 samples에 기본적으로 사용할 수 있는 API가 있었다. 코드는 아래와 같다.

<pre class="brush:js">function InsertHTML()
{
	// 원하는 에디터의 인스턴스를 가져온다.
	var oEditor = CKEDITOR.instances.editor1;
	var value = &#039;넣고 싶은 텍스트&#039;;

	// Check the active editing mode.
	if ( oEditor.mode == &#039;wysiwyg&#039; )
	{
		// Insert the desired HTML.
		oEditor.insertHtml( value );
	}
	else
		alert( &#039;위지윅 모드여야 가능합니다!&#039; );
}
</pre>

생각보다 쉬웠다.

위 코드대로 하면 커서가 있는 곳에 value가 들어가게 된다.

value는 그냥 텍스트여도 되고, html이어도 된다. 

html이면 html로 들어가고, text면 알아서 html처리를 한 다음 들어간다. 

선택영역이 있으면 선택영역을 대체하면서 들어간다. 즉, 에디터에 내용을 채울 때 이게 핵심이다.

따라서 여러 가지로 테스트해 보기 바란다.