---
title: 리눅스, 저장장치 자동 마운트
author: 안형우
layout: post
permalink: /archives/13326
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13326-auto-mount.md
mytory_md_visits_count:
  - 4
categories:
  - 기타
tags:
  - linux
  - shell
  - TIP
---
하드를 하나 더 꽂았는데, 웬걸 이게 인식이 안 되고 파일 탐색기에서 클릭을 해 줘야 인식을 하고 작동을 하는 거다. USB라면 모를까 HDD를 이렇게 쓸 순 없지. 그래서 찾아 봤다.

터미널로 간다.

    cat /proc/mounts
    

이렇게 해서 해당 저장장치를 가리키는 줄을 찾는다. 내 경우는 가리키는 줄이 다음과 같았다.

    /dev/sdc1 /var/run/media/mytory/data-hdd vfat rw,nosuid,nodev,relatime,uid=1000,gid=100,fmask=0022,dmask=0077,codepage=437,iocharset=iso8859-1,shortname=mixed,showexec,utf8,flush,errors=remount-ro 0 0
    

이 줄을 복사한 뒤, 자기가 편한 편집기로 `/etc/fstab` 파일을 연다. 난 vi를 사용한다. 루트 권한이 필요하므로 `sudo`를 사용한다.

    sudo vi /etc/fstab
    

그리고 가장 아래쪽에 복사한 줄을 붙여 넣는다. 그럼 끝!