---
title: '[우분투:이클립스]숨김파일 보이게 하기(.htaccess 같은 거)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/592
aktt_notify_twitter:
  - yes
daumview_id:
  - 36925798
categories:
  - 개발 툴
tags:
  - Eclipse
---
.htaccess를 편집해야 하는데 이클립스에서 보이질 않아서 당황했다.  
그렇다고 외부에서 접속해서 고치면 svn이 충돌날 수도 있고 해서 좀 고민했다.(뭐, 반드시 충돌하는 것 같지는 않지만서도.)  
그래서 숨김파일을 볼 수 있도록 설정하는 게 있을 거라 생각하고 찾아봤다. 윈도우 프리퍼런스를 뒤져도 나오지 않았다. 검색해도 잘 안 나왔다.  
흐음&#8230; 그러던 중 발견!  
<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile29.uf.16705C514D4BC9401E611B.png" class="aligncenter" width="580" height="464" alt="" />왼쪽의 빨간 동그라미를 누르거나, 오른쪽의 빨간 동그라미 부분에 있는 메뉴로 들어가면 아래와 같은 화면을 만날 수 있다.  
<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile3.uf.144DBF4F4D4BC9412BA47E.png" class="aligncenter" width="372" height="605" alt="" />자자, 프로젝트 익스플로러에서 보기 싫은 파일 타입을 체크해 주면 되는데, 맨 위에 있는 게 숨김파일 부분이다.  
이걸 보고 싶으면 체크해제하면 되겠다. 이상.