---
title: 페이스북 공유/좋아요 했을 때 이미지 지정해 주기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2186
aktt_notify_twitter:
  - yes
daumview_id:
  - 36637857
categories:
  - 기타
tags:
  - TIP
---
페이스북 공유하기나 좋아요를 눌렀을 때, 검색 버튼 옆에 달린 삼각형 불릿이 이미지 썸네일로 들어간다면? 폼이 안 난다.

해결책은,head에 페이스북용 정보를 삽입해 주는 것이다.

단, 페이스북은 한 번 퍼간 페이지는 캐시에 저장하므로 이미 한 번 공유된 것에는 적용이 안 된다. 적용하려면 [Facebook Debugger][1] 에 가서 URL을 한 번 입력해 주면 된다고 한다.

## 참고 링크

아래 두 링크에 자세한 설명이 나와 있으니 참고하면 된다. 내가 쓴 것도 모두 아래 링크를 참고한 것이다.

[▶페이스북 공유하기, 썸네일 이미지를 마음대로 설정해보자][2]

<a title="페이스북 공유하기에 엉뚱한 글, 그림이 들어간다면" href="http://pat.im/812" rel="bookmark">▶페이스북 공유하기에 엉뚱한 글, 그림이 들어간다면</a>

## 페이스북용 정보 태그

<div>
  <pre class="brush: html; gutter: true; first-line: 1">&lt;meta property="og:title" content="제목표시"/&gt;
&lt;meta property="og:type" content="사이트 종류"/&gt;
&lt;meta property="og:image" content="이미지경로"/&gt;
&lt;meta property="og:site_name" content="사이트 이름"/&gt;
&lt;meta property="fb:app_id" content="앱아이디"/&gt;
&lt;meta property="og:url" content="표시하고싶은URL"/&gt;
&lt;meta property="og:description" content="본문내용"/&gt;</pre>
  
  <p class="brush: html; gutter: true; first-line: 1">
    위 코드는 &#8216;<a href="http://thekida.tistory.com/26">페이스북 공유하기, 썸네일 이미지를 마음대로 설정해보자</a>&#8216;에서 퍼온 것이다.
  </p>
  
  <h2 class="brush: html; gutter: true; first-line: 1">
    HTML5 코드를 쓰라고 하더라
  </h2>
  
  <p class="brush: html; gutter: true; first-line: 1">
    페이스북 &#8216;좋아요&#8217; 코드는 FBML 코드와 HTML5 코드가 있다. 이 중 FBML 코드를 사용하면 위에서 제공해 준 것대로 작동하지 않는 경우가 있다고 한다. 따라서 좋아요 버튼은 HTML5 코드를 쓰는 게 낫다고 한다.
  </p>
</div>

 [1]: http://developers.facebook.com/tools/lint
 [2]: http://thekida.tistory.com/26