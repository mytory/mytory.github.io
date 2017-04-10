---
title: '리눅스 커맨드라인에서 한글 파일 열기'
layout: post
author: 안형우
tags: 
  - linux
description: pyhwp 패키지를 이용해서 odt 파일을 만든 뒤 libreoffice로 여는 bash 스크립트를 설명한다.
image: /uploads/2017/hwp-in-cli.jpg
---

리눅스를 주 운영체제로 사용하면서 불편한 것 중 하나는 hwp 파일을 여는 것이 불편하다는 점일 것이다. 아래 방법들을 주로 이용하게 될 텐데...

- 버추얼박스로 윈도우를 실행한 뒤 윈도우용 한글을 띄워서 연다. 한글 파일 하나 때문에 버추얼박스를 돌려야 하니 귀찮다.
- 네이버 오피스에 올린 다음 내용을 본다. 네이버에 접속해야 하니 귀찮다.
- 와인으로 한글 구버전을 설치한다. 매우 복잡하다. 
- 한컴에서 내놓은 리눅스용 한글을 설치한다. 매우 복잡하다.

커맨드라인이 조금 익숙한 사람이라면 좀 더 간편한 방법을 사용할 수 있다. 바로 [pyhwp]라는 프로그램이다. 

[pyhwp]: https://pythonhosted.org/pyhwp/ko/ 

우선 설치하려면 python과 pip(python의 패키지 관리자)가 있어야 한다. 우분투라면 다음 명령어로 간단하게 설치할 수 있다.

    sudo apt install python python-pip

아마 python은 기본으로 설치돼 있을 것이고, `python-pip`만 설치하면 될 거다.

그리고 pyhwp를 설치하려면 아래 명령어를 사용한다.

    sudo pip install setuptools pycrypto pyhwp

pyhwp를 사용하기 위해 setuptools가 있어야 한다. pycrypto는 필수는 아니고 선택사항이다.

설치가 완료됐으면 `hwp5odf`, `hwp5html`, `hwp5txt` 명령을 사용할 수 있게 된다.

사실 bash 스크립트를 만들지 않고 `hwp5odf file.hwp` 형식으로 hwp를 odt로 변환한 뒤 그냥 libreoffice에서 여는 식으로 사용해도 된다. 여기부터 설명하는 bash 파일은 libreoffice로 여는 걸 좀더 쉽게 해 주는 것에 불과하다.

## hwp 명령을 만들어 보자

이제 `hwp5odf` 명령을 이용해서 `hwp filename.hwp`라고 명령을 내리면 odt로 변환한 파일을 만들고 그걸 libreoffice에서 여는 bash 스크립트를 만들어 보자. 아래 스크립트를 복사해 hwp라는 이름의 파일을 만든다.

    #!/bin/bash
    if [ "$1" == "" ]
      then 
        echo 'usage: hwp filename.hwp'
        exit 1 
    fi
    hwp5odt "$1"
    libreoffice $(basename -s '.hwp' "$1").odt &

자, 저장을 한 뒤, 이 파일에 실행 권한을 준 뒤 /usr/local/bin 폴더로 옮긴다. 아래 명령어를 사용해도 되고, 그냥 파일 탐색기에서 해도 된다.

    chmod a+x hwp
    sudo mv hwp /usr/local/bin/ 

`hwp`라고 쳤을 때 `usage: hwp filename.hwp`라고 나오면 성공한 것이다. 그럼 앞으로는 hwp 파일을 열 때 `hwp 파일명.hwp`라고 명령을 내려 열면 된다. 그러면 `파일명.odt`라는 파일을 생성한 뒤, libreoffice가 그 파일을 연다. 

## 실 사용 동영상

아래는 실사용 동영상이다. 화면 녹화가 잘 안 돼서 많이 깜빡거리긴 하는데, 대충 뭔지만 볼 수 있으면 되니까 노력을 더 들이지 않고 그냥 올렸다.

