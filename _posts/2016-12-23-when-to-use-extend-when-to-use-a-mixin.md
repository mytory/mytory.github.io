---
title: '[Sass] 웬만하면 @extend 말고 믹스인을 사용하자'
author: 안형우
layout: post
tags:
  - css
---

## 역자의 말 

csswizardry에 실린 해리 로버츠의 글, ['@extend를 사용해야 할 때와 믹스인을 사용해야 할 때(When to use @extend; when to use a mixin)'][원문]를 번역한 것이다.

[원문]: http://csswizardry.com/2014/11/when-to-use-extend-when-to-use-a-mixin/

Sass를 처음 사용하고 가장 신기했던 게 `@extend`였다. CSS 속성을 한 번 정의한 다음 거기에 클래스를 덧붙이는 게 얼마나 귀찮았던가. 그런데 Sass를 사용하면 굳이 덧붙일 원래의 클래스를 찾지 않아도 지금 작성하는 클래스 속성 정의에서 확장을 할 수 있었던 것이다. (`@extend`가 뭔지 알면 이 말이 무슨 말인지 알 수 있을 것이다.)

사실 믹스인(대충 함수라고 생각하면 된다)에는 관심 없었다. CSS에서 함수를 사용한다는 건 오버킬로 느껴졌기 때문이다. 물론 나중에 inuitcss를 사용하게 되면서 믹스인도 사용하게 됐다.

그런데 이 글은 가급적 `@extend`를 사용하지 말라고 주장하는 글이다. 연관성 없는 값들이 한 장소에 묶이게 되고, 소스 순서가 어그러져서 혼란을 준다는 것이다. 심각한 경우 특정도(적용 우선순위 점수, specificity)가 엉망이 되면서 코드가 뜻대로 제어되지 않는 결과를 낳을 수도 있다. 해리 로버츠가 대안으로 제시하는 것은 인자값 없는 믹스인이다. 

물론, 출력된 CSS에서의 연관성이 어그러진다는 말은 좀 모호하다. 작성하는 입장에서 본다면 출력된 CSS는 소스코드는 아니다. 그러나 브라우저 입장에서는 출력된 CSS를 바탕으로 화면을 그리기 때문에 또 소스코드라고 볼 수도 있을 것이다. 결정적으로, 출력된 CSS를 바탕으로 화면을 렌더링할 때 `@extend`는 특정도를 혼란시킬 수 있다. 그 점은 매우 일리 있다고 본다. 즉, 개념상은 모호한 구석이 있지만 실질적으론 설득력이 있는 주장이다. 읽어 보자.

[ ]는 읽는 데 도움이 되라고 내가 끼워 넣은 말이다.

-----------

고객에게 이런 질문을 많이 듣는다: <q>언제 믹스인을 사용해야 하고, 언제 `@extend`를 사용해야 하나요?</q>

<q>'인자값이 없는 믹스인은 나쁘다'</q> 하는 오래된 경험칙이 있다. 그런 믹스인은 인스턴스간 차이가 없는 코드를 중복시키는 데 불과하므로 아주 나쁘다는 것이다. 진실은, 그보다 훨씬 더 미묘한 점을 많이 고려해 대답해야 한다는 것이다.

자, 살펴 보자.

## `@extend`를 사용할 때

`@extend`를 전혀 사용하지 말 것을 조언하는 것으로 시작하겠다. `@extend`는 [빛 좋은 개살구][fools-gold] 같은 것[^fools-gold]이다. 많은 것을 약속하지만 그 두 배의 주의사항을 알아야 하는 기능이다.

[fools-gold]: http://oliverjash.me/2012/09/07/methods-for-modifying-objects-in-oocss.html
[^fools-gold]: 원문은 Fool's Gold. 돌 안에 들어있는 금과 매우 비슷해 보이는 물질을 뜻하는 말인데, 만약 돈을 벌 계획이 Fool's Gold라고 말한다면, 계획이 실패하거나 문제를 일으킬 것이 확실하기 때문에 그것을 수행하는 것이 어리석다는 뜻이다.

만약 확실히, 완전히 `@extend`를 사용하기로 했다면:

1. 다시 생각해 봐라.
2. [플레이스홀더 핵][placeholder-hack]을 사용하라.
3. 결과물을 계속 살펴 봐라.

[placeholder-hack]: http://csswizardry.com/2014/01/extending-silent-classes-in-sass/

