---
title: '[우분투] 다운로드 없이 iso 파일로 배포판 업그레이드하기'
author: 안형우
layout: post
permalink: /archives/553
aktt_notify_twitter:
  - yes
daumview_id:
  - 36960566
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
좀 헤맸다. <div>
  일단 alternate 버전의 우분투 iso를 다운받는다.
</div>

<div>
  그리고 gisomount를 시냅틱 패키지 관리자에서 설치하거나, sudo apt-get install gisomount 명령어로 설치한다.
</div>

<div>
  프로그램 > 시스템 도구 > gISOMount 를 실행한다.
</div>

<div>
  거기서 다운받은 우분투 alternate iso를 선택하고 마운트한다.
</div>

<div>
  alt+F2 를 눌러 실행창을 부르거나 터미널을 연 후 gksu nautilus를 입력해서 노틸러스를 관리자 권한으로 연다.
</div>

<div>
  좌측에 보면 마운트한 cd가 보일 거이다. 그리로 가면 cdromupgrade라는 파일이 있다. 더블클릭해 준다.
</div>

<div>
  그러면 실행할 수 있는 파일이라면서 터미널에서 실행 / 보기 / 실행 이런 창이 뜬다. 실행을 눌러 준다. 그러면 업그레이드 시작.
</div>