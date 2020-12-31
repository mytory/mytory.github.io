---
title: 'mp3 메타데이터 인코딩 변경 - Plex 등에서 한글이 깨져 나올 때 커맨드라인으로 처리하기'
layout: post
tags: 
    - etc
    - bash
    - python
---

간단히 쓴다. 메타데이터의 인코딩을 cp949에서 utf-8로 변경하는 것이다. 현재 폴더의 하위 폴더에 있는 모든 mp3를 한 번에 변경한다.

``` bash
pip install mutagen
find . -iname "*.mp3" -execdir mid3iconv -e cp949 {} \;
```

`-execdir` 옵션이 없다고 나오는 경우 `-exec` 옵션을 붙이면 된다는 이야기가 있다.

참고한 글: “[MP3 태깅 정보를 UTF-8로 바꾸는 방법](http://www.2cpu.co.kr/nas/12760)”