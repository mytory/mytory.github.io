---
title: 'css positon: fixed'
author: 안형우
layout: post
permalink: /archives/34
aktt_notify_twitter:
  - yes
daumview_id:
  - 37263861
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
아래 css코드는 해당 클래스의 객체를 화면 아래쪽에 고정시킨다. 스크롤을 해도 여전히 그 위치에 있다. 즉, 떠다니는 애들처럼 되는 것이다.

<pre class="brush: css;" title="code">.클래스이름 {
	position: fixed;
	bottom: 0;
	left: 0;
}</pre>

fixed 속성의 특징은 다음과 같다. 일단 오늘 내가 다루면서 알게 된, 알아놓으면 좋을 점에 대해 쓴 거다.

1.  top / left / right / bottom 등으로 위치를 지정해 줘야 한다.
2.  위치를 지정해 주지 않으면 객체의 코드상 위치가 고정될 위치가 된다.(지정하지 않고 해봐라.)
3.  위치를 지정해주면 상위 객체를 무시한 채로 위치를 잡는다. (left:0 으로 놓으면 화면 가장자리에 위치한다.)
4.  너비가 inline처럼 된다. block처럼 만들고 싶다면 width를 지정해 줘야 한다. 그냥 전체 너비로 하고 싶다면 고민할 것 없이 100%로 하라. 그러면 화면 가로사이즈가 된다.(상위 객체의 가로사이즈를 상속받는 게 아니라는 점이 중요하다.)