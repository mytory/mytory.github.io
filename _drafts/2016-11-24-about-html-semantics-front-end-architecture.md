---
title: '[번역] HTML 시맨틱과 프론트엔드 아키텍처에 대해'
layout: post
tags:
  - CSS
---

역자: 이 글은 니콜라스 갤라거가 2012년에 쓴 글 [About HTML semantics and front-end architecture][3]를 번역한 것이다. HTML의 시맨틱과 CSS의 시맨틱은 다르다, CSS 클래스 이름을 내용과 연관짓지 않는 것이 시맨틱하지 않은 것이 아니다 하는 주장을 담고 있다. 흔히 권장되는 CSS 클래스 명명법과 다른 이 주장은, 오늘날 유지보수하기 쉬운 CSS를 작성하려는 많은 사람들에게 받아들여지고 있는 주장이다. 혹시나 번역한 글이 있나 해서 찾아 봤는데 없길래 번역해 본다. 이런 글은 더 많은 사람들이 봐야 한다.

시맨틱은 "의미", "의미론", "의미론적"이라고 번역할 수 있겠지만, 그보단 "시맨틱"으로 더 많이 사용되므로 "시맨틱" 혹은 "시맨틱한"으로 음차했다. 단, 맥락에 따라서 "의미론"이나 "의미"라고 번역하는 게 더 나은 경우에는 그렇게 했다. 프론트엔드도 굳이 번역한다면 "사용자가 직접 사용하는" 이라고 번역할 수 있겠지만 음차가 더 많이 사용되므로 마찬가지로 번역했다.

------

이 글은 내가 좋아하는 생각, 경험, 아이디어들에 관한 것이고, 지난 1년 간 내가 실험한 것들에 관한 것이다. HTML 시맨틱, 컴포넌트를 다룬 뒤 프론트엔드 아키텍처, 클래스 작명 방식, 그리고 HTTP 압축을 다룬다.

> 우리는 탐험을 멈추지 않을 것이다
> 그리고 우리 모든 탐험의 끝은
> 출발한 곳에 도착하는 것이 될 것이다
> 그리고 그곳을 처음으로 알게 될 것이다.
>
> T.S. 엘리엇 – “리틀 기딩(Little Gidding)”

## 시맨틱에 대하여

의미론(Semantics)이란 기호(signs)와 상징(symbols) 그리고 그것이 나타내는 것 사이의 관계를 연구하는 것이다. 언어학에서 이것은 주로 언어에서 기호(단어, 문장 혹은 소리 같은 것들)의 의미에 대한 연구다. 프론트엔드 웹 개발자의 맥락에서, 시맨틱은 대개 HTML 요소, 속성, 그리고 속성값(마이크로데이터 같은 확장을 포함해)에 대해 합의된 의미를 가리킨다. 이 합의된 시맨틱들―보통 _공식화된_ 명세서에 있는―은 프로그램이 (나중에는 사람이) 웹사이트에 있는 정보들을[^fn1] 더 잘 이해하도록 돕는 데 사용할 수 있다. 그러나 ― 공식화 이후에 조차 ― 요소, 속성, 속성값의 의미는 개발자들이 손보고 토론하는[^fn2] 대상이다. 이것은 공식적으로 합의된 시맨틱의 수정으로 우리를 이끈다. (그리고 이것은 [HTML 디자인 원리][1]다.)

## 서로 다른 HTML 시맨틱 유형 구분

"시맨틱한 HTML" 작성은 최신 전문 프론트엔드 개발의 기반중 하나다. 대부분의 시맨틱은 존재하는 혹은 기대되는 콘텐츠의 성격과 연관된다(예컨대, `h1` 요소, `lang` 속성, `type` 속성의 `email`이란 값, 마이크로데이터).

그러나, **모든 시맨틱한 것들이 콘텐츠에서 도출될 필요는 없다.** 클래스명은 "시맨틱하지 않을(unsemantic)" 수 없다. 어떤 이름을 사용하든간에 말이다. 클래스명엔 의미가 있고 목적이 있다. 클래스명에서 시맨틱이란 HTML 요소들의 시맨틱과 차이가 날 수 있다. HTML 요소, 특정 HTML 속성, 마이크로데이터 등 합의된 "글로벌한" 시맨틱함을 유지하면서도 `class` 속성의 값 같은 "로컬" 웹사이트/어플리케이션에 맞는 시맨틱함도 유지할 수 있다. 목적을 헷갈리지 않으면서도 말이다.

