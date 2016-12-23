---
title: 아파치 rewrite module 켜서 .htaccess 활성화하기(우분투 기준)
author: 안형우
layout: post
permalink: /archives/108
aktt_notify_twitter:
  - yes
daumview_id:
  - 37216901
categories:
  - 서버단
tags:
  - apache
---
일단 그린비&단미 블로그에서 본 [태터툴즈 설치때 아파치 rewrite 모듈문제 해결법][1]에 큰 신세를 졌음을 밝혀야겠다.

## .htaccess 파일은 무엇인가?

.htaccess 파일은 apache 서버에서 각 폴더에 위치하면서 아파치 세팅을 폴더별로 변경할 수 있도록 하는 파일인데, 최근에는 주소 표시줄을 간단하게 고치는 데 많이 사용한다. 사용법은 간단하다. .htaccess라는 이름의 파일을 생성하고, 문법에 맞게 내용을 채우고, 적용하기 원하는 폴더에 넣으면 된다. .htaccess 앞에 붙는 점(.)은 리눅스 에서 숨김파일을 의미하는 파일명이다. 더도덜도 말고 정확히 &#8216;.htaccess&#8217;라는 이름으로 파일을 만들어야 한다. 윈도우에서 그냥 만들려고 하면 에러가 날 테고, 에디트 플러스 같은 데 들어가서 새 이름으로 저장을 선택하고 .htaccess 라는 이름으로 저장을 하면 만들어진다.

우분투에서 처음 apache2를 설치하면 rewirte module이 활성화 돼있지 않다. 무슨 말인고 하니, .htaccess 파일을 사용할 수 없다는 말이다.

아마 에러 로그를 살펴보면 아래와 같은 줄이 써 있을 것이다.

<pre class="brush:plain">.htaccess: Invalid command &#039;RewriteEngine&#039;, perhaps misspelled or defined by a module not included in the server configuration</pre>

.htaccess 파일은 자신이 위치한 폴더와 하위폴더에 영향을 미치는 아파치 설정 파일이다. 그런데 요놈이 요즘 많이 사용된다. 주소를 짧게 줄여 주기 때문이다.

독자가 프로그래머일 것이라고 가정하고 말한다. GET 방식으로 변수를 넘길 때 이런 식으로 주소 표시줄을 쓸 것이다.

<pre class="brush:plain">http://mywebsite.com/content/index.php?no=500</pre>

index.php 파일을 불러오되, $\_GET\[no\](PHP4까지는 그냥 $no로 받을 수도 있었지만 보안 문제 때문에 5부터는 그렇게 할 수없게 기본설정을 해 두었다. 만약 php5에서도 php4처럼 사용하고 싶다면 php.ini에서 register\_globals = On으로 설정하면 된다.)에 500이란 값을 넣으라는 뜻인 걸 알고 있을 것이다.

그런데 .htaccess를 사용하면 이 주소를 아래와 같은 형식으로 바꿀 수 있다.

<pre class="brush:plain">http://mywebsite.com/content/500</pre>

훨씬 간편한 주소가 되는 것이다.

이렇게 하는 이유는, 검색엔진이 주소를 읽기 쉽게 하기 위해서라고 한다.

## rewrite_module은 그럼?

자, 앞서 말했듯, .htaccess 파일을 사용하기 위해서는 rewrite_module을 활성화시켜야 한다.

우분투에서 설치하는 아파치는 기본적으로 이 rewrite_module이 비활성화 돼있다고 한다.

(rewrite_module이 활성화돼있는지 아닌지 확인하는 방법은 위에서 소개한 [태터툴즈 설치때 아파치 rewrite 모듈문제 해결법][1]에 나와있으니 참고하기 바란다.)

그렇다면, 활성화하기 위해서, 일단 터미널에서 다음 명령어를 입력한다. 물론 관리자 권한으로 입력해야 한다. 관리자 모드로 접속하기 않는 경우가 많을 테니, 관리자 권한으로 명령을 실행할 수 있는 sudo를 앞에 붙여서 명령어를 쓰도록 하겠다.

<pre class="brush:plain">sudo a2enmod rewrite</pre>

그리고 역시 root 권한으로 아파치 설정파일을 손봐줘야 한다.

