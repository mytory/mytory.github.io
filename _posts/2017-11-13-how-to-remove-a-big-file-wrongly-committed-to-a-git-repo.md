---
title: 'Git에 실수로 큰 파일을 커밋했을 때 제거하는 방법'
layout: post
author: 안형우
tags: 
  - git
description: filter-branch 명령어를 이용한다
image: /uploads/2017/KRACK-vulnerability-and-dealing-with.jpg
---

자세한 설명은 [How to remove a big file wrongly committed to a Git repo][1]를 참고하자. 아래 명령어를 이용한다.

[1]: https://murze.be/2017/10/remove-big-file-wrongly-committed-git-repo/

~~~~
git filter-branch --tree-filter 'rm path/to/your/bigfile' HEAD

git push origin master --force
~~~~

예전 기록을 변경했으니, 강제 푸시가 아니면 푸시되지 않는다. 공동 작업자가 있다면 미리 알린 다음에 푸시해야 할 것이다.
