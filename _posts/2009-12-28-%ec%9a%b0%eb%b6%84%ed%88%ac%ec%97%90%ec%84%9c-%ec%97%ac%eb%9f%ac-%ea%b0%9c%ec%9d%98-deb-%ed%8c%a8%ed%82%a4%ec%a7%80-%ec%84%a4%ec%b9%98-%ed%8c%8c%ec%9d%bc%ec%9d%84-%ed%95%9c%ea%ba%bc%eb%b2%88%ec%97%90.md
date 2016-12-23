---
title: 우분투에서 여러 개의 deb 패키지 설치 파일을 한꺼번에 설치하고 싶다면
author: 안형우
layout: post
permalink: /archives/167
aktt_notify_twitter:
  - yes
daumview_id:
  - 37168252
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투에서 deb 패키지 설치 파일이 많을 때 일일이 더블클릭해 설치 버튼을 누르는 것은 번거로운 일이다. <div>
  다음 명령어를 활용하면 간편하게 할 수 있다.
</div>

<div>
  터미널에서 해당 설치파일이 있는 폴더로 간다. 그리고 아래 명령어를 쓰고 엔터.
</div>

<div>
  sudo dpkg -i *.deb
</div>

<div>
  [덧1]시냅틱 패키지 관리자가 열려 있거나 다른 프로그램을 설치하고 있다면 설치가 안 되니 주의하라.
</div>

<div>
  [덧2]dpkg는 아마 gnome을 사용하는 리눅스에서 공통으로 사용되는 명령어일 듯하다. 그러나 나는 일단 우분투에서만 사용해 봤기 때문에 우분투라고 썼다.
</div>

<div>
  [덧3]이 명령어와 쉘 스크립트를 활용해 여러 개의 패키지를 한꺼번에 설치하는 실행파일을 만들려면 다음 글을 참고하라 : <a href="http://mytory.textcube.com/entry/%EC%9A%B0%EB%B6%84%ED%88%AC%EC%97%90%EC%84%9C-%EC%89%98-%EC%8A%A4%ED%81%AC%EB%A6%BD%ED%8A%B8sh%EB%A5%BC-%EC%9D%B4%EC%9A%A9%ED%95%B4-%EC%97%AC%EB%9F%AC-%EA%B0%9C%EC%9D%98-%EC%84%A4%EC%B9%98-%ED%8C%8C%EC%9D%BC%EC%9D%84-%ED%95%9C%EA%BA%BC%EB%B2%88%EC%97%90-%EC%84%A4%EC%B9%98%ED%95%98%EB%8A%94-%EC%8B%A4%ED%96%89-%ED%8C%8C%EC%9D%BC%EC%9D%84-%EB%A7%8C%EB%93%A4%EB%A0%A4%EA%B3%A0-%ED%95%9C%EB%8B%A4%EB%A9%B4" target="_blank">우분투에서 쉘 스크립트(sh)를 이용해 여러 개의 설치 파일을 한꺼번에 설치하는 실행 파일을 만들려고 한다면</a>
</div>