---
title: "트루크립트 사용시 한글 파일명이 깨진다면"
layout: "post"
category: "etc"
tags: 
    - program
---

트루크립트는 개발중단됐지만 여전히 결함이 발견되지 않은 훌륭한 암호화 프로그램이다.

윈도우에서 fat로 만든 트루크립트 파일에 한글 파일명으로 된 파일을 집어 넣고 리눅스에서 열었더니 파일명이 깨져 나왔다. ntfs로 하면 괜찮으려나 했는데 이번엔 맥에서 ntfs로 된 트루크립트 파일을 열지 못한다. 난감...

혹여나 해서 검색해 봤더니 character set을 지정해 주는 옵션이 있다. 윈도우 등에서 GUI로 사용한다면 이 조언을 참고하면 된다. 

> 흔히 트루크립트 볼륨은 FAT32로 만들게 될 거다. FAT를 리눅스에서 마운트하면 character set 기본값은 iso8859-1이다. 윈도우에서 긴 파일명은 유니코드 형식으로 디스크에 저장돼 있지만 말이다.

> 해결책: 트루크립트 Mount options에서 iocharset=utf8이라고 지정해 주면 된다(전역 설정(preferences) 혹은 고급 설정(advanced options)의 특정 볼륨(specific volume)).

> 출처 : [Answer of 'Cross-platform non-ASCII symbols in filenames with TrueCrypt'](http://askubuntu.com/a/79184)

## 커맨드라인 해결책

커맨드라인에서 사용할 때는 아래처럼 명령을 내리면 된다.

    truecrypt --fs-options=iocharset=utf8 tc-file.tc
