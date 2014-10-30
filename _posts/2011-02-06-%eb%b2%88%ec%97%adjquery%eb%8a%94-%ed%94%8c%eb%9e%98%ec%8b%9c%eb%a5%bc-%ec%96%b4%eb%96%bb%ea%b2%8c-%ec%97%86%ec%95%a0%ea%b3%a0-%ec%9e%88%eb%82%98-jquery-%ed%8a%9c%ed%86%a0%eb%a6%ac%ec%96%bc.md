---
title: '[번역]jQuery는 플래시를 어떻게 없애고 있나 + jQuery 튜토리얼 &#038; 플래시 애니메이션을 대체할 플러그인'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/831
aktt_notify_twitter:
  - yes
daumview_id:
  - 36763747
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
<a href="http://aext.net/2010/03/javascript-jquery-killing-flash-tutorial-jquery-plugin/" target="_blank">How jQuery is Killing Flash + jQuery Tutorials & Plugins to Beat Up Flash Animations</a>

위는 원문이고 아래는 제가 번역한 것입니다. 의역이 많이 있으니 정확하게 보고 싶다면 원문을 보세요.

&#8212;&#8212;&#8211; 번역 시작 &#8212;&#8212;&#8212;-

1996년에 매크로미디어가 플래시라고 불리는 제품을 내놨다. 이건 벡터 기반 애니메이션 플랫폼이었다. 플래시로 웹디자이너들은 시간순으로 흐르는(using a timeline) 애니메이션과 비디오로서의 벡터 디자인 툴을 창조할 수 있게 됐다. 나아가 웹디자이너들에게는, 플래시는 여전히 작은 파일 사이즈로 방문자들에게 부드러운 화면을 제공할 수 있는 훌륭한 솔루션이다. 웹 서핑을 하는 사람들이 플래시를 즐기기 위해 해야 하는 유일한 일은 매크로미디어 플래시 플레이어를 설치하는 것뿐이다.

그러나 1997년 자바스크립트가 나오면서 플래시와 자바스크립트 사이에 전쟁이 벌어졌다. 플래시는 자바스크립트가 하루아침에 모든 애니메이션에서 플래시를 대체할 것이라고 두려워했기 때문이다. 왜? 자바스크립트 프레임워크의 활력이 점차 대중적이 됐기 때문이다. 자바스크립트는 확장성, 퍼포먼스, 사용성이 뛰어났다. jQuery, MooTools, script.aculo.us, Prototype과 다른 것들을 포함해서 최근에는 jQuery가 특히 그렇다.

jQuery는 빠르고 간결한 자바스크립트 라이브러리다. jQuery는 신속한 웹 개발을 위해 HTML 문서 탐색, 이벤트 핸들링, 애니메이션, 그리고 Ajax 통신을 간결하게 만든다. 여러분이 스스로 뛰어난 자바스크립트 코드 스킬을 갖고 있더라도, jQuery를 사용하면 작업을 간단하게 할 수 있다.(100여 줄의 코드 vs jQuery 몇 줄) 나아가, jQuery에는 수천 개의 플러그인이 있다. 그리고 커다란 커뮤니티가 이 프로젝트를 지원한다. jQuery는 플래시의 묵직한 경쟁자다.

(이 글이 좋다면, <a href="http://feeds.feedburner.com/aextnet" target="_blank">RSS feed</a>를 구독하시고 <a href="http://twitter.com/aextnet" target="_blank">Twitter</a>를 팔로우하세요. 최신글을 보실 수 있습니다. [원 저작자의 RSS와 Twitter입니다.])

## 플래시 대신 jQuery를 사용해야 하는 이유

이 두 기술을 사용할 때 각각의 이득과 손실에는 수많은 차이가 있다. 그러나 이 글에서 우리는 몇 가지 중요한 특징만 살펴 볼 것이다.

