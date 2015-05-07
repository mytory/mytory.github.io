---
layout: post
title: "[번역] BEM으로 사고하기 - BEM 문법 익히기"
categories:
- html-css-js
tag:
- OOCSS
- CSS

---

**이 글은 CSS Wizardry를 운영하는 Harry Roberts의 글 ['MindBEMding – getting your head ’round BEM syntax'](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/)를 번역한 것이다.**

**해리 로버츠는 자신이 만든 inuitcss에서 BEM 원리에 따라 클래스 이름을 지었다. 나도 여기서 처음 BEM을 알게 됐다. 작명법으로서 BEM은 각 요소의 연관성을 분명하게 보여 줄 수 있다. 여튼 글을 읽어 보자.**

---

내가 가장 자주 받는 질문 중에 하나는 <q>당신이 작성한 클래스에서 `--`랑 `__`가 뭘 뜻하는 거냐?</q> 하는 것이다.

대답은 [BEM](http://bem.info)과 [Nicolas Gallagher](http://twitter.com/necolas) 덕분에…

---

BEM - <i>block</i>, <i>element</i>, <i>modifier</i>의 약어 - 은 [Yandex](http://yandex.ru) 사람들이 고안해 낸 프론트엔드 작명법이다. BEM은 깔끔한 CSS 클래스 작명법이다. CSS 클래스들을 더 투명하게 하고, 다른 개발자들에게 의미가 잘 전달될 수 있도록 한다. BEM으로 작명한 클래스들은 훨씬 더 엄격하고, 정보가 풍부하다. BEM 작명 규칙(naming convention)은 계속 이어질 큰 프로젝트에 이상적이다. 

짚고 가야 할 것은, 내가 BEM에 _기반한_ 작명 규칙을 사용하지만, 그것은 [니콜라스 갤라허가 연마한 것](http://nicolasgallagher.com/about-html-semantics-front-end-architecture/)이라는 점이다.
이 글에서 다루는 작명 기법(techniques)은 BEM 원형의 것이 아니다. 내가 선호하는 개선판이다. 실제로 어떤 표기법을 사용하든 간에 그것은 모두 동일한 BEM 원리에 기초한다.

작명 규칙은 다음 패턴을 따른다.

    .block {}
    .block__element {}
    .block--modifier {}

* `.block`(`.블럭`)은 더 높은 단계의 추상(abstraction) 혹은 구성요소(component)를 나타낸다.
* `.block__element`(`.블럭__요소`)는 `.block`의 자식을 나타낸다. 자식은 `.block`을 형성하는 일부다.
* `.block--modifier`(`.블럭--수식어`)는 `.block`의 다른 상태나 버전을 나타낸다.

하이픈(`-`)이나 언더스코어(`_`)를 하나가 아니라 두 개를 사용하는 이유는, 블럭 이름 자체가 
하이픈 구분자를 사용할 수 있기 때문이다.예컨대

	.site-search {} /* Block */
	.site-search__field {} /* Element */
	.site-search--full {} /* Modifier */

BEM의 핵심은 다른 개발자들에게 이 마크업이 무엇을 하는 놈인지 이름 그 자체로 더 많은 것을 알려 줄 수 있다는 점이다.
HTML과 클래스들을 조금 읽으면, (적어도) 덩어리들의 연관성을 알 수 있다. 어떤 것은 단지 구성소요일 수 있고, 어떤 것은 아마도 구성요소의 자식, 혹은 <i>요소</i>일 것이다. 그리고 다른 어떤 것은 아마도 그 구성요소의 변형판 혹은 <i>수식어</i>일 것이다. 
이 비유/모형(analogy/model)에 따르면, 다음 것들이 어떻게 연관돼 있는지 생각해 보자. 

    .person {}
    .person__hand {}
    .person--female {}
    .person--female__hand {}
    .person__hand--left {}

최고 단계 블럭은 '사람'이다. 사람에겐 '손' 같은 요소가 있다. 
사람은 또한 여성 같은 변형판이 있다. 그리고 변형판에는 또한 자신의 요소가 있다.
이것은 다시 '일반적인' CSS로 써 보자.

    .person {}
    .hand {}
    .female {}
    .female-hand {}
    .left-hand {}

이것은은 모두 의미가 있다. 하지만 어떤 연결은 끊어졌다. `.female`(여성)을 보자.
여성이 뭐? `.hand`(손)는 어떤가? 시계바늘(a hand of a clock)인가? 카드게임에 나오는 손인가? 
BEM을 사용함으로써, 우리는 더 설명적이면서도 더욱 명쾌해질 수 있다. 
우리는 이름만으로 코드 내 요소들 간에 단단한 연결을 구축할 수 있다. 강력한 기법이다.

앞서 `.site-search` 예제로 돌아가 보자. '보통' 작명법으로 말이다.

    <form class="site-search  full">
        <input type="text" class="field">
        <input type="Submit" value ="Search" class="button">
    </form>

이 클래스들은 꽤 헐겁다. 그리고 우리에게 별 걸 말해 주지 않는다. 우리가 이걸로 문제를 해결할 
수는 있다고 해도, 아주 불명료하다. BEM 표시법으로 하면 이렇게 된다.

    <form class="site-search  site-search--full">
        <input type="text" class="site-search__field">
        <input type="Submit" value ="Search" class="site-search__button">
    </form>

우리는 `.site-search`라 부르는 블럭을 볼 수 있다. 그 안엔 `.site-search__field`라 부르는 요소가 들어 있다.
그리고 `.site-search--full`이라 부르는 `.site-search`의 변형반이 있다는 것도 알 수 있다.

또 다른 예시를 보자.

OOCSS에 익숙하다면, 분명 [미디어 객체(the media object)](http://stubbornella.org/content/2010/06/25/the-media-object-saves-hundreds-of-lines-of-code)에도
친숙할 것이다. BEM 모양으로 한다면, 미디어 객체는 이렇게 될 것이다.

    .media {}
    .media__img {}
    .media__img--rev {}
    .media__body {}

CSS를 작성한 방식 덕분에 우리는 `.media__img`와 `.media__body`가 반드시 `.media` 안에 있어야만 한다는 것을 금방 알 수 있다.
그리고 `.media__img--rev`가 `.media__img`의 변형판이라는 것도 알 수 있다. 이 모든 정보는 우리의 CSS 선택자 이름만으로 
얻을 수 있는 것이다.

또 다른 이점은 다음과 같은 상황에서다. 미디어 객체를 다시 사용해 보자.

    <div class="media">
        <img src="logo.png" alt="Foo Corp logo" class="img-rev">
        <div class="body">
            <h3 class="alpha">Welcome to Foo Corp</h3>
            <p class="lede">Foo Corp is the best, seriously!</p>
        </div>
    </div>

이것을 보면, `.media`와 `.alpha`가 연관돼 있는지 그렇지 않은지 알 수 없다. `.body`와 `.lede` 혹은 `.img-rev`
와 `.media`는 뭔가? 이 HTML에서 (미디어 객체에 아주 친숙하지 않은 한) 우리는 무엇이 저 구성요소들을 
이루는 것이고 어떤 것이 없어도 되는 것인지 알 수가 없다.
BEM으로 다시 작성해 보자.

    <div class="media">
        <img src="logo.png" alt="Foo Corp logo" class="media__img--rev">
        <div class="media__body">
            <h3 class="alpha">Welcome to Foo Corp</h3>
            <p class="lede">Foo Corp is the best, seriously!</p>
        </div>
    </div>

이제 우리는 `.media`가 블럭이라는 사실을 즉시 알 수 있다. `.media__img--rev`는 
수식어가 붙은 `.media`의 요소라는 것을 알 수 있다. 그리고 `.media__body`는 수식어가 
붙지 않은 `.media`의 요소라는 것을 알 수 있다. 이것은 모두 클래스 이름으로 얻은 정보다.
**믿을 수 없을 만큼** 유용하다. 

## 못생겼다!(Uuuugly!)

BEM에 반대하는 흔한 논거는 이게 못생겼다는 것이다. 나는 감히 이렇게 말할 수 있다.
당신이 _순전히_ 코드의 모양만 가지고 회피한다면 당신은 자주 핵심을 놓치게 될 것이다.
코드가 쓸데없이 유지보수하기 힘들어진다면, 혹은 정말 더 읽기 힘들어진다면, 그렇다면 
아마 당신은 그것을 사용하기 전에 _분명_ 다시 생각할 필요가 있을 것이다. 그러나 '꽤
이상해 보이'지만 목적이 올바르다면, 그것은 분명 치워 버리기 보다는 깊이 생각해 볼 문제다.

나는 BEM이 이상해 보인다는 데 동의한다. 하지만 그 힘은 모양 때문에 생기는 부정적인 
것들에 비한다면 _훨씬_ 뛰어나다.

BEM은 좀 웃겨 보일 지도 모른다. 그리고 아마 좀더 타이핑해야 할 것이다. (대부분의 텍스트 
에디터들에는 자동완성 기능이 있다. 그리고 gzip은 파일 크기를 무시할 수 있게 해 줄 것이다.)
하지만 BEM은 **아주** 강력하다.

## BEM을 쓸 곳과 쓰지 않은 곳은?

나는 지금 내가 만드는 모든 곳에 BEM 표기법을 사용한다. 사용하면 할수록 유용성을 
더욱 느낀다. 나는 모두가 가급적 BEM 표기법을 사용하기를 강력히 추천한다. BEM은 
모든 것을 더 단단히 연결해 주고, 팀이나 심지어 나조차도 몇 달 후 코드를 보게 됐을 때, 
유지보수하기 쉽게 해 주기 때문이다.

BEM을 사용할 때, 그러나, 모든 곳에 사용할 필요는 없다는 것을 기억하는 것이 중요하다.
이런 예시를 보자.

    .caps { text-transform: uppercase; }

이 CSS는 어떤 BEM 분류에도 들어갈 수 없을 것이다. 이건 그냥 혼자 있는 클래스다.

BEM이 아닌 다른 예제를 보자.

    .site-logo {}

로고를 넣는 클래스다. BEM으로 바꾸면 이렇게 될 것이다.

    .header {}
    .header__logo {}

하지만 이렇게 하는 것은 불필요하다. BEM 기법은 언제 어떤 것이 연관된 분류로 따라와야 하는지를
아는 것이다. 단지 어떤 것이 우연히 블록 안에 있다고 해서 그게 실제로 BEM 요소가 되는 것은 아니다.
이 경우 사이트 로고는 `.header` 안에 순전히 우연히 들어있다. 로고는 사이드바나 푸터 같은 곳으로 
쉽게 옮겨갈 수 있다. 요소의 범위(scope)는 어떤 맥락에서든 시작할 수 있으므로 BEM은 필요한 곳에만
적용해야 한다. 또다른 예를 보자.

    <div class="content">
        <h1 class="content__headline">Lorem ipsum dolor...</h1>
    </div>

여기서 우리는 그냥 두 번째 클래스를 `.headline`이라고 부를 수도 있다. 
그것은 이것이 `.content` 안에 있기 **때문에** 특정한 모양이 된 것인지, 아니면 
그저 _우연히_ `.content` 안에 있는 것인지에 달려있다. 후자라면 BEM을 사용할 필요가 없다.

그렇긴 해도, 모든 것은 잠재적으로 BEM의 영역으로 옮겨갈 수 있다. `.site-logo` 예제를
다시 살펴 보자. 우리가 크리스마스에 맞춘 축제 버전 사이트를 준비한다고 생각해 보자. 
그러면 이렇게 할 수 있을 것이다.

    .site-logo {}
    .site-logo--xmas {}

우리는 `--` 수식어 표기법을 사용해 재빨리 변형판을 만들 수 있다.

BEM에서 가장 어려운 부분은 범위의 시작과 끝을 결정하는 것, 그리고 BEM을
사용해야하는지(혹은 말아야 하는지)를 결정하는 것이다. 이것은 '때가 되면 알게 
될 거야' 하는 경우라고 할 수 있겠다(It’s a case of ‘you’ll just know when you know’.).

## 결론

그래서, 이것이 BEM(혹은 그것은 약간 변형판)이다. 아주 유용하고, 강력하고, 간단한 
작명 규칙이다. 우리의 프론트엔드 코드를 읽기 쉽고, 이해하기 쉽고, 작업하기 쉽고, 
확장하기 쉽고, 더 건강하고 명확하고 엄격하게 만들어 준다.

모든 BEM은 약간 이상해 보이지만, 프론트엔드 개발자의 도구상자뿐 아니라 프로젝트에도
아주 큰 가치를 더할 것이다.
