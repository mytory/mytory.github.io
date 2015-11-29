---
title: '[TIP] 크롬 확장, iReader 한글 글꼴 고치기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10219
categories:
  - 기타
tags:
  - TIP
---

2015-11-29 추가: 크롬이 버전 33부터 사용자 스타일시트를 제거하면서 방법이 없게 됐다. 아래는 혹시 아이디어를 얻을 사람들이 있나 해서 남겨 둔 것이다.

--------------

크롬 확장인 iReader는 본문만 뽑아서 글을 읽을 수 있게 해 주는 좋은 녀석이다. 그런데 문제는 한글 글꼴이 굴림으로 나온다는 점이다. 고를 수 있는 글꼴 목록에 한글 글꼴은 있지도 않다. 안 되면 직접 쓰게라도 해 주던가!

여튼, 나는 퍼블리싱을 해야 하니 모든 웹사이트의 글꼴을 맑은 고딕으로 만들 수는 없고 iReader의 글꼴만 맑은 고딕으로 만들고 싶은데, 방법이 없나 하던 찰나, 크롬의 유저 스타일시트에 iReader의 선택자만 넣어서 맑은 고딕으로 만들면 되겠다 하는 생각이 들었다. 그래서 유저 스타일시트에 이렇게 넣었다.

<pre>#articleContainer #article .page .contentWrapper * {
  font-family: Arial, "Malgun Gothic", "맑은 고딕";
}</pre>

[후략...]