---
title: '[번역]모바일용 사이트를 디자인할 때 유용한 팁'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/329
aktt_notify_twitter:
  - yes
daumview_id:
  - 37052974
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
# <a href="http://woork.blogspot.com/2008/07/tips-to-design-your-site-for-mobile.html" target="_blank">Tips to design your site for mobile devices</a>[원문]

(역자주 : 당연히, 저는 전문 번역가가 아니기 때문에 틀린 번역이 있을 수 있습니다. 원문 링크는 클리어 보스에서 얻었습니다.)

며칠 전 내 친구 루카스(Lucas)가 자기 블로그를 모바일 버전에 대해 조언(asked to me some suggest)해 달라고 했다. 그래서 이번 글에서 나는 사이트를 모바일 버전으로 만들려고 할 때 필요한 몇 가지 간단한 팁을 쓰려고 한다. 예컨대, 모바일 버전 사이트를 어떤 URL 주소로 할 것인가 &#8211; 모바일 기기를 위해 리디렉트를 시킬 것인가, CSS와 HTML을 이용해서 모바일에 맞는 디자인을 할 것인가. (만약 당신이 WordPress 유저라면) free WordPress plugin으로 빨리 처리해 버릴 것인가.

## 모바일 버전 사이트 URL 주소는 뭘로 할 것인가

첫 단계는 URL 주소 고르기다. 몇 가지 방법이 있다. root에 모바일용 폴더(mobile로 이름붙였다고 하자)를 하나 만들 수 있다. 그러면 모바일용 페이지는 http://www.yoursite.com/mobile 이 될 것이다.

<div style="width: 328px" class="wp-caption aligncenter">
  <img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile25.uf.1754F14C4D4BC89A1CDF71.png" alt="" width="318" height="264" /><p class="wp-caption-text">
    △이 폴더를 사이트 루트에다 만들어라.
  </p>
</div>

아니면, 만약에 서브도메인을 추가할 수 있다면, http://m.yoursite.com 이나 http://mobile.yoursite.com 같은 주소를 모바일용 파일이 있는 폴더에 링크시켜 사용할 수도 있다.

## 모바일 기기를 위한 리디렉트(Redirect) 스크립트

두 번째 단게는 모바일 기기를 위해 리디렉트 스크립트를 만드는 것이다. 이게 꼭 필요한 건 아니다. 하지만 모바일 기기로 들어오는 모든 트래픽을 자동으로 모바일 페이지에 리디렉트시키는 것은 유용하다. 이 주제 대한 더 많은 정보는 다음 링크에서 볼 수 있다.

*   <a href="http://www.webmasterworld.com/forum45/260.htm" target="_blank">Redirect a mobile/PDA to a &#8220;lite homepage&#8221;</a>
*   <a href="http://studiohyperset.com/mobile-redirect-code-discussion-index/1558" target="_blank">Mobile Redirect Code Discussion Index</a> [원문에 소개된 페이지에 가 보면 deprecated 라고 표시돼 있다. 그 페이지에서 추천해 준 페이지가 여기기 때문에 여기를 링크했다.]

… 그리고 특히 PHP나 ASP 프로그래머는 다음 링크를 봐라.

*   <a href="http://dev.mobi/article/lightweight-device-detection-php" target="_blank">Device detection using PHP</a>
*   <a href="http://dev.mobi/article/lightweight-device-detection-asp" target="_blank">Device detection using ASP</a>

만약 괜찮은 링크가 더 있으면, 코멘트 남겨 주기 바란다.

## 모바일에 맞는 간단한 페이지 구조

모바일용으로 어떤 레이아웃이 더 좋을까? 나는 모바일용으로는 컬럼 1개짜리가 가장 대중적이고, 쓸만하고, 읽기 편하다고 생각한다. 예를 들면, 유튜브, 페이스북, 트위터가 이런 구조다.

<div style="width: 346px" class="wp-caption aligncenter">
  <img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile22.uf.1611E8564D4BC89A32557E.png" alt="" width="336" height="280" /><p class="wp-caption-text">
    △유튜브 모바일 페이지다.(컬럼 한 개 짜리 레이아웃이다.)
  </p>
</div>

컬럼 하나짜리 레이아웃은 좋은 방법이지만 반드시 따라야 하는 것(rule)은 아니다. 사실, 윈도우 모바일을 사용하는 기기에서 모바일 인터넷 익스플로러를 사용해서 웹서핑을 한다면 기기의 가로 사이즈에 따라 내용을 &#8220;arrange&#8221;(정렬?)하는 옵션을 선택할 수 있다.(오리지널 페이지 레이아웃에 상관없이 말이다.)(모바일 IE에는 컴럼 하나짜리 모바일 페이지도 두세개로 표현할 수 있는 옵션이 있나보다.)

> *   Default, 가로 스크롤을 줄이기 위해 콘텐츠 너비를 좁게 한다.
> *   One Column, 모든 콘텐츠를 강제로 한 컬럼으로 만든다.
> *   Desktop은 콘텐츠에 아무 변화를 주지 않는다.(데스크탑용 IE에서 보는 거랑 똑같이 보인다.)

하지만, 일반적으로 사이트 레이아웃이 너무 복잡하면 결과가 안 좋다. 이런 문제를 피하고, 사이트를 기기에 맞는 한 컬럼짜리 레이아웃으로 만들어서 모바일 기기에 최적화시키는 디자인으로 만들기 위해서는 좀 더 고민을 해야 한다. 다음 섹션에서 그걸 설명한다.

