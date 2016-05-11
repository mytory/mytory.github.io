---
title: fckeditor, 디폴트 파일매니저에서 이미지 썸네일 보이게 하는 방법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/28
aktt_notify_twitter:
  - yes
daumview_id:
  - 37264749
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
나는 이 방법을 사용하지 않는다. 너무 리소스를 많이 먹기 때문이다. 파일이 수십개씩 폴더에 들어있는 상황에서 모든 이미지를 로드하는 것은 별로 안 좋은 것 같다.(2010.3.14 추가)

&#8212;&#8212;&#8212;&#8212;&#8212;-

먼저 말해두지만 이 방법은 **편법**이다. 사용할 사람만 사용하기 바란다.

fckeditor의 버전은 2.6.4.1이다.

이 방법을 사용하고 나면 다음과 같이 파일매니저 화면이 변한다.

<span class="Apple-style-span" style="background-color: rgb(248, 248, 248);"><img src="/uploads/legacy/old-images/1/cfile22.uf.18571F474D4BC8631C8C30.gif" class="aligncenter" width="540" height="368" alt="" /></span>

들어있는 파일이 이미지일 경우에는 좌측에 썸네일이 뜬다.

그러나 ㅡㅡ;; 그냥 파일일 경우에는 십중팔구 깨질 것이다. 아마도 엑박이 뜰텐데, 그걸 감수하고 이 방법을 사용하겠다면 좋다.

(난 그렇게 사용하고 있다. 이미지 썸네일을 보여 주는 플러그인을 찾았는데 잘 작동하지 않고, 그걸 잘 커스터마이징하기엔 내 실력이 부족하고&#8230; 그래서 아쉬운대로 대충 고쳐서 사용하기로 했다.)

한 가지 더 말하자면, 썸네일을 생성하는 게 아니라 img 태그에서 그냥 줄여버린 것이다. 이게 의미하는 바는? 파일매니저 폴더에 있는 그림파일을 전부 다운로드하는 결과를 낳는다는 것이다. 이미지 파일 10여개 있으면 상관 없겠지만, 1000개쯤 있으면 그걸 모두 다운로드해야 썸네일이 보인다는 말씀. 그러니까 그런 경우에도 이 방법을 사용하면 안 된다.

서두가 길었다. 방법은 간단하다.

<span style="color: rgb(255, 0, 0);"><strong>fckeditor\editor\filemanager\browser\default\frmresourceslist.html</strong></span> 을 연다.

아래 코드를 찾는다.

<pre title="code" class="brush: jscript;first-line: 62; ">oListManager.GetFileRowHtml = function( fileName, fileUrl, fileSize )&lt;br /&gt;{&lt;br /&gt;   (생략)&lt;br /&gt;}</pre>

코드를 이렇게 고친다.

<pre title="code" class="brush: jscript;first-line: 62; highlight: [69,70]; ">oListManager.GetFileRowHtml = function( fileName, fileUrl, fileSize )&lt;br /&gt;{&lt;br /&gt;	// Build the link to view the folder.&lt;br /&gt;	var sLink = &#039;&lt;a href="#" onclick="OpenFile(\&#039;&#039; + ProtectPath( fileUrl ) + &#039;\&#039;);return false;"&gt;&#039; ;&lt;br /&gt;	// Get the file icon.&lt;br /&gt;	var sIcon = oIcons.GetIcon( fileName ) ;&lt;br /&gt;	return &#039;&lt;tr&gt;&#039; +&lt;br /&gt;			&#039;&lt;td width="70"&gt;&#039;+sLink+&#039;&lt;img src="&#039; + ProtectPath( fileUrl ) + &#039;" width="70" border="0"&gt;&lt;\/a&gt;&#039; +&lt;br /&gt;			&#039;&lt;\/td&gt;&#039; +&lt;br /&gt;			&#039;&lt;td width="16"&gt;&#039; +&lt;br /&gt;				sLink +&lt;br /&gt;				&#039;&lt;img alt="" src="images/icons/&#039; + sIcon + &#039;.gif" width="16" height="16" border="0"&gt;&lt;\/a&gt;&#039; +&lt;br /&gt;			&#039;&lt;\/td&gt;&lt;td&gt;&amp;nbsp;&#039; +&lt;br /&gt;				sLink +&lt;br /&gt;				fileName +&lt;br /&gt;				&#039;&lt;\/a&gt;&#039; +&lt;br /&gt;			&#039;&lt;\/td&gt;&lt;td align="right" nowrap&gt;&amp;nbsp;&#039; +&lt;br /&gt;				fileSize +&lt;br /&gt;				&#039; KB&#039; +&lt;br /&gt;		&#039;&lt;\/td&gt;&lt;\/tr&gt;&#039; ;&lt;br /&gt;}</pre>

원래대로 돌리고 싶다면? 69,70번째 줄을 지우거나 주석처리하면 된다.

끝.