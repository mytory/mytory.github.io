---
title: '[이클립스] subversive 콘솔 출력 늘 되게 하기'
author: 안형우
layout: post
permalink: /archives/2030
aktt_notify_twitter:
  - yes
daumview_id:
  - 36663109
categories:
  - 개발 툴
tags:
  - SVN
---
subclipse와 달리 subversive는 콘솔을 켜놓지 않으면 콘솔에 찍히는 값을 보여 주지 않는다. 선호에 따라 다르겠지만, 콘솔에 찍히는 걸 보고 싶은 사람도 있을 거다.

그러려면 아래 이미지와 같이 Preferences에 가서 Team > SVN > Console 항목을 찾는다.

그리고 Show console automatically 를 On output 으로 바꾼다. 기본값은 Never 라고 돼 있다.

<img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/subversive-console-setup.png" alt="" width="912" height="706" />