이론적으로, `@extend`는 훌륭하다. 하지만, 실제로는 잘못되는 경우가 너무 많다. 나는 두 배 넘는 사이즈의 스타일시트를 본 적이 있다; 소스 순서가 파괴된 것도 봤다; 그리고 나는 [4,095개의 선택자 예산][4095]을 한 방에 다 써버린 고객을 본 적도 있다. 늘 지나치다 싶을 정도로 조심하는 편이 낫다. 실질적 이득이 거의 없거나 전혀 없으면서 많은 문제를 일으킬 위험이 있는 기능이나 도구도 피하는 편이 좋다. 생산성 도구를 오용한 결과로 스타일시트를 4,096개 미만의 선택자로 분할하는 작업을 하는 것은 아주 아주 비상식적인 일이다.[^original1]

[4095]: https://blogs.msdn.microsoft.com/ieinternals/2011/05/14/stylesheet-limits-in-internet-explorer/

[^original1]: Having to shard your stylesheets into less-than-4096-selector-groups as a result of misusing a productivity tool is very, very counterintuitive.

**주의:** `@extend` 그 자체를 싫어하는 것은 아니라는 점은 덧붙여야겠다. 다만 알아야 하는 게 많다는 것이고, 사용하려면 정신을 바짝 차려야 한다는 것이다.

하지만, `@extend`를 사용한다면 언제가 되어야 할까?

**`@extend`가 연관성을 형성한다는 것**을 이해하는 것이 중요하다. 당신이 `@extend`를 사용하면, 선택자를 스타일시트의 이쪽에서 저쪽으로 이식하게 되고, 이미 거기에 이식돼 있는 다른 선택자들과 특성을 공유하게 된다. 결과적으로, 당신은 이 선택자들 모두가 연관을 맺게 한 것이고, **잘못된 기준으로 연관을 맺도록 함으로써 `@extend`를 오용하고 있는 것이다**. 이것은 마치 CD를 분류할 때 표지 색깔별로 분류하는 것과 같은 일이다. 할 수는 있지만, 그렇게 할 만한 쓸모가 있는 분류는 아니다.

**올바른 특성을 중심으로 연관성을 형성하는 것은 필수적이다.**

꽤 자주—그리고 나 자신도 과거에 이런 죄를 저질렀다—나는 이런 것을 봤다(아, ...은 100줄쯤을 나타낸다고 생각하며 보자): 

    %brand-font {
        font-family: webfont, sans-serif;
        font-weight: 700;
    }

    ...

    h1 {
        @extend %brand-font;
        font-size: 2em;
    }

    ...

    .btn {
        @extend %brand-font;
        display: inline-block;
        padding: 1em;
    }

    ...

    .promo {
        @extend %brand-font;
        background-color: #BADA55;
        color: #fff;
    }

    ...

    .footer-message {
        @extend %brand-font;
        font-size: 0.75em;
    }

위 코드를 컴파일하면 아래처럼 된다.

    h1, .btn, .promo, .footer-message {
        font-family: webfont, sans-serif;
        font-weight: 700;
    }

    ...

    h1 {
        font-size: 2em;
    }

    ...

    .btn {
        display: inline-block;
        padding: 1em;
    }

    ...

    .promo {
        background-color: #BADA55;
        color: #fff;
    }

    ...

    .footer-message {
        font-size: 0.75em;
    }

[위 코드의] 문제는 연관성 없는 규칙들에 강제로 연관성을 부여했다는 점이다 — 규칙들은 서로 수백 줄 떨어져 있다. 이것은 순전히 우연히 공유된 특성에 기반해서 맺은 연관성이다. 강제로 이상하게 연관성을 부여했을 뿐 아니라, 소스 순서가 아주 이상해져서 특정도(specificity)가 꼬이게 됐다. [별로다.][not-good-news]

[not-good-news]: http://csswizardry.com/2014/10/the-specificity-graph/

나는 연관성도 없는 규칙들을 다른 규칙들과 묶기 위해서 원래 있던 소스로부터 수백줄 떨어진 곳에 이식했다. 잘못된 위치에, 순전히 우연적이고 상황적인 유사성에 기반해서 말이다. **이것은 `@extend`를 잘못 사용하는 것이다.** (사실, 이런 경우는 인자값 없는 믹스인을 사용하기에 딱 맞는 상황이라고 할 수 있다. 이것은 나중에 다루겠다.)

또다른 `@extend` 오용 사례는 아래 코드 같은 것이다:

    %bold {
        font-weight: bold;
    }

    ...

    .header--home > .header__tagline {
        @extend %bold;
        color: #333;
        font-style: italic;
    }

    ...

    .btn--warning {
        @extend %bold;
        background-color: red;
        color: white;
    }

    ...

    .alert--error > .alert__text {
        @extend %bold;
        color: red;
    }
    
