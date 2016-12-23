---
title: '[CSS] 박스 쉐도우 box-shadow 그림자 넣기'
author: 안형우
layout: post
permalink: /archives/637
aktt_notify_twitter:
  - yes
daumview_id:
  - 36897621
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
정찬명 님의 블로그에 갔더니 <a href="http://naradesign.net/css3/" target="_blank">9 Useful CSS3 Properties</a> 라는 글이 있었다. 그 중 인상깊은 놈 하나를 퍼왔다. 나머지도 보고 싶다면 직접 글을 보기 바란다.

CSS3긴 하지만, 지금도 당장 사용할 수 있다.

<pre class="brush:css">/* Opera */
box-shadow:10px 10px 10px silver;

/* Firefox */
-moz-box-shadow:10px 10px 10px silver;

/* Safiri, Chrome */
-webkit-box-shadow:10px 10px 10px silver;

/* IE */
filter:progid:DXImageTransform.Microsoft.Shadow(color=silver,direction=135, strength=20);</pre>

이렇게 쓰면 아래처럼 나온다고 한다.

<div style="width: 590px" class="wp-caption aligncenter">
  <a href="http://naradesign.net/css3/"><img class="  " src="/uploads/legacy/old-images/1/cfile29.uf.1448044A4D4BC94B20DFEB.png" alt="css3 box-shadow를 적용한 모습" width="580" height="326" /></a><p class="wp-caption-text">
    이거 참 괜찮은 효과다. 정찬명 님의 나라디자인 블로그에 가면 더 많은 것을 볼 수 있다. 그림을 클릭하면 이동한다.
  </p>
</div>

나중에 디자인할 때 꼭 써먹어 봐야겠다.