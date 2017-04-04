---
title: '[composer] Your requirements could not be resolved to an installable set of packages.'
layout: post
tags:
  - composer
---

`composer update`라고 명령을 내렸다. 그런데 아래 에러 메시지가 나왔다.

    Your requirements could not be resolved to an installable set of packages.

"설치 가능한 패키지 세트로 요구사항을 해결할 수 없습니다" 하는 말인데, 알아먹기 쉽게 말하면 의존성 설정이 서로 안 맞아서 에러가 난 것이다.

예컨대 아래 에러 메시지를 대충 훑어 보고 아래 설명을 보자.

~~~
Loading composer repositories with package information
Updating dependencies (including require-dev)
Your requirements could not be resolved to an installable set of packages.

  Problem 1
    - Conclusion: don't install laravel/framework v5.4.12
    - Conclusion: don't install laravel/framework v5.4.11
    (중략)
    - Conclusion: don't install laravel/framework v5.4.2
    - Conclusion: don't install laravel/framework v5.4.1
    - mmieluch/laravel-vfs-provider 0.0.3 requires illuminate/support 5.0.*|5.1.*|5.2.*|5.3.* -> satisfiable by laravel/framework[v5.3.28], illuminate/support[v5.0.0, v5.0.22, v5.0.25, v5.0.26, v5.0.28, v5.0.33, v5.0.4, v5.1.1, v5.1.13, v5.1.16, v5.1.2, v5.1.20, v5.1.22, v5.1.25, v5.1.28, v5.1.30, v5.1.31, v5.1.41, v5.1.6, v5.1.8, v5.2.0, v5.2.19, v5.2.21, v5.2.24, v5.2.25, v5.2.26, v5.2.27, v5.2.28, v5.2.31, v5.2.32, v5.2.37, v5.2.43, v5.2.45, v5.2.6, v5.2.7, v5.3.0, v5.3.16, v5.3.23, v5.3.4].
    - mmieluch/laravel-vfs-provider 0.0.3 requires illuminate/filesystem 5.0.*|5.1.*|5.2.*|5.3.* -> satisfiable by laravel/framework[v5.3.28], illuminate/filesystem[v5.0.0, v5.0.22, v5.0.25, v5.0.26, v5.0.28, v5.0.33, v5.0.4, v5.1.1, v5.1.13, v5.1.16, v5.1.2, v5.1.20, v5.1.22, v5.1.25, v5.1.28, v5.1.30, v5.1.31, v5.1.41, v5.1.6, v5.1.8, v5.2.0, v5.2.19, v5.2.21, v5.2.24, v5.2.25, v5.2.26, v5.2.27, v5.2.28, v5.2.31, v5.2.32, v5.2.37, v5.2.43, v5.2.45, v5.2.6, v5.2.7, v5.3.0, v5.3.16, v5.3.23, v5.3.4].
    - Can only install one of: laravel/framework[v5.4.0, v5.3.28].
    - don't install illuminate/support v5.3.0|don't install laravel/framework v5.4.0
    - don't install illuminate/support v5.3.16|don't install laravel/framework v5.4.0
    (중략)
    - don't install illuminate/support v5.3.23|don't install laravel/framework v5.4.0
    - don't install illuminate/support v5.3.4|don't install laravel/framework v5.4.0
    - don't install illuminate/filesystem v5.3.0|don't install laravel/framework v5.4.0
    - don't install illuminate/filesystem v5.3.16|don't install laravel/framework v5.4.0
    (중략)
    - don't install illuminate/filesystem v5.2.6|don't install laravel/framework v5.4.0
    - don't install illuminate/filesystem v5.2.7|don't install laravel/framework v5.4.0
    - don't install illuminate/support v5.0.0|don't install laravel/framework v5.4.0
    - don't install illuminate/support v5.0.22|don't install laravel/framework v5.4.0
    (중략)
    - don't install illuminate/support v5.2.6|don't install laravel/framework v5.4.0
    - don't install illuminate/support v5.2.7|don't install laravel/framework v5.4.0
    - Installation request for laravel/framework 5.4.* -> satisfiable by laravel/framework[v5.4.0, v5.4.1, v5.4.10, v5.4.11, v5.4.12, v5.4.2, v5.4.3, v5.4.4, v5.4.5, v5.4.6, v5.4.7, v5.4.8, v5.4.9].
    - Installation request for mmieluch/laravel-vfs-provider ^0.0.3 -> satisfiable by mmieluch/laravel-vfs-provider[0.0.3].
~~~

우선 `laravel-vfs-provider` 0.0.3 버전은 `illuminate/support`과 `illuminate/filesystem`의 `5.0.*|5.1.*|5.2.*|5.3.*` 버전을 요구한다. 이 요구사항은 `laravel/framework`의 5.3.28 버전에 의해 충족된다. 그런데 나는 `composer.json`에 `"laravel/framework": "5.4.*"`라고 적었다. 따라서 요구사항 충돌 에러가 발생한 것이다. 

## 해결

`mmieluch/laravel-vfs-provider`의 웹사이트에 가서 버전을 확인해 본다. 패키지명 앞에 `https://github.com/`이라고 붙이면 될 거다. 아래처럼.

    https://github.com/mmieluch/laravel-vfs-provider
    
가 보면 2017-02-17 현재 최신 버전이 1.0.1이다. `composer.json`을 확인해 보면 아래처럼 명시돼 있다.

    "require": {
        "php": ">=5.4.0",
        "illuminate/support": "^5.0",
        "illuminate/filesystem": "^5.0",
        "league/flysystem-vfs": "^1.0"
    },
    
`illuminate/support`와 `illuminate/filesystem` 버전이 `^5.0`으로 명시돼 있는데, 이건 5.0보다 크거나 같고, 6.0보다 작은 버전을 뜻한다. 그럼 의존성이 서로 맞게 된다.

이제 원래 내 프로젝트의 `composer.json`으로 돌아와서 아래처럼 버전을 고쳐 주자. 원래는 `0.0.3`이었는데, 그냥 버전 1.0대가 모두 가능하게 고쳤다.

    "mmieluch/laravel-vfs-provider": "^1.0.1",
    
그러니까 무사히 업데이트됐다.
    
