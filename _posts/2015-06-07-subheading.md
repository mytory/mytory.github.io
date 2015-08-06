---
layout: post
title: "부제(subheading)를 표현하는 HTML 마크업"
categories:
- html-css-js
tag:
- html5
---

신문 웹사이트([&lt;노동자 연대&gt;](http://wspaper.org))를 관리하고 있으니, 글의 구조를 마크업할 때 고민해야 할 게 많다. 이번에 다룰 것은 부제를 HTML 태그로 어떻게 표현해야 할 것인가다.

결론적으로 나는 아래처럼 사용하기로 마음먹었다.

    <header>
        <p class="subheading">남중국해 분쟁</p>
        <h1>제국주의 간 경쟁이 동아시아를 더욱 불안정에 빠뜨리다</h1>
    </header>

명세를 확인하는 게 올바른 사용법을 아는 지름길이다. [클리어보스](http://www.clearboth.org/)에서 여러 번 들었던 말인데 최근 새삼 느꼈다.

자세한 내용은 [4.12.1 Subheadings, subtitles, alternative titles and taglines](http://www.w3.org/TR/html5/common-idioms.html#sub-head) 항목에서 찾아 볼 수 있다. HTML에는 부제를 표현하는 태그가 없으며, 아래와 같은 방법을 제안한다 하고 설명이 돼 있다. 명세가 제안하는 방법은 세 가지다. 


## 기호를 사용해서 구분하는 방법

    <h1>남중국해 분쟁 - 제국주의 간 경쟁이 동아시아를 더욱 불안정에 빠뜨리다</h1>

위처럼 `-`로 구분할 수 있다. `:`으로 구분해도 될 것이다. 그러나 이 방법은 앞의 것이 부제인지 뒤의 것이 부제인지 구분하기 힘들다는 단점이 있다. 위 경우 앞의 것이 부제다.


## 제목(heading) 태그 안에 `span` 등을 넣어 표시하는 방법

    <h1>
        <span class="subheading">남중국해 분쟁</span>
        제국주의 간 경쟁이 동아시아를 더욱 불안정에 빠뜨리다
    </h1>

2015년 6월 7일 현재 [\<노동자 연대\>](http://wspaper.org)가 취하고 있는 방법이다. 이건 명세 보고 한 건 아니고 그냥 내가 생각해 냈던 방법인데, 명세에도 이런 예시가 있었다. 이 방법의 단점은, CSS를 걷어냈을 때 부제와 제목을 구분할 수 없게 된다는 점이다. 그래서 중간에 보이지 않는 `-` 같은 것을 넣을까 고민하기도 했다. 아래처럼 말이다.

    <h1>
        <span class="subheading">남중국해 분쟁</span>
        <span class="hidden">-</span>
        제국주의 간 경쟁이 동아시아를 더욱 불안정에 빠뜨리다
    </h1>

위 예제는 W3 명세에는 없는 것이고, 내가 생각해 본 것이다. 그런데 여튼, `header` 안에 넣는 방법을 사용하면 이 문제가 해결되므로 사용해 볼 이유는 없어졌다.


## `header` 안에 `p`로 넣는 방법

    <header>
        <p class="subheading">남중국해 분쟁</p>
        <h1>제국주의 간 경쟁이 동아시아를 더욱 불안정에 빠뜨리다</h1>
    </header>

이렇게 하면 CSS를 걷어냈을 때도 부제와 제목이 구분된다. 아울러 `hgroup` 태그를 사용하지 않는다고 밝힌 명세에서는 `header`뿐 아니라 `div`로도 부제를 묶을 수 있다고 적었다(아래 `hgroup` 부분 참고). 물론 난 그냥 `header`를 사용할 생각이다.


## `hgroup` 태그는 명세에서 없어졌다

[`hgroup` 태그는 명세에서 더이상 사용하지 않는다(obsolete)](http://www.w3.org/TR/html5/obsolete.html#non-conforming-features)고 분류됐다. 아래는 번역이다. 그 밑에 원문을 붙였다.

### `hgroup`

부제를 마크업하기 위해 제목을 담고 있는 `h1`-`h6` 요소 뒤에 오는 `p` 요소에 부제를 넣는 것을 고려하라. 아니면, 부제를 제목을 담고 있는 `h1`-`h6` 요소 안에 바로 집어 넣어라. 단, 기호 등으로 제목과 구분해라. 예컨대, `span class="subheading"` 요소 같은 것에 스타일을 다르게 줘서 말이다.

제목, 부제, 대등 제목(alternative titles)[^1]이나 태그라인[^2]은 `header`나 `div` 요소로 묶을 수 있다.

<blockquote>
    <dl>
        <dt><dfn id="hgroup"><code>hgroup</code></dfn></dt>
        <dd><p>To mark up subheadings, consider putting the subheading into a <code><a href="http://www.w3.org/TR/html5/grouping-content.html#the-p-element">p</a></code> element after the <code><a href="http://www.w3.org/TR/html5/sections.html#the-h1,-h2,-h3,-h4,-h5,-and-h6-elements">h1</a></code>-<code><a href="http://www.w3.org/TR/html5/sections.html#the-h1,-h2,-h3,-h4,-h5,-and-h6-elements">h6</a></code> element containing the main heading, or putting the subheading directly within the <code><a href="http://www.w3.org/TR/html5/sections.html#the-h1,-h2,-h3,-h4,-h5,-and-h6-elements">h1</a></code>-<code><a href="http://www.w3.org/TR/html5/sections.html#the-h1,-h2,-h3,-h4,-h5,-and-h6-elements">h6</a></code> element containing the main heading, but separated from the main heading by punctuation and/or within, for example, a <code>span class="subheading"</code> element with differentiated styling.</p>
       <p>Headings and subheadings, alternative titles, or taglines can be grouped using the <code><a href="http://www.w3.org/TR/html5/sections.html#the-header-element">header</a></code> or <code><a href="http://www.w3.org/TR/html5/grouping-content.html#the-div-element">div</a></code> elements.</p></dd>
    </dl>
</blockquote>


[^1]: 본제목과는 다른 제목으로 해당 기록을 표현하는 또 다른 제목을 의미한다. 본제목과 다른 언어로 표현된 제목도 대등 제목에 해당한다. ([출처: \[네이버 지식백과\] 대등 제목 \[alternative title\] (기록학용어사전, 2008.3.10, 역사비평사)](http://terms.naver.com/entry.nhn?docId=440923&cid=50296&categoryId=50296))
[^2]: 아래와 같이 제목 밑에 붙는 슬로건 같은 것 - 안형우  
      ![태그라인 예제](https://dl.dropboxusercontent.com/u/15546257/blog/mytory/tagline-example.png)