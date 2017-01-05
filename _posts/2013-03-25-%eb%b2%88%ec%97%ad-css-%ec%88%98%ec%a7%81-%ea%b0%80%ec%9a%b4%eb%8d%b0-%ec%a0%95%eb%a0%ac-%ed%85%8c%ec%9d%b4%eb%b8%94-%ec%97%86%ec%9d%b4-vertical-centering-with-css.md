---
title: '[번역] CSS 수직 가운데 정렬 (테이블 없이!) Vertical Centering with CSS'
author: 안형우
layout: post
permalink: /archives/9727
daumview_id:
  - 42024562
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
뭔가 폼을 짤 일이 있었다. 수직 가운데 정렬을 해야 하는 상황이었다. CSS로 구현하긴 좀 까다로워서 그냥 js로 margin을 계산하게 해 버렸다. (참고로 [수직 가운데 정렬을 해 주는 jQuery 플러그인][1]도 있다. 보통은 이걸 사용하는 게 속편한 것 같다.) 뭐 별 상관 없지. 

하지만 궁금했다. CSS 기법은 없는지. 찾아 봤고, 찾았다. 원문은 CSS로 수직 가운데 정렬 하기(Vertical Centering with CSS)다.[^improvement][^original] 원문은 2009년 2월 말에 씌어졌고, 이 때는 아직 IE8 베타 버전만 나와있던 때다. IE8 정식 버전은 2009년 3월 19일에 출시됐다.

[^improvement]: 내가 번역한 글은 저자가 원문을 약간 개선한 것을 이메일로 보내준 것이다.
[^original]: 원문이 사라졌다! 원문의 원래 URL은 `http://blog.themeforest.net/tutorials/vertical-centering-with-css/`였다.

----

## 2017-01-05

이제는 세월이 흘러 IE8 지원도 하지 않는 곳이 많아졌다. IE6까지 지원하느라 고생했던 것을 생각하면 격세지감이다. 하지만 여전히 아래 기법들은 유효하다. (IE5~6을 지원하기 위한 코드 자체를 제외하면.)

`display: flex`를 대부분의 브라우저에서 사용할 수 있게 된 것도 희소식이다. 수직 가운데 정렬이 훨씬 편해졌다. 다만 IE9이 이걸 지원하지 않는다는 점이 문제다.

이 글은 2009년에 나온 글이라 플렉스박스에 대한 설명이 없다. `display: flex`를 이용한 기법을 간단하게 살펴 보고 싶다면 [Vertical Centering in CSS][14]를 참고하라.

----

CSS로 요소를 수직으로 가운데 오게 하는 방법은 몇 가지 방법이 있다. 하지만 적당한 걸 고르기는 힘들다. 나는 내가 본 것 중에 최고의 방법을 보여 주겠다. 수직 가운데로 잘 정렬된 간단한 웹사이트를 만드는 방법도 보여 주겠다.

