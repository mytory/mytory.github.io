---
title: '크롬으로 느린 인터넷 환경 테스트하기'
layout: post
tags:
  - tip
---

이미지 슬라이드가 많은 사이트나 웹폰트를 사용하는 사이트를 만들 때는 느린 인터넷 환경 테스트를 해야 한다.

일단, 느린 인터넷 환경 테스트를 throttling이라고 부르더라. throttle은 목을 조르다는 뜻인데, 우리말론 병목현상 쯤으로 생각하면 되지 싶다.

아파치 `mod_ratelimit` 모듈 같은 것을 찾아 적용해 봤는데 뜻대로 작동하지 않았다. 로컬 테스트라 그런 건가.. 여튼 그래서 헤매다가 크롬 개발자도구에서 제어할 수 있는 것을 우연히 찾았다. 

![](/uploads/2016-06-09/throttling-test.png)

Network 섹션에 가면 No throttling 이라는 셀렉트박스가 있다. 거기 보면 latency(지연시간), download, upload 순서로 값이 씌어 있다. 위 이미지에서 Regular 2G의 경우엔 latency가 300ms, Download 속도가 250kb/s, Upload 속도가 50Kb/s인 것이다. 

이걸 선택하고 새로고침하면 느린 인터넷 속도를 크롬이 흉내내 주는 것을 볼 수 있다. 


 

