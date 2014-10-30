---
title: svn log 특정 기간으로 검색
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/793
aktt_notify_twitter:
  - yes
daumview_id:
  - 36784673
categories:
  - 개발 툴
tags:
  - SVN
---
svn에 log를 충실히 기록했다면, 그동안 작업팀이 어떤 작업을 해 왔는지 쉽게 알 수 있다.

지난 한 달간 나는 뭐 했나 하는 실의에 빠지지 않을 수 있다.

특히 잡무에 시달리며 정신없이 지나간 때라면 더더욱!

그럼, 2010년 10월 23일부터 2010년 12월 15일 기간의 svn log를 보자. 콘솔에 아래와 같이 써 준다. 아, 자신의 작업 사본 디렉토리에 있어야 한다.

<pre class="brush:plain">svn log -r {2010-10-23}:{2010-12-15}</pre>

쉽다. 하지만 외우지 않으면 어렵다. 난 외우기 힘들어서 기록해 둔다.

<pre>svn log -r {2010-10-23}:{2010-12-15} -v</pre>

이렇게 쓰면 변경된 파일을 볼 수 있다.