CSS로 수직 가운데 정렬을 하는 것은 쉽지 않다. 서로 다른 방법들이 있고, 어떤 방법은 몇몇 브라우저에서는 작동하지 않는다. CSS를 다룰 때, 작동이 어떻게 되는지 아는 것은 중요하다. 그러니 요소를 수직 가운데 정렬하는 5가지 방법을 살펴 보자. 그리고 장단점을 살펴 보자. (각 방법을 간략하게 요약 설명한 [테스트 페이지][3]를 볼 수 있다.

![](/uploads/legacy/css-absolute-center/tutorial/demo-thumb.jpg)

[(테스트 페이지 보기)][3]

일러 두기: 나는 오스트레일리아인이다. 그래서 center라고 쓰지 않고 centre라고 쓴다. css에서는 cent**er**라고 써야 하니 헷갈리지 말기 바란다.

## 방법 1

![](/uploads/legacy/css-absolute-center/tutorial/images/method1.gif)

[(테스트 페이지 보기)][3]

이 방법은 테이블처럼 만들어서 테이블의 `vertical-align` 속성을 사용할 수 있도록 `<div>`를 몇 개 세팅한다. (테이블의 `vertical-align` 속성은 다른 요소들에서는 [굉장히 다르게][4] 작동한다.)

일러 두기: 아마 "테이블을 사용하려던 건 아닌데" 하고 생각할지 모르겠다. 테이블을 사용할 때 주된 문제는 마크업을 시멘틱하게 유지해야 한다는 것이다. 테이블 코드를 짜지만 그게 사실 진짜 표는 아닌 경우, 테이블로 코딩하지 말아야 한다. (실제 표인 경우엔 테이블을 사용해도 아무 문제 없다.) `<div>`를 테이블로 생각하게 만들어서 생기는 유일한 문제는 브라우저가 일관되게 작동하지 못하게 된다는 점이다. 이건 미친 짓은 아니다. `a`에 `display:block;`을 주거나 `<h2>`에 `display:inline;`을 주는 것과 비슷한 것뿐이다.

[역자 주 - 한 줄에 여러 요소를 넣어야 할 때는 `display: table` 대신 `display: inline-table`을 사용할 수도 있다.]

<pre>&lt;div id="wrapper"&gt;
  &lt;div id="cell"&gt;
    &lt;div&gt;
      Content goes here
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre>

<pre>#wrapper {
  display: table;
}
#cell {
  display: table-cell; 
  vertical-align: middle;
}</pre>

### 장점

* 높이가 변해도 상관없다. (CSS에 높이를 지정하지 않아도 된다.)
* wrapper에 공간이 없어도 내용이 잘리지 않는다.

### 단점

* 인터넷 익스플로러에서 작동하지 않는다. (심지어 IE8 베타에서도.)
* 태그 단계가 깊어진다. (그렇게 나쁜 건 아니다. 이건 주관적인 부분이다.)

## 방법 2

![](/uploads/legacy/css-absolute-center/tutorial/images/method2.gif)

[(테스트 페이지 보기)][3]

이 방법은 `position` `absolute`를 사용한다. `top`을 50%로 설정하고 `margin-top`을 콘텐츠 높이 절반만큼 음수로 설정한다. 이것은 요소의 높이를 CSS에서 지정해야 한다는 걸 의미한다.

높이를 지정해 두기 때문에, 내용이 넘치면 `div` 밖으로 튀어나간다. 대신에 스크롤바가 생기도록 콘텐츠 `div`에 `overflow:auto;`를 주고 싶을 것이다.

<pre>&lt;div id="content"&gt;
  Content Here    
&lt;/div&gt;</pre>

<pre>#content {
  position: absolute; 
  top: 50%; 
  height: 240px; 
  margin-top: -120px; /* 높이의 절반을 음수 마진으로 */
}</pre>

### 장점

* 모든 브라우저에서 작동한다.
* 태그가 깊이 들어가지 않는다.

### 단점

* 충분한 공간이 없으면 내용이 잘린다. (div가 body 밑에 있고, 사용자가 브라우저 창을 줄이면, 스크롤바가 나타나지 않는다.)

## 방법 3

![](/uploads/legacy/css-absolute-center/tutorial/images/method3.gif)

[(테스트 페이지 보기)][3]

이 방법은 내용 요소 위에 `div`를 두는 방법이다. 이 `div`는 `height: 50%;`, `margin-bottom: -content높이의절반;` 이렇게 설정한다. content엔 `clear` 속성을 줘서 `float`된 `div` 밑으로 오게 하면 content가 가운데 오게 된다.

<pre>&lt;div id="floater"&gt;&lt;/div&gt;
&lt;div id="content"&gt;
  Content Here    
&lt;/div&gt;</pre>

<pre>#floater {
  float: left; 
  height: 50%; 
  margin-bottom: -120px;
}
#content  {
  clear: both; 
  height: 240px; 
  position: relative;
}</pre>

### 장점

