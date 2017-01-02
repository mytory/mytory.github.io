---
title: "[번역] OOCSS 객체 수정시 extend 말고 class 이어 적기를 사용하자"
author: 안형우
tags:
  - OOCSS
  - css
---

올리버 조셉 애쉬의 ["OOCSS 객체 수정 방법(Methods for modifying objects in OOCSS)"][원본](2012년 9월) 번역글이다. 객체를 약간 변형할 때 어떤 방법을 사용할 것인가 하는 주제를 다룬 글로 세 번째 번역이다. 다른 두 개는 아래와 같다.

1. 니콜라스 갤러거는 ["HTML 시맨틱과 프론트엔드 아키텍처에 대해"][갤러거](2012년 3월)에서 "멀티 클래스" 패턴과 "싱글 클래스" 패턴이라고 명명하면서 자신은 다양한 변종을 만들 때 더 효과적이기 때문에 "멀티 클래스" 패턴을 지지한다고 밝혔다.
2. 해리 로버츠는 ["@extend를 사용해야 할 때와 믹스인을 사용해야 할 때"][로버츠](2014년 11월)에서 소스 연관성이 깨지고 특정도에 혼란이 오기 때문에 `@extend`를 웬만하면 사용하지 말라고 권장했다.
3. 이 글은 `@extend`를 사용하면 유지보수하기가 오히려 힘들어지고, 소스가 지저분해진다는 점을 좀더 구체적으로 보여 준다.

[원본]: https://oliverjash.me/2012/09/07/methods-for-modifying-objects-in-oocss
[갤러거]: http://mytory.net/2016/12/02/about-html-semantics-front-end-architecture.html
[로버츠]: http://mytory.net/2016/12/23/when-to-use-extend-when-to-use-a-mixin.html

각주는 모두 역자가 붙인 것이다. \[ \] 안의 말은 역자가 이해를 돕기 위해 추가한 말이다.

-----

CSS 객체 수정자(modifier)[^modifier]를 구현하는 방법은 두 가지가 있다. 하나는 CSS 객체를 확장하는 것이고, 다른 하나는 HTML 작성시에 클래스를 이어 적기 해서 해결하는 것이다. 이 글에서, 나는 OOCSS에서 수정자의 목적을 소개하고 두 방법의 장단점을 살펴 보면서 `@extend`가 [때로 빛 좋은 개살구(fools gold)라고][fools-gold] 주장할 것이다.

[^modifier]: BEM에 관한 번역에서는 modifier를 "수식어"라고 번역했다. 그런데 지금 번역하는 글에서 modifier는 단지 수식하는 역할만 하지 않는다. 아예 원래 객체의 속성을 다 물려 받아서 새로운 클래스를 만드는 경우도 있다. (물론 이 글은 그런 식의 방법을 추천하지 않고 '수식어'로 사용할 것을 권장하고 있지만 말이다.) 그래서 어쩔 수 없이, 좀 맘에 안 들긴 하지만 "수정자"로 번역했다. 여전히 BEM에서는 "수식어"로 번역할 것이다.
[fools-gold]: https://twitter.com/csswizardry/status/261056433607569409

## 수정자란 무엇인가?

OOCSS의 발상을 처음 접하는 사람들을 위해, 객체 수정자의 원리를 적용할 수 있는 간단한 예를 살펴 보자.

    .widget {
      padding: 10px;
    }

`widget` 객체가 있다. 이 객체의 목적은 이름에 잘 나타나 있다. `widget`엔 패딩이 있지만, 가끔은 예컨대 외곽선이 있는 위젯을 보여 줘야 한다고 해 보자. DRY 방법론을 따르면 `widget` 객체를 확장하고 수정할 테니, 다음처럼 하지 않는다.

<pre>.widget {
    padding: 10px;
}

.widget-alt {
    padding: 10px;
    border: 1px solid #ccc;
}</pre>

새로 만든 `widget-alt` 객체(alternative widget의 약어)에는 외곽선이 있지만, `widget`의 padding을 중복하고 있다. 디자인으로 돌아가 보자. 모든 위젯에는 padding이 있음이 분명하다. 이 시점에서, 우리는 패턴이 있음을 알아채야 한다. 원래의 `widget` 객체를 확장하면 padding 속성 선언 중복을 피할 수 있다.

    .widget,
    .widget-alt {
      padding: 10px;
    }

    .widget-alt {
      border: 1px solid #ccc;
    }

## 전처리기로 확장(extend)하기

CSS를 구성할 때, 속성을 공유하게 하기 위해 늘 이렇게 수동으로 선택자를 확장하는 것은 실용적이지 않다. 여러 종류의 위젯이 있다고 생각해 보자. 매번 직접 작성한 그룹 선택자[^group-selector]로 돌아가서 그걸 확장해야 한다. [`@extend` 마법][extend-magic]을 사용하지 않고 말이다.

