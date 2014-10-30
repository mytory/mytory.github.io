---
title: '[번역]스마트폰에 모바일 CSS 적용시키기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/335
aktt_notify_twitter:
  - yes
daumview_id:
  - 37052070
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
# <a target="_blank" href="http://www.songinwind.com/blog/trends/how-to-apply-mobile-css-to-smart-phone-devices">스마트폰에 모바일 CSS 적용시키기[원문]</a>

Posted by Jen in coding front-end, trends on December 9th, 2009

(역자 주 : 당연히, 나는 전문 번역자가 아니다. 그래서 오역이 있을 수 있다. 원문의 링크는 클리어 보스에서 얻었다. 원문과 비교해 보면 의역이 많다는 걸 알 수 있을 텐데, 번역 실력이 모자라기 때문에 그런 거다;;)

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile9.uf.163E7A4A4D4BC89B2DEBC3.png" class="alignleft" width="152" height="300" alt="" />

내가 모바일 CSS에 대해 얘기할 때, 나는 아이폰의 사파리, 블랙베리의 기본 브라우저, 그리고 신제품이지만 많은 이들이 사용하게 될 오페라 미니를 떠올린다.(원문은 이거다 : I am looking for safari in iphone, blackberry default browser and this new born but the mobile browser for majority to be &#8211; opera mini.)

오늘날, 3세대 폰임에도 불구하고 스마트폰은 미국 시장에서 가장 중요한 시장을 형성하고 있다. 그런데 불행히도 데스크탑 컴퓨터와는 달리 모바일 웹은 국제 표준이 없다. 결국, 모바일용 페이지를 디자인할 때, 브라우저 호환성과 접근성을 해결하기 위해 보통 더 많은 노력을 들여야 한다. 그리고 우습게도, 대부분의 스마트폰은 자신을 handheld 기기로 간주하지 않는다. 그래서 이 &#8220;handheld&#8221; CSS 선언이 제대로 작동하지 않는다.

<pre class="brush:html">&lt;link media=”handheld” href=”mobile.css” type=”text/css” rel=”stylesheet” /&gt;</pre>

## 우선, 아이폰 기본 브라우저인 사파리.

맞다, 아이폰은 모두에게 모든게 쉽게 만들어져 있다. 소비자뿐 아니라 아이폰 어플 개발자도 [아이폰용 작업을 하기는] 웹디자이너만큼이나 쉽다. ^^ 그래서 아이폰에 접근하는 게 다른 스마트폰 기기에 접근하는 것보다 훨씬 간단하다.

<pre class="brush:html">&lt;link media=”only screen and (max-device-width: 480px)” href=”mobile.css” type=”text/css” rel=”stylesheet” /&gt;</pre>

스스로를 handheld로 여기는 기기들을 포함하기 위해, 이 라인을 좀더 일반적으로 작동하도록 고쳐 보자.

<pre class="brush:html">&lt;link media=”handheld, only screen and (max-device-width: 480px)” href=”mobile.css” type=”text/css” rel=”stylesheet” /&gt;</pre>

좀더 안전하게, 한 번 더 작업을 해 주자. 기기의 가로 사이즈가 320픽셀이거나 그 아래인 경우에도 작동하도록. 그걸 위해서 이렇게 해 준다.

<pre class="brush:html">&lt;link media=”handheld, only screen and (max-device-width: 320px)” href=”mobile.css” type=”text/css” rel=”stylesheet” /&gt;
&lt;link media=”only screen and (max-device-width: 480px)” href=”mobile.css” type=”text/css” rel=”stylesheet” /&gt;</pre>

이 두 라인을 넣으면 어디서나 완벽하게 작동을 한다. 단, W3C CSS validator만 빼고. 그렇다. W3C는 모바일 style 라인을 고려하지 않는데다가 검증(validation)을 통과시켜 주지도 않는다. 여기서는 대응법을 말하지 않겠다. 더 많은 정보를 얻으려면, 여기를 보라 : <a target="_blank" href="http://csscreator.com/node/28171">http://csscreator.com/node/28171</a>

## 블랙베리 기본 브라우저

블랙베리는 어떤 식으로 세팅을 해 놔도 모바일 스타일시트를 인지하지 않는다.[그냥 데스크탑 css를 사용해 버린다.] handheld로 해도, 가로 480px이나 320px로 해 놔도 마찬가지다. 블랙베리[로 들어온 유저]한테 모바일 페이지를 보여 주기 위해서 딱 한 가지 방법이 있다. 자바스크립트를 이용해서 블랙베리에게 모바일용 페이지를 보여 주는 것이다. [그러려면 블랙베리를 인지하는] 스크립트를 다른 작동하는 스크립트들보다 더 앞쪽에 놔야 한다. 나는 페이지 이동 없이 모바일 스타일시트를 적용하기 위해서 노력했는데, 불행히도 작동하지 않았다. 더 자세한 내용을 보자.

<pre class="brush:js">&lt;script type=”text/javascript”&gt;
var deviceBB = “blackberry”;
//Initialize our user agent string to lower case.
var uagent = navigator.userAgent.toLowerCase();
var cssFile = “mobile.css”;
//**************************
// Detects if the current browser is a BlackBerry of some sort.
if (uagent.search(deviceBB) &gt; -1) {
//document.getElementById(’blackb’).href = ‘mobile.css’; // this doesn’t work
window.location = ‘home_bb.html’;
//document.write(’&lt;link href=”‘+cssFile+’” type=”text/css” rel=”stylesheet”&gt;); //this doesn’t work either
}
&lt;/script&gt;
</pre>

## 오페라 미니

얘는 대부분의 스마트폰 ─ 블랙베리, 아이폰, treo palm 등 ─ 에서 작동하는 정말 좋은 모바일 브라우저다. 모바일 CSS를 이 오페라 미니에게 인식시키기 위해서, 다음 두 라인이면 충분하다.

<pre class="brush:html">&lt;link media=”handheld, only screen and (max-device-width: 320px)” href=”mobile.css” type=”text/css” rel=”stylesheet” /&gt;
&lt;link media=”only screen and (max-device-width: 480px)” href=”mobile.css” type=”text/css” rel=”stylesheet” /&gt;
</pre>

오페라 미니 시뮬레이터 사이트가 있다. <a target="_blank" href="http://www.opera.com/ko/developer/opera-mini-simulator">http://www.opera.com/mini/demo/</a> 여기서는 모바일 폰 없이도 모바일 CSS를 테스트해 볼 수 있다. 그러나 &#8216;잘못된'(FALSE) 결과만 보여 준다. 그러니 테스트용으로 사용하지는 마라. 자기가 갖고 있는 모바일 폰에 직접 오페라 미니(it)를 설치해서 실제로 폰에서(there) 테스트를 해 봐야 한다.(이 부분은 제대로 번역한 것인지 좀 자신 없다.)

시뮬레이터에서 볼 수 없는, 진짜 폰에서 볼 수 있는 문제(Issue)가 있다 :

오페라 미니는 CSS에서 font size를 인식하지 않는다. 이건 내가 위키피디아에서 가져온 문장이다 : 오페라 미니는 오직 한 종류의 폰트만 지원한다. 이 폰트는 글꼴크기로 “Small”, “Medium”, “Large”와 “Extra large” 사이즈만 지원한다.

<a target="_blank" href="http://en.wikipedia.org/wiki/Opera_Mini">http://en.wikipedia.org/wiki/Opera_Mini</a>

폰트의 기본 사이즈는 “medium”이다. 이 문제를 파악했다면, 모바일 스타일을 디자인할 때, 만약 오페라 미니 브라우저를 염두에 둔다면, 모든 텍스트 사이즈를 medium으로 놓고 페이지를 거기에 맞춰야 한다.

<div id="__KO_DIC_LAYER__" style="padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; position: fixed; z-index: 999999999; overflow-x: hidden; overflow-y: hidden; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(51, 51, 119); border-right-color: rgb(51, 51, 119); border-bottom-color: rgb(51, 51, 119); border-left-color: rgb(51, 51, 119); display: none; ">
</div>