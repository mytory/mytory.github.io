---
title: '[링크]SVN과 https 그리고 아파치 설치 가장 잘 정리된 듯한 글'
author: 안형우
layout: post
permalink: /archives/604
aktt_notify_twitter:
  - yes
daumview_id:
  - 36919439
mytory_md_path:
  - 
categories:
  - 서버단
tags:
  - apache
---
**스프링노트 서비스가 중지되면서 글이 사라졌다.**

<del>http://docs.springnote.com/pages/2106238#toc_4</del>

여기다.

단, 한 가지 부족해 보이는 점이 있다.

svn을 https로의 접근만 허용하도록 하는 게 필요해 보인다.

그러려면 <Location> 항목 안에 (뭐, 맨 아래줄 쯤에) SSLRequireSSL 이라고 써 주면 된다. 다른 건 쓸 거 없다.

물론, https도 돌아가고 위에 설정한 Location이 http로 잘 들어가질 때 얘기다.