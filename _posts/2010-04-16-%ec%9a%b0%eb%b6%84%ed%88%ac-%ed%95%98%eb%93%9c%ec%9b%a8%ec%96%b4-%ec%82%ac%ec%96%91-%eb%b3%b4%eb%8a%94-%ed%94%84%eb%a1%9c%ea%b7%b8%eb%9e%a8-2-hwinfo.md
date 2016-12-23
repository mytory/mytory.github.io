---
title: '[우분투] 하드웨어 사양 보는 프로그램 2 hwinfo'
author: 안형우
layout: post
permalink: /archives/516
aktt_notify_twitter:
  - yes
daumview_id:
  - 36970155
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
아까 <a title="[우분투] 하드웨어 사양 보는 프로그램 sysinfo" href="http://mytory.net/archives/513" target="_blank">sysinfo를 소개</a>했는데, 더 자세하게 볼 수 있는 방법도 있다. 단, GUI가 아니라 터미널로 정보를 출력해 준다.

<pre class="brush:plain">sudo apt-get install hwinfo</pre>

로 설치하거나 시냅틱 패키지 관리자에서 설치한다.

그리고 터미널에서

<pre class="brush:plain">hwinfo</pre>

라고 치면 컴퓨터에 있는 모든 하드웨어의 복잡하고 알아먹을 수 없는 정보를 다 나열한다.

<pre class="brush:plain">hwinfo --help</pre>

라고 쳐 보자 그러면 아래와 같은 설명이 나온다.

<pre class="brush:plain">Usage: hwinfo [options]
Probe for hardware.
  --short        just a short listing
  --log logfile  write info to logfile
  --debug level  set debuglevel
  --version      show libhd version
  --dump-db n    dump hardware data base, 0: external, 1: internal
  --hw_item      probe for hw_item
  hw_item is one of:
   all, bios, block, bluetooth, braille, bridge, camera, cdrom, chipcard,
   cpu, disk, dsl, dvb, fingerprint, floppy, framebuffer, gfxcard, hub,
   ide, isapnp, isdn, joystick, keyboard, memory, modem, monitor, mouse,
   netcard, network, partition, pci, pcmcia, pcmcia-ctrl, pppoe, printer,
   scanner, scsi, smp, sound, storage-ctrl, sys, tape, tv, usb, usb-ctrl,
   vbe, wlan, zip

  Note: debug info is shown only in the log file. (If you specify a
  log file the debug level is implicitly set to a reasonable value.)</pre>

내가 사용한 방법은 두 가지다.

(1)내가 원하는 하드웨어의 정보만 보자.

<pre class="brush:plain">hwinfo --memory</pre>

라고 치면 메모리 정보만 나온다. 전부 다 나오면 너무 길어서 뭐가 어디 있는지 찾을 수가 없기 때문이다.

그러면 memory라고 쓴 저 위치에 어떤 단어들을 쓸 수 있을까?

위 설명에 나와 있는데 이 단어들을 쓸 수 있다.

<pre class="brush:plain">all, bios, block, bluetooth, braille, bridge, camera, cdrom, chipcard,
   cpu, disk, dsl, dvb, fingerprint, floppy, framebuffer, gfxcard, hub,
   ide, isapnp, isdn, joystick, keyboard, memory, modem, monitor, mouse,
   netcard, network, partition, pci, pcmcia, pcmcia-ctrl, pppoe,
printer,
   scanner, scsi, smp, sound, storage-ctrl, sys, tape, tv, usb,
usb-ctrl,
   vbe, wlan, zip</pre>

(2)파일로 기록하는 방법이 있다.

아래는 틀린 예다.

<pre class="brush:plain">hwinfo --log 파일명</pre>

위처럼 적으면 된다고 하는데 저렇게 적으면 파일만 생기고 내용이 없다. 왜? 뭘 출력할지 정해 주지 않았기 때문이다. 따라서 아래처럼 적는다.

<pre class="brush:plain">hwinfo --all --log 파일명</pre>

위처럼 하니까 파일이 생성되고 모든 정보가 담겼다.