먼저, jQuery를 이용해 어플리케이션을 구축하기 위해서, 여러분은 어떤 것도 구입할 필요가 없다. 그리고 플래시를 사용하기 위해서는 플래시를 인코딩하기 위한 소프트웨어를 구매해야 한다. 플래시 소프트웨어는 699$고 옛 버전에서 업그레이드하기 위해서도 199$나 지급해야 한다. jQuery와 대부분의 자바스크립트 프레임워크는 공짜다.(몇몇 jQuery 플러그인은 상업적 용도로 사용할 때는 비용을 지불해야 한다.) **이 점에서 jQuery가 우위다.**

<img class="aligncenter" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile25.uf.165E1C4C4D4EA95501480A.jpg" alt="" width="292" height="438" />

두번째이면서 플래시 최고의 문제점은 아이폰에서 안 돌아간다는 점이다. 플래시는 아이폰뿐 아니라 다른 많은 모바일 기기에서도 안 돌아간다. 어도비사(社)의 말을 들어 보면, 현재 98퍼센트의 데스크탑 컴퓨터와 노트북이 플래시를 지원한다. 그러나 진실은 아이폰과 아이패드, 그리고 핸드폰에 답재된 모든 브라우저에서 플래시가 호환성이 없다는 것이다. 플래시와 달리, jQuery는 [장애인을 위한] 스크린 리더 접근성을 지원한다. accDND(jQuery 플러그인)[이 플러그인은 jQuery 플러그인 사이트가 날아가면서 공식 사이트에서 사라졌다 - 2012-06-30 안형우]를 사용하면, 우리는 키보드와 스크린 리더를 사용해서 드래그 인 드롭을 할 수 있다. **jQuery가 또다시 우위다.**

다음으로, 커스터마이징의 측면에서 봐도 플래시보다는 제이쿼리가 더 쓸 만하다. (we’ll consider using jQuery instead of Flash in its customization.) jQuery와 다른 자바스크립트 프레임워크는 개발과 커스터마이징이 쉽다.

몇 가지 각도에서 jQuery가 플래시를 이기긴 했지만, 실제 사용에서 jQuery가 플래시를 완전히 대체할 수는 없다. 플래시는 3D 지원 능력이 완전하고, 객체 애니메이션에서도 광범한 특징이 있다. jQuery로는 한계가 있다. 더군다나, jQuery의 UI는 플래시 개발 UI와 비교조차 할 수 없다. 이것은 플래시에 가격표가 붙어 있는 이유 중 하나다. 이 외에도, 우리는 적당한 글꼴 지원에서도 문제를 발견할 수 있다. 플래시를 사용하면 웹에서 어떤 글꼴이든 구현할 수 있다. 그러나 자바스크립트로는 그렇게 할 수 없다. HTML 페이지에 글꼴을 심을 수 있는 수많은 툴과 서비스가 있음에도 불구하고 그렇다.

비교해 볼 만한 또 다른 영역은 비디오다. 이 부분에서는 ─ 당연히 완전히 다른 영역인 ─ HTML5가 다가오고 있다.

대부분의 경우, 그럼에도 불구하고, jQuery가 플래시보다 낫다. 여기에 우리는 튜토리얼 몇 개와 정말 놀라운 jQuery 플러그인 몇 개를 모았다. 각각의 튜토리얼은 플래시로 구현했던 효과를 어떻게 jQuery로 구현하는지 가르쳐 준다.

*이 다음은 튜토리얼과 플러그인 소개라 번역하지 않았고, 제목만 번역했습니다. 필요하신 분은 원문을 직접 방문해 보세요. 이 목록 뒤에 결론부도 있습니다.

## 튜토리얼