[HTML5의 명세의 클래스에 관한 절][2]이 "베스트 프랙티스"라고 간주하는 것을 여전히 반복하고 있기는 하지만,

> ... 작성자는 콘텐츠의 본질(nature)을 설명하는 [클래스 속성] 값을 사용하는 편이 좋다.
> 콘텐츠 모양이 어떻게 표시되길 바라는가를 설명하는 값을 사용하는 것은 좋지 않다.

... 그렇게 해야 할 본질적 이유는 없다. 사실, 그렇게 하면 대규모 웹사이트나 애플리케이션 작업을 할 때 방해되는 경우가 많다.

- **콘텐트 계층의 시맨틱은 HTML 요소와** 그 밖에 다른 속성들이 **이미 담당하고 있다.**

- **클래스명은 기계** 또는 사람**에겐 시맨틱한 정보를 거의 또는 전혀 전달하지 않는다.** 위에서 말한 합의된 (그리고 기계가 읽을 수 있는) 이름에 해당하는 작은 부분―마이크로포맷―을 제외하면 말이다.

- **클래스명의 주 목적은 CSS와 JavaScript 훅을 걸기 위한 것이다.** 만약 모양이나 동작을 추가할 필요가 없다면 아마 HTML에 클래스가 필요치 않을 것이다.

- **클래스명은 _개발자_에게 _유용한_ 정보를 전해 줘야 한다.** DOM 조각을 읽을 때 특정 클래스명은 그게 뭘 하는 것인지 알 수 있는 이름이어야 한다. 특히 프론트엔드 개발자만이 아니라 여러 개발자가 HTML을 건드리는 팀인 경우에 그렇다.

간단한 예를 보자.

    <div class="news">
        <h2>News</h2>
        [news content]
    </div>

`news`라는 클래스명은 콘텐트만 보면 이미 명백히 알 수 있는 것 외에는 어떤 것도 말해 주지 않는다. 컴포넌트의 아키텍처 구조에 대한 어떤 정보도 전해 주지 않으며, "뉴스"가 아닌 콘텐트에는 사용할 수도 없다. 클래스명을 콘텐트 성격에 묶는 시맨틱함은 이미 아키텍트의 확장 능력, 아키텍트를 다른 개발자가 쉽게 사용할 수 있게 하는 능력을 저해시켰다.

## 콘텐트 독립적 클래스명

대안은 클래스명의 시맨틱함을 디자인에서 반복되는 구조와 기능 패턴으로부터 도출하는 것이다. **가장 재사용성이 높은 컴포넌트는 콘텐트 독립적인 클래스명을 붙인 것이다.**

우리는 계층들을 명확하고 명시적으로 연결되게 하는 것을 두려워해선 안 된다. 그것이 융통성 없게 특정 콘텐트를 반영해 클래스명을 짓는 것보다 낫다. 이렇게 하는 것이 클래스를 "시맨틱하지 않게" 만드는 것이 아니다. 이것은 단지 클래스명의 시맨틱함을 콘텐트에서 도출하지 않는 다는 것을 의미할 뿐이다. 우리는 HTML 요소를 추가하는 것도 두려워해선 안 된다. 그렇게 하는 것이 컴포넌트를 튼튼하고 유연하며 재사용 가능하게 만드는 데 도움이 된다면 말이다. 그렇게 하는 것이 HTML을 "시맨틱하지 않게" 만드는 것이 아니다. 그것은 단지 콘텐트를 마크업하는 데 필요한 가장 최소한의 요소만 사용하는 것을 넘어선다는 것을 뜻할 뿐이다.

## 프론트엔드 아키텍처

컴포넌트/텔플릿/객체지향 아키텍처의 목표는 한정된 숫자의 재사용 가능한 컴포넌트를 이용해서 서로 다른 콘텐트 타입을 다룰 수 있게 하는 것이다. 대규모(non-trivial) 어플리케이션에서 클래스명을 시맨틱하게 짓는다고 할 때 중요한 것은 실용성을 염두에 두고 지어야 한다는 것이다. 그리고 그것의 주 목적 ― 의미있고, 유연하고, 재사용 가능한 표현/행위에 관한 훅(hook)을 _개발자들이_ 사용할 수 있게 제공하는 것을 최우선으로 해야 한다는 점이다.

### 재사용 가능하고 결합 가능한 컴포넌트

