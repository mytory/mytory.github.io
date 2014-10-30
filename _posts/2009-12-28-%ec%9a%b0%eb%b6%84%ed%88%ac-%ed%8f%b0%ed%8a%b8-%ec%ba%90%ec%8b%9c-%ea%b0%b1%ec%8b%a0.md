---
title: 우분투 폰트 캐시 갱신
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/166
aktt_notify_twitter:
  - yes
daumview_id:
  - 37169494
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투에서 폰트를 설치하면 캐시를 갱신해 줘야 한다.

가장 간단한 방법은 로그아웃했다가 들어오는 것이지만 귀찮다.

터미널을 열어 다음 명령을 써 주면 된다.

sudo fc-cache -f -v