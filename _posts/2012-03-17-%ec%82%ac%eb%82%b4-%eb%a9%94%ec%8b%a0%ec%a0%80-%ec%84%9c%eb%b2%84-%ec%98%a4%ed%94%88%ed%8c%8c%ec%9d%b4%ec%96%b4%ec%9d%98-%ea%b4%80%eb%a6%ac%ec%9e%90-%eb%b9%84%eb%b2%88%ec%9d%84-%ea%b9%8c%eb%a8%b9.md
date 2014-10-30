---
title: 사내 메신저 서버 오픈파이어의 관리자 비번을 까먹었을 때
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2328
aktt_notify_twitter:
  - yes
daumview_id:
  - 36620515
categories:
  - 기타
tags:
  - Program
---
[오픈파이어][1]는 메신저 서버 구축 프로그램이다.

외부 DB를 사용하고 있는 경우에는 간단하다. 임베디드 DB의 경우 아래쪽에 있는 다른 해법을 참고하라.

나는 mysql을 사용하고 있었기 때문에 간단했다.

ofuser 테이블을 찾은 뒤, admin 의 레코드를 수정한다. 일단 해쉬된 password 컬럼은 null로 지정한다. 그냥 비우지 말고 반드시 null로 만든다.

그리고 plain password에 123456 따위를 쳐 넣는다.

그러면 plain password에 쳐 넣은 것으로 로그인된다.

로그인한 다음 user/group 메뉴로 가서 admin의 비번을 변경해 준다. 간단함!

## 다른 방법 &#8211; 임베디드 DB인 경우 이 방법만 먹힐 수도

openfire.xml을 편집하는 방법이다. 비번을 알고 있는 계정이 있어야 한다. 그 계정을 관리자 계정으로 만들어서 해결하는 방법이다. 아래 코드는 joe라는 계정을 admin 계정으로 만드는 거다. 물론 joe라는 계정의 비번은 알고 있어야 할 것이다.

우분투의 경우 `/etc/openfire` 에 위 파일이 있다.

<pre>&lt;admin&gt;
    &lt;authorizedUsernames&gt;joe&lt;/authorizedUsernames&gt;
&lt;/admin&gt;</pre>

이렇게 한 뒤 오픈파이어를 재시작한다. 우분투라면 아래 명령어를 사용한다.

<pre>sudo /etc/init.d/openfire restart</pre>

이렇게 한 뒤 serverDomain:9090 으로 들어가서 joe 계정으로 로그인한다. 그러면 관리자 패널로 들어갈 수 있다.

들어간 뒤 admin의 비밀번호를 변경하고, 관리자 계정으로 만든 뒤 나온다.

 [1]: http://mytory.local/archives/212 "오픈소스 (사내)메신저 서버 구축, 오픈 파이어(openfire) 설치방법과 세팅(리눅스 기준)"