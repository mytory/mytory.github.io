---
title: '[Sass] 컴파일시 UTF-8 인코딩 문제 해결 error common.sass (Line 20: Invalid CP949 character &#8220;\xEC&#8221;)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9653
daumview_id:
  - 41779904
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - Sass
---
**요약 : 컴파일시 옵션에 `-E UTF-8` 이라고 써 준다.**

맥에서는 잘만 작동하던 `sass --watch`가 윈도우7에서 에러를 뿜었다. 에러 메시지는 아래와 같았다.

<pre>error common.sass (Line 20: Invalid CP949 character "\xEC")</pre>

sass 원본 파일이 UTF-8로 돼 있었고, 한글로 // 주석을 붙여 놨었는데, 그것 때문에 발생한 문제였다. 윈도우에서 기본 인코딩이 CP949니까 이런 에러가 발생한 듯 싶다.

검색을 했고, 찾았다. [How to let Sass permanently output UTF-8 CSS files on Windows][1] 라는 글이었다. 비슷한 문제를 곳곳에서 겪나 보다.

인코딩 옵션에 `-E UTF-8` 이라고 주는 게 해결책이다.

그래서 풀 명령어 예시는 이렇게 된다. 당연히 파일명과 다른 옵션들은 알아서 하면 된다.

<pre>sass --watch -E -UTF-8 common.sass:common.css</pre>

 [1]: https://groups.google.com/forum/?fromgroups=#!msg/sass-lang/lHpKGGi9eWY/qnfKlw3Jx2wJ