---
title: Chromium 브라우저 윈도우용 다운로드/설치하기
author: 안형우
layout: post
permalink: /archives/1384
aktt_notify_twitter:
  - yes
daumview_id:
  - 36709943
categories:
  - 기타
tags:
  - TIP
---
크로미움은 구글 크롬의 기반이 되는 오픈소스 브라우저 프로젝트다. 그래서 누구나 무료로 사용할 수 있다. 소스코드가 공개돼 있기 때문에 누구나 소스를 살펴볼 수도 있을 것이다. 물론 나는 봐도 뭔지 모른다. 난 웹 개발자다.

여튼, 크롬이 요새 자꾸 버벅대는 느낌이라 크로미움을 깔아 볼까 하는 생각을 하게 됐다. 아무래도 크롬의 프로토타입(?)이다 보니 버전도 높고 빠르기도 빠를 거라는 기대 때문이다.

그래서 [크로미움 공식 사이트][1]에 들어가 봤더니 구글 크롬을 다운로드할 수 있는 링크만 안내돼 있고 크로미움을 다운로드할 수 있는 방법은 없는 것이었다.

이 경우는 차라리 우분투 리눅스가 설치하기 쉽구나 하는 생각을 했다. 우분투 리눅스에서 크로미움을 설치하는 것은 클릭 몇 번으로 해결되기 때문이다.

여튼간에 역시 또 구글에게 물어봐서 찾을 수 있었다.

소개돼 있는 곳은 [Chromium Browser Download for Windows][2] 였고, 방법은 간단했다.

[크로미움을 데일리 빌드 폴더 모음][3]으로 들어간다.

그러면 숫자 폴더만 주구장창 있는데 신경쓸 거 없다. 맨 밑에 있는 놈이 최신버전이다.

나 같은 경우는 [90030 폴더][4]가 최신버전이었는데, 이 글을 보는 여러분들은 그거보다 더 큰 숫자를 다운받으면 되겠다.

다운받을 파일은 chrome-win32.zip 이다. 나머지는 무시한다.

나는 64bit 윈도우를 사용하기 때문에 64비트용은 없나 살펴봤는데 없다. 그냥 32비트용을 다운받는다.

그리고 Program Files 폴더에 풀면 끝이다.

실행 파일은 chrome.exe 니까 단축 아이콘 같은 건 알아서 만든다.

 [1]: http://www.chromium.org/
 [2]: http://ianchanning.wordpress.com/2011/06/14/chromium-browser-download-for-windows/
 [3]: http://commondatastorage.googleapis.com/chromium-browser-continuous/index.html?path=Win/
 [4]: http://commondatastorage.googleapis.com/chromium-browser-continuous/index.html?path=Win/90030/