* 모든 브라우저에서 작동한다.
* 충분한 공간이 없을 때 (예컨대 윈도우 사이즈를 줄일 때) 콘텐츠가 잘리고 스크롤바가 나타난다.

### 단점

* 내가 생각할 수 있는 유일한 단점은, 빈 요소가 사용된다는 점이다. (그렇게 나쁜 건 아니다. 이것 역시 주관적인 부분이다.)

## 방법 4

![](/uploads/legacy/css-absolute-center/tutorial/images/method4.gif)

[(테스트 페이지 보기)][3]

이 방법은 높이와 너비를 지정하고 `position: absolute;`를 매긴 `div`를 사용한다. `div`는 그러면 `top: 0;`부터 `bottom: 0;`까지 뻗는다. 근데 사실 높이를 지정해 뒀기 때문에 그게 가능하진 않다. 그래서 `margin: auto;` 라고 주면 요소가 가운데로 가게 된다. 이건 우리가 흔히 블럭 요소에 `margin: 0 auto;` 를 적용해서 사용하는 수평 가운데 정렬과 아주 비슷하다.

<pre>&lt;div id="content"&gt;
  Content Here    
&lt;/div&gt;</pre>

<pre>#content {
  position: absolute; 
  top: 0; 
  bottom: 0; 
  left: 0; 
  right: 0;
  margin: auto; 
  height: 240px; 
  width: 70%;
}</pre>

### 장점

* 쉽다

### 단점

* 인터넷 익스플로러에서 작동하지 않는다. (심지어 IE8 베타에서도.)
* 컨테이너에 공간이 없으면 내용이 스크롤바 없이 잘린다.

## 방법 5

![](/uploads/legacy/css-absolute-center/tutorial/images/method5.gif)

[(테스트 페이지 보기)][3]

이 방법은 오직 한 줄짜리 텍스트만 수직 가운데 정렬을 해 준다. 간단히,  `line-height`를 요소의 높이로 설장한다. 그러면 텍스트가 가운데로 간다.

<pre>&lt;div id="content"&gt;
  Content
&lt;/div&gt;</pre>

<pre>#content {
  height:100px; 
  line-height: 100px;
}</pre>

### 장점

* 모든 브라우저에서 작동한다.
* 공간이 없어도 잘리지 않는다.

### 단점

* 오직 텍스트에서만 작동한다. (블럭 요소에선 작동하지 않는다.)
* 한 줄 이상이 되면 (즉, 두 줄이 되면), 보기 싫게 깨진다.

이 방법은 버튼이나 한 줄짜리 텍스트 필드를 수직 가운데 정렬해야 하는 경우처럼 작은 요소들에 사용하기 유용하다.

## 어떤 방법을 사용할까?

내가 좋아하는 방법은 3번째 방법 — `float`시킨 요소와 `clear`를 적용한 콘텐츠를 사용하는 방법이다. 이 방법엔 치명적인 결점이 하나도 없다. 콘텐츠가 `clear: both;`돼 있으니, 우리는 다른 요소를 그 위에 얹을 수도 있다. 그리고 윈도우가 접혀도 콘텐츠가 그 위를 덮지 않는다. [데모][5]를 봐라.

<pre>&lt;div id="top"&gt;
  &lt;h1&gt;Title&lt;/h1&gt;
&lt;/div&gt;
&lt;div id="floater"&gt;&lt;/div&gt;
&lt;div id="content"&gt;
  Content Here    
&lt;/div&gt;</pre>

<pre>#floater {
  float: left; 
  height: 50%; 
  margin-bottom: -120px;
}
#top {
  float: right; 
  width: 100%; 
  text-align: center;
}
#content {
  clear: both; 
  height: 240px; 
  position: relative;
}</pre>

이제 어떻게 작동하는지 감이 잡힐 거다. 간단하지만 흥미로운 웹사이트를 만들어 보자! 최종 결과물은 아래처럼 보일 거다.