## 모바일 사이트 계획하기

만약에 당신이 모바일용 페이지를 만들려고 하는 게 블로그라면, 모바일 기기에 맞는 사이트 레이아웃은 아래와 비슷할 것이다.

<img class="aligncenter" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile25.uf.145A7A4D4D4BC89A297D72.png" alt="" width="258" height="276" />

블로그에는 이런 요소들이 있다 : header, body 와 footer. Header에는 사이트 로고가 있다. body에는 글이나 요약이 들어간다. 푸터에는 사이트에 대한 다른 정보가 들어간다.

## HTML와 CSS 기본 코드

드림위버나 아리면 선호하는 에디터를 이용해서 코드를 짜 보자. HTML 코드는 아주 간단한데, 아래와 같을 수 있다.

<pre class="brush:html">&lt;!-- ------------ --&gt;
&lt;!-- Page Header --&gt;
&lt;div id="header"&gt;
&lt;a href="index.html"&gt;&lt;img src="logo.png" border="0" /&gt;&lt;/a&gt;
&lt;/div&gt;

&lt;!-- ------------ --&gt;
&lt;!-- Page Body --&gt;
&lt;div id="page-body"&gt;
&lt;!-- Your post here --&gt;
&lt;h1&gt;&lt;a href="post1.html"&gt;Title of your post&lt;/a&gt;&lt;/h1&gt;
&lt;p&gt;A summary of your post&lt;/p&gt;
&lt;p class="tag"&gt;
&lt;a href="tag1"&gt;tag1&lt;/a&gt;,
&lt;a href="tag2"&gt;tag2&lt;/a&gt;,
&lt;a href="tag3"&gt;tag3&lt;/a&gt;
&lt;/p&gt;
&lt;!-- Your post here --&gt;
&lt;!-- Your post here --&gt;
&lt;!-- ... --&gt;
&lt;/div&gt;

&lt;!-- ------------ --&gt;
&lt;!-- Page Footer --&gt;
&lt;div id="footer"&gt;
&lt;a href="index.html"&gt;Home&lt;/a&gt; |
&lt;a href="mailto:youremail@yoursite.com"&gt;Contact me&lt;/a&gt;
&lt;/div&gt;</pre>

&#8230; 그리고 CSS 코드는 이럴 수 있다.

<pre class="brush:css">/* -- Reset default style -- */
body, h1, p{border:0; margin:0; padding:0;}
body{font-family:Arial, Helvetica, sans-serif; font-size:12px;}

/* ------------ */
/* HEADER */
#header{
padding:6px;
background:#444444;
}
/* PAGE BODY */
#page-body{padding:10px;}
h1{font-size:14px; font-weight:bold;}
h1 a:link, a:visited{color:#0033CC;}
.tag{font-size:12px; margin-bottom:20px;}
.tag a:link, .tag a:visited{color:#999999;}

/* FOOTER */
#footer{
padding:6px;
border-top:solid 1px #DEDEDE;
color:#999999;
font-size:11px;
}
#footer a:link, #footer a:visited{
color:#666666;
}</pre>

결과는 이런 식이 될 것이다.

<img class="aligncenter" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile8.uf.150941494D4BC89A2A8A6E.png" alt="" width="306" height="280" />

당연히, 이건 아주 기본적인 제안일 뿐이다. 직접 이미지나 로고, 색깔, 글꼴을 추가하고, PHP나 Coldfusion, ASP나 다른 코드를 집어 넣어서 동적인 페이지를 만들어야 한다. 예를 들면, CSS코드를 몇 개를 고쳐서 이렇게 만들 수도 있다.

<img class="aligncenter" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile4.uf.1140694E4D4BC89B338C13.png" alt="" width="481" height="512" />

또, 독자들이 원하는 것을 빨리 찾을 수 있도록 헤더에 검색창을 넣을 수도 있다. 나는 또한 [사이트 구조를] 심플하게 유지하라고 말하고 싶다. 소셜 네트워크 버튼 같은 쓸모없는 요소를 넣지 마라.(delicious tagometer나 digg같은 것 말이다.(한국으로 치면 다음뷰나 믹시, 블코 버튼 같은 게 되겠다)) 자바스크립트를 사용하는 위젯도 마찬가지다. 이것은 모바일용 페이지고, 모바일용 페이지는 심플하게 유지돼야 한다. 사용성있고 읽기쉽게 말이다. 다른 건 중요하지 않다.

## 윈도우 모바일을 사용하는 기기의 폰트 사용에 대해

윈도 모바일이 탑재된 모바일 기기를 사용한다면, Arial, Verdana, Georgia 같은 기본 폰트가 설치돼 있지 않다. 그래서 웹페이지를 제대로 보기 위해서는 이렇게 웹디자인에 아주 많이 사용되는 폰트를 모바일 기기로 복사해 줘야 한다. 탐색기를 클릭해서, PC에서(혹은 MAC에서) 이 폰트들을 모바일 기기에 있는 Windows > Fonts 폴더에 집어 넣어라.

*   - Arial
*   - Verdana
*   - Georgia
*   - Trebouchet MS
*   - Times New Roman

## WordPress 모바일 플러그인

만약 WordPress를 사용하고 있고, 모바일용 사이트를 빨리 제작하고 싶다면, WordPress 모바일 플러그인을 다운받을 수 있다.

*   Download WordPress Mobile Plugin

이게 전부다! 다른 제안이 있거나, 이 주제에 대한 재밌는 링크가 있다면 코멘트 남겨 주시면 고맙겠다. :)