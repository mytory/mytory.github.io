---
title: '[번역] 객체 지향 CSS(OOCSS) 소개'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/8949
daumview_id:
  - 38211835
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - OOCSS
---
스매싱 매거진의 <a title="Read 'An Introduction To Object Oriented CSS (OOCSS)'" href="http://coding.smashingmagazine.com/2011/12/12/an-introduction-to-object-oriented-css-oocss/" rel="bookmark">An Introduction To Object Oriented CSS (OOCSS)</a>를 번역한 글이다. [루이스 라자리스][1]가 썼다.

나는 평소에 재사용성이 높은 CSS가 개발 속도를 높여 줄 것이라고 생각해 왔다. 그리고 그렇게 하려면 컨테이너에 독립적인 스타일을 사용하는 편이 낫지 않을까 하는 생각을 하고 있었다. 그런데 웬걸! 아예 객체 지향 CSS라는 개발 방법론이 있었다! 와우! 신나서 다 읽고 번역했다. 도움이 되길 바란다.

--------

**&#8220;콘텐츠가 생명이다&#8221; 하는 이야기를 들어 봤는지? 웹 개발자로서 우리는 콘텐츠 생산에 관련된 일을 자주 하게 된다. 콘텐츠가 생명이라는 말은 확실히 남용돼 왔지만, 사이트 방문자에게는 진실이다.**

그러나, 웹 개발자 관점에서는, 논쟁의 여지는 있지만 [속도가 생명][2]이다. 나는 점점 더 이 입장을 지지하게 됐다. 최근 몇 년간 경험있는 프론트엔드 엔지니어 다수가 속도 향상으로 사용자 경험을 개선할 수 있다는 [입장을 받아들였다.][3]

불행히도, 속도 개선 영역에서 CSS는 간과돼 왔다. 많은 개발자들은 (좋은 이유에서) 자바스크립트 속도와 [다른 영역들][4]에 주로 초점을 맞춰 왔다.

이 글에서, 나는 자주 간과되는 영역을 다룰 것이다. **객체 지향 CSS(Object Oriented CSS, OOCSS)** 개념을 소개하고, 이것이 웹 페이지의 속도와 유지보수 용이성을 둘 다 개선하는 방법이라는 점을 알려 주겠다.

## OOCSS의 원칙

다른 객체 기반 코딩 방법론처럼, OOCSS의 목적도 코드 재사용성을 높이고, 궁극적으로는, 더 빠르고 효율적이며 뭔가 추가하기 쉽고 유지보수하기 용이한 스타일시트를 만드는 것이다.

<p style="text-align: center;">
  <img class="aligncenter" alt="OOCSS" src="/uploads/legacy/intruduce-oocss/oocss-splash1.jpg" width="500" height="375" />
</p>

[OOCSS GitHub의 위키 페이지][5]에서 설명하듯, OOCSS는 두 가지 원칙에 기초해 있다.

### 표현에서 구조를 분리하기

스타일을 입힌 웹페이지의 거의 모든 요소들은 맥락에 따라 모양이 다르다. (표현) 웹사이트의 컨셉을 생각해 보자. 색깔, 그라디언트의 섬세한 사용, 또는 보이는 선들. 반면, 다른 보이지 않는 요소들은 비슷하게 반복된다. (구조)

이 다른 요소들을 클래스 기반 모듈로 추상화하면, **재사용이 가능해지고** 어떤 요소에도 적용할 수 있으며, 기본적으로 일관된 모양을 기대할 수 있게 된다. 코드를 다듬기 전과 다듬은 후를 비교해 보자. 내가 무슨 이야기를 하는지 알 수 있을 것이다.

OOCSS 원칙을 적용하기 전엔 이런 CSS를 작성했 것이다.

<pre class="brush: css">#button {
	width: 200px;
	height: 50px;
	padding: 10px;
	border: solid 1px #ccc;
	background: linear-gradient(#ccc, #222);
	box-shadow: rgba(0, 0, 0, .5) 2px 2px 5px;
}

