---
title: 트위터 공식 위젯 오류 해결하기
author: 안형우
layout: post
permalink: /archives/802
aktt_notify_twitter:
  - yes
daumview_id:
  - 36777593
categories:
  - 서버단
tags:
  - API
---
<a href="https://twitter.com/settings/widgets" target="_blank" title="[https://twitter.com/about/resources/widgets/widget_profile]로 이동합니다.">트위터 공식 위젯</a>을 게시하려는 페이지의 인코딩이 euc-kr일 경우 오류가 발생한다.

<div style="width: 269px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/old-images/1/cfile23.uf.1576D4514D4BC96B14A958.png" width="259" height="219" alt="" filename="cfile23.uf.1576D4514D4BC96B14A958.png" filemime="" /><p class="wp-caption-text">
    △트위터 공식 위젯
  </p>
</div>

이 경우 트위터 위젯의 코드 중

<script src=&#8221;http://widgets.twimg.com/j/2/widget.js&#8221;></script>&nbsp;

부분에

<script src=&#8221;http://widgets.twimg.com/j/2/widget.js&#8221; <span style="color:#E31600;font-weight: bold;">charset=&#8221;utf-8&#8243;</span>></script>&nbsp;

위에 넣은 것처럼 charset=&#8221;utf-8&#8243; 이라고 써 넣어 주면 된다.