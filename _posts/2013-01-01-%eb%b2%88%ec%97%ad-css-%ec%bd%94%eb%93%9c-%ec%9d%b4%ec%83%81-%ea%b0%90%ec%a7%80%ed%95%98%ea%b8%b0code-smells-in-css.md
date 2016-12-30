---
title: '[번역] CSS 코드 이상 감지하기(Code smells in CSS)'
author: 안형우
layout: post
permalink: /archives/8982
tags:
  - CSS
---
원문은 [CSS의 코드 냄새(Code smells in CSS)][1]다.

Code smell은 리팩토링에서 사용하는 단어다. 코드에 이상한 부분이 생기면 냄새가 난다고 표현하는 것이다. 한국에서 &#8216;코드 냄새&#8217;는 널리 사용하는 단어가 아니다. 그래서 제목에선 그냥 &#8216;코드 이상 감지하기&#8217;라고 했다. 본문에선 섞어서 사용할 거다. 그럼 번역 시작.

&#8212;&#8212;

크리스 코이어는 최근 누군가의 질문에 [답했다.][2] 질문은 이거다.

> CSS코드에서 냄새가 나는지 판단하는 방법을 알려 주실래요? 작성하면 안 되는 코드라는 징후는 뭔지,[^sub-optional] 혹은 개발자가 제대로 하지 못했다는 징후는 뭔지. 코드가 좋은지 나쁜지 어떻게 판단하시는지 궁금합니다.

[^sub-optional]: What are the signs that the code is sub-optional

크리스의 훌륭한 대답에 내 생각을 몇 가지를 덧붙여서 확장을 할 수 있겠다는 생각이 들었다.

