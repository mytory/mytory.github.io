---
title: 구글에서 javascript 라이브러리를 빌려다 쓰자
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/357
aktt_notify_twitter:
  - yes
daumview_id:
  - 37029230
categories:
  - 웹 퍼블리싱
tags:
  - javascript
---
<a target="_blank" href="http://twurl.nl/008kwp">http://twurl.nl/008kwp </a>

블로그에 jquery를 사용하고 싶은 나 같은 사람은 서버 hosting을 받아야 하는 불편한 점이 있었다. jquery.js를 블로그에 업로드하는 건 허용이 안 되기 때문이다. 자유도가 높은 텍큐나 티스토리도 안 된다. js를 업로드하도록 하면 해킹 위험이 있기 때문이다.

그런데 오늘 우연히 좋은 걸 알게 됐다. 구글이 자기 서버를 개방해서 js라이브러리들을 제공하고 있었던 것이다.

사용법은 간단한데,

<pre class="brush:html">&lt;script type="text/javascript" src="js/jquery.js"&gt;&lt;/script&gt;</pre>

라고 쓰던 걸

<pre class="brush:html">&lt;script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"&gt;&lt;/script&gt;
</pre>

라고 쓰면 된다.

다른 방법도 있다.

<pre class="brush:html">&lt;script src="http://www.google.com/jsapi?key=자기_API_key"&gt;&lt;/script&gt;
&lt;script&gt;
// jQuery를 불러 온다
google.load("jquery", "1.4.2");
&lt;/script&gt;
</pre>

이렇게 쓰면 된다. 그런데 이 방식을 사용할 경우에는 <a target="_blank" href="http://code.google.com/intl/ko-KR/apis/ajaxsearch/signup.html">API key를 발급</a>받<span style="text-decoration: line-through;">으면다양한 자바스크립트 라이브러리를 자유롭게 사용할 수 있다.</span>아야 한다. 

굳이 두 번째 방식도 사용하도록 하고, API key까지 발급받아야만 사용할 수 있도록 하는 이유는 아시는 분이 있으면 말해 주시면 고맙겠다. 좀 더 다양한 걸 할 수 있는 걸까?

이상.

(<a target="_blank" href="http://mytory.textcube.com/262#comment8699544">아즈키 님의 댓글</a>을 참고해서 내용 좀 수정봤습니다.)