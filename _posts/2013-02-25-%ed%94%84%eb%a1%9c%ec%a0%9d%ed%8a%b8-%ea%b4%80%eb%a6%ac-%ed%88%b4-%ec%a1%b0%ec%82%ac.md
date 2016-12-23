---
title: 오픈소스 설치형 프로젝트 관리 툴 조사
author: 안형우
layout: post
permalink: /archives/9467
daumview_id:
  - 40749282
categories:
  - 기타
tags:
  - 개발 방법론
---
개인 프로젝트 관리 툴로 [iceScrum][1]을 사용하고 있었는데, 권고사항을 무시하고 내장 hsqldb를 사용하다가 프로그램이 뻗은 다음 복구가 안 되는 상황에 직면하고 말았다. 그런데 이놈이 JAVA와 Tomcat 조합이라 PHP 전문인 내 입장에서는 복구를 위해 엄청난 시간을 들여야 하게 생겼다.

iceScrum 소개를 좀 하자면 이렇다.

*   **iceScrum** : JAVA로 돼 있어서 나에겐 에러 복구가 불가능에 가깝다. 그러나 매우 깔끔한 스크럼 맞춤 툴이다. 한 달 쯤 사용했다. 스토리와, 스토리를 이루는 더 세분화된 태스크가 나뉘는 게 좋다. 포스트잇 형태도 좋다. 난 내장 DB 사용하다가 자료를 다 날려먹게 될 듯 하다.

[iceScrum은 온라인 서비스][2]도 하는데, 1인 1프로젝트는 무료다. 별로 맘에 드는 조건은 아니다. 개인 프로젝트긴 하지만, 프로젝트를 하나만 하는 건 아니잖아! 그리고 돈내긴 좀 그렇고. 개인 프로젝트라고 어디까지나.

여튼간에 복구할 시간에 그냥 할일 목록을 다시 만드는 게 낫다는 생각이 들었고, 이 참에 그냥 프로젝트 관리 툴도 PHP로 변경하는 게 나을 듯 싶어 좀 찾아 봤다. 원래는 애자일 툴을 찾았는데, 애자일 툴은 별로 없고, 그냥 프로젝트 관리 툴을 찾으면 되겠다 싶었다. [12 Efficient Open Source Project Management Tools][3]라는 잘 정리돼 있는 글을 발견한 거다. 2011년 5월에 작성한 글이라 지금은 안 맞는 내용이 된 것도 좀 있는데, 여튼간에 거기서 소개하는 툴을 하나씩 훑어 보고 나름 정리를 좀 했다. PHP인지 아닌지도 체크를 했다. 지금 그게 중요하다.

*   [**Collabtive**][4] : PHP, 영어, 커뮤니티가 큰 듯. 설치가 빠르고 깔끔하다. Task List와 그것을 구성하는 Task로 구분돼 있는 거 좋다. 그런데 모든 Task에 날짜를 지정해야 한다. 헐~ 멀티바이트 글자 지원이 제대로 안 되는지 한글이 글자수 줄여서 보여 줄 때 흉하게 잘린다.
*   [**Redmine**][5] : Ruby, 한글 지원, 검색해 보면 한국어 블로그 글도 꽤 많다.
*   [**Retrospectiva**][6] : Ruby, 프로젝트 관리 툴. 루비라 패스.
*   [**Trac**][7] : 졸라 유명한 프로젝트 관리 툴. 나도 왕년에(!) 이거 설치해 봤는데 설치하기 너무 복잡했고, 무엇보다 느렸다.
*   [**KForge Project**][8] : Python. 다양한 프로젝트를 호스팅하는 걸 만들어주는 것 같다. 엔터프라이즈급이란 말에 그냥 나왔다. 사실 Trac도 엔터프라이즈급이지.
*   [**Project Pier**][9] : PHP, 프로젝트 관리 툴. 커뮤니티가 졸라 뜸한 걸 보고 나왔다.
*   [**Open Atrium**][10] : PHP, 한글 지원, 커뮤니티. 유명한 Open Source CMS인 Drupal이 지원하는 듯. Drupal을 기반으로 만들어진 것 같다. 프로젝트 관리 툴은 아니고 그냥 그룹웨어다. 그런데 정말 무겁다.
*   [**todoyu**][11] : PHP, 오픈소스 그룹웨어. 굉장히 빡빡하게 짜여진 ToDo List라고 보면 될 것 같다.
*   [**Plancake**][12] : PHP5/MySQL, 그냥 할일 관리 툴이다. ToDo List라고 보면 된다. 내가 걸어 둔 링크 타고 가서 맨 아래를 찾아 보면 다운받는 링크가 있다.
*   [**Project HQ**][13] : 파이썬. 웹사이트는 망가져 있고, 소스포지에 소스가 남아 있다. 2012-10-09이 마지막 업데이트.
*   <span style="line-height: 1.714285714; font-size: 1rem;"><a href="https://github.com/teambox/teambox"><strong>Teambox v3</strong></a> : Ruby on Rails. v3은 오픈소스고, v4부터는 5명/5기가/5개 프로젝트까지 무료, 그 이상은 유료인 Web Only 서비스가 됐다. <a href="http://teambox.com/pricing/">Teambox v4 가격표와 유무료 차이 보기.</a></span>
*   [**EGroupware community edition**][14] : PHP, 그룹웨어.

## 결론은?

Collabtive와 Open Atrium, 그리고 todoyu를 설치해 봤다. 그런데 iceScrum만큼의 만족을 못 준다;; 그래서 그냥 iceScrum + MySQL 조합으로 가기로 결정. iceScrum과 MySQL을 같이 쓰는 방법은 [iceScrum Install Guide의 Database 항목][15]을 보면 된다. 근데 회원가입해야 볼 수 있다.

 [1]: http://www.icescrum.org/en/
 [2]: https://www.kagilum.com/icescrum-hosting/
 [3]: http://blueblots.com/tools/12-efficient-open-source-project-management-tools/
 [4]: http://collabtive.o-dyn.de/index.php
 [5]: http://www.redmine.org/
 [6]: http://retrospectiva.org/overview
 [7]: http://trac.edgewall.org/
 [8]: http://www.kforgeproject.com/
 [9]: http://www.projectpier.org/
 [10]: http://openatrium.com/
 [11]: http://www.todoyu.com/
 [12]: http://www.plancake.com/open-source
 [13]: http://sourceforge.net/projects/openpm-org/
 [14]: http://www.egroupware.org/community_edition
 [15]: https://www.kagilum.com/documentation/install-guide/#database