[^group-selector]: `.widget, .widget-alt { ... }`처럼 여러 선택자를 연이어 써서 정의한 것을 그룹 선택자라고 한다.
[extend-magic]: http://sass-lang.com/

    /* Our pattern */
    .widget {
      padding: 10px;
    }

    .widget-alt {
      @extend .widget;
      border: 1px solid #ccc;
    }

정말로, 만약 OOCSS를 쓰고 있다면, CSS 전처리기로 이렇게 하는 것은 특히 손쉬운 일이다. 간단하게 `@extend`를 사용하면 앞서 작성한 것과 똑같은 CSS가 나온다. 프로젝트가 커질수록 이 방식이 훨씬 쉽다.

### 확장(extend)할 때 문제점

`widget` 객체의 예제를 확장해 보자. 스타일을 정의한 자손이 몇 개 더 있다.

<pre>
/* SCSS */

.widget {
  padding: 10px;

  h1 {
    margin-bottom: 10px;
  }

  p {
    /* 간단한 팁, 전처리기는 모든 CSS3 `hsl` 값을 `rgb`로 변환한다. `hsl`은  떠올리기에 훨씬 쉽고, 따라서 색상을 적용하기도 쉽다. 내가 전처리기를 좋아하는 또 하나의 이유다. */
    color: hsl(0, 0%, 10%);
  }
}
</pre>

이제 수정자를 만들어 이 객체를 확장하려면 무엇을 해야 할까?

<pre>
/* SCSS */

.widget-alt {
  @extend .widget;
  border: 1px solid hsl(0, 0%, 90%);
}

/* CSS */

.widget,
.widget-alt {
  padding: 10px;
}

.widget h1,
.widget-alt h1 {
  margin-bottom: 10px;
}

.widget p,
.widget-alt p {
  color: rgb(26, 26, 26);
}

.widget-alt {
  border: 1px solid rgb(230, 230, 230);
}
</pre>

`@extend`가 뭔가 문제를 일으킬 수 있는 상황이다. 객체를 확장하면 **중첩된 객체를 전부 확장하게 되기** 때문이다. 보다시피, `widget`은 `widget-alt`에게 자기 자신만 공유하는 것이 아니라 자손들까지 공유하게 된다. `h1`와 `p` 요소가 그런 예다. 이것은 이미 CSS를 필요 이상으로 늘렸고, 결국 (더 큰 프로젝트에서는) 더 긴 선택자를 만들어내게 될 것이다.

예컨대, 사이드바 안에 있는 모든 `widget` 객체의 하단 마진을 조정해야 한다고 해 보자. 위젯들을 어떻게 특정할 것인가?

<pre>
/* SCSS */
.l-sidebar {
  .widget,
  .widget-alt {
    margin-bottom: 25px;
  }
}

/* CSS */
.l-sidebar .widget,
.l-sidebar .widget-alt {
  margin-bottom: 25px;
}
</pre>

우리는 모든 위젯에 스타일을 적용하도록 모든 변형판 목록을 다 나열해야 한다.

이게 그리 많아 보이지 않을 수도 있겠지만, 더 많은 변형판을 만들면서 `widget` 객체를 확장하기 시작하면(예컨대 `widget-primary`, `widget-secondary`), CSS는 순식간에 스파게티처럼 변할 것이다.

## HTML에서 클래스를 연이어 적기

한 번 언급하는 것만으로 전체 위젯 종류에 영향을 미칠 수 있다면 훨씬 더 효율적일 것이다. 내가 작업을 HTML로 미루는 편이 낫다고 믿는 이유다. 방법을 보자.

<pre>
/* SCSS */

.l-sidebar {
  .widget {
    margin-bottom: 25px;
  }
}

.widget {
  padding: 10px;

  h1 {
    margin-bottom: 10px;
  }

  p {
    color: hsl(0, 0%, 10%);
  }
}

.widget-alt {
  border: 1px solid rgb(230, 230, 230);
}

/* CSS */

.l-sidebar .widget {
  margin-bottom: 25px;
}

.widget {
  padding: 10px;
}

.widget h1 {
  margin-bottom: 10px;
}

.widget p {
  color: hsl(0, 0%, 10%);
}

.widget-alt {
  border: 1px solid rgb(230, 230, 230);
}
</pre>

모양을 제대로 적용하려면, 우리는 HTML에 두 클래스를 사용해야 한다.

    <div class="widget widget-alt">
      …
    </div>

