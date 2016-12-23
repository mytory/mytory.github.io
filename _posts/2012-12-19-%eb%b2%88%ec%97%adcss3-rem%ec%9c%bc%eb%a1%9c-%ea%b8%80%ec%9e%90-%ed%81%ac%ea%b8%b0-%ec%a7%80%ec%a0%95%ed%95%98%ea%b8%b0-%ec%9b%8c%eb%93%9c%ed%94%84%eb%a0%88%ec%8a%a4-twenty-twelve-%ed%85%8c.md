---
title: '[번역:CSS3] rem으로 글자 크기 지정하기 &#8211; 워드프레스 Twenty Twelve 테마에 사용된 놈'
author: 안형우
layout: post
permalink: /archives/8906
daumview_id:
  - 37997865
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - CSS3
---
워드프레스의 새로운 테마인 Twenty Twelve의 style.css를 살펴 보면 rem이란 단위가 사용된 것을 알 수 있다. <a class="simple-footnote" title="이거 사족인데 Twenty Twelve는 그냥 2012다." id="return-note-8906-1" href="#note-8906-1"><sup>1</sup></a> 테마 맨 앞부분의 설명을 보면 아래와 같은 설명을 접할 수 있다. 영어고 좀 길지만 그냥 다 인용한다. 대충 보고 넘겨라. rem이 14를 의미하고 line-height가 24를 의미한다고 나와 있는 것 정도는 이해할 수 있을 거고, 스타일을 픽셀 단위로 우선 선언한 뒤 rem 단위로 덮어쓴다는 걸 알 수 있을 것이다.

<pre class="brush: css; gutter: true">/* =Notes
--------------------------------------------------------------
This stylesheet uses rem values with a pixel fallback. The rem
values (and line heights) are calculated using two variables:

$rembase:     14;
$line-height: 24;

---------- Examples

* Use a pixel value with a rem fallback for font-size, padding, margins, etc.
	padding: 5px 0;
	padding: 0.357142857rem 0; (5 / $rembase)

* Set a font-size and then set a line-height based on the font-size
	font-size: 16px
	font-size: 1.142857143rem; (16 / $rembase)
	line-height: 1.5; ($line-height / 16)

---------- Vertical spacing

Vertical spacing between most elements should use 24px or 48px
to maintain vertical rhythm:

.my-new-div {
	margin: 24px 0;
	margin: 1.714285714rem 0; ( 24 / $rembase )
}

---------- Further reading

http://snook.ca/archives/html_and_css/font-size-with-rem


http://blog.typekit.com/2011/11/09/type-study-sizing-the-legible-letter/</pre>

여튼간에, 이런 걸 보면 원리를 이해하려고 노력을 해야 한다. 친절하게도 워드프레스 테마 팀이 &#8216;더 읽을 거리&#8217;의 링크를 제공해 줬으니 그걸 번역해 보기로 했다. 두 개의 링크 중 위에 있는 링크를 번역한 거다. 원문은 [FONT SIZING WITH REM][1] 이다. 지금부터 번역 시작.

# rem으로 글자 크기 지정하기

요즘까지도, 글자 크기 측정 단위를 뭘로 결정할지는 뜨거운 주제가 될 수 있다. 불행히도, 다양한 장단점이 있고, 그래서 약간 결함이 있는 다양한 방법들이 있는 거다. 약간 결함이 있는 것 중에 무엇을 사용하는 것이 가장 바람직한지가 문제일 뿐이다.

사람들은 주로 다음 두 가지 방법을 사용한다.

1.  px로 사이즈 지정
2.  em으로 사이즈 지정

내가 마법 같은 세 번째 방법을 소개할 텐데, 그 전에 위의 두 가지 접근법을 살펴 보자.

## px로 사이즈 지정하기

웹 초기에는 글자 크기를 지정하기 위해 픽셀을 사용했다. 픽셀은 견고하고 한결같다. 불행히도, [픽셀을 사용해 디자인할 경우] 인터넷 익스플로러(IE) 사용자는 —심지어 IE9 에서도 — 브라우저 기능을 이용해서 글자 크기를 조절할 수 없다. <a class="simple-footnote" title="역자 주 &#8211; 어라? 진짜?" id="return-note-8906-2" href="#note-8906-2"><sup>2</sup></a> 이건 사이트 사용성을 꽤 희생하는 거다. IE의 최근 버전은 다른 주요 브라우저들처럼 페이지 전체의 크기를 확대 축소할 수 있는 기능이 있다. 그래서 어느 정도 문제는 완화됐다.

나는, 개인적으로, 픽셀 기반 레이아웃을 더 선호했다. 픽셀 기반 레이아웃은 일관성을 제공하기 때문이다. 접근성 문제를 극복할 수 있는 툴도 충분하고 말이다. 하지만 난 입장을 바꿨다. 나머지를 알아 보자.

## em으로 사이즈 지정하기

IE에서 글자 크기를 제대로 조절할 수 없는 점은 계속 불만이었다. 그걸 위해서, 우리는 em 단위를 사용할 수 있다. 리차드 루터의 글, [em을 사용해서 글자 크기를 지정하는 방법][2]은 <a class="simple-footnote" title="How to size text using ems" id="return-note-8906-3" href="#note-8906-3"><sup>3</sup></a> 아마 이 접근법에 관해 처음 읽은 글일 것이다. 꽤 오래 전인 2004년에 말이다. (와우, 7년이나 지났다.)

이 방법에서는 퍼센트를 이용해서 body의 기본 글자 크기를 고친다. 이렇게 하면 원래는 16px인 1em이 10px이 된다. 글자 크기를 14px로 하려면 1.4em으로 설정을 하면 된다.

<pre>body { font-size:62.5%; }
h1 { font-size: 2.4em; } /* =24px */
p  { font-size: 1.4em; } /* =14px */
li { font-size: 1.4em; } /* =14px? */</pre>

