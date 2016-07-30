---
title: '[Tip/소개] Emmet(예전 젠 코딩 Zen Coding) 사용법은 정말 쉽다!'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2521
aktt_notify_twitter:
  - yes
daumview_id:
  - 36600310
categories:
  - 기타
tags:
  - TIP
---
[Emmet(예전 젠 코딩)][1]. 뭘까? 모르는 사람들은 일단 [Emmet 문서 사이트][2]에 있는 온라인 데모부터 보면 된다. 심지어 직접 사용해 볼 수도 있는데, Watch Demo 우측 상단에 있는 Try it yourself를 누르면 된다. (이게 동영상이 아니다.) 근데 내가 추천하는 건, 바로 Try it youself하기보다는 Play demo 해서 차분히 본 다음에 Try it yourself 하는 거다.

<img class="aligncenter" alt="" src="/uploads/legacy/emmet-watch-demo.png" width="716" height="363" />

처음에 젠 코딩 시절에 Emmet이라는 걸 알았을 때, 대박이라고 생각하면서도, 한 편으로는 &#8220;그래도 쉽게 사용하긴 힘들 거야. 나중에 연습을 좀 한 다음 사용해 봐야겠다&#8221; 하고 생각을 했다.

최근에 HTML 코드를 많이 짜야 하는 일이 생겼다. 그래서 이 김에 Emmet 연습이나 좀 해 봐야겠다는 생각을 했다. 그리고 이클립스에 플러그인을 설치해 사용해 봤는데, 웬걸! 빨리 사용하지 않은 걸 오히려 후회하게 됐다. 정말 간단해서 별로 볼 것도 없었다.

물론 고급 기능을 사용하려면 몇 가지 볼 건 있지만, 고급 기능을 사용한다는 생각을 하지 말고 그냥 사용하기 시작해라. 이클립스에서 a라고 쓴 다음 그냥 탭을 누르면 a 태그가 뿌려지는데, 이 기능만 사용해도 충분히 편하기 때문이다.

## 엄청 다양한 에디터에 적용되고 있는 Emmet

플러그인을 깔기 위해서 [Emmet 공식 사이트][1]에 들어가 봤다. ([Emmet 트위터][3])

헐! 엄청나게 많은 에디터가 Emmet을 지원하고 있었다. 내가 사용하는 이클립스와 에디트 플러스도 역시나 Emmet을 지원하고 있었다.

[Emmet을 지원하는 에디터][4]는 굉장히 많았다. 내가 사용하는 이클립스와 에디트 플러스도 Emmet을 지원했다. (에디트 플러스는 젠 코딩 시절을 지원하는 거다. 그리고 난 지금 에디트 플러스보다 Sublime Text 2를 더 많이 사용한다.)

*   [Emmet 이클립스 플러그인 설치 방법][5]
*   에디트 플러스는 [최신 버전을 다운받으면 그 안에 젠 코딩이 구현][6]돼 있고 플러그인은 따로 없다.

구 젠 코딩 시절의 [구글 코드 사이트][7]에 가면 목록이 더 다양하게 있는 것 같다. 아마 Emmet의 최신 기능은 지원하지 않겠지만 말이다.

구 젠 코딩 시절, 젠 코딩을 공식 지원하고 있는 에디터는 2012-06-15 시점으로 아래와 같았다.

> 압타나, 젠드, 이클립스, 텍스트메이트, 코다, 에스프레소, 코모도 에디트/IDE, 노트패드++, PS패드, 에디트에이리어, 코드미러, 코드미러2

공식 지원은 아니지만 서드 파티를 통해 지원되는 에디터는 2012-06-15 시점으로 아래와 같았다. 따라서 Emmet의 모든 최신 기능을 지원한다고 보장할 수는 없다. 물론, 엔진 자체는 젠 코딩 시절의 공식 엔진을 사용한다.

> 드림위버, 서브라임 텍스트1,2, 울트라에디트, 탑스타일, G에디트, BB에디트, 텍스트랭귤러(맥), 비주얼 스튜디오, Em에디터, 사쿠라 에디터, 에디트플러스, 넷빈, 크롬확장, 그리스몽키, 지니, RJ 텍스트Ed, 아켈패드, WIODE 웹 베이스 IDE, 블루피시

