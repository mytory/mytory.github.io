---
title: ckeditor에서 에디터 인스턴스 접근 방법과 선택 영역 구하는 함수
author: 안형우
layout: post
permalink: /archives/216
aktt_notify_twitter:
  - yes
daumview_id:
  - 37150897
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
ckeditor를 커스터마이징해야 해서 <a target="_blank" href="http://docs.cksource.com/ckeditor_api/index.html">API</a>를 좀 뜯어 봤다.

초보다 보니 눈이 막 돌아간다. 게다가 영어&#8230; OTL;;

하지만 노력해서 몇 가지를 알아 냈다. 메모해 둔다.

일단, 에디터 인스턴스는 이렇게 접근한다.

<pre class="brush:js">CKEDITOR.instances.textarea_id
//textarea_id는 ckeditor를 만든 textarea의 id
//CKEDITOR는 자동으로 만들어진다.
</pre>

여기서 선택한 놈을 고르려면 아래처럼 쓴다.

<pre class="brush:js">CKEDITOR.instances.textarea_id.getSelection().getNative()
</pre>

사실 이게 용도에 맞게 쓴 것인지는 모르겠지만, 선택한 부분을 불러 오긴 한다. 이상.