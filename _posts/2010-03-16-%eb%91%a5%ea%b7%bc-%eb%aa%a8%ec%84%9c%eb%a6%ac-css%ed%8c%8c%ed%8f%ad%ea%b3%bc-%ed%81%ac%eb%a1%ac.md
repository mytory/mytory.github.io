---
title: 둥근 모서리 CSS(파폭과 크롬)
author: 안형우
layout: post
permalink: /archives/416
aktt_notify_twitter:
  - yes
daumview_id:
  - 37001313
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
다들 아는 거겠지만 소스 긁기 쉽게 갈무리한다.

일단 소스부터.

<pre class="brush:css">-moz-border-radius: 10px; 
-webkit-border-radius: 10px;</pre>

위처럼 하면 반지금 10px로 모서리를 둥글게 처리한다. -moz-가 붙은 게 모질라 엔젠(즉, 파이어폭스 등)에서 지원하는 것이고, -webkit-이 붙은 게 웹킷 엔진(즉, 크롬과 사파리 등)에서 지원하는 것이다.

위 CSS는 각각 아래처럼 각 모서리별로 다르게 사용할 수 있다. 이 표는 <a target="_blank" href="http://www.the-art-of-web.com/css/border-radius/">CSS: border-radius and -moz-border-radius</a>에서 퍼온 것이다.

<table class="collapse" style="margin: 1em auto;" cellpadding="5">
  <tr>
    <th style="padding-right: 2em;">
      CSS3 (아직 사용 불가)
    </th>
    
    <th>
      모질라 엔진(파폭 등)
    </th>
    
    <th>
      웹킷 엔진(크롬,사파리 등)
    </th>
  </tr>
  
  <tr>
    <td>
      border-top-right-radius
    </td>
    
    <td>
      -moz-border-radius-topright
    </td>
    
    <td>
      -webkit-border-top-right-radius
    </td>
  </tr>
  
  <tr>
    <td>
      border-bottom-right-radius
    </td>
    
    <td>
      -moz-border-radius-bottomright
    </td>
    
    <td>
      -webkit-border-bottom-right-radius
    </td>
  </tr>
  
  <tr>
    <td>
      border-bottom-left-radius
    </td>
    
    <td>
      -moz-border-radius-bottomleft
    </td>
    
    <td>
      -webkit-border-bottom-left-radius
    </td>
  </tr>
  
  <tr>
    <td>
      border-top-left-radius
    </td>
    
    <td>
      -moz-border-radius-topleft
    </td>
    
    <td>
      -webkit-border-top-left-radius
    </td>
  </tr>
  
  <tr>
    <td>
      border-radius
    </td>
    
    <td>
      -moz-border-radius
    </td>
    
    <td>
      -webkit-border-radius
    </td>
  </tr>
</table>

역시 축약형도 있다.

<pre class="brush:css">-moz-border-radius: 10px 0 0 10px;
-webkit-border-radius 10px 0 0 10px;</pre>

이렇게 쓰면 왼쪽위와 왼쪽아래만 둥글게 처리된다.

즉, 처음부터 왼쪽위/오른쪽위/오른쪽아래/왼쪽아래 순으로 시계방향으로 돌리면서 적용된다.