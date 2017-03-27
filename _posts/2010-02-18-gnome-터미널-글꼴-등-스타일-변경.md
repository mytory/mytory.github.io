---
title: gnome 터미널 글꼴 등 스타일 변경
author: 안형우
layout: post
permalink: /archives/294
aktt_notify_twitter:
  - yes
daumview_id:
  - 37065446
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
일단 글꼴에서 mmm 이런 게 겹쳐 나오기 때문에 안 겹치게 나오는 글꼴을 사용해야 한다.

DejaVu Sans Mono 라는 글꼴이 겹치지 않는 글꼴이라고 한다.

Inconsolata라는 글꼴도 안 겹친다고 한다. 이 글꼴은 설치해야 한다.

<pre class="brush:plain">sudo apt-get install ttf-inconsolata</pre>

터미널에서 글꼴을 바꾸는 방법을 설명하겠다.

터미널의 <span style="font-weight: bold;">파일 > 새 프로파일</span> 을 선택한다.

나름의 프로파일 이름을 적어 주자. 프로파일(profile)은 설정 저장 파일이라고 생각하면 된다.

그 다음, <span style="font-weight: bold;">편집 > 프로파일</span> 을 선택하자.

아까 만든 프로파일이 있을 것이다. 선택하고 <span style="font-weight: bold;">편집</span>을 눌러 주자.

그리고 나서 아래 그림처럼 글꼴을 바꿔 주면 된다.

<img src="/uploads/legacy/old-images/1/cfile9.uf.12297E484D4BC89225C839.png" class="aligncenter" width="540" height="436" alt="" />

<div style="width: 92px" class="wp-caption align">
  <img src="/uploads/legacy/old-images/1/cfile6.uf.176A85504D4BC89212A74E.png" width="82px" height="46px" alt="" /><p class="wp-caption-text">
    원래는 이렇게 겹친다.
  </p>
</div>