#box {
	width: 400px;
	overflow: hidden;
	border: solid 1px #ccc;
	background: linear-gradient(#ccc, #222);
	box-shadow: rgba(0, 0, 0, .5) 2px 2px 5px;
}

#widget {
	width: 500px;
	min-height: 200px;
	overflow: auto;
	border: solid 1px #ccc;
	background: linear-gradient(#ccc, #222);
	box-shadow: rgba(0, 0, 0, .5) 2px 2px 5px;
}</pre>

위의 세 요소엔 각각 독립적인 스타일이 있다. 그리고 스타일을 적용하기 위해 ID 선택자(selector)를 사용하고 있다. ID 선택자는 재사용할 수 없다. 공통 스타일(common styles)은 분위기를 내거나 디자인을 일관되게 유지하기 위해 존재한다. <a class="simple-footnote" title="The common styles might exist for branding purposes or consistency of design." id="return-note-8949-1" href="#note-8949-1"><sup>1</sup></a>

조금만 계획을 세우고 생각을 먼저 하면, 공통 스타일(common styles)을 추상화할 수 있다. 그렇게 하면 CSS는 아래처럼 될 것이다.

<pre class="brush: css">.button {
	width: 200px;
	height: 50px;
}

.box {
	width: 400px;
	overflow: hidden;
}

.widget {
	width: 500px;
	min-height: 200px;
	overflow: auto;
}

.skin {
	border: solid 1px #ccc;
	background: linear-gradient(#ccc, #222);
	box-shadow: rgba(0, 0, 0, .5) 2px 2px 5px;
}</pre>

이렇게 하면, 모든 요소들은 클래스를 두 개 이상 사용하게 된다. 하지만 공통 스타일과 재사용 가능한 &#8220;표현&#8221;용 스타일을 결합해 사용하면서 불필요한 반복은 없어진다. 우리는 단지 모든 요소들에 &#8220;표현&#8221; 클래스를 적용하면 된다. 그러면 처음 예제에서 만들었던 것과 동일한 결과물을 볼 수 있다. **코드가 줄었다는 점과 재사용의 가능성이 늘었다는 점**만 빼고 말이다.

### 컨테이너와 콘텐츠를 분리하기

OOCSS Github 위키 페이지가 설명하는 두 번째 원칙은, 컨테이너를 콘텐츠에서 분리하는 것이다. 다음 CSS를 보면 이게 왜 중요한지 알 수 있다.

<pre class="brush: css">#sidebar h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: .8em;
	line-height: 1;
	color: #777;
	text-shadow: rgba(0, 0, 0, .3) 3px 3px 6px;
}</pre>

이 스타일은 `#sidebar` 요소의 자식 요소인 3단계 제목(h3)에 적용할 것이다. 하지만 글자 크기와 그림자만 바꾸고 나머지는 완전히 같은 스타일로 푸터의 h3에 적용하고 싶다면?

그러면 이런 식으로 해야 할 거다.

<pre class="brush: css">#sidebar h3, #footer h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 2em;
	line-height: 1;
	color: #777;
	text-shadow: rgba(0, 0, 0, .3) 3px 3px 6px;
}

#footer h3 {
	font-size: 1.5em;
	text-shadow: rgba(0, 0, 0, .3) 2px 2px 4px;
}</pre>

아니면, 더 이런 식으로 더 나쁘게 할 수도 있다.

<pre class="brush: css">#sidebar h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 2em;
	line-height: 1;
	color: #777;
	text-shadow: rgba(0, 0, 0, .3) 3px 3px 6px;
}

/* other styles here.... */

#footer h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 1.5em;
	line-height: 1;
	color: #777;
	text-shadow: rgba(0, 0, 0, .3) 2px 2px 4px;
}</pre>

결국, 우리는 **불필요한 중복 스타일**을 만들고 있으며, 아마 그걸 알아차리지 못할 거다. (아니면 신경쓰지 않거나.) OOCSS에서는 여러가지 요소에서 공통된 부분을 찾아내고, 그걸 어디서나 재사용할 수 있도록 모듈화하거나, 객체로 만든다.

