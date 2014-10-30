---
title: fckeditor용 code syntax highlighter 사용하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/20
aktt_notify_twitter:
  - yes
daumview_id:
  - 37267207
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
나는 블로그를 프로그래밍 관련된 글로 채우고 있다. 나에게도 도움이 되고 다른 사람들에게도 도움이 되니까 말이다. 그래서 프로그래밍 코드를 많이 쓰는 편이다.

그런데 코드를 쓰다 보면 이클립스나 에디트플러스 같은 에디터들에서 해 주는 문법 하이라이트 기능이 없는 게 아쉬웠다. 그렇다고 일일이 손으로 색깔을 넣는 노가다는 하기 싫었고&#8230;

내가 자주 보던 블로그들에는 아래와 같이 색깔이 들어간 코드가 많이 눈에 띄었다. 그래서 100% 뭔가 플러그인이 있을 것이라고 확신했다. 그리고 오늘 찾았다.

간단한 설치 방법을 설명하겠다. 일단 이 제품은, 글 쓸 때는 fckeditor가 필요하다. fckeditor를 이용해 생성한 코드만 있으면 어디서든 코드 하이라이트 기능을 이용할 수 있다.

fckeditor에 플러그인으로 붙여서 생성한 코드를, 코드 하이라이트 기능을 이용해서 보려면 보는 페이지에 js와 css파일을 연결해야 한다. 두 부분으로 나눠서 설명하겠다.

## code syntax highlighter 2를 fckeditor에 설치하기

### 1.

다운받는다 : <a href="http://alexgorbatchev.com/SyntaxHighlighter/download/" target="_blank">code syntax highlighter 다운로드</a> (현재 버전이 3이 됐다. 그래서 작동을 할지 모르겠다 : 2012-05-19)

(덧붙여 말하자면, 다음 링크에는 fckeditor의 다양한 플러그인이 모여 있다 : <a href="http://sourceforge.net/tracker/?group_id=75348&atid=737639" target="_blank">fckeditor 플러그인 모음</a>)

### 2.

사실 다운받은 다음에 거기에 있는 설명대로 하면 된다. 영어 설명서에 공포감을 갖고 있는 사람이 아니라면 차분히 읽으며 따라하는 게 더 나을지도 모른다. 여튼, 나도 나름대로 설명해 보겠다.

<img class="alignleft" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile22.uf.150AF7564D4BC8632F83C7.jpg" alt="" width="301" height="358" />왼쪽 그림처럼 폴더에 설치한다. 다운받은 거에서 압축 풀면 나오는 파일들 다 넣는다. <span style="text-decoration: underline;"><strong><span style="color: #ff0000;">폴더명은 반드시 syntaxhighlight2</span></strong></span>여야 한다. 다르게 하면 작동 안 한다.

단, 압축풀면 fckconfig.js도 같이 들어있는데, 이건 업로드할 필요 업다.

### 3.

원래 fckeditor에 들어있는 fckconfig.js를 열고 아래 코드를 추가해 준다.

<div style="clear: both; color: white;">
  .
</div>