이번엔 Alt+F2를 눌러서 노틸러스(우분투의 파일 탐색기)를 관리자 권한으로 실행시켜 보자.

Alt+F2를 눌렀을 때 뜨는 창에 아래와 같이 입력하고 엔터를 치자.

<pre class="brush:plain">gksu nautilus</pre>

그러면 관리자 권한으로 노틸러스가 실행된다.

(물론 굳이 Alt+F2를 누르지 않고 터미널에서 바로 입력해도 무방하다.)

## /etc/apache2/apache2.conf 수정

자, 탐색을 해서 /etc/apache2/apache2.conf 파일을 수정하자. gedit로 열면 되겠다. 아마 더블클릭하면 될 거다. 실행할 거냐 뭐할 거냐 이런 식으로 묻는다면 &#8216;보기&#8217;를 선택한다.

여기에 다음 설정을 추가해 준다.

<pre class="brush:plain">&lt;IfModule mod_rewrite.c&gt;
rewriteEngine On
&lt;/IfModule&gt;</pre>

그리고 또 하나 남았다.

## /etc/apache2/sites-enabled/000-default 수정

또 탐색을 해서 /etc/apache2/sites-enabled/000-default 파일을 열자.

여기에서 다음을 수정한다.

<pre class="brush:plain">&lt;Directory /var/www/&gt;
Options Indexes FollowSymLinks MultiViews
AllowOverride all
Order allow,deny</pre>

위에서 AllowOverride 항목이 아마 none이나 deny로 돼 있을 것이다. 저걸 all로 고쳐 준다.

all이 보안에 별로 안 좋고 다른 걸 써 주는 게 낫지 않냐는 의견을 본 적도 있는데 내가 모르니까 패스한다.

만약 가상 호스트(virtual host)를 사용하고 있다면 거기서도 AllowOverride가 none이나 deny로 돼 있지 않은지 확인해 봐야 한다.

## 아파치 재시작(apache restart)

다 해놓고 왜 안되지 고민하지 않길 바란다.

아파치 재시작 명령어를 입력해 줘야 한다.

<pre class="brush:plain">sudo /etc/init.d/apache2 restart</pre>

위 명령어를 입력하면 종료. 이제 잘 될 것이다.

만약 잘 안 된다면? 이럴 땐 반드시 에러 로그를 확인한다. 그게 편한 길이다.

<span style="font-size: 20px; font-weight: bold;">.htaccess의 권한 확인</span>

나는 다음과 같은 에러 로그가 찍혀 있었다.

<pre>[Tue Apr 19 13:27:58 2011] [crit] [client 127.0.0.1] (13)Permission denied: /home/mytory/.htaccess pcfg_openfile: unable to check htaccess file, ensure it is readable</pre>

근데 이게 환장할 노릇인 게, 분명 .htaccess를 777로 권한 변경을 해 줬기 때문이었다.

검색을 해 보고서야 알았다. mytory 폴더가 읽을 수 없게 돼 있었다. 즉, 폴더와 .htaccess 권한 둘 다를 아파치가 읽을 수 있게 만들어 줘야 한다.

.htaccess는 기본적으로 숨김파일이다. 노틸러스에서 **편집-기본 설정** 으로 들어간 후 **숨김/백업파일 보기**에 체크를 해 주면 볼 수 있다.(혹은 Ctrl+H)

파일을 선택하고 속성을 보면 권한 탭이 있다. 여기서 누가 소유자며 누가 읽을 수 있는지 등을 설정할 수 있다.

[덧] 위대로 다 실행했는데 안 되면 다른 원인이 있는 것이다. rewrite모듈 말고 다른 원인을 찾아 보기 바란다. 예컨대, 나는 rewrite 모듈 때문이 아니라 register_grobals 때문에 계속 오류가 났었다. 이 글의 각주 1번을 참고하면 도움이 될 것이다.

 [1]: http://lica1.tistory.com/entry/%ED%83%9C%ED%84%B0%ED%88%B4%EC%A6%88-%EC%84%A4%EC%B9%98%EB%95%8C-%EC%95%84%ED%8C%8C%EC%B9%98-rewrite-%EB%AA%A8%EB%93%88%EB%AC%B8%EC%A0%9C-%ED%95%B4%EA%B2%B0%EB%B2%95