---
title: '크롬에서 모든 웹사이트 글꼴을 &#8220;맑은 고딕&#8221;이나 &#8220;나눔고딕&#8221;으로 만들기'
author: 안형우
layout: post
permalink: /archives/1262
categories:
  - 기타
tags:
  - TIP
---
나는 굴림이 정말 싫다. 빨리 사라져야 할 글꼴이라고 생각한다.

그래서 나는 웹브라우저의 기본 글꼴을 &#8220;맑은 고딕&#8221;으로 해 두고 사용한다. 맑은 고딕은 참 맑다.

그런데 <한겨레> 같은 데는 글꼴을 `'굴림',Dotum,verdana,UnDotum,AppleGothic,sans-serif`으로 지정해 뒀다. 무의미한 일이다. 모든 윈도우에는 굴림 글꼴이 있고, 기본 글꼴이다. 그런데 굳이 &#8220;굴림&#8221;으로 한 번 더 폰트 설정을 해 뒀다. 은 돋움이나 애플고딕도 우분투와 iOS/OSX의 기본 글꼴이다. 무의미하다.

## 지정하지 않아도 적용되는 기본글꼴을 font-family로 지정하는 건 무의미함을 넘어 짜증을 유발한다

무의미함을 넘어서 짜증을 불러 일으키는 이유는, 크롬의 기본 글꼴을 &#8220;맑은 고딕&#8221;으로 해 둬도 저 스타일 지정 때문에 글꼴이 굴림으로 나온다는 사실이다! 우분투에서도 은 돋움으로 나와서 매우 짜증났다. 난 우분투에서는 나눔고딕이나 &#8220;함초롬 바탕&#8221;을 웹브라우저 기본 글꼴로 사용하기 때문이다.

## 크롬 확장을 이용해서 글꼴을 바꾸기

크롬 확장 중 반드시 그런 게 있을 거라 생각했고, 찾았다. custom css 라고 검색했더니 나왔다. [Personalized Web][2]이다(비슷한 프로그램이 많다).

이놈을 설치한 후, 브라우저 오른쪽 상단의 공구모양 아이콘 <img class="alignnone" alt="" src="http://www.google.com/help/hc/images/chrome_toolsmenu.gif" width="29" height="29" />을 누른 후 **도구 > 확장 프로그램**을 선택한다. 그러면 설치된 확장 프로그램들이 나오는데, 거기서 Personalized Web 을 찾아 **&#8216;옵션&#8217;**을 누른다. 그러면 아래 같은 설정을 할 수 있다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="/uploads/legacy/chrome-font/personalized-web.png" width="640" height="273" />
</p>

Rule name은 본인이 원하는대로 사용하고 Match URLs는 그대로 둔다. Add CSS 에 다음 코드를 집어 넣는다.

<pre>*{font-family:'맑은 고딕', 'Malgun Gothic','나눔고딕', 'Nanumgothic','함초롬 바탕', 'HCR Batang','함초롬 돋움', 'HCR Dotum' !important;}</pre>

그리고 save를 누르면 끝! 이후로는 99%의 페이지에서 위 글꼴들을 사용할 수 있을 거다.

## 사용자 스타일 시트를 사용한는 방법은 버전 33부터 없어졌다

크롬에서 직접 사용자 스타일을 넣는 방법이 있었는데, 어느 순간부터 없어졌다. ["User Stylesheet (Custom.css) support removed in Chrome 33"](https://www.reddit.com/r/chrome/comments/1ymfgw/user_stylesheet_customcss_support_removed_in/)를 보면 버전 33부터 없어졌다는 말이 있다. 

 [1]: #comment-749
 [2]: https://chrome.google.com/webstore/detail/plcnnpdmhobdfbponjpedobekiogmbco