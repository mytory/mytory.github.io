---
title: '[Google Analytics] (not provided) 검색 키워드는 뭐고 어떻게 대처할까'
author: 안형우
layout: post
permalink: /archives/2958
aktt_notify_twitter:
  - yes
daumview_id:
  - 36588761
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
<img class="aligncenter" alt="" src="http://mytory.net/uploads/legacy/google-analytics-not-provied-1.png" width="786" height="269" />

위에서 `(not provided)` 라는 게 보일 거다. 깜짝 놀랐다. 키워드의 거의 30%가 `(not provided)` 처리된 것이다.

구글이 개인정보 보호 정책의 하나로 [로그인한 사용자의 검색어는 제공하지 않기로 했다][1]는 것이다. 이 정책으로 자신의 구글 아날리틱스 통계가 얼마나 영향을 받고 있는지 궁금하다면 [《실전 웹사이트 분석 A to Z》][2]의 저자 [아비나우 카우쉭(블로그)][3]이 제공하는 맞춤 보고서 <a href="https://www.google.com/analytics/web/permalink?type=custom_report&uid=I3_ojx0zRYycZcCjbcrxzg" target="_new">Google httpS Change Impact</a>를 자신의 구글 아날리틱스 프로필에 적용하면 된다.

그런데! 꽤 괜찮아 보이는 트릭을 찾았다. [How to steal some &#8216;not provided&#8217; data back from Google][4] 이라는 글에서 찾은 트릭이다. 이 글은 [아비나우 카우쉭이 제안한 `(not provided)` 분석 방법][5]에서 아이디어를 얻어서, `(not provided)`를 랜딩 페이지(외부에서 내 사이트로 온 사람이 처음 도착한 페이지)의 주소로 바꿔치기하는 트릭을 제공한다.

얼레? 아비나우 카우쉭의 분석 방법이 궁금해졌다. 그래서 열심히 읽어 봤다.

## 그럼, 카우쉭이 제안한 분석 방법부터 간단하게 훑어 보자

아비나우 카우쉭은 자신의 블로그에 있는 `(not provided)` 방문자를 분석해 본 결과 다양한 키워드로 들어 온 사람들의 유형과 거의 비슷한 패턴을 보이므로 그렇게 큰 신경을 쓸 필요가 없다고 결론을 지었다. 주요 분석 대상은 브랜드 검색어(아비나우 카우쉭 따위의, 아비나우 카우쉭이라는 &#8216;브랜드&#8217;를 미리 알고 사용한 검색어) 사용자라는 것이다.

카우쉭은 그래서 두 가지 방법을 제안한다.

1.  하나는 `(not provided)`가 브랜드 검색어로 들어온 사람들인지 아닌지를 판단해 보는 것이고,
2.  다른 하나는 구글 검색으로 들어온 사람들 평균 행동 양태와 `(not provided)`로 들어온 사람들의 평균 행동 양태를 비교해 보는 것이다.

그러려면 아래 고급 세그먼트를 만들어야 한다.

*   `(not provided)` 고급 세그먼트
*   브랜드 검색어 고급 세그먼트
*   브랜드 검색어를 제외한 고급 세그먼트
*   구글 검색으로 들어온 사람들 고급 세그먼트

아래 그림은 `(not provided)`로 고급 세그먼트를 만든 것이다.

<p style="text-align: center;">
  <img class="aligncenter" alt="" src="http://mytory.net/uploads/legacy/google-analytics-not-provied-2.png" width="645" height="221" />
</p>

키워드를 포함으로 놓고 &#8216;전체 일치&#8217;를 고른 후 `(not provided)`를 넣어 주면 된다.

아래는 구글 검색으로 들어온 사람들 고급 세그먼트를 만든 것이다. 소스에 google을 포함시키고, and로 연결한 후 organic과 전체일치하는 놈을 포함 하면 된다.

<img class="aligncenter" alt="" src="http://mytory.net/uploads/legacy/google-analytics-not-provied-3.png" width="646" height="376" />

브랜드 검색어는 각자 상황에 맞게 판단하면 된다. 레프트21의 경우는 그냥 레프트21이 브랜드 검색어였다. 그래서 브랜드 검색어 고급 세그먼트는 키워드가 &#8216;레프트21&#8242; 전체 일치 하나만 했고, 브랜드 검색어 아닌 것 고급 세그먼트는 키워드가 &#8216;레프트21&#8217;이랑 전체일치하는 것을 제외한 것으로 설정했다. (참고로 키워드 말고 검색어도 있는데 이놈은 뭔지 모르겠다. 여튼간에 검색엔진에서 사용한 검색어는 &#8216;키워드&#8217;다. 이런 거 할 땐, 번역된 단어가 뜻이 불분명해서 영어로 하는 게 낫다는 생각이 든다.)

내 블로그의 경우는 &#8216;웹으로 말하기&#8217;가 브랜드 검색어라고 할 수 있는데 정말 비율이 적어서 비교할 필요가 없었다.

구글 검색의 평균 행동 양태와 `(not provided)`의 평균 행동 양태는 거의 유사했기 때문에 나 역시 `(not provided)`를 신경쓸 필요가 없다는 결론에 도달할 수 있었다.

그러나, 랜딩 페이지 주소로 `(not provided)`를 대체하는 것도 괜찮은 자료를 제공할 것이기 때문에 해 보기는 해야겠다. 그럼, `(not provided)`를 랜딩 페이지 주소로 변경하는 방법을 알아 볼까?

## `(not provided)`를 랜딩 페이지 주소로 변경하기

이렇게 바꾸면 꽤 의미가 있을 거다. 뭘로 검색해서 들어왔는지는 모르지만, 이 놈들이 우리 사이트의 어디로 들어왔는지 알면 대충 뭘 검색했구나 짐작해 볼 수 있는 거다. 그리고 이 놈들이 꽤 신경을 써야 할 집단인지 아니면 파편화된 놈들이라서 신경쓸 필요가 없는지 좀더 직관적으로 알 수 있을지도 모른다.

자, 구글 아날리틱스 우측 상단의 &#8216;관리&#8217;를 눌러 준다. 그리고 나오는 페이지에서 &#8216;프로필&#8217; 안에 있는 &#8216;필터&#8217; 탭을 고른다. 아래 이미지를 참고한다.

<img class="aligncenter" alt="" src="http://mytory.net/uploads/legacy/google-analytics-not-provied-4.png" width="690" height="858" />

1.  필터 이름은 적당한 걸로 한다. 나는 not provided rewrite 라고 적었다.
2.  필터 유형은 &#8216;맞춤 필터&#8217;를 고르고 &#8216;고급&#8217;을 선택한다.
3.  필드 A -> 추출 A 에서 앞의 칸은 &#8216;캠페인 용어(Campaign Term)&#8217;를 고르고, 뒤의 칸에는 &#8216;`(not provided)`&#8216;를 적어 준다.
4.  필드 B -> 추출 B 에서 앞의 칸은 &#8216;요청 URI&#8217; 혹은 &#8216;페이지 제목&#8217;을 고르고, 뒤의 칸에는 &#8216;(.*)&#8217;를 적어 준다.
5.  출력 대상 -> 생성자 에서 앞의 칸은 다시 &#8216;캠페인 용어&#8217;를 고르고, 뒤의 칸에는 &#8216;np &#8211; $B1&#8217;을 적어 준다. np는 not provided의 앞글자를 딴 것이고, $B1은 필드B 뒤의 칸 첫  번째 괄호 안의 내용을 가리킨다. 정규식 규칙을 구글 아날리틱스가 약간 번안한 것이다.
6.  &#8216;입력란 B는 필수 항목입니다&#8217;를 &#8216;예&#8217;로 변경한다.

그리고 저장을 누르면 된다. 근데 내가 위의 4번째 순서에서 &#8216;요청 URI&#8217; 혹은 &#8216;페이지 제목&#8217;을 고르라고 했는데, 이건 원문에 있는 것과 약간 다른 거다. 왜 그러냐면, 내 블로그는 URL이 보다시피 다 글번호로 돼 있다. 링크 걸려 있는 것도 아닌데, 글 번호만 나열돼 있으면 나 눈 돌아간다. 그래서 나는 &#8216;페이지 제목&#8217;으로 치환되도록 했다. 아래 그림처럼 말이다.

<img class="aligncenter" alt="" src="http://mytory.net/uploads/legacy/google-analytics-not-provied-5.png" width="515" height="121" />

자, 이제 적용하고 한두시간 있으면 결과를 알 수 있을 거다.

## 적용 결과

적용이 잘 됐다. 아래 그림처럼 말이다. 역시 내 생각대로 의미있는 집단은 아니었던 것 같다.

[2013-10-04 추가 : 일단, 의미있는 집단이 아니라는 것을 안 뒤, 약 1년 3개월 동안 'np - 제목' 기능을 사용하다가 사용을 중단했다. 실제 키워드를 아는 게 더 낫다는 생각이 들어서다.]

<img class="aligncenter" alt="" src="http://mytory.net/uploads/legacy/google-analytics-not-provied-6.png" width="646" height="488" />

 [1]: http://googleblog.blogspot.kr/2011/10/making-search-more-secure.html
 [2]: http://mytory.net/archives/2486 "《실전 웹사이트 분석 A to Z》 읽으며 밑줄 그은 것"
 [3]: http://www.kaushik.net/avinash/
 [4]: http://econsultancy.com/us/blog/8342-how-to-steal-some-not-provided-data-back-from-google "How to steal some 'not provided' data back from Google"
 [5]: http://www.kaushik.net/avinash/google-secure-search-keyword-data-analysis/