em을 기반으로 글자 크기를 정하는 경우 문제는 글자 크기가 복잡해진다는 것이다. [위처럼 스타일을 지정하면] 리스트 안의 리스트는 14px이 아니라 20px이 된다. 리스트가 한 단계 더 깊어지면 글자 크기는 27px이 된다! 이 문제를 교정하려면 자식 요소의 글자 크기를 1em으로 선언해서 교정할 수 있다.

<pre>body { font-size:62.5%; }
h1 { font-size: 2.4em; } /* =24px */
p  { font-size: 1.4em; } /* =14px */
li { font-size: 1.4em; } /* =14px? */
li li, li p /* etc */ { font-size: 1em; }</pre>

em 기반으로 글자 크기를 지정할 때 이런 복잡성은 불만일 수 있다. 그럼 또 뭘 할 수 있을까?

## rem으로 사이즈 지정하기

CSS3는 몇 가지 새로운 단위를 소개했다. 그 중에는 &#8220;root em&#8221;을 의미하는 rem이라는 단위도 있다. 아직 졸리지 않다면, rem이 어떻게 작동하는지 살펴 보자.

em 단위는 부모 요소의 글자 크기에 상대적인 크기다. 그래서 복잡한 문제가 생기는 거다. rem 단위는 최상위 요소 혹은 `html` 요소에 상대적인 크기다. 이것이 의미하는 건, html 요소에 글자 크기를 한 번 지정하고, 나머지에서는 그 비율에 따라 글자 크기를 지정하면 된다는 것이다.

<pre>html { font-size: 62.5%; } 
body { font-size: 1.4rem; } /* =14px */
h1   { font-size: 2.4rem; } /* =24px */</pre>

나는 기반이 되는 글자 크기를 62.5%로 지정했다. 이렇게 하면 px과 비슷하게 단위를 사용할 수 있기 때문이다.

하지만 참담한 수준의 브라우저 지원을 걱정해야 하지 않나?

브라우저 지원이 꽤 괜찮다는 걸 알면 놀랄 거다. 사파리5, 크롬, 파이어폭스 3.6 이상, 그리고 심지어 인터넷 익스플로러 9도 이걸 지원한다. rem을 사용하면 IE9이 글자 크기 조절을 지원한다는 것도 좋은 소식이다. (아아, 불쌍한 오페라는 (최소한 11.10까지는) rem 단위를 아직 구현하지 않았다.)

rem 단위를 지원하지 않는 브라우저를 위해 뭘 해야 할까? 우리는 대체제로 px를 사용할 수 있다. 구버전의 익스플로러에서 글자 크기 조정이 안 되는 것을 신경쓰지 않는다면 말이다. (음, 여전히 IE7과 IE8에서 페이지 확대는 된다.) 그렇게 하기 위해서, 우리는 글자 크기를 먼저 px로 지정하고, 그 다음 rem을 사용해서 지정을 한다.

<pre>html { font-size: 62.5%; } 
body { font-size: 14px; font-size: 1.4rem; } /* =14px */
h1   { font-size: 24px; font-size: 2.4rem; } /* =24px */</pre>

와우! 이제 우리는 모든 브라우저에서 일관되고 예측가능한 크기 지정을 할 수 있다. 그리고 모든 주요 브라우저의 최신 버전에서 글자 크기 조정을 할 수 있다.

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>
  
  <ol>
    <li id="note-8906-1">
      이거 사족인데 Twenty Twelve는 그냥 2012다. <a href="#return-note-8906-1">&#8617;</a>
    </li>
    <li id="note-8906-2">
      역자 주 &#8211; 어라? 진짜? <a href="#return-note-8906-2">&#8617;</a>
    </li>
    <li id="note-8906-3">
      <a href="http://clagnut.com/blog/348/"><i>How to size text using ems</i></a> <a href="#return-note-8906-3">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://snook.ca/archives/html_and_css/font-size-with-rem
 [2]: http://clagnut.com/blog/348/