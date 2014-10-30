---
title: '[eclipse] Ctrl + Shift + F 로 코드 정리할 때 줄바꿈 길게 하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/287
aktt_notify_twitter:
  - yes
daumview_id:
  - 37072886
categories:
  - 개발 툴
tags:
  - Eclipse
---
난 코드가 깔끔한 걸 좋아하기 때문에 이클립스의 코드 정리 기능을 자주 사용한다.

그런데 한 가지 불만은 한 줄에 들어가는 길이가 너무 짧은 거다.

줄바꿈이 많으면 정신없다.

줄바꿈 길이를 늘리고 싶다면 <span style="font-weight: bold;">window > preferences > Java > Code Style > Formatter</span> 로 간다.

거기에서 New를 누른다. 자신만의 스타일을 사용하겠다고 알려 주는 것이다. default로 설정돼 있는 것은 Edit할 수 없기 때문에 반드시 New를 눌러야 한다.

그리고 <span style="font-weight: bold;">Line Wrapping</span> 탭에서 <span style="font-weight: bold;">Maximum Line Width</span>를 수정해 준다. 기본은 80이다. 나느 160으로 고쳤다.

아래는 스크린샷.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/eclipse-line-break-1.png" alt="" width="512" height="499" />
</p>

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/eclipse-line-break-2.png" alt="" width="640" height="455" />
</p>