---
title: '[링크:영어] 이클립스 PDT와 nWire 속도를 높이기 위한 다섯 가지 팁 Five tips for speeding up Eclipse PDT and nWire'
author: 안형우
layout: post
permalink: /archives/1010
aktt_notify_twitter:
  - yes
daumview_id:
  - 36761310
categories:
  - 개발 툴
tags:
  - Eclipse
---
일단 링크는 여기다 : [Five tips for speeding up Eclipse PDT and nWire][1]

오늘 윈도우에서 이클립스를 다시 설치하고 워크스페이스를 열었는데 이건 왠일, PHP 프로젝트를 인덱싱 하느라 이클립스 시작을 할 수 없었다.

시간도 지체되고 심심해서 뭐하는 거냐 하고 검색해 봤다. 그랬더니 역시나 있었다. (영어가 짱. 난 영어가 싫어 ㅠ)

이클립스가 하고 있던 건 다름아닌 DLTK indexing 이었고, 검색하자 이런 글이 등장했다.

[Disable or speed up DLTK indexing in Eclipse PDT?][2]

뭔가 이클립스가 스스로 하는 거면 필요하지 싶어서 Disable 하는 건 관심 없었지만, speed up 에는 관심이 있었기에 읽어 봤다.

그리고 바로 이 글을 쓴 놈이 &#8220;<acronym title="PHP Developer Tool">PDT</acronym>(PHP용 이클립스)와 nWire 속도를 높이는 다섯 가지 팁&#8221;(위에 영어로 된 글)을 썼다면서 읽어 보라고 하고 있었다. (nWire는 eclipse 플러그인이다. 판매하는 놈인데 처음 봤다. 이 글 덕에 호감이 가서 trial을 한 번 사용해 보려고 한다.)

원문을 보면 되겠지만, PDT는 3.6으로 넘어오면서 파일을 인덱스해서 함수를 호출해 주고 하는 성능이 비약적으로 향상됐다고 한다. 이게 다 H2라는 DB 엔진 덕분인데, 이걸 사용하려고 처음에 워크스페이스를 indexing한다는 거다.

이 indexing 속도를 높이려면 다섯 가지 조치를 하라고 한다.

1.  바이러스 실시간 감시에서 <workspace folder>/.metadata/.plugins/org.eclipse.dltk.core.index.sql.h2/ 폴더의 *.db 파일을 제하라고 한다. 이거만 하면 꽤 속도 향상을 볼 수 있다. 대부분의 바이러스 감시 프로그램들은 이런 기능을 제공한다고 해서 나도 아비라 안티비르에서 찾아 봤더니 진짜로 제거 항목이 있었다. &#8216;antiVir 구성&#8217;이란 항목에서 예외를 설정할 수 있었다.
2.  속도가 빠른 하드디스크를 사용하라고 한다.
3.  JVM을 최신으로 유지하라고.
4.  문제가 있는 거 같으면 위의 경로에 있는 *.db를 다 지워 버리고 이클립스를 다시 시작하라고 한다. 갑자기 컴터가 꺼지거나 해서 db 파일이 만들어지다가 말면 이클립스가 그걸 복구하려고 노력하는데, 걍 지우고 첨부터 다시 하게 하는 게 나을 수도 있다는 거 같다.
5.  이 db 파일들은 엄청 용량도 크고, 자주 바뀌기 때문에 TimeMachine 같은 자동 백업 프로그램에서 예외 등록을 해 두라고 조언하고 있다.

흠, 역시 아는 게 힘이다. 나도 바이러스 실시간 감시에서 db 파일들을 제외했더니 순식간에 indexing이 끝났다. 뭐, 끝날 때쯤 내가 실시간 감시에서 예외 처리를 한 것일 수도 있고;;

여튼간에 이만 쓴다.

 [1]: http://www.nwiresoftware.com/blogs/nwire/2010/09/five-tips-speeding-eclipse-pdt-and-nwire
 [2]: http://stackoverflow.com/questions/3414592/disable-or-speed-up-dltk-indexing-in-eclipse-pdt