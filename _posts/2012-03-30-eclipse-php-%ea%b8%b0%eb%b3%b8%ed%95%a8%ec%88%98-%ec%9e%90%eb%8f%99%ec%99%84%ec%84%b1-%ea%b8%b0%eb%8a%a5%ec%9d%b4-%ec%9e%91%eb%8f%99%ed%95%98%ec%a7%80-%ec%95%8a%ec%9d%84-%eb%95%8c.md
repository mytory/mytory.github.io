---
title: '[eclipse] PHP 기본함수 자동완성 기능이 작동하지 않을 때'
author: 안형우
layout: post
permalink: /archives/2390
aktt_notify_twitter:
  - yes
daumview_id:
  - 36613050
categories:
  - 개발 툴
tags:
  - Eclipse
---
이 방법은 늘 맞는 방법은 아니고, 프로젝트가 PHP 프로젝트가 아니게 됐을 때 사용할 수 있는 방법이다.

어느 순간 str_ 이라고 치고 Ctrl+Space 를 눌러도 자동완성 기능이 작동하지 않았다. .buildpath가 망가져 더이상 PHP를 참조하지 않게 됐기 때문이다.

프로젝트 폴더에 있는 .buildpath 파일을 열어서, xml의 `<buildpath>` 항목 안에 아래 줄을 추가해 준다.

<pre>&lt;buildpathentry kind="con" path="org.eclipse.php.core.LANGUAGE"/&gt;</pre>

그럼 결과적으로 아래처럼 될 거다.

<pre class="brush: xml; gutter: true; first-line: 1; highlight: [4]">&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;buildpath&gt;
 &lt;buildpathentry kind="src" path=""/&gt;
 &lt;buildpathentry kind="con" path="org.eclipse.php.core.LANGUAGE"/&gt;
 &lt;buildpathentry combineaccessrules="false" kind="prj" path="/CI_CodeBase"/&gt;
 &lt;!-- ... --&gt;
&lt;/buildpath&gt;</pre>

<p class="brush: xml; gutter: true; first-line: 1">
  참고 : <a href="http://www.eclipse.org/forums/index.php/mv/msg/204772/671639/#msg_671639">Re: Configure &#8220;PHP Language library&#8221;</a>
</p>