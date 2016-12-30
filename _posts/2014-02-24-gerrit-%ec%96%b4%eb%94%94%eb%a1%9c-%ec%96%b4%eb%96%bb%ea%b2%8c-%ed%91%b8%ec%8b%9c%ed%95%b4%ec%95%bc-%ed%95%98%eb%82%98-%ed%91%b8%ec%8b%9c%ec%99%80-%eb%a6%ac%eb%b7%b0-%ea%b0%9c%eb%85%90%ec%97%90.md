---
title: 'gerrit 어디로 어떻게 푸시해야 하나 &#8211; 푸시와 리뷰 개념에 대해'
author: 안형우
layout: post
permalink: /archives/12632
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12632-gerrit.md
categories:
  - 개발 툴
tags:
  - git
  - Program
---
[gerrit][1]은 git 기반 웹 인터페이스 코드 리뷰 툴이다. 이렇게 생겼다.

![][2]

&#42;이미지 출처 : [&#8216;Gerrit Code Review &#8211; A Quick Introduction&#8217;][3]

보면 알겠지만 줄단위로 리뷰를 할 수 있다. 코드리뷰는 코드 품질을 균일화할 수 있는 가장 좋은 도구인 것 같다. 아직 본격적으로 팀에 적용해 보지 않아서 확신을 갖고 말할 순 없지만 말이다.

위 이미지 출처인 [&#8216;Gerrit Code Review &#8211; A Quick Introduction&#8217;][3]을 보면 gerrit을 이용한 작업 흐름을 잘 알 수 있다. 아쉽게도 영어라 해석하는 데 시간이 많이 걸리지만 말이다.

## 푸시는 `refs/for/branch-name`에 한다.

설치는 문서 보고 알아서 하시고. 이 글에선 개념만 간략히 다루겠다. 처음에 가장 헷갈렸던 게 리뷰 화면에 나오게 하는 방법이었다. gerrit은 프로젝트를 생성하고 git 주소까지 제공해 준다. 즉, gerrit을 설치하면 git 저장소 관리까지 gerrit을 이용해서 하게 된다. gerrit이 주는 git 저장소 주소를 받아서 clone하고 push를 했는데 리뷰 화면엔 아무 것도 안 나와서 처음엔 당황했다. 뭐지?

역시 매뉴얼을 꼼꼼히 읽고 했어야 했다. 리뷰 대상이 되는 것은 `refs/for/branch-name`으로 들어온 푸시다. 예를 들면 아래처럼 push를 해야 한다.

    git push origin HEAD:refs/for/master
    

위에서 `HEAD`는 로컬저장소 위치다. 즉, 로컬의 `HEAD`를 원격의 `refs/for/master`에 집어넣으라는 말이다. `HEAD`나 `refs/for/master`는 refspec인데 사실 우리가 자주 사용하는 branch인 master branch는 `refs/heads/master` refspec의 별칭이다.

refspec은 레퍼런스 스펙의 약어인데, Pro Git의 [&#8216;Git의 내부 &#8211; Git 레퍼런스&#8217;][4] 부분을 보면 레퍼런스가 뭔지 나와 있다. 레퍼런스는 특정 커밋을 가리키는 놈인데, 커밋이 sha-1 해시값이라면, 레퍼런스는 사람이 알아먹기 쉽게 이름이 붙은 놈이라고 생각하면 된다. master도 레퍼런스다. branch나 tag도 레퍼런스다.

git는 레퍼런스를 텍스트 파일로 저장한다. master 레퍼런스는 master란 이름의 파일이다. 파일 안에는 커밋의 해시값이 들어있다. Annotated tag는 예외인데, 뭐 자세한 설명은 생략하자. 레퍼런스는 확인하고 싶으면 `.git/refs` 폴더를 살펴 보자. master 레퍼런스는 `.git/refs/heads/master`라는 파일로 저장된다.

`refs/for/branch-name` 형식의 refspec은 그리고 푸시한 커밋을 gerrit의 리뷰 대상으로 만드는 refspec이다. `refs/for/branch-name`은 일반적인 git에서 사용되는 refspec은 아닌 것 같고, gerrit이 내부적으로 만들어서 사용하는 refspec인 것 같다.

일반 git 저장소와 gerrit의 git 저장소의 차이를 보려고 다 살펴 봤다.

*   기본적으로 로컬 `.git` 폴더 안에는 `heads`, `remotes`, `tags` 폴더가 있다. `for` 폴더는 없다. 
*   리모트에 있는 일반 bare 저장소를 살펴 보니 `refs` 폴더 하위에 `heads`, `tags` 폴더가 있다. 
*   gerrit의 bare 저장소인 `gerrit/git` 하위에 있는 `refs` 폴더를 보니 `changes`, `heads`, `meta`, `tags` 네 개의 폴더가 있다. 근데 `for`는 찾을 수가 없다. 
*   좀더 살펴 보니 `refs/for/*`로 넣으면 아마 gerrit이 정리를 해서 `git/refs/change` 폴더에 넣는 것 같다. `git/refs/change` 폴더에 각 review 대상이 01, 02 &#8230; 식으로 정리돼 있는 걸 보니 말이다.

## 각 리뷰는 commit 메시지에 있는 Change-Id로 구분한다.

커밋 메시지 맨 마지막 부분에는 Change-Id를 넣어 줘야 한다. 아래는 예시다.

    commit aeef0e3d6e4a1db31c3ca5ec3fcddc4dc6c2c7fd
    Author: mytory <mytory@gmail.com>
    Date:   Mon Feb 24 04:31:05 2014 +0900
    
        test.
    
        Change-Id: Iaea0f4d225beed878b3d17d2ca421c93d22f7e96
    

gerrit은 Change-Id를 자동으로 넣어 주는 commit hook을 제공한다. 로컬 git 프로젝트의 루트 폴더에서 아래 명령어를 차례대로 치면 Change-Id commit hook이 만들어진다.

    scp -p -P 29418 mytory@gerrit.domain.com:hooks/commit-msg .git/hooks/
    chmod u+x .git/hooks/commit-msg
    

왜 commit name이 있는데 그걸 놔두고 따로 Change-Id를 또 사용하는 것일까? 예를 들어, 리뷰가 빠꾸먹었다고 치자. 그래서 `git commit --amend`로 commit을 수정했다. 그러면 commit name은 변한다. 그러나 Change-Id는 변하지 않는다. 그래서 gerrit은 이 커밋이 예전 리뷰를 수정한 놈이구나 하는 걸 알 수 있게 된다. cherry-pick이나 rebase를 해도 마찬가지라고 한다.

알아둘 것. Change-Id는 commit name과 다르다. 그리고 commit name과 구분하기 편하게 `I`로 시작한다.

 [1]: https://code.google.com/p/gerrit/
 [2]: http://mytory.net/uploads/legacy/gerrit.png
 [3]: https://gerrit-documentation.storage.googleapis.com/Documentation/2.8.1/intro-quick.html
 [4]: http://git-scm.com/book/ko/Git%EC%9D%98-%EB%82%B4%EB%B6%80-Git-%EB%A0%88%ED%8D%BC%EB%9F%B0%EC%8A%A4