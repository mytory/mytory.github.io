---
title: 우분투, root 권한으로 로그인하는 방법
author: 안형우
layout: post
permalink: /archives/27
aktt_notify_twitter:
  - yes
daumview_id:
  - 37264993
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
대부분의 경우에 root로 로그인할 필요는 없다.

gsku nautilus 명령어로 gui탐색도 가능하고, 터미널에서 &#8216;sudo 명령어&#8217; 이렇게 쓰면 root권한으로 명령도 내릴 수 있다.

다만, 터미널에서 아예 root 권한을 얻어 돌아다니고 싶을 경우(즉, sudo 자꾸 치기 귀찮은 경우)는 아래와 같은 방법을 따른다.

터미널에서 su root로 루트권한을 얻을 수도 있다.

다만, sudo passwd root로 root패스워드를 한 번 설정해야 권한을 얻을 수 있을 것이다.

아래 설명은 root로 아예 로그인하는 방법이다.

<a target="_blank" href="http://ubuntu.or.kr/viewtopic.php?f=10&t=4263">http://ubuntu.or.kr/viewtopic.php?f=10&t=4263</a>

1] root 관리자 권한 얻기

초기 시스템 관리자로 root 계정은 만들어져 있으나 패스워드 설정은 되어 있지 않다.

1. 터미널에서 &#8216;sudo passwd root&#8217;입력

2. 패스워드 물으면 제 계정 암호(처음에 만들때 썼던거)입력

3. 새로운 패스워드를 입력

4. su root로 루트권한을 얻음.

5.시스템-관리-로그인창-보안에서 로컬 시스템 관리자 로그인 허용에 V 표시를 한다.

6. root 로그인할 때 언어 설정도 한글로 바꾼다.

7.터미널 창에서 root 계정 켜기 sudo -s