![](/uploads/legacy/css-absolute-center/tutorial/step4-thumb.jpg)[6]

## 스텝 1

시멘틱한 마크업으로 시작하는 건 늘 좋은 일이다. 이것은 우리가 만들 페이지의 구조를 보여 준다.

* `#floater` (콘텐츠를 수직 가운데로 밀어내기 위한 요소)
* `#centered` (수직 가운데 정렬할 박스) 
    * `#side` 
        * `#logo`
        * `#nav` (순서 없는 목록 `<ul>`)
    * `#content`
* `#bottom` (저작권 등)

이건 내가 사용할 xhtml 코드다.

<pre>&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
  &lt;meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /&gt;
  &lt;title&gt;A Centred Company&lt;/title&gt;
  &lt;link rel="stylesheet" href="styles.css" type="text/css" media="all" /&gt;
&lt;/head&gt;

&lt;body&gt;
  &lt;div id="floater"&gt;&lt;/div&gt;
  &lt;div id="centered"&gt;

    &lt;div id="side"&gt;
      &lt;div id="logo"&gt;&lt;strong&gt;&lt;span&gt;A&lt;/span&gt; Company&lt;/strong&gt;&lt;/div&gt;
      &lt;ul id="nav"&gt;
        &lt;li&gt;&lt;a href="#"&gt;Home&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#"&gt;Products&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#"&gt;Blog&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#"&gt;Contact&lt;/a&gt;&lt;/li&gt;
        &lt;li&gt;&lt;a href="#"&gt;About&lt;/a&gt;&lt;/li&gt;
      &lt;/ul&gt;
    &lt;/div&gt;

    &lt;div id="content"&gt;

      &lt;h1&gt;Page Title&lt;/h1&gt;

      &lt;p&gt;
      Holisticly re-engineer value-added outsourcing after process-centric collaboration and idea-sharing. 
      Energistically simplify impactful niche markets via enabled imperatives. 
      Holisticly predominate premium innovation after compelling scenarios. 
      Seamlessly recaptiualize high standards in human capital with leading-edge manufactured products. 
      Distinctively syndicate standards compliant schemas before robust vortals. 
      Uniquely recaptiualize leveraged web-readiness vis-a-vis out-of-the-box information. 
      &lt;/p&gt;

      &lt;h2&gt;Heading 2&lt;/h2&gt;

      &lt;p&gt;
      Efficiently embrace customized web-readiness rather than customer directed processes. 
      Assertively grow cross-platform imperatives vis-a-vis proactive technologies. 
      Conveniently empower multidisciplinary meta-services without enterprise-wide interfaces. 
      Conveniently streamline competitive strategic theme areas with focused e-markets. 
      Phosfluorescently syndicate world-class communities vis-a-vis value-added markets. 
      Appropriately reinvent holistic services before robust e-services. 
      &lt;/p&gt;

    &lt;/div&gt;

  &lt;/div&gt;

  &lt;div id="bottom"&gt;
    &lt;p&gt;
      Copyright notice goes here
    &lt;/p&gt;
  &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>

## 스텝 2

페이지 레이아웃을 잡기 위해 기본적인 CSS를 잡는다. 이걸 `styles.css`에 넣는다. 스타일은 html 맨 위쪽에 연결해 뒀다.

<pre>html, body {
    margin: 0;
    padding: 0;
    height: 100%;
}

body {
    background: url('page_bg.jpg') 50% 50% no-repeat #FC3;
    font-family: Georgia, Times, serifs;
}

#floater {
    position: relative;
    float: left;
    height: 50%;
    margin-bottom: -200px;
    width: 1px;
}

#centered {
    position: relative;
    clear: left;
    height: 400px;
    width: 80%;
    max-width: 800px;
    min-width: 400px;
    margin: 0 auto;
    background: #fff;
    border: 4px solid #666;
}

#bottom {
    position: absolute;
    bottom: 0;
    right: 0;
}

