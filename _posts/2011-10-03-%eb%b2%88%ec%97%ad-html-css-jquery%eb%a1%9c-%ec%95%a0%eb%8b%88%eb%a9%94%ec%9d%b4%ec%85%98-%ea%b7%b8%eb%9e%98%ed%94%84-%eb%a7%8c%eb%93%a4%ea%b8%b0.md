---
title: '[번역:튜토리얼] HTML, CSS, jQuery로 애니메이션 그래프 만들기'
author: 안형우
layout: post
permalink: /archives/1893
aktt_notify_twitter:
  - yes
daumview_id:
  - 36666268
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
[역자주: 원문은 [Create An Animated Bar Graph With HTML, CSS And jQuery][1] 다. 한 번 사용해 볼까 하고 번역을 했다. 내 번역은 의역이다. 따라서 빼먹는 단어, 추가하는 단어들이 있다. 그래서 정확한 번역은 아닐 수 있다. 그러나 내가 프로그래머인 만큼 코드를 보면서 나름대로 말이 되게 번역을 했다. 영 못 알아먹겠는 번역은 꺽쇠 안에 원문이나 설명을 넣었다. 당연히 오역은 있을 수 있다. 그리고 코드 검토를 충분히 해 본 것은 아니라서 코드를 엉뚱하게 설명한 게 있을지도 모른다는 불안감이 있다. 그런 게 있으면 댓글로 남겨 주시기 바란다. 약간의 오역이 있어도 영어 원문 보면서 하는 것보다는 나을 거다.]

세계적으로 볼 때, 회의실에 있는 사람들은 훌륭한 그래프를 좋아한다. 그들은 파워포인트와 각종 목록에 열광한다. “아이디어 늘어놓기”, “창의적 사고”, “쉬운 목표를 확실히 잡아라” 같은 말들에도 열광한다. 그리고 모든 것은 늘 전진중이다.[They go nuts for PowerPoint, bullet points and phrases like “run it up the flagpole,” “blue-sky thinking” and “low-hanging fruit,” and everything is always “moving forward.”] [시대 정신의 패러다임을 움직이는 사람들][2]의 사전에 후퇴는 없다. 재정 계획 그래프, 분기별 판매량, 그리고 시장 공략은 중간 관리자의 꿈이다.

<img class="aligncenter" src="http://lh4.googleusercontent.com/-ZDbaPDCyfy4/ToXMAEx62wI/AAAAAAAAI-Y/_96C7dCLz1w/graph-tut-image-header.jpg" alt="" />

웹디자이너인 우리는 이런 뜨거운 그래프 열풍에 어떻게 동참할 수 있을까? 웹으로 그래프를 보여 줄 수 있는 방법이 실제로 몇 가지 있다. 가장 간단한 방법은 이미지를 만들어서 웹페이지에 박아 넣는 방법이다. 하지만 그렇게 하면 접근성이 떨어진다. 재밌지도 않다. 플래시를 사용할 수도 있다. 그러면 멋진 그래프를 보여 줄 수 있다. 하지만 이것 역시 접근성이 아주 떨어진다. 게다가 디자이너와 개발자, 그리고 [신(神)][3]도 플래시에는 정나미가 떨어졌다.

HTML5 같은 기술을 플러그인 없이 그런 것을 할 수 있다. HTML5에 새로 도입된 `<canvas>` 요소는 이런 일에 아주 딱 맞는다. 온라인에 이런 툴은 꽤 있다. 하지만 우리에게 딱 맞는 것을 원한다면 어떻게 해야 할까?

우리가 사용할 수 있는 많은 자원들에는 각기 장단점이 있다. 하지만 이 튜토리얼은 그 모든 걸 다루지는 않을 것이다. 대신에 우리는, CSS3와 jQuery로 양념을 살짝 뿌려 [점진적 향상 기법][4]으로 우리 그래프를 만들 것이다.

## 무엇을 만들까?

우린 [이걸][5] 만들 거다. 그리고 더 나아갈 거다! 이 튜토리얼에서 배운 테크닉을 확장하면 좀더 많은 가능성이 열릴 거다.

*   모든 인류가 좀비가 돼 멸망할 때까지 얼마나 걸리는지를 보여 주는 그래프
*   좀비 전염병으로 한 실외 활동의 감소 그래프
*   좀비 전염병과 무섭도록 유사한 매너 감소 그래프
*   페이스북의 [팜빌][6]만 하느라 좀비 전염병을 알지 못한 사람의 증가. [The increase of people who were unaware of the zombie plague because they were sharing with all of their now-deceased friends on Facebook what they did on FarmVille.]

아니면 좀비의 공포를 설명하는, 최고는 아니겠지만 유용하기는 한, 그런 설명 그래프나 할당량 막대를 간단히 그릴 수 있다. [Or you could create a graph or quota bar that simply illustrates something useful and less full of dread and zombies.] 그러면 한 번 해 보자.

### 필요한 것

*   텍스트(혹은 HTML) 에디터: 여러 가지가 있으니 [알아서 골라 잡아라.][7]
*   [jQuery][8]. 안전한 스크립팅을 배우고, 최신 버전을 다운받아라. jQuery 웹사이트를 열어놓고 필요할 때 문서를 찾아 봐라.
*   그림판 같은 이미지 에디터가 있는 편이 좋다. 그래프 모형을 만들어 보기 위해서다.
*   그래프를 보기 위한 최신 웹브라우저

이게 있어야 한다. 이 튜토리얼이 HTML, CSS, jQuery나 좀비를 소개하기 위해 씌어지지 않았다는 걸 염두에 둬라. 이 세 가지 기술과 언데드에 대해서는 이미 아는 것으로 가정하고 진행할 것이다.

