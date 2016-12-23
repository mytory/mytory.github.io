---
title: 'SVG 활용 5 &#8211; SVG에 애니메이션 효과 주기'
author: 안형우
layout: post
permalink: /archives/11444
mytory_md_path:
  - http://dl.dropboxusercontent.com/u/15546257/mytory-md-content/svg5.md
categories:
  - 웹 퍼블리싱
tags:
  - SVG 활용
  - 마법 나무 테마
---

## 목차

1. [SVG 활용 1 – 아이콘 폰트가 아니라 SVG를 사용한 이유](/archives/11169)
2. [SVG 활용 2 – 일러스트레이터를 이용해서 SVG 파일 만들기](/archives/11175)
3. [SVG 활용 3 – 웹 문서에 SVG를 넣는 다양한 방법, 온갖 예외 피하기](/archives/11213)
4. [SVG 활용 4 – 미지원 브라우저 대응](/archives/11338)
5. SVG 활용 5 – SVG에 애니메이션 효과 주기

SVG에 애니메이션 효과를 주는 여러 방법
--------------------------------------

SVG에 애니메이션 효과를 주는 방법은 여러 가지가 있다.

* CSS transition을 이용하는 방법
* js를 이용하는 방법
* SVG의 애니메이션 효과를 이용하는 방법

나는 본격적으로 방법을 다루진 않을 것이다. 내 블로그에 이용한 정도만 다룰 것이고, 따라서 인라인 SVG에 CSS transition 효과를 이용해 애니메이션 효과를 주는 방법만 다룰 것이다.

나머지는 참고할 링크만 전달한다.

인라인 SVG에 CSS trasition 주기
--------------------------------

inline SVG란 HTML 문서 안에 `svg` 태그를 이용해서 SVG를 박은 경우를 뜻한다. 지금 바로 아래 보이는 SVG가 그런 inline SVG다. 텍스트만 보인다면 inline SVG를 지원하지 않는 브라우저를 이용하고 있는 것이다.

<p data-height="268" data-theme-id="0" data-slug-hash="vhpGi" data-default-tab="result" data-user="mytory" class='codepen'>See the Pen <a href='http://codepen.io/mytory/pen/vhpGi/'>plain svg circle </a> by Ahn, Hyoung-woo (<a href='http://codepen.io/mytory'>@mytory</a>) on <a href='http://codepen.io'>CodePen</a>.</p>
<script async src="//assets.codepen.io/assets/embed/ei.js"></script>

이 원의 코드는 아래와 같다.

<p data-height="268" data-theme-id="0" data-slug-hash="vhpGi" data-default-tab="html" data-user="mytory" class='codepen'>See the Pen <a href='http://codepen.io/mytory/pen/vhpGi/'>plain svg circle </a> by Ahn, Hyoung-woo (<a href='http://codepen.io/mytory'>@mytory</a>) on <a href='http://codepen.io'>CodePen</a>.</p>

inlnie SVG는 HTML의 한 요소로 취급된다. 이 말은 CSS가 적용된다는 말이다. 그래서 그냥 클래스나 아이디를 줘서 CSS로 제어하면 된다는 말이다.

CSS 코드는 아래처럼 사용하면 된다.

<p data-height="268" data-theme-id="0" data-slug-hash="GteBD" data-default-tab="css" data-user="mytory" class='codepen'>See the Pen <a href='http://codepen.io/mytory/pen/GteBD/'>plain svg circle </a> by Ahn, Hyoung-woo (<a href='http://codepen.io/mytory'>@mytory</a>) on <a href='http://codepen.io'>CodePen</a>.</p>

위 스타일을 적용하면 아래처럼 된다.

<p data-height="268" data-theme-id="0" data-slug-hash="GteBD" data-default-tab="result" data-user="mytory" class='codepen'>See the Pen <a href='http://codepen.io/mytory/pen/GteBD/'>plain svg circle </a> by Ahn, Hyoung-woo (<a href='http://codepen.io/mytory'>@mytory</a>) on <a href='http://codepen.io'>CodePen</a>.</p>

`stroke`나 `stroke-width`, `fill` 속성은 CSS로 제어할 수 있다. `cx`, `cy`, `r` 속성은 CSS로 제어되지 않는다. SVG에 사용할 수 있는 CSS 프로퍼티 목록은 [SVG's styling properties](http://www.w3.org/TR/SVG/styling.html#SVGStylingProperties)에서 볼 수 있다.

CSS3 애니메이션을 먹이는 방법은 간단하다. 그냥 `transition` 속성을 주면 된다. 그리고 `:hover`로 스타일을 변경한다.

<p data-height="268" data-theme-id="0" data-slug-hash="Aasub" data-default-tab="css" data-user="mytory" class='codepen'>See the Pen <a href='http://codepen.io/mytory/pen/Aasub/'>plain svg circle </a> by Ahn, Hyoung-woo (<a href='http://codepen.io/mytory'>@mytory</a>) on <a href='http://codepen.io'>CodePen</a>.</p>

아래는 이 코드를 적용한 SVG 원이다. 마우스를 올리면 색이 스르르 변한다.

<p data-height="268" data-theme-id="0" data-slug-hash="Aasub" data-default-tab="result" data-user="mytory" class='codepen'>See the Pen <a href='http://codepen.io/mytory/pen/Aasub/'>plain svg circle </a> by Ahn, Hyoung-woo (<a href='http://codepen.io/mytory'>@mytory</a>) on <a href='http://codepen.io'>CodePen</a>.</p>

SVG 안에 애니메이션 코드 넣기
----------------------------

인라인 SVG가 기존 방식대로 가장 편하게 애니메이션을 먹일 수 있는 방법이다. 그러나 SVG 파일 안에 애니메이션을 박을 수도 있다. 단, 이 경우엔 `img` 태그로 SVG 파일을 넣으면 안 되고, `object`, `embed`, `iframe` 중 하나로 넣어야 한다. 아래 링크를 타고 가서 예제를 살펴 보면 된다.

<del>[▶SVG 포함하기 예시 링크](/wp-content/uploads/svg-ex/)</del>(현재 링크가 깨져 있다. 복구중.)

SVG 파일 안에서 js를 사용하는 경우엔 아래처럼 `type`을 `text/ecmascript`라고 줘야 하고, `<![CDATA[ ... ]]>`로 감싸야 한다.

    <?xml ...
    <!DOCTYPE ...
    <svg ...>
        <script type="text/ecmascript"><![CDATA[
            // code...
        ]]></script>
    </svg>

스타일은 특별히 다를 게 없으니 따로 설명하지 않겠다. `svg` 태그 안에만 잘 적어 주면 된다. 아, 외부 스타일시트도 SVG에 연결할 수 있다는 점을 알아 두자. CSS 관련해서 자세한 내용은 아래 링크에서 볼 수 있다.

[▶SVG and CSS - Cascading Style Sheets](http://tutorials.jenkov.com/svg/svg-and-css.html)

SVG의 애니메이션 태그 이용하기
------------------------------

SVG의 애니메이션 태그를 이용하면 더 멋지게 효과를 줄 수 있다. 이건 이번 테마에 전혀 사용하지 않았으니 설명하지 않겠다. 나도 경험이 없다. 애니메이션 태그를 이용하고 싶다면 아래 링크를 참고하라.

[▶SVG Animation](http://tutorials.jenkov.com/svg/svg-animation.html)

끝
-----

이것으로 내가 이번에 내 블로그 테마(마법 나무)를 새로 만들면서 익힌 SVG 관련 사항을 모두 공유했다.