맨 위의 예제처럼 계층화한 선택자를 사용해 스타일을 선언하면, **재사용할 수 없게 된다.**  <a class="simple-footnote" title="역자 주 &#8211; #sidebar h3 같은 식으로 사용한 것" id="return-note-8949-2" href="#note-8949-2"><sup>2</sup></a> 특정 컨테이너에 종속돼기 때문이다. (이 경우엔 사이드바나 푸터에 종속됐다.)

OOCSS의 클래스 기반 모듈을 구축함으로써 스타일이 어떤 컨테이너에도 종속되지 않도록 할 수 있다. 이것은 구조적 맥락을 신경쓰지 않고, 클래스를 문서의 **어디에서나 재사용**할 수 있게 된다는 것을 뜻한다.

## 실제 사례

OOCSS 사용법을 좀더 설명하기 위해, [내 사이트를 최근에 다시 디자인][6]하면서 쓴 것과 비슷한 것을 보여 주도록 하겠다. 내 사이트에서 헤더 안의 요소를 코딩한 뒤, 헤더 안의 기본 구조용 스타일을 페이지의 다른 요소에서 재사용할 수 있다는 것을 깨달았다.

아래는 내 사이트의 헤더를 꾸밀 때 사용한 코드다.

<pre class="brush: css">.header-inside {
	width: 980px;
	height: 260px;
	padding: 20px;
	margin: 0 auto;
	position: relative;
	overflow: hidden;
}</pre>

`.header-inside` 요소에만 필요한 것은 아주 조금이고, 나머지는 재사용 가능한 모듈로 만들 수 있다. 그래서 나는 구조용 스타일을 재사용 가능한 클래스로 추상화했다. 그래서 나온 결과물이다.

<pre class="brush: css">.globalwidth {
	width: 980px;
	margin: 0 auto;
	position: relative;
	padding-left: 20px;
	padding-right: 20px;
	overflow: hidden;
}

.header-inside {
	padding-top: 20px;
	padding-bottom: 20px;
	height: 260px;
}</pre>

`.globalwidth` 클래스가 포함하는 것들 :

*   고정 너비
*   마진을 이용해 가운데로 위치시키기 : `auto`
*   절대 위치를 사용하는 자식 요소를 제어하기 위한 `position: relative`
*   좌우 20px 패딩
*   clearfix를 위한 `overflow: hidden` <a class="simple-footnote" title="clearfix란 float 요소를 컨테이너가 제대로 감싸게 하는 것을 말한다." id="return-note-8949-3" href="#note-8949-3"><sup>3</sup></a>

이렇게 하면 같은 특성이 필요한 경우 단지 원하는 요소에 클래스만 부여함으로써 같은 스타일을 적용할 수 있다. CSS를 한 줄도 추가하지 않고 말이다.

내 사이트에서, 나는 이 구조용 스타일들을 주요 콘텐츠 요소와 푸터 안 요소에 재사용했다. 디자인에 따라, 이 스타일은 아마 헤더와 콘텐츠 사이에 들어가는 수평 내비게이션 요소에 적용될 수도 있을 것이다. 혹은 페이지의 가운데 와야 하는 고정 너비 요소에 사용할 수도 있을 것이다.

&#8220;globalwidth&#8221; 스타일을 이 요소들에 추가한 뒤, HTML 마크업은 이렇게 변했다.

<pre class="brush: css">&lt;header&gt;
	&lt;div class="header-inside globalwidth"&gt;
	&lt;/div&gt;
&lt;/header&gt;

&lt;div class="main globalwidth"&gt;
&lt;/div&gt;

&lt;footer&gt;
	&lt;div class="footer-inside globalwidth"&gt;
	&lt;/div&gt;
&lt;/footer&gt;</pre>

어떤 사람들은 이런 식의 스타일 추상화가 HTML을 지저분하게 만들고 표현에서 마크업을 분리하는 원칙을 위배한다고 생각할 것이다.

