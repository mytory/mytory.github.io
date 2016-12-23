---
title: '[tomcat] 톰캣 매니저 사용시 log4j NullPointer Exception'
author: 안형우
layout: post
permalink: /archives/466
aktt_notify_twitter:
  - yes
daumview_id:
  - 36986887
categories:
  - 서버단
tags:
  - JAVA
---
이유는 모르겠고 이렇게 하니까 됐다.  
톰캣 매니저는 톰캣에 붙어 있는 여러 프로젝트를 각각 따로 리스타트할 수 있도록 해 주는 도구다. 톰캣에서 기본으로 제공한다. 사용법은 검색해 보면 나온다.  
그런데 톰캣 매니저를 붙였는데 stop은 되고 start는 안 됐다. 에러 메시지는 log4j 어쩌고 NullPointer Exception이었다.  
log4j가 문제일리 없다고 생각했다.  
다만 log4j의 설정이 DEBUG로 돼 있어서 log파일 덩치가 넘 컸기 때문에 이놈을 INFO로 바꾸고 에러를 찾기 시작했다.  
헐랭~ 근데 그렇게 하니까 톰캣매니저가 제대로 돌아가기 시작했다 ㅡㅡ;;  
이건 뭥미 ㅡㅡ;;