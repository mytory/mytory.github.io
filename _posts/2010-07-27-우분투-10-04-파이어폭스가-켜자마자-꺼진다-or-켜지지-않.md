---
title: 우분투 10.04, 파이어폭스가 켜자마자 꺼진다! or 켜지지 않는다. (혹은 Attempting to load the system libmoon 라는 에러를 내며 실행 안 됨)
author: 안형우
layout: post
permalink: /archives/715
aktt_notify_twitter:
  - yes
daumview_id:
  - 36833678
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
이 글은 전적으로 <a target="_blank" href="http://myubuntu.tistory.com/421">http://myubuntu.tistory.com/421</a> 을 참고해서 쓴 것입니다. 여기 있는 설명보다 자세한 설명이 있으므로 초보 분들은 위 링크로 가서 설명을 보세요.  
아마 moonlight를 설치했기 때문일 것이다. moonlight는 silverlight를 리눅스 환경에서도 돌릴 수 있게 해 주는 프로그램이다. 근데 10.04에서는 저놈이 말썽을 피운다.  
따라서 삭제한다.  
터미널을 열고 아래 명령을 넣어 준다.

<pre class="brush:plain">sudo apt-get remove libmoon</pre>

저놈을 제거하고 나면 잘 실행된다.