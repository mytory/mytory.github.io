---
title: FCKeditor, 내용을 에디터에 집어넣는 소스
author: 안형우
layout: post
permalink: /archives/392
aktt_notify_twitter:
  - yes
daumview_id:
  - 37011053
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
FCKeditor 지원이 끝난 듯하다. [CKeditor][1]를 사용하는 편이 나을 거다.

&#8212;&#8212;

FCKeditor 플러그인을 만들려면 필수 코드고, 이 코드만 알면 많은 것을 할 수 있을 것이다. 굳이 플러그인까지 만들지 않고도 말이다.

코드 자체는 아주 간단하다.

<pre class="brush:js">FCKeditorAPI.GetInstance(&#039;FCKeditor이름&#039;).InsertHtml(HTML코드);</pre>

위에서 FCKeditor이름 부분은

<pre class="brush:php">$oFCKeditor = new FCKeditor(&#039;FCKeditor이름&#039;) ;</pre>

위 부분에 나오는 걸 말하는 거다.

당연히, FCKeditor API를 보면 더 많은 걸 알 수 있다.

 [1]: http://ckeditor.com/