결과물은, 예상대로, 아래와 같다.

    .header--home > .header__tagline,
    .btn--warning,
    .alert--error > .alert__text {
        font-weight: bold;
    }

    ...

    .header--home > .header__tagline {
        color: #333;
        font-style: italic;
    }

    ...

    .btn--warning {
        background-color: red;
        color: white;
    }

    ...

    .alert--error > .alert__text {
        color: red;
    }

용량은 299바이트다.

흔히, 반복을 피하려고 작성한 선언보다 이식한 [결과물로 출력된] 선택자가 더 길 수 있다. 실제로 ―반복을 완전히 피하려고 하기보다― 그냥 `font-weight: bold;` 선언을 *n*회 반복했다면, 파일 용량은 **264바이트**로 더 작았을 것이다. 이것은 아주 소극적인 모델일 뿐이지만, 결과물의 용량이 줄어들 가능성을 가늠해 보는 데 분명 도움이 된다. [즉,] 한 줄짜리 선언에 `@extend`를 사용하는 것은 대개 역효과를 낳는다.

그러면, *도대체*  언제 `@extend`를 사용하는가?

명백히 연관성이 있는 규칙들 사이에 특성을 공유하기 위해 `@extend`를 사용한다. 다음은 완벽한 예다:

    .btn,
    %btn {
        display: inline-block;
        padding: 1em;
    }

    .btn-positive {
        @extend %btn;
        background-color: green;
        color: white;
    }

    .btn-negative {
        @extend %btn;
        background-color: red;
        color: white;
    }

    .btn-neutral {
        @extend %btn;
        background-color: lightgray;
        color: black;
    }

결과물은 이렇다:

    .btn,
    .btn-positive,
    .btn-negative,
    .btn-neutral {
        display: inline-block;
        padding: 1em;
    }

    .btn-positive {
        background-color: green;
        color: white;
    }

    .btn-negative {
        background-color: red;
        color: white;
    }

    .btn-neutral {
        background-color: lightgray;
        color: black;
    }

이것은 완벽한 `@extend` 활용 사례다. 이 규칙들은 본질적으로 연관성이 있다. 공유한 특성은 이유가 있고, 우연적이지도 않다. 더 나아가, 우리는 소스에서 수백 줄 떨어진 곳으로 선택자를 이식하지도 않았다. 그래서 우리의 [특정도 그래프][specificity-graph]는 훌륭하고 아름답게 유지됐다.

[specificity-graph]: http://csswizardry.com/2014/10/the-specificity-graph/

## 믹스인을 사용할 때

<q>인자값 없는 믹스인은 나쁘다</q>는 규칙(rule)은 좋은 의도를 담고 있다. 하지만 불행히도 이건 그리 간단한 문제가 아니다.

이 규칙은 DRY 원칙[^dry]을 약간 오해한 데서 비롯한 것이다. DRY는 프로젝트에서 [유일한 진리의 근원(Single Source of Truth)][ssot]을 추구하는 원칙이다. DRY는 **직접(Yourself)** 반복하지 말라는 것이지, 반복을 완전히 피하라는 것이 아니다.

[^dry]: [Don't Repeat Yourself](https://en.wikipedia.org/wiki/Don't_repeat_yourself).
[ssot]: http://en.wikipedia.org/wiki/Single_Source_of_Truth

만약 프로젝트에서 같은 선언을 50번 타자 치고 있다면, 그것은 직접 반복하는 것이다. 이것은 DRY하지 않은 것이다. 수동으로 반복해 치지 않으면서 선언을 50번 생성할 수 있다면, 그것은 DRY한 것이다. 직접 반복하지 않으면서 반복되는 코드를 생성한 것이다. 이것은 꽤 미묘하지만 인식상 중요한 구분이다. **컴파일 결과물에서 반복은 나쁜 것이 아니다. 소스를 반복하는 것이 나쁜 것이다.**

유일한 진리의 근원은 반복 사용할 소스를 한 군데 저장한 뒤, 그것을 실제로 중복하지 않으면서도 재활용하고 재사용할 수 있다는 것을 의미한다. 물론, 시스템이 우리를 위해 반복할 것이다. 하지만 소스는 오직 한 군데만 존재한다. 우리가 그것만 고치면 변경이 모든 곳으로 전파될 것이다. 소스코드에는 중복이 없을 것이다. 이것은 유일한 진리의 근원을 의미한다. 이것이 우리가 DRY에 대해 말할 때 뜻하는 것이다. 

