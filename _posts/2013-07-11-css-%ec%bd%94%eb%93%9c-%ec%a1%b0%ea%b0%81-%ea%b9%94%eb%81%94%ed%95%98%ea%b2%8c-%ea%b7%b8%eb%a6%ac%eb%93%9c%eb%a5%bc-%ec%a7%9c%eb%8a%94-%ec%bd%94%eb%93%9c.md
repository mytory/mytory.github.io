---
title: '[CSS 코드 조각] 깔끔하게 그리드를 짜는 코드'
author: 안형우
layout: post
permalink: /archives/10535
daumview_id:
  - 47779165
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
<pre>.l-grid {
    margin: 0;
    padding: 0;
    list-style-type: none;
}
.l-grid &gt; li {
    display: inline-block;
    margin: 0 0 10px 10px;
    /* IE7 hack to mimic inline-block on block elements */
    *display: inline;
    *zoom: 1; 
}</pre>

이 코드는 [SMACSS][1]에 나오는 코드다. `inline-block`으로 썸네일 그리드 같은 것을 깔끔하게 처리한다. `ul`에 `l-grid`라는 클래스를 주면 된다. IE7 이상에서 작동한다. (`.l-grid > li` 를 `.l-grid li`로 변경하면 IE6에서도 작동한다. 하지만 `li` 안에 `li`를 쓸 때 골치아파질 거라는 점을 알고 그렇게 해야 한다.)

 [1]: http://smacss.com/