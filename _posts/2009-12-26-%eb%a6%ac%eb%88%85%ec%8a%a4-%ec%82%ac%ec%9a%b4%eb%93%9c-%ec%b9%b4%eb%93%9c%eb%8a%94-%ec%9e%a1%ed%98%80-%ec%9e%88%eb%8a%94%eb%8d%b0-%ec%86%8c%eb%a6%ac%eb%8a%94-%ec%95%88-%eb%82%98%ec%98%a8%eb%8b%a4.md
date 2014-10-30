---
title: 리눅스 사운드 카드는 잡혀 있는데 소리는 안 나온다면(엄청 작게 나온다면)
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/160
aktt_notify_twitter:
  - yes
daumview_id:
  - 37174845
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투 9.10으로 업그레이드한 이후 사운드가 나오질 않았다. 처음에는 사운드 카드를 못 잡는 것이라고 생각했다. 무선랜은 못 잡았기 때문이다.(<a href="http://mytory.textcube.com/entry/우분투에서-윈도우용-무선랜-드라이버-설치하기" target="_blank">무선랜은 윈도우 드라이버를 사용해서 해결했다.</a>) 그래서 드라이버를 찾아 헤맸다.(<a href="http://mytory.textcube.com/entry/리눅스용-사운드카드-드라이버-구할-수-있는-곳" target="_blank">리눅스용 사운드카드 드라이버 구할 수 있는 곳</a>) 그런데 그런 문제가 아니었다. 음악을 틀어 보니 소리는 났다. 그런데 아주 작게 난 것이 문제였다.

우분투 한국 사용자 포럼에도 도움이 되는 글을 발견했다 &#8211; <a href="http://ubuntu.or.kr/viewtopic.php?p=12073#p12073" target="_blank">Re:사운드 크기가 너무 작습니다</a>

그래서 따라해 봤더니 금세 해결이 됐다.

방법은 간단하다. 일단 터미널을 열고 다음 명령어를 입력한다.

alsamixer

그러면 아래와 같은 화면이 뜬다.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile29.uf.12778A544D4BC8791F6523.png" class="aligncenter" width="580" height="486" alt="" />

나는 Master F 가 최소로 돼 있었다. 이걸 최대로 조정해버렸다.

그래서 깔끔하게 해결.

MP3를 재생시켜 놓고 조절했다. 변경시키면 소리 크기가 변하는 걸 실시간으로 들을 수 있으니 재생시켜 놓고 변경을 하면 편리할 것이다.

## Alsa Mixer 설정 종료하고 나오는 방법

설정 종료하고 나오는 방법을 몰라서 좀 당황했는데, 그냥 터미널 끄면 되는 것 같다. 불안하면 Ctrl+Z 눌러서 프로그램 정지시키고 나오면 된다. 설정은 날아가지 않는다.