#nav {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 70%;
    padding: 20px;
    margin: 10px;
}

#content {
    position: absolute;
    left: 30%;
    right: 0;
    top: 0;
    bottom: 0;
    overflow: auto;
    height: 340px;
    padding: 20px;
    margin: 10px;
}</pre>

콘텐츠를 수직으로 가운데 정렬하도록 만들기 위해서는 `body`와 `html`의 높이가 100%여야 한다. 높이는 `padding`과 `margin` 안쪽에 들어가는 것이니, `padding`과 `margin`은 0으로 해야 한다. 안 그러면 작은 `margin`을 보여 주려고 스크롤바가 나타난다.

`float`시킨 요소의 `margin-bottom`은 콘텐츠 높이(`400px`)의 절반인 `-200px`이다.

아래처럼 보여야 한다.

![](/uploads/legacy/css-absolute-center/tutorial/step2-thumb.jpg)

`#centered`의 너비는 80%다. 이렇게 하면 작은 스크린에서는 웹사이트가 작게 표현되고, 큰 스크린에서는 웹사이트가 크게 표현된다. (내 스크린은 약간 큰데, 낡은 웹사이트들 상당수가 좌측 상단 코너에 조그맣게 표현된다. 좀 짜증난다.) 이것은 유동 레이아웃으로 알려진 것이다. `min-width`와 `max-width`가 너무 커지거나 너무 작아지는 것을 막아 준다. Internet Explorer는 min&max width를 지원하지 않는다. 그렇긴 하지만 전용 `expression` 값을 이용해서 나중에 수정할 것이다. 당연히, 이렇게 하는 대신에 고정폭을 선택할 수도 있다.

`#centered`가 `position: relative`기 때문에, 우리는 그 안에 요소를 배치할 때 absolute position 요소를 사용할 수 있다. `overflow: auto;` 가 `#content`에 적용됐기 때문에, 내용이 넘치면 스크롤바가 나타날 것이다. Internet Explorer는 `overflow: auto;`를 좋아하지 않는다. 우리가 높이를 말해 주기 전까지는 말이다. (단지 `top`과 `bottom` 위치를 지정하는 것으론 안 된다. 그리고 높이를 %로 지정해도 안 된다.)[^percent] 그래서 그렇게 했다.

[^percent]: not just top and bottom position, and not in %

## 스텝 3

마지막으로 할 것은 스타일을 추가해서 좀더 예쁘게 만드는 거다. 메뉴를 다듬어 보자.

<pre>#nav ul {
    list-style: none;
    padding: 0;
    margin: 20px 0 0 0;
    text-indent: 0;
}

#nav li {
    padding: 0;
    margin: 3px;
}

#nav li a {
    display: block;
    background-color: #e8e8e8;
    padding: 7px;
    margin: 0;
    text-decoration: none;
    color: #000;
    border-bottom: 1px solid #bbb;
    text-align: right;
}

#nav li a::after {
    content: '\00BB';
    color: #aaa;
    font-weight: bold;
    display: inline;
    float: right;
    margin: 0 2px 0 5px;
}

#nav li a:hover, #nav li a:focus {
    background: #f8f8f8;
    border-bottom-color: #777;
}

#nav li a:hover::after {
    margin: 0 0 0 7px;
    color: #f93;
}

#nav li a:active {
    padding: 8px 7px 6px 7px;
}</pre>

목록(`li` 요소)을 메뉴처럼 보이게 만들 때 맨 처음 할 일은 `list-style: none`으로 목록 앞에 찍혀 있는 점을 지우고, 모든 `margin`과 `padding`을 없애는 것이다. 만약 `margin`과 `padding`을 지정하고 싶다면 특정한 값을 정해 줘라. 브라우저가 기본으로 지정하는 값은 브라우저별로 다르니까 말이다.

