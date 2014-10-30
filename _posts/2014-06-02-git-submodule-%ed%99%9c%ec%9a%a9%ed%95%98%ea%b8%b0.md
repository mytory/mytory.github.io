---
title: git submodule 활용하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/13033
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13033-submodule.md
categories:
  - 개발 툴
tags:
  - git
---
git가 좋은 게, 내 프로젝트에 사용하는 라이브러리를 프로젝트 안에서 clone해서 쓸 수 있다는 거다. 우리가 내부 프로젝트에 공통으로 사용할 용도로 만든 사내 라이브러리를 관리할 때도 사용할 수 있다.

예컨대, marxism이라는 프로젝트가 있다고 하자. 우리는 공통으로 관리하는 sass 모듈이 있다. marxism의 css 폴더 밑에다가 이 공통 모듈을 두고 싶다. 그렇다면 이렇게 하는 거다. 프로젝트 root 에서 해도 되고, 뭐 아무데서나 해도 된다.

    git sumodule git@mydomain.net:repository/sass-modules css/sass-modules
    

이렇게 하면 `sass-modules` 라는 폴더가 생기고, 거기에 내용이 그대로 clone된다. 이 놈은 하나의 독립적인 repository처럼 작동한다. 이 놈을 서브모듈이라고 부른다. 그리고 이 놈의 부모 프로젝트(슈퍼 프로젝트라고 부르더라)는 이 서브모듈의 체크썸을 기억하고 있게 된다.

이후엔 서브모듈에서 작업을 한 뒤 commit, push를 그냥 하나의 git 프로젝트인 것처럼 독립적으로 하면 된다. 이후에 슈퍼 프로젝트로 와서 `git status`를 해 보면 서브모듈의 체크썸이 바뀌었다는 표시가 나온다. 역시 `add`, `commit`, `push`하면 된다.

즉, 서브모듈에서 알아서 작업하고 `add`, `commit`, `push`한 뒤, 슈퍼 프로젝트에서 역시 `add`, `commit`, `push`해야 한다는 말이다.

## submodule이 있는 프로젝트를 clone했을 때 처리할 것

submodule이 있는 프로젝트를 clone했을 때 submodule 디렉토리로 가 보면 그냥 텅 비어 있다. 아래 명령어를 내려 줘야 submodule이 제대로 들어 온다.

    git submodule init
    git submodule update
    

이렇게 두 명령어를 쳐 주면 된다.

이상 대략적으로 알아 본 것이다. 더 자세한 설명은 Pro Git의 [&#8216;Git &#8211; 서브모듈&#8217;][1]을 보자.

 [1]: http://git-scm.com/book/ko/Git-%EB%8F%84%EA%B5%AC-%EC%84%9C%EB%B8%8C%EB%AA%A8%EB%93%88