<pre class="brush: jscript;gutter: false; ">FCKConfig.Plugins.Add( &#039;syntaxhighlight2&#039;, &#039;en&#039;) ;</pre>

FCKConfig.Plugins.Add라는 함수가 씌어있는 곳이 있다. 찾아서 그 근처에 넣어주면 될 것이다.

### 4.

그리고, 역시 fckconfig.js에 있는 툴바 세트 설정을 건드려야 한다.

FCKConfig.ToolbarSets["Default"]나 FCKConfig.ToolbarSets["Basic"] 중에 자신이 사용하는 것이 뭔지 알고 있는 게 좋을 것이다. 버튼이 많은 거면 Default고 버튼이 적으면 Basic이다. 일단은 말이다.

Custom으로 설정해서 사용하는 사람도 물론 있다. Custom을 건드릴 줄 아는 분은 굳이 설명 안 해도 될 것이라 믿는다.

Code Syntax Highlight2의 버튼이름은 <span style="color: #ff0000;"><strong>SyntaxHighLight2</strong></span>다. 이것도 철자 틀리면 안 된다. 조심스럽게 붙여 넣는다. 붙여넣은 결과 예시를 보여주면 다음과 같다. 이건 <span style="color: #ff0000;"><strong>예시</strong></span>라는 걸 명심하기 바란다. 어쨌든, 알아서 잘 넣으라는 말이다.(!)

<pre class="brush: jscript;gutter: false; ">FCKConfig.ToolbarSets["Basic"] = [
	[&#039;Bold&#039;,&#039;Italic&#039;,&#039;-&#039;,&#039;OrderedList&#039;,&#039;UnorderedList&#039;,&#039;SyntaxHighLight2&#039;,&#039;-&#039;,&#039;Link&#039;,&#039;Unlink&#039;,&#039;-&#039;,&#039;About&#039;]
] ;</pre>

### 5.

여기까지 하면 일단 완료됐다. 그럼 fckeditor로 들어가서 플러그인이 작동하는지 알아보자.

일단 <span style="color: #ff0000;"><strong>웹브라우저의 캐시를 삭제한다.</strong></span> 안 하면 안 변할 확률이 높다. 파폭이면 개인정보 초기화에서 캐시를 지우면 되고, 익스플로러라면 인터넷 옵션에서 검색기록을 삭제한다.

fckeditor 편집화면에서 아래같은 버튼이 나오고, 눌렀을 때 아래같은 화면이 나오면 일단 성공한 것이다.

<img class="aligncenter" src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile9.uf.120B09534D4BC86307C697.png" alt="" width="478" height="578" />

## fckeditor가 생성한 코드로 Code Syntax Highlighter2 작동시키기

이걸 찾느라 꽤 헤맸다. 아무래도 영어는 딸린다;;

코드 신택스 하이라이트 프로젝트 사이트에서 다운받아야 한다.

<p style="text-align: center;">
  <a title="[http://alexgorbatchev.com/SyntaxHighlighter/]로 이동합니다." href="http://alexgorbatchev.com/SyntaxHighlighter/" target="_blank">코</a><a title="[http://alexgorbatchev.com/SyntaxHighlighter/]로 이동합니다." href="http://alexgorbatchev.com/SyntaxHighlighter/" target="_blank">드 신택스 하이라이트 페이지</a>
</p>

다운받아 압축을 풀면 test.html이란 아이가 있고, src, scripts, styles라는 폴더가 있다.

script, src, styles 폴더를 모조리 자신의 계정에 업로드한다. textcube에 js파일을 올릴 수는 없게 돼 있으므로, 자신이 파일을 업로드할 수 있는 계정이 있어야 한다.

test.html의 코드를 열어서 head 사이에 있는 script 코드랑 style 코드를 다 긁자. <span style="color: #ff0000;"><strong>src와 href의 경로는 자신이 파일을 업로드한 계정에 맞게 잘 수정해 줘야 한다.</strong></span>

<pre class="brush: xhtml;">&lt;script type="text/javascript" src="scripts/shCore.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushBash.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushCpp.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushCSharp.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushCss.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushDelphi.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushDiff.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushGroovy.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushJava.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushJScript.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushPhp.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushPlain.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushPython.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushRuby.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushScala.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushSql.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushVb.js"&gt;&lt;/script&gt;
	&lt;script type="text/javascript" src="scripts/shBrushXml.js"&gt;&lt;/script&gt;
	&lt;link type="text/css" rel="stylesheet" href="styles/shCore.css"/&gt;
	&lt;link type="text/css" rel="stylesheet" href="styles/shThemeDefault.css"/&gt;
	&lt;script type="text/javascript"&gt;
		SyntaxHighlighter.config.clipboardSwf = &#039;scripts/clipboard.swf&#039;;
		SyntaxHighlighter.all();
	&lt;/script&gt;</pre>

이걸 다 긁어서, 글 보여주는 페이지에 넣는다.

나는 textcube를 사용하므로 당연히 스킨편집에 들어가서 skin.html에다 저 코드를 넣었는데, 작동하지 않았다. 소스보기를 하니까 코드가 사라져있었다. 그래서 위젯으로 들어간 다음 html 코드 위젯에다 저 코드를 모조리 집어넣었다.

그러면 설치 끝이다.