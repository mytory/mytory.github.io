---
title: MySQL 백업 명령(mysqldump)
author: 안형우
layout: post
permalink: /archives/1641
date_modified: 2020-09-06 19:29
categories:
  - 서버단
tags:
  - MySQL
---
자, 아이디는 `mytory` 이고, 패스워드는 `mypass` 라고 가정하자.

백업해야 하는 DB는 `mydb` 다.

그럼 명령어는 아래와 같다. 그냥 콘솔에서 치면 된다. 굳이 mysql에 접속하거나 할 거 없다.

리눅스라면 프롬프트가 `$`이나 `#`으로 끝나는 터미널일 것이고 윈도우라면 `C:\>`가 표시되는 터미널일 것이다.

아래처럼 명령어를 쓰면 된다.

~~~ bash
mysqldump -umytory -pmypass mydb > mydb.sql
~~~

혹은 아래처럼 `-p` 뒤에는 비운다. 비우는 건 왜 비우는지 아래에서 설명한다.

~~~ bash
mysqldump -umytory -p mydb > mydb.sql
~~~

사실 매뉴얼에서 본 내용은 아래와 같다.

~~~ bash
mysqldump -u[id] -p[password] dbname > dbname.sql
~~~

매뉴얼에는 이렇게 써 있는데 `-p[mypass]` 라고 아무리 쳐도 나오는 건 아래 메세지뿐이었다.

    mysqldump: Got error: 1045: Access denied for user 'root'@'localhost' (using password: YES) when trying to connect

그래서 한참 검색을 했다. 나중에야 [패스워드 입력법을 알려주는 글을 발견][1]해서 다행. 이렇게 설명돼 있었다.

> Try placing a '=' in between --password lose like:  
> `--password=lose`  
> If you use `-p`, then there can be no space between the `-p` and the password, i.e. `'-plose'`.

이렇게 친절하게 설명할 것이지! 문서의 문법을 모르는 초보의 비애였다…

## `-p` 뒤에 패스워드를 입력하지 않아도 된다

아래처럼 쓰면 패스워드를 입력하라는 프롬프트가 한 번 나오게 되고, 패스워드를 입력해 주면 백업이 진행된다.

~~~ bash
mysqldump -umytory -p mydb > mydb.sql
~~~

`-p` 뒤에 아무것도 적지 않으면 "패스워드가 있는 사용자인데(없는 사용자도 있다), 명령문에 암호를 적지는 않을 게. 패스워드 입력하는 프롬프트를 띄워 줘" 하는 의미가 된다. 

이렇게 하는 이유는 보안 때문이다. 명령문에 암호를 적으면 터미널의 명령어 기록에 데이터베이스의 암호가 남는다. 예컨대 리눅스 bash의 경우 터미널 명령어 기록은 홈 폴더의 `.bash_history`라는 파일에 남게 되는데 이 파일을 까보면 mysql의 패스워드를 알 수 있게 되는 것이다.

따라서 보안을 위해서는 터미널 명령문에 암호를 적기 보다는 그냥 `-p` 옵션만 붙여서 사용해야 한다.

## 옵션 몇 가지

전체 DB를 백업하는 명령어는 아래와 같다.

~~~ bash
mysqldump -umytory -pmypass -A > mydb.sql
~~~

DB 몇 개를 골라서 백업하려면 아래와 같이 입력한다.

~~~ bash
mysqldump -umytory -pmypass --databases mydb1 mydb2 mydb3 > mydbs.sql
~~~

특정 테이블만 백업하는 방법은 아래와 같다.

~~~ bash
mysqldump -umytory -pmypass mydb1 mytable > mydb_mytable.sql
~~~



[1]: http://stackoverflow.com/questions/148951/does-mysqldump-password-really-do-what-it-says
