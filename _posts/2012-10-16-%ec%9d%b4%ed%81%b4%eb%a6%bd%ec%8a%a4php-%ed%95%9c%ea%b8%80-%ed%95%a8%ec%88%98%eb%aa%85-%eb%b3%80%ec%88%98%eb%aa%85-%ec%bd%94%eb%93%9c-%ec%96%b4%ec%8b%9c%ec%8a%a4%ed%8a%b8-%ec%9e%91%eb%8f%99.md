---
title: '[이클립스PHP] 한글 함수명, 변수명 코드 어시스트 작동하게 하는 방법'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3275
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36535306
categories:
  - 개발 툴
tags:
  - Eclipse
---
**요약: Help > Eclipse Marketplace&#8230; 에서 makegood을 검색해서 설치한다.**

[2012-10-20 추가] Eclipse Juno 에서는 이 방법이 잘 먹힌다. 우분투에서도 먹힌다. 그런데 갈릴레오에서는 잘 안 된다. 즉, 늘 작동하는 방법은 아니라는 것이다. 그 점을 감안해야 할 듯하다.

<div style="width: 588px" class="wp-caption aligncenter">
  <img src="http://dl.dropbox.com/u/15546257/blog/mytory/makegood.png" alt="" width="578" height="504" /><p class="wp-caption-text">
    이놈을 찾아서 설치하면 그 때부터 한글 함수명, 변수명 자동완성과 찾아가기가 지원된다.
  </p>
</div>

리팩토링에서 엄청 강조하는 것 중 하나는 사람이 읽기 편한 코드다. 아래와 같은 거다.

<pre class="brush: php; gutter: true; first-line: 1">$기사목록 = 목록불러오기(&#039;기사&#039;);
foreach( $기사목록 as $기사 ){
  echo "&lt;h1&gt;{$기사-&gt;제목}&lt;/h1&gt;";
  echo "&lt;div class=&#039;일시&#039;&gt;{$기사-&gt;일시}&lt;/div&gt;";
}</pre>

그런데 코드를 영어로 짜다 보니 어쩔 수 없는 문제가 생긴다. 영어로 쓰면 아무리 잘 써도 가독성이 떨어진다는 점이다. 위 코드처럼 간단한 건 영어로 해도 어느 정도 쉽게 이해할 수 있지만, 함수명이 복잡해지면 얘기가 달라진다. 아래와 같은 코드를 보자.

<pre class="brush: php; gutter: true; first-line: 1">$calculation_result = get_sum_of_visits_from_standard_date($standard_date);</pre>

위 코드를 한 눈에 보고 알아먹을 수 있는 사람이 얼마나 될까? (그리고 난 영어를 잘 못하므로 위 문장이 문법에 맞는지도 모른다.)

그런데 한글로 쓰면 완벽한 문법으로 엄청난 가독성의 코드를 작성할 수 있다.

<pre class="brush: php; gutter: true">$계산결과 = 기준일에서_3일_후까지의_방문수_합을_구한다($기준일);</pre>

명쾌하다. 그래서 한글로 함수를 짜면 참 좋겠다는 생각을 해 왔다.

## 이클립스 for PHP(PDT)에서는&#8230;

그런데 문제가 있다. 이클립스에서 한글로 변수명과 함수명을 작성하면 엄청난 에러 표시가 양산된다. 실제 프로그램이 돌아가는 것과 별개로 말이다. 이클립스가 한글 함수명과 변수명을 문법 에러로 인식하는 것이다.

그래서 한글로 코드를 작성하는 것을 포기하고 있었는데, 왠걸! 작업용 컴퓨터에선 한글로 코드를 작성하면 깨졌는데, 집에 있는 이동 작업용 노트북에 설치돼 있는 이클립스에서는 한글로 코드 작성이 가능했다! 아래는 시연 동영상이다.

<div class="video-container">
  <div class="video-container__inner">
  </div>
</div>

헐&#8230; 등잔 밑이 어둡다더니.

## Makegood

찾아 본 결과 [Makegood][1]이라는 플러그인을 설치했더니 된 것이었다. 왜인지는 모르겠지만 말이다. Makegood은 테스트 케이스를 편리하게 만들어 주는 플러그인이다. 그런데 이걸 설치하면 한글 함수명 변수명의 자동완성과 찾아가기가 지원된다. 심지어 일본어랑 한문도!

이상이다.

 [1]: http://piece-framework.com/projects/makegood