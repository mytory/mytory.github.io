---
title: "git에서 euc-kr로 된 파일 diff 시 한글 제대로 표시하기"
layout: "post"
category: "develope tool"
tags: 
    - git
---

euc-kr로 된 프로젝트 작업을 하고 있는데, 이게 커맨드 라인에서 `git diff`를 하면 한글이 다 깨져 나온다. 터미널은 UTF-8이고, 프로젝트는 EUC-KR이라 그렇다. 귀찮아서 `alias`로 `iconv`를 걸어 놓고 작업했지만... `diff` 옵션을 충분히 줄 수 없는 문제가 있어서... 해법을 찾아 나섰다. 그리고 [`textconv`](https://git.wiki.kernel.org/index.php/Textconv#.gitattributes)라는 옵션이 있다는 걸 알게 됐다.

보니까 JPG나 ODT 같은 바이너리 파일을 diff로 비교할 때 사용하는 옵션인 거 같은데, 인코딩 변환에도 얼마든 사용할 수 있다.

자신의 홈 디렉토리를 보면 `.gitconfig`라는 파일이 있다. 여기에 아래와 같은 걸 추가한다.

	[diff "euckr"]
	      textconv="iconv -f euc-kr -t utf-8"

나는 이름을 `euckr`이라고 붙였는데 자유롭게 붙이면 된다. 그리고 `textconv` 옵션으로 사용할 툴을 적어 준다. 나는 iconv를 이용해서 인코딩 변환을 하도록 툴을 적었다. `odt` 같은 것이라면 `odt2txt.sh` 같은 명령어를 적으면 될 것이다. 

그리고 자신의 프로젝트에 가서 [`.gitattributes`](https://www.kernel.org/pub/software/scm/git/docs/gitattributes.html)라는 파일을 생성한다. 이 파일은 폴더 단위로 적용할 수 있나 보다. 적용하기 원하는 폴더에 이 파일을 두면 되는 듯하다. 이 파일의 내용은 아래와 같다.

	*.php diff=euckr
	*.css diff=euckr
	*.js diff=euckr

만들어 둔 diff 세트를 특정 파일명 패턴에 적용하는 것이다.

이렇게 하고 `git diff`를 하니 euc-kr이 깔끔하게 한글로 표시된다.