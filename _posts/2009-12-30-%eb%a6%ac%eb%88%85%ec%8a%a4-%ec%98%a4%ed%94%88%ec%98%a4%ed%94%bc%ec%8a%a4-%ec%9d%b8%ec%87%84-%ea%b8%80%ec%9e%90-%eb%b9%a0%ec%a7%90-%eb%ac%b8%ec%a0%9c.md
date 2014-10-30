---
title: 리눅스 오픈오피스 인쇄 글자 빠짐 문제
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/180
aktt_notify_twitter:
  - yes
daumview_id:
  - 37164039
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투 사용자 모임과 오픈오피스 사용자 모임에 보면 해결되지 않은 문제가 한 가지 있다. 바로 우분투 환경의 오픈오피스에서 인쇄를 하면 글자가 한 자씩 빠져서 인쇄가 되는 문제다.(<a href="http://openoffice.or.kr/forums/viewtopic.php?p=9416" target="_blank">오픈오피스 게시판 : 심각한 인쇄 오류</a>, <a href="http://www.ubuntu.or.kr/viewtopic.php?p=15008" target="_blank">우분투 한국 사용자 모임 : 글자 빠지는 현상</a>) 쿠분투와 오픈수세에서도 같은 문제를 경험했다.

이해하기 쉽게 설명해 보자.

> 12월 29일, 이명박 정부는 몇 달 전부터 세상을 떠들썩하게 만들었던 삼성그룹 전 회장 이건희에 대한 사면을 마침내 단행했다.

위 문장을 출력한다고 하자. 그러면 아래처럼 인쇄가 된다.

> 12월 29일, 이명박 정부는 <span style="background-color: #ff0000;">  </span>달 전부터 세상을 떠들썩하게 만들었던 삼  그룹<span style="font-weight: bold; color: #ff0000;">성</span> 전 회장 이건희에 대한 사면을 마침내 단행했다.

뭐 인쇄 뻑날 걸 그냥 사진 찍어 올리는 게 가장 좋겠지만, 지금 집이라 프린터기가 없고;;

대충 어떤 현상인지는 알 수 있을 거라 생각한다. 위에서 빨간 표시한 부분이 인쇄 오류 부분인 건데, &#8216;몇&#8217; 자가 빠진 것을 알 수 있다. &#8216;성&#8217; 자는 엉뚱한 데로 가 있다.

이런 현상이 우분투, 쿠분투, 오픈수세에서 모두 발견됐다. 테스트 환경은, 우분투 9.04, 쿠분투 9.04, 오픈수세 11.1 + 오픈오피스 3.0 + 캐논 이미지러너 3300 + HP 레이저Jet 5100 이다.

## 해결책

현재 오픈오피스 쪽에서는 우분투 문제라고 생각하는 것 같다. 그런데 오픈오피스 쪽에서 말하길, 오픈수세에서는 인쇄가 잘 된다고 했다는데 내가 테스트한 바로는 오픈수세 11.1에서 같은 문제가 발생했다. 이건 뭥미. 오픈수세에서도 같은 문제가 발생하는 상황이므로 오픈오피스 문제인 거 아닌가 싶다.

해결책은 간단하다.

(**2010년 5월 9일 추가 사항** -> 해결책은 진짜 간단하다. **3.2로 업그레이드**하면 된다. 3.2 버전부터는 글자 빠짐 버그가 수정됐다.)

1.PDF로 뽑아서 PDF 인쇄를 하는 방법이 있다.

2.오픈오피스를 사용하지 말고 <a href="http://www-01.ibm.com/software/kr/lotus/symphony.html" target="_blank">IBM의 로터스 심포니 워드</a>를 사용하는 방법이 있다. 한글 언어팩 지원도 된다. 파일 두 개를 다운받아서 두 개 다 설치하면 된다. (링크 : <a href="http://myubuntu.tistory.com/entry/%EA%B7%B8%EA%B0%80-%EC%99%94%EB%8B%A4-IBM-%EB%A1%9C%ED%84%B0%EC%8A%A4-%EC%8B%AC%ED%8F%AC%EB%8B%88-13" target="_blank">로터스 심포니 설명</a> &#8211; 프리젠테이션에서 한글이 안 써진다고 하는데 워드, 프리젠테이션, 스프레드시트 모두에서 한글 입력 되는 것 확인했다.)

3.<a href="http://www.hancom.co.kr/downLoad.downPU.do?mcd=003" target="_blank">한글2008</a>만 쓴다.(우분투 9.04 이하 버전이어야 체험판 설치가 원활하다.)

## 오픈오피스는 포기하기 너무 아까운 프로그램

그러나 역시 오픈오피스는 아직까지는 무료 오피스 중에 최고의 기능을 자랑하는 프로그램이다.

예컨대, 사소한 거지만, 오픈오피스에서는 Ctrl+Shift+V 를 누르면 서식 없이 붙여넣기가 되지만, 심포니 워드에서는 편집 메뉴의 &#8216;선택하여 붙여넣기&#8217;를 골라야 합니다. 단축키가 없는 거죠. 그리고 간혹 가다가 서식없는 텍스트로 붙이면 글자가 깨져 나오는 경우가 생겨요.

그래서 저는 오픈오피스, 한글2008 체험판, 로터스 심포니를 막 섞어서 사용하고 있습니다;;

편집할 때는 오픈오피스, 한글 파일 열어야 할 때는 한글2008, 인쇄해야 할 때는 로터스 심포니를 사용하는 것이죠.