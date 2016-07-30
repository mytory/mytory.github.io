---
title: '[번역] CSS와 jQuery를 이용한 메가 드롭 다운 메뉴 튜토리얼'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1488
aktt_notify_twitter:
  - yes
daumview_id:
  - 36699910
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
이 메가 드롭다운 메뉴는 내가 애용하는 것이다.

튜토리얼이라 커스터마이징하기는 좀 까다롭지만 말이다.

오늘도 고칠 일이 좀 생겼는데 골치가 좀 아파서 그냥 튜토리얼을 번역하기로 결심했다. 그동안은 그냥 갔다 쓰기만 했는데 이번엔 한 번 제대로 공부해 볼 셈으로 말이다.

그럼 이제부터 번역 시작이다. 이 글을 보면 이 사람의 메가 드롭 다운 메뉴도 커스터마이징하기 쉬울 거다.

## [Mega Drop Down Menus w/ CSS & jQuery][1]

4wheelparts.com 을 재디자인하는 과정에서, 나는 많은 목록과 카테고리를 잘 다룰 수 있는 새로운 방법을 탐구해 보기로 결심했다. 나는 몇 가지 연구를 했고, e커머스 사이트에서 &#8220;메가 드롭 다운 메뉴&#8221;라고 부르는 새로운 트렌드에 주목했다.

사용성 전문가인 제이콥 닐슨의 말을 들어 보면, 메가 드롭 다운 메뉴는 테스트 결과, 스케일이 큰 웹사이트에서 효과적이었다고 한다. 나는 다른 방법으로 이 테크닉을 구현하는 실험을 해 보기로 했다. 그리고 내가 이 방법을 어떻게 기뤘는지 공유하도록 하겠다.

> 일반적인 드롭 다운 메뉴가 사용성 문제로 가득한 것을 감안할 때, 새로운 형태의 드롭다운 메뉴를 추천하는 것은 좀 망설여진다.(it takes a lot for me to recommend a new form of drop-down.) 하지만 우리 테스트 비디오를 보면 메가 드롭 다운 메뉴가 아래로 펼쳐지는 일반적인 드롭다운 메뉴보다 낫다. 따라서, 나는 다른 것들에게 대해 경고를 하면서 하나를 추천할 수 있다. &#8211; [Jakob Nielson &#8211; Alert Box][2]

그의 글에서, 드롭 다운 메뉴는 마우스가 올라갔을 때(hover)와 내려갔을 때(out) 메뉴가 펼쳐지는 시간에 잠깐의 딜레이가 있어야 한다는 것을 읽었을 때, 나는 이 일에 [Hover Intent Jquery plugin][3]을 사용하겠다고 마음먹었다.

<p style="text-align: center;">
  <img class="aligncenter" src="/uploads/legacy/mega-dropdown-demo.jpg" alt="" width="575" height="200" />
</p>

<p style="text-align: center;">
  <del>데모 보기</del> [이 사람 블로그가 통째로 없어졌다]
</p>

## 스텝 1. 기초공사 &#8211; HTML

그동안 내가 한 모든 내비게이션 튜토리얼처럼, 시작은 순서없는 목록(ul)을 만드는 것이다. 내가[ CSS Sprite][4]를 사용할 것이기 때문에, 모든 목록에는 자신만의 클래스명이 붙어 있어야 한다. [역자 주: 하나의 큰 이미지에 모든 이미지를 때려 박고, css에서 백그라운드 위치를 조정해서 이미지를 표시하는 거다. 이미지를 하나만 다운받으면 되기 때문에 http 요청을 줄여 줄 수 있다.]

<pre class="brush:xml">&lt;ul id="topnav"&gt;
    &lt;li&gt;&lt;a href="#" class="home"&gt;Home&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#" class="products"&gt;Products&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#" class="sale"&gt;Sale&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#" class="community"&gt;Community&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href="#" class="store"&gt;Store Locator&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>

## 스텝 2. 기초 스타일 잡기 &#8211; CSS

