---
title: 맥에서 무선 네트워크 비밀번호를 잘못 입력해서 재설정하고 싶을 때
author: 안형우
layout: post
permalink: /archives/3118
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36575203
categories:
  - 기타
tags:
  - Mac
---
오늘 맥에서 무선 네트워크 비밀번호를 잘못 넣었다. 세 번을 잘못 넣었는데, 이상하게 세 번째 넣은 비밀번호를 가지고 무선 네트워크 접속을 시도하기 시작하는 것이다. 그런데 접속은 됐는데 &#8220;인터넷이 연결되지 않았습니다&#8221; 하는 메시지를 띄우고 인터넷이 되지 않았다. 즉, 실제로는 연결이 안 된 것이다.

그런데 이상한 게, 그 다음부터 다시는 비밀번호를 물어 보지 않아서 비밀번호를 수정하고 싶어도 수정할 수가 없는 것이다! 이런 젠장할.

이럴 때 비밀번호를 수정하는 방법이다. 일단 스포트라이트 파인더의 응용프로그램 폴더에서 keychain 으로 검색을 해 봐라. 그러면 키체인 접근(keychain access)이라는 앱이 나온다.

<img class="aligncenter" src="http://mytory.net/uploads/legacy/mac-keychain.png" alt="" width="811" height="573" />

거기 들어가서 좌측 상단의 &#8216;시스템&#8217;을 클릭하면 거기에 무선 네트워크의 이름이 있다. 그걸 더블클릭하면 비밀번호를 변경할 수 있다. 끝!