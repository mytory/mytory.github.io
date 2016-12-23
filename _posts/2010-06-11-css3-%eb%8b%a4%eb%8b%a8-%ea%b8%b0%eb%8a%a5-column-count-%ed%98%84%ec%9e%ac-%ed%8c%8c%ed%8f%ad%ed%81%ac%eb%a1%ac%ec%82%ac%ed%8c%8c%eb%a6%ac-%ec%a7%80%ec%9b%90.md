---
title: '[CSS3] 다단 기능 column-count : 현재 파폭,크롬,사파리 지원'
author: 안형우
layout: post
permalink: /archives/673
aktt_notify_twitter:
  - yes
daumview_id:
  - 36868213
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - CSS3
---
어제 이야기를 나누다가 획기적인 발견(?)을 했다. 바로 다단 기능을 HTML에서 곧장 지원한다는 사실을 알게 된 것이다.

나는 얼마 전 알게 된, CSS3와 HTML5의 요소를 지원하는 최신 브라우저들이 은근 많으므로 지원을 시작하는 족족 활용할 수 있다는 것을 떠올렸다.

그리고 바로 검색에 들어갔다. 쉽게 찾을 수 있었다.

사용법은 간단했다.

<pre class="brush:css">.content {
    /* Column-count는 아직 구현되지 않았다. */
    -moz-column-count: 2;
    -webkit-column-count: 2;  

    /* Column-gap은 아직 구현되지 않았다. */
    -moz-column-gap: 22px;
    -webkit-column-gap: 22px;
}</pre>

이렇게 간단할 수가.

## 활용도

사실, 다단은 화면에서 보는 용도로는 많이 사용하지 않을 수도 있다.

하지만 인쇄할 때는 얘기가 다르다.

공간을 효율적으로 사용할 수 있는 대표적인 방법이 다단이고, 나는 긴 글을 인쇄할 때 항상 다단을 이용했다.

그래서 내가 개인적으로 구축해 두고 사용하는, ckeditor를 이용한 word 시스템에 이 다단 기능을 당장 도입하기로 결심했다.

나는 인쇄할 때 보통 파폭을 사용하기 때문에 다단 기능을 충분히 활용할 수 있다.(현재 오페라는 지원하지 않고 있으며, 파폭과 크롬, 사파리가 지원한다.)

땡큐 CSS3.

## 참고

<div>
  <ul>
    <li>
      <a href="http://net.tutsplus.com/tutorials/html-css-techniques/html-5-and-css-3-the-techniques-youll-soon-be-using/" target="_blank">HTML5와 CSS3: 곧 사용하게 될 것(HTML 5 and CSS 3: The Techniques You’ll Soon Be Using)</a>
    </li>
    <li>
      <a href="http://www.evotech.net/blog/2010/02/css3-columns-browser-support/" target="_blank">CSS3 다단과 지원 브라우저(CSS3 Columns & Browser Support)</a>
    </li>
    <li>
      <a href="http://www.evotech.net/blog/2009/05/css-properties-values-and-browser-support/" target="_blank">CSS3 프로퍼티와 값, 그리고 지원 브라우저(CSS3 Properties, Values & Browser Support)</a>
    </li>
    <li>
      <a href="http://www.normansblog.de/demos/browser-support-checklist-css3/">Browser Support Checklist CSS3</a>
    </li>
  </ul>
</div>