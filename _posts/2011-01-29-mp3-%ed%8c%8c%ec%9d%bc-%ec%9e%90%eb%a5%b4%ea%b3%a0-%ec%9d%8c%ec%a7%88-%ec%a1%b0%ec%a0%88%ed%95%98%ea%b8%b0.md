---
title: mp3 파일 자르고 음질 조절하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/822
aktt_notify_twitter:
  - yes
daumview_id:
  - 36765738
categories:
  - 기타
tags:
  - Program
---
150mb짜리 mp3 파일을 웹에 올려야 하는 일이 생겼다.

일단 앞뒤를 잘라야 했고, 음질을 다운시켜 용량을 줄이기로 했다.

구글링해 보니 간단한 프로그램들이 나왔는데,

일단 앞뒤를 자르는 데는 <a href="http://mpesch3.de1.cc/mp3dc.html" target="_blank" title="[http://mpesch3.de1.cc/mp3dc.html]로 이동합니다.">mp3DirectCut</a>을 사용했다. 시작과 끝을 성정하고 선택부분 저장하기를 하니 순식간에 파일이 잘렸다. Good! 심지어 이놈은 한글도 지원된다.

<img src="/uploads/legacy/old-images/1/cfile29.uf.184DAE474D4BC9702CC6C9.png" class="aligncenter" width="660" height="430" alt="" filename="mp3DirectCut.png" filemime="image/jpeg" />

그런데 이놈은 윈7에서 실행할 때 **관리자 권한으로 실행해 줘야 설치**가 됐다. 최신버전은 어떤지 모르겠는데, 내가 사용한 버전은 2.09였다.

mp3DirectCut은 설치할 때 윈도우를 건드리지 않으므로 제거할 때도 Program Files에서 그냥 폴더를 지우면 된다고 한다. 그런데 실행할 때도 단축아이콘 따위를 만들어 주지 않기 때문에 직접 C:\Program Files\mp3DirectCut 폴더로 가서 실행해야 한다. ㅡㅡ;;

음질 변환에는 <a href="http://www.inspire-soft.net/software/mp3-quality-modifier" target="_blank" title="[http://www.inspire-soft.net/software/mp3-quality-modifier]로 이동합니다.">MP3 Quality Modifier</a>를 사용했다. 이놈도 포터블이라 그냥 압축풀고 나온 파일 실행하면 된다.

<img src="/uploads/legacy/old-images/1/cfile7.uf.1401E5534D4BC97019C303.png" class="aligncenter" width="566" height="445" alt="" filename="MP3 Quality Modifier.png" filemime="" />

실행하고 원하는 파일이나 폴더를 Add한 다음 Preset에서 미리 설정돼 있는 음질을 골라서 Process를 눌러 주면 알아서 변환을 시작한다. 속도도 만족스럽다. 1시간 반쯤 되는 mp3인데 10분 정도 걸렸다. 물론 이건 컴퓨터 성능에 따라 차이가 있을 것이다.

나는 음성 파일이라서 Compromise와 Very low quality 모두로 음질을 변환해 봤다.&nbsp;146mb가 각각 45mb, 36mb로 변경됐다. 음악은 어떻게 될지 모르겠다.