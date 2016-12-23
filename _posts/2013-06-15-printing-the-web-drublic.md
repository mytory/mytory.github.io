---
title: '[번역] 웹을 인쇄하기'
author: 안형우
layout: post
permalink: /archives/9796
daumview_id:
  - 46177065
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - CSS3
---
원문은 <a title="Permalink to Printing The Web" href="http://drublic.de/blog/printing-the-web/" rel="entry-title">Printing The Web</a>이다.

[역자 주] page란 단어를 번역하는 데 애먹었다. 애초에 &#8216;페이지&#8217;라고 번역하기로 통일했으면 별 상관 없었을 텐데, 종이에 인쇄된 것을 뜻하는 page는 쪽으로 번역하기로 하는 바람에 발생한 일이다. 문제라고까지 할 지는 모르겠고. 웹 페이지를 의미하는 page는 그래서 굳이 앞에다 &#8216;웹&#8217;이란 단어를 붙여서 &#8216;웹 페이지&#8217;라고 썼다. 마지막으로 &#8216;인쇄 영역&#8217;이라고 번역하는 게 자연스러울 때가 있어서 그냥 &#8216;인쇄 영역&#8217;이라고 번역한 경우도 있다.

다음으로 고민이 들었던 건 &#8216;[CSS Paged Media Specification][1]&#8216;이라는 단어였다. 이건 공식적으로 번역어가 있을 지도 모르겠는데 여기서는 &#8216;페이지가 있는 매체 CSS 스펙&#8217;이라고 번역했다. &#8216;Paged Media Specification&#8217;은 역시 &#8216;페이지가 있는 매체 스펙&#8217;이라고 번역했다.

![Printable Websites - some books][2]

**스마트폰과 태블릿으로 거의 모든 콘텐츠를 소비하는 것이 가능해지면서 많은 웹 개발자에게는 종이없는 사무실의 꿈이 이루어지고 있는 것처럼 보인다.**

**하지만 웹에는 디지털에 익숙한 세대만 있는 게 아니다. 여전히 종이에 웹을 출력해 보는 걸 선호하는 사람들이 있다. 이 점을 알게 되면, 관리하는 사이트에 인쇄 전용 스타일시트를 포함시키고 싶을 거다. 이 글은 최고 품질의 웹 페이지 출력을 위한 조언을 담고 있다.**

**알림:** 이 글은 독일의 [Screen Guide Magazine][3] 15호에 처음 실렸다. (2012년 9~12월호, 77~79쪽). 이 글은 좀더 많은 내용과 진전된 연구 결과를 담고 있다.

인쇄용 스타일시트에 대한 기본적인 내용은 이미 대부분의 웹 개발자들이 알고 있다. 인쇄용 CSS를 포함하는 건 두 가지 방법이 있다.

*   인쇄 매체에 대한 내용만 담고 있는 분리된 파일을 HTML에 포함하는 방법  
    `<link rel="stylesheet" media="print" href="css/print.css">`
*   인쇄 모드를 대상으로 하는 특정한 미디어 쿼리를 일반적인 스타일시트에 통합하는 방법.  
    `@media print { … }`

어떤 방법을 사용할 지는 아주 명확하다. 우리는 추가적인 스타일시트 때문에 서버에 또다른 요청을 보내고 싶지 않다. 따라서 우리는 미디어쿼리를 이용해서 스타일을 포함할 거다. LESS나 Sass 같은 전처리기(preprocessor)와 빌드 시스템 덕분에 파일을 분리해 뒀다가 발행 시점에 파일을 쉽게 합칠 수 있다.

## 잡동사니 제거하기

일반적으로, 인쇄용 스타일시트에서 웹 페이지의 주요 내용에 초점을 맞추는 것은 아주 중요하다.`display: none;`을 이용해서 내비게이션과 바닥글 같은 불필요한 웹 페이지 요소를 제거하자. 하지만 인쇄물에서 웹사이트의 정체성을 표시해 줄 로고를 제거하고 싶지는 않을 것이다. (흑백 출력에서 좀더 나은 단색 로고를 갖고 있을지도 모르겠다. 이걸 배경 이미지로 포함할 수 있다. 사용자가 설정으로 덮어쓸 수도 있지만 말이다.)

