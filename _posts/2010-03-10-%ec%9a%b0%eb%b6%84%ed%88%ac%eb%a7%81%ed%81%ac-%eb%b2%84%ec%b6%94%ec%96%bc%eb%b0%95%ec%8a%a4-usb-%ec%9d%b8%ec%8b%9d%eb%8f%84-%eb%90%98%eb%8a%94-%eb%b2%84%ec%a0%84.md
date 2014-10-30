---
title: '[우분투:링크] 버추얼박스, USB 인식도 되는 버전'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/385
aktt_notify_twitter:
  - yes
daumview_id:
  - 37012361
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
## [VirtualBox의 설치방법과 MS윈도우 가상머신 만들기 [리눅스사용자]][1]

<a target="_blank" href="http://mytory.textcube.com/entry/%EB%A7%81%ED%81%AC-VirtualBox%EC%97%90-Windows-XP-%EC%84%A4%EC%B9%98%ED%95%98%EA%B3%A0-%EB%86%80%EA%B8%B0">버추얼 박스 설명은 예전에 올린</a> 바 있다. 이번에 발견한 것은 예전에 링크한 글에서는 라이센스 문제가 될 수 있으니 사용하지 말라고 했던 버전이다. 그런데, 이번에 발견한 글에서 보니 기업 유료, 개인 무료다. 따라서 개인들은 자유롭게 사용할 수 있다.

버박에서 USB가 안 될 때 불편한 점은, MP3나 휴대폰을 연결했을 때 디바이스로 인식을 하지 못한다는 점이다. 이걸로 하면 문제가 해결되지 않을까 기대하면서 지금 설치 중이다. 설치 완료하고 테스트까지 마치면 결과를 쓰겠다.

<a target="_blank" href="http://www.virtualbox.org/wiki/Linux_Downloads">버추얼박스 완전판 리눅스용 다운로드 페이지</a>에가서 자신의 우분투 버전을 고르면 된다.

공유폴더를 드라이브로 만들 때 주의할 점이 있다. 이 버전의 버추얼박스는 대소문자를 엄격히 구분한다고 한다. 따라서 다음처럼 써 줘야 한다.

<pre class="brush:plain">net use x: \\VBOXSVR\공유폴더이름</pre>

위에서 x: 는 다른 할당되지 않은 드라이브 이름을 써 줘도 된다. 즉, m:라든지 y:도 괜찮다는 말이다.

공유폴더이름은 공유폴더 설정할 때 적어 준 이름이다. 폴더명이 아니다.

다음, <a target="_blank" href="http://apedix.tistory.com/34">net use</a> 는 네트워크로 접속하는 공유폴더에 드라이브 문자를 할당하겠다는 명령어다. 따라서 그냥 공유폴더로 접근할 수도 있다. \\VBOXSVR 이라고 탐색기 주소표시줄에 쳐 봐라. 그러면 공유폴더가 나타날 것이다. 드라이브 굳이 할당하지 않아도 사용할 수 있다. 드라이브 할당하면 편하니까 하는 거다.

 [1]: http://noneway.tistory.com/55