<div class="video-container"><div class="video-container__inner"><iframe width="560" height="315" src="https://www.youtube.com/embed/COJeTd3R3X8?rel=0" frameborder="0" allowfullscreen></iframe></div></div>

## 코드 설명

나름 코드를 이해할 수 있는 사람들을 위한 코드 설명이다. 일반 사용자라면 그냥 패스하라.

1. 첫 줄의 `#!`로 시작하는 부분은 해시뱅이라고 불리는 줄인데, 이 문서의 파서를 지정해 주는 것이다. 여기서는 `/bin/bash`를 지정한 것이다.
2. 둘째 줄의 `if [ "$1" == "" ]`는 bash의 if문이다. `$1`는 첫 번째 인자값을 말한다. 따옴표로 감싸 줘야 if문이 제대로 작동한다.
3. 셋째 줄의 `then`은 if문 안의 조건이 충족하면 실행할 부분을 지정하기 위해 적어 주는 키워드다. 무조건 써야 한다.
4. 넷째 줄의 `echo`로 시작하는 부분은 해당 내용을 화면에 출력하라는 명령이다. 인자값, 즉 파일명이 들어오지 않았을 때 사용법을 출력하고 끝내기 위해서 넣은 부분이다.
5. 다섯째 줄의 `exit 1`은 스크립트를 종료하라는 명령이다. `1`은 정상 종료되지 않았다는 뜻으로 넣어 준다. bash는 명령이 정상적으로 실행되면 `0`을 리턴하고 그렇지 않으면 다른 값을 리턴하는 게 규칙이다.
6. 여섯째 줄의 `fi`는 if문이 끝났음을 뜻한다.
7. 일곱째 줄의 `hwp5odt "$1"`은 넘긴 파일을 `hwp5odt` 프로그램을 이용해서 odt로 변환하는 부분이다. 커맨드라인에서 내리는 명령과 같다. `$1`이 첫 번째 인자값으로 넘긴 문자열이라는 것만 알면 된다. 파일명에 띄어쓰기가 있을 때를 대비해 따옴표로 감싸야 한다는 것을 잊지 말자. 이 때 작은 따옴표로 감싸면 첫 번째 인자값이 아니라 그냥 `$1`이라는 문자열을 가리키게 되므로 큰 따옴표로 감싸야 한다는 것을 기억하라.
8. 여덟번째 줄의 `libreoffice $(basename -s '.hwp' "$1").odt &`는 libreoffice로 변환한 odt 파일을 열라는 부분이다. `$()`로 감싼 부분은 bash로 명령을 실행한 뒤 리턴값을 집어넣어 문자열로 넣는 부분이다.
    - `basename`은 파일 경로에서 `/`로 나눈 것들 중 맨 마지막 부분을 리턴하는 명령이다. `basename /home/mytory`라고 넘기면 `mytory`를 리턴한다. `basename /home/mytory/file.hwp`라고 명령을 내리면 `file.hwp`를 리턴한다. 
    - `basename`의 `-s` 옵션은 `suffix`의 약자로, 접미사를 떼는 옵션이다. `basename -s '.hwp' /home/mytory/file.hwp`라고 명령을 내리면 결과값이 될 `file.hwp`에서 `.hwp`를 뗀 `file`만 리턴한다. 
    - 그래서 `$(basename -s '.hwp' "$1")` 부분은 결국 `$1`에서 확장자를 제외한 파일명으로 치환된다. 만약 파일명이 `file.hwp`였다면 `file`이라는 문자열로 치환되는 것이다.
    - `$1`이 `file.hwp`라면 결국 `$()`로 감싼 부분이 치환된 후에 전체 명령은 `hwp5odt file.odt &`가 되는 것이다. 
    - `&`를 마지막에 붙이면 프로세스가 백그라운드에서 실행된다. 그래서 터미널이 libreoffice에 붙잡히지 않고 계속 사용할 수 있는 상태가 된다. 

