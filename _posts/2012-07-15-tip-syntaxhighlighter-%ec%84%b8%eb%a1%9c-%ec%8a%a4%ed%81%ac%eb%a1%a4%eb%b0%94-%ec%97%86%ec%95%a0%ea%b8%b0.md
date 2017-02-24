---
title: '[Tip] SyntaxHighlighter 세로 스크롤바 없애기'
author: 안형우
layout: post
permalink: /archives/3050
aktt_notify_twitter:
  - no
daumview_id:
  - 36578550
categories:
  - 기타
tags:
  - TIP
---
나는 블로그에 있는 코드를 읽기 좋게 하기 위해 [alexgorbatchev의 SyntaxHighlighter][1]를 사용한다. (워드프레스 [WP SyntaxHighlighter 플러그인][2]을 설치해서 사용하고 있다.)

그런데 늘 세로 스크롤바가 거슬렸다.

<img class="aligncenter" src="https://mytory.net/uploads/legacy/code-syntax-highlight-vertical-scrollbar.png" alt="" width="778" height="191" />

그래서 어느 날 세로 스크롤바를 없애기로 마음먹었다. 생각보다 간단했다. 스타일(`style.css`)에 아래 코드를 추가했더니 말끔히 해결.

<pre class="brush: css; gutter: true; first-line: 1">.syntaxhighlighter{
	padding: 5px 0;
}</pre>

 [1]: http://alexgorbatchev.com/SyntaxHighlighter/
 [2]: http://wordpress.org/extend/plugins/wp-syntaxhighlighter/