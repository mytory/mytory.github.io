---
title: svn export시 ATTENTION! Your password for authentication realm 하고 나올 때 해결책
author: 안형우
layout: post
permalink: /archives/1147
aktt_notify_twitter:
  - yes
daumview_id:
  - 36687714
categories:
  - 개발 툴
tags:
  - SVN
---
[녹풍] 더 나은 해결책을 발견해서 내용을 추가한 후 재발행한다.

<pre>ATTENTION! Your password for authentication realm:

Subversion Repositories

can only be stored to disk unencrypted! You are advised to configure
your system so that Subversion can store passwords encrypted, if
possible. See the documentation for details.

You can avoid future appearances of this warning by setting the value
of the &#039;store-plaintext-passwords&#039; option to either &#039;yes&#039; or &#039;no&#039; in
&#039;/home/hahaite/.subversion/servers&#039;.
-----------------------------------------------------------------------
Store password unencrypted (yes/no)? yes
Please type &#039;yes&#039; or &#039;no&#039;: yes
Please type &#039;yes&#039; or &#039;no&#039;: y
Please type &#039;yes&#039; or &#039;no&#039;: &#039;yes&#039;
Please type &#039;yes&#039; or &#039;no&#039;: no
Please type &#039;yes&#039; or &#039;no&#039;: 18
Please type &#039;yes&#039; or &#039;no&#039;:</pre>

yes든 no든 안 먹히고 그냥 멈춘다.

## 해결책1

[해결책1은 2011-08-05에 추가한 내용이다. - 녹풍]

[firejune님 블로그에서 발견한 내용][1]이다.

> 여기서 한참 삽질하다가 포기할 뻔 했습니다. locale이 한글로 되어있던게 원인이더군요. &#8220;예&#8221; 또는 &#8220;아니오&#8221;로 입력해야 됩니다.

## 해결책2

이 해결책은 [gnome keyring manager 써보신 분이나, SVN 에서 암호화안된 패스워드 처리법 아시는 분~][2] 을 참고했다.

아예 명령어에 암호화되지 않은 패스워드를 입력하는 방법이다. 명령줄 맨 뒤에 `--password myPassword` 하고 입력해 주는 것이다.

이런 식이 될 것이다. 암호를 1234로 가정하자.

<pre>svn export svn://192.168.0.100/myProject/trunk . --password 1234</pre>

이러면 해결된다. 별로 좋은 방법은 아닌 것 같다. 암호를 평문으로 입력해야 하기 때문이다.

그냥 할 때는 상관 없는데, 자동으로 export를 돌려야 할 때는 쉘 스크립트에 암호를 평문으로 박아야 하니 좀 찝찝하다.

더 나은 해결책은 [Subversion 1.6: Security Improvements Illustrated[번역: 서브버전 1.6 보안 개선 예제]][3]에서 찾아볼 수 있는 듯하다. 정석대로 공부하고 싶은 분은 이 글을 읽는 편이 좋을 것이다.

 [1]: http://firejune.com/1682
 [2]: http://kldp.org/node/109560
 [3]: http://www.linuxforu.com/previews/subversion-16-security-improvements-illustrated/