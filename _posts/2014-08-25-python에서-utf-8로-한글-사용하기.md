---
title: python에서 utf-8로 한글 사용하기
author: 안형우
layout: post
permalink: /archives/13172
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13172-use-utf8-in-python.md
categories:
  - 서버단
tags:
  - encoding
  - Python
---
파일에 아래 문구를 적어 줘야 한다.

    # -*- coding: utf-8 -*-
    import sys
    reload(sys)
    sys.setdefaultencoding('utf-8')
    

우선 `# -*- coding: utf-8 -*-` 이 놈은 1,2라인에 들어가 있어야 한다. 자세한 문법은 인코딩 때문에 에러가 발생할 때 나오는 에러 메시지에 있는 URL에 가 보면 알 수 있다. 에러 메시지는 아래처럼 보인다.

      File "filename.py", line 17
    SyntaxError: Non-ASCII character 'xea' in file filename.py on line 18, but no encoding declared; see http://www.python.org/peps/pep-0263.html for details
    

보면 더 자세한 내용을 알려면 여길 봐라 이렇게 나오는 건데, [Defining Python Source Code Encodings][1]이라는 문서다.

    import sys
    reload(sys)
    sys.setdefaultencoding('utf-8')
    

이 놈은 표준출력(stdout)의 인코딩을 정하는 놈이다. 이렇게 써 줘야 한글이 포함된 결과물이 터미널에서 잘 출력된다. 가령 `>` 파이프로 넘기거나 할 때 오류없이 넘길 수 있다.

 [1]: http://legacy.python.org/dev/peps/pep-0263/