---
title: '[PHP] HTML 파싱하기 simplehtmldom, phphtmlparser'
author: 안형우
layout: post
permalink: /archives/1085
aktt_notify_twitter:
  - yes
daumview_id:
  - 36749544
categories:
  - 서버단
tags:
  - PHP
---
[▶ simplehtmldom 라이브러리 바로 가기][1]

doa님의 글에서 봤던 걸 기억해 뒀다가 쓸 일이 있어서 써 봤다.

예제를 보고 따라하면 매우 쉽게 할 수 있다.

그래서 이 예에 대한 설명은 끝!

## PHP4를 사용하고 있다면

한 가지 문제는 simplehtmldom 라이브러리가 PHP5만 지원한다는 것이다.

따라서 PHP4를 사용한다면 다른 라이브러리를 사용해야 한다.

simplehtmldom 라이브러리 웹사이트의 하단에 힌트가 나와 있다.

> Original idea is from Jose Solorzano&#8217;s HTML Parser for PHP 4.

이렇게 써 있는 부분이다. 오리지널 아이디어는 조스 솔로자노(?)의 [HTML Parser for PHP4][2]라는 것을 밝혀 둔 부분이다.

이 웹사이트에 들어가 보면 아래와 같은 안내 문구가 써 있다.

> Note: This project has been inactive for some time, but we recommend checking out Simple HTML DOM Parser, which is a PHP 5 DOM parser based on this project.
> 
> 알림: 이 프로젝트는 당분간 중지합니다. 대신 이 프로젝트에 기반한 PHP 5 DOM 파서인 Simple HTML DOM Parser를 살펴 보시길 추천합니다.

그렇다. 서로 추천하고 있다 ㅡㅡ;;

이놈은 사용하기가 좀더 까다로운데, 예제조차 제대로 나와 있지 않기 때문이다. 예제가 단 하나 있다.

그런데 사용해 보면 이 하나의 예제가 모든 것을 포함하고 있다는 것을 알 수 있다. 예제를 보자.

<pre class="brush:php">include ("htmlparser.inc");

  $htmlText = "... HTML text here ...";
  HtmlParser parser = new HtmlParser ($htmlText);
  while ($parser-&gt;parse()) {

      // Data you can use here:
      //
      // $parser-&gt;iNodeType
      // $parser-&gt;iNodeName
      // $parser-&gt;iNodeValue
      // $parser-&gt;iNodeAttributes     

      if ($parser-&gt;iNodeType == NODE_TYPE_ELEMENT) {
          ...
      }
  }</pre>

기본적으로 파싱을 위해 무조건 while문을 사용해야 하며, while문 안에서 읽은 놈이 어떤 놈인지 체크해서 갖다 쓰는 방법을 사용한다.

기본적으로 내용만 불러올 수 있지 HTML에 조작을 가해 재사용하거나 할 수는 없는 듯하다. 말 그대로 parsing만 할 수 있다.

[파일을 다운][3]받으면 몇 가지 예제가 더 있는데, 그걸 분석해 보면 좀더 알 수 있을 것이다.

&nbsp;

 [1]: http://simplehtmldom.sourceforge.net/
 [2]: http://php-html.sourceforge.net/
 [3]: http://sourceforge.net/projects/php-html/files/