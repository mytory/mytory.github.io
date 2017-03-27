---
title: 이클립스 serial version ID 경고 메세지 없애기
author: 안형우
layout: post
permalink: /archives/220
aktt_notify_twitter:
  - yes
daumview_id:
  - 37140785
categories:
  - 개발 툴
tags:
  - Eclipse
---
이클립스 사용중 아래와 같은 메세지가 뜰 때가 있다.

<img src="/uploads/legacy/old-images/1/cfile25.uf.114AEB474D4BC8812F0FF4.png" class="aligncenter" width="580" height="201" alt="" />

Add default serial version ID나 Add generated serial version ID 같은 메세지다.

왜 나오는건지 나는 모른다. 그래서 불필요하다고 확언하지는 못한다. 그러나 누구도 저걸 신경쓰라고 한 적이 없고, 검색해보면 &#8216;불필요한 경고 메세지&#8217;라고 하니, 없애는 방법을 설명한다.

<img src="/uploads/legacy/old-images/1/cfile29.uf.135489474D4BC8821F8DCE.png" class="aligncenter" width="580" height="531" alt="" />

window &#8211; preference 메뉴에서 Errors/Warnings 로 검색하면 위의 좌측 트리처럼 나온다. Java 하위의 Compiler 하단에 있는 Errors/Warnings를 선택해 준다.

Potential programming problems 탭을 펼쳐서, Serializable class without serialVersionUID를 Ignore로 바꾼다.