이것을 염두에 두면, 인자값 없는 믹스인을 실제로 매우 유용하게 쓸 수 있다는 것을 알 수 있다. 앞서 다뤘던 `%brand-font { }` 예제로 돌아가 보자.

프로젝트에서 특정한 글꼴을 사용하고 있다고 생각해 보자. 이 글꼴에는 언제나 `font-weight:`를 정의해야 한다.

    .foo {
        font-family: webfont, sans-serif;
        font-weight: 700;
    }

    ...

    .bar {
        font-family: webfont, sans-serif;
        font-weight: 700;
    }

    ...

    .baz {
        font-family: webfont, sans-serif;
        font-weight: 700;
    }


코드에서 두 선언을 수동으로 한없이 반복하는 것은 아주 지루한 일일 것이다. 게다가 익숙한 `regular`나 `bold`가 아니라 `700`이라는 숫자를 기억해야만 한다. 만약 웹 폰트[ 종류]나 굵기를 변경해야 한다면, 우리는 프로젝트 전체를 훑으면서 위 선언을 전부 찾아내 바꿔야 한다. 

이럴 때 `@extend`를 이용해 강제로 연관성을 부여하는 것은 하면 안 된다는 점을 앞서 다뤘다. 해야 할 일은 믹스인을 사용하는 것이다.

    @mixin webfont() {
        font-family: webfont, sans-serif;
        font-weight: 700;
    }

    ...

    .foo {
        @include webfont();
    }
    
    
**우리는 반복을 컴파일했다. 직접 반복하지 않았다.** 위 규칙들은 서로 연관성이 없는 규칙들이고, 그래서 연관을 맺게 만들지 않았다는 점을 기억하는 것이 여기서 중요하다. 이 규칙들은 연관성이 없고, 단지 *우연히*  몇몇 특성을 공유하게 된 것이다. 그래서 이 반복은 합리적이고 예측 가능한 것이다. 우리는 이 선언들을 *여러* 곳에서 사용하길 *원하며* 따라서 *여러* 군데 나타나게 만들었다.

인자값 없는 믹스인은 유일한 진리의 근원을 유지하면서 똑같은 선언들을 반복해서 뱉어내게 하는 데 아주 좋다. 이 믹스인을 클립보드 복사/붙여넣기 기능의 멋진 확장판처럼 생각하라. 몇몇 문자열을 다른 데서 미리 저장했다가 붙여넣기 위해 사용하기만 하면 된다. 유일한 진리의 근원을 확보한 것이고, 이제 한 군데만 수동으로 고치면 모든 선언을 바꿀 수 있다. 아주 DRY하다.

<small>Gzip이 반복을 좋아하므로 조금 늘어나는 파일 용량도 대부분 무효화된다는 점도 강조할 만하다.</small>

물론, 믹스인은 반복되는 구조를 가진 동적인 값을 생성할 때 정말 정말 유용하다. 인자값이 *있는* 믹스인 말이다. 그 누구도 이게 별로라고 말하지 못할 것이다. 이건 DRY할 뿐 아니라 유일한 진리의 근원을 바로 수정할 수 있게 해 준다. 예를 보자.

    @mixin truncate($width: 100%) {
        width: $width;
        max-width: 100%;
        display: block;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .foo {
        @include truncate(100px);
    }

같은 선언을 뱉어 내지만, 경우에 따라 동적으로 `width`를 설정한다.

이것은 가장 일반적이고 널리 합의된 믹스인 형태고, 모두가 이걸 좋은 방법이라고 생각할 것이다.

## 요약(tl;dr)

DRY하게 유지하려고 하는 규칙들이 본질적으로 연관돼 있을 때, 그리고 한 주제로 묶여 있을 때만 `@extend`를 사용하자. 연관성도 없는데 강제로 묶지 말자. 코드가 이상하게 묶이고, 소스 순서가 이상해진다.

믹스인은 반복되는 구조에 동적인 값을 넣는 데 사용할 수 있다. 또한 동일한 선언 묶음을 반복하게 해 줌으로써, 프로젝트에서 유일한 진리의 근원을 유지하게 해 주는, 멋진 복사/붙여넣기처럼 사용할 수 있다.


### 한 줄 요약(tl;dr;tl;dr)

연관 있는 반복에는 `@extend`를 사용하자. 그냥 같을 뿐이라면 믹스인을 사용하자.[^last]

[^last]: Use `@extend` for same-for-a-reason; use a mixin for same-just-because.

