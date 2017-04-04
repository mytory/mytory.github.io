---
title: 'CIA 요원들이 사용한 git alias'
layout: post
author: 안형우
tags: 
  - git
description: 위키리크스의 폭로로 CIA 개발자들도 git를 사용했다는 게 드러났다. 그들이 사용한 git alias를 살펴 본다.
image: /uploads/2017/cia.png
---

3월 7일, 위키리크스가 2013~2016년 사이 생산된 CIA 문건 약 8천 건을 폭로했다. 이 문건을 보면 삼성 스마트 TV를 꺼진 척하게 한 뒤(fake off 모드) 대화를 녹음해 CIA로 전송하게 하는 해킹(다행히 이 문건에 따르면 물리적 접촉을 해야 이렇게 해킹할 수 있다.), 썬더볼트를 이용해 맥북의 EFI에 침투하는 해킹 등을 이용한 것을 알 수 있다. 국가가 개인을 사찰하는 것은 엄격히 금지돼야 하지만, 아마도 국가는 결코 멈추지 않을 것이다.

여튼, 가디언 기사를 보다가 [CIA 개발자들이 git 설정을 어떻게 하는지 적어 둔 매뉴얼](https://wikileaks.org/ciav7p1/cms/page_7995412.html)도 보게 됐다. alias를 쓰더라. 나도 한 번 그 alias를 써봤다.


`~/.gitconfig` 파일에 아래 코드를 추가하면 `git b` 형식으로 사용할 수 있다.

~~~
[alias]
    b = branch
    ca = commit --amend
    ci = commit
    co = checkout
    f = fetch --all --prune
    gui = !sh -c '/usr/local/git/libexec/git-core/git-gui'
    po = push origin
    st = status --short --branch
    lg = log --color --graph --pretty=format:'%Cred%h%Creset -%C(yellow)%d%Creset %s %Cgreen(%cr)%C(bold cyan) <%an>%Creset' --abbrev-commit
~~~

개인적으로 `ca`, `ci`, `co`, `po` 같은 `alias`가 그리 맘에 들진 않는다. 짧은 타자는 그냥 외우는 편이 낫다고 본다. 자기 머신에만 익숙해지는 것보다는 범용적으로 사용하는 명령어에 익숙해지는 것을 나는 선호한다.

`git lg` 단축은 재밌는데, 로그에 색깔을 입혀 준다. 예뻐서 나도 써 볼까 싶다.

`git f`에서 `--prune` 옵션은 fetch하기 전에 원격에 더이상 존재하지 않는 참조를 연결하는 걸 제거한다고 설명돼 있는데, 안 써 봐서 뭔지 잘 모르겠다.