나는 BSkyB에 다니고 일상적으로 재택 근무를 한다. (역자 주 &#8211; BSkyB는 British Sky Broadcasting라는 방송사다.) 나는 커다란 웹사이트를 다룬다. 이 웹사이트는 구축할 때 마지막 1년은 프론트 엔드 구축만 했다. 나도 거기 참여했고 말이다. (그리고 여전히 구축하고 있다.) 나에게, 내가 일하는 곳에서는, 나쁜 CSS는 아주 아주 명확하다. 그리고 완전 골칫거리다. 어떤 사이트에서 한달 동안 계속 일을 하면, 형편없는 코드를 견딜 수 없을 것이다. CSS든 다른 것이든 말이다. 그리고 어떤 나쁜 코드는 복원해야 한다. <a class="simple-footnote" title="역자 주 &#8211; 어쩔 수 없이 놔둬야 하는 나쁜 코드가 있다는 것 같다. when you’re working on one site for months on end, you can’t afford poor code, be it CSS or otherwise, and any bad code needs righting." id="return-note-8982-2" href="#note-8982-2"><sup>2</sup></a>

품질, 유지보수 용이성, 완결성(integrity)에 대해 생각할 거리를 던져 주는 CSS를 몇 가지만 공유를 해 보도록 하겠다. (미리 밝혀두지만, 이론의 여지 없이 내가 실수한 것들이다.)

## 취소 스타일(Undoing styles)

스타일을 재설정하는 CSS는 죄다 분명한 경고음이다. (리셋 스타일은 빼고.) 자연스런 CSS는 이전에 설정된 것을 계층적으로 잘 상속한다. CSS 규칙 세트는 오직 상속하기만 하거나 부모 것에 추가를 해야지 취소를 하면 안 된다.[^cancel]

[^cancel]: Any CSS that unsets styles (apart from in a reset) should start ringing alarm bells right away. The very nature of CSS is that things will, well, cascade and inherit from things defined previously. Rulesets should only ever inherit and add to previous ones, never undo.

어떤 CSS 선언은 이렇게 생겼다.

    border-bottom:none;
    padding:0;
    float:none;
    margin-left:0;
    

이런 게 **전형적인** 실수다. [이제 와서 - 역자] border를 제거해야 하는 거라면, 그전에 너무 빨리 border를 적용한 것이다.[^early] 말로 설명하기는 좀 힘드니까, 간단한 예제를 또 하나 들어 보겠다.

[^early]: If you are having to remove borders, you probably applied them too early.

    h2{
        font-size:2em;
        margin-bottom:0.5em;
        padding-bottom:0.5em;
        border-bottom:1px solid #ccc;
    }
    

여기서 우리는 모든 `h2`에 전부 `font-size`를 먹이고, `margin`에다가 심지어 `padding`까지 조금 줬고, 페이지의 다른 요소들과 구분이 되도록 아래쪽에 밑줄까지 그어 줬다. 그러나, 아마도 밑줄이 **없는** 편이 나은 경우가 생길 거다. `h2`에 `border`와 `padding`이 없었으면 하는 상황도 생길 것이다. 그러면 우리는 결국 이렇게 쓰게 될 거다.

    h2{
        font-size:2em;
        margin-bottom:0.5em;
        padding-bottom:0.5em;
        border-bottom:1px solid #ccc;
    }
    .no-border{
        padding-bottom:0;
        border-bottom:none;
    }
    

CSS가 열 줄에, 클래스 이름도 이상하다. 이게 더 낫다.

    h2{
        font-size:2em;
        margin-bottom:0.5em;
    }
    .headline{
        padding-bottom:0.5em;
        border-bottom:1px solid #ccc;
    }
    

이렇게 하면 CSS는 여덟 줄이고, 앞선 선언을 취소하는 것도 없다. 클래스 이름도 훌륭하고 시맨틱하다.

**스타일시트를 작성해 나갈 때, 스타일은 추가하기만 해야 한다. 취소하는 건 안 된다.** 스타일을 작성하다가 앞서 선언한 스타일을 취소해야 한다면, 바로 취소 스타일을 추가하기 십상이다. 경솔한 일이다.

이건 아주 사소한 예다. 하지만 내가 짚고 싶은 점을 명확하게 짚어 준다. 수만 줄의 CSS를 생각해 보자. 엄청 지저분하고 쓸모없는 스타일 무효화 선언도 많다. 그렇게 되기 전에 더 간단하게 만들어라.[^peg] 너무 복잡하게 만들지 마라. 나중에 일을 다시 해야 하도록 만들지 마라. 그랬다가는 **스타일 조금 고치는 데도 긴 CSS를 작성하게 될 거다.**

[^peg]: Peg things onto simpler things that came before it

이전 CSS 선언을 취소하는 스타일을 작성하게 되면, 나는 즉각 이렇게 생각한다. 뭔가 구조가 잘못됐기 때문에 이런 일이 벌어진 거야. 고쳐야겠어.

## 매직 넘버(Magic numbers)

이건 특히 나의 골칫거리다. 나는 매직 넘버를 **혐오한다**.

매직 넘버는 &#8216;반드시 그렇게만 작동하는&#8217; 값을 말한다. 다음 예를 보자.

    .site-nav{
        [styles]
    }
        .site-nav > li:hover .dropdown{
            position:absolute;
            top:37px;
            left:0;
        }
    

`top:37px;` 이게 매직 넘버다. 이걸 이렇게 작성한 이유는, 아마, `.site-nav` 안에 있는 `li`가 높이 37px로 **만들어졌고**, 그러면 `.dropdown`이 그 아래 나타나야 하기 때문일 것이다.

문제는 37px이 전적으로 특정 환경에 따른 숫자이고, 이 숫자가 늘 그렇게 유지되지는 않을 거라는 점이다. 누군가 `.site-nav`의 `font-size`를 바꿔서 모든 것의 높이가 29px이 되면 어떡할까? 이 숫자는 더이상 맞지 않게 될 것이고, 이를 유지보수할 개발자는 이 숫자를 갱신해야 한다는 사실을 알고 있어야 한다.

크롬은 `li`를 37px로 **렌더링**하는데, IE는 36px로 렌더링하면 어떻게 될까? 저 숫자는 특정 상황에서만 타당하게 되는 것이다.

단지 작동한다는 이유 만으로 매직 넘버를 사용하는 것은 **언제나** 금물이다. 이런 상황에서는 `top:37px;`을 `top:100%;`로 변경하는 것이 훨씬 낫다. 이렇게 하면 언제나 &#8216;위에 있는 놈의 전체 높이&#8217;를 가리키게 된다.

매직 넘버는 다양한 문제가 있다. 위에서 보여준 것처럼 다른 것과 연관지을 수가 없을뿐 아니라, &#8216;단지 작동하기 때문에&#8217; 작성된 것으로, 그 숫자가 어떻게 나온 숫자인지를 다른 개발자가 알기 힘들다. 복잡한 매직 넘버를 사용한 (그래서 뭔가 잘못된) 예가 있다면 아마 다음과 같을 것이다.

*   다음 개발자는 매직 넘버의 숫자가 어디서 왔는지 모른다. 그래서 지우고 처음으로 돌아갔다.
*   그 다음 개발자는 조심스러운 사람이라서, 매직 넘버가 어디서 왔는지 모르니까, 매직 넘버는 건드리지 않고 문제를 고치기로 결정한다. 이렇게 되면 낡고, 뒤쳐졌으며, 쓸모없는 매직 넘버가 코드에 남아있게 된다. 그 다음 개발자는 그 위에 핵을 사용하고, 그 다음으로 당신이 지금 그 위에 핵을 쓰고 있는 것이다.

매직 넘버는 나쁜 징후다. 매직 넘버는 금세 구닥다리가 된다. 다른 개발자들을 혼란스럽게 한다. 어떻게 나왔는지도 알 수 없고 신뢰할 수도 없다.

다른 누군가의 코드를 볼 때, 어떤 숫자를 만났는데 그 숫자가 왜 나왔는지 모르겠다면 최악의 상황이다. 이런 X 같은 상황에 놓이면 어떻게든 그걸 건드려야 한다.

나는 CSS에서 매직 넘버를 만나자마자 질문을 시작한다. 이게 왜 여기 있지? 이놈은 뭘 하는 놈이지? 왜 이 숫자인 거지? 매직 넘버 없이 같은 효과를 얻을 방법은 없나?

**매직 넘버는 전염병이다. 피해라.**

## 태그를 붙인 선택자(Qualified selector)

태그를 붙인 선택자라는 건 이런 걸 말한다.

    ul.nav{}
    a.button{}
    div.header{}
    

기본적으로, 선택자 앞에 쓸모없는 HTML 태그가 들어가 있다. 이건 나쁜 징후다. 이유는 다음과 같다.

*   다른 요소에서 전혀 재사용될 수 없다.
*   CSS 점수(specificity)를 높인다.[^specificity]
*   브라우저 작업량을 증가시킨다. (성능을 저하시킨다.)

[^specificity]: 특정도(specificity)는 같은 요소에 서로 다른 스타일이 선언돼 있을 때 우선순위를 판단하는 점수다.

이건 모두 나쁜 특성이다. 위 선택자들은 이렇게 쓸 수 있고, 이렇게 써야 한다.

    .nav{}
    .button{}
    .header{}
    

이렇게 써도, 나는 내가 `ol`에 `.nav`를 붙일 수 있다는 걸 안다. `.button`을 `input`에 붙일 수 있다는 것도 안다. 사이트를 HTML5로 포팅할 때, 나는 잽싸게 헤더의 `div`를 `header` 요소로 변경할 것이다. 스타일이 깨질 것이라는 걱정 없이 말이다.

성능은 아주 사소한 이슈다. 하지만 어쨌건 이슈는 이슈다. 왜 브라우저가 `a`에서 `.button` 클래스를 찾게 하지 않고 `.button` 클래스만 찾게 하는가? 태그를 붙인 선택자는 브라우저의 작업량을 증가시키기 때문이다.

더 극단적인 예를 보자. 아마 이럴 거다.

    ul.nav li.active a{}
    div.header a.logo img{}
    .content ul.features a.button{}
    

위에 있는 선택자는 죄다 완전히, 전적으로 줄여서 다시 쓸 수 있다. 이렇게.

    .nav .active a{}
    .logo > img {}
    .features-button{}
    

위와 같이 쓰는 건 도움이 된다.

*   실제 코드 양을 줄여 준다.
*   성능이 좋아진다.
*   이식성이 더 나아진다.
*   CSS 점수(specificity)가 감소한다.

나는 태그가 붙은 선택자를 발견하자마자 스타일시트를 훑어 보면서 스타일이 왜 이렇게 장황하게 작성됐는지 추적하고 가능한한 짧게 줄일 방법을 찾는다.

## 절대값(Hard-coded/absolute values)

매직 넘버와 마찬가지로 절대값 역시 나쁜 소식이다. 절대값은 이런 것을 말한다.

    h1{
        font-size:24px;
        line-height:32px;
    }
    

`line-height:32px;` 이건 쿨하지가 않다. 이래야 한다. `line-height:1.333`…

줄간격은 유연성이 있도록 늘 상대값으로 설정해야 한다. 나중에 `h1`의 `font-size`를 변경하면, `line-height`도 같이 변하는 게 낫다. `line-height`를 상대값으로 지정하지 않으면 `h1`을 수정할 때마다 이런 식으로 작성을 해야 할 것이다.

    h1{
        font-size:24px;
        line-height:32px;
    }
    
    /**
     * Main site `h1`
     */
    .site-title{
        font-size:36px;
        line-height:48px;
    }
    

처음에 줄간격을 고정으로 지정하는 바람에 우리는 계속 고정된 `line-height`를 지정해야 하게 됐다. 상대값으로 지정해서 `line-height`가 비율에 따라 변하게 하면 이렇게 간단하게 할 수 있다.

    h1{
        font-size:24px;
        line-height:1.333;
    }
    
    /**
     * Main site `h1`
     */
    .site-title{
        font-size:36px;
    }
    

큰 차이가 없어 보일 수도 있다. 하지만 커다란 프로젝트에서 모든 텍스트 요소에 적용되면, 이건 큰 문제가 된다.

**주의.** 이건 line-height에만 적용되는 게 아니다. 기본적으로 스타일시트에 하드코딩된 절대값이 있다면 경고로 받아들이고 의심해 봐야 한다.

절대값은 미래에 어떻게 될지 모르고, 유연하지 않다. 따라서 피해야 한다. 절대값을 사용할 수 있는 유일한 경우는 스프라이트처럼 **언제나** 같은 값이 필요한 경우다.[^sprite]

[^sprite]: 스프라이트란, 웹사이트의 이미지 들을 하나의 커다란 이미지로 만든 다음 배경 위치를 지정함으로써 각각의 다른 이미지를 표시하는 방식. http 요청을 줄여 사이트 성능을 높이기 위해 사용하는 방식이다. 더 알고 싶다면 CSS sprite로 검색해 봐라.

나는 스타일시트에서 절대값을 보면, 이게 필요한 이유를 묻고 피할 방법을 찾는다.

## 폭력적인 스타일(Brute forcing)

절대값과 비슷한 건데, 조금 더 특수하다. 폭력적인 CSS는 절대값과 매직 넘버를 사용하고 또 레이아웃을 강제로 지정하는 여러 기술을 사용하는 경우를 말한다. 이런 거다.

    .foo{
        margin-left:-3px;
        position:relative;
        z-index:99999;
        height:59px;
        float:left;
    }
    

**끔찍한** CSS다. 모든 선언은 필요 이상으로 엄격하고, 폭력적이고, 어디에 어떻게 렌더링할 것인지 **완전히** 강제함으로써 레이아웃에 영향을 준다.[^terrible]

[^terrible]: This is terrible CSS. All of these declarations are heavy-handed, brute-forced, layout-affecting declarations which are clearly only used to force something to render as and where it’s wanted.

이런 종류의 CSS는 솜씨가 부족한 코드라는 것을 나타낼 뿐 아니라, 박스 모델 혹은 레이아웃, 아니면 둘 다에 대한 이해가 부족하다는 것을 나타낸다.

잘 작성된 레이아웃은 폭력적으로 스타일을 지정할 필요가 없다. 박스 모델과 레이아웃을 견고하게 이해하고 스타일을 좀더 계산적으로 사용하면[^computed] 이런 상황에 처할 일이 거의 없다.

[^computed]: taking a look at your computed styles more often

나는 폭력적으로 사용된 CSS를 발견하면 왜 이런 일이 벌어졌는지 알아 보고, 돌이켜서 더 합리적으로 해결할 수 있는 방법을 찾아 본다.[^as-soon-as]

[^as-soon-as]: As soon as I see brute-forced CSS I want to know how it happened, and how far back we need to unpick things before we can lay things out more rationally.

## 위험한 선택자(Dangerous selectors)

&#8216;위험한 선택자&#8217;란 너무 광범위하게 적용될 수 있는 것을 말한다. 다음은 정말 명확하고 간단한 위험한 선택자 예시다.

    div{
       background-color:#ffc;
       padding:1em;
    }
    

이걸 보기만 하면 개발자들은 비명을 지를 거다. 도대체 왜 사이트에 있는 모든 `div`에 융단 폭격을 가하는 거지? 좋은 질문이다. 그렇다면 예컨대, `aside{}` 처럼 선택자를 사용하는 이유는 뭘까? `header{}`는? `ul{}`은? 이런 선택자는 너무 **멀리**까지 영향을 미치고 결국은 우리가 앞선 섹션에서 다룬 취소 CSS를 사용하게 만든다.

더 면밀하게 보기 위해 `header{}` 예제를 보자.

많은 이들이 사이트 메인 헤더를 정의하기 위해 `header` 요소를 사용한다. 그건 좋은 일이다. 그런데 이런 식으로 헤더 스타일을 정의한다면,

    header{
        padding:1em;
        background-color:#BADA55;
        color:#fff;
        margin-bottom:20px;
    }
    

… 그러면 좋지 않다. `header` 요소는 &#8216;사이트의 메인 헤더&#8217;를 의미하지 **않는다**. 그리고 스펙을 보면, `header` 요소는 여러 맥락에서 여러 번 사용될 수 있다. 위 예제는, 예를 들면, `.site-header{}` 같은 식으로 사용돼야 한다.

태그 선택자(generic selector)에 특정 스타일을 주는 건 위험하다. 해당 요소를 다른 데서 사용하려고 하면 아까 매긴 스타일이 새어나와 거기에 적용될 것이다. 그러면 그것과 싸우기 위해서 다시 (사이트에 더 많은 코드를 추가하게 하는) 취소 스타일이 필요하게 될 거다.

선택자를 [의도가 명확한 선택자][3](selector intent)로 만들어라.

이런 식으로.

    ul{
        font-weight:bold;
    }
    header .media{
        float:left;
    }
    

나는, 위의 예시처럼, 태그 선택자나 아주 일반적화된 클래스를 만다면 패닉에 빠진다. 저런 선택자는 아주 광범위하게 영향을 미치고 금세 문제를 일으킬 것이다. 위에서 지정한 요소를 다른 데서 사용하려고 하는 순간, 저 광범위한 선택자가 여기까지 영향을 미쳐서, 불필요한 스타일을 상속시켰다는 걸 알게 된다.

## 즉흥적인 `!important`(Reactive `!important)`

`!important`는 좋은 놈이다. 좋은 것이고, 음... **중요한** 툴이다. 그러나 `!important`는 오직 특정한 상황에서반 사용해야 한다.

**`!important`는 명확한 의도를 갖고(**proactively**) 사용해야지 즉흥적으로 사용하면 안 된다.**[^important]

[^important]: !important should only ever be used proactively, not reactively.

이 말이 뜻하는 바는, 언제나, **언제나** 우선 적용할 스타일이라는 점을 알고 있을 때, 그리고 이것을 늘 추적하고 있을 때만 `!important`를 사용하라는 것이다.[^precedence]

[^precedence]: By this I mean that there are times when you know you will always, always want a style to take precedence, and you will know this up front.

예컨대, 에러는 **언제나** 빨간 색이라는 것을 알 거다. 그래서 이런 선언은 아무 상관이 없다.

    .error-text{
        color:#c00!important;
    }
    

텍스트가 파란 `div`에서 에러가 나면, 규칙이 깨져서 혼란스러울 수 있다. 우리는 그게 에러라는 걸 알 수 있도록 **언제나** 에러가 빨간색이길 바란다. 그리고 사용자가 작성한 글은 언제나 일관돼야 한다. 그러면 우리는 명확한 의도를 가지고 `!important`를 추가할 수 있다. 에러는 언제나 빨간 색이라는 걸 알고 있기 때문이다.

`!important`가 나쁜 경우는 즉흥적으로 사용됐을 때다. 말하자면, `!important`를 특정 문제를 회피하는 데 사용하거나, 곤경에 처했을 때 강제로 해결하기 위해 `!important`에 의존하는 것이다. 이런 게 `!important`를 즉흥적으로 사용하는 경우고, 이건 나쁜 소식이다.

`!important`를 즉흥적으로 사용하게 되는 경우는 CSS를 잘못 사용했을 때밖에 없다. `!important`는 어떤 문제점도 수정하지 않는다. 증상만 덮을 뿐이다. 문제는 여전히 남아있다. `!important`에 가려서 묻혀 있을 뿐이다.[^overcome]

[^overcome]: The problems still exist, but now with and added layer of super-specificity that will take yet more specificity to overcome.

나는 명확한 의도가 있는 한 `!important` 사용하기를 망설이지 않는다. `!important`를 즉흥적으로 사용한 경우를 보는 순간, 나는 잘못된 CSS 구조가 있을 것이라고 생각하고, 리팩토링을 한다. 성급하게 불필요한 강제력을 사용하지 않는다.

## ID <a class="simple-footnote" title="IDs" id="return-note-8982-15" href="#note-8982-15"><sup>15</sup></a>

이건 나에게 특히 그런 것이고, 커다란 팀에게도 해당된다. [나는 예전에 ID가 별로 좋은 생각이 아니라고 쓴 적이 있다.][4] 특정도(specificity)가 높기 때문이다. ID는 전혀 쓸모가 없고 **CSS에서는 사용하면 안 된다.** 책갈피나 자바스크립트 이벤트를 거는 데 사용하고, CSS에서는 사용하지 마라.

이유는 간단하다.

*   ID는 한 페이지에서 두 번 사용될 수 **없다.**
*   클래스는 한 페이지에 한 번만 존재해도 되고 여러 번 존재해도 된다.
*   ID를 클래스로 바꾸면 재사용이 가능해지는 경우가 많다.
*   <del>[ID 하나는 클래스 하나보다 **255배** 강력하다...][5]</del> *클래스보다 무한히 강력하다*
*   이건, <del>ID를 [다른 스타일로] 덮어쓰려면 연결된 클래스 256개가 필요하다는</del> *아무리 많은 클래스로도 ID를 덮어쓸 수 없다는* 걸 의미한다.

ID를 사용하지 말라고 설득하기 위해 내가 꺼낼 수 있는 마지막 카드는 ... 뭔지 모르겠다.[^id]

[^id]: then I don’t know what will…

나는 스타일시트에서 ID를 발견하는 순간, 클래스로 바꾼다. 특정도가 프로젝트를 소용돌이에 빠지게 만드니, 낮게 유지하는 게 핵심이다.

재미삼아 푸는 문제 : [이 문제][6]를 **우아하게** 풀어 봐라. 힌트 : [이것은 우아하지 않다.][7] [이것도.][8]

## 느슨한 클래스 이름(Loose class names)

&#8216;느슨한&#8217; 클래스 이름이란 의도한 목적을 충분히 드러내지 못하는 것을 말한다. `.card`라는 클래스를 생각해 봐라. 이게 뭘 하는 놈일까?

이 클래스 이름은 아주 느슨하다. 그리고 느슨한 클래스 이름은 아주 나쁘다. 이유는 두 가지다.

*   클래스 자체에서 그것의 목적을 알아낼 수가 없다.
*   이름이 너무 모호해서 다른 개발자가 우연히 다른 의도로 사용하게 되기 쉽다.

첫 번째 지적은 정말 단순하다. `.card`가 의미하는 바가 뭘까? 스타일은 어떤 모양일까? 트렐로[^trello] 풍으로 각 카드가 컴포넌트인 컨셉인가? 포커 웹사이트에서 카드 게임 하기에 붙인 클래스인가? 크레딧 카드를 의미하는가? 판단하기 힘들다. 너무 느슨하기 때문이다. 이게 크레딧 카드를 의미한다고 해 보자. 이 클래스는 `.credit-card-image{}` 라고 하는 게 훨씬 나을 것이다. 물론 더 길다. 맞다. 그리고 더 낫다. 완전 맞다!(hell yes!)

[^trello]: 프로젝트 협업 관리 툴. 카드 모양 인터페이스를 사용한다.

느슨한 클래스 이름을 사용할 때 두 번째 문제는 (우연히) 재정의되기가 아주 쉽다는 거다. 전자 상거래 사이트에서 일하고 있다고 해 보자. 역시 `.card`를 사용했다고 치자. `.card`는사용자의 계정으로 연결된 크레딧 카드 모양의 링크다. 이제 다른 개발자가 기능을 추가하러 왔다고 치자. 뭔가를 구입해서 다른 사람에게 선물을 줄 때 카드로 메시지를 첨부할 수 있는 기능이다. `.card`를 어딘가에 다시 사용하고 싶을 것이다. 이건 **잘못**이다. 하지만 확실히, (거의 일어날 것 같지 않은 일이겠지만) .card 클래스를 재정의하고 덮어쓸 수 있다.

더 엄격한 클래스 이름을 사용하면 이런 것들을 피할 수 있다. .card나 .user 같은 클래스 이름은 너무 느슨해서 정확히 뭘 의미하는지 빨리 알아채기 힘들고, 우연히 재사용하거나 덮어쓰게 되게 쉽다.

나는 느슨한 클래스 이름을 보자마자, 이게 실제로 의미하는 바가 뭔지를 찾아내고, 새 이름으로 바꿀 수 없을까 생각한다. 클래스 이름은 가능한 구체적으로 지어야 한다.

## 마지막으로

자, 여기까지 왔다. 내가 CSS에서 코드 냄새라고 감지한 **많은** 것들 중에 일부를 풀어 놨다. 내가 어떤 대가를 치르고서라도 피하려고 매일매일 싸우는 것들이다. 몇 달 동안 (그리고, 궁극적으로는, 몇 년 간) 지속되는 더 큰 프로젝트에서는 규칙을 엄격하게 유지하는 것이 **사활적**이고, 위에 설명한 것들을 철저하게 추적하는 것이 ─ 다른 어떤 것들 보다도 ─ 최고로 중요하다. (이것은 아주아주 작은 부분이라는 것을 어떻게 더 설명할 수 있을지 모르겠다. 내가 찾아낸 것들은 **엄청** 많다.)

물론, 모든 규칙에는 예외가 있다. 하지만 각 사례별로 다르게 다뤄야 할 거다. 그러나 대부분은, 여기 있는 모든 것들은 내가 피하기 위해 노력하는 것들이고, CSS에서 한 눈에 알아볼 수 있는 것들이다.

## 내가 말한 것들을 연습할 때...

내가 알기로 이 사이트는 이 규칙들을 거의 다 어기고 있다. 그래서 [이에 대해 댓글을 남겼다.][9] [역자 주 - 그런데 지금은 없다.][^comment]

[^comment]: I am more than aware that this site goes against nearly all of these rules, so I left a brief comment on the matter.

 [1]: http://csswizardry.com/2012/11/code-smells-in-css/
 [2]: http://coding.smashingmagazine.com/2012/07/13/coding-qa-with-chris-coyier-code-smell-type-grid/
 [3]: http://csswizardry.com/2012/07/shoot-to-kill-css-selector-intent/
 [4]: http://csswizardry.com/2011/09/when-using-ids-can-be-a-pain-in-the-class/
 [5]: http://codepen.io/chriscoyier/pen/lzjqh
 [6]: http://jsfiddle.net/csswizardry/9wGac/
 [7]: http://jsfiddle.net/csswizardry/9wGac/1/
 [8]: http://jsfiddle.net/csswizardry/9wGac/2/
 [9]: http://csswizardry.com/2012/11/code-smells-in-css/#comment-253931