---
title: '[CSS] 사용자 컴터에 없는 글꼴 사용할 수 있게 만들기 @font-face'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/641
aktt_notify_twitter:
  - yes
daumview_id:
  - 36893814
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
IE를 제외한 모든 브라우저가 TTF 파일을 지원하고, IE는 EOT 파일을 지원한다고 한다.(출처는 <meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<http://naradesign.net/ouif/css3/#s25>와 <http://naradesign.net/ouif/css3/#s26>&nbsp;다.) <div>
  EOT는 <a href="http://ttf2eot.sebastiankippe.com/" target="_blank">TTF를 EOT로 변환해 주는 웹사이트</a>를 통해 간단히 생성할 수 있다.(작동 테스트는 했는데 실제로 EOT가 적용되는지 테스트해 보지는 않았다.)
</div>

<div>
  적용 CSS 코드는 아래와 같다.
</div>

<pre class="brush:css">/* FF, OP, SF, CR */
@font-face 
{ font-family:ng_ttf; src:url(ng_ttf.ttf);}

/* IE */
@font-face 
{ font-family:ng_eot; src:url(ng_eot.eot);}

.nanum { font-family:ng_ttf, ng_eot;}
</pre>

<pre class="brush:html">&lt;p class="nanum"&gt; ... &lt;/p&gt;
</pre>

<div>
  위처럼 하면 글꼴을 적용시킬 수 있다고 한다.
</div>

<div>
  코드를 유의해서 보기 바란다. @font-face에서 font-family로 선언한 이름이 ng_ttf인데, .nanum에서 font-family로 ng_ttf를 적용했다. 즉, @font-face는 글꼴 파일과 이름을 연결시켜서 선언하는 역할을 하는 놈이다. 그리고 font-family는 그걸 사용하는 놈이다. ㅇㅋ?
</div>

<div>
  이런 걸 할 때는 저작권을 유심히 봐야 할 거다. 내가 알기로 개인 및 기업에서 무료로 사용할 수 있는 폰트는 네이버의 나눔글꼴, <a href="http://mytory.textcube.com/entry/%ED%95%9C%EC%BB%B4-%EB%AC%B4%EB%A3%8C-%EA%B8%80%EA%BC%B4%EC%9D%B8-%ED%95%A8%EC%B4%88%EB%A1%AC%EC%B2%B4-%EB%B0%9C%ED%91%9C" target="_blank">한컴의 함초롬체</a> 등이다. 글꼴에 대해서 더 자세한 건 직접 찾아 보기 바란다. 내가 아는 건 이정도.
</div>

<div>
  아, 우분투에 들어있는 은 돋움이나 은 바탕, 그리고 <a href="http://offree.net/entry/LexiGulim" target="_blank">렉시 굴림</a> 같은 글꼴은 기업에서도 무료일 수 있겠다. 확신은 못한다. 이상.
</div>