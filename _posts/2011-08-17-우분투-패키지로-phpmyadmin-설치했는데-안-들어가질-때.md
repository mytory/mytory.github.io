---
title: 우분투 패키지로 phpmyadmin 설치했는데 안 들어가질 때
author: 안형우
layout: post
permalink: /archives/1711
aktt_notify_twitter:
  - yes
daumview_id:
  - 36681787
categories:
  - 기타
tags:
  - Ubuntu Family
---
아마도 아래 명령어로 설치했거나, 시냅틱 패키지 관리자 내지는 우분투 소프트웨어에서 phpmyadmin을 설치했을 것이다.

<pre>sudo apt-get install phpmyadmin</pre>

그런데 이놈이 http://localhost/phpmyadmin 으로 들어가지지 않는 경우가 있다.

그럴 때는 아래 명령어로 아파치 설정 파일을 열어서 편집을 해야 한다.

<pre>sudo vi /etc/apache2/apache2.conf</pre>

그래서 적당한 곳에 아래 설정을 추가한다. (그냥 속편히 맨 아래 넣자.)

<pre># Enable PhpMyAdmin
Include /etc/phpmyadmin/apache.conf</pre>

다 하고 나면 당연히 아파치를 재시작해야 할 거다.

<pre>sudo /etc/init.d/apache2 restart</pre>

그러면 잘 접속된다.

## dekiwiki를 사용하고 있는 경우

dekiwiki뿐 아니라 위키 페이지들을 사용하는 경우에 같은 문제가 발생할 수 있다.

http://localhost/phpmyadmin 으로 접속했을 때 phpmyadmin 이라는 제목의 문서를 편집하는 페이지로 가는 경우다.

위키들이 새 문서를 만들 때 저런 식으로 문서 제목을 주소에 바로 적어 버리는 형식을 사용하기 때문에 그런 거다.

따라서 예외 처리를 해 줘야 한다. [dekiwiki 사용자가 phpmyadmin을 설정하려면 어떻게 해야 하는지 설명한 페이지][1]를 참고했다.

<pre>sudo ln -s /usr/share/phpmyadmin/ /var/www/dekiwiki/phpmyadmin</pre>

이렇게 한 다음 다음 파일을 편집한다. 나는 gedit를 사용하겠다.

<pre>sudo gedit /etc/apache2/sites-available/dekiwiki</pre>

그리고

<pre>RewriteCond %{REQUEST_URI} !^/(@api|editor|skins|config|deki)/</pre>

이렇게 써 있는 줄을 찾아서,아래쪽에 다음 줄을 추가한다.

<pre>RewriteCond %{REQUEST_URI} !/phpmyadmin/?</pre>

phpmyadmin을 예외로 하라는 거다.

이렇게 다 했으면 아파치를 재시작한다.

<pre>sudo /etc/init.d/apache2 restart</pre>

&nbsp;

 [1]: http://developer.mindtouch.com/en/kb/Installing_phpMyAdmin_for_database_administration