---
title: 'MySQL PID 에러와 Can&#8217;t read from messagefile 에러'
author: 안형우
layout: post
permalink: /archives/12624
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12624-mysql-language-error.md
categories:
  - 서버단
tags:
  - MySQL
---
라즈베리 파이, 그러니까 뭐 데비안이라고 생각하면 되겠다. 거기서 마리아DB를 컴파일해서 깔았다가 생각이 바뀌어 mysql을 `apt-get`으로 깔고 다시 생각이 바뀌어 mysql을 삭제하고 다시 mariadb를 컴파일해 깔았다. 그런데 첫 컴파일 때는 잘 돌아가던 mariadb가 두 번째로 깔았을 땐 안 돌아가는 거 아닌가? 아래와 같은 에러 메시지를 뿜고 말이다.

    The server quit without updating PID file (/var/run/mysqld/mysqld.pid). debian
    

졸라 헤맨 끝에 `/var/log/syslog`를 보니 제대로 된 에러 메시지를 찾을 수 있었다. 아래와 같은 에러 메시지를 뿜고 있었다.

    [Warning] An old style --language or -lc-message-dir value with language specific part detected: /usr/share/mysql/
    [Warning] Use --lc-messages-dir without language specific part instead.
    [ERROR] Can't read from messagefile '/usr/share/mysql/errmsg.sys'
    [ERROR] Aborting
    

일단 `/usr/share/mysql/errmsg.sys` 파일을 만들어 봤다. 아무 소용이 없었다. 검색을 막 때려 보니 [&#8216;[ERROR] Can&#8217;t read from messagefile&#8217;][1]라는 글이 있었다. `my.cnf` 파일에 특정 줄을 추가해 주라는 거였는데 난 지금 내 mariadb가 사용하는 `my.cnf` 파일이 어딨는지 모른단 말이다. 그래서 아래 명령으로 실행을 해 봤다. 제대로 작동했다.

    /usr/local/mysql/bin/mysqld_safe --language=/usr/local/mysql/share --user=mysql
    

즉, `--language=/usr/local/mysql/share` 부분을 추가한 거다. `/usr/local/mysql/share`에 `english`며 `dutch`며 하는 언어 파일들이 있었기 때문이다. `/usr/local/mysql/share/english`에 가 보니 `errmsg.sys` 파일도 있었다.

그러니까, 한 마디로 `my.cnf` 파일에 언어 폴더가 제대로 지정돼 있지 않아서 발생하는 에러였다고 정리할 수 있겠다. 근데 `my.cnf`에 설정할 때는 어떻게 하는 건지는 모르겠다;; 더 찾을 시간이 없어서 패스. 이정도면 도움이 됐겠지.

 [1]: http://bugs.mysql.com/bug.php?id=69677