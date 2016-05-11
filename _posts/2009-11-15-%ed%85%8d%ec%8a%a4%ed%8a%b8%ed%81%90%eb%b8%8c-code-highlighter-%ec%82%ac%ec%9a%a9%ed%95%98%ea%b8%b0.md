---
title: 텍스트큐브 code highlighter 사용하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/84
aktt_notify_twitter:
  - yes
daumview_id:
  - 37226939
categories:
  - 기타
tags:
  - TIP
---
일단 \[ code\]\[ /code\]를 사용하려면 환경설정-글쓰기에서 Code SyntaxHighlighter를 켜야 한다.

아래 그림을 참고하면 도움이 될 것이다.(실제 사용할 때는 [<span class="Apple-style-span" style="background-color: rgb(255, 255, 0);"> </span>code][<span class="Apple-style-span" style="background-color: rgb(255, 255, 0);"> </span>/code] 노란 부분으로 표시한 공백이 있으면 안 된다. 그냥 붙여 쓰라는 말이다.)

<img src="/uploads/legacy/old-images/1/cfile8.uf.18104A494D4BC86E1E7EE1.jpg" class="aligncenter" width="555" height="638" alt="" />

[ code]와 [ /code] 사이에 코드를 집어넣으면 된다.

예 컨대,

[ code **<span style="color: rgb(255, 0, 0); ">html</span>**]

<form method=&#8221;post&#8221;>

&nbsp; <input type=&#8221;text&#8221; name=&#8221;wow&#8221; value=&#8221;텍스트 필드&#8221;/>

&nbsp; <input type=&#8221;submit&#8221; value=&#8221;확인&#8221;/>

</form>

[ /code]

이런 식으로 써 주면 되는 것이다.(빨갛게 표시한 부분은 따로 설명한다.) 그러면 아래처럼 나온다.

<pre class="brush:html">&lt;form method="post"&gt;
  &lt;input type="text" name="wow" value="텍스트 필드"&gt;
  &lt;input type="submit" value="확인"&gt;
&lt;/form&gt;
</pre>

그런데, 이걸 에디터 모드에서 쓰면 안 되고, HTML 모드에서 써야 한다.

<div style="width: 590px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile10.uf.185059474D4BC86F2629C8.jpg" width="580" height="211" alt="" /><p class="wp-caption-text">
    html모드에 체크하면 이런 화면이 나온다.
  </p>
</div>

그러면 대체로 제대로 나오는 것 같다.

## 불친절한 텍스트큐브.com의 설명

텍스트큐브의 Code Highlighter 설명은 좀 불친절한데, 다음과 같다.

> [ code] ~ [ /code] 영역을 Syntax Highlighter를 이용 코드 포맷팅을 해 주는 기능입니다. Syntax Highlighter에 대한 정보는 개발 홈페이지(영문)을 확인하시기 바랍니다. Brush 지정은 영역 시작부를 &#8220;[ code {Brush name}]&#8220;로 하시면 됩니다. (예제: [ code php], [ code cpp])

개발 홈페이지를 확인하라고 했는데 링크도 안 걸려 있다;;

개발 홈페이지는 여기다 : <http://code.google.com/p/syntaxhighlighter/>

## 가장 중요한 브러시네임(Brushname)

꼭 설명이 필요한 건 아닐 수도 있다. 대체로 php, java, js, javascript 이런 식으로 brushname을 적어주면 다 제대로 된다.

즉, \[ code\]\[ /code\]라고 쓰는 게 아니라, \[ code php\]\[ /code\]이런 식으로 써야 한다는 거다.

그런데 {brushname}으로 뭐가 들어갈 수 있는지 설명이 없어 답답하다.

<a target="_blank" href="http://code.google.com/p/syntaxhighlighter/wiki/Languages">brushname의 종류를 볼 수 있는 페이지</a>를 찾았다 : [brushname][1]

그럼 이상.

 [1]: http://code.google.com/p/syntaxhighlighter/wiki/Languages