Emmet의 공식 엔진을 사용하지 않고 자신들의 커스텀 엔진을 사용하는 확장은 아래와 같다. 몇몇 문법이 다를 수 있다.

> IntelliJ IDEA/WebStorm/PHPStorm, 이맥스, 빔, ReSharper plugin for Visual Studio

## Emmet 사용 팁

아래는 내 생각에, 알아 두면 좋은 것 같은 팁이다. Emmet 문법과 그 문법에 따라 구현되는 놈들을 차례로 적었다. 기초 문법은 좀 연습했다는 걸 가정하고 설명한다.

## 태그 이름을 적지 않으면 div다

그냥 .하고 클래스를 적으면 div가 생성된다.

<pre>.className
&lt;div class="className"&gt;&lt;/div&gt;</pre>

## +할 때 괄호를 사용할 수 있다

<pre>table&gt;(colgroup&gt;col*3)+(tbody&gt;tr*5&gt;td*3)
&lt;table&gt;
  &lt;colgroup&gt;
    &lt;col /&gt;
    &lt;col /&gt;
    &lt;col /&gt;
  &lt;/colgroup&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
      &lt;td&gt;&lt;/td&gt;
    &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</pre>

## 하나씩 적고 펼치는 게 편하다

그러나 위 예제처럼 문법을 복잡하게 적는 경우는 거의 없다. 하나씩 적고 펼치고 하는 경우가 훨씬 많고, 이게 핵심적으로 편하다. 예컨대 img 같은 거다.

<pre>img
&lt;img src="" alt="" /&gt;</pre>

이렇게 src와 alt를 모두 생성해 주기 때문에 굉장히 편해 진다.

a도 마찬가지다.

<pre>a
&lt;a href=""&gt;&lt;/a&gt;</pre>

## **에디트 포인트 이동**을 사용하면 좋다

Emmet 데모에서는 에디트 포인트 이동 단축키가 **Ctrl+Shift+좌우화살표** 였다. 이클립스 Emmet 플러그인에서는 **Ctrl+Alt+[** 과 **Ctrl+Alt+]** 이다. Emmet 문법을 HTML로 확장한 다음 HTML 태그들 사이에서 사용해 봐라. 편하다.

## $를 이용하면 숫자를 증가시킬 수 있다

<pre>ul&gt;li.item$*5
&lt;ul&gt;
  &lt;li class="item1"&gt;&lt;/li&gt;
  &lt;li class="item2"&gt;&lt;/li&gt;
  &lt;li class="item3"&gt;&lt;/li&gt;
  &lt;li class="item4"&gt;&lt;/li&gt;
  &lt;li class="item5"&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>

## CSS에서도 쓸 수 있다.

아래 치트시트를 보면 CSS에서 사용할 수 있는 것들의 목록이 나온다.

## Emmet 문서

*   [Emmet 문서][2] : 차분히 보고 간단한 것부터 쓰길 바란다.
*   [Emmet 치트시트][8] : 이걸 보면 다양한 단축 코드가 나오는데, 심지어 `html:4t`라고 쓰고 탭을 누르면 html 기본 틀이 펼쳐진다.

## 지금 당장 Emmet을 사용하자

복잡한 생각 하지 말고, 그냥 간단한 놈부터 사용한다는 생각을 갖고 Emmet을 시작하자. 복잡한 기능을 다 사용하지 않아도 Emmet은 코딩 시간을 단축해 준다. 학습에 드는 시간은 거의 없다. CSS 문법을 안다면 1분? 모른다면 2분? 뭐 그 정도다.

**모든 기능을 사용해야 한다는 생각을 하지 말고 a 누르고 탭을 누르는 것부터 시작하라.** 그러면 Emmet의 매력에 빠져들게 될 거다.

 [1]: http://emmet.io/
 [2]: http://docs.emmet.io/
 [3]: https://twitter.com/#!/emmetio
 [4]: http://emmet.io/download/
 [5]: https://github.com/emmetio/emmet-eclipse#readme
 [6]: http://www.editplus.com/kr/zencoding.html
 [7]: http://code.google.com/p/zen-coding/#Officially_supported_editors
 [8]: http://docs.emmet.io/cheat-sheet/