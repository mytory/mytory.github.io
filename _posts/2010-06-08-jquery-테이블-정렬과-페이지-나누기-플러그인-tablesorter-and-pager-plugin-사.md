---
title: '[jQuery] 테이블 정렬(과 페이지 나누기) 플러그인 tablesorter (and pager) plugin 사용해 보기'
author: 안형우
layout: post
permalink: /archives/666
aktt_notify_twitter:
  - yes
daumview_id:
  - 36869201
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
《jQuery 1.3 &#8211; 작고 강력한 자바스크립트 라이브러리》에는 다양한 플러그인이 소개돼 있다. 그 중에 <a href="http://tablesorter.com/" target="_blank">tablesorter</a>를 사용하기로 했다. table에 정확히 사용할 수 있고, 그냥 적용만 하면 알아서 되기 때문이었다.  
일단 예제 코드를 포함한 풀 패키지를 다운로드받는 게 편하다. <a target="_blank" href="http://tablesorter.com/docs/#Download">다운로드 페이지</a>로 가서 필요한 것만 다운받을 수도 있겠다. <div>
  기본 코드는 아래가 전부다.
</div>

<div>
  <pre class="brush:js">$(&#039;table&#039;).tablesorter()</pre>
</div>

<div>
  당연히 jquery와 jquery.tablesorter.js를 넣어야 한다.
</div>

<div>
  그리고 이쁜 스타일을 먹이고 싶다면, /tablesorter/themes/blue/style.css 를 link해야 하고. css가 있는 폴더에 함께 있는 그림파일을 당연히 같이 둬야 한다.(이놈은 전체 패키지의 압축을 풀면 나온다.)
</div>

<div>
  스타일이 먹게 하려면 원하는 table에 tablesorter라는 클래스를 직접 줘야 한다.
</div>

<div>
  테이블 구조는 <thead>와 <tbody>가 반드시 있어야 한다. thead를 기준으로 tbody를 정리하기 때문이다.
</div>

<div>
  골치아픈 게 있다. td 안에 plain text만 있는 경우가 많지는 않을 거다. 태그가 함께 끼어 있을 거다. 이 경우 태그의 단어들을 기준으로 정렬을 해 버린다. 원치 않는 경우, text를 기준으로 정렬하도록 만들 수 있다.
</div>

<div>
  참고할 데모는 &#8216;<a href="http://tablesorter.com/docs/example-option-text-extraction.html" target="_blank">셀 안의 마크업 다루기</a>&#8216;라는 항목이다.
</div>

<div>
  물론 아래 코드를 따다 써도 된다. 아래처럼 쓰면 textExtraction 옵션에 있는 함수에서 return해 주는 놈을 갖고 비교를 하게 된다.
</div>

<pre class="brush: js">$(&#039;table.tablesorter&#039;)&lt;br /&gt;.tablesorter({&lt;br /&gt;  textExtraction: function(node){&lt;br /&gt;    return $(node).text();&lt;br /&gt;  } &lt;br /&gt;)&lt;br /&gt;</pre>

## 페이지 나누기 pager plugin

<div>
  추가로 <a href="http://tablesorter.com/docs/example-pager.html" target="_blank">pager plugin</a>이 필요하다. 어차피 같은 홈페이지에서 구할 수 있다.
</div>

<div>
  js를 연결하고, 페이지의 특정 부분에 아래 html을 넣는다. 당연히 경로 수정을 해 줘야 한다. 나는 /css/jquery.tablesorter/pager/icons/ 폴더에 넣어줬다고 가정했다. 같은 폴더에 있는 css 파일도 link해 줘야 한다.
</div>

<pre class="brush: html">&lt;div id="pager" class="tablesorterPager"&gt; &lt;br /&gt;	&lt;form&gt; &lt;br /&gt;		&lt;img src="/css/jquery.tablesorter/pager/icons/first.png" class="first"/&gt; &lt;br /&gt;		&lt;img src="/css/jquery.tablesorter/pager/icons/prev.png" class="prev"/&gt; &lt;br /&gt;		&lt;input type="text" class="pagedisplay"/&gt; &lt;br /&gt;		&lt;img src="/css/jquery.tablesorter/pager/icons/next.png" class="next"/&gt; &lt;br /&gt;		&lt;img src="/css/jquery.tablesorter/pager/icons/last.png" class="last"/&gt; &lt;br /&gt;		&lt;select class="pagesize"&gt; &lt;br /&gt;			&lt;option selected="selected"  value="10"&gt;10&lt;/option&gt; &lt;br /&gt;			&lt;option value="20"&gt;20&lt;/option&gt; &lt;br /&gt;			&lt;option value="30"&gt;30&lt;/option&gt; &lt;br /&gt;			&lt;option  value="40"&gt;40&lt;/option&gt; &lt;br /&gt;		&lt;/select&gt; &lt;br /&gt;	&lt;/form&gt; &lt;br /&gt;&lt;/div&gt; &lt;br /&gt;</pre>

<div>
  그리고 위의 jquery 코드에 하나를 추가한다.
</div>

<div>
  아래처럼 말이다.
</div>

<div>
  .tablesorterPager 함수를 사용하고 있으며, container 옵션이 들어간다. container는 page 넘기는 아이콘 등이 들어있는 요소를 의미한다. #pager라고 돼 있는데, 바로 위에 내가 따다 쓰라고 한 html을 보면 id가 pager다. 위 div에 tablesorterPager를 클래스로 매긴 이유도 있다. 기본 css가 여기 매려지게 하려면 그렇게 클래스를 줘야 한다.
</div>

<pre class="brush:js">$(&#039;tablesorter&#039;)&lt;br /&gt; .tablesorter()&lt;br /&gt; .tablesorterPager({container: $("#pager")});&lt;br /&gt;</pre>

<div>
  그래서, 태그 안의 텍스트만 바탕으로 정렬이 가능하게 하면서 페이지도 나누게 하려면 아래 코드가 되겠다.
</div>

<pre class="brush: js">$(&#039;table.tablesorter&#039;)&lt;br /&gt;.tablesorter({&lt;br /&gt;  textExtraction: function(node){&lt;br /&gt;    return $(node).text();&lt;br /&gt;  } &lt;br /&gt;).tablesorterPager({&lt;br /&gt;  container: $("#pager")&lt;br /&gt;});&lt;br /&gt;</pre>

<div>
  그럼 대충 설명 완료됐다. 코드 긁기 쉽게 했다.
</div>