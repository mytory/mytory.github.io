---
title: fckeditor 선택 영역(블럭 씌운 부분) 제어를 위한 javascript 명령
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/33
aktt_notify_twitter:
  - yes
daumview_id:
  - 37264004
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
fckeditor에서 선택한(블럭 씌운) 부분을 제어하기 위한 명령어는 다음과 같다.

<pre class="brush: jscript;" title="code">FCKeditorAPI.GetInstance(&#039;content&#039;).Selection.GetSelection()</pre>

위에서 content는 당연히 FCKeditor에 붙인 이름이다. 자기가 붙인 이름을 써야 한다.

FCKeditorAPI에 대한 설명은 다음 문서를 참고하면 된다.

<p style="text-align: center;">
  <strong> FCKeditorAPI</strong>
</p>