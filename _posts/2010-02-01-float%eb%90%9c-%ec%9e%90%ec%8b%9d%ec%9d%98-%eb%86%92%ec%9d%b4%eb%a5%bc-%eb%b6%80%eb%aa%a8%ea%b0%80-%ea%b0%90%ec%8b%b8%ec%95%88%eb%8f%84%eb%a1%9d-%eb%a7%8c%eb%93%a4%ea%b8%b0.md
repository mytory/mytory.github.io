---
title: float된 자식의 높이를 부모가 감싸안도록 만들기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/245
aktt_notify_twitter:
  - yes
daumview_id:
  - 37113975
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
CSS에서 디자인을 하다가 float된 요소를 자식으로 품고 있는 부모가 같이 float되지 않은 경우 자식이 부모 밖으로 튀어나가는 경우를 볼 수 있다. 아래처럼 말이다.

<div style="width: 500ox; padding: 20px; background: gold;">
  <p>
    부모
  </p>
  
  <div style="width: 400px; height: 100px; float: left; background: skyblue;">
    자식
  </div>
</div>

<p style="clear: both;">
  이런 경우 대응법을 총망라한 글을 발견했다. 짱이다.
</p>

<p style="clear: both;">
  원래는 원문을 퍼다놨었지만, 다 지웠다. ㅋ 보고 싶은 분들은 원문 링크를 타고 가서 보시길!
</p>

<p style="text-align: center;">
  <strong><a href="http://naradesign.net/wp/2008/05/27/144/">▶float을 clear하는 4가지 방법</a></strong>
</p>