---
title: '[Ubuntu Family] 터미널에서 하드디스크 UUID 구하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1669
aktt_notify_twitter:
  - yes
daumview_id:
  - 36684943
categories:
  - 기타
tags:
  - Ubuntu Family
---
uuid가 필요할 때가 있다. 터미널에서 하드를 마운트하거나 할 때다.

하드디스크를 마운트하고 ROOT 권한으로 노틸러스에 들어가면 하드디스크 레이블이 1C62E85462E833E4 이런 식으로 나온다. 이게 하드디스크의 UUID다.

하지만 터미널에선 이놈을 알 길이 없다는?

아니다. 있다.

아래 명령어를 그대로 쳐 주면 된다. 자기 환경에 맞춰서 바꿔 주고 할 거 없다. 그대로 치면 된다. 그대로! 복사해서!

<pre>ls -l /dev/disk/by-uuid</pre>

그러면 아래와 같은 문자열이 나온다.

<pre>total 0
lrwxrwxrwx 1 root root 10 2011-08-11 12:42 1C62E81111E833E4 -&gt; ../../sda2
lrwxrwxrwx 1 root root 10 2011-08-11 12:42 56e9d5f8-1111-4ffc-b02c-9a5b6f3d121a -&gt; ../../sda5</pre>