하지만 마크업에 미치는 영향에 관한 논쟁을 무시하면, 이 추상화가 특정 스타일을 **추적하고** 위의 구조적 요소들에 **사용된 공통 스타일을 수정하기 더 쉽게 해 준다**는 데 아무도 의문을 제기할 수 없을 것이다.

## 미디어 객체(Media Object)

OOCSS 운동의 개척자 중 하나는 [니콜 설리반][7]이다. 니콜 설리반은[ 미디어 객체][8]라는 재사용 가능한 모듈을 만들었다. 니콜의 설명을 보면, 이 모듈을 사용해서 [코드 분량을 대폭 줄일 수 있다.][9]

<p style="text-align: center;">
  <img class="aligncenter" alt="OOCSS" src="/uploads/legacy/intruduce-oocss/media-object.jpg" width="500" height="375" />
</p>

미디어 객체는 OOCSS의 강력함을 보여 주는 훌륭한 예다. 콘텐츠 좌측에 사이즈에 상관없이 미디어 요소를 배치할 수 있도록 해 주기 때문이다. 안쪽 콘텐츠에 적용하는 많은 스타일이 ─ 그리고 미디어 요소 자신의 크기 조차도 ─ 변할 수 있지만, 미디어 객체 자체는 불필요한 중복을 피하도록 해 주는 공통 스타일에 기반한다.

## OOCSS의 이득

나는 이미 OOCSS의 몇 가지 장점에 대해 말했다. 좀더 확장을 해 보겠다.

### 더 빠른 웹사이트

OOCSS를 사용하면, 속도 측면에서 이득이 명확하다. 재사용을 많이 해서 스타일이 거의 없는 CSS라면, **파일 사이즈가 작을 것이고**, 그러면 다운로드 속도가 빨라질 것이다.

마크업이 좀 지저분해지고, 그래서 HTML 파일 사이즈가 좀 커지긴 할 것이다. 하지만 많은 경우에, 마크업 때문에 느려지는 것보다 스타일시트 때문에 빨라지는 게 더 클 것이다.

명심할 또다른 개념은 OOCSS 위키에 있는 **성능 팁**(performance freebies)이다. 이것은 재사용을 통해 CSS 한 줄 없이 새로운 요소에 스타일을 적용할 수 있다는 것을 보여 준다. 대규모 트래픽의 커다란 프로젝트에서 이 &#8220;팁&#8221;은 [성능을 통해 결정적인 이득][10]을 얻을 수 있게 해 준다. <a class="simple-footnote" title="these “freebies” could be a crucial performance gain." id="return-note-8949-4" href="#note-8949-4"><sup>4</sup></a>

#### 유지보수하기 쉬운 스타일시트

OOCSS를 사용하면, 계속 늘어나는 스타일시트 대신, 자연스럽게 제역할을 하면서도 **유지보수하기 쉬운 모듈 세트**가 생길 것이다. <a class="simple-footnote" title="내용과 상관없고 번역하기 힘든 부분 일부를 생략했다. With OOCSS, instead of a constantly growing stylesheet full of specificity wars, you’ll have an easy to maintain set of modules where the natural cascade plays an important role." id="return-note-8949-5" href="#note-8949-5"><sup>5</sup></a>

기존 사이트에 뭔가를 추가할 때, 보통 스타일시트 맨 밑에 스타일을 추가할 것이다. 앞에 뭐가 있는지 신경쓰면서 말이다. 이제 그러지 않아도 된다. 대신에 기존 스타일을 재사용하게 될 것이고, 기존 규칙 세트를 기반으로 스타일을 확장하게 될 것이다.

생각부터 먼저 함으로써, 아주 적은 CSS만으로 전체 페이지를 만들 수 있다. 기존 CSS 모듈 중 어떤 것이든 새로운 페이지에 사용할 수 있다. 그러면 새로 생기는 CSS는 최소화될 것이다. 어떤 경우엔 CSS를 한 줄도 작성하지 않고 완전히 스타일을 입힌 페이지를 만들 수 있을 것이다.

이 유지보수 용이성이라는 이득은 스타일시트의 건강함으로 확장된다. 스타일이 모듈화돼 있기 때문에, OOCSS에 기반한 페이지는 새로운 개발자도 쉽게 적응할 수 있다.

