---
title: subclipse 프로젝트 익스플로러에서 복잡한 리비전 날짜, 아이디 안 보이게 하기
author: 안형우
layout: post
permalink: /archives/534
aktt_notify_twitter:
  - yes
daumview_id:
  - 36964229
categories:
  - 개발 툴
tags:
  - Eclipse
---
제목을 어떻게 다는게 좋을지 좀 고민이었는데, 더 적절한 제목이 있닥고 생각하는 분은 알려 주기 바란다.

자자&#8230;

서브클립스를 사용하는 분들 중, 하나 불만인 분이 있을 거다. 파일명 옆에 설명이 많이 붙는 거다. 뭐, 파일 커밋 시간이랑 커밋한 사람 아이디가 붙는데, 파일이 한두개라도 그런 게 옆에 길게 붙어 있으면 부담스러운데 파일이 매우 많고 일일이 다 붙어 있으면 이건 뭐 눈 돌아간다.

그래서, 오늘은 그걸 간소화시키는 방법을 메모한다. 필요한 분들 적어가라고 캡쳐를 하고 메모까지 했으니 도움이 많이 됐으면 한다.

일단 아래 그림부터 보자.

<img src="/uploads/legacy/old-images/1/cfile25.uf.121D49524D4BC8EF21B5D5.png" class="aligncenter" width="580" height="477" alt="" />

window > preperences 에서 상단 왼쪽에 svn이라고 치면 서브클립스 관련한 설정을 할 수 있는 부분이 나온다.

우리에게 필요한 건 Label Decoration 이다. 이 메뉴를 고르면 라벨을 어떻게 붙일지 설정할 수 있다.

위에 보이는 것처럼 {date} {author} 를 지워버리면 아래 그림처럼 깔끔하게 리비전 번호만 남는다.  
<img src="/uploads/legacy/old-images/1/cfile6.uf.193F624A4D4BC8EF2F0667.png" class="aligncenter" width="580" height="477" alt="" />

솔직히 리비전 시간이랑 작성자 궁금하면 히스토리로 보면 된다.

파일 옆에 일일이 시간 써 주는 거 매우 짜증난다. 이건 뭐 파일 이름이 매우 길어 보인다. 괜시리 스트레스 받기 싫다.

그래서 찾아 보니깐 고치는 게 있었던 것.

뭐 맘에 안 드는 거 있으면 참지 말고 프리퍼런스를 찾자. 왠만한 건 다 있다.