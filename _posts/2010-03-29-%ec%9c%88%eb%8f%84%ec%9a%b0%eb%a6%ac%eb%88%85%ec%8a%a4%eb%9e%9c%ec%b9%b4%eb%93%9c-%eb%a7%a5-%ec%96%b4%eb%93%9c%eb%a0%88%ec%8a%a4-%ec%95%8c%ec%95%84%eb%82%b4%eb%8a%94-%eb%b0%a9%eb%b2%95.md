---
title: '[윈도우,리눅스]랜카드 맥 어드레스 알아내는 방법'
author: 안형우
layout: post
permalink: /archives/470
aktt_notify_twitter:
  - yes
daumview_id:
  - 36985500
categories:
  - 기타
tags:
  - TIP
---
간혹 비밀번호가 없는 AP인데 연결을 해도 헛돌기만 하고 연결되지 않는 경우가 있다. <div>
  이런 경우는 AP의 관리자가 허용된 MAC 어드레스만 연결되도록 설정한 경우다.
</div>

<div>
  자, 우리 집에 있는 무선 네트워크 공유기를 이런 식으로 활용하려면 어떻게 해야 할까?
</div>

<div>
  공유기 설명서를 보면 되겠지만, 자기 컴퓨터의 MAC 어드레스 주소를 알아내는 것도 필요하다.
</div>

<div>
  윈도우에서 알아내는 방법을 설명하겠다.<s>(리눅스에서는 어떻게 알아내는지 모른다;;)</s>
</div>

<div>
  리눅스에서 알아내는 방법은 아래쪽에 설명돼 있다.
</div>

<div>
  윈도우+R 키를 누르거나 시작 메뉴에서 &#8216;실행&#8217;을 누른 후 cmd를 치고 엔터.
</div>

<div>
  그러면 콘솔 창이 뜬다.
</div>

<div>
  거기에 ipconfig /all 이라고 친다.
</div>

<div>
  그러면 아래처럼 화면이 나오게 되는데, 표시한 부분이 Mac Address다.
</div>

<div>
  <img src="/uploads/legacy/old-images/1/cfile9.uf.11086D494D4BC8D52E13F4.jpg" class="aligncenter" width="580" height="573" alt="" />
</div>

<div>
  트위터에 이 글을 올렸더니 @seyriz님이 RT를 하면서 리눅스에서 맥어드레스 얻는 법을 알려 주셨다.
</div>

<div>
  <pre class="brush:plain">리눅스에서 맥어드레스 얻는 법. 콘솔을 연다 ifconfig -&gt; return 끝 </pre>
</div>

<div>
  좋은 정보 감사드린다.
</div>