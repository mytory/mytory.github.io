---
title: Javascript로 문서 수정하기(DOM Script) 간단 예제
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/41
aktt_notify_twitter:
  - yes
daumview_id:
  - 37262489
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
다음 내용은 O\`relly 시리즈 중 하나인 <a href="http://www.insightbook.co.kr/books/programming-insight/%EC%9E%90%EB%B0%94%EC%8A%A4%ED%81%AC%EB%A6%BD%ED%8A%B8-%EC%99%84%EB%B2%BD-%EA%B0%80%EC%9D%B4%EB%93%9C" target="_blank">《자바스크립트 완벽 가이드》(인사이트)</a>의 한국어판 435페이지를 변용하여 옮긴 것이다. 너무나 알고 싶었던 기능이라서 한참 동안 읽다가 바로 메모하기로 결정!

소스를 보면 다 알 것이므로 설명은 생략한다. 다만, 저 책은 자바스크립트를 공부하고 싶은 사람들에겐 무조건 강추다. 끝.

<pre title="code" class="brush: jscript;">&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
 &lt;head&gt;
  &lt;title&gt;textNode Test&lt;/title&gt;
  &lt;meta http-equiv="content-type" content="text/html;charset=utf-8" /&gt;
  &lt;meta name="author" content="ahw" /&gt;
  &lt;meta name="keywords" content="textNode" /&gt;
  &lt;meta name="description" content="textNode control example." /&gt;
  &lt;script type="text/javascript"&gt;
  //이 함수는 Node n을 전달인자로 받고, 이 노드를 HTML &lt;strong&gt; 태그를 표현하는 Element 노드로 교체한 후 기존 노드를 새로 만든 &lt;strong&gt; 엘리먼트의 자식으로 만든다.
  function emStrongly(n){
	if (typeof n == "string") n = document.getElementById(n); //노드를 조사한다.
	var s = document.createElement("strong"); //새로운 &lt;strong&gt; 엘리먼트를 생성.
	var parent = n.parentNode; //주어진 노드의 부모를 얻는다.
	parent.replaceChild(s, n); //주어진 노드를 &lt;strong&gt; 태그로 교체한다.
	s.appendChild(n);
  }
  &lt;/script&gt;
 &lt;/head&gt;

 &lt;body&gt;
  &lt;!-- 두 개의 샘플 문단 --&gt;
  &lt;p id="p1"&gt;이것은 &lt;i&gt;문단&lt;/i&gt; 1입니다.&lt;/p&gt;
  &lt;p id="p2"&gt;이것은 &lt;i&gt;문단&lt;/i&gt; 2입니다.&lt;/p&gt;
  &lt;!-- emStrongly() 함수를 p1이라는 엘리먼트에 대해 호출하는 버튼 --&gt;
  &lt;button onclick="emStrongly2(&#039;p1&#039;);"&gt;EmStrongly&lt;/button&gt;
 &lt;/body&gt;
&lt;/html&gt;</pre>

&nbsp;