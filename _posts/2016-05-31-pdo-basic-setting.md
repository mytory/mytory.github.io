---
title: 'PDO 접속 기본 설정 코드'
layout: post
tags:
  - php
  - pdo
---

자꾸 검색해서 찾아야 해서 기본적으로 사용하는 코드 저장.

~~~ php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=myDB;charset=utf8mb4', 'username', 'pass');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // fetch시 객체로 리턴.
// $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // fetch시 배열로 리턴.
~~~