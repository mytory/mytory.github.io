---
title: 마우스 키보드 공유 프로그램, Synergy가 갑자기 작동하지 않을 때 체크할 것
author: 안형우
layout: post
permalink: /archives/10098
daumview_id:
  - 44353835
categories:
  - 기타
tags:
  - Program
---
Synergy가 갑자기 작동을 하지 않았다. 정상적으로 접속도 다 됐는데 말이다.

log level을 debug로 바꾸고 log를 보고서야 알 수 있었다. 로그에 아래처럼 나왔다.

<pre>locked to screen</pre>

스크린에 갇혔다고? 왜? [검색해 봤다. 나왔다.][1]

Scroll Lock 키가 눌려 있기 때문이었다. 대체 이 키는 뭐에 쓰는 물건인데 이럴 때만 사람 귀찮게 만드는 거야?!

여튼 그거 한 번 눌러주니 잘 된다. 끝!

 [1]: http://blog.ajperrins.com/2011/10/synergy-locked-to-screen.html