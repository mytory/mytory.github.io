---
title: 트위터 공식 RT 위젯 (Tweet Button) 달기
author: 안형우
layout: post
permalink: /archives/1274
aktt_notify_twitter:
  - yes
daumview_id:
  - 36714506
categories:
  - 기타
tags:
  - TIP
---
얼마 전부터 내가 관리하는 사이트에 달아 놓은 트위터 RT 버튼이 작동하지 않았다. 클릭을 해도 트윗 입력 창이 빈 채로 나타나는 것이었다.

아마도 트위터 측에서 그 파라미터를 막은 듯했다. 입력한 파라미터는 간단했다.

<pre>http://twitter.com/home/?status=some+text+http://mydomain.com/article/1234</pre>

status라는 파라미터만 사용하는 것이 예전의 트위터 RT 방식이었다.

그게 작동하지 않은 것.

그래서 트위터 공식 API를 찾아 봤다. 트위터의 **설정 > 프로필 > [(내 웹사이트에 트위터를 더하려면 여기를 클릭)][1] > [트윗 버튼 만들기][2] > [개발자용 공유 API 가이드(Tweet Button)][3]** 에서 찾을 수 있었다.

URL 형식과 들어가는 파라미터가 달라졌다. 좀더 DB에 분류를 잘 할 수 있게 바꾼 듯하다.

URL 형식은 아래와 같다.

<pre>http://twitter.com/share?text=some+text&url=http://mydomain.com&via=myTweetAccount</pre>

기본적으로는 위와 같이 쓰면 된다. `a`의 `href`에 위 주소를 넣으면 되는 것이다.

몇 가지 파라미터가 더 있다.

*   url : 공유하려는 페이지의 URL
*   via : 공유할 때 누구 것을 인용했는지 표시할 이름 (즉, 트위터 아이디)
*   text : 기본 트윗 텍스트
*   related : 관련 계정
*   count : 카운트 박스 위치
*   lang : 트윗 버튼의 언어
*   counturl : 공유된 URL을 해석하기 위한 주소(?) [The URL to which your shared URL resolves to]

마지막 세 개는 커스텀 버튼을 만들 때도 필요한 건지는 잘 모르겠다. 뭘 의미하는지도 모르겠고.

내가 표시한 링크에 들어가 보면 알겠지만, 기본적으로는 자바스크립트를 이용해서 트위터에서 직접 디자인한 트윗 버튼이 뜬다. 굉장히 간단하게 표시할 수 있게 돼 있다.

하지만, 관리하는 사이트의 디자인에 맞춰서 만들기 위해 나는 Build your own 항목을 참고했다.

이상. 트윗 버튼 만들기 끝이다.

(나는 검색할 때 **트위터 공식 RT 위젯** 이런 걸로 검색을 해서 찾기가 힘들었다. 그런데 그냥 tweet button 으로 검색했으면 훨씬 빨리 찾을 수 있었을 듯하다. 나처럼 찾는 사람을 위해서 제목에는 **트위터 공식 RT 위젯**이라고 썼다.)

 [1]: https://twitter.com/about/resources
 [2]: https://twitter.com/about/resources/tweetbutton
 [3]: http://dev.twitter.com/pages/tweet_button