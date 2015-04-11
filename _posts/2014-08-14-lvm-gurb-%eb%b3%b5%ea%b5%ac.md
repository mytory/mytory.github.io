---
title: lvm 수동 마운트해서 grub 복구하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/13141
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13141-mount-lvm.md
categories:
  - 기타
tags:
  - grub
  - linux
---
ubuntu 라이브CD를 이용해서 오픈수세 grub을 복구한 사례인데, 어떤 리눅스건 이 방식으로 할 수 있는 것 같다.

우선 라이브 부팅을 한 다음 터미널을 열고 아래 명령어를 친다.

    sudo -i
    fdisk -l
    

`fdisk` 결과에서 lvm 하드를 찾는다. 결과물을 복사하진 못했다;;

아래 명령어는 lvm을 인식하도록 하는 것이다. 아래 명령어에서 `crypt`는 원하는 아무거나 해도 된다. 명령어를 입력하고 나면 lvm 암호를 입력하라고 나온다. 암호를 친다.

    cryptsetup luksOpen /dev/sda2 crypt
    

이제 볼륨그룹 스캔을 한다.

    apt-get install lvm2
    vgscan
    

결과물은 아래와 같다. 안 나오면 `-v` 옵션을 붙여 봐라.

    Found volume group "system" using metadata type lvm2
    

결과물에 보이는 &#8220;system&#8221;이 lvm의 볼륭그룹 이름이다. 아래 명령어를 친다.

    vgchange -ay system
    

이제 마운트를 해야 한다. 볼륨 그룹 이름은 아래 명령어로 볼 수 있다.

    ls /dev/mapper
    

내 경우는 아래처럼 나왔다.

    control    crypt    system-mytory    system-swap
    

그러면 `system-mytory`를 마운트하자.

    mount /dev/mapper/system-mytory /mnt
    mount --bind /dev /mnt/dev
    mount --bind /proc /mnt/proc
    mount --bind /sys /mnt/sys
    mount /dev/sdb1 /mnt/boot

이제 마운트를 다 했으니 root를 변경한다.

    chroot /mnt
    

이후엔 ubuntu, opensuse 각각의 grub 복구 명령을 쳐서 하면 된다. 오픈수세의 경우

    grub2-install /dev/sda
    

명령어로 했다.

위 명령을 친 후

    exit
    reboot
    

하니까 완료.

하아&#8230; 길었다.
