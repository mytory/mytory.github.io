---
title: 대용량 MySQL 쿼리 백업 파일을 터미널에서 직접 임포트하는 방법
author: 안형우
layout: post
permalink: /archives/3189
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36569087
categories:
  - 서버단
tags:
  - MySQL
---
`phpMyAdmin`에서 1기가가 넘는 `SQL` 백업 파일을 임포트하려고 했더니만 용량이 너무 크다고 안 된다고 한다. 그러면서 파일로 직접 임포트하는 방법을 알려 줬다.

나는 학교에서 커리큘럼으로 개발을 배운 적이 없다. 콘솔에서 `MySQL`을 조작하는 방법도 배운 적이 없다. 결국 검색해서 찾아서 했다. 까먹지 않기 위해 적는다.

일단 MySQL에 접속해야 한다. 터미널에서 다음과 같이 적는다.

<pre class="brush: bash; gutter: true; first-line: 1">mysql -u root -p</pre>

내 환경은 윈도우 APM\_SETUP 7이었다. 뭐, MySQL 콘솔에 들어가는데 그런 게 큰 상관은 없겠지만. 만약 안 되면 MySQL 폴더로 가서 하면 된다. APM\_SETUP 폴더의 서버 폴더에 가 보면 MySQL 폴더를 찾을 수 있을 거다. 리눅스에서 어딨는지는 모르겠고. 근데 리눅스에서 `apt-get`이나 뭐 그런 걸로 설치했다면 굳이 MySQL 폴더를 찾을 필요는 없을 거다. 아마도.

MySQL 콘솔로 진입하면 `>` 이 표시밖에 나오지 않는다. 그럼 성공한 거다. 그럼 이제 아래 명령을 친다.

<pre class="brush: bash; gutter: true; first-line: 1">use mydb</pre>

이 명령은 어떤 데이터베이스를 사용할 건지 알려 주는 명령어다. `mydb` 대신 자기 데이터베이스의 이름을 적어 주면 된다. 이 명령을 치면 데이터베이스 채인지 어쩌고 하고 안내가 나온다.

그 다음은 간단하다. sql 파일의 이름을 바탕으로 아래 명령을 내려 준다.

<pre class="brush: bash; gutter: true; first-line: 1">source c:/temp/big-dump.sql</pre>

주의점은, 윈도우라 하더라도 폴더 경로 사이에 적어 주는 게 역슬래시(`\`)가 아니라 슬래시(`/`)라는 점이다.

이 명령을 내리면 뭔가 메시지들이 어지럽게 지나간다. 느긋하게 기다리면 되겠다. SQL 파일에 문제가 없다면 임포트가 잘 될 것이다.

## 한글이 깨지는 경우

한글이 깨지는 경우가 있다. DB인코딩, 콘솔 인코딩, sql 파일 인코딩 중 몇 개가 어떤 방식으론가 영향을 미치는 것 같은데, 다 테스트해보지 않아 모르겠다.

내 경우에는 결국 `euc-kr`로 DB 생성, 윈도우 `cmd` 콘솔에서 `euc-kr` sql 파일로 임포트에 성공했다. `utf-8` DB 생성, 윈도우 `cmd` 콘솔에서 `utf-8` sql 파일로 임포트하니까 한글이 다 깨졌다. `set names utf8` 명령을 내리고 임포트를 해도 마찬가지였다.