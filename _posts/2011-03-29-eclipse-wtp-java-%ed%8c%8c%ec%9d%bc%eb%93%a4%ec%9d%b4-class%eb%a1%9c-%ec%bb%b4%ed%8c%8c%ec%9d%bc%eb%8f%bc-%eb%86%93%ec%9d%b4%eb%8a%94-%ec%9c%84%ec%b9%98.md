---
title: '[Eclipse WTP] java 파일들이 class로 컴파일돼 놓이는 위치'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1027
aktt_notify_twitter:
  - yes
daumview_id:
  - 36759010
categories:
  - 개발 툴
tags:
  - Eclipse
---
이클립스가 java 파일을 class로 제대로 컴파일하지 않는 줄 알았다. FTP에 class 파일을 아무리 올려도 제대로 작동하지 않았기 때문이다.

알고 봤더니 내가 컴파일 결과물의 위치를 잘못 알고 있었던 것이었다.

eclipse 프로젝트의 최상위 폴더(workspace/projectName 폴더를 말한다)에는 .classpath 라는 파일이 있다. (우분투 사용자라면 .으로 시작하는 파일은 숨김파일이니 Ctrl+H 키를 눌러서 보이게 만들기 바란다.)

그 파일을 열면 대략 아래와 같은 모양이 보일 거다.

<pre class="brush:xml">&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;classpath&gt;
  &lt;classpathentry kind="src" path="src"/&gt;
  &lt;!-- 중략 --&gt;
  &lt;classpathentry kind="output" path="build/classes"/&gt;
&lt;/classpath&gt;</pre>

위에서 kind가 output으로 돼 있는 놈을 봐야 한다. 바로 저 경로에 class 들이 컴파일돼 놓이게 된다.

거기에 가면 깔끔한 class들을 만날 수 있는 것이다.

난 괜히 [.metadata에 들어가서 찾는 삽질][1]을 했던 것이다. ㅠ.ㅠ

(아, jsp가 컴파일된 것을 찾으려면 또 다른 데를 뒤져야 한다.)

참고로, 패키지 익스플로러에서 저 위치는 사라지게 된다. 아래 그림처럼, 경로만 나오고 파일이 표시되지 않거나, 그냥 경로가 통째로 사라지거나 한다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/eclipse-build.png" alt="" width="223" height="154" />
</p>

 [1]: http://mytory.net/archives/770 "[java]이클립스 WTP 사용시 실제 WebContent 경로"