확장에 용이한 HTML/CSS를 만들려면, 대개는, 클래스를 활용해서 재사용 가능한 컴포넌트를 만들어야 한다. 유연하고 재사용 가능한 컴포넌트는 특정 DOM 요소나 구조[^fn3]에 의존하면 안 된다. 특정 요소 유형[HTML 태그 - 형우]을 필수로 해서도 안 된다. 서로 다른 컨테이너에 적용할 수 있어야 하고, 모양을 바꾸는 것도 쉬워야 한다. 컴포넌트를 더 건강하게 만들기 위해, 필요하다면 HTML 요소를 (콘텐트를 마크업하는 데 필요한 정도를 넘어) 추가로 사용할 수도 있어야 한다. 좋은 예는 [니콜 설리반][4]이 [미디어 객체][5]라고 부른 것이다.

컴포넌트를 쉽게 결합하려면 타입 선택자[6]\[`h1`, `p` 같은 태그 선택자를 말하는 것 - 형우\]보다는 클래스를 사용해야 한다.[^fn4] 다음 예는 `btn` 컴포넌트와 `uilist` 컴포넌트를 쉽게 결합하지 못하게 만든 예다. 문제는 `.btn`의 특정도(Specificity)[^fn5]가 `.uilist`보다 낮고 (그래서 겹치는 속성을 덮어 쓰게 될 것이다), `uilist` 컴포넌트에는 앵커 노드가 자식으로 있어야 한다는 점이다.

~~~~
.btn { /* styles */ }
.uilist { /* styles */ }
.uilist a { /* styles */ }
~~~~

~~~~
<nav class="uilist">
    <a href="#">Home</a>
    <a href="#">About</a>
    <a class="btn" href="#">Login</a>
</nav>
~~~~

다른 컴포넌트들을 `uilist`와 결합하기 쉽게 개선하는 접근법은 자식 DOM 요소에 스타일을 입힐 때 클래스를 사용하는 것이다. 이 방법은 규칙의 특정도를 감소시켜 주긴 하지만, 주요한 장점은 어떤 종류의 자식 노드에도 구조상의 스타일을 입힐 수 있게 해 준다는 점이다.

<pre>
.btn { /* styles */ }
.uilist { /* styles */ }
<mark>.uilist-item { /* styles */ }</mark></pre>


<pre>
&lt;nav class=&quot;uilist&quot;&gt;
    &lt;a class=&quot;uilist-item&quot; href=&quot;#&quot;&gt;Home&lt;/a&gt;
    &lt;a class=&quot;uilist-item&quot; href=&quot;#&quot;&gt;About&lt;/a&gt;
    <mark>&lt;span class=&quot;uilist-item&quot;&gt;</mark>
        &lt;a class=&quot;btn&quot; href=&quot;#&quot;&gt;Login&lt;/a&gt;
    <mark>&lt;/span&gt;</mark>
&lt;/nav&gt;</pre>


### 자바스크립트 전용 클래스

어떤 형태든 자바스크립트 전용 클래스를 사용하는 것은 모양이나 구조에 변화가 있을 때 거기에 적용된 자바스크립트가 깨질 위험을 줄여 준다. 내가 발견한 유용한 방법은, 내가 발견한 유용한 접근법은 자바스크립트 훅_만을_ 위한 특정한 클래스(`js-*` 같은 것)를 사용하는 것이다. 그리고 거기엔 모양을 전혀 입히지 않는다.

<pre>
&lt;a href=&quot;/login&quot; class=&quot;btn btn-primary <mark>js-login</mark>&quot;&gt;&lt;/a&gt;</pre>

이 방법을 사용하면 구조나 모양을 변경했을 때 필수적 자바스크립트 동작이나 복잡한 기능에 우연히 영향을 미치게 되는 경우를 줄일 수 있다.

### 컴포넌트 수식어(modifier)

기본 컴포넌트와 모양이 약간 다른 컴포넌트 변종을 사용해야 하는 경우가 자주 있다. 예컨대 배경이나 외곽선 색을 달리하는 경우. 컴포넌트 변종을 만들기 위해서는 주로 두 가지 패턴 중 하나를 사용한다. 여기서는 그것을 "싱글 클래스(single-class)"와 "멀티 클래스(multi-class)" 패턴이라고 부를 것이다.

#### "싱글 클래스" 패턴

    .btn, .btn-primary { /* button template styles */ }
    .btn-primary { /* styles specific to save button */ }

    <button class="btn">Default</button>
    <button class="btn-primary">Login</button>


