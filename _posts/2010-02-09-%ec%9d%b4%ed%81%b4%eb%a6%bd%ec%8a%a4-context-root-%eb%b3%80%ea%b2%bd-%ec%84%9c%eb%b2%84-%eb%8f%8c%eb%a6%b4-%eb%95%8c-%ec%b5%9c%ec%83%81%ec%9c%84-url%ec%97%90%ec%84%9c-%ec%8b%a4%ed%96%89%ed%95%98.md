---
title: '이클립스 context root 변경 &#8211; 서버 돌릴 때 최상위 url(/)에서 실행하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/261
aktt_notify_twitter:
  - yes
daumview_id:
  - 37105694
categories:
  - 개발 툴
tags:
  - Eclipse
---
이클립스에서 프로젝트를 만들고 톰캣에서 테스트할 때 http : //localhost:8080/프로젝트명/ 형태로 돼 있는게 아주 짜증날 거다. 실제로 홈페이지를 붙이면 http: //내도메인.com/ 이니깐. HTML 태그에서 href=&#8221;/&#8221; 형태를 개발 당시에 사용하지 못하니깐 아주 짜증난다. 붙인 다음에 일일이 수정해줄 수도 없고.

의외로 해결책은 간단했다.

두 가지 방법이 있다.

1.  프로젝트에서 마우스 오른쪽 버튼을 눌러 preference로 들어가서 Web Project Setting 란의 Context Root를 공란으로 만든다.
2.  Server 프로젝트에 있는 server.xml의 docBase를 &#8220;프로젝트명/&#8221;으로, path를 &#8220;&#8221;으로 만든다.

둘 중 하나의 방법을 사용하면 간단하게 해결 된다.