우리 드롭 다운 메뉴가 [absolute positioning][5]을 사용할 것이기 때문에, 목록 아이템에는 relative positioning이 매겨져 있어야 한다. 텍스트는 text-indent 값을 -9999px 로 줘서 다 안 보이는 곳으로 보내 버리도록 한다. 우리는 내비게이션 링크를 모두 이미지로 대체할 것이다. 링크별로 각각 이미지를 줘서 말이다.

<pre class="brush:css">ul#topnav {
	margin: 0; padding: 0;
	float:left;
	width: 100%;
	list-style: none;
	font-size: 1.1em;
}
ul#topnav li {
	float: left;
	margin: 0; padding: 0;
	position: relative; /*--중요하다--*/
}
ul#topnav li a {
	float: left;
	text-indent: -9999px; /*--텍스트를 페이지 밖으로 보내서 없앤다--*/
	height: 44px;
}
ul#topnav li:hover a, ul#topnav li a:hover { background-position: left bottom; } /*--Hover 상태--*/
ul#topnav a.home {
	background: url(nav_home.png) no-repeat;
	width: 78px;
}
ul#topnav a.products {
	background: url(nav_products.png) no-repeat;
	width: 117px;
}
ul#topnav a.sale {
	background: url(nav_sale.png) no-repeat;
	width: 124px;
}
ul#topnav a.community {
	background: url(nav_community.png) no-repeat;
	width: 124px;
}
ul#topnav a.store {
	background: url(nav_store.png) no-repeat;
	width: 141px;
}</pre>

## 스텝 3. 메가 서브 내비게이션 HTML을 만든다

메인 내비게이션 링크의 바로 뒤에 &#8220;sub&#8221; 클래스를 [가진 요소를] 추가한다. 그리고 그 안에 순서없는 목록(ul)을 집어 넣는다. 각각의 순서없는 목록(ul)은 메가 드롭 다운의 내비 컬럼으로 작동할 것이다.

<p style="text-align: center;">
  <img class="aligncenter" src="/uploads/legacy/mega-dropdown-subnav1.jpg" alt="" width="512" height="277" />
</p>

<pre class="brush:xml">&lt;ul id="topnav"&gt; &lt;li&gt;&lt;a href="#" class="home"&gt;Home&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;
    	&lt;a href="#" class="products"&gt;Products&lt;/a&gt;
        &lt;strong&gt;&lt;div class="sub"&gt;&lt;/strong&gt;
            &lt;ul&gt;
                &lt;li&gt;&lt;h2&gt;&lt;a href="#"&gt;Desktop&lt;/a&gt;&lt;/h2&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
            &lt;ul&gt;
                &lt;li&gt;&lt;h2&gt;&lt;a href="#"&gt;Laptop&lt;/a&gt;&lt;/h2&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
            &lt;ul&gt;
                &lt;li&gt;&lt;h2&gt;&lt;a href="#"&gt;Accessories&lt;/a&gt;&lt;/h2&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
            &lt;ul&gt;
                &lt;li&gt;&lt;h2&gt;&lt;a href="#"&gt;Accessories&lt;/a&gt;&lt;/h2&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a href="#"&gt;Navigation Link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;strong&gt;&lt;/div&gt;&lt;/strong&gt;
    &lt;/li&gt;
    &lt;li&gt;&lt;a href="#" class="sale"&gt;Sale&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href="#" class="community"&gt;Community&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href="#" class="store"&gt;Store Locator&lt;/a&gt;&lt;/li&gt; &lt;/ul&gt;</pre>

## 스텝 4. 메가 서브 내비게이션 스타일링 &#8211; CSS

서브 메뉴를 상위 메뉴의 왼쪽 하단에 정확히 위치시키기 위해서, .sub 컨테이너에 absolute 위치를 세팅해 줘야 한다. top은 44px로 하고, left는 0으로 준다. 스타일을 위해, 브라우저가 지원하는 경우에는 둥근 모서리가 되도록 한다.(파이어폭스, 크롬, 사파리)

목록 안에 목록이 있는 경우 충돌하는 CSS 요소를 덮어써 줄 필요가 있다는 점을 기억하라. 아래 코드의 주석을 참고하라.