다음으로 위 코드에서 살펴 봐야 할 것은 링크를 블럭 요소처럼 보이게 만든 부분이다. 이렇게 하면 링크가 영역을 꽉 채우게 되고 제어하기 한결 수월해 진다. 메뉴를 수평으로 만들고 싶다면 목록을 `float`시키면 된다. (이 예제의 설계에서는 작동하지 않는다.)

[역자 주 - 나는 수평 목록을 만들 때 `float`보단 `inline-block` 같은 것을 선호한다.]

메뉴에서 또 재밌는 부분은,  `:before`와 `:after` CSS 가상 요소다. 이것은 요소의 앞뒤로 콘텐츠를 넣게 한다. 이걸 이용하면 작은 아이콘이나 문자 ─ 예컨대 화살표 같은 같은 걸 각 링크의 뒷부분에 쉽게 넣을 수 있다. 하지만 Internet Explorer 8 이전 버전에선 작동하지 않는다.

![](/uploads/legacy/css-absolute-center/tutorial/step3-thumb.jpg)

## 스텝 4

마지막으로 할 일은 CSS를 좀더 넣어서 페이지를 다듬는 거다.

<pre>#centered {
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
}

h1, h2, h3, h4, h5, h6 {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: normal;
    color: #666;
}

h1 {
    color: #f93;
    border-bottom: 1px solid #ddd;
    letter-spacing: -0.05em;
    font-weight: bold;
    margin-top: 0;
    padding-top: 0;
}

#bottom {
    padding: 10px;
    font-size: 0.7em;
    color: #f03;
}

#logo {
    font-size: 2em;
    text-align: center;
    color: #999;
}

#logo strong {
    font-weight: normal;
}

#logo span {
    display: block;
    font-size: 4em;
    line-height: 0.7em;
    color: #666;
}

p, h2, h3 {
    line-height: 1.6em;
}

a {
    color: #f03;
}</pre>

봐야 할 부분은,  `#centered`의 둥근 모서리다. CSS3에서, 모서리를 둥글게 만들려면 `border-radius` 프로퍼티를 사용해야 한다. [2009년 2월까지] 아직 어떤 주요 브라우저도 이걸 그대로 구현하지 않았고,  `-moz`나 `-webkit` prefix를 붙여서 사용해야 한다. (Mozilla Firefox와 Safari/Webkit용)

