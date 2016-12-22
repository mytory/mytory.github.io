---
title: '[bash] /bin/sh^M: bad interpreter'
author: 안형우
layout: post
tags:
  - shell
---

sass 컴파일을 하려고 `watch.sh`를 실행했더니 저런 메시지가 뜨면서 실행되지 않았다. 아래 글에서 해법을 찾을 수 있었다.

    -bash: ./watch.sh: /bin/sh^M: bad interpreter: No such file or directory

sh 파일의 맨 앞에 선언한 인터프리터가 `/bin/sh`인데, 여기에 `^M` 문자가 붙으면서, "`/bin/sh^M` 같은 인터프리터는 없는데?" 하고 에러 메시지가 나온 것이다.

`^M` 문자는 윈도우에서 사용하는 리턴값을 vim이 표현하는 값이라고 한다. 보통은 `\r`로 표현하는 것을 많이 봤을 것이다. 개발자라면 코드를 작성해서 `\r` 문자를 잡아도 될 것이다. 물론 커맨드라인에서 sed를 이용해 간편하게 제거하는 방법이 있다. 제거하는 방법은 아래 글을 참조했다.

[Remove CTRL-M characters from a file in UNIX](http://its.ucsc.edu/unix-timeshare/tutorials/clean-ctrl-m.html)

명령어는 아래와 같다.

    sed -i "s|{^M문자 입력 버튼 누르기}||g" watch.sh
    
`^M문자 입력 버튼 누르기`에서는 <kbd>Ctrl</kbd> + <kbd>v</kbd>, <kbd>m</kbd>을 누르면 된다. 그러면 `^M` 문자가 입력되는 것을 볼 수 있을 것이다. <kbd>Ctrl</kbd>을 떼지 말고 <kbd>v</kbd>, <kbd>m</kbd>을 연이어 누르는 것이 중요하다.

## 해설

- sed는 문서 편집기다. 
- `-i` 옵션은, 변환 결과를 표준 출력으로 내뱉지 말고 원본 파일에 그대로 덮어 쓰라는 옵션이다. 
   원본 파일을 덮어쓰기 싫으면 `>` 파이프를 사용해서 다른 파일로 만들어라. `sed "s|^M||g" watch.sh > watch2.sh`
- `"s|^M||g"`에서 `s`는 Substitude의 약자로 교체하라는 뜻이다.
   `|`는 구분자다. `/`를 구분자로 사용해도 되는데, url 변환을 많이 하다 보니 `|`를 구분자로 사용하는 게 습관이 됐다.
   뒤에 붙은 `g` 플래그는 Global의 약어로, 나오는 모든 것을 바꾸라는 뜻이다. 안 그러면 처음 나오는 거 하나만 바꾼다.
   

