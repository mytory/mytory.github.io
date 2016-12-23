---
title: '[lubuntu(루분투)] 기본 탐색기 PCManFM을 노틸러스로 바꾸기'
author: 안형우
layout: post
permalink: /archives/1664
aktt_notify_twitter:
  - yes
daumview_id:
  - 36685378
categories:
  - 기타
tags:
  - Ubuntu Family
---
루분투는 성능이 안 좋은 컴퓨터에서도 잘 돌아가는 우분투 계열 리눅스(?)다. 빠르고 가볍고 에너지를 절약하는 우분투 계열 운영체제라고 자신들을 소개하고 있다.

루분투의 l은 lightweight 에서 왔을 것이다. 캐노니컬이 공인한 Kubuntu나 Xubuntu 같은 프로젝트는 아니지만, 공인받는 걸 목적으로 한다고 [루분투 소개][1]에 써 놨다.

나는 루분투를 사용한다. 컴 성능이 딸려서가 아니라 그래픽 카드 성능이 딸려서다. 듀얼 모니터를 사용하니까 우분투에서는 엄청나게 버벅댔다. 화면 효과를 다 끄고 고전 모드로 들어가도 마찬가지였다. 결국 루분투를 사용하고 나서야 제성능을 발휘하기 시작했다.

## 기본 탐색기 PCManFM

루분투의 기본 탐색기는 PCManFM이다. 성능은 괜찮다. 가볍고 빠르다. 그러나 내 입장에서는 기능이 많은 Nautilus(노틸러스, 우분투의 기본 탐색기)를 사용하는 게 더 좋다.

PCManFM이나 노틸러스나 뜨는 시간도, 성능도 비슷하기 때문이다.

그래서 구글링 시작!

결국 시스템을 손보는 방법은 찾지 못했고 편법을 찾아냈다.

내가 찾은 방법은 [노틸러스를 thunar 라는 가벼운 탐색기로 대체하는 방법][2]인데, 그냥 문자열 찾기 바꾸기로 내가 스크립트를 변경했다. nautilus 를 pcmanfm으로, thunar 를 nuatilus 로.

자자. 아래처럼 써 주자.

<pre>sudo mv /usr/bin/pcmanfm /usr/bin/pcmanfm.real</pre>

기존의 pcmanfm 실행파일 이름을 변경한 것이다.

<pre>sudo gedit /usr/bin/pcmanfm</pre>

이러면 새로운 pcmanfm 파일을 만들고 편집을 시작하게 된다. gedit가 뜰 거다. 그러면 아래 내용을 채워 준다.

<pre class="brush:shell">#!/bin/bash

#zenity --info --text="${1}/${@}" #DEBUG
if [ -n "${1}" ]; then
    if [ "${1:0:1}" == "/" ]; then
        nautilus "${1}"
    elif [ "${1}" == "--no-desktop" ]; then
        if [ -n "${2}" ]; then
            if [ "${2:0:7}" == "file://" ] || [ "${2:0:1}" == "/" ]; then
                nautilus "${2}"
            else
                pcmanfm.real "${2}"
            fi
        else
            nautilus

        fi
    else
        pcmanfm.real "${@}"
    fi
else
    nautilus
fi</pre>

당연히 붙여 넣고 저장을 해야겠지.

그리고 마지막으로 파일 권한을 설정해 준다.

<pre>sudo chmod 755 /usr/bin/pcmanfm</pre>

이렇게 하면 그 다음부터는 기본 파일 탐색기가 노틸러스로 변한다.

## 편법인 이유

시스템에 &#8220;기본 탐색기는 얘를 써라&#8221; 하고 알려주는 게 아니라, 옷만 pcmanfm으로 입히고 내용을 nautilus를 실행하게 만들었으니 편법인 거다.

루분투에서는 시스템에 &#8220;기본 탐색기가 얘란다!&#8221; 하고 알려주는 방법이 뭘까? 조금만 찾아봐서 그런지는 모르겠지만, 못 찾겠다. OTL;;

 [1]: https://wiki.ubuntu.com/Lubuntu
 [2]: http://www.linuxquestions.org/questions/linux-software-2/change-of-default-file-manager-700122/#td_post_3566192