## 주목할 만한 가치가 있는 것

OOCSS는 커뮤니티에서 많은 토론을 유발했고, 몇몇 논란을 일으켰다. 여기서 몇몇 오해를 불식시켜 보겠다.

### 여전히 ID를 사용할 수 있다

OOCSS 규칙을 완전히 지키면서 작업하기로 했다면, 주로 CSS 클래스에 기반해 스타일을 입히게 될 것이고, ID를 사용해 스타일을 입히지는 않게 될 것이다.

이 때문에, 많은 이들이 OOCSS가 ID를 전혀 사용하지 않는다고 잘못 주장해 왔다. 하지만 이는 사실이 아니다.

ID를 피하라는 규칙은, 더 구체적으로 말하면, **ID를 선택자로 사용하지 말라**는 것이다. 따라서 **HTML에서 ****자바스크립트 이벤트(hook)와 책갈피(**fragment identifiers**) 용으로 ID를 사용하는 것**은 OOCSS 규칙에 완전히 부합하는 것이다.

물론, 이미 요소에 ID가 적용된 상황일 수 있다. 그 요소가 페이지에서 유일한 것일 수 있다. <a class="simple-footnote" title="역자 주 &#8211; ID는 유일한 놈에만 적용하는 것이니까." id="return-note-8949-6" href="#note-8949-6"><sup>6</sup></a> 클래스 대신 ID 선택자를 사용해서 몇 바이트를 절약할 수는 있을 것이다. 하지만 이 경우, 나중에 특정 문제에 부딪히지 않으려면 클래스를 사용하는 것이 더 안전하다.

#### 더 작은 프로젝트를 다루기

소규모 사이트와 앱에서 OOCSS가 과잉(overkill)인 경우가 분명히 있을 것이다. 그러니까 이 글이 어떤 환경에서도 OOCSS를 사용해야 한다고 주장하는 것으로 받아들이지 마라. 프로젝트에 따라 다양한 상황이 있을 수 있다.

그렇지만, 최소한, 모든 프로젝트에서 OOCSS 규칙으로 사고하는 것은 좋은 일이다. 한 번 그렇게 할 줄 알게 되면, 확실한 이득이 있는 더 큰 프로젝트에서 OOCSS로 작업하기가 더 쉬워질 것이다. 장담한다.

## 구현 가이드라인

OOCSS를 처음 시작하려면 시간이 조금 걸릴 거다. 나는 여전히 노력하고 있다. 그래서 이 영역에서 내가 모든 답을 갖고 있거나 모든 경험을 했다고 할 수는 없다.

그러나 OOCSS 모드로 들어가고 싶다면 도움이 될 만한 것들을 몇 가지 알려 주겠다.

*   계층적 선택자를 피하라. (예컨대, `.sidebar h3` 같은 것을 사용하지 말라.)
*   자바스크립트 이벤트를 거는 ID에 스타일을 입히지 말라.
*   스타일시트 클래스에 HTML 태그를 적지 말라. (예컨대 `div.header`, `h1.title`)
*   정말 드문 경우를 외에는 `!important`를 사용하지 말라.
*   [CSS Lint][11]를 이용해서 CSS를 검사하라. (옵션과 [오류 종류][12]를 익혀라.)
*   [CSS 그리드][13]를 사용하라.

나중에 이 규칙 중 일부가 깨질 수도 있다. 하지만 전체적으로 이 규칙들은 좋은 습관이고 스타일시트를 더 작고 유지보수하기 쉽게 만들어 줄 것이다.

## 니콜 설리반의 작업을 살펴 봐라

OOCSS를 계속 배우려면, 연관 맺을 가장 중요한 사람은 [니콜 설리반][7]이다.

니콜은 자기 블로그에 OOCSS에 대한 글을 정기적으로 올린다. 또한 슬라이드쇼를 활용한 발표를 많이 했다. 아래는 볼 만한 발표 자료다.

