---
title: 우분투에서 USB 부팅디스크 만들기
author: 안형우
layout: post
permalink: /archives/276
aktt_notify_twitter:
  - yes
daumview_id:
  - 37089155
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투는 언제부터인지는 모르겠지만, **시스템 > 관리 > USB 부팅 디스크 생성** 이라는 항목을 제공한다. 이걸 이용할 수 있는 사람들은 이용하면 된다.

하지만 왠일인지 나는 이 항목으로 만들면 &#8216;설치 실패&#8217;만 뜰 뿐이었다. 혹시나 해서 포맷을 하면 USB만 망가질 뿐이었다. (물론 윈도우에서 다시 포맷하면 됐다.)

관리자 권한이 없어서라는 이야기를 보고 sudo usb-creator-gtk 명령을 터미널에 입력해서 관리자 권한을 얻은 다음에 시도해 보기도 했지만, 역시 안 됐다.

결국 <a href="http://unetbootin.sourceforge.net/" target="_blank">UNetbootin 이라는 프로그램</a>을 사용해서 해결할 수 있었다. 이건 윈도우 리눅스 모두에서 작동하는 프로그램이다. 윈도우에서 만들 사람들은 UNetbootin 홈페이지에서 윈도우용 프로그램을 설치한 다음 메뉴 보고 알아서 하면 된다. 알아서 할 수 있을 거라 생각한다.

문제는 리눅스에서 만들 사람들인데, 나 같은 초보 입장에서는 달랑 unetbootin-linux-408 라는 파일 하나만 다운로드된 걸 보고 어떻게 하라는 소린지 알 수가 없었다;;

그래서 그냥 시냅틱 패키지 관리자를 이용하기로 했다. <a href="https://launchpad.net/~gezakovacs/+archive/ppa" target="_blank">UNetbootin의 우분투 패키지 페이지</a>로 갔다. 여기에는 소프트웨어 소스의 주소를 제공한다. 이걸 소프트웨어 소스에 추가하면 된다.

일단 **시스템 > 관리 > 소프트웨어 소스** 에 들어가서 기타 소프트웨어에서 추가 버튼을 누른다.

<img src="/uploads/legacy/old-images/1/cfile3.uf.121F15494D4BC8900B5066.png" class="aligncenter" width="459" height="507" alt="" />

기타 소프트웨어는 영어로는 third party software다 알아 둬라.

차, 추가를 두 개 해야 한다. 한 번 눌러서 아래 두 줄 중 윗줄 걸 입력하고, 다시 추가 눌러서 아랫줄을 입력한다. 아래 두 줄을 각각 추가해야 한다는 얘기다.

<pre class="brush:plain">deb http://ppa.launchpad.net/gezakovacs/ppa/ubuntu karmic main
deb-src http://ppa.launchpad.net/gezakovacs/ppa/ubuntu karmic main</pre>

그리고서 닫기를 하면 소프트웨어 목록이 오래됐다며 새로 읽겠다고 한다. 그러라고 해야 한다.

그리고 시냅틱 패키지 관리자를 켜서 unetbootin으로 검색하면 나온다. 설치하면 된다.

설치 후에는 **프로그램 > 시스템 도구 > UNetbootin** 에서 찾을 수 있다.