---
title: '[sed] 터미널에서 텍스트 파일 문자열 바로 치환하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12993
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12993-sed.md
categories:
  - 기타
tags:
  - shell
---
워드프레스 사이트를 개발할 때 로컬에 사이트를 구축하기 위해서는 늘 DB를 다운받아서 에디트플러스로 열어서 `Ctrl+H`로 도메인을 찾기바꾸기 했다. `site.com`을 `site.local`로 변경했던 것이다. 그런데 이게 DB 용량이 크면 골때린다. 게다가 에디트플러스는 윈도우용이기 때문에 리눅스를 사용하고부터는 대용량 파일의 문자열을 치환하는 게 늘 골치가 아팠다. &#8230; 커맨드라인 명령어를 알기 전까지는 말이다! ㅋㅋㅋ

`sed`는 커맨드라인에서 문자열을 정규식으로 찾아서 치환해 주는 놈이다. 정규식은 펄 스타일을 사용한다. 즉, 대충 다들 쓰는 거 쓰면 된다.

예컨대, `mytory.local`을 `work.local/mytory.local/html`로 변경하고 싶다면 아래처럼 쓴다.

    sed 's/mytory.local/work.local/mytory.local/html/g' 2014-04-03.sql > 2014-04-03-replaced.sql
    

위처럼 명령을 내리면 `2014-04-03.sql`이라는 파일의 문자열이 치환돼 `2014-04-03-replaced.sql`이라는 파일이 생긴다.

`-i` 옵션을 주면 `>`가 필요 없다. 표준출력(StdOut, Standard Output)을 자기 원래 파일로 보내게 된다. 즉, 그냥 원본 파일을 수정해 버린다. 난 간이 작아서 그렇겐 못하겠다.

문법을 설명하면 이렇다.

    sed 's/찾을정규식/바꿀문자열/g'
    

`s`는 문자열을 치환하겠다는 표시(flag)고, `g`는 자바스크립트에서 `replace` 함수 사용해 본 사람이라면 알겠지만, 첫 번째 것만 바꾸는 게 아니라 전체를 다 바꾼다는 표시다. 즉, global의 약자라고 생각하면 된다. 바꿀문자열 쪽에서는 구분자로 쓴 `/`만 이스케이핑해 주면 된다. 구분자는 `/`뿐 아니라 `|`도 사용할 수 있다. 즉, 아래처럼 쓸 수 있다.

    sed 's|찾을정규식|바꿀문자열|g'
    

뭐, 나머지는 각자들 알아서 테스트해 보시길 바란다.