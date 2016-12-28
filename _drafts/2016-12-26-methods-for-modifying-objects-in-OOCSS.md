---
title: "OOCSS에서 객체를 수정하는 방법"
author: 안형우
tags:
  - OOCSS
  - css
---

올리버 조셉 애쉬의 ["Methods for modifying objects in OOCSS"][원본](2012년 9월) 번역글이다. 관련 주제를 다룬 글로 세 번째 번역이다.

[원본]: https://oliverjash.me/2012/09/07/methods-for-modifying-objects-in-oocss

니콜라스 갤러거는 [HTML 시맨틱과 프론트엔드 아키텍처에 대해][갤러거](2012년 3월)에서 "멀리 클래스" 패턴과 "싱글 클래스" 패턴이라고 명명하면서 자신은 특성을 수정하기 쉽기 때문에 "멀티 클래스" 패턴을 지지한다고 밝혔다.

[갤러거]: http://mytory.net/2016/12/02/about-html-semantics-front-end-architecture.html

해리 로버츠는 [@extend를 사용해야 할 때와 믹스인을 사용해야 할 때][로버츠](2014년 11월)에서 소스 연관성이 깨지고 특정도에 혼란이 오기 때문에 `@extend`를 웬만하면 사용하지 말라고 권장했다.

[로버츠]: http://mytory.net/2016/12/23/when-to-use-extend-when-to-use-a-mixin.html

이 글은 니콜라스 갤러거가 간단히 한 주장을 좀더 심화해서 구체적으로 보여 준다.

-----

CSS 객체 수정자(modifier)를 구현하는 방법은 두 가지가 있다. 하나는 CSS 객체를 확장하는 것이고, 다른 하나는 HTML 작성시에 클래스를 이어 씀으로써 해결하는 것이다. 이 글에서, 나는 OOCSS에서 수정자의 목적을 소개하고 두 방법의 장단점을 살펴 보면서 `@extend`가 [때로 빛 좋은 개살구(fools gold)라고][fools-gold] 주장할 것이다.

[fools-gold]: https://twitter.com/csswizardry/status/261056433607569409

## 수정자란 무엇인가?

OOCSS의 발상을 처음 접하는 사람들을 위해, 객체 수정자의 원리를 적용할 수 있는 간단한 예를 살펴 보자.

    .widget {
      padding: 10px;
    }

`widget` 객체가 있다. 이 객체의 목적은 이름에 잘 나타나 있다. `widget`엔 패딩이 있지만, 예를 들면 가끔 외곽선이 있는 위젯을 보여 줘야 한다고 해 보자. DRY 방법론을 따르면 `widget` 객체를 확장하고 수정할 테니, 나는 다음과 같이 할 필요가 없다.

<pre>.widget {
    padding: 10px;
}

.widget-alt {
    padding: 10px;
    border: 1px solid #ccc;
}</pre>

새로 만든 `widget-alt` 객체(alternative widget의 약어)에는 외곽선이 있지만, `widget`의 패딩을 중복하고 있다. 
