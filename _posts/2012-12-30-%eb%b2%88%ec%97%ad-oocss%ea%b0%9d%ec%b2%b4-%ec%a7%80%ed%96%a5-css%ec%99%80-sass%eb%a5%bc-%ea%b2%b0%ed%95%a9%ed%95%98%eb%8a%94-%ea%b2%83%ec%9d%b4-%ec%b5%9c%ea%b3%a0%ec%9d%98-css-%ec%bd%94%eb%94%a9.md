---
title: '[번역] OOCSS(객체 지향 CSS)와 Sass를 결합하는 것이 최고의 CSS 코딩 방법이다(OOCSS + Sass = The best way to CSS)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/8986
daumview_id:
  - 38367448
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - OOCSS
---

## 역자의 말

이 글을 번역한 지 3년 반이 지났다. 지금은 이 방법이 별로라고 생각하게 됐다. 그냥 HTML에 여러 개의 클래스를 쓰자. 그리고 이 글은 `@extend`를 긍정적으로 묘사하고 있는데, [`@extend`는 사용하지 말자.](http://csswizardry.com/2014/11/when-to-use-extend-when-to-use-a-mixin/) 그래도 번역은 한 거니 남겨 둔다.

-----

*** 알아 둘 점** : semantic이라는 단어는 &#8216;시맨틱&#8217;이라고 번역했다. 원래 semantic은 차세대 HTML에서 중요한 개념으로 사용되는 말이다. 번역하면 &#8216;의미론적&#8217;이라는 뜻이 되는데, 사실 &#8216;의미론적인&#8217; 뭐 이런 식으로 번역해도 큰 문제는 없다. 하지만, 업계에서 더 자주 사용되는 용어는 &#8216;시맨틱&#8217;이다. 그래서 그냥 &#8216;시맨틱&#8217;이라고 번역했다.

-----

[객체 지향 CSS][4]는 멋지다. 하지만 시맨틱하지 않은 클래스들로 마크업을 어지럽히는 것은 멋지지 않다. HTML 곳곳에 흩어져 있는 클래스들을 **모두** 바꿔야 할 일이 생길 텐데, 그건 아주 짜증나는 일이다. 하지만 OOCSS와 [Sass][3]를 결합한다면, 두 분야에서 최고의 결과물을 얻게 된다. 모듈화와 HTML 유지보수 용이성. (HTML을 복잡한 CSS로 어지럽힐 필요가 없기 때문에.)

## OOCSS는 HTML 유지보수를 힘들게 한다

우선, 빠르게 포기한 사람들, 상당수는 아마 열광했을 것이고, 다음으로 &#8220;시맨틱하지 않다&#8221;는 이야기를 들었을 것이다. 해법이 있다. 내 진정한 관심사는 **단지 시맨틱한지**가 아니다. 내 관심사는 유지보수다. 시맨틱하지 않은 클래스는 컴포넌트를 설명할 필요가 없고, 이것은 클래스가 **나중에** 컴포넌트에서 제거될 수도 있다는 것을 의미한다.

CSS만으로 모듈을 만드는 방법은 시맨틱하지 않은 클래스를 사용하는 방법밖에 없다. ([현재로서는.][5]) 그렇다면, 모든 HTML 요소에 이 클래스들을 적용해야 한다. 이것이 OOCSS의 모듈 접근법이다. 하지만 이것은 커다란 문제를 낳는다.

1.  나는 스타일이 변경될 때마다 HTML 전체를 훑으면서 수정하고 싶지 않다. 나는 [스타트업 회사][6]에서 일했는데, 시도 때도 없이 변경이 있었다.
2.  심지어, 클래스를 추가해야 하는 DOM 요소에 접근 권한이 없는 경우도 있다! 페이지 요소들을 렌더링하는 데 자바스크립트 컴포넌트를 사용하고 있다면, 컴포넌트 안에 있는 요소에는 클래스를 추가할 수가 없다. (뭔가 미친 짓을 하지 않는 이상.)

HTML 유지보수를 힘들게 하는 점만 제외하면, OOCSS의 나머지 부분은 맞는 소리들이다. 반복을 모듈로 추상화하는 것은 대규모 프로젝트에서 CSS를 유지보수하기 용이하게 할 수 있는 유일한 방법이다. 자, 그럼 문제점을 피하면서 이득을 취할 수 있는 방법이 있을까?

## 구원의 OOSass!   <a class="simple-footnote" title="OOSass to the rescue!" id="return-note-8986-1" href="#note-8986-1"><sup>1</sup></a>

OOCSS와 Sass를 결합하면 엄청난 힘이 생긴다. Sass의 `@extend` 지시자는 다른 선택자의 스타일을 상속할 수 있도록 해 준다. `@mixin`처럼 모든 것을 중복시키지도 않는다. 하지만 계층적으로 사용하거나, 계층화된 것들과 함께 사용한다면 `@extend` 호출조차 코드를 지저분하게 만들 수 있다. <a class="simple-footnote" title="nest를 계층적이라고 번역했다. 원문 필자는 .navi .title 이런 식으로 사용하는 것을 nest라고 칭한 것이고, 그래서 나는 그걸 계층적 사용이라고 번역했다." id="return-note-8986-2" href="#note-8986-2"><sup>2</sup></a>

반갑게도 [Sass 3.2][7]는 [플레이스홀더][8]라는 기능을 추가했다. 플레이스홀더는 다른 곳에서 `@extend`로 호출해 사용하기 전까지는 아무 것도 출력하지 않는 선택자다. 플레이스홀더는 이렇게 생겼다.

<pre><code class="sass">%separator
    border-top: 1px solid black

hr
    @extend %separator

.separator
    @extend %separator
</code></pre>

위 코드는 이런 CSS를 생성한다.

<pre><code class="css">hr,
.separator {
    border-top: 1px solid black
}
</code></pre>

플레이스홀더는 `mixin`이나 보통의 `@extend` 호출이 만들어내는 **지저분한 코드라는 문제를 피하게 해 준다**. 이런 특징 덕분에 플레이스 홀더는 시맨틱하지 않은 CSS 모듈을 만드는 데 최상이다. 나는 이 모듈을 **&#8220;패턴&#8221;**이라고 부른다. 패턴에는 다른 데 섞어서 사용할 수 있는 스타일을 조금 넣어 둔다.

## 실제 사용 사례를 보자

OOCSS 최고의 사례인 `.media` 모듈을 보자. `.media` 모듈을 `.status`, `.profile` 같은 다양한 컴포넌트에 적용하고 싶을 거다.

하지만, `.media` 클래스를 모든 HTML에 반복해서 갖다 붙이고 싶지는 않을 것이다. 특히 이미 `.status`와 `.profile` 클래스를 HTML에 널리 사용한 상태라면 말이다. 이럴 때 플레이스홀더를 사용하면 제대로 DRY할 수 있다. <a class="simple-footnote" title="DRY는 개발 원칙 중 하나다. Don&#8217;t Repeat Youself의 약자." id="return-note-8986-3" href="#note-8986-3"><sup>3</sup></a> 이게 우리의 `%media` 패턴이다.

<pre><code class="sass">%media
    overflow: hidden
    &:first-child
        float: left
    &:last-child
        overflow: hidden
</code></pre>

이렇게 하면 `.media` 클래스를 모든 요소들에 반복해서 갖다 붙이는 대신, 원하는 곳에 `%media` 패턴을 `extend`하면 된다.

<pre><code class="sass">.status
    @extend %media
    // Status-specific styles here...

.profile
    @extend %media
    // Profile-specific styles here...
</code></pre>

즉, HTML에 시맨틱한 클래스만 붙여 놓으면 된다는 말이다. `.status`와 `.profile` 같은 것 말이다. 이런 것까지 타이핑하기 싫지는 않을 거다. 이런 클래스들마저 없으면 `<article>` [같은 HTML] 요소밖에 남지 않을 테니까 말이다.

이렇게 하면 유연성도 얻을 수 있다. status의 스타일을 변경해서 이제 `.media` 모듈이 필요없다면, `@extend` 호출을 제거하기만 하면 된다! `.media` 클래스를 제거하려고 HTML을 돌아다닐 필요가 없다.

눈치가 빠른 사람들은 내가 `.media` 모듈을 약간 수정해서 사용했다는 걸 알아챘을 거다. 이제, 자바스크립트 컴포넌트를 사용할 때 DOM 접근권이 없는 경우로 돌아가 보자…

## OOSass는 자바스크립트 컴포넌트에 스타일을 입히기 쉽게 해 준다

내가 OOCSS를 사용할 때 겪은 가장 큰 문제는, DOM을 완전히 제어할 수 있어서 어디에나 클래스를 붙일 수 있다고 가정한다는 것이었다. 그렇지 않을 때가 있다! 자바스크립트 컴포넌트를 이용해서 (혹은 다른 뭔가를 이용해서) 렌더링할 때, 우리는 단지 컴포넌트 맨 위의 컨테이너만 건드릴 수 있다.

`.user-dropdown` 요소에 `DropdownView`를 붙인다고 가정해 보자. `.user-dropdown`에 `.media` 클래스를 붙일 수는 있지만, dropdown의 `.button`이나 `.menu-item` 안에 있는 요소에는 클래스를 붙일 방법이 없다. 컴포넌트 안의 DOM은 제어할 수 없기 때문이다.

Sass의 플레이스홀더를 사용하면 문제가 없다.

<pre><code class="sass">.dropdown
    // 여기는 모든 dropdown에 적용할 스타일...

.user-dropdown
    // 여기는 특정 dropdowns에만 적용할 스타일...
    .menu-item
        @extend %media
</code></pre>

CSS 클래스만 갖고 컴포넌트 안의 DOM을 건드리려면 미친 짓을 해야 한다. 컴포넌트에 들어가서 캡슐화돼 있는 것을 파괴하거나 문자열 기반의 끔찍한 클래스네임 API를 이용하거나. <a class="simple-footnote" title="You’d have to do uncouth things to get that to work with pure CSS classes: reaching into components and destroying their encapsulation, or using some sort of horrific string-based className API." id="return-note-8986-4" href="#note-8986-4"><sup>4</sup></a> 하지만 Sass 패턴을 사용하면 직접 제어하지 않는 DOM 요소가 늘어나도 상관없다. <a class="simple-footnote" title="But with Sass patterns you can easily augment DOM elements that you have no direct control of." id="return-note-8986-5" href="#note-8986-5"><sup>5</sup></a>

## 좋아, 좋아, 그럼 예제를 보자 {#okay_okay_get_to_the_examples}

나는 다른 사람들이 만든 CSS 패턴을 자주 읽어 본다. 그래서 나도 내 것을 몇 개 공유하기로 했다. 내가 [Segment.io][9]를 만들 때 전체적으로 사용했던 패턴이다.

### Lip {#lip}

이건 애플 스타일의 구분자다. 컨텐츠 위쪽으로 입술처럼 스타일을 만들어 준다. (역방향으로 사용하기 위해서 `%reversed-lip`도 만들었다.)

[역자 주 - 뭔지 궁금해서 [Segment.io][9]에 가 봤는데, 아래 이미지처럼 생긴 놈이다. 섹션을 구분할 때 그냥 선이 아니라 저렇게 은은한 그라데이션으로 만든 거다. 저게 입술처럼 생겼다고 lip이라고 이름붙였나 보다.]

<img class="aligncenter" alt="" src="/uploads/legacy/lip.png" width="775" height="83" />

<pre><code class="sass">%lip
    clear: both
    display: block
    height: 5px
    background: url('/public/images/patterns/lip/lip.png') no-repeat
    background-size: 100% 100%

%reversed-lip
    @extend %lip
    background-image: url('/public/images/patterns/lip/reversed-lip.png')
</code></pre>

### Valley {#valley}

오목해 보이도록 HTML 요소 위아래로 **lip**을 추가한다.

<div class="highlight">
  <pre><code class="sass">%valley
    position: relative
    overflow: hidden

    &::before,
    &::after
        content: ''
        position: absolute
        left: 0
        right: 0
    &::before
        @extend %lip
        top: 0
    &::after
        @extend %reversed-lip
        bottom: 0
</code></pre>
</div>

### Plane(평면) {#plane}

아주 간단한, 둥근 모서리 박스. Segment.io에서 바탕에 색을 입히기 위해 사용한다.

<div class="highlight">
  <pre><code class="sass">%plane
    box-shadow: 0 2px 5px rgba($black, .1)
    border-radius: $border-radius-medium

%white-plane
    @extend %plane
    background-color: $white

%off-white-plane
    @extend %plane
    background-color: $off-white

...
</code></pre>
</div>

### Seam(경계선) {#seam}

검은 줄과 하얀 줄을 겹쳐 놔서 반투명하게 보이는 border를 본 적이 있을 것이다. 난 그걸 **seam**이라고 부른다. (역자 주 : 선 하나 긋는 건데 약간 오목하게 들어가 보이는 선 말이다. 아래 그어져 있는 선이 이 사람이 말하는 선이다. rgba가 지원되는 브라우저에서만 제대로 보인다.)

<div style="clear: both; display: block; height: 0px; border-top: 1px solid rgba(0,0,0, .12); border-bottom: 1px solid rgba(255,255,255, .15); margin: 1em 0;">
</div>

<div class="highlight">
  <pre><code class="sass">%seam
    clear: both
    display: block
    height: 0px
    border-top: 1px solid rgba($black, .12)
    border-bottom: 1px solid rgba($white, .15)
</code></pre>
</div>

### Well {#well}

valley처럼, 페이지에서 들어가 있는 부분이다. `<code>` 예제 같은 데서 사용한다. (이 블로그에서 사용하는 것과 비슷하다. [역자 주 - 이 블로그란 저자의 블로그를 말한다.])

<div style="width: 773px" class="wp-caption aligncenter">
  <img alt="" src="/uploads/legacy/seam.png" width="763" height="138" /><p class="wp-caption-text">
    seam
  </p>
</div>

<div class="highlight">
  <pre><code class="sass">%well
    box-shadow: inset 0 1px 5px rgba($black, .14)
    border-radius: $border-radius-medium

%off-white-well
    @extend %well
    background-color: $off-white

%light-gray-well
    @extend %well
    background-color: $light-gray

...
</code></pre>
</div>

## 이제 당신의 차례다

이 글을 통해 CSS 컴포넌트에서 패턴으로 할 수 있는 것과 사용법에 대해 잘 알게 됐으면 좋겠다. [패턴을] 사용할 곳은 어디에나 있다.

패턴은 [오직 한 가지 기능만][10] 해야 한다. 그리고 그걸 잘 해야 한다. 해리 로버트는 패턴의 이름은 추상적으로, 시맨틱하지 않게 지어야 한다고 [논평했다][11]. 그렇게 하면 패턴은 추상화될 것이고, 그럼 어디서나 사용할 수 있게 된다. 또한 패턴은 언제나 다른 것들을 기반으로 작성할 수 있다. 내가 **valley** 예제에서 한 것처럼 말이다.

비슷한 자기만의 패턴이 있다면, 나에게 한 번 보여 주길 바란다!

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>

  <ol>
    <li id="note-8986-1">
      OOSass to the rescue! <a href="#return-note-8986-1">&#8617;</a>
    </li>
    <li id="note-8986-2">
      nest를 계층적이라고 번역했다. 원문 필자는 <code>.navi .title</code> 이런 식으로 사용하는 것을 nest라고 칭한 것이고, 그래서 나는 그걸 계층적 사용이라고 번역했다. <a href="#return-note-8986-2">&#8617;</a>
    </li>
    <li id="note-8986-3">
      <a href="http://sunnyspace.tistory.com/entry/DRY%EC%9B%90%EC%B9%99">DRY</a>는 개발 원칙 중 하나다. Don&#8217;t Repeat Youself의 약자. <a href="#return-note-8986-3">&#8617;</a>
    </li>
    <li id="note-8986-4">
      You’d have to do uncouth things to get that to work with pure CSS classes: reaching into components and destroying their encapsulation, or using some sort of horrific string-based className API. <a href="#return-note-8986-4">&#8617;</a>
    </li>
    <li id="note-8986-5">
      But with Sass patterns you can easily augment DOM elements that you have no direct control of. <a href="#return-note-8986-5">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://mytory.net/archives/8949 "[번역] 객체 지향 CSS(OOCSS) 소개"
 [2]: http://mytory.net/archives/8949#comment-4354
 [3]: http://sass-lang.com/
 [4]: http://oocss.org/
 [5]: http://www.xanthir.com/blog/b49w0
 [6]: https://segment.io/
 [7]: http://chriseppstein.github.com/blog/2012/08/23/sass-3-2-is-released/
 [8]: http://sass-lang.com/docs/yardoc/file.SASS_REFERENCE.html#placeholders
 [9]: https://segment.io
 [10]: http://csswizardry.com/2012/04/the-single-responsibility-principle-applied-to-css/
 [11]: http://www.youtube.com/watch?v=R-BX4N8egEc&hd=1

 *[DRY]: Don't Repeat Yourself