## 마크업

그래프의 뼈대가 되는 HTML을 만드는 방법은 몇 가지가 있다. 이 튜토리얼에서, 우리는 `table`로 시작할 거다. JS나 CSS 없이 시각적으로 가장 이해하기 쉽기 때문이다. 접근성 항목에서 그건 굉장히 중요하다.

급하다! 지금 우리는 놀라운 수치를 건네 받은 상태다. 황갈색 좀비의 인구가 앞으로 몇 년간 통제불능에 빠질 것으로 예상된다. 카본 타이거와 블루 몽키는 위협에 놓였다. 황갈색 좀비는 아마 우리를 덮칠 것이다. 그러나 당신은 일개 디자이너에 불과하다. 어떻게 하면 도움을 줄 수 있을 것인가?

그렇다! 당신은 웹페이지에 멋진, 차분한, 부드러운, 애니메이션 그래픽을 만들어서 그걸 알릴 수 있다!

시작해 보자. 일단, 테이블이 데이터를 넣자. 열은 연도고 행은 좀비 종류다.

<pre class="brush:xml">&lt;!doctype html&gt;
&lt;html lang="en"&gt;
   &lt;head&gt;
      &lt;meta charset="utf-8"&gt;
      &lt;meta name="viewport" content="width=1024"&gt;
      &lt;title&gt;Example 01: No CSS&lt;/title&gt;
   &lt;/head&gt;

   &lt;body&gt;
      &lt;div id="wrapper"&gt;
         &lt;div class="chart"&gt;
            &lt;h3&gt;2012년에서 2016년 사이 멸종 위기에 놓이는 종&lt;/h3&gt;
            &lt;table id="data-table" border="1" cellpadding="10" cellspacing="0"
            summary="2012년에서 2016년 사이, 멸종 위기 종의 인구에 좀비 발생이 끼치는 영향"&gt;
               &lt;caption&gt;단위: 천 명&lt;/caption&gt;
               &lt;thead&gt;
                  &lt;tr&gt;
                     &lt;td&gt; &lt;/td&gt;
                     &lt;th scope="col"&gt;2012&lt;/th&gt;
                     &lt;th scope="col"&gt;2013&lt;/th&gt;
                     &lt;th scope="col"&gt;2014&lt;/th&gt;
                     &lt;th scope="col"&gt;2015&lt;/th&gt;
                     &lt;th scope="col"&gt;2016&lt;/th&gt;
                  &lt;/tr&gt;
               &lt;/thead&gt;
               &lt;tbody&gt;
                  &lt;tr&gt;
                     &lt;th scope="row"&gt;카본 타이거&lt;/th&gt;
                     &lt;td&gt;4080&lt;/td&gt;
                     &lt;td&gt;6080&lt;/td&gt;
                     &lt;td&gt;6240&lt;/td&gt;
                     &lt;td&gt;3520&lt;/td&gt;
                     &lt;td&gt;2240&lt;/td&gt;
                  &lt;/tr&gt;
                  &lt;tr&gt;
                     &lt;th scope="row"&gt;블루 몽키&lt;/th&gt;
                     &lt;td&gt;5680&lt;/td&gt;
                     &lt;td&gt;6880&lt;/td&gt;
                     &lt;td&gt;6240&lt;/td&gt;
                     &lt;td&gt;5120&lt;/td&gt;
                     &lt;td&gt;2640&lt;/td&gt;
                  &lt;/tr&gt;
                  &lt;tr&gt;
                     &lt;th scope="row"&gt;황갈색 좀비&lt;/th&gt;
                     &lt;td&gt;1040&lt;/td&gt;
                     &lt;td&gt;1760&lt;/td&gt;
                     &lt;td&gt;2880&lt;/td&gt;
                     &lt;td&gt;4720&lt;/td&gt;
                     &lt;td&gt;7520&lt;/td&gt;
                  &lt;/tr&gt;
               &lt;/tbody&gt;
            &lt;/table&gt;
         &lt;/div&gt;
      &lt;/div&gt;
   &lt;/body&gt;
&lt;/html&gt;</pre>

CSS와 JS가 적용되지 않은 상태에서는 아래처럼 보인다. 스크린 리더로 접근하는 사람들에게도 이 테이블은 접근성이 좋다. 스크린 리더로도 “달아나! 좀비가 다가오고 있다!” 하는 이 테이블의 메세지를 이해할 수 있다.

[<img class="aligncenter" src="https://lh3.googleusercontent.com/-LrOZ7U0M8ZU/ToXL_vu7kbI/AAAAAAAAI-I/rE65AFC_blo/graph-tut-image-01.jpg" alt="" />][9]

이제 쉬운 부분은 지나갔다. 이제 CSS와 JS(jQuery를 이용)의 세계로 들어가 보자. 이걸 이용하면 저 숫자들이 진짜로 뭘 말해 주는지 확실히 표현할 수 있다. 기술적으로, 우리의 목표는 IE8을 포함해 모든 최신 브라우저에서 작동하는 그래프를 생성하는 것이다.

방금 나는 모든 최신 브라우저라고 했다. IE8은 운이 좋다: 나중엔 박물관에 전시될 테지만[it gets to hang out with the cool kids.]. CSS3를 지원하는 브라우저들에는 몇 가지를 더 추가해 줄 거다.

## “너의 힘을 더함으로써…”

