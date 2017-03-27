---
title: ckeditor, 자바스크립트로 내용 집어넣기(전체 내용 바꾸기)
author: 안형우
layout: post
permalink: /archives/217
aktt_notify_twitter:
  - yes
daumview_id:
  - 37149575
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
웹에디터를 커스터마이징하기 위해서 내용을 제어할 수 있어야 할 것이다. 앞서 &#8216;선택&#8217;하는 방법을 썼다. 이번에는 내용을 집어넣는 방법이다.

<pre class="brush:js">CKEDITOR.instances.textarea_id.setData(&#039;&lt;p&gt;집어넣을 데이터&lt;/p&gt;&#039;)
//textarea_id는 당연히 각자 상황에 맞는 이름으로.
</pre>

<span role="presentation" class="objectBox objectBox-text ">전체 내용을 가져오는 방법이 getData()다. 거기서 착안해 setData로 해봤더니 작동한다.</span>

내가 궁금한 것은 커서가 위치한 곳에 특정한 element를 집어넣는 방법, 선택한 영역을 특정 오브젝트로 치환하는 방법이다. 더 알아보면 되겠지.

굳이 첨언하자면, ckeditor 안에 있는 내용을 태그 포함해서 다 가져오는 함수는 아래와 같다.

<pre class="brush:js">CKEDITOR.instances.textarea_id.getData()
</pre>