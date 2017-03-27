---
title: 미친듯이 느린 IT World 웹사이트 빠르게 만들기
author: 안형우
layout: post
permalink: /archives/11791
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/11791-itworld.md
daumview_id:
  - 51226166
categories:
  - 기타
tags:
  - TIP
---
[IT World Korea][1]는 볼 만한 기사가 많이 올라오는 괜찮은 웹사이트다. 그런데 사이트 제작을 어떻게 한 건지 미친듯이 느리다. 덕지덕지 붙어있는 소셜 관련 자바스크립트들 때문이다. 내 개발용 컴의 크롬에서 사이트가 느리면 대체 어쩌자는 건가.

그래서 자바스크립트를 끄고 들어갔더니 첫 화면의 윗부분을 투명 레이어가 덮어 버려서 주요 기사들이 클릭이 안 되는 사태가 벌어진다. 난감하다.

여튼, 그래서 AdBlock 필터에 규칙을 추가하는 걸로 해결해 버렸다. AdBlock 옵션 페이지에 가서 &#8216;사용자 필터&#8217;로 간 다음 직접 편집하면 된다.

    abc.idg.co.kr/node.js$domain=www.itworld.co.kr
    twitter$domain=www.itworld.co.kr
    facebook$domain=www.itworld.co.kr
    linkedin/in.js$domain=www.itworld.co.kr
    fbstatic-a$domain=www.itworld.co.kr
    addthis$domain=www.itworld.co.kr
    googleusercontent.com/static/fonts/earlyaccess/nanumgothic$domain=www.itworld.co.kr
    

차단한 URL을 보면 대충 알겠지만, 트위터 페이스북, 링크드인, 애드디스, 나눔고딕 웹폰트 이런 거 다 막아 버렸다. 이상.

 [1]: http://www.itworld.co.kr/