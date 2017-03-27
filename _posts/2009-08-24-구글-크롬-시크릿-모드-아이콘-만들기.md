---
title: 구글 크롬 시크릿 모드 아이콘 만들기
author: 안형우
layout: post
permalink: /archives/23
aktt_notify_twitter:
  - yes
daumview_id:
  - 37266590
categories:
  - 기타
tags:
  - TIP
---
아이콘 속성으로 들어간다.

실행에 맨 뒤쪽에다가 &#8211;incognito를 써 준다.

만약 실행파일이 chrome.exe라면 다음과 같이 될 것이다.

**&#8220;**(앞부분 생략)chrome.exe<span style="color: rgb(255, 0, 0); "><strong>&#8220;</strong></span><span style="background-color: rgb(255, 255, 0); ">&nbsp;</span>**&#8211;incognito**

중요한 것은 노란색이다. 반드시 한 칸 띄워야 한다는 의미로 저렇게 표시했다. 그리고 빨간표시를 한 따옴표로 눈여겨 보라. 실행파일 부분을 따옴표로 감싸야 한다는 것을 강조하기 위해 저렇게 표시했다. 아마도 이미 따옴표로 감싸여 있을 텐데, 그렇지 않은 경우라면 직접 따옴표로 감싸 줘라.

만약 두 개의 명령을 사용한다면 다음처럼 하면 된다.

**&#8220;**(앞부분 생략)chrome.exe<span style="color: rgb(255, 0, 0); "><strong>&#8220;</strong></span><span style="background-color: rgb(255, 255, 0); ">&nbsp;</span>**&#8211;incognito<span style="background-color: rgb(255, 255, 0); ">&nbsp;</span>&#8211;enable-plugins**

<span class="Apple-style-span" style="background-color: rgb(255, 255, 255);">(&#8211;enable-plugins는 플러그인을 활성화하는 명령어다. 아마 윈도우 버전 크롬에선 기본으로 활성화돼있을 테니 필요가 없을 것.)</span>