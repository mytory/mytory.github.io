---
title: 'ie6에서 margin: auto 하면 문제가 있다'
author: 안형우
layout: post
permalink: /archives/622
aktt_notify_twitter:
  - yes
daumview_id:
  - 36911385
categories:
  - 웹 퍼블리싱
tags:
  - IE:인터넷 익스플로러
---
margin: auto;   
이렇게 쓰면, margin을 자동으로 정할 것이라고 생각하고 사용하는 것 같은데, ie6에서 안 그럴 수도 있다.  
width가 900px인 박스에 width200, 700px인 div 박스를 넣고 margin: auto, float: left와 float:right 를 주면 한 줄에 안 들어간다. 뒤에 있는 박스가 아래로 떨어진다. 주의 요망.