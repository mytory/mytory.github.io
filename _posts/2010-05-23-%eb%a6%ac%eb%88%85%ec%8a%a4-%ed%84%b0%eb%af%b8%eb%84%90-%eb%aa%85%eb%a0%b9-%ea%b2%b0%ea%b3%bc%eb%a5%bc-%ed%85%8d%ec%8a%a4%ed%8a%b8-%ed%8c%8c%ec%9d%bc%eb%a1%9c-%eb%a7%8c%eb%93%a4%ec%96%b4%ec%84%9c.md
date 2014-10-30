---
title: 리눅스 터미널 명령 결과를 텍스트 파일로 만들어서 보기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/609
aktt_notify_twitter:
  - yes
daumview_id:
  - 36918541
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/609-stdout-to-txt.md
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
터미널에서 명령을 쳤는데 너무 길어서 화면을 다 훑고 지나가는데다 앞부분은 스크롤해서 올라가도 이미 지워져버리는 경우가 있다.

이 경우 txt 파일로 만들어서 텍스트 에디터나 `less` 명령어 같은 걸로 봐도 좋다.

방법은 간단하다.

    명령 > 텍스트파일명
    

한 마디로

    ls > my_file_list.txt
    

이런 식으로 하면 된다는 거다.

`.txt`라는 확장자는 사실 윈도우를 위한 것이므로 유닉스 스타일로 확장자 없이 만들어도 되겠다.