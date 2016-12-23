---
title: 'Eclipse: Could not initialize class org.eclipse.wst.server.ui.internal.provisional.UIDecoratorManagerCommentsAdd Star'
author: 안형우
layout: post
permalink: /archives/291
aktt_notify_twitter:
  - yes
daumview_id:
  - 37069141
categories:
  - 개발 툴
tags:
  - Eclipse
---
옆으로 치워 놓으면 이상작동하지는 않지만 사람을 매우 짜증나게 만드는 에러, Could not initialize class org.eclipse.wst.server.ui.internal.provisional.UIDecoratorManagerCommentsAdd Star 이걸 해결하는 방법을 좀 모으기로 했다.

자주 일어나는 버그라고 하는데, 명확한 해결책이 있는 건 아니고 다양한 방법이 있다고 한다.

일단 제일 간단한 거는 이클립스 아이콘 속성으로 들어가서 실행명령 뒤에 -clean을 붙여 주는 거다.( <a href="http://54321.textcube.com/7" target="_blank">http://54321.textcube.com/7</a>&nbsp;) 플러그인을 초기화하는 거라고 한다. 그런데 나는 이걸로 안 됐다.

안 되면 오른쪽 상단에 있는 perspective 아이콘에서 Java EE perspective를 보이게 하고 이클립스를 껐다 켜라고 한다. 나는 이것으로도 해결되지 않았다.( <a href="http://d.hatena.ne.jp/falkenhagen/20091030/1256868650" target="_blank">http://d.hatena.ne.jp/falkenhagen/20091030/1256868650</a>&nbsp; )

<p style="text-decoration: line-through;">
  다른 해결책을 아는 사람은 댓글 남겨 주기 바란다.
</p>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />


에러명을 보면 WST의 UI 관련 클래스가 문제를 일으키는 것 같은데 말이다.

<p style="font-weight: bold;">
  2010.2.18 추가
</p>

위 두 가지 조치를 하고 얼마 안 있어 이 증상이 사라졌다. 정확이 어떤 것 덕분에 이 증상이 사라진 것인지는 모르겠다;; 어쨌든 위 두 가지 조치를 해 보면 나처럼 소리소문없이 해결될 수도&#8230;