#### "멀티 클래스" 패턴

    .btn { /* button template styles */ }
    .btn-primary { /* styles specific to primary button */ }

    <button class="btn">Default</button>
    <button class="btn btn-primary">Login</button>

프리 프로세서를 사용한다면, 아마 Sass의 `@extend` 기능을 이용해서 "싱글 클래스" 패턴 유지보수에 드는 노력을 줄일 수 있을 것이다. 하지만, 프리 프로세서의 도움이 있더라도, 나는 "멀티 클래스" 패턴과 HTML에 클래스 수식어를 추가하는 것을 선호한다.

나는 그게 더 확장성 있는 패턴이라는 점을 발견했다. 예를 들면, 기본 `btn` 컴포넌트를 만들고, 다섯 종류의 버튼과 세 가지 크기를 추가한다고 해 보자. "멀티 클래스" 패턴을 사용하면 결합해 적용할 수 있는 클래스를 9개 만들게 된다. "싱글 클래스" 패턴을 사용하면 클래스를 24개 만들어야 한다.

"멀티 클래스" 패턴을 사용하면, 정말 필요한 경우에는, 맥락에 따라 살짝 변형하기도 쉽다. 우리는 _어떤_ `btn`이 다른 컴포넌트 안에 나타나게 살짝 조정을 가해야 할 지도 모른다. 

    /* "multi-class" adjustment */
    .thing .btn { /* adjustments */ }

    /* "single-class" adjustment */
    .thing .btn,
    .thing .btn-primary,
    .thing .btn-danger,
    .thing .btn-etc { /* adjustments */ }

"멀티 클래스" 패턴에서는 컴포넌트에 있는 `btn`으로 스타일된 모든 요소를 가리키는 컴포넌트 안쪽 선택자(intra-component selector)를 하나만 추가하면 된다. "싱글 클래스" 패턴에서는 가능한 모든 버튼 종류를 나열해야 할 것이고, 새 변종이 만들어질 때마다 선택자를 조정해야 한다.

## 구조화된 클래스명

When creating components – and “themes” that build upon them – some classes are used as component boundaries, some are used as component modifiers, and others are used to associate a collection of DOM nodes into a larger abstract presentational component.

It’s hard to deduce the relationship between btn (component), btn-primary (modifier), btn-group (component), and btn-group-item (component sub-object) because the names don’t clearly surface the purpose of the class. There is no consistent pattern.

In early 2011, I started experimenting with naming patterns that help me to more quickly understand the presentational relationship between nodes in a DOM snippet, rather than trying to piece together the site’s architecture by switching back-and-forth between HTML, CSS, and JS files. The notation in the gist is primarily influenced by the BEM system‘s approach to naming, but adapted into a form that I found easier to scan.

Since I first wrote this post, several other teams and frameworks have adopted this approach. MontageJS modified the notation into a different style, which I prefer and currently use in the SUIT framework:

/* Utility */
.u-utilityName {}

/* Component */
.ComponentName {}

/* Component modifier */
.ComponentName--modifierName {}

/* Component descendant */
.ComponentName-descendant {}

/* Component descendant modifier */
.ComponentName-descendant--modifierName {}

/* Component state (scoped to component) */
.ComponentName.is-stateOfComponent {}
This is merely a naming pattern that I’m finding helpful at the moment. It could take any form. But the benefit lies in removing the ambiguity of class names that rely only on (single) hyphens, or underscores, or camel case.

A note on raw file size and HTTP compression

Related to any discussion about modular/scalable CSS is a concern about file size and “bloat”. Nicole Sullivan’s talks often mention the file size savings (as well as maintenance improvements) that companies like Facebook experienced when adopting this kind of approach. Further to that, I thought I’d share my anecdotes about the effects of HTTP compression on pre-processor output and the extensive use of HTML classes.

When Twitter Bootstrap first came out, I rewrote the compiled CSS to better reflect how I would author it by hand and to compare the file sizes. After minifying both files, the hand-crafted CSS was about 10% smaller than the pre-processor output. But when both files were also gzipped, the pre-processor output was about 5% smaller than the hand-crafted CSS.

This highlights how important it is to compare the size of files after HTTP compression, because minified file sizes do not tell the whole story. It suggests that experienced CSS developers using pre-processors don’t need to be overly concerned about a certain degree of repetition in the compiled CSS because it can lend itself well to smaller file sizes after HTTP compression. The benefits of more maintainable “CSS” code via pre-processors should trump concerns about the aesthetics or size of the raw and minified output CSS.

