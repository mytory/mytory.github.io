---
title: '[git] 파일 권한 기능이 없는 파일 시스템에서 작업하느라 발생하는 문제를 없애려면?'
author: 안형우
layout: post
permalink: /archives/10294
daumview_id:
  - 45528325
categories:
  - 개발 툴
tags:
  - git
---
<pre>diff --git a/templates/view.template b/templates/view.template
old mode 100644
new mode 100755</pre>

맥에 있던 프로젝트를 FAT 파일 시스템으로 옮기고 `git diff`를 쳐 봤더니 자꾸 모든 파일에 저런 메시지가 나왔다. 아 썅. 찾아 봤더니 파일 권한 기능을 추적하는 기능을 끄는 git 옵션이 있었다.

<pre>git config core.filemode false</pre>

뭐 그냥 간단하게 위 명령을 쳐 주면 된다. 그러면 자꾸 644가 755로 변경됐다고 나오는 게 사라진다.