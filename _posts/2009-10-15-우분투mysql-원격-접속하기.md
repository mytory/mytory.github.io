---
title: '[우분투]mysql 원격 접속하기'
author: 안형우
layout: post
permalink: /archives/72
aktt_notify_twitter:
  - yes
daumview_id:
  - 37246231
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
우분투라고 썼지만, 우분투에만 해당하지도 않을 듯싶다.

mysql에 원격접속을 하기 위해서는 일단 mysql 설정을 손봐 줘야 한다.

`/etc/mysql/my.cnf` 에

<pre>bind-address        = 127.0.0.1</pre>

위 부분을

<pre>#bind-address        = 127.0.0.1</pre>

위와 같이 주석처리한다. 그래야 원격과 로컬에서 모두 접속할 수 있다.

주석차리하지 않고 넷 상의 ip주소를 썼다가, 원격접속은 되는데 로컬에서 db를 읽는 아이가 db를 읽지 못해 당황했다.

이 외의 것은 [mysql] 원격으로 db에 접속하기 <a class="simple-footnote" title="스프링노트 서비스 종료로 글이 사라졌다." id="return-note-72-1" href="#note-72-1"><sup>1</sup></a>와 <a title="http://blueb.net/blog/1271" href="http://blog.naver.com/rlawlss/80132553667" rel="bookmark">MySQL my.conf 설정 character set</a>를 참고했다.

이렇게 바꾸고 사용자 권한 설정을 위의 두 글에서 말한 대로 해 준다.

phpmyadmin에서 간단하게 사용 권한을 수정해 주면 된다. `localhost`를 `192.168.0.70` 같은 아이피 주소를 써주거나 `%`를 써주면 된다. `%`는 아무데서나 접속할 수 있다는 뜻이다.

`my.cnf`를 수정했으니 `mysql`을 재시작 해줘야 한다.

재시작 명령어는 간단하다.

<pre>sudo /etc/init.d/mysql restart</pre>

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>
  
  <ol>
    <li id="note-72-1">
      스프링노트 서비스 종료로 글이 사라졌다. <a href="#return-note-72-1">&#8617;</a>
    </li>
  </ol>
</div>