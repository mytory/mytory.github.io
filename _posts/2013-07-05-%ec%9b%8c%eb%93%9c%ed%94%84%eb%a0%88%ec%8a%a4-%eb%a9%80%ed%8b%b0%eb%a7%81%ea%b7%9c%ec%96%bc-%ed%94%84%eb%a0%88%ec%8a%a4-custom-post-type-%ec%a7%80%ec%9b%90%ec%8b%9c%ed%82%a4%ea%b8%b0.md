---
title: '[워드프레스] 멀티링규얼 프레스 custom post type 지원시키기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10508
daumview_id:
  - 47493931
categories:
  - WordPress
tags:
  - WordPress Tip
---
옵션으로 할 수 없고 코드를 뜯어 고쳐야 한다.

multilingual-press.php 파일에 있는 add\_meta\_boxes 함수를 찾아서 post, pgae로 돼 있는 라인을 복사 떠서 custom post type을 추가하면 된다. 두 줄을 해야 한다. if문 안에 있는 것과 밖에 있는 것 모두.

custom post type을 상당히 자유롭게 사용할 수 있는 개발자만 알아들을 수 있게 써서 안타깝지만, 시간이 없는 관계로&#8230;