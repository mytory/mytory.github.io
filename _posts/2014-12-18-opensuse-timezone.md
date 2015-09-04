---
title: "오픈수세에서 시간이 안 맞는 현상 수정"
layout: "post"
category: "etc"
tags: "linux"
---

[2015-02-17에 추가한 내용]

`sudo su`로 `root`로 로그인한 뒤, 아래 명령어로 시각을 맞췄다.

    ntpdate ntp1.epidc.co.kr

`ntp1.epidc.co.kr`은 한국의 시간 서버다. `whois`로 검색해 보니 세종 텔레콤이
보유한 도메인이다. 세종 텔레콤이 뭐 하는 덴지는 나도 모른다.

그리고 재부팅. 

그리고 자꾸 GUI 시각이 안 맞아서 yast2의 Date and Time에 가서
그냥 서버 동기화를 해제해 버렸다(Other SEtting에 있었나?). 좀더 지켜보며
부작용이 없는지 살펴 볼 예정이다.

이렇게 하니 시간이 아주 잘 맞는다. 