[역자 주 - 지금은 당연히 대부분의 브라우저가 `border-radius`를 제대로 [지원한다.](http://caniuse.com/#search=border-radius)]

![](/uploads/legacy/css-absolute-center/tutorial/step4-thumb.jpg)

## 스텝 5 — IE를 위한 수정

알고 있겠지만, Internet Explorer는 문제를 일으키는 유일한 주요 브라우저다.

* `#floater`에 반드시 너비를 지정해야 한다. 그렇지 않으면 [2009년 2월 기준으로 IE8 베타까지] IE 모든 버전에서 깨진다. (예제엔 이미 반영돼 있다.)
* IE5는 수평 가운데 정렬을 할 수 있다. (`margin: 0 auto;`를 좋아하지 않는다.)
* IE6 이하는 메뉴 주변에 너무 많은 공간이 생겨서 모양이 깨진다.
* IE6 이하는 `min-width`와 `max-width`를 지원하지 않는다.

이 문제들을 수정하기 위해 각 버전의 IE용 추가 스타일시트를 제공할 것이다. IE 전용 조건식 주석을 이용해서 말이다. 이 주석은 정식 HTML 주석처럼 보인다. (그래서 다른 브라우저들은 이걸 완전히 무시한다.) 하지만 IE는 내용을 읽고 무시하거나 받아들이거나 할 것이다.

<pre>&lt;!--[if lte IE 6 ]&gt;
  &lt;link rel="stylesheet" href="styles_ie6.css" type="text/css" media="all" /&gt;
&lt;![endif]--&gt;</pre>

조건식 시작부분에 `[ ]`를 넣었다. `lte`는 "less than or equal to"(≤, 작거나 같음)을 의미한다. 이것뿐 아니라 `gte` (≥), `lt` (<), `gt` (>)을 사용할 수 있고 특정 버전을 명시할 수도 있다. (예컨대, `[if IE 6]`) 문법에 대해 더 알고 싶다면 [Sitepoint의 자료][7]를 참고하라.

그래서, 우리 문제를 해결하려면 새 stylesheet를 두 개 만들어야 한다. “`styles_ie5.css`”와 “`styles_ie6.css`”. 원래 stylesheet의 바로 뒤에 아래 코드를 추가해서 새 stylesheet 2개를 연결한다.

<pre>&lt;!--[if IE 5 ]&gt;
  &lt;link rel="stylesheet" href="styles_ie5.css" type="text/css" media="all" /&gt;
&lt;![endif]--&gt;

&lt;!--[if lte IE 6 ]&gt;
  &lt;link rel="stylesheet" href="styles_ie6.css" type="text/css" media="all" /&gt;
&lt;![endif]--&gt;</pre>

[역주 - IE8 미만에 대해서는 더이상 알 필요가 없다. 원문에 있으니 번역은 했다. 참고만 해라.]

### Internet Explorer 5

첫 번째 스타일시트는 오직 IE 5의 수평 위치를 바로잡기 위한 것이다. 이것은 문서화가 잘 돼 있는 버그고, 블럭 요소가  `text-align` 프로퍼티를 따르는 문제다. 우리는 `body`에 `align` `center`를 주고, `#centered` `div`에 다시 `align` `left`를 준다. 이렇게 하면 텍스트가 가운데 정렬되는 것을 막을 수 있다.

<pre>/* styles_ie5.css */
body {
    text-align: center;
}

#centered {
    text-align: left;
}</pre>

### Internet Explorer 6, `hasLayout` & `expression()`

IE6 스타일시트는 IE5의 문제까지 함께 해결한다. 그래서 조건식 주석의 조건도 `lte`로 사용했고, 그러면 이전 버전의 IE도 이 파일을 해석한다.

메뉴 주변에 추가 공간이 생기는 문제를 고치는 것은 좀 복잡하다. IE의 내부적으로 쓰이는 `hasLayout` 프로퍼티로 작업해야 한다. Internet Explorer에서 오직 (`html`,`body`, `table`, `fieldset` 같은) 몇몇 아이템만 "레이아웃을 가진다(have layout)". 그리고 자식들의 레이아웃을 이 아이템들이 제어한다. 레이아웃이 없는 모든 요소들은 페이지의 모양을 제대로 컨트롤하지 못한다. 비록 완전히 무시당하지는 않지만 말이다. IE 렌더링 문제의 대부분은 요소에 "레이아웃"을 부여함으로써 해결할 수 있다. "레이아웃"을 부여하는 가장 간단한 방법은 IE 전용 CSS 프로퍼티인 `zoom`을 해당 요소에 적용하는 것이다. IE용 스타일시트에서 그렇게 하면 된다.[^zoom]
[^zoom]: To fix the problem of extra space around the menu is a bit more complicated. It has to do with IE’s internal `hasLayout` property. In Internet Explorer only some items “have layout” (such as `html`,`body`, `table`, `fieldset`), and these are the ones that control the layout of their children. All the elements that don’t have layout have less control over the display of the page, although they aren’t totally ignored. Many of IE’s rendering problems can be fixed by giving elements “layout”. The simplest way to do this is to add the proprietary CSS property `zoom` to elements in an IE specific stylesheet.

“hasLayout”이라는 주제 전체는 설명하기도, 이해하기도 아주 어렵다. 더 자세한 설명은 역시 [Sitepoint의 자료][8]를 보면 된다.

<pre>/* styles_ie6.css */
#nav {
    zoom: 1;
}

#nav li {
    zoom: 1;
}

#nav a {
    zoom: 1;
}

#centered {
    width: expression( (document.body.clientWidth &gt; 1000) ? "800px" : "80%");
}</pre>

