---
title: 우분투 리눅스에서 윈도우용 무선랜 드라이버 설치하기
author: 안형우
layout: post
permalink: /archives/138
aktt_notify_twitter:
  - yes
daumview_id:
  - 37186617
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
내 노트북의 무선랜은 Atheros 5005G다. 한동안 무선랜이 잡히지 않아 엄청 고생했다. 윈도우랑 함께 사용하기에 망정이지 그렇지 않았으면 아예 인터넷을 못 할 뻔했다.

그런던 중 윈도우용 무선랜 드라이버를 리눅스에 설치해서 사용할 수 있는 프로그램알 알게 됐다.

그리고 설치해서 무선랜을 잡는 데 성공했다.

설치할 프로그램은 총 세 개다.

일단 시냅틱 패키지 관리자에 들어간다. atp-get으로 설치해도 되는데, 명령어를 따로 쓰지는 않겠다. 아래 세 개를 설치하면 된다.

<img src="/uploads/legacy/old-images/1/cfile22.uf.146E40514D4BC8751FC9AA.png" class="aligncenter" width="580" height="196" alt="" />

전체 화면을 보고 싶은 사람도 있을 것 같아 가로로 넓게 첨부했다. 클릭하면 커진다.

설치할 패키지는, ndisgtk, ndiswrapper-utils-1.9, ndiswrapper-common 이다.

ndisgtk만 설치표시하고 적용 버튼을 누르면 나머지 두 개를 함께 설치하게 된다. 의존성 때문이다.

설치를 마치면 시스템 &#8211; 관리 &#8211; Windows Wireless Drivers 를 연다.

<img src="/uploads/legacy/old-images/1/cfile24.uf.146D0B504D4BC8750E6713.png" class="aligncenter" width="381" height="208" alt="" />

클릭하면 아래와 같은 화면이 나온다. 당연히 Install New Driver를 누르면 되겠다.

<img src="/uploads/legacy/old-images/1/cfile28.uf.170D12534D4BC87504C4F6.png" class="aligncenter" width="460" height="282" alt="" />

그러면 아래와 같은 화면이 나온다. 당연히 드라이버 위치를 뜻하는 Location을 눌러 준다. 없음이라고 표시돼 있다고 당황할 필요 없다.

<img src="/uploads/legacy/old-images/1/cfile2.uf.162E83484D4BC875243D57.png" class="aligncenter" width="360" height="159" alt="" />

누르면 파일 탐색기가 뜬다. 미리 받아 둔 무선랜 드라이버가 있는 폴더로 이동해서 inf 파일을 선택해 준다. 나 같은 경우는 <a href="http://mytory.textcube.com/entry/%EC%95%84%EB%8D%B0%EB%A1%9C%EC%8A%A4-atheros-%EB%AC%B4%EC%84%A0%EB%9E%9C-%EB%93%9C%EB%9D%BC%EC%9D%B4%EB%B2%84" target="_blank">Atheros 5005G에 해당하는 드라이버</a>다. 윈도우XP 32bit(대부분 32bit라고 보면 된다.)용 드라이버를 다운받았다.

<img src="/uploads/legacy/old-images/1/cfile7.uf.1779EF544D4BC8751D7C5D.png" class="aligncenter" width="580" height="452" alt="" />

창의 타이틀부터 Select inf File이다. 당연히 inf를 골라 줘야 한다. 나는 inf가 두 개 있어서 헷갈렸는데 그냥 과감하게 하나 골라잡았다.

inf를 더블클릭하고 진행하면 된다. 그러면 아래처럼 설치된 화면을 만날 수 있고, 무선랜이 잡히기 시작한다.

<div style="width: 470px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile7.uf.12480B4C4D4BC87630ACD9.png" width="460" height="282" alt="" /><p class="wp-caption-text">
    △netathw라는 이름의 드라이버가 설치된 것을 볼 수 있다.
  </p>
</div>

<div style="width: 251px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile26.uf.124CF54C4D4BC87628CD5E.png" width="241" height="275" alt="" /><p class="wp-caption-text">
    △무선 네트워크 iptime이 잡히기 시작했다. 완전 감동이다.
  </p>
</div>