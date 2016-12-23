---
title: 이클립스에서 CharacterEncodingFilter.java에 에러 표시가 뜰 때
author: 안형우
layout: post
permalink: /archives/10681
daumview_id:
  - 49240372
categories:
  - 서버단
tags:
  - JAVA
---
이것은 대증요법이지 근본 해결책은 아니다. 난 자바와 서블릿, 톰캣 쪽은 체계적으로 혹은 깊이 본 적이 없어서 근본 해결책은 모르겠다.

서버에선 잘 돌아가는데 이클립스에서는 안 돌아갈 때 대처법이다. 톰캣의 `lib`엔 `javax.servlet.jar` 파일이 포함돼 있기 때문에 문제가 없을 거라고 한다. 여튼간에 이클립스에서 돌릴 때도 문제가 생기는 건 별로니까, 아래처럼 하면 된다.

프로젝트에 있는 `javax.servlet.jar` 파일을 `WEB-INF/lib`에 복사.