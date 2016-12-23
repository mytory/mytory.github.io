---
title: '[링크]WTP의 Server View 사용하기'
author: 안형우
layout: post
permalink: /archives/262
aktt_notify_twitter:
  - yes
daumview_id:
  - 37104599
categories:
  - 개발 툴
tags:
  - Eclipse
---
디플로이할 때 임시 디렉토리에 하지 않는 방법을 설명한 글이다. 내용은 잘 모르겠다. 해봤는데 잘 안 된다. 나중에 다시 하기 위해 갈무리.

<a href="http://aircook.tistory.com/entry/WTP%EC%9D%98-Server-View-%EC%82%AC%EC%9A%A9%ED%95%98%EA%B8%B0" target="_blank">WTP의 Server View 사용하기</a>

> depoly를 .metadat\.plugins\org.eclipse.wst.server.core#tmp~ 이쪽으로 하는문제(이게 파일이 많아지면 너무 느리고 가끔씩 에러가 나와서요)는 그냥 속편하게 Server Option에서 Serve modules without publishing 해버리시면 편합니다. 이렇게 하면 파일 복사 안하고 workspace의 자원을 가지고 tomcat이 돌아갑니다.

그리고 블로그 말 중에 이게 참고할 만하다.