*   <a href="http://www.newmediacampaigns.com/page/jquery-vs-flash-for-interactive-map" target="_blank">플래시 대신 jQuery를 이용해서 상호작용하는 지도 만들기</a>
*   <a href="http://tutorialzine.com/2009/12/animated-share-buttons-jquery-css/" target="_blank">jQuery와 CSS로 움직이는 [소셜 네트워크] 공유 바 만들기</a>
*   <a href="http://youlove.us/blog/the-youloveus-scrolling-background-effect-explained" target="_blank">스크롤되는 배경 효과, youlove.us 설명</a>
*   <a href="http://buildinternet.com/2009/08/crafting-an-animated-postcard-with-jquery/" target="_blank">jQuery로 구현한 움직이는 우편엽서 기능</a>
*   <a href="http://css-tricks.com/jquery-robot/" target="_blank">jQuery로 움직이는 만화 로봇 만들기</a>
*   <a href="http://acko.net/blog/abusing-jquery-animate-for-fun-and-profit-and-bacon" target="_blank">베이컨 구름</a>
*   <a href="http://tutorialzine.com/2009/12/colorful-clock-jquery-css/" target="_blank">jQuery와 CSS로 만든 컬러풀한 시계</a>
*   <a href="http://net.tutsplus.com/tutorials/javascript-ajax/jquery-os-x-style-dock-and-stack-navigation/" target="_blank">jQuery OS X 스타일 Dock 네비게이션</a>
*   <a href="http://css-tricks.com/css3-clock/" target="_blank">jQuery와 CSS3로 만든 옛날 학교 시계</a>
*   <a href="http://www.devirtuoso.com/2009/09/making-a-3d-engine-in-jquery/" target="_blank">jQuery로 만든 3D 엔진</a>
*   <a href="http://www.gayadesign.com/diy/puffing-smoke-effect-in-jquery/" target="_blank">jQuery로 만든 연기 뿜는 효과</a>

## 플러그인

*   <a href="http://webdev.stephband.info/parallax.html" target="_blank">jParallax</a> : DIV 엘리먼트의 background-position을 이용해서 사진의 시점을 이동하는 효과를 내 주는 플러그인.
*   <a href="http://www.jquery.info/scripts/jFlip/demo.html" target="_blank">jFlip</a> : 페이지 넘기는 효과를 내 주는 플러그인.
*   <a href="http://elliottkember.com/sexy_curls.html" target="_blank">Sexy Curl 플러그인</a> : 페이지 껍질을 벗기는 듯한 효과를 주는 플러그인
*   <a href="http://cssglobe.com/post/5780/easy-slider-17-numeric-navigation-jquery-slider" target="_blank">이지 슬라이더(숫자 네비게이션 jQuery 슬라이더)</a>
*   <a href="http://css-tricks.com/anythingslider-jquery-plugin/" target="_blank">AnythingSlider jQuery 플러그인</a>
*   <a href="http://jquery.vostrel.cz/reel" target="_blank">reel</a> : 드래그하면 이미지가 회전하는 플러그인. 아이폰에서도 돌아가는 듯.
*   <a href="http://code.google.com/p/flot/" target="_blank">Flot</a> : 그래프 그려 주는 플러그인
*   <a target="_blank">jCrop</a> : 이미지 Crop할 때 효과를 내 주는 플러그인. 실제로 자른 이미지를 저장하려면 서버사이드 프로그램이 있어야 한다. 예제로 PHP를 제공한다.

## 결론

jQuery가 플래시 비슷한 효과를 낼 수 있는 강력한 자바스크립트 프레임워크임에도 불구하고, 프래시를 완전히 대체할 수는 없다. 그러나 jQuery는 디딤돌이다. jQuery는 웹을 HTML5에 더 가까이 다가가게 하고 <a href="http://cappuccino.org/" target="_blank">Cappuccino</a>처럼(다른 것들도 있다) 로컬에서 돌아가는 어플리케이션을 만들기 위해서도 사용된다.

우리가 빼먹은 게 있다면, 어려워 말고 알려 주기 바란다. 어떤 코멘트나 제안에 대해서도 고맙게 생각할 것이다. 어떻게 생각하는가? 다음 10년 동안에도 플래시가 계속될까?