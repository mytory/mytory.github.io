---
title: Git 패치 파일 만들어서 적용하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12126
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12126-git-create-patch.md
categories:
  - 개발 툴
tags:
  - git
  - shell
  - TIP
---
SVN이든 git든 deploy할 때 `svn update`나 `git pull`을 사용하지 못하는 경우가 있다. 이럴 때 `patch`를 이용하면 간편하다.

나 같은 경우 인터넷 접속이 되지 않는 내부 망 컴퓨터에 업데이트된 소스를 적용하기 위해 사용했다.

단, patch를 적용하는 시점의 소스를 정확히 기억해 둬야 한다. 패치를 적용할 때 기본 로직은 &#8216;x번째 줄을 삭제하고, 이런 소스를 넣는다&#8217; 이거다. 그런데 적용 대상 소스가 패치를 만든 소스와 다르면 적용이 안 될 거다. (적용이 맘대로 돼 버리면 그거야말로 최악 ㄷㄷ)

버전 관리 툴의 `tag` 기능을 이용하면 간편하다. 난 git를 쓰니 git를 중심으로 설명한다.

    git diff tag1 tag2 > patch-file-name.patch
    

위처럼 쓰면 된다. `diff` 명령 결과로 나오는 화면 자체가 표준적으로 사용되는 patch 파일 형식인가 보다.

`>`는 출력 결과를 파일로 만들라는 뜻이고. (정확히 말하면 표준출력.)

여튼 위 명령을 내리면 패치 파일이 생성된다. (주의! binary 파일은 적용되지 않고 text만 적용된다. binary까지 포함하는 patch를 만드는 방법은 알게 되는대로 보강할 생각이다. binary 파일을 일단 알아서 복사떠야 한다.)

생성된 patch파일을 들고 가서 적용을 하려면 일단 적용할 컴퓨터로 가서 patch 파일을 생성한 경로에 해당하는 경로로 간다. 그리고 아래 명령.

    patch -p1 < /path/to/patch-file-name.patch
    

`-p1` 옵션은 패치 파일의 경로 앞에 붙은 prefix를 몇 단계나 제거하고 파일경로로 받아들일지 정하는 것이다. 예컨대 git의 diff를 하면 아래처럼 파일경로가 나온다.

    --- a/application/views/session/login.php
    +++ b/application/views/session/login.php
    

`a/`와 `b/`는 경로가 아니라 구분하기 위한 표시이다. 그래서 없애야 한다. 그래서 `-p1` 옵션을 주는 것이다. 저런 게 두 단계 있으면 `-p2` 옵션을 주면 된다.