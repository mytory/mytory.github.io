---
title: '[Shell] 특정 문자열이 들어있는 파일 찾기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2211
aktt_notify_twitter:
  - yes
daumview_id:
  - 36630739
categories:
  - 서버단
tags:
  - shell
---
<pre>find -name "*.php" -o -name "*.html" | xargs fgrep -il &#039;test&#039;</pre>

이렇게 쓰면 현재 폴더를 포함한 모든 하위 폴더에서 php나 html 파일 중에 test라는 문자열이 들어가 있는 것을 다 찾아서 목록을 뿌려 준다.

`fgrep`은 `grep`과 달리 정규식을 사용하지 않는 명령어다.

`xargs`는 파이프로 넘어온 결과들을 줄별로 매개변수로 던져주는 역할을 한다. 사실 `find`에는 `-exec` 라는 옵션이 있어서 그닥 필요하지 않다고 한다. 하지만,

<pre>ls f* | xargs cat</pre>

위와 같은 식으로 사용하면 f로 시작하는 모든 파일의 내용을 출력하게 된다.

## 궁금한 점

그런데 궁금한 게 있다.

<pre>ls -al | grep 찾는문자열</pre>

이라고 쓰면 &#8216;찾는문자열&#8217;을 가진 해당 열이 출력될 거다. 예를 들면

<pre>ls -al | grep load</pre>

라고 썼다고 하자.

<pre>-rw-r--r--    1 mytory  mytory    2546  2  2 12:48 wp-load.php</pre>

이런 결과가 출력될 거다.

자, `grep`은 `xargs` 없이도 그냥 파이프만으로 결과를 넘겨받았다. 그럼 `xargs`는 언제 사용하는 거지?

<pre>ls | cat</pre>

이렇게 쓰니까 `cat`은 작동하지 않았다. 뭐지;;

이게 왜 작동하지 않는 건지, `xargs`가 하는 정확한 기능은 뭔지, 아는 분은 댓글로 답해 주시면 감사하겠다! ^^