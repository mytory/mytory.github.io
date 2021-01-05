---
title: '[리눅스] 하드웨어 정보를 보는 커맨드라인 명령어 16개'
author: 안형우
layout: post
tags:
  - linux
  - shell
---

[16 commands to check hardware information on Linux](http://www.binarytides.com/linux-commands-hardware-info/)에 나오는 명령어를 간략하게 정리한 것이다.

- `lscpu` : cpu 정보를 본다.
- `lshw` : 각종 하드웨어 정보를 본다. opensuse 저장소엔 없더라.
- `sudo dmidecode --type 17`: 메모리 정보를 상세히 본다.
- `hwinfo --short` : cpu 포함 각종 하드웨어 정보를 본다. 대충 거의 다 나오는 거 같다. 보는데 몇 초 걸리니까 명령 내리고 좀 기다려야 한다.
- `lspci` : PCI 기기 목록을 본다고.  VGA, DRAM, Ethernet, USB Controller, Firewire 뭐 그런 거 나오는 거 같다.
- `lsscsi` : scsi 기기 목록을 본다. 하드디스크랑 DVD랑 뭐 그런 거.
- `lsusb` : usb bus랑 기기의 상세 내역이 나온다.
- `inxi -Fx` : 10K짜리 스크립트인데, 여러 소스에서 정보를 뽑아서 예쁘게 보여 준다고. opensuse는 저장소에서 설치하면 된다.
- `lsblk` : 블럭 기기를 본다고. 하드 디스크 정보인 듯.
- `df -h` : 터미널좀 쓰면 다들 아는 명령어일 거다. 하드 사용량을 본다. `-H` 옵션을 주면 1GB를 1000MB로 계산한다.
- `pydf` : python으로 짠 `df` 개선 버전이라는데 opensuse 저장소엔 없다.
- `sudo fdisk -l` : 터미널 배울 때 거의 가장 처음 배우는 명령어니까 뭐 설명이 필요없겠지.
- `mount | column -t` : 마운트된 파일시스템을 볼 때 쓴다고.  근데 뭐가 매우 많이 나온다. `column -t` 명령은 그냥 출력 내용을 정리해 주는 역할을 한다.
- `mount | column -t | grep ext` : 하드디스크 정보만 본다. 마운트 포인트랑 dev 이름이랑 나오니까 쓸 데가 있을 거다.
- `free -m` : 메모리 정보를 보여 준다. 이건 뭐 `top`으로 봐도 되는 거 아님?
- `dmidecode -t ...` : `-t` 뒤에 `bios`, `memory`, `processor`, `system`, `baseboard`, `chassis`, `cache`, `connector`, `slot` 같은 것을 붙여서 해당 정보를 본다. `dmidecode -t`라고만 치면 키워드가 잘못됐다고 나오면서 어떤 키워드를 넣을 수 있는지 보여 준다. 대충 때려 넣자.
- `/proc` 폴더에 있는 파일들 : `/proc` 폴더에는 각종 하드웨어 정보랑 돌아가고 있는 프로그램 정보가 있는데, `less`나 `cat`으로 출력시켜 보면 된다. 근데 별로 볼 게 많진 않다. `less /proc/cpuinfo` 같은 건 쓸만하다. `/proc/meminfo`도 있다고 하고. `/proc/version`은 리눅스와 커널 버전을 보여 준다. `/proc/scsi/scsi` 파일에는 SCSI/Sata 기기 정보가 있다고. `/proc/partitions`엔 파티션 정보가 있다.
- `hdparm -i /dev/sda` : `/dev/sda/`는 당연히 자기 시스템에 맞게 바꿔 넣어야 하는 거고. sata 기기의 정보를 상세하게 보여 준다. 내가 쓸 일이 있을 진 모르겠다.

뭐 이정도. 사실 맨 위에 있는 `hwinfo --short`면 충분한 것 같다. 그리고 조금 흥미가 더 가는 건 `inxi -Fx`고. cpu 정보는 앞으로 `lscpu`로 볼 것 같다. 

사실 이 명령어 처음 찾은 이유는 이 컴퓨터 32비트인지 64비트인지 어디서 보지? 하는 것때문이었는데. 여튼 공부 한 번 했다. 
