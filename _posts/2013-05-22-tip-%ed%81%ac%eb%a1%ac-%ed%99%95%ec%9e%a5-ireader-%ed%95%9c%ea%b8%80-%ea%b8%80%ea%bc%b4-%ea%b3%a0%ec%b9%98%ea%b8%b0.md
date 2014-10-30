---
title: '[TIP] 크롬 확장, iReader 한글 글꼴 고치기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10219
daumview_id:
  - 45025987
mytory_md_path:
  - 
categories:
  - 기타
tags:
  - TIP
---
크롬 확장인 iReader는 본문만 뽑아서 글을 읽을 수 있게 해 주는 좋은 녀석이다. 그런데 문제는 한글 글꼴이 굴림으로 나온다는 점이다. 고를 수 있는 글꼴 목록에 한글 글꼴은 있지도 않다. 안 되면 직접 쓰게라도 해 주던가!

여튼, 나는 퍼블리싱을 해야 하니 모든 웹사이트의 글꼴을 맑은 고딕으로 만들 수는 없고 iReader의 글꼴만 맑은 고딕으로 만들고 싶은데, 방법이 없나 하던 찰나, 크롬의 유저 스타일시트에 iReader의 선택자만 넣어서 맑은 고딕으로 만들면 되겠다 하는 생각이 들었다. 그래서 유저 스타일시트에 이렇게 넣었다.

<pre>#articleContainer #article .page .contentWrapper * {
  font-family: Arial, "Malgun Gothic", "맑은 고딕";
}</pre>

영어는 Arial로, 한글은 맑은 고딕으로 나오게 된다. 윈도우 메모장에서 편집할 때는 한글로 쓴 글꼴 이름은 넣지 않는 게 나을 거다. 한글 글꼴명을 적을 거면 Sublime Text 2나 Editplus 같은 프로그램을 사용해 UTF-8 형식으로 파일을 저장해야 한다.

크롬의 유저 스타일시트를 찾는 방법은?

[아래 경로에 가면 크롬의 유저 스타일시트가 있다.]

<pre>C:\Users\[계정]\AppData\Local\Google\Chrome\User Data\Default\User StyleSheets\Custom.css</pre>

찾는 더 자세하고 쉬운 방법은 아래를 참고. [&#8220;크롬에서 모든 웹사이트 글꼴을 “맑은 고딕”이나 “나눔고딕”으로 만들기&#8221;][1]의 일부를 인용한 거다.

&#8212;&#8212;&#8212;&#8212;&#8211;

> [계정] 이라고 써 있는 건 자신의 계정 이름을 의미한다. 나 같은 경우는 윈도우 계정 이름이 mytory다. 그러니 나를 기준으로 한다면 아래와 같은 경로에 파일이 있을 거다.
> 
>     C:\Users\mytory\AppData\Local\Google\Chrome\User Data\Default\User StyleSheets\Custom.css
> 
> 또한 탐색기로 볼 때 Users 폴더는 ‘사용자’라는 이름으로 나오므로 거기로 가면 된다. AppData는 숨김파일 보기를 해도 보이지 않으므로 그냥 탐색기의 주소표시줄에 직접 적어야 한다. 저 파일을 열기 위해 까다로운 절차를 거치게 되기 때문에 초보들에겐 어려울 거다.
> 
> 다른 방법도 있다. 이게 가장 쉬울 거다.
> 
> 일단 크롬 아이콘을 찾는다. 마우스 우클릭을 해서 속성을 연다.
> 
> <img alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/icon-property.png" width="354" height="512" />
> 
> 속성을 연 다음 아래처럼 “파일 위치 열기”를 고른다.
> 
> <img alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/property.png" width="435" height="480" />
> 
> 그러면 크롬의 폴더로 직행할 수 있다. 위 항목을 눌렀을 때 열리는 폴더는 크롬의 실행 파일이 있는 폴더이다. 아래 그림처럼 말이다.
> 
> <img alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/exe-file-folder.png" width="640" height="436" />
> 
> 여기서 한 단계 위로 올라가 줘야 한다. Chrome 이라는 폴더로 이동하라는 말이다. 그 다음 Chrome 하위의 User Data/Default/User StyleSheets 폴더로 이동해 준다. 그러면 아래 그림처럼 Custom.css 파일을 만날 수 있다.
> 
> <img alt="" src="http://dl.dropbox.com/u/15546257/blog/mytory/chrome-font/user-stylesheet.png" width="640" height="436" />
> 
> 그 다음엔 이 파일을 연다. 메모장으로 열면 된다.

 [1]: http://mytory.local/archives/1262 "크롬에서 모든 웹사이트 글꼴을 “맑은 고딕”이나 “나눔고딕”으로 만들기"