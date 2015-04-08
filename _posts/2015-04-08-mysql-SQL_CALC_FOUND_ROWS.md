---
title: "MySQL, 페이징할 때 테이블 긁는 쿼리 하나로 전체 개수까지 받아 오기(SQL_CALC_FOUND_ROWS)"
layout: "post"
category: "serverside"
tags: 
	- MySQL
---

아래처럼 하면 된다.

    SELECT SQL_CALC_FOUND_ROWS * FROM article ORDER BY id DESC LIMIT 0, 10;
    SELECT FOUND_ROWS();

위의 것은 내용을 가져 오는 쿼리고, 아래 것은 LIMIT 없이 실행했을 경우의 전체 개수를 받는 쿼리다.

보면 알겠지만 `SELECT`하는 필드 앞에 `SQL_CALC_FOUND_ROWS`라는 키워드를 적어 준 게 핵심이다. 그렇게 하면 MySQL이 전체 개수를 기억해 뒀다가 `SELECT FOUND_ROWS()`를 실행하면 방금 찾은 게 몇 개였는지 알려 주는 것이다.