HTML에 클래스 추가하기를 꺼리는 사람도 있을 것이다. 개인적으로, 나는 요소에 클래스를 연이어 적는 것이 OOCSS에서 객체를 확장하는 가장 좋은 방법이라고 생각한다. 중요한 것은, CSS에서 HTML로 작업을 미룸으로써, 우리가 훨씬 더 효율적인 CSS를 얻었다는 점이다. 이 예제는 수정자를 단 하나만 사용하는 간단한 경우지만, `widget` 객체에 수정자가 몇 개 더 있는 경우, CSS에서 작업하게 되면 그룹 선택자가 지저분해질 것이라는 점을 금세 알 수 있다.

## 확장을 사용할 때 효율성

위젯 예시를 다시 한 번 보자. 다만, 이번에는 다른 수정자를 붙일 것이다.

<pre>
/* SCSS */

.widget {
  …

  h1 {
    …
  }

  p {
    …
  }
}

.widget-alt {
  @extend .widget;

  …
}

.widget-box {
  @extend .widget;

  …
}

/* CSS */

.widget,
.widget-alt,
.widget-box {
  …
}

.widget h1,
.widget-alt h1,
.widget-box h1 {
  …
}

.widget p,
.widget-alt p,
.widget-box p {
  …
}

.widget-alt {
  …
}

.widget-box {
  …
}
</pre>

\[Sass 컴파일 후\] 우리가 얻은 것은 다음과 같다.

- 선택자 3개(\[선택자가\] 3개인 그룹 1개). 원 객체와 수정자가 스타일을 공유함으로써 나온 것.
- 선택자 6개(\[선택자가\] 3개인 그룹 2개). 원 객체와 수정자 둘의 자손 스타일을 공유함으로써 나온 것.

위의 예에서, `@extend`를 사용해 `widget`을 수정하면 25줄 짜리 CSS가 나온다. 반면, 연이어 적은 클래스를 사용하면 19줄이 나온다. 지금 이 예제에서는 차이가 작다. 하지만 더 큰 사례를 보자.

객체가 10개가 있다고 생각해 보자(위젯, 내비게이션 목록 등). 각 객체에는 수정자가 2개씩 있고(`widget-alt`, `widget-box` 등), 자손이 평균 2개씩 있다. `extend`를 사용하면 우리가 얻는 것은 다음과 같다.

- 선택자 30개(\[선택자가\] 3개인 그룹 10개). 원 객체와 수정자가 스타일을 공유함으로써 나온 것.
- 선택자 60개(\[선택자가\] 3개인 그룹 20개). 원 객체와 수정자 둘의 자손 스타일을 공유함으로써 나온 것.

선택자당 줄 수를 세어 보면, 수정자와 자손을 모두 선택하는 데만 90줄을 사용하게 됐다. 반면, 같은 객체 샘플에서, HTML에 클래스를 연이어 적는 방법을 사용하면, CSS는 30줄만 사용하게 된다. 물론, 이 방법을 쓰면 HTML에 클래스를 추가해야 한다. 그러나 99%의 경우 이 방법이 더 효율적일 것이다.


## 결론

요컨대, 나는 개인적으로 객체 수정자 작업을 HTML로 미루는 것이 더 낫다고 믿는다. 이것이 (대부분의 경우) 더 효율적이기 때문만은 아니다. 두 방법 사이의 진정한 차이는 다른 객체 안에 들어간 객체를 수정할 필요가 있을 때 보이기 시작한다. 예컨대, 사이드바 안에 있는 모든 위젯의 하단 마진을 조정하는 것 같은 경우다. `extend`를 사용하면 객체 수정자 전부를 수동으로 나열해야 하는 경우가 생긴다. 어떤 객체 안의 모든 제목 CSS를 조정할 필요가 있을 때도 비슷하다. 이렇게 할 수 있을 것이다.

<pre>
.widget {
  padding: 10px;
}

.widget-alt {
  padding: 10px;
  border: 1px solid #ccc;
}
</pre>

다른 방법으로는, 그냥 HTML에 클래스를 추가할 수 있다. 그러면 CSS 복잡성이 줄어든다.[^change]

[^change]: 원본글에는 `.widget-alt`에 `padding: 10px;`이 들어있는데, 내 생각엔 없는 게 맞는 듯해 뺐다.

<pre>
.widget {
  padding: 10px;
}

.widget-alt {
  border: 1px solid #ccc;
}
</pre>

내가 여기서 말한 것과 다른 생각이 있다면, [트위터][twitter]로 알려 달라. (다른 모든 프론트엔드 개발자들이 그렇듯이, 정말로) 나는 내가 실제로 사용하는 방법들을 매우 비판적으로 검토한다.[^critical] 모든 비판은 좋은 것이다.

[twitter]: https://twitter.com/OliverJAsh
[^critical]: I’m incredibly critical of the methods I use in practice (like any front-end developer should be, really).
