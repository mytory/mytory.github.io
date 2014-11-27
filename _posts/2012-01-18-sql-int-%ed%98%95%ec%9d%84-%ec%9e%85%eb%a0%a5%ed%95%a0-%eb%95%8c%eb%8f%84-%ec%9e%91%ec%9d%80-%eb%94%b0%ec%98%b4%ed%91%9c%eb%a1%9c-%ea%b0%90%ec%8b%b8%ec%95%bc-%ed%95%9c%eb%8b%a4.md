---
title: '[SQL] INT 형을 입력할 때도 작은 따옴표로 감싸야 한다'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2083
aktt_notify_twitter:
  - yes
daumview_id:
  - 36656256
categories:
  - 서버단
tags:
  - MySQL
---
[SQL 인젝션][1]에 대해서 한두번 쯤은 들어 봤을 것이다.

난 많은 걸 알지는 못하기 때문에, 심심풀이로 한 번 주소 표시줄의 page=1 부분에 page=1 or 1=1 이라고 넣어 봤다. 와우~ 왠걸 그러니까 모든 글이 다 불러와 지는 것이다.

내가 만들던 것은 모든 사람의 글을 한 테이블에 저장하는 시스템이었다. 각 글 별로 게시판의 ID가 있고, 특정 게시판에서는 자기 게시판에 해당하는 글만 불러 와야 한다.

그런데, page=1 or 1=1 이라고 입력하니까 게시판 ID에 상관없이 모든 글이 불러와 졌다.

옆에 있던 친구에게 물어 봤더니 where 절에 INT형이라고 해도 따옴표를 꼭 붙여야 한다고 했다. 따옴표를 붙여도 SQL에서는 잘 인식을 하며, 그렇게 해야 저런 어이없는 공격(?)에 당하지 않는다는 것이다.

여튼간에 하나 배웠다.

참고로 [PHP의 SQL Injection 방어 함수][2]도 있다. 참고해 보면 도움이 될 거다.

 [1]: http://msdn.microsoft.com/ko-kr/library/ms161953.aspx
 [2]: http://mytory.net/archives/961 "[PHP] sql injection 방어 함수, mysql_real_escape_string"