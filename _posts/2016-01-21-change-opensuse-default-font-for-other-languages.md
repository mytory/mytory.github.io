---
title: 오픈수세에서 시스템 기본 글꼴 변경하기
layout: post
categories:
  - linux
tags:
  - opensuse
---

오픈수세를 사용한지 1년 9개월이 됐다. 그 사이 버전도 13.2로 올렸다. 

애초에 오픈수세 설치 직후 엉망인 한글 폰트를 나눔고딕으로 변경하느라고 꽤 애를 썼다. 그런데 그 뒤 [KoPub서체](http://www.kopus.org/biz/electronic/font.aspx)라는 좋은 글꼴을 알게 됐다. 시스템 기본 글꼴을 KoPub 서체로 변경하려고 했는데, 웬걸 어떻게 바꿨는지 기억이 나야 말이지.

Configure Desktop > Fonts 에선 영문 글꼴만 변경할 수 있고, 세리프와 산세리프 구분도 할 수 없다. 

여러 차례 시도 끝에 오늘 방법을 알았다. 정교한 방법은 아니다. 그냥 의심가는 걸 다 고쳤다;;

`/etc/fonts/conf.d` 폴더에 가서 `40-nonlatin.conf`, `60-family-prefer.conf`, `65-nonlatin.conf` 파일 안에 들어간다. 그리고 규칙대로 원하는 폰트를 넣어 준다. 나 같은 경우는 세리프에 `KopubBatang Light`, 산세리프에 `KopubDotum Light`를 넣었다. 그리고 로그아웃했다가 로그인하니, 와우~! 그리 속썩이던 시스템 글꼴 문제 해결~! 코펍돋움 폰트로 기본 글꼴 변경에 성공했다. 

아, 참고로 고정폭 글꼴은 [D2Coding](http://dev.naver.com/projects/d2coding/download)으로 했다.