[캡틴 플레닛][10]을 소환하고 싶다면, 땅 불 바람 물 마음이 필요하다. 만약 좀비 병사로 인한 임박한 멸망을 그려내는 그래프를 만들려고 CSS와 jQuery를 결합하는 방법을 배우고 싶다면, 계속 읽으면 된다.

처음 할 일은 기본적인 CSS를 활용로 테이블에 스타일을 입히는 거다. 이것은 브라우저에서 JS를 사용하지 못하는 사람들을 위한 안전망이다.

[<img class="aligncenter" src="https://lh3.googleusercontent.com/-LpbmPKmF3Lc/ToXL_uQfrFI/AAAAAAAAI-M/OHYDu3BXd2k/graph-tut-image-02.jpg" alt="" />][11]

## jQuery 시작

우리는 원본 테이블과는 별로도, 그래프를 만들기 위해 즉시 jQuery를 사용할 거다. 이걸 위해, 데이터를 테이블에서 분리해 내 좀더 사용하기 편한 포맷으로 변환해 저장해야 한다. 그리고 나서, 우리는 데이터를 이용해 그래프를 그리는 데 사용하는 새 엘리먼트를 생성해 문서에 집어넣을 것이다.

메인 함수는 `createGraph()`다. 만들어 보자. 아래는 구조를 이해하기 쉽게 하려고, 함수 중간을 생략한 것이다. 잊지 마라. 이 튜토리얼과 함께 제공되는 소스에 언제든 접근할 수 있다.

이게 기본적인 구조다:

<pre class="brush:js">// DOM이 안전하게 모두 로드될 때까지 기다린다.
$(document).ready(function() {

   // 데이터 테이블을 이용해서 그래프를 생성하고, 그래프를 집어넣을 컨테이너를 알려 준다.
   createGraph(&#039;#data-table&#039;, &#039;.chart&#039;);

   // 여기서 그래프가 만들어진다.
   function createGraph(data, container) {
      // 몇몇 공통 변수와 컨테이너 요소를 선언한다.
      …

      // 테이블 데이터 오브젝트를 생성한다.
      var tableData = {
         …
      }

      // 데이블 데이터에 접근할 유용한 변수들
      …

      // 그래프 구축
      …

      // 각각의 막대 높이 설정
      function displayGraph(bars) {
         …
      }

      // 그래프 설정을 재설정하고 보여 줄 준비를 한다.
      function resetGraph() {
         …
         displayGraph(bars);
      }

      // 헬퍼 함수들
      …

      // 마지막으로, 함수를 리셋함으로써 그래프를 보여 준다.
      resetGraph();
   }
});</pre>

우리는 이 함수에 두 가지 파라미터를 넘겨 줬다.

1.  `table` 안에 있는 `data`;
2.  그래프를 넣을 `container` 요소.

다음으로 가자. 우리는 데이터와 컨테이너 요소를 제어하고, 애니메이션을 표현할 타이머 값을 더하기 위해 몇가지 변수를 선언할 거다. 이게 코드다:

<pre class="brush:js">// 몇몇 공통 변수와 컨테이너 요소를 선언한다.
var bars = [];
var figureContainer = $(&#039;&lt;div id="figure"&gt;&lt;/div&gt;&#039;);
var graphContainer = $(&#039;&lt;div class="graph"&gt;&lt;/div&gt;&#039;);
var barContainer = $(&#039;&lt;div class="bars"&gt;&lt;/div&gt;&#039;);
var data = $(data);
var container = $(container);
var chartData;
var chartYMax;
var columnGroups;

// 타이머 변수
var barTimer;
var graphTimer;</pre>

별 거 없다. 하지만 나중엔 이것들이 정말 유용하게 사용된다.

## 데이터를 가져 오기

단순히 데이터를 표시하는 것 외에, 좋은 막대 그래프에는 크고 멋진 제목, 깔끔하게 이름이 표시된 축, 그리고 색상으로 표시된 범례가 있다.

우리는 테이블에서 데이터를 벗겨내서, 그래프에 좀더 의미가 있도록 포맷을 변경해야 한다. 그걸 위해서, 데이터를 저장할 JS 객체를 생성할 것이다. 간단한 함수를이용한다. `tableData{}` 객체를 탄생시키자:

<pre class="brush:js">// 테이블 데이터 객체를 생성한다
var tableData = {
   // 테이블의 셀에서 숫자 데이터를 가져 온다
   chartData: function() {
      …
   },
   // 테이블 캡션에서 헤딩 데이터를 가져 온다
   chartHeading: function() {
      …
   },
   // 테이블 body에서 범례 데이터를 가져 온다
   chartLegend: function() {
      …
   },
   // y축 중에서 가장 높은 숫자를 가져 온다
   chartYMax: function() {
      …
   },
   // 테이블 셀에서 y축 데이터를 가져 온다
   yLegend: function() {
      …
   },
   // 테이블 헤더에서 x축 데이터를 가져 온다
   xLegend: function() {
      …
   },
   // 테이블의 열을 돌면서 데이터를 그룹으로 묶어 저장한다
   columnGroups: function() {
      …
   }
}</pre>

위에 보면 여러 함수가 있다. 주석에 어떤 함수인지 설명을 달아 놨다. 대부분은 비슷하다. 그래서 코드를 전부 보여 줄 필요는 없다고 생각한다. 대신에 하나만 골라서 보여 주겠다. `columnGropus`다.

<pre class="brush:js">// 테이블의 열을 돌면서 데이터를 그룹으로 묶어 저장한다
columnGroups: function() {
   var columnGroups = [];
   // 테이블 body의 첫 번째 행으로 열 개수를 센다
   var columns = data.find(&#039;tbody tr:eq(0) td&#039;).length;
   for (var i = 0; i &lt; columns; i++) {
      columnGroups[i] = [];
      data.find(&#039;tbody tr&#039;).each(function() {
         columnGroups[i].push($(this).find(&#039;td&#039;).eq(i).text());
      });
   }
   return columnGroups;
}</pre>

함수 설명이다.

*   데이터를 저장하기 위해 `columnGroups[]` 배열을 생성했다.
*   첫째 열에 있는 테이블 셀(`td`)을 세서 열 개수를 얻었다.
*   각각의 열에 대해, 행의 테이블 body(`tbody`) 안에 있는 tr을 돌면서 그 안에 있는 td들의 데이터를 저장하기 위해 이중배열을 생성한다.
*   각각의 열을 돌면서 각각의 테이블 셀에서 데이터를 잡아내(jQuery의 `text()` 함수 이용), 테이블 셀 데이터 배열에 집어넣는다.

일단 객체가 싱싱한 데이터로 가득차면, 우리 그래프를 만들기 위해 요소를 생성할 수 있게 된다.

## 데이터 사용하기

jQuery의 `$.each` 함수를 사용해서, 우리는 어떤 지점에서든 데이터를 순환하면서 그래프를 만들 요소를 생성할 수 있다. 좀더 영리하게 한다면, 각 종의 연도별 수치를 막대 그래프로 넣을 수도 있다. [One of the trickier bits involves inserting the bars that represent each species inside the yearly columns.]

코드를 보자:

<pre class="brush:js">// 연도별 수치들을 돌면서 막대기를 생성한다.
$.each(columnGroups, function(i) {
   // 연도별 수치 막대기(barGroup)를 넣을 컨테이너를 만든다.
   var barGroup = $(&#039;&lt;div class="bar-group"&gt;&lt;/div&gt;&#039;);
   // 각 열에 막대기 높이를 세팅한다.
   for (var j = 0, k = columnGroups[i].length; j &lt; k; j++) {
      // 막대의 속성(레이블, 높이, 코드 등)을 저장할 객체를 만들고, 배열에 넣는다.
      // displayGraph() 함수로 좌에서 우로 잇달아 그래프를 그릴 텐데, 그 때 사용할 높이를 설정한다.
      var barObj = {};
      barObj.label = this[j];
      barObj.height = Math.floor(barObj.label / chartYMax * 100) + &#039;%&#039;;
      barObj.bar = $(&#039;&lt;div class="bar fig&#039; + j + &#039;"&gt;&lt;span&gt;&#039; + barObj.label + &#039;&lt;/span&gt;&lt;/div&gt;&#039;)
         .appendTo(barGroup);
      bars.push(barObj);
   }
   // 연도별 수치 막대기(barGroup)를 그래프에 추가한다.
   barGroup.appendTo(barContainer);
});</pre>

제목열[headings]을 제외하고 우리 테이블은 5행 3열이다. 이것은, 그래프에서 연도별로 각각 3개의 막대가 있다는 것을 의미한다. 아래 이미지는 우리 그래프가 어떤 식으로 만들어질 지를 보여 준다.

<p style="text-align: center;">
  <img class="aligncenter" src="http://mytory.net/uploads/legacy/create-an-animated-bar/graph-tut-image-construction.png" alt="" /><br /> 분석해 보자.
</p>

*   각 열의 [연도별] 수치를 담을 `div`를 만든다.
*   각 열의 [연도별] 수치가 담겨 있는 셀을 돌아서 데이터를 받아온다.
*   레이블, 높이, 마크업 같은 각 막대의 속성을 담기 위해서 막대 객체(`barObj{}`)를 만든다.
*   각 열의 색상을 구분하는 &#8216;.fig&#8217;+j 클래스를 각 막대`div`에 추가한다. 레이블을 `span`으로 감싸고 이걸 막대 `div`에 추가한다.
*   `bar[]` 배열에 객체를 추가해서 나중에 접근할 수 있게 한다.
*   컨테이너 요소에 넣어서 [막대] 조각들을 모은다.

[4번 항목은 의역을 참 많이 했다.]

우리가 막대의 높이를 세팅하지 않은 것을 눈치챘다면, 보너스 포인트를 짚은 거다. 막대를 그릴 때 좀더 제어를 할 수 있도록 하기 위해 그렇게 한 것이다.

막대를 그렸으니 라벨링을 해 보자. 레이블을 붙이는 것은 코드가 다 비슷비슷하기 때문에, 코드를 전부 다 보여 줄 필요는 없다고 본다. y축에 라벨링하는 코드만 보여 주겠다.

<pre class="brush:js">// 그래프에 y축을 넣는다.
var yLegend   = tableData.yLegend();
var yAxisList   = $(&#039;&lt;ul class="y-axis"&gt;&lt;/ul&gt;&#039;);
$.each(yLegend, function(i) {
   var listItem = $(&#039;&lt;li&gt;&lt;span&gt;&#039; + this + &#039;&lt;/span&gt;&lt;/li&gt;&#039;)
      .appendTo(yAxisList);
});
yAxisList.appendTo(graphContainer);</pre>

분석하면 아래와 같다.

*   레이블과 관련된 데이터를 가져 온다.
*   목록 아이템을 넣기 위해 `ul`(unordered list &#8211; 순서없는 목록)을 생성한다.
*   레이블 데이터를 돌면서 각 레이블을 `li`로 만들고, 그걸 `span`으로 감싼다.
*   목록 아이템[`li`]을 우리 목록[`ul`]에 집어 넣는다.
*   마지막으로, 컨테이너 요소에 목록을 집어넣는다.

이런 식으로 반복해서 우리는 범례, x축 레이블, 제목행 들을 그래프에 추가할 수 있다.

그래프를 그리기 전에 우리가 작업한 결과들을 컨테이너 요소에 집어넣을 필요가 있다.

<pre class="brush:js">// 그래프에 막대를 넣는다.
barContainer.appendTo(graphContainer);      

// 그래프 컨테이너에 그래플 넣는다.
graphContainer.appendTo(figureContainer);

// 그래프 컨테이너를 메인 컨테이너에 넣는다.
figureContainer.appendTo(container);</pre>

## 데이터 보여주기

jQuery로 할 일은 각 막대의 높이를 세팅하는 것밖에 없다. 앞서 막대 객체의 속성에 높이를 저장해 뒀다. 이걸 사용하기만 하면 된다.

우리는 그래프의 막대가 하나씩 솟아오르게 할 것이다.

사용할 수 있는 방법 중 하나는, 한 막대를 솟아오르게 하는 게 끝났을 때 콜백 함수를 이용해서 다음 막대를 솟아오르게 하는 것이다.

그러나 그러면 그래프가 전부 다 그려질 때까지 너무 오래 걸리게 된다. 대신에,우리는 타이머 함수를 이용해서 막대를 그릴 것이다. 막대가 다 솟아올랐는지에 상관없이 일정 시간마다 막대가 하나씩 솟아오를 것이다. 돌려 보자!

`displayGraph()` 함수다.

<pre class="brush:js">// 각 막대의 높이를 세팅한다
function displayGraph(bars, i) {
   // Changed the way we loop because of issues with $.each not resetting properly
   if (i &lt; bars.length) {
      // jQuery animate() 함수를 이용해 막대를 솟아오르게 한다.
      $(bars[i].bar).animate({
         height: bars[i].height
      }, 800);
      // 일정 시간을 기다린 다음, 다음 막대를 위해 displayGraph() 함수를 실행한다.
      barTimer = setTimeout(function() {
         i++;
         displayGraph(bars, i);
      }, 100);
   }
}</pre>

이런 질문을 할 수 있다. “왜 다른 데서는 `$.each` 함수를 써놓고 여기서는 사용하지 않나요?” 좋은 질문이다. 첫째, `displayGraph()` 함수의 역할에 대해 토론해 보자. 그러면 왜 그렇게 했는지 알 수 있다.

`displayGraph()` 함수는 두 파라미터를 받는다.

1.  `bars`를 받아서 루프를 돈다.
2.  몇 번째 놈을 그릴지 알기 위해 인덱스(`i`)를 받는다.(시작은 ``이다.)

마저 분석해 보자.

*   막대의 개수보다 `i`가 작으면, 계속 돈다.
*   `i` 값을 이용해 배열에서 현재 막대를 가져 온다.
*   높이 속성을 변화시키며 애니메이션을 실행한다.(`bars[i].height`에 저장된 퍼센트 값을 계산해서 한다.)
*   100밀리초를 기다린다.
*   `i`를 1씩 증가시키면서 다음 막대에 똑같이 한다.

“그러면 각 애니메이션 전에 `delay()` 함수를 사용해서 `$.each`를 돌리면 되는 거 아냐?”

그렇게 할 수도 있다. 아마 잘 작동할 거다… 처음에는. 하지만 “그래프 재설정” 버튼을 눌러서 애니메이션을 재설정하려고 한다면, 시간 이벤트가 완전히 깨끗하게 비워지지 않을 것이고, 그러면 순차적으로 애니메이션이 일어나지 않게 된다.

더 나은 방법이 있어서 내가 틀린 것으로 판명됐으면 좋겠다. 그렇다면 댓글 섹션에서 강하게 주장해 주시라.

계속 가 보자. `resetGraph()` 함수다.

<pre class="brush:js">// 보여 주기 전에 그래프 세팅을 재설정한다.
function resetGraph() {
   // 애니메이션을 멈추고 모든 막대의 높이를 0으로 만든다.
   $.each(bars, function(i) {
      $(bars[i].bar).stop().css(&#039;height&#039;, 0);
   });

   // 시간을 지운다.
   clearTimeout(barTimer);
   clearTimeout(graphTimer);

   // 마이머를 재시작한다.
   graphTimer = setTimeout(function() {
      displayGraph(bars, 0);
   }, 200);
}</pre>

`resetGraph()` 함수를 분석해 보자.

*   모든 애니메이션을 멈추고 높이를 모두 0으로 되돌린다.
*   타이머를 멈춰서, 애니메이션이 계속되지 않도록 만든다.
*   200밀리초를 기다린다.
*   첫 번째 막대를 솟아오르게 하기 위해 `displayGraph()` 함수를 호출한다.(인덱스는 0부터 시작한다.)

마지막으로, `createGraph()` 맨 밑에서 `resetGraph()`를 호출한다. 그리고 우리 노력의 결과 어떤 마법이 펼쳐지는지 감상한다.

## CSS

맨 처음 할 일은, 실제 데이터가 담겨 있는 테이블을 보이지 않게 만드는 것이다. 다양한 방법으로 할 수 있지만, CSS가 자바스크립트보다 먼저 로드되기 때문에, 가능한 방법 중에 가장 쉬운 방법을 사용하도록 하자.

<pre class="brush:css">#data-table {
   display: none;
}</pre>

됐다. 그래프를 넣을 컨테이너 영역을 만들자. 우리 그래프를 만들기 위해 비순차 목록(`ul`)을 몇 개 사용했기 때문에 ul의 스타일을 재정의할 것이다. `#figure`와 `.graph` 요소에 `position: relative`를 주는 것은 중요하다. 우리 그래프가 여기 제대로 들어가려면 그렇게 해 줘야 한다. [because it will anchor the place elements exactly where we want in those containers.]

<pre class="brush:css">/* 컨테이너들 */

#wrapper {
   height: 420px;
   left: 50%;
   margin: -210px 0 0 -270px;
   position: absolute;
   top: 50%;
   width: 540px;
}

#figure {
   height: 380px;
   position: relative;
}

#figure ul {
   list-style: none;
   margin: 0;
   padding: 0;
}

.graph {
   height: 283px;
   position: relative;
}</pre>

이제 범례다. 우리는 컨테이너(`#figure`)의 우측 하단에 범례를 둘 것이다. 그리고 가로로 아이템들을 배열할 것이다.

<pre class="brush:css">/* Legend */

.legend {
   background: #f0f0f0;
   border-radius: 4px;
   bottom: 0;
   position: absolute;
   text-align: left;
   width: 100%;
}

.legend li {
   display: block;
   float: left;
   height: 20px;
   margin: 0;
   padding: 10px 30px;
   width: 120px;
}

.legend span.icon {
   background-position: 50% 0;
   border-radius: 2px;
   display: block;
   float: left;
   height: 16px;
   margin: 2px 10px 0 0;
   width: 16px;
}</pre>

x축은 범례와 아주 비슷하다. 우리를 아이템을 가로로 배열하고 그래프 컨테이너(`.graph`)의 아래쪽에 놓을 것이다.

<pre class="brush:css">/* x축 */

.x-axis {
   bottom: 0;
   color: #555;
   position: absolute;
   text-align: center;
   width: 100%;
}

.x-axis li {
   float: left;
   margin: 0 15px;
   padding: 5px 0;
   width: 76px;
}</pre>

y축은 조금 복잡하고 트릭이 필요하다. 우리는 일반적인 컨텐츠 흐름을 벗어나도록, 하지만 컨테이너에 붙어있기는 하도록, y축에 `position: absolute`를 줬다. 우리는 각 `li`를 그래프 전체 너비로 잡아 늘렸다. 그리고 윗 모서리에 border를 줬다. 이렇게 하면 배경에 멋진 가로 눈금이 생긴다.

[y축은, 코드를 뜯어 보면 알겠지만, 단지 y축의 레이블을 의미하는 게 아니라 그래프 전체 y축을 말한다. 아래 그림을 참고하라.

<img class="aligncenter" src="https://lh3.googleusercontent.com/-yXmUpcavBKI/TolWC51WidI/AAAAAAAAI-o/HKR30LLvBVo/s576/y-axis%252520li.jpg" alt="" />

- 녹풍]

음수 마진을 이용해서, [y축의] 숫자 레이블을 그래프 왼쪽편으로 끄집어낼 수 있다. 와우~!

<pre class="brush:css">/* y축 */

.y-axis {
   color: #555;
   position: absolute;
   text-align: right;
   width: 100%;
}

.y-axis li {
   border-top: 1px solid #ccc;
   display: block;
   height: 62px;
   width: 100%;
}

.y-axis li span {
   display: block;
   margin: -10px 0 0 -60px;
   padding: 0 10px;
   width: 40px;
}</pre>

이제 멸종 위기에 처한 샌드위치의 고기인, 막대 자신에 대해서 살펴 보자. 막대와 열을 위한 컨테이너 요소를 설정하는 데서 시작하자.

<pre class="brush:css">/* 그래프 막대 */

.bars {
   height: 253px;
   position: absolute;
   width: 100%;
   z-index: 10;
}

.bar-group {
   float: left;
   height: 100%;
   margin: 0 15px;
   position: relative;
   width: 76px;
}</pre>

복잡한 건 없다. 간단히, 컨테이너의 수치를 설정하고, `z-index`를 설정해서 y축 앞쯕으로 막대가 확실히 보일 수 있도록 한다.

각각의 `.bar`의 css를 세팅하자.

<pre class="brush:css">.bar {
   border-radius: 3px 3px 0 0;
   bottom: 0;
   cursor: pointer;
   height: 0;
   position: absolute;
   text-align: center;
   width: 24px;
}

.bar.fig0 {
   left: 0;
}

.bar.fig1 {
   left: 26px;
}

.bar.fig2 {
   left: 52px;
}</pre>

눈여겨 봐야 할 주요 스타일을 살펴 보자.

*   `position: absolute`와 `bottom: 0`이다. 이것은 우리 그래프가 바닥에 붙어서 위로 솟아 오를 것이라는 것을 의미한다.
*   각 종의 막대다.(`.fig0`, `.fig1`과 `.fig2`), 이것들은 `.bar-group` 안에 위치한다.

이제, `border-radius` 속성을 이용해서 막대의 우측 상단, 좌측 상단 모서리를 둥글게 만들어서 날카로운 부분을 가능한 최소화시키는 게 어떨까? 좋다. `border-radius`가 꼭 필요한 건 아니지만, 그걸 지원하는 브라우저로 보는 사람에게는 좋은 느낌을 줄 수 있다. 감사하게도, 주요 브라우저들의 최신 버전은 이걸 지원한다.

우리가 각 테이블의 셀에서 각 막대의 수치를 이미 가져왔기 때문에, 막대에 마우스를 올려놨을 때 살짝 수치가 뜨게 만들 수 있다.

<pre class="brush:css">.bar span {
   #fefefe url(../images/info-bg.gif) 0 100% repeat-x;
   border-radius: 3px;
   left: -8px;
   display: none;
   margin: 0;
   position: relative;
   text-shadow: rgba(255, 255, 255, 0.8) 0 1px 0;
   width: 40px;
   z-index: 20;

   -webkit-box-shadow: rgba(0, 0, 0, 0.6) 0 1px 4px;
   box-shadow: rgba(0, 0, 0, 0.6) 0 1px 4px;
}

.bar:hover span {
   display: block;
   margin-top: -25px;
}</pre>

처음에는, 팝업이 `display: none`으로 안 보이게 처리돼 있다. 그리고나서 `.bar` 요소에 마우스가 올라오면, `display: block`으로 설정해서 보이게 한다. 음수 `margin-top`을 이용하면 막대 위에 표시된다.

`text-shadow`, `rgba` 그리고 `box-shadow`는 최신 주요 브라우저에서 모두 지원한다. 이 최신 브라우저들 중에서, 사파리만 `box-shadow`를 작동하게 하기 위해 프리픽스(`-webkit-`)가 있어야 한다. 이런 속성들은 우리 그래프를 간단히 향상시키기 위한 것일 뿐이다. 이런 게 없어도 그래프를 이해하는 데는 아무 문제가 없다. 우리가 신경쓰는 최저치인 인터넷 익스플로러 8은 이런 속성들을 무시한다.

마지막 단계는, 각 막대에 색을 입히는 것이다.

<pre class="brush:css">.fig0 {
   background: #747474 url(../images/bar-01-bg.gif) 0 0 repeat-y;
}

.fig1 {
   background: #65c2e8 url(../images/bar-02-bg.gif) 0 0 repeat-y;
}

.fig2 {
   background: #eea151 url(../images/bar-03-bg.gif) 0 0 repeat-y;
}</pre>

이 예제에서, 우리는 간단히 `background-color`와 세로 타일 형태인 `background-image`를 사용했다. 이것은 막대와 범례에 표시되는 색깔 스타일을 좀더 업그레이드해 줄 것이다. 멋지게.

그리고, 믿든 말든, 이게 끝이다!

## 완성된 제품

<p style="text-align: center;">
  <a href="http://provide.smashingmagazine.com/graph_tut_files/ex_03.html"><img class="aligncenter" src="https://lh4.googleusercontent.com/-45TyP4ziRHc/ToXL_mhALRI/AAAAAAAAI-Q/42-_DAUXs_Q/graph-tut-image-03.jpg" alt="" width="500" height="260" /></a>
</p>

이걸 둘러싼 이야기는 끝났다. 우리는 좀비 인구 폭발에 대해 공적으로 경고하는 것을 충분히 했다고 생각한다. 그러나, 더 할 것이 있다. 나는 사람들이 이 튜토리얼을 통해 뭔가 유용한 것을 얻었기를 바란다. 그래서 사람들이 브라우저로 할 수 있는 것의 영역을 넓혀 갔으면 좋겠다. 특히, 써드파티 플러그인 없이 웹표준만으로 그런 것들을 했으면 한다. 만약 여기서 본 것 이상으로 확장하거나 개선할 만한 아이디어가 있다면, 댓글 남기기를 망설이지 않았으면 한다. 아니면 트위터에서 나를 찾아라: [@derek_mack][12].

## 보너스: CSS3의 힘을 개방하라!

이 보너스는 위에서 진행한 튜토리얼만큼 상세하지는 않다. 이것은 CSS3의 스펙 중 이용을 고려할 수 있는 기능 몇 개 정도를 보여 주려는 것이다.

아직 CSS3에 대한 지원이 제한적이기 때문에, 사용 역시 제한적이다. 여기 언급된 몇 개의 기능을 브라우저들이 각각 다른 방식으로 지원하고 있기는 하지만, 애플 사파리나 구글 크롬 같은 웹킷 기반의 브라우저들이 CSS3를 주도하고 있다.

우리는 실제로 이미지를 전혀 사용하지 않고 그래프를 만들 수 있다. 심지어 jQuery가 아니라 CSS만을 가지로 애니메이션을 만들 수 있다.

우리 막대에서 배경 이미지를 제거하자, 그리고 그것을 `-webkit-gradient` 속성으로 대체하자.

<pre class="brush:css">.fig0 {
   background: -webkit-gradient(linear, left top, right top, color-stop(0.0, #747474), color-stop(0.49, #676767), color-stop(0.5, #505050), color-stop(1.0, #414141));
}

.fig1 {
   background: -webkit-gradient(linear, left top, right top, color-stop(0.0, #65c2e8), color-stop(0.49, #55b3e1), color-stop(0.5, #3ba6dc), color-stop(1.0, #2794d4));
}

.fig2 {
   background: -webkit-gradient(linear, left top, right top, color-stop(0.0, #eea151), color-stop(0.49, #ea8f44), color-stop(0.5, #e67e28), color-stop(1.0, #e06818));
}</pre>

숫자 팝업에도 똑같이 적용할 수 있다.

<pre class="brush:css">.bar span {
   background: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #fff), color-stop(1.0, #e5e5e5));
   …
}</pre>

웹킷 그라디언트에 대해 더 많은 걸 알고 싶다면, [Surfin’ Safari][13] 블로그를 참고하라.

팝업을 좀더 손보자. `-webkit-transition`을 소개한다. CSS 전환(transition)은 아주 사용하기 쉽고 이해하기도 쉽다. 브라우저가 요소 속성(높이, 너비, 색, 투명도 등)의 변화를 감지했을 때, 새 속성으로 변할 때까지의 전환[ 시간과 모양]을 설정하는 것이다.

다시 한 번, [Surfin’ Safari][13]를 추천한다. `-webkit-transition`에 대해 더 자세히 알고 싶다면 말이다.

여기 예시가 있다.

<pre class="brush:css">.bar span {
   background: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #fff), color-stop(1.0, #e5e5e5));
   display: block;
   opacity: 0;

   -webkit-transition: all 0.2s ease-out;
}

.bar:hover span {
   opacity: 1;
}</pre>

막대에 마우스를 올려 놨을 때, 팝업의 마진과 투명도 속성이 변한다. 그러면 우리가 세팅한 전환 속성에 따라 전환 이벤트가 발생한다. 꽤 멋지다.

`-webkit-transition` 덕분에, 우리는 자바스크립트 함수를 좀더 간단하게 만들 수 있다.

<pre class="brush:js">// 각 막대의 높이를 설정
function displayGraph(bars, i) {
   // Changed the way we loop because of issues with $.each not resetting properly
   if (i &lt; bars.length) {
      // Add transition properties and set height via CSS
      $(bars[i].bar).css({&#039;height&#039;: bars[i].height, &#039;-webkit-transition&#039;: &#039;all 0.8s ease-out&#039;});
      // Wait the specified time, then run the displayGraph() function again for the next bar
      barTimer = setTimeout(function() {
         i++;
         displayGraph(bars, i);
      }, 100);
   }
}
//보여주기 위해 그래프 세팅을 재설정
function resetGraph() {
   // 막대가 솟아오르게 하기 전에 높이를 모두 0으로
   $.each(bars, function(i) {
      &lt;strong&gt;$(bars[i].bar).stop().css({&#039;height&#039;: 0, &#039;-webkit-transition&#039;: &#039;none&#039;});&lt;/strong&gt;
   });

   // 타이머를 지운다
   clearTimeout(barTimer);
   clearTimeout(graphTimer);

   // 타이머 재시작
   graphTimer = setTimeout(function() {
      displayGraph(bars, 0);
   }, 200);
}</pre>

주요하게는 아래 것들을 변경한 거다.

*   막대의 높이를 jQuery의 css() 함수를 이용해 설정했다. 그러면 CSS 전환(transition)이 애니메이션을 보여 준다.
*   그래프를 재설정할 때, 전환(transition)을 껐다. 그래프의 높이가 [애니메이션 없이] 즉각 0이 되도록 말이다.

사파리나 크롬 최신버전을 사용하고 있다면 [예제를 확인][14]해 보길!

### 울드라 메가 웹킷 보너스: 3D 사용!

미래를 살짝 엿보기 위해, 내가 넣은 [다소 실험적인 예제][15]를 살펴 봐라. 3D 효과와 CSS 변환(transform)을 사용했다. 다시 말하지만, 이게 작동하려면 사파리와 크롬 최신버전을 사용해야 한다.

우리의 이전 웹킷 예제와 같이, **이미지가 없고**, **모든 애니메이션은 CSS로 제어된다**. [Kiss my face!][16] [뭔진 모르겠는데, 개그 같아서 그냥 원문 그대로.]

이걸 본 사람들이 뭘 할지는 모르겠다. 하지만, 이 새로운 힘의 잠재적인 오용에 대해 경고할 수밖에 없다. 우리 친구 캡틴 플레닛은 말했다. “The power is yours!”[이 힘은 너의 것이다?]

현명하게 사용하길.

(al) (kw) (il)

## [Derek Mack][17]

<img style="float: left; margin-right: 1em;" src="https://lh3.googleusercontent.com/-30ULMpd2Ju8/Tolg10neVqI/AAAAAAAAI-8/Lzor7GU-4V0/Derek%252520Mack.jpg" alt="" />

Derek Mack은 오스트레일리아 멜버른 출신 디자이너다. 그는 [The Graphic Order][18]의 절반이고[?], [Verbs IM][19]의 iOS 디자이너다. 그리고 [Aussie Rules Live][20]에서 iOS와 안드로이드 관련 수상 경력이 있다.

[인물 소개는 늘 번역하기 힘들다;;]

 [1]: http://coding.smashingmagazine.com/2011/09/23/create-an-animated-bar-graph-with-html-css-and-jquery/
 [2]: http://cbsg.sourceforge.net/cgi-bin/live
 [3]: http://www.apple.com/hotnews/thoughts-on-flash/
 [4]: http://coding.smashingmagazine.com/2009/04/22/progressive-enhancement-what-it-is-and-how-to-use-it/
 [5]: http://provide.smashingmagazine.com/graph_tut_files/ex_03.html
 [6]: http://www.farmville.com/
 [7]: http://en.wikipedia.org/wiki/Comparison_of_HTML_editors
 [8]: http://jquery.com/
 [9]: http://provide.smashingmagazine.com/graph_tut_files/ex_01.html
 [10]: http://en.wikipedia.org/wiki/Captain_Planet
 [11]: http://provide.smashingmagazine.com/graph_tut_files/ex_02.html
 [12]: http://twitter.com/derek_mack
 [13]: http://webkit.org/blog/175/introducing-css-gradients/
 [14]: http://provide.smashingmagazine.com/graph_tut_files/ex_04.html
 [15]: http://provide.smashingmagazine.com/graph_tut_files/ex_05.html
 [16]: http://www.youtube.com/watch?v=bkcCBXZHfPw
 [17]: http://coding.smashingmagazine.com/author/derek-mack/
 [18]: http://dribbble.com/alanvanroemburg
 [19]: http://verbs.im/
 [20]: http://www.sportsmatemobile.com/