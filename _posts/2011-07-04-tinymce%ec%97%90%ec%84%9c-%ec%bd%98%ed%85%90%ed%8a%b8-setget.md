---
title: tinymce에서 콘텐트 set/get
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1419
aktt_notify_twitter:
  - yes
daumview_id:
  - 36706003
categories:
  - 서버단
tags:
  - API
---
[tinymce][1]는 [ckeditor][2]와 더불어 가장 대중적인 위지윅 에디터다.

이놈의 내용을 제어가는 가장 기본적인 명령어를 알아 본다.

jQuery 어답터를 사용했을 때 예시다.

## 콘텐트를 넣는다

이 때 원래 있던 것은 지워진다.

<pre>$(&#039;textarea[name=my_editor]&#039;).tinymce().setContent(&#039;&lt;p&gt;안녕하세요&lt;/p&gt;&#039;);</pre>

## 콘텐트를 얻는다

<pre>$(&#039;textarea[name=my_editor]&#039;).tinymce().getContent();</pre>

## API

API는 여기 있다 : <http://tinymce.moxiecode.com/wiki.php/API3:class.tinymce.Editor>

 [1]: http://tinymce.moxiecode.com/
 [2]: http://ckeditor.com/demo