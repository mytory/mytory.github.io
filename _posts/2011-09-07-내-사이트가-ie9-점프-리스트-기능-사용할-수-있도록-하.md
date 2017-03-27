---
title: 내 사이트가 IE9 점프 리스트 기능 사용할 수 있도록 하기
author: 안형우
layout: post
permalink: /archives/1767
aktt_notify_twitter:
  - yes
daumview_id:
  - 36676817
categories:
  - 기타
tags:
  - TIP
---
<div class="video-container">
  <div class="video-container__inner">
  </div>
</div>

위 동영상에 나오는 게 바로 IE9의 점프 리스트 기능이다.

일단 윈도우7의 작업 표시줄에 사이트를 고정시킬 수 있다. 이건 드래그 앤 드롭으로 가능하다. 동영상을 보면 앞부분에 나온다.

그리고 특정 코드를 넣어 두면 점프 리스트가 생성된다. 맨 마지막에 잠깐 뜨는 게 바로 그거다.

<img class="aligncenter" src="https://mytory.net/uploads/legacy/result-of-IE9-jump-list.jpg" alt="" width="288" height="343" />

위에 보이듯 일단 레프트21이 상태 표시줄에 아이콘으로 등록됐으며, 최신 온라인 기사, 독자 토론 광장, 독자 편지 쓰기, 갤러리, 지난 호 보기 바로 가기가 제공된다. 레프트21에서 가장 많은 독자들이 관심을 갖는 게 최신 온라인 기사인 만큼 제일 위에 배치했다.

## 화면 미리 보기에 기능 추가 등

이 외에도 다양한 기능이 제공되는데, 화면 미리보기에 기능을 가진 아이콘을 배치한다든가 할 수 있다.

이 모든 것을 MS가 잘 설명하고 있다.

[&#8220;사이트 고정을 사용하면 귀사의 사이트가 맨 앞에 표시됩니다&#8221;][1] 라는 글인데, 설명을 보고 따라하면 많은 걸 할 수있다. 물론 레프트21에 적용할 만한 건 그리 많지 않았다.

## 통계 추적하기

재밌는 건 통계를 추적하는 거였다. `?utf_source=뭐시기` 하는 식으로 URL에 get 변수를 추가하면 구글 아날리틱스가 공식적으로 통계를 잡는다는 사실을 알게 됐다. 그래서 레프트21의 점프리스트에도 그런 GET 변수들을 추가했다.

예컨대 아래와 같은 소스다.

<pre>&lt;meta name="msapplication-starturl" content="http://left21.com/?utm_source=ie9&utm_medium=web&utm_campaign=pinned-ie9" /&gt;</pre>

*   **utm_source=ie9 :** IE9에서 왔다는 걸 알려 주는 듯
*   **utm_medium=web :** 왜 미디어를 medium이라고 쓰는진 잘 모르겠다. medium에는 매개물이라는 뜻도 있긴 하다. 하지만 미디어라고 하는 게 낫지 않나?
*   **utm_campaign=pinned-ie9 :** 이건 특정 캠페인을 지칭하는 듯하다. 알아서 캠페인을 붙이면 되겠다. 메일링리스트에 당장 적용해야겠다는 생각이 들었다.

나머지는 MS의 설명을 차분히 따라해 보기 바란다. 소스 코드와 예제 사이트를 모두 잘 정리해 놨으니 도움이 될 거다.

<div style="width: 730px" class="wp-caption aligncenter">
  <a href="http://buildmypinnedsite.com/ko-KR?WT.mc_id=eml-f-kr-dca-F2-msft_IE"><img src="https://mytory.net/uploads/legacy/ie9-pin.jpg" alt="" width="720" height="521" /></a><p class="wp-caption-text">
    △클릭하면 위 사이트로 이동한다
  </p>
</div>

 [1]: http://buildmypinnedsite.com/ko-KR?WT.mc_id=eml-f-kr-dca-F2-msft_IE