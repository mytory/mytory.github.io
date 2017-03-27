---
title: 리눅스, 윈도우에서 압축한 zip에 한글 파일이 들었을 때 파일명 깨지는 문제 해결하기
author: 안형우
layout: post
permalink: /archives/250
aktt_notify_twitter:
  - yes
daumview_id:
  - 37113165
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---

일단 unzip 최신버전을 사용하는 경우 `-O` 옵션을 주면 된다. 최신 우분투에선 되니깐 이렇게 하자.

    unzip -O cp949 korean-archives.zip


## kozip 스크립트 사용

수집한 kozip이다.

- 파이썬으로 마든 kozip이다 : [kozip](https://github.com/hojunester/kozip), 다운로드받은 뒤 `kozip.py`를 사용하면 된다.
- 펄로 만든 kozip 파일이다: [kozip.zip](/uploads/legacy/old-images/1/kozip.zip)

Alt+F2를 눌러서 실행 창을 열고 여기에

<pre class="brush:plain">gksu nautilus</pre>

라고 쳐서 관리자 모드로 파일 탐색기를 연다.

다운 받은 `kozip` 혹은 `kozip.py` 파일을 `/usr/local/bin` 폴더에 집어넣는다. `kozip.py`라면 파일명은 `kozip`으로 변경해 주자. 마우스 우클릭해서 속성을 보자. 실행 권한이 있어야 한다.

    kozip 압축파일명.zip

위와 같은 방식으로 압축을 풀면 게임 끝!
