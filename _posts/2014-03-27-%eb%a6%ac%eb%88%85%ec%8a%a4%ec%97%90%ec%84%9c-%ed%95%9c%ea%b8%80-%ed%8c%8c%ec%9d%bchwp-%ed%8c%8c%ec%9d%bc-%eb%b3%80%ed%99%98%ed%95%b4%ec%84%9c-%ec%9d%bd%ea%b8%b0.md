---
title: 리눅스에서 한글 파일(hwp) 파일 변환해서 읽기
author: 안형우
layout: post
permalink: /archives/12797
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12797-hwp-convert-in-linux.md
categories:
  - 기타
tags:
  - linux
  - Program
  - Python
  - TIP
---
리눅스용 한글도 있고, 뭐 와인으로 돌리는 방법도 있을 테지만, 이건 리눅스에서 한글파일을 `html`이나 `txt`, `odt`로 변환해서 읽는 방법에 대한 설명이다.

우선 `python`과 `pip`(파이썬의 패키지 설치 유틸리티)가 설치돼 있어야 한다. 고로, 개발자가 아니라면 약간 막막할 수도 있겠다;; 내가 자세히 설명할 만큼 시간이 있진 않으니, 초보인데 이런 게 꼭 필요하다면 주변에 잘 아는 사람에게 물어 보기 바란다.

우분투나 데비안 계열 리눅스 사용자라면 아래 명령어를 입력해서 `pip`를 설치하면 된다.

    sudo apt-get install pip
    

그럼 알아서 잘 설치할 거다.

그리고 아래처럼 명령을 치면 `hwp`를 `html`, `txt`, `odt`로 변환하는 스크립트(프로그램)가 설치된다.

    pip install --user --pre pyhwp
    

제대로 안 된다면 요구사항을 충족하지 않는 거니, 그건 알아서 충족하도록 하자. [요구사항을 보려면 여기][1]로 간다.

만드신 분이 친철하게도 패키지를 쉽게 설치할 수 있도록 올려 두셨기 때문에 이렇게 명령 한 줄로 설치가 가능한 것이다.

그러면 설치 완료 메시지가 나오는데, 대략 아래와 같다.

    Downloading/unpacking pyhwp
      Downloading pyhwp-0.1b7.zip (200kB): 200kB downloaded
      Running setup.py egg_info for package pyhwp
    
    Requirement already satisfied (use --upgrade to upgrade): OleFileIO-PL>=0.23 in ./.local/lib/python2.7/site-packages (from pyhwp)
    Requirement already satisfied (use --upgrade to upgrade): docopt>=0.6 in ./.local/lib/python2.7/site-packages (from pyhwp)
    Requirement already satisfied (use --upgrade to upgrade): hypua2jamo>=0.2 in ./.local/lib/python2.7/site-packages (from pyhwp)
    Installing collected packages: pyhwp
      Running setup.py install for pyhwp
    
        Installing hwp5txt script to /home/mytory/.local/bin
        Installing hwp5spec script to /home/mytory/.local/bin
        Installing hwp5proc script to /home/mytory/.local/bin
        Installing hwp5odt script to /home/mytory/.local/bin
        Installing hwp5html script to /home/mytory/.local/bin
    Successfully installed pyhwp
    Cleaning up...
    

자, 마지막 7줄을 보자. `Installing hwp5txt script to /home/mytory/.local/bin`이란 문장이 보일 거다. 뒤쪽에 있는 `/home/mytory/.local/bin`이 파이썬의 실행 명령어가 들어간 디렉토리다. 이놈을 `PATH`에 추가해서 이 디렉토리에 있는 실행 스크립트는 어디서나 실행할 수 있게 만들자. 현재 이 디렉토리에 `hwp5txt`, `hwp5spec`, `hwp5proc`, `hwp5odt`, `hwp5html` 다섯 개의 실행 스크립트가 설치된 거다. 어디서나 실행할 수 있게 되면 터미널에서 `hwp` 파일을 어디서나 변환할 수 있다. 자, 상세한 설명은 일단 `PATH`를 추가한 다음에 하겠다.

## PATH에 `/home/yourname/.local/bin` 추가

나 같은 경우는 디렉토리 이름이 `/home/mytory/.local/bin`으로 나왔다. 각자 뭔가 다른 이름이 나왔을 거다. 그러니까 위의 설치 완료 메시지에 나온 디렉토리를 일단 복사를 해 두자. 터미널에서 복사는 우분투라면 `Ctrl+Shift+C`다. 맥이면 그냥 `Cmd+C` 하면 되고.

우분투나 데비안이라면 아마 `~/.bashrc`, 맥이라면 `~/.bash_profile` 파일이 있을 거다. 터미널에서 아래처럼 써 보자.

    nano ~/.bashrc
    

뭐, `nano` 대신 `gedit` 같은 걸 사용해도 된다. 여튼 파일을 연 다음 맨 아래줄에 이렇게 추가해 주자.

    export PATH="$PATH:/home/mytory/.local/bin"
    

자, 그리고 터미널을 껐다가 다시 들어와 보자. 그리고 아래 명령을 쳐 봐라.

    hwp5txt --version
    

에러 없이 `0.1b7` 뭐 이런 결과가 나오면 제대로 한 거다. 그럼 이제 사용은 어떻게 할까?

## 사용법

사용법은 간단하다. 터미널 명령은 각각 아래와 같다.

`hwp`를 텍스트 파일로 변환

    hwp5txt 한글파일명
    

`hwp`를 `html` 파일로 변환

    hwp5html 한글파일명
    

`html`로 변환하는 경우에는 폴더가 생기고 `xhtml` 파일과 `css` 파일이 생긴다.

`hwp`를 `odt` 파일로 변환

    hwp5odt 한글파일명
    

뭐 이게 다다.

`hwp5proc`, `hwp5spec` 두 스크립트는 개발자 외에는 관심 가질 필요가 없으니 패스. 상세한 내용은 아래 링크한 위키에 있다.

## 더 자세한 게 알고 싶다면

더 자세한 게 알고 싶다면 [pyhwp wiki][2]에 가 보면 된다. [github에서 개발][3]하고 있다. 마음에 들면 개발자에게 감사 표시를 하자.

 [1]: http://pythonhosted.org/pyhwp/ko/intro.html#requirements
 [2]: http://pythonhosted.org/pyhwp/ko/
 [3]: https://github.com/mete0r/pyhwp