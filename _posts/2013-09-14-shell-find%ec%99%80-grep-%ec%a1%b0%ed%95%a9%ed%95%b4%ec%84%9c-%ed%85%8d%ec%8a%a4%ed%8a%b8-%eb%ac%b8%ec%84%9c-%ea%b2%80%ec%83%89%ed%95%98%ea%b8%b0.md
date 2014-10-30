---
title: '[Shell] find와 grep 조합해서 텍스트 문서 검색하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10905
daumview_id:
  - 49934458
categories:
  - 서버단
tags:
  - shell
---
<pre>find . -name "*.css" -print | xargs grep --color=auto -nH "screen-reader-shortcut"</pre>

뭐 별다른 건 없고 위처럼 검색하면 된다.

그런데 `min.css` 처럼 한 줄에 모든 내용이 다 들어가 있는 경우 골치가 아프다. grep이 찾았다면서 파일 하나를 다 출력해 주니 말이다. 그런 경우엔 아래처럼 `regex` 옵션을 사용해 주면 된다.

<pre>find . -regex ".*[^(min)]\.css$" -print | xargs grep --color=auto -nH "screen-reader-shortcut"</pre>

## `find`의 옵션

*   `-name` : 파일명 검색
*   `-regex` : 정규식으로 파일명 검색
*   `-print` : 결과를 Standard Output으로 넘겨 준다. 그렇게 해야 `xargs`로 각각의 줄을 `grep`에 넘겨줄 수 있나보다.

## 파이프 사용할 때

*   `xargs` : 그냥 파이프를 쓰면 Standard Output을 통째로 넘겨 주는데, 이걸 쓰면 한 줄씩 인자값으로 넘기나 보다.

## `grep`의 경우

*   `--color=auto` : 검색 결과에 색깔 입히는 거
*   `-n` : 줄번호 출력
*   `-H` : 파일명 출력. 근데 사실 파일이 하나 이상이면 파일명은 기본으로 나온다.