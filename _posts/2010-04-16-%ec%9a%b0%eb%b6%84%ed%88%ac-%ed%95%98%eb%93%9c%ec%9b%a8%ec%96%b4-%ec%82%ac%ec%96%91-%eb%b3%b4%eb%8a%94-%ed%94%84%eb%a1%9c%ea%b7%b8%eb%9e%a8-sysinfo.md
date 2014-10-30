---
title: '[우분투] 하드웨어 사양 보는 프로그램 sysinfo'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/513
aktt_notify_twitter:
  - yes
daumview_id:
  - 36972302
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
sysinfo 라는 프로그램이다. 터미널에서 아래처럼 입력하거나

<pre class="brush:plain">sudo apt-get install sysinfo</pre>

시냅틱 패키지 관리자에서 sysinfo를 찾아 설치한다.

그러면 **프로그램 > 시스템 도구 > Sysinfo** 로 실행할 수 있다.

sysinfo는 다음 정보들을 제공해 준다.

*   시스템 (리눅스 배포판 릴리즈, GNOME 버전, 커널, gcc와 Xorg 그리고 호스트네임)
*   CPU의 (업체 식별, 모델 이름, 주파수, level2 캐시, <a href="http://minimonk.tistory.com/1014" target="_blank">bogomips</a>, 모델 번호와 플래그);
*   메모리 (전체 시스템의 RAM, 메모리, 스왑 공간 및 자유로운 메모리(free memory), 캐시, 활성, 비활성 메모리);
*   저장장치 (IDE 인터페이스, 모든 IDE 장치, SCSI 장치);
*   하드웨어 (마더보드, 그래픽 카드, 사운드 카드, 네트워크 장치);
*   엔비디아 그래픽 카드 : NVIDIA 디스플레이 드라이버가 설치된 경우에만.

역시 이런 짧은 문장은 구글 번역기 돌리니까 완전 제대로 나온다.

It is able to recognize information about:

*   System (Linux distribution release, versions of GNOME, kernel, gcc and Xorg and hostname);
*   CPU (vendor identification, model name, frequency, level2 cache, bogomips, model numbers and flags);
*   Memory (total system RAM, free memory, swap space total and free, cached, active, inactive memory);
*   Storage (IDE interface, all IDE devices, SCSI devices);
*   Hardware (motherboard, graphic card, sound card, network devices);
*   NVIDIA graphic card: only with NVIDIA display driver installed.

그런데 난 내 메모리가 DDR2인지 뭔지 알고 싶었던 건데 그런 정보는 안 나온다. OTL;;

누구 리눅스에서 그런 거 볼 수 있는 방법 아는 사람 없나요;; 본체 뜯기 싫어 &#8230;