가독성 있는 글꼴과, 충분한 글자 크기에 대해 생각해야 한다. 인쇄물에서는 보통 본문을 12px보다 크게 하지 않는다. 하지만 모니터에서는 16px이 전혀 이상하지 않다. 나아가, 밝은 배경에 진한 글자색으로 출력하는 것은 중요하다. [아마 기본 글자색을 검정으로 사용하는 게 가장 좋을 것][4]이다.

검정색으로 출력하는 것은 다른 색으로 출력하는 것보다 더 경제적이기도 하다.

의심스럽다면, 글자에 효과를 주고 웹 페이지를 출력해 봐라. <a class="simple-footnote" title="When in doubt, print the page while developing it to get a better feeling for the font setup." id="return-note-9796-1" href="#note-9796-1"><sup>1</sup></a>

## 내용을 개선하기

웹 페이지 내용에 더 나은 것을 추가하는 여러 테크닉이 있다. 그 중 하나는 링크 바로 뒤에 URL을 추가하는 것이다. 웹 페이지 내의 책갈피나 자바스크립트 핸들러에는 그렇게 하면 안 된다. 정보성 내용이 아니기 때문이다.

    a[href]:after {
        content: " (" attr(href) ")";
    }
    
    a[href^="#"]:after,
    a[href^="javascript"]:after {
        content: "";
    }
    

