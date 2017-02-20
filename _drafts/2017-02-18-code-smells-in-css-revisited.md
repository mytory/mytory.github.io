---
title: '추가적인 CSS 코드 냄새'
layout: post
tags:
  - css
---

CSS Wizardry의 해리 로버츠가 최근 [Code Smells in CSS Revisited][original]를 작성했다. 해리 로버츠는 [2012년에 이미 한 번 CSS의 코드 냄새에 대해 글을 쓴 바 있는데,][2012] 최신 상황에 맞추어 몇 가지를 추가한 것이다.

[original]: https://csswizardry.com/2017/02/code-smells-in-css-revisited/

[2012]: http://mytory.net/archives/8982

여기서는 해당 글을 요약 소개한다. 

----

## 코드 냄새란 무엇인가?

우선 코드 냄새가 무엇을 말하는지부터 살피고 가자. 아래는 위키피디아에 정의된 내용인데 강조는 해리 로버츠가 한 것이다.

  >  코드 냄새는, 악취라고 부르기도 하는데, 컴퓨터 프로그래밍 코드에서 **더 심층에서(deeper) 문제를 일으킬 수 있는** 프로그램 소스 코드를 가리키는 용어다. 마틴 파울러에 따르면 '코드 냄새는 표면에 드러난 표시고, 보통 시스템의 더 깊은 곳과 관련돼 있다'.  냄새를 찾는 또 다른 방법은 원칙과 품지에 관심을 기울이는 것이다. '냄새는 코드에서 **핵심 설계 원칙을 깨뜨리고** 설계 품질에 부정적인 영향을 미치는 특정 구조다'. 흔히 코드 냄새가 버그인 것은 아니다. 코드 냄새는 **기술적으로 잘못된 것은 아니며** 현재는 프로그램의 기능을 중단시키는 것도 아니다. 대신에, **코드 냄새는 개발을 늦출 수 있는 설계의 취약함을 나타내거나** 미래에 버그나 실패의 위험이 높아진다는 것을 의미한다.  코드 악취는 기술 부채가 늘어날 징후일 수 있다. 로버트 C. 마틴은 코드 냄새의 목록을 소프트웨어 장인정신을 위한 '가치 체계'라고 부른다.

해리 로버츠는 따라서 자신이 드는 '코드 냄새'들이 언제나 틀린 것은 아니며, 단지 좋은 리트머스 시험지로 여기라고 한다.

나는 그정도로 느슨하게 말하지 않겠다. '내가 처한 경우는 예외야' 하고 생각하는 것은 너무 많은 예외를 만드는 경향이 있다. 따라서 처음에는 다소 기계적이라고 느껴지더라도 권장사항을 그냥 따르려고 노력하자.

## `@extend`

내가 몇 가지 글을 번역하기도 했는데, 지난 4년 동안 해리 로버츠도 `@extend`의 위험성을 많이 경고해 왔다며 사용하지 말 것을 권하고 있다. 이유를 요약하면 아래와 같다.

  - mixin보다 성능이 떨어진다. CSS 성능이란 건 대체로 용량을 말하는데, 용량이 작아야 빨리 다운로드할 수 있기 때문이다. gzip 압축시 mixin은 완전한 반복이므로 용량이 확 줄어드는 반면, extend는 완전한 반복이 아니므로 용량이 커지는 경향이 있다.
  - 탐욕스럽다. `@extend`는 모든 자식 요소들에 적용돼 엄청나게 긴 선택자를 만들어내기도 한다. [예시][example]
  - 코드를 여기저기 흩어 놓는다.
  - 실마리를 감춘다. HTML 쪽에서 클래스의 내용을 인지하기 어렵다. 여러 개의 클래스를 사용하는 기법이 낫다.

[example]: https://twitter.com/gaelmetais/status/564109775995437057

