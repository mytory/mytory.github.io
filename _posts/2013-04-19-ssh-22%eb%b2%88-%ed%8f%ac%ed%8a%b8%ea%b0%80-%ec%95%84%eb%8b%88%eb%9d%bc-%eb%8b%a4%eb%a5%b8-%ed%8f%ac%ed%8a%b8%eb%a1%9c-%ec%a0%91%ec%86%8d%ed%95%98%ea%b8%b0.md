---
title: ssh 22번 포트가 아니라 다른 포트로 접속하기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9945
daumview_id:
  - 43399655
categories:
  - 기타
tags:
  - TIP
---
집에 서버를 구성하고 ssh로 접속을 하려고 하는데, 얼마 전 친구가 ssh 해킹으로 컴퓨터가 맛이 갔던 이야기를 해준 게 떠올랐다. 

나 혼자 쓸 테니 그러면 포트를 바꿔서 보안을 강화해야지 생각했다. 그래서 10000번 포트로 설정! (물론 진짜로 10000번 포트로 하진 않고 다른 포트로 했다. 몇 번 포트인지는 안 가르쳐 준다. :)

sshd_config 파일을 찾아서 Port 부분 주석을 해제하고 10000으로 변경한 뒤, OpenSSH를 재시작하는 것까진 성공했는데, 

<pre>ssh myname@mydomain.com:10000</pre>

이렇게 접속 명령을 내리자 주소를 해석할 수 없다고 나온다. 뭐냐 이건. 

검색해서 알아냈는데, ssh에선 포트를 저렇게 안 쓴다. 

<pre>ssh -p 10000 myname@mydomain.com</pre>

이렇게 써야 22번 포트가 아닌 10000번 포트로 접속을 하게 된다. 

끝!