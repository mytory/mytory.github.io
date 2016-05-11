---
title: 우분투, hosts 파일을 이용한 광고 제거
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/155
aktt_notify_twitter:
  - yes
daumview_id:
  - 37178945
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
윈도우에서 hosts 파일을 이용해 광고를 제거하는 것처럼, 우분투에서도 똑같이 할 수 있다.

윈도우에서 초심자들은 센스부족이라는 프로그램을 설치하면 훨씬 편하게 광고를 제거할 수 있다.

우분투에는 그런 프로그램은 없지만, 그래도 어려운 일은 아니니 도전해 보자.

일단 다음 파일을 다운 받아라.

<a href="/uploads/legacy/old-images/1/cfile26.uf.1558114C4D4BC8781B69D9.zip" class="aligncenter" />cfile26.uf.1558114C4D4BC8781B69D9.zip</a>

다운받은 파일을 압축푼 후 /etc 에 복사해 넣으면 된다. 간단하다.(그런데 관리자권한으로 들어가서 복사해 넣어야 한다. 관리자 권한으로 탐색기를 열어서 하면 되는데, 그 방법은 아래쪽에 설명해 뒀다.)

원래대로 광고가 나오게 하려면 아래 파일을 복사해 넣어라.

<a href="/uploads/legacy/old-images/1/cfile30.uf.175BC84D4D4BC878216838.zip" class="aligncenter" />cfile30.uf.175BC84D4D4BC878216838.zip</a>

## 관리자 권한으로 노틸러스(파일 탐색기) 여는 법

터미널에 들어가거나 Alt+F2를 눌러 명령을 입력할 수 있도록 한다.

gksu nautilus를 입력하고 엔터 친다.(아래 그림 참고)

암호를 입력한다. 그럼 root 권한으로 탐색기가 열린 것을 볼 수 있다.

<div style="width: 590px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile2.uf.134E49474D4BC87941F1AB.png" width="580" height="115" alt="" /><p class="wp-caption-text">
    △이런 식으로 터미널을 열어서 gksu nautilus를 입력하거나...
  </p>
</div>

<div style="width: 430px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile23.uf.143F2D4A4D4BC8782F5FA1.png" width="420" height="194" alt="" /><p class="wp-caption-text">
    △Alt + F2를 눌러서 프로그램 실행 창을 열어서 gksu nautilus를 입력한다.
  </p>
</div>