---
title: '@extend를 사용해야 할 때와 mixin을 사용해야 할 때'
author: 안형우
layout: post
tags:
  - css
---

[csswizardry에 실린 해리 로버츠의 글][원문]을 번역한 것이다. 

[원문]: http://csswizardry.com/2014/11/when-to-use-extend-when-to-use-a-mixin/

Sass를 처음 사용하고 가장 신기했던 게 `@extend`였다. CSS 속성을 한 번 정의한 다음 거기에 클래스를 덧붙이는 게 얼마나 뒤찮았던가. 그런데 Sass를 사용하면 굳이 덧붙일 원래의 클래스를 찾지 않아도 지금 작성하는 클래스 속성 정의에서 확장을 할 수 있었던 것이다. (`@extend`가 뭔지 알면 이 말이 무슨 말인지 알 수 있을 것이다.)

사실 mixin(대충 함수라고 생각하면 된다)에는 관심 없었다. CSS에서 함수를 사용한다는 건 오버킬로 느껴졌기 때문이다. 물론 나중에 inuitcss를 사용하게 되면서 mixin도 사용하게 됐다.

그런데 이 글은 가급적 `@extend`를 사용하지 말라고 주장하는 글이다. 

(중략. 나중에 추가 보강하자.)

-----------

고객에게 이런 질문을 많이 듣는다: <q>언제 믹스인을 사용해야 하고, 언제 `@extend`를 사용해야 하나요?</q>

<q>'인자값이 없는 믹스인은 나쁘다'</q>는 오래된 경험칙이 있다. 그런 믹스인은 인스턴스간 차이가 없는 코드를 중복시키는 데 불과하므로 아주 나쁘다는 것이다. 진실은 대답에 그보다 훨씬 더 미묘한 점이 많다는 것이다.

자, 살펴 보자.

## `@extend`를 사용할 때

`@extend`를 전혀 사용하지 말 것을 조언하는 것으로 시작하겠다. `@extend`는 [빛 좋은 개살구][fools-gold]와 같은 것[^fools-gold]이다. 많은 것을 약속하지만 그 두 배의 주의사항을 알아야 하는 기능이다.

[fools-gold]: http://oliverjash.me/2012/09/07/methods-for-modifying-objects-in-oocss.html
[^fools-gold]: 원문은 Fool's Gold. 돌 안에 들어있는 금과 매우 비슷해 보이는 물질을 뜻하는 말인데, 만약 돈을 벌 계획이 Fool's Gold라고 말한다면, 계획이 실패하거나 문제를 일으킬 것이 확실하기 때문에 그것을 수행하는 것이 어리석다는 뜻이다.

만약 확실히, 완전히 `@extend`를 사용하기로 했다면:

1. 다시 생각해 봐라.
2. [플레이스홀더 핵][placeholder-hack]을 사용하라.
3. 결과물을 계속 살펴 봐라.

[placeholder-hack]: http://csswizardry.com/2014/01/extending-silent-classes-in-sass/

이론적으로, `@extend`는 훌륭하다. 하지만, 실제로는 잘못되는 경우가 너무 많다. 나는 두 배 넘는 사이즈의 스타일시트를 본 적이 있다; 소스 순서가 파괴된 것도 봤다; 그리고 나는 [4095개의 선택자 예산][4095]을 곧장 다 써버린 고객을 본 적도 있다. 늘 지나치다 싶을 정도로 조심하는 편이 낫다. 손에 잡히는 이득이 거의 혹은 전혀 없으면서 많은 문제를 일으킬 위험이 있는 기능이나 도구 역시 피하는 편이 좋다. 생산성 도구를 오용한 결과로 스타일시트를 4,096개 미만의 선택자로 분할하는 작업을 하는 것은 아주, 아주 직관에 어긋나는 일이다.[^original1]

[4095]: https://blogs.msdn.microsoft.com/ieinternals/2011/05/14/stylesheet-limits-in-internet-explorer/

[^original1]: Having to shard your stylesheets into less-than-4096-selector-groups as a result of misusing a productivity tool is very, very counterintuitive.

**주의:** `@extend` 그 자체를 싫어하는 것은 아니라는 점을 덧붙여야겠다. 다만 알아야 할 것이 많다는 것이고, 사용하려면 정신을 바짝 차려야 한다는 것이다.

하지만, `@extend`를 사용한다면 언제가 되어야 할까?

**`@extend`가 관계를 형성한다는 것**을 이해하는 것이 중요하다. 당신이 `@extend`를 사용하면, 선택자를 스타일시트의 이쪽에서 저쪽으로 이식하게 되고, 이미 거기에 이식돼 있는 다른 선택자들과 특성을 공유하게 된다. 결과적으로, 당신은 이 선택자들 모두가 관계를 형성하게 한 것이고, **잘못된 기준으로 관계를 형성할 수 있게 `@extend`를 오용하고 있는 것이다**. 이것은 마치 CD 콜렉션을 표지 색깔별로 분류하는 것과 같은 일이다. 할 수는 있지만, 형성할 만한 쓸모 있는 관계는 아니다.

**올바른 특성을 중심으로 관계를 형성하는 것은 필수적이다.**

꽤 자주—그리고 나 자신도 과거에 이런 죄를 저질렀다—나는 이런 것을 봤다(말하자면, ...은 100줄쯤 나타낸다는 점을 상상하며 보자): 

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

문제는 내가 관계없는 규칙들을 강제로 관계 맺개 했다는 점이다 — 규칙들은 서로 수백 줄 떨어져 있다. 이것은 순전히 우연히 공유된 특성에 기반해서 맺은 관계다. And not only have I forced an unusual relationship, but I now have a very unusual source order in which specificity is jumbled up. I am distributing selectors across my codebase for purely circumstantial reasons. This is [not good news][not-good-news].

[not-good-news]: http://csswizardry.com/2014/10/the-specificity-graph/

I have transplanted unrelated rulesets to hundreds of lines away from their source, in order to live with other rulesets, in the incorrect location, based on purely coincidental and circumstantial similarities. **This is not a good way to use `@extend`.** (In fact, this is probably a perfect use-case for an argument-less mixin. We’ll come back to that soon.)

Another case of an abused `@extend` looks a little like this: