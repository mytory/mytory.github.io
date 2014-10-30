---
title: '크롬에서 모든 웹사이트 글꼴을 &#8220;맑은 고딕&#8221;이나 &#8220;나눔고딕&#8221;으로 만들기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1262
aktt_notify_twitter:
  - yes
daumview_id:
  - 36716117
mytory_md_path:
  - 
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

## 까다롭지만 강력한 방법(2011-06-16 추가)

크롬에서 기본으로 제공하는 사용자 스타일시트(User StyleSheets)를 편집하는 방법이다. 이건 [한가람님이 댓글로 알려 주신 방법][1]이라 뒤늦게 추가한다. 댓글을 그대로 인용하겠다.

> C:\Users\[계정]\AppData\Local\Google\Chrome\User Data\Default\User StyleSheets\Custom.css를 편집하는 방법도 있습니다.

{계정} 이라고 써 있는 건 자신의 계정 이름을 의미한다. 나 같은 경우는 윈도우 계정 이름이 mytory다. 그러니 나를 기준으로 한다면 아래와 같은 경로에 파일이 있을 거다.

<pre>C:\Users\mytory\AppData\Local\Google\Chrome\User Data\Default\User StyleSheets\Custom.css</pre>

또한 탐색기로 볼 때 Users 폴더는 &#8216;사용자&#8217;라는 이름으로 나오므로 거기로 가면 된다. AppData는 숨김파일 보기를 해도 보이지 않으므로 그냥 탐색기의 주소표시줄에 직접 적어야 한다. 저 파일을 열기 위해 까다로운 절차를 거치게 되기 때문에 초보들에겐 어려울 거다.

다른 방법도 있다. 이게 가장 쉬울 거다.

일단 크롬 아이콘을 찾는다. 마우스 우클릭을 해서 속성을 연다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/icon-property.png" width="354" height="512" />
</p>

속성을 연 다음 아래처럼 &#8220;파일 위치 열기&#8221;를 고른다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/property.png" width="435" height="480" />
</p>

그러면 크롬의 폴더로 직행할 수 있다. 위 항목을 눌렀을 때 열리는 폴더는 크롬의 실행 파일이 있는 폴더이다. 아래 그림처럼 말이다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/exe-file-folder.png" width="640" height="436" />
</p>

여기서 한 단계 위로 올라가 줘야 한다. Chrome 이라는 폴더로 이동하라는 말이다. 그 다음 Chrome 하위의 User Data/Default/User StyleSheets 폴더로 이동해 준다. 그러면 아래 그림처럼 Custom.css 파일을 만날 수 있다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/user-stylesheet.png" width="640" height="436" />
</p>

그 다음엔 이 파일을 연다. 메모장으로 열면 된다.

파일을 연 후에는 아래 코드를 적어 넣으면 된다. 아마 처음 파일을 열면 그냥 빈 파일일 거다.

<pre>*{font-family: Arial, '맑은 고딕', 'Malgun Gothic','나눔고딕', 'Nanumgothic','함초롬 바탕', 'HCR Batang','함초롬 돋움', 'HCR Dotum' !important;}</pre>

파일을 여는 건 그냥 텍스트 편집기면 된다. 단, 메모장을 사용하는 경우라면 한글은 빼고 영문만 쓰기 바란다. 

맨 앞에 Arial을 적은 이유는, 영문은 Arial로 표현되게 하기 위한 것이다.

## 쉽지만 약한 방법

쉽지만 약한 방법은 확장 기능을 설치하는 것이다. 애초에 내가 생각한 것도 확장 프로그램을 찾는 것이기도 했다.

크롬 확장 중 반드시 그런 게 있을 거라 생각했고, 찾았다. custom css 라고 검색했더니 나왔다. 이름하여 [Personalized Web][2]이다.

이놈을 설치한 후, 브라우저 오른쪽 상단의 공구모양 아이콘 <img class="alignnone" alt="" src="http://www.google.com/help/hc/images/chrome_toolsmenu.gif" width="29" height="29" />을 누른 후 **도구 > 확장 프로그램**을 선택한다. 그러면 설치된 확장 프로그램들이 나오는데, 거기서 Personalized Web 을 찾아 **&#8216;옵션&#8217;**을 누른다. 그러면 아래 같은 설정을 할 수 있다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/personalized-web.png" width="640" height="273" />
</p>

Rule name은 본인이 원하는대로 사용하고 Match URLs는 그대로 둔다. Add CSS 에 다음 코드를 집어 넣는다.

<pre>*{font-family:'맑은 고딕', 'Malgun Gothic','나눔고딕', 'Nanumgothic','함초롬 바탕', 'HCR Batang','함초롬 돋움', 'HCR Dotum' !important;}</pre>

그리고 save를 누르면 끝! 이후로는 99%의 페이지에서 위 글꼴들을 사용할 수 있을 거다.

 [1]: #comment-749
 [2]: https://chrome.google.com/webstore/detail/plcnnpdmhobdfbponjpedobekiogmbco