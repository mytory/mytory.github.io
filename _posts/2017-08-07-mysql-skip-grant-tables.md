---
title: 'MySQL 비밀번호 없이 접속하기'
layout: post
author: 안형우
tags: 
  - mysql
  - tip
description: '로컬 작업시엔 비밀번호를 없애는 게 편할 수도 있다. skip-grant-tables 옵션을 활용한다.'
image: /uploads/2017/skip-grant-tables.jpg
---

로컬에서 작업할 때는 MySQL에 차라리 패스워드가 없는 편이 편할 수도 있다. mysql 설정 파일의 `[mysqld]` 섹션에 `skip-grant-tables`라고 문구를 추가한다.

    [mysqld]
    # ...
    skip-grant-tables

우분투의 경우 `[mysqld]`섹션이 있는 파일 경로는 `/etc/mysql/mysql.conf.d/mysqld.cnf`다. 위 파일에 있지 않은 경우 mysql 설정이 있는 폴더에서 아래 명령을 실행해 찾아 보면 된다.

    grep \\[mysqld\\] -r .