[역자 주 - CSS안에서 `expression()` 함수를 사용하는 IE 전용 기법은 개발자를 혼돈에 빠뜨린다. 절대 사용하지 말 것. 그냥 js를 써라.]

`expression()` 함수는 CSS 안에서 javascript 선언을 사용할 수 있도록 해 준다. 요소에 동적인 값을 설정하기 위해 쓴다. (Internet Explorer 전용이다.) 선언은 자주 재적용되므로 너무 많이 사용하면 성능이 떨어진다. 위 선언은 이런 뜻이다. "만약 윈도우 너비가 1000px보다 크면 #centered의 너비를 800px로 하고, 그렇지 않으면 80%로 하라."

이 선언은 [3항 연산자(ternary operator)][9]를 사용한다. ("if" 선언 같은 거다.) 구조는 이렇다: **조건 ? 값이 참인 경우 : 값이 거짓인 경우**

이것은 아래 코드와 똑같다.

<pre>if (document.body.clientWidth &gt; 1000) {
  "800px";
} else {
  "80%";
}</pre>

## 더 생각해 볼 것

수직 가운데 정렬한 웹사이트 관련해서 할 만한 재밌는 것들이 많이 있다. 나는 이 아이디어를 SWFObject Generator 2.0[^link-break]을 재디자인할 때 사용했다. ([SWFObject 2.0][11]을 사용하기 위한 코드를 생성하기 위해서.) 여기엔 [또 다른 아이디어][12]가 있다.

[^link-break]: 원래 `http://douglasheriot.com/swfobjectgenerator/`로 링크가 걸려 있었는데, 페이지가 사라졌다.

## 정리

그래서, 결국 우리가 배운 것은 다음과 같다.

* CSS 테크닉: 
    * 콘텐츠를 수직 가운데 정렬하기 위한 몇 가지 방법과 각 방법의 장단점.
    * Firefox/Webkit에서 쉽게 둥근 모서리 구현하기.
    * 목록에 기반한 수직 내비게이션 메뉴. `:after` (or `:before`)로 글자를 붙이기.
* IE 
    * 추가 스타일시트를 불러 오기 위한 IE 조건식
    * IE 전용 `hasLayout` 프로퍼티
    * IE 전용 `expression()` 값, 그리고 그걸 이용해서 IE 6에서 min과 max width를 설정하기

## 참고자료

이 모든 걸 나 혼자 알아낸 게 아니다. 나는 이 테크닉 중 몇몇을 설명한 글들을 읽었고, 아래는 그 목록이다. (흥미가 생겼다면 읽어 보길 권한다.)

* [Understanding vertical-align, or "How (Not) To Vertically Center Content"(vertical-align 이해하기, 혹은 "수직 가운데 정렬 (안) 하는 방법")][4]
* [Vertical centering using CSS(CSS를 이용해서 수직 가운데 정렬하기)][13]
* [Vertical Centering in CSS(CSS에서 수직 가운데 정렬하기)][14]


 [1]: https://github.com/PaulSpr/jQuery-Flex-Vertical-Center
 [3]: /uploads/legacy/css-absolute-center/demo/demo4.html
 [4]: http://phrogz.net/CSS/vertical-align/index.html
 [5]: /uploads/legacy/css-absolute-center/demo/demo5.html
 [6]: /uploads/legacy/css-absolute-center/demo/demo.html
 [7]: https://www.sitepoint.com/web-foundations/internet-explorer-conditional-comments/
 [8]: https://www.sitepoint.com/web-foundations/internet-explorer-haslayout-property/
 [9]: http://en.wikipedia.org/wiki/Conditional_operator
 [11]: https://github.com/swfobject/swfobject
 [12]: /uploads/legacy/css-absolute-center/demo/demo1.html
 [13]: http://www.student.oulu.fi/~laurirai/www/css/middle/
 [14]: https://www.jakpsatweb.cz/css/css-vertical-center-solution.html