`abbr`(abbreviations, 약어)요소에도 `title` 속성을 이용해서 그렇게 하면 유용하다. (기술적으로 같은 규칙이 `acronym`에도 적용된다. &#8211; [Adrian Roselli][5]이 기여해 줬다.)

    abbr[title]:after {
        content: " (" attr(title) ")";
    }
    

이 기술에 대해서 [더 자세한 내용을 다루고 있는 글][6]도 있다.

**수정:** [Tim이 댓글로 알려 줬다.][7] 링크가 길어서 레이아웃을 깨는 경우에는 `word-wrap: break-word;`를 사용하는 게 필요할 거라고 말이다.

브라우저가 보통 머리글과 바닥글에 출력 웹 페이지의 URL이나 날짜 같은 정보를 보여 준다는 것을 기억하자. 아마 이 표시들을 제거할 수 있는 옵션이 있을 거다. 그러니까 링크나 브레드크럼[**홈 > 소개** 같은 식으로 현재 웹 페이지의 위치를 표시해 주는 것 - 역자]을 출력해서 사용자가 원하면 웹으로 쉽게 돌아올 수 있도록 해 주고 싶을 지도 모르겠다. Adrian Roselli가 추가로 [이 방법을 설명한다.][8]

대부분의 스타일시트는 이 정도만 고려하고 끝낼 것이다. 하지만 특정한 경우에 편리함을 더할 수 있는 헬퍼(helper)와 CSS 규칙이 더 있다.

몇 주 전에 스매싱 매거진에 [재밌는 글][9]이 실렸다. 이 글에는 링크와 이미지 등을 다루는 더 유용한 팁이 있다. 필요하면 봐라.

## 인쇄 영역을 구조화하기

좀더 깊이 들어가 보자.

`@page` at-규칙[@로 시작하는 규칙을 말한다. `@chaset` 같은 거 - 역자]은 인쇄 영역의 구조를 지정한다. 이건 여백을 설정하는 예다.

    @page {
        margin: 2cm 1.5cm;
    }
    

더욱이, 가상 클래스[pseudo-classes, `:before` 같이 선택자 뒤에 `:`를 붙여서 쓰는 선택자 - 역자]를 지정하는 것이 가능하다. 예컨대, `:first`를 사용하면 문서의 1쪽을 대상으로 할 수 있고,`:left`와 `:right`는 짝수, 홀수 쪽을 대상으로 한다(이건 언어별 쓰기 방향에 따라 달라진다). 예컨대, 원고나 잡지를 출력할 때 도움이 될 거다.

속성의 이름을 정하고 각기 다른 요소에 적용하는 것도 가능하다. [아래 예는 `tables`라는 이름의`@page` 속성을 정하고 `table` 요소에 그걸 지정한 것이다.]

    @page tables {
        size: landscape;
    }
    
    table {
        page: tables;
    }
    

아래는 더 실험적인 것들이다. 안정적으로 사용할 수는 없을 것이다. 이 [테스트 케이스][10]를 확인해 봐라. 더 자세한 내용은 [스펙][11]을 참고하라.

`@page`의 규칙에 대해서 더 알고 싶다면 [모질라 개발자 네트워크][12]를 봐라.

`size`를 사용해서 출력할 문서의 종이 사이즈를 지정할 수 있다. 초기 값인 `auto`는 210 x 297mm인 DIN[독일 공업 규격 - 역자] A4용지를 뜻한다. 이렇게 하면 종이 사이즈를 DIN A5로 지정할 수 있다.

    @page {
        size: 148mm 210mm;
    }
    

기본 종이 사이즈를 제어할 수 있더라도, 프린터가 기본 종이 사이즈를 제어하도록 해야 한다. 예컨대, 특히 미국에선 A4 용지를 사용하지 않기 때문이다.

**참고:** CSS로 종이를 자르는 것은 여전히 불가능하다는 것을 알기 바란다. 따라서 이것은 기대 사이즈일 뿐이다. 젠장. 3D 프린터가 우리를 구원할 거다. <a class="simple-footnote" title="Please be aware that it is still not possible to cut a sheet via CSS, thus it is only an expected size. &#8211; 3D 프린터 이야기가 갑자기 왜 나오는지 모르겠다. 그리고 &#8216;cut&#8217;이 진짜로 자르는 걸 의미하는 건지 아니면 쪽을 나누는 걸 의미하는 건지도 정확히는 모르겠다. 하지만 쪽을 나누는 CSS는 있으니까 종이를 자르는 걸 의미할 거라고 생각한다." id="return-note-9796-2" href="#note-9796-2"><sup>2</sup></a>

## 쪽 나누기

`page-break-before`와 `page-break-after` 두 속성은 언제 쪽을 나눌지, 나누지 않을지 지정한다. 예컨대, 헤드라인 뒤에서 쪽이 나뉘기를 바라지는 않을 것이다.

    h2 {
        page-break-after: avoid;
    }
    

`page-break-before`와 `page-break-after`에 넣을 수 있는 값은 다음과 같다.

*   `auto` – 기본 값. 아무 일도 일어나지 않는다.
*   `always` – 쪽을 나눈다.
*   `avoid` – 쪽을 나누지 않게 한다.
*   `left/right` – 한 쪽, 혹은 두 쪽을 나눈다. 좌측 혹은 우측에서 요소를 시작시키기 위해서 말이다. 브로슈어나 책을 인쇄할 때 도움이 될 거다.

나아가, `page-break-inside` 속성도 있다. 이 속성은 위의 속성과 비슷하지만 `auto`와`avoid`만 지정할 수 있다. `avoid`를 지정하면 요소 안에서 쪽을 나누지 않는다. `auto`는 그냥 놔두는 것이다.

## 실험적 속성들

다음 기능들은 아직 개발중이거나 한 브라우저에서만 지원하는 것들이다. 여기서 소개하는 것들 중 몇몇은 [쪽이 있는 매체 CSS 스펙][1]의 일부다. 이 스펙은 새로 나온 것이다.

### 보이는대로 출력하기

`-webkit-print-color-adjust: exact;` 속성은 오직 웹킷 브라우저(즉, 크롬과 사파리)에서만 작동한다. 이 속성은 스크린에서 보이는 것을 완전히 그대로 인쇄할 수 있도록 해 준다. 대부분의 경우, 이것은 CSS 배경을 인쇄할 수 있다는 것을 의미한다. 하지만 조심해라. 그라디언트 버그가 있다. 그라디언트는 전혀 인쇄되지 않는다. 그리고 이 속성은 `body`에 지정할 수 없다(잉?????? :/). [이 잉??은 저자의 것이다. - 역자]

미리 그려 놓은 흑백 최적화 로고를 마크업에 포함하지 않으면서 출력할 때 이 속성이 필요하다. <a class="simple-footnote" title="You need to use this property if you want to print a b/w-optimized logo as outlined earlier and you don’t want to include an image in the markup. &#8211; 마크업에 포함하지 않는다는 말은 배경 속성으로 넣는다는 말인 것 같다. &#8211; 역자" id="return-note-9796-3" href="#note-9796-3"><sup>3</sup></a>

파이어폭스 같은 다른 브라우저는 배경 이미지와 색을 인쇄할지 말지 인쇄 대화창 옵션에서 선택할 수 있도록 한다.

### 과부(widows)와 고아(orphans)

한 쪽에 한 줄만 나오는 것을 막기 위해서 최소 몇 줄이 함께 나와야 하는지 정하는 것이 `orphans`속성이다. 예컨대, 마지막 쪽에 최소 3줄은 나와야 한다면 이렇게 쓴다. `p { orphans: 3; }`[orphan은 고아라는 뜻이다. 문단이 다음 쪽으로 넘어갔는데 글이 다음 쪽에서 바로 끝나서 다음 쪽의 맨 위에 한 줄만 출력되는 줄. 아래 이미지 참고. 이미지는 역자가 넣은 것. 물론 CSS는 문단 차원에서 widow와 orphan을 방지하는 것 같진 않고, 쪽 단위로 방지하는 것 같다. - 역자]

![과부와 고아의 예시.][13]

반면 &#8211; 새 쪽을 시작할 때 한 줄만 있는 경우 &#8211; `widows`가 도움을 줄 것이다. `article { widows: 2; }` 이렇게 쓰면 문단이 다음 쪽에 걸치는 경우 최소 두 줄은 같이 넘어가게 될 것이다.

### Crop Marks And Page Bleed

가끔 종이 한 장을 자르는 특정한 방법을 선언해야 할 때가 있다. <a class="simple-footnote" title="Sometimes you need specific declarations on how to cut a sheet of paper." id="return-note-9796-4" href="#note-9796-4"><sup>4</sup></a> `marks`를 사용하면 가능하다. 가능한 값은 `crop`과 `cross`다. `crop`은 마크를 자르고, `cross`는 기준 마크를 추가한다. <a class="simple-footnote" title="무슨 말인지 당췌 모르겠다. 이 기능을 구현해 놓은 브라우저도 없다. 스펙만 있을 뿐이다. &#8211; With marks it is possible to set marks via the values crop and crosswhile crop adds crop marks and cross adds fiducial marks." id="return-note-9796-5" href="#note-9796-5"><sup>5</sup></a>

[이건 뭔 말인지 모르겠다. - 역자] If this property is set you can specify how far the printable area spreads out of the area defined by the aforementioned marks by using the property `bleed` while using one of the units defined in the [values and units specification][14].

이 속성은 브라우저 벤더가 진짜로 기본적으로 고려하고 있는 [쪽이 있는 매체 모듈을 위해 CSS가 생성한 내용][15]의 일부다. <a class="simple-footnote" title="This property is part of the CSS Generated Content for Paged Media Module which is basically to really recognized by the browser vendors." id="return-note-9796-6" href="#note-9796-6"><sup>6</sup></a>

### 쪽이 나뉘는 지점에 있는 박스

`box-decoration-break` 속성은 쪽이 나뉠 때 배경, 여백, 선을 어떻게 처리할지 정한다. 가능한 값은 두 가지다. (이미지도 참고하라.)

![box-decoration-break: slice and clone][16]

*   `slice` &#8211; 기본 값, 흐르면서 박스를 두 부분으로 &#8220;slice&#8221;한다[자른다].
*   `clone` &#8211; 스타일을 중복해서 각 쪽의 박스에 적용한다.

이것은 현재 오페라의 프레스토 엔진이 지원하며, 곧 크롬도 지원할 것이다.Lennart Schoors가 얼마 전에 자신의 블로그인 Bricss에 [이 속성에 대해 썼다.][17]

파이어폭스에 있는 `-moz-background-inline-policy` 속성은 배경 이미지를 원하는대로 다룰 수 있게 한다. 하지만 이것은 분명 `box-decoration-break`의 부분적인 구현이다.

## 브라우저 지원에 대해 좀 더 말하자면

at-규칙인 `@page`를 인터넷 익스플로러 7을 제외한 모든 주요 브라우저가 지원하고, 파이어폭스가 바로 몇 달 전에 구현했지만, 대부분의 다른 속성들은 훨씬 복잡하다.

*   `page-break-before`와 `page-break-after`에는 `always`만 사용해야 한다. 다른 값들은 지원 안 되는 경우가 많기 때문이다.
*   `page-break-inside`는 인터넷 익스플로러 7이 지원하지 않는다.

실험적 속성은 대부분의 브라우저가 지원하지 않으며, 단 하나의 주요 엔진만 구현했다는 점을 알아야 한다. 예를 들면, `orphans`와 `widows`는 오직 인터넷 익스플로러 8 이상과 오페라만 지원한다. 웹킷 엔진으로 갈아타면서 역사 속으로 사라질 오페라 말이다. [프레스토 엔진 시절의 오페라만 지원한다는 뜻으로 말하는 것 같다. - 역자] `marks`와 `bleed`는 아직 어떤 브라우저도 구현하지 않았다.

## 빠진 것은?

인쇄용 스타일을 만들 때 단점이 있다. 지금까지도 머리글과 바닥글 라인을 정하는 좋은 방법이 없다. 쪽이 나뉜 인쇄를 할 때 아주 도움이 되는데 말이다. 머리글과 바닥글을 첫 쪽과 마지막 쪽에 설정하기 위해서 가상(pseudo) 요소를 `body` 요소에 사용할 수 있다. 하지만 필요에 딱 맞는 건 아니다. 표를 출력할 때 이런 문제를 마주하게 될 것이다. 간단한데, `thead`를 쪽마다 출력할 방법이 없다는 점이다(쪽이 어디서 나뉠지 모르는 한 마크업을 반복하는 것은 진정한 해결책이 될 수 없다).

재밌는 것은 `thead`와 `tfoot` [스펙][18]에는 요소를 각 쪽에 반복할 수 있어 유용하다고 적혀 있다는 점이다. 안타깝게도 이걸 구현한 브라우저 벤더는 아직 없다.

하지만 해결책을 만드는 것은 가능하다. 쪽이 출력되기 직전에 이벤트를 일으키는 자바스크립트를 구현하는 것은 좋은 방법이다. 하지만 [Simon Sapin][19]의 말을 들어 보면, 브라우저가 쪽 레이아웃을 잡는 매커니즘 때문에 진짜로 가능하지는 않다.

> 쪽는 레이아웃을 그리는 동안 나뉜다. (레이아웃을 무효화하고 다시 그리며) DOM을 돌기에는 이미 너무 늦은 것이다. 정말로 레이아웃 엔진에 달린 것이다. <a class="simple-footnote" title="Page breaks happen during layout, much too late to do DOM manipulation (which invalidates and restarts layout). It’s really up to the layout engine to do this." id="return-note-9796-7" href="#note-9796-7"><sup>7</sup></a>

또한 `@page`의 다른 속성이 각 쪽의 머리글과 바닥글을 생성하는 데 도움이 될 수 있다.

다행히 [쪽이 있는 매체 스펙][20]이 이 문제를 해결하려 하고 있다. 이 스펙은 현재 초안에 머물러 있다.

이것은 모든 쪽의 바닥글에 쪽수를 출력하는 예제다.

    @page {
        counter-increment: page;
    
        @top-center {
            content: "Headline, yo!"
        }
    
        @bottom-right {
            counter-increment: page;
            content: "Page " counter(page);
        }
    }
    

`counter-increment` 속성에 `page` 키워드를 쓰는 것은 좀 특별하다. 쪽수(`page`)가 스펙에 따라 자동으로 증가한다. 따라서 우리는 그게 전혀 필요 없다. [신경쓸 필요가 없다는 말인 듯 - 역자] <a class="simple-footnote" title="The counter-increment property is a bit special with the keywordpage – it increments automatically according to the specification, so you don’t need it at all." id="return-note-9796-8" href="#note-9796-8"><sup>8</sup></a>

대박이다! 이건 모든 브라우저에 지금 당장 필요하다.

**수정 &#8211; 2013-03-26:** 사실 머리글과 바닥글을 또다른 방법으로 가능하게 할 수 있다. [Robert Weber][21]가 [밝혀낸 바][22]에 따르면 `position: fixed;`를 사용하면 된다. 안타깝지만, 이 기법은 파이어폭스, 오페라와 인터넷 익스플로러에서만 작동한다. 약간 이상한 모양으로 말이다. [Robert Weber의 댓글][22]을 읽어 보기 바란다.

### 모바일에 대해 한 마디

스마트폰과 태블릿으로 웹 페이지를 방문하는 게 점점 대중화되고 있다. 하지만 그런 기기에서 웹 페이지를 프린트하는 걸 아직 본 적이 없다.

<del>나는 웹 페이지를 출력할 수 있는 모바일 브라우저를 아직 보지 못했다. 하지만 아마 곧 나타날 것 같다.</del>더 아는 사람이 있다면 알려 주기 바란다.

**수정 &#8211; 2013-03-25:** iOS는 무선 프린터에 접속하고 출력하는 기능이 있다고 [Cãtãlin Mariş][23]가 알려 줬다. 이건 애플의 [에어프린트 서비스][24]를 이용한다.

### 서버 단

이 글은 스타일시트를 만들기 위한 서버 단 렌더링 방법을 다루지 않는다. 하지만 브라우저가 아니면서도 출력에 최적화한 CSS 구현이 몇 개 있다. [WeasyPrint][25], [PrinceXML][26] 또는 [AntennaHouse][27] 등이 브라우저가 하지 못한 CSS 구현을 해 놨다.

그러니 좀더 일관된 출력을 해야 한다면 이 라이브러리들을 살펴 봐라.

## 결론

지금까지 이야기한 인쇄용 CSS 속성으로 간단한 구조의 웹사이트는 제어할 수 있다는 게 명확해졌다. 하지만 더 복잡한 어플리케이션은 제대로 제어하기 힘들다는 것이 금세 드러날 것이다.

결론적으로, 쪽이 있는 매체 스펙 같은 새로운 스펙이 등장하면 미래에는 더 나은 방법으로 이 문제를 다룰 수 있을 것이다.

## 감사의 말

이 글에 대해 아주 가치있는 피드백을 해 준 [Adrian Roselli][5]와 [Simon Sapin][28]에게 깊은 감사를 전한다. 이 글을 교정봐 준 [Thomas Caspers][29]에게도 감사한다.

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>
  
  <ol>
    <li id="note-9796-1">
      When in doubt, print the page while developing it to get a better feeling for the font setup. <a href="#return-note-9796-1">&#8617;</a>
    </li>
    <li id="note-9796-2">
      Please be aware that it is still not possible to cut a sheet via CSS, thus it is only an expected size. &#8211; 3D 프린터 이야기가 갑자기 왜 나오는지 모르겠다. 그리고 &#8216;cut&#8217;이 진짜로 자르는 걸 의미하는 건지 아니면 쪽을 나누는 걸 의미하는 건지도 정확히는 모르겠다. 하지만 쪽을 나누는 CSS는 있으니까 종이를 자르는 걸 의미할 거라고 생각한다. <a href="#return-note-9796-2">&#8617;</a>
    </li>
    <li id="note-9796-3">
      You need to use this property if you want to print a b/w-optimized logo as outlined earlier and you don’t want to include an image in the markup. &#8211; 마크업에 포함하지 않는다는 말은 배경 속성으로 넣는다는 말인 것 같다. &#8211; 역자 <a href="#return-note-9796-3">&#8617;</a>
    </li>
    <li id="note-9796-4">
      Sometimes you need specific declarations on how to cut a sheet of paper. <a href="#return-note-9796-4">&#8617;</a>
    </li>
    <li id="note-9796-5">
      무슨 말인지 당췌 모르겠다. 이 기능을 구현해 놓은 브라우저도 없다. 스펙만 있을 뿐이다. &#8211; With <code>marks</code> it is possible to set marks via the values <code>crop</code> and <code>cross</code>while <code>crop</code> adds crop marks and <code>cross</code> adds fiducial marks. <a href="#return-note-9796-5">&#8617;</a>
    </li>
    <li id="note-9796-6">
      This property is part of the <a href="http://www.w3.org/TR/css3-gcpm/#page-marks-and-bleed-area">CSS Generated Content for Paged Media Module</a> which is basically to really recognized by the browser vendors. <a href="#return-note-9796-6">&#8617;</a>
    </li>
    <li id="note-9796-7">
      Page breaks happen during layout, much too late to do DOM manipulation (which invalidates and restarts layout). It’s really up to the layout engine to do this. <a href="#return-note-9796-7">&#8617;</a>
    </li>
    <li id="note-9796-8">
      The <code>counter-increment</code> property is a bit special with the keyword<code>page</code> – it increments automatically according to the specification, so you don’t need it at all. <a href="#return-note-9796-8">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://www.w3.org/TR/css3-page/
 [2]: /uploads/legacy/printing-the-web/print-websites-small-800x346.jpg
 [3]: http://screengui.de/
 [4]: http://www.sanbeiji.com/archives/953
 [5]: http://adrianroselli.com/
 [6]: http://drublic.de/blog/pseudo-classes-in-print-styles-for-references-in-links/
 [7]: http://drublic.de/blog/printing-the-web/#comment-1188
 [8]: http://blog.adrianroselli.com/2013/03/calling-qr-in-print-css-only-when-needed.html
 [9]: http://coding.smashingmagazine.com/2013/03/08/tips-tricks-print-style-sheets/
 [10]: http://dabblet.com/gist/5232020
 [11]: http://www.w3.org/TR/2013/WD-css3-page-20130314/#using-named-pages
 [12]: https://developer.mozilla.org/en-US/docs/CSS/@page
 [13]: /uploads/legacy/widow-and-orphan.png
 [14]: http://www.w3.org/TR/css3-values/
 [15]: http://www.w3.org/TR/css3-gcpm/#page-marks-and-bleed-area
 [16]: /uploads/legacy/printing-the-web/box-break.png
 [17]: http://bricss.net/post/24672339016/box-decoration-break-finally-coming-to-more-browsers
 [18]: http://www.w3.org/TR/CSS21/tables.html#value-def-table-header-group
 [19]: https://twitter.com/SimonSapin
 [20]: http://www.w3.org/TR/2013/WD-css3-page-20130314/
 [21]: http://clt.ag/
 [22]: http://drublic.de/blog/printing-the-web/#comment-1100
 [23]: https://twitter.com/alrra
 [24]: http://support.apple.com/kb/ht4356
 [25]: http://weasyprint.org/
 [26]: http://www.princexml.com/
 [27]: http://www.antennahouse.com/
 [28]: http://exyr.org/
 [29]: http://tomascaspers.de/