In another experiment, I removed every class attribute from a 60KB HTML file pulled from a live site (already made up of many reusable components). Doing this reduced the file size to 25KB. When the original and stripped files were gzipped, their sizes were 7.6KB and 6KB respectively – a difference of 1.6KB. The actual file size consequences of liberal class use are rarely going to be worth stressing over.

How I learned to stop worrying…

The experience of many skilled developers, over many years, has led to a shift in how large-scale website and applications are developed. Despite this, for individuals weaned on an ideology where “semantic HTML” means using content-derived class names (and even then, only as a last resort), it usually requires you to work on a large application before you can become acutely aware of the impractical nature of that approach. You have to be prepared to disgard old ideas, look at alternatives, and even revisit ways that you may have previously dismissed.

Once you start writing non-trivial websites and applications that you and others must not only maintain but actively iterate upon, you quickly realise that despite your best efforts, your code starts to get harder and harder to maintain. It’s well worth taking the time to explore the work of some people who have proposed their own approaches to tackling these problems: Nicole’s blog and Object Oriented CSS project, Jonathan Snook’s Scalable Modular Architecture CSS, and the Block Element Modifier method that Yandex have developed.

When you choose to author HTML and CSS in a way that seeks to reduce the amount of time you spend writing and editing CSS, it involves accepting that you must instead spend more time changing HTML classes on elements if you want to change their styles. This turns out to be fairly practical, both for front-end and back-end developers – anyone can rearrange pre-built “lego blocks”; it turns out that no one can perform CSS-alchemy.





[^fn1]: "aspects of the information"을 그냥 정보들이라고 번역했다. "정보의 측면들"이라고 번역하면 너무 이상하다. 더 좋은 번역이 있다면 알려 달라.
[^fn2]: "subject to adaptation and co-option by developers"를 번역한 것이다. 직역하면 "개발자들에 의해 적응되고 공동 선택되는 대상" 정도 될 것이다.
[^fn3]: "existing within a certain part of the DOM tree"를 번역한 것이다. 직역하면 "DOM 트리의 특정 부분에 존재하는 것"
[^fn4]: Components that can be easily combined benefit from the avoidance of type selectors in favour of classes. 직역 불능에 가까워 의역했다.
[^fn5]: Specificity는 "특정도"로 번역했다. [MDN에서는 "명시도"로 번역][7]했더라. 이 점수는 두 개의 선택자가 같은 요소를 가리킬 때 어떤 CSS 규칙을 적용할지 가릴 때 사용하는 개념인데, 예컨대 id가 클래스보다 Specificity가 높고, 클래스 두 개가 중첩된 것이 클래스 한 개만 사용한 것보다 Specificity가 높다.   
MDN의 "명시도"라는 번역은 사전적으로 볼 때 크게 무리가 있는 번역은 아니다. "명시"의 사전적 뜻은 "분명하게 드러내 보임"이고, "명시도"의 뜻은 "<미술> 둘 이상의 색깔이 같은 거리에 같은 크기로 있을 때, 뚜렷이 잘 보이는 것과 잘 보이지 않는 정도"다. 비교한다는 뜻이 명확히 있다.  
그런데 "명시성"이라고 하면 "더 잘 보인다" 하는 식의 뉘앙스가 느껴진다. 그보다는 "이놈보다 저놈이 더 우선한다, 이것보다 저것을 더 특정했다" 하는 뉘앙스가 더 나아 보였다. 그래서 "특정도"라고 번역했다. 영어사전의 뜻도 비슷한데, 옥스퍼드는 "특별함, 우수함", 동아출판과 YBM은 "특수성, 전문성"으로 적고 있다.


[1]: https://www.w3.org/TR/html-design-principles/#pave-the-cowpaths
[2]: https://www.w3.org/TR/html5/dom.html#classes
[3]: http://nicolasgallagher.com/about-html-semantics-front-end-architecture/
[4]: http://www.stubbornella.org/content/
[5]: http://www.stubbornella.org/content/2010/06/25/the-media-object-saves-hundreds-of-lines-of-code/
[6]: https://www.w3.org/TR/CSS22/selector.html#type-selectors
[7]: https://developer.mozilla.org/ko/docs/Web/CSS/Specificity
