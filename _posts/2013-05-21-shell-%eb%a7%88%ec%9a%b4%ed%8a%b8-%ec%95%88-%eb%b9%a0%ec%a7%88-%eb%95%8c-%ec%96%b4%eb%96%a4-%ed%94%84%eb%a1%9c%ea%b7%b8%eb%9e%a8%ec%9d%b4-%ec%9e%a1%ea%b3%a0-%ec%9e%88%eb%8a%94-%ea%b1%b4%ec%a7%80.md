---
title: '[shell] 마운트 안 빠질 때 어떤 프로그램이 잡고 있는 건지 확인해 보기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10189
daumview_id:
  - 44980176
categories:
  - 서버단
tags:
  - shell
---
USB 같은 걸 마운트했다가 안 빠지는 경우가 있다. 다른 프로그램이 USB에 있는 뭔가를 사용하고 있기 때문에 벌어지는 현상이다.

예컨대, USB에 있는 문서를 어떤 프로그램에서 열어 놓은 상태라던가 뭐 그런 경우에 안 빠지는 거다.

![맥에서 마운트했다가 안 빠지는 경우][1]

위 이미지는 맥에서 찍은 스크린샷인데, 리눅스도 비슷한 메시지가 뜬다.

윈도우라면 뭐 프로그램을 다 꺼봐야 겠고, 다른 방법이 있을지 모르겠는데, 여튼간에 맥이나 리눅스라면 터미널에서 다음과 같은 명령어를 입력해서 종료해야 할 프로그램을 확인할 수 있다.

    lsof +D /mount-point

`lsof`는 list open files의 약자다.

예컨대, 나는 USB 이름이 MYUSB였다. 그러면 맥에서는 아래처럼 써 주면 된다.

    lsof +D /Volumes/YAN

맥은 `Volumes`라는 폴더에 외부 저장장치가 마운트된다는 사실만 알면 간단하다. 우분투 같은 경우엔 외부 저장장치가 `/media`에 마운트되니 같은 형식으로 찾아 주면 될 거다.

위 명령어를 치면 아래처럼 나온다.

    COMMAND     PID   USER   FD   TYPE DEVICE SIZE/OFF NODE NAME
    Sublime   15570 mytory  cwd    DIR    1,4    16384    1 /Volumes/YAN
    Finder    39170 mytory   20r   DIR    1,4    16384    1 /Volumes/YAN

파인더는 탐색기고 종료할 필요가 없다. Sublime만 종료해 주면 된다. 뭐, 알아서 종료하면야 되겠지만, 이렇게 PID를 사용해 종료할 수도 있다.

    sudo kill 15570

이렇게 하고 나면 마운트를 해제할 수 있다.

 [1]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/cant-umount.png