<pre class="brush:css">ul#topnav li .sub {
	position: absolute; /*--중요하다--*/
	top: 44px; left: 0;
	z-index: 99999;
	background: #344c00 url(sub_bg.png) repeat-x; /*--Background 그라디언트--*/
	padding: 20px 20px 20px;
	float: left;
	/*--오른쪽 하단 둥근 모서리--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Bottom left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	display: none; /*--js가 꺼져 있을 때는 감춘다.--*/
}
ul#topnav li .row { /*--줄을 바꿔야 하는 경우--*/
	clear: both;
	float: left;
	width: 100%;
	margin-bottom: 10px;
}
ul#topnav li .sub ul{
	list-style: none;
	margin: 0; padding: 0;
	width: 150px;
	float: left;
}
ul#topnav .sub ul li {
	width: 100%; /*--부모 li 속성을 덮어 쓴다--*/
	color: #fff;
}
ul#topnav .sub ul li h2 { /*--서브 내비게이션의 h2--*/
	padding: 0;  margin: 0;
	font-size: 1.3em;
	font-weight: normal;
}
ul#topnav .sub ul li h2 a { /*--서브 내비게이션 h2 안의 링크--*/
	padding: 5px 0;
	background-image: none;
	color: #e8e000;
}
ul#topnav .sub ul li a {
	float: none;
	text-indent: 0; /*--부모 li의 text-indent를 덮어 쓴다--*/
	height: auto; /*--부모 li의 height를 덮어 쓴다--*/
	background: url(navlist_arrow.png) no-repeat 5px 12px;
	padding: 7px 5px 7px 15px;
	display: block;
	text-decoration: none;
	color: #fff;
}
ul#topnav .sub ul li a:hover {
	color: #ddd;
	background-position: 5px 12px ;/*--background 위치를 덮어 쓴다--*/
}</pre>

## 스텝 5. jQuery와 hover Intent를 세팅한다.

jQuery에 친숙하지 않은 사람들을 위해, [jQuery][6]를 작동시키는 방법을 간략히 짚고 넘어간다. 나는 그동안 몇 가지 jQuery 트릭을 소개해 왔다. 이번 기회에 추가로 그것들을 살펴 보는 것도 좋을 것이다.

### 기본 스텝 &#8211; jQuery 파일을 호출한다

jQuery 사이트에서 파일을 [다운로드][7]하거나, 구글에서 호스트할 수 있다.

<pre class="brush:xml">&lt;script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"&gt;&lt;/script&gt;</pre>

jQuery 파일을 호출한 뒤, 최신 [Hover Intent jQuery Plugin][3] 을 다운로드한다.

## 스텝 6. Document Ready 코드를 준비한다.

jQuery와 hover intent 파일을 호출한 바로 뒤에, 새로운 <script> 태그를 열고, $(document).ready 이벤트에 사용할 코드를 작성한다. 이것은, 문서가 로드되어 DOM을 조작할 준비가 되는 순간 jQuery 코드가 실행되게 해 준다.

<pre class="brush:js">$(document).ready(function() {
	//여기에 코드를 쓴다
});</pre>

## 스텝 7. Hover Over와 Hover Out 이벤트를 세팅한다 &#8211; jQuery

Note: hover intent 플러그인을 사용할 때, 그 자신의 함수 안에 각각 hover over, hover out이 있어야 한다.

### 로직

드롭 다운 메뉴의 부모 링크가 hover over 상태일 때:

1.  .sub를 찾아서 fade in 한다.(기본적으로, 우리는 투명도 0까지 fade 시킨다.)
2.  .row가 있는지 체크한다.(줄이 한 개 이상 있는 경우를 위해)
3.  .row가 있다면, 가장 넓은 줄을 찾아서 .sub 컨테이너의 width를 세팅한다.
4.  .row가 **없다면, **.sub 컨테이너의 width를 세팅한다.

hover out 상태일 때:

1.  .sub를 찾아서 fade out 한다.(투명도 Opacity 0)
2.  .sub를 감춘다.(Display none &#8211; 그래서 완전히 사라지게 한다.)

아래 코드에 있는 주석은 각각의 jQuery 액션이 뭘 하는지 설명한다.

<pre class="brush:js">//Hover Over 일 때
function megaHoverOver(){
    $(this).find(".sub").stop().fadeTo(&#039;fast&#039;, 1).show(); //sub를 찾아서 페이드인 한다.
    (function($) {
        //ul의 전체 width를 구하는 함수.
        jQuery.fn.calcSubWidth = function() {
            rowWidth = 0;
            //Calculate row
            $(this).find("ul").each(function() { //각각의 ul을 돈다...
                rowWidth += $(this).width(); //각각의 ul의 너비를 합산한다.
            });
        };
    })(jQuery); 

    if ( $(this).find(".row").length &gt; 0 ) { //row가 있다면...

        var biggestRow = 0;	

        $(this).find(".row").each(function() {	//각각의 row를 돈다...
            $(this).calcSubWidth(); //모든 ul의 너비를 합산하는 함수를 호출한다.
            //가장 넓은 row를 찾는다.
            if(rowWidth &gt; biggestRow) {
                biggestRow = rowWidth;
            }
        });

        $(this).find(".sub").css({&#039;width&#039; :biggestRow}); //width 세팅
        $(this).find(".row:last").css({&#039;margin&#039;:&#039;0&#039;});  //마지막 row의 margin을 없앤다.

    } else { //row가 없다면...

        $(this).calcSubWidth();  //모든 ul의 width를 합산하는 함수 호출
        $(this).find(".sub").css({&#039;width&#039; : rowWidth}); //Width 세팅

    }
}
//Hover Out 일 때
function megaHoverOut(){
  $(this).find(".sub").stop().fadeTo(&#039;fast&#039;, 0, function() { //투명도(opacity) 0으로 만든다
      $(this).hide();  //페이드 아웃한 후 숨긴다(hide)
  });
}</pre>

## 커스텀 설정을 하고, 함수를 붙인다(Trigger)

위에서 hover over와 hover out 함수를 선언했다. 이제 커스텀 설정을 하고 hover intent 함수를 호출할 시간이다.

<pre class="brush:js">//custom 설정
var config = {
     sensitivity: 2, // number = 반응 민감도 (1 이상)
     interval: 100, // number = 마우스 over 시 함수 호출 때까지의 간격(밀리초) //milliseconds for onMouseOver polling interval
     over: megaHoverOver, // function = onMouseOver callback (필수)
     timeout: 500, // number = 마우스 out 시 함수 호출 때까지 딜레이 시간
     out: megaHoverOut // function = onMouseOut callback (필수)
};

$("ul#topnav li .sub").css({&#039;opacity&#039;:&#039;0&#039;}); //기본적으로 sub 내비게이션을 투명도 0으로 만든다. $("ul#topnav li").hoverIntent(config); //Hover intent 함수를 custom 설정과 함께 실행</pre>

## 결론

이 스크립트는 (row별로 UL을 추가할 때) .sub 컨테이너의 너비를 계산해서 전체 너비를 자동으로 조정한다는 점을 명심해야 한다. 만약 custom width를 설정하고 싶다면, 해당 코드를 삭제하고 css에 width를 지정하면 된다. 자신의 메가 드롭 다운 메뉴에 무엇을 추가하려고 하는지에 따라 각각 시나리오가 달라질 것이다. 이 튜토리얼의 기본 개념을 파악해서, 미래의 프로젝트에 잘 적용할 수 있기를 바란다. 다른 질문이나 관심사, 제안이 있다면, 알려 주기 바란다!

## 추가로 아이디어를 얻을 수 있는 곳

이제 메가 드롭 다운 메뉴를 처음부터 어떻게 만드는지 알았으므로, 영감을 얻을 수 있는 다른 사이트들을 체크해 보자.

<div style="width: 585px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/mega-dropdown-examples/yahoo.jpg" alt="" width="575" height="311" /><p class="wp-caption-text">
    야후는 디자인이 변경됐으므로 이미지만 보면 된다 - 형우
  </p>
</div>

<p style="text-align: center;">
  <a href="http://www.shop.puma.com/on/demandware.store/Sites-US-Site/en_US/Home-Show"><img class="alignnone" src="/uploads/legacy/mega-dropdown-examples/puma.jpg" alt="" width="575" height="311" /></a>
</p>

<div style="text-align: center;">
  <a href="http://virgin.com"><img class="aligncenter" src="/uploads/legacy/mega-dropdown-examples/virgin.jpg" alt="" width="575" height="311" /></a>
</div>

<div style="text-align: center;">
  <a href="http://www.whitehouse.gov"><img class="aligncenter" src="/uploads/legacy/mega-dropdown-examples/whitehouse.jpg" alt="" width="575" height="311" /></a>
</div>

<div style="text-align: center;">
  <a href="http://www.rei.com"><img class="aligncenter" src="/uploads/legacy/mega-dropdown-examples/rei.jpg" alt="" width="575" height="311" /></a>
</div>

<div style="text-align: center;">
  <a href="http://www.gateway.com"><img class="aligncenter" src="/uploads/legacy/mega-dropdown-examples/gateway.jpg" alt="" width="575" height="311" /></a>
</div>

<div>
  <a href="http://www.billabong.com/us"><img class="alignnone aligncenter" src="/uploads/legacy/mega-dropdown-examples/billabong.jpg" alt="" width="575" height="311" /></a>
</div>

## 관련 글

*   <a href="http://www.smashingmagazine.com/2009/03/24/designing-drop-down-menus-examples-and-best-practices/" target="_blank">Designing Drop-Down Menus: Examples and Best Practices</a>
*   <a href="http://cherne.net/brian/resources/jquery.hoverIntent.html" target="_blank">Hover Intent</a>
*   <a href="http://www.useit.com/alertbox/mega-dropdown-menus.html" target="_blank">Mega Drop-Down Navigation Menus Work Well</a>

## 관련 포스트 [저자 블로그가 사라졌다]

<ul class="related_post">
  <li>
    Animated Navigation with CSS & jQuery
  </li>
  <li>
    Horizontal Subnav with CSS
  </li>
  <li>
    Guest Post – Sexy Drop Down Menu
  </li>
  <li>
    Simple Tooltip w/ jQuery & CSS
  </li>
  <li>
    Advanced Columns using the :nth-child(N)
  </li>
</ul>

## 저자

내 이름은 Soh Tanaka이고, 나는 로스앤젤레스에 기반을 두고 있는 디자이너/프론트-엔드 개발자다. CSS주도 웹디자인에 특화된다. 사용성과 검색엔진 최적화가 특기인. 나는 또한 <a href="http://www.designbombs.com" target="_blank">CSS Gallery</a>를 운영하고 있다. 매일 전 세계의 훌륭한 CSS 웹사이트를 올려 주는 사이트다. <a href="http://www.designbombs.com" target="_blank">방문해 보기 바란다</a>!

## 이 글이 좋았다면?

[RSS][8]나 [email][9]로 구독하라. 최신 글과 튜토리얼을 빠짐없이 볼 수 있다.

 [1]: http://neilkearney.net/welcome/mega-drop-down-menus-w-css-jquery/
 [2]: http://www.useit.com/alertbox/mega-dropdown-menus.html
 [3]: http://cherne.net/brian/resources/jquery.hoverIntent.html
 [4]: http://coding.smashingmagazine.com/2009/04/27/the-mystery-of-css-sprites-techniques-tools-and-tutorials/
 [5]: http://coding.smashingmagazine.com/2009/10/05/mastering-css-coding-getting-started/#CSS-Basics7
 [6]: http://jquery.com
 [7]: http://code.google.com/p/jqueryjs/downloads/detail?name=jquery-1.3.2.min.js&downloadBtn=
 [8]: http://feeds2.feedburner.com/sohtanaka
 [9]: http://feedburner.google.com/fb/a/mailverify?uri=sohtanaka