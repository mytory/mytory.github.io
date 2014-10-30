---
title: ckeditor의 checkDirty()와 resetDirty()는 무엇인가?
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/219
aktt_notify_twitter:
  - yes
daumview_id:
  - 37146171
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
<a href="http://mytory.textcube.com/entry/ckeditor-%EC%9E%90%EB%B0%94%EC%8A%A4%ED%81%AC%EB%A6%BD%ED%8A%B8%EB%A1%9C-%EB%82%B4%EC%9A%A9-%EC%A7%91%EC%96%B4%EB%84%A3%EA%B8%B0%EC%A0%84%EC%B2%B4-%EB%82%B4%EC%9A%A9-%EB%B0%94%EA%BE%B8%EA%B8%B0" target="_blank">ckeditor, 자바스크립트로 내용 집어넣기(전체 내용 바꾸기)</a>에서 <a href="http://ckeditor.com/download" target="_blank">다운</a>받으면 나오는 _samples의 API를 보면 몇몇 API는 쉽게 볼 수 있다고 썼다.

ckeditor/_samples/api.html 가 바로 그 API 페이지다. 여기에는 checkDirty와 resetDirty라는 버튼이 있다.

이건 뭔고하니, 간단하다. 페이지에 변화가 있었는지 없었는지 체크하는 것이다. 변화가 있었다면 true, 없었다면 false를 반환한다. 수정하러 들어왔다가 아무 것도 수정하지 않고 돌아간다면 굳이 submit할 필요가 없을 테니 그럴 때 사용하는 것 아닐까? 아니면 ajaxAutoSave 같은 걸 만들 때 사용하거나.

각 버튼에 바인드된 함수 코드는 아래와 같다.

<pre class="brush:js">function CheckDirty()
{
	// 원하는 에디터 인스턴스를 고른다.
	var oEditor = CKEDITOR.instances.textarea_id;
	alert( oEditor.checkDirty() );
}

function ResetDirty()
{
	// 원하는 에디터 인스턴스를 고른다.
	var oEditor = CKEDITOR.instances.textarea_id;
	oEditor.resetDirty();
	alert( &#039;IsDirty 상태가 리셋됐습니다.&#039; );
}
</pre>

ResetDirty를 하고 나서 CheckDirty를 하면, 아무것도 변하지 않았다는 의미로 false라고 나온다.

아작스 오토 세이브 같은 걸 한 다음 ResetDirty 함수를 실행하면 사용자들이 자기 데이터가 저장됐는지 안 됐는지 알 수 있을 것이다.