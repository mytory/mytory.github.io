---
title: 우분투 9.10 grub 복구
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/278
aktt_notify_twitter:
  - yes
daumview_id:
  - 37087383
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
나는 노트북에서 우분투 9.10을 사용한다. 그런데 내 그래픽 드라이버인 chrome9 HC는 우분투 9.10에서 3D 가속 지원을 하지 않는다. HP2133 노트북이 내 노트북인 TGIC MX1530과 같은 칩셋을 사용한다는 <a href="http://www.ubuntu.or.kr/viewtopic.php?p=47451#p47451" target="_blank">이야기</a>를 듣고 3D 가속 사용법을 찾아 봤다. 영어권에는 이미 <a href="https://wiki.ubuntu.com/LaptopTestingTeam/HP2133" target="_blank">HP2133에서 우분투를 사용하는 법</a>이 잘 정리된 페이지가 있었다.

그런데 <a href="http://mytory.textcube.com/entry/via-chrome-9-리눅스-드라이버-설치를-위한-자료들" target="_blank">우분투 9.10에서는 3D 가속을 사용할 수 있는 방법이 없다</a>고 써 있었다.

그래서 9.10은 놔둔 채로 9.04, 8.10, 8.04를 설치했다. 차례대로 설치했는데, 모두 그래픽 드라이버를 잡는 데 실패했다. OTL;;

그런데 설치했던 우분투 하위버전들을 삭제하고 나면 grub이 망가지는 것이었다. 라이브 시디로 부팅한 후, 아래 명령어를 이용해서 복구했다.

sudo update-grub