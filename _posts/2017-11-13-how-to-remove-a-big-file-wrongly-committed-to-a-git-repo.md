---
title: 'Git에 실수로 큰 파일을 커밋했을 때 제거하는 방법'
layout: post
author: 안형우
tags: 
  - git
description: filter-branch 명령어를 이용한다
---

자세한 설명은 [How to remove a big file wrongly committed to a Git repo][1]를 참고하자. 아래 명령어를 이용한다.

[1]: https://murze.be/2017/10/remove-big-file-wrongly-committed-git-repo/

~~~~ bash
git filter-branch --tree-filter 'rm path/to/your/bigfile' HEAD

git push origin master --force
~~~~

만약 폴더째로 삭제해야 하면 아래처럼 `rm`에 `-rf` 옵션을 붙여 준다.

~~~~ bash
git filter-branch --tree-filter 'rm -rf path/to/your/folder' HEAD

git push origin master --force
~~~~

commit history 변경했으니, 강제 푸시가 아니면 푸시되지 않는다. 공동 작업자가 있다면 `git pull -f`를 사용해야 하며 작업 내용이 날아갈 수 있다고 미리 알린 다음에 푸시해야 할 것이다. 

강제 푸시 전에 모든 작업자가 작업 내용을 푸시하게 하고, 나도 최신으로 pull한 뒤에 하자. 그래야 작업 내용이 날아가지 않을 것이다.

당연한 이야기지만 commit할 필요가 없는 큰 파일은 다시 커밋되지 않게 `.gitignore`에 추가하자.

그리고 이런 처리를 한 다음에 `.git`폴더 용량을 확인해 봐도 용량이 변하지 않을 수도 있다. 내가 그랬는데, 다시 clone을 하자 용량이 확 준 것을 확인할 수 있었다.