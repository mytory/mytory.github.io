---
title: '[jQuery] 맨 위로 스크롤시키기(번쩍 하고 가는 거 말고)'
author: 안형우
layout: post
permalink: /archives/1594
aktt_notify_twitter:
  - yes
daumview_id:
  - 36687441
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
<pre>&lt;a onclick="jQuery(&#039;html, body&#039;).animate( { &#039;scrollTop&#039;: 0 }, &#039;slow&#039; );"  href="javascript:void(0);"&gt;
	Go to top
&lt;/a&gt;</pre>

기본적으로는 이 간단한 코드가 맨 위로 올려 주는 코드다. 발견한 곳은 [SNIPPLR][1] 다.

그러나 실전에 적용하기 위해서는 난관이 좀 있는 것 같다.

이 블로그에 문제가 있는지 IE7에서는 아래쪽에 있는 데모가 안 돌아간다. 근데 그냥 HTML만 빼서 하면 잘 작동한다. 또한 [@third_j님 제보][2]에 따르면 OSX 라이언에서 크롬을 사용한 환경에서도 데모가 작동하지 않는다고 한다.

그래서 좀 찾아 봤는데 오페라에서도 작동을 안 한다는 걸 찾을 수 있었다. 아래 글을 참고하면 온전한 코드를 얻을 수 있을 듯하다. (아직 나도 완전히 보진 않았다.)

[▶jQuery Animating Same-Page #Links Bugs][3]

따라서 고민없이 해결하고 싶은 분들은 위 글의 저자가 참여한 [jQuery Smooth Scroll 플러그인][4]을 사용하는 게 나을 듯 싶다. 이 플러그인을 사용하면 IE, 오페라에서 모두 제대로 작동한다.

원인은 animate 함수나 scrollTo라는 인자값에 있는 게 아니라 html, body 여기에 있는 듯하다. 오페라의 경우 html에 걸어야 부드럽게 스크롤이 되고, body에 걸면 번쩍 한다. 리눅스 크롬에서는 html에 건 것은 작동하지 않고, body에 건 놈만 작동한다.

아래 데모가 있다. html에 건 경우와 body에 건 경우를 나눠서 만들었다. 번쩍하고 맨 위로 가는 건 아마도 모든 브라우저에서 작동할 것이다. 하지만 부드럽게 맨 위로는 브라우저에 따라 html에서 작동하는 놈도, body에서 작동하는 놈도 있는 듯하다.

<a onclick="jQuery('html').animate( { 'scrollTop': 1 }, 'slow' );" href="javascript:void(0);">부드럽게 맨 위로(html)</a> | <a onclick="jQuery('body').animate( { 'scrollTop': 1 }, 'slow' );" href="javascript:void(0);">부드럽게 맨 위로(body)</a> | <a onclick="window.scrollTo(0,0)" href="javascript:void(0);">번쩍하고 맨 위로</a>

 [1]: http://snipplr.com/view/57612/slide-to-top-of-page-jquery/
 [2]: https://twitter.com/thirdjj/status/99483339970445312
 [3]: http://www.zachstronaut.com/posts/2009/01/18/jquery-smooth-scroll-bugs.html
 [4]: https://github.com/kswedberg/jquery-smooth-scroll