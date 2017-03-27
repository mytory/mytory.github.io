---
title: 구글 아날리틱스 통계를 바탕화면에 띄워놓고 실시간으로 보자
author: 안형우
layout: post
permalink: /archives/88
aktt_notify_twitter:
  - yes
daumview_id:
  - 37224890
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
**이 프로그램은 더이상 다운받을 수 없다. dopac이라는 유료 프로그램쪽으로 방향을 틀었나 보다. 웹사이트에 가면 더이상 지원하지 않으며, v2가 나올 거다 라는 공지만 떠 있다.(2012-02-18 추가)**

구글 아날리틱스, 통계를 보려면 접속을 해서 봐야 한다.

안 그러고 그냥 웹사이트에 삽입하거나 컴퓨터 바탕화면에 띄워놓고 보면 좋겠다는 생각을 해 본 적 있을 것이다.

다음 인사이드의 경우는 웹사이트에 삽입할 수 있도록 제공하고 있다.

구글 아날리틱스도 웹사이트에 삽입할 수 있도록 하는 가젯들이 있었던 것 같은데, 필요해서 찾아보니 지금 작동하는 것은 하나도 없는 것으로 보인다.

분명히 API를 제공하고 있기 때문에 누군가는 만들었을 것 같은데 말이다.

그래서 찾아가 대안으로 일단 낙점한 것은 바탕화면에 띄워놓고 보는 것이다. adobe air를 바탕으로 만든 어플리케이션이고, 영어다. 그래서 탑 콘텐츠 리스트나 키워드가 제대로 나오지는 않는데, 마우스를 갖다내고 있으면 팝업으로 글자가 나오니까 큰 무리는 없다.

## 구글 아날리틱스에서 쉽게 확인할 수 없는 것도 보여 준다.

아래 그림은

*   링크 타고 들어온 방문수(Referring Sites)
*   주소를 직접 치거나 즐겨찾기 등록해놨다가 들어온 방문수(Direct Traffic)
*   검색 엔진을 타고 들어온 방문수(Search Engines)

의 비율을 보여 준다. 검색엔진을 통한 방문 수가 가장 많다는 것을 알 수 있다.

<img class="aligncenter" alt="" src="/uploads/legacy/old-images/1/cfile25.uf.114FA5474D4BC8702B406A.jpg" width="460" height="270" />

아래 그림을 보자. 각 방문 유형의 페이지뷰를 보여 준다. 여전히 검색 엔진을 타고 들어온 사람들이 본 총 페이지뷰가 가장 많지만, Direct Traffic이 방문수에 비해 페이지를 많이 보고 나간다는 사실을 알 수 있다.

<img class="aligncenter" alt="" src="/uploads/legacy/old-images/1/cfile9.uf.131179594D4BC86F1B575E.jpg" width="460" height="270" />

아래를 보자. 사이트에 머문 시간을 보여 주는 그래프다.

이번에는 방문수의 비율과 비교해 완전히 역전됐음을 알 수 있다.

Direct Traffic이 사이트에 머문 총 시간이 46%나 된다. 반면 검색엔진을 타고 들어온 경우는 방문수는 많지만 사이트에 많이 머물지는 않는다는 사실을 알 수 있다.

<img class="aligncenter" alt="" src="/uploads/legacy/old-images/1/cfile25.uf.163F1F4A4D4BC86F30E3F8.jpg" width="460" height="270" />

구글 아날리틱스 통계를 바탕화면에 띄워놓고 볼 수 있는 이 프로그램을 다운받으려면(설치하려면)

<del>Desktop Reporting for Google Analytics &#8211; Polaris에 가면 된다.</del>

2013년 1월 4일 현재, 사이트 도메인 자체가 사라졌다. [구글에서 google analytics polaris로 검색][1]하면 프로그램은 다운받을 수 있다.

 [1]: https://www.google.co.kr/search?q=google+analytics+polaris&aq=f&oq=google+analytics+polaris&aqs=chrome.0.57j0l3j62l2.5800&sugexp=chrome,mod=5&sourceid=chrome&ie=UTF-8