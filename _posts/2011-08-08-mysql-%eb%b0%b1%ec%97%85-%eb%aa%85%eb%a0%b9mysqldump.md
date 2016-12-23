---
title: MySql 백업 명령(mysqldump)
author: 안형우
layout: post
permalink: /archives/1641
aktt_notify_twitter:
  - yes
daumview_id:
  - 36687022
categories:
  - 서버단
tags:
  - MySQL
---
자, 아이디는 mytory 이고, 패스워드는 audqkrl18fhak 라고 가정하자.

백업해야 하는 DB는 mytorydb 다.

그럼 명령어는 아래와 같다. 그냥 콘솔에서 치면 된다. 굳이 mysql 접속하거나 할 거 없다.

리눅스라면 $ 콘솔일 거고 윈도우라면 C:\> 콘솔이겠지.

<pre>mysqldump -u<strong>mytory</strong> -p<strong>audqkrl18fhak</strong> mytorydb &gt; mytorydb.sql</pre>

이렇게 써 주면 된다.

이거 몰라서 한참 헤맸다.

<pre>mysqldump -u[id] -p[password] dbname &gt; dbname.sql</pre>

이렇게 써 있는데 -p[audqkrl18fhak] 라고 아무리 쳐도 나오는 건 아래 메세지뿐.

<pre>mysqldump: Got error: 1045: Access denied for user 'root'@'localhost' (using password: YES) when trying to connect</pre>

그래서 한참 검색을 했다. 나중에야 [패스워드 입력법을 알려주는 글을 발견][1]해서 다행. 이렇게 설명돼 있었다.

> <pre>Try placing a '=' in between --password lose like:
--password=lose
If you use -p, then there can be no space between the -p and the password, i.e. '-plose'.</pre>

이렇게 친절하게 설명할 것이지 말야!

## 옵션 몇 가지

전체 DB를 백업하려면 명령어는 아래와 같다.

<pre>mysqldump -u<strong>mytory</strong> -p<strong>audqkrl18fhak</strong> -A &gt; mytorydb.sql</pre>

DB 몇 개를 골라서 백업하려면 아래와 같이 입력한다.

<pre>mysqldump -u<strong>mytory</strong> -p<strong>audqkrl18fhak</strong> --databases mytorydb1 mytorydb2 mytorydb3 &gt; mytorydbs.sql</pre>

특정 테이블만 백업

<pre>mysqldump -u<strong>mytory</strong> -p<strong>audqkrl18fhak</strong> mytorydb1 mytable &gt; mytorydb_mytable.sql</pre>

 [1]: http://stackoverflow.com/questions/148951/does-mysqldump-password-really-do-what-it-says