*   [Object Oriented CSS (객체 지향 CSS)][14] (Slideshow)
*   [High Performance Websites: Nicole Sullivan (고성능 웹사이트)][15] [(Video)](http://ydn.zenfs.com/blogs/videos/nicolesullivan.m4v)
*   [Our Best Practices Are Killing Us (베스트 프랙티스가 우리를 죽이고 있다)][16] (Slideshow)
*   [CSS Bloat (CSS 과잉)][17] (Slideshow)

## 결론

많은 사람들이 OOCSS를 꺼린다. 우리가 &#8220;베스트 프랙티스&#8221;라고 배워 온 것들을 위반하는 것처럼 보이기 때문이다. 하지만 **OOCSS의 장기적 이득**을 한 번 이해하고 나면, 많은 개발자들이 전향할 것이라고 확신한다.

전반적으로 나는 OOCSS가 CSS 개발의 밝은 미래일 것이라고 생각한다. 그리고 OOCSS는 모든 개발자들이 웹 페이지를 더 빠르고 효율적이며 유지보수하기 쉽게 만들기 위해 프로젝트에 ─ 적어도 몇몇 단계에서는 ─ 적용해야 하는 개념이다.

--------


<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>

  <ol>
    <li id="note-8949-1">
      The common styles might exist for branding purposes or consistency of design. <a href="#return-note-8949-1">&#8617;</a>
    </li>
    <li id="note-8949-2">
      역자 주 &#8211; <code>#sidebar h3</code> 같은 식으로 사용한 것 <a href="#return-note-8949-2">&#8617;</a>
    </li>
    <li id="note-8949-3">
      clearfix란 <code>float</code> 요소를 컨테이너가 제대로 감싸게 하는 것을 말한다. <a href="#return-note-8949-3">&#8617;</a>
    </li>
    <li id="note-8949-4">
      these “freebies” could be <a href="http://www.svennerberg.com/2008/12/page-load-times-vs-conversion-rates/">a crucial performance gain</a>. <a href="#return-note-8949-4">&#8617;</a>
    </li>
    <li id="note-8949-5">
      내용과 상관없고 번역하기 힘든 부분 일부를 생략했다. With OOCSS, instead of a constantly growing stylesheet full of specificity wars, you’ll have an <strong>easy to maintain set of modules</strong> where the natural cascade plays an important role. <a href="#return-note-8949-5">&#8617;</a>
    </li>
    <li id="note-8949-6">
      역자 주 &#8211; ID는 유일한 놈에만 적용하는 것이니까. <a href="#return-note-8949-6">&#8617;</a>
    </li>
    <li id="note-8949-7">
      원문 : <a href="http://ianstormtaylor.com/oocss-plus-sass-is-the-best-way-to-css">OOCSS + Sass = The best way to CSS</a> <a href="#return-note-8949-7">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://coding.smashingmagazine.com/author/louis-lazaris/?rel=author
 [2]: http://www.stevesouders.com/blog/2009/10/06/business-impact-of-high-performance/
 [3]: http://www.stevesouders.com/blog/
 [4]: http://developer.yahoo.com/performance/rules.html
 [5]: https://github.com/stubbornella/oocss/wiki
 [6]: http://www.impressivewebs.com/rolled-new-design/
 [7]: http://www.stubbornella.org/
 [8]: https://github.com/stubbornella/oocss/wiki/Content
 [9]: http://www.stubbornella.org/content/2010/06/25/the-media-object-saves-hundreds-of-lines-of-code/
 [10]: http://www.svennerberg.com/2008/12/page-load-times-vs-conversion-rates/
 [11]: http://csslint.net/
 [12]: https://github.com/stubbornella/csslint/wiki/Rules
 [13]: http://www.stubbornella.org/content/2011/01/22/grids-improve-site-performance/
 [14]: http://www.slideshare.net/stubbornella/object-oriented-css
 [15]: https://developer.yahoo.com/blogs/ydn/high-performance-websites-nicole-sullivan-6939.html
 [16]: http://www.slideshare.net/stubbornella/our-best-practices-are-killing-us
 [17]: http://www.slideshare.net/stubbornella/css-bloat