다음을 참고하자.

  - [Mixins Better for Performance](https://csswizardry.com/2016/02/mixins-better-for-performance/)
  - [When to Use @extend; When to Use a Mixin](https://csswizardry.com/2014/11/when-to-use-extend-when-to-use-a-mixin/)(번역: [Sass에서 웬만하면 extend 말고 믹스인을 사용하자](http://mytory.net/2016/12/23/when-to-use-extend-when-to-use-a-mixin.html)
  - [Extending Silent Classes in Sass](https://csswizardry.com/2014/01/extending-silent-classes-in-sass/)

## 클래스 문자열 이어붙이기

이게 또 최근에 짜증나는 코드인데, `&`를 사용해서 클래스명을 이어 붙이는 것이다.

<pre>
. foo {
  color: red;

  &-bar {
    font-weight: bold;
  }

}
</pre>

이러면 아래쪽의 `&-bar`가 `.foo-bar`가 된다. 간편하고 DRY(Do Not Repeat Yourself) 원칙에도 맞는 것처럼 보인다.

하지만 이러면 소스코드에 더이상 `.foo-bar`가 존재하지 않게 된다. 전체 검색을 하면 HTML 쪽에서만 발견될 것이다. 그러면 클래스를 추적하기가 어려워진다.

이건 나도 격하게 동의하는 바다. 전체 찾기와 `grep`[^ack]을 자주 사용하는 나는 이런 식의 코드 사용을 별로 좋아하지 않는다.

[^ack]: 해리 로버츠는 [`grep`보다 `ack`을 좋아한다][ack]고 밝혔다. 그런데 난 아직 `ack` 사용 연습을 하지 않았다.

[ack]: https://csswizardry.com/2017/01/ack-for-css-developers/

소스맵이 알려 준다고 생각할 수도 있고, 클래스명으로 해당 클래스가 있는 파일을 유추할 수 있다고 말할 수도 있을 테지만, 그게 늘 그렇게 되는 게 아니다. 해리 로버츠의 [스크린캐스트](https://www.youtube.com/watch?v=MGzoRM3Al40) 참조.

## `background` 단축어

css의 `background` 속성은 사실 아래처럼 많은 의미를 담고 있다.

<pre>
background: [background-color || background-image || background-repeat || background-attachment || background-position] | inherit]
</pre>

그러니까 아래처럼 쓰면 다른 모든 값을 초기화하는 효과를 낸다.

<pre>
.btn {
  background: #f43059;
}
</pre>

배경 이미지, 배경 첨부, 배경 위치, 배경 반복 여부를 초기화한다. 아마 개발자가 실제로 의미한 바는 아래와 같을 것이다.

<pre>
.btn {
  background-color: #f43059;
}
</pre>

그러니까 `background` 단축 속성은 사용하지 말자.

## 핵심 선택자가 한 번 이상 나타나는 것

핵심 선택자(key selector)란 스타일을 지정하려고 목표하는 최종 선택자를 말한다. 아래 코드를 보자.

<pre>
.foo {}

nav li .bar {}

.promo a,
.promo .btn {}
</pre>

여기서 핵심 선택자는 아래와 같다.

  - `.foo`
  - `.bar`
  - `a`
  - `.btn`

그런데 코드에서 `.btn`으로 검색을 해 보면 아래처럼 여러 곳에 흩어져서 코드가 등장하는 경우가 있다.

<pre>
.btn {}

.header .btn,
.header .btn:hover {}

.sidebar .btn {}

.modal .btn {}

.page aside .btn {}

nav .btn {}
</pre>

CSS 코드가 별로인 건 차치하고, 이러면 두 가지 문제가 생긴다.

  - 버튼이 어떻게 보일지 알려 주는 진실의 유일 소스(Single Source of Truth)가 사라진다.
  - `.btn`의 변형판이 너무 많아서, 이게 결국 어떻게 보일지 예상하지 못하게 된다.

이런 경우 의도치 않은 효과가 발생하기 마련이다. BEM을 사용하자.

## 여러 컴포넌트에 나타나는 클래스

비슷하지만 좀 다른 사례인데, 아래 코드를 보자.

<pre>
.btn {}
.modal .btn {}
</pre>

자, `.modal .btn`은 어느 파일에 둬야 할까? `_components.btn.scss`일까 `_components.modal.scss`일까?

위 경우 `.btn` 파일에 코드를 둬야 한다. 주제에 따라 그룹을 짓는다. 주제는 "무엇을 스타일하냐" 하는 것이다. 위에서 우리는 `.btn`을 스타일한다. `.modal`은 그냥 맥락일 뿐이다.

이렇게 하는 게 버튼 스타일을 살펴 보는 데도 편하다. 버튼 스타일 하나 보려고 파일을 10개씩 열고 싶진 않을 것이다.

버튼 스타일을 다른 프로젝트로 한 방에 옮길 때도 이렇게 돼 있는 편이 편하다.

한 마디로 말하면, 네가 스타일하고 있는 것이 x냐 y냐 하는 질문에 답해 보면 된다. x를 스타일하고 있다면 `x.css`에, y를 스타일하고 있다면 `y.css`에 두면 된다.

