---
title: 라즈베리 파이 node.js 설치 deb 파일(v0.10.25)
author: 안형우
layout: post
permalink: /archives/12572
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/raspberry-nodejs-deb.md
categories:
  - 기타
  - 서버단
tags:
  - 라즈베리 파이
---
라즈베리 파이에 node.js를 설치하려고 컴파일을 하는데 정말 시간이 오래 걸렸다. nodejs.org에서 제공하는 deb 설치 파일은 10.2 버전이었고, 난 최신 버전을 깔고 싶었다. 한참 걸려서 컴파일을 했다.

그래서 파일을 공유한다.

[> node.js deb v0.10.25 for arm][1]

알겠지만, 라즈베리 파이에서 다운받은 다음 커맨드라인으로 아래처럼 치면 된다.

    sudo dpkg -i node_0.10.25-1_armhf.deb

 [1]: https://drive.google.com/file/d/0B1y-xjZYE3AqWV9jS2NkSWdwT2c/edit?usp=sharing