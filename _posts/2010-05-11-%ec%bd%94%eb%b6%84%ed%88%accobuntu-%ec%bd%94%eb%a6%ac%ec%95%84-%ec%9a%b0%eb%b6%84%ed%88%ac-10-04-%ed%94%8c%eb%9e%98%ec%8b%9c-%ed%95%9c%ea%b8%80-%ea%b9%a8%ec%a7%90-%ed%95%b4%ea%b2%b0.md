---
title: '코분투(cobuntu &#8211; 코리아 우분투?) 10.04 플래시 한글 깨짐 해결'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/582
aktt_notify_twitter:
  - yes
daumview_id:
  - 36941942
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
<div>
  <a href="http://ubuntu.or.kr/viewtopic.php?p=56951#p56951" target="_blank">http://ubuntu.or.kr/viewtopic.php?p=56951#p56951</a>
</div>

<div>
  위 글에는 은돋움으로 바꾸는 방법이 설명돼 있습니다.
</div>

<div>
  나눔고딕으로 하고 싶다면 nanumgothic이라고 써 넣으시면 됩니다.
</div>

<div>
  (요약설명하자면, 일단 아래 코드를 터미널에서 쳐 넣으세요.)
</div>

<pre class="brush:plain">sudo gedit /etc/fonts/conf.avail/49-sansserif.conf</pre>

<div>
  그리고 맨 아래의 sans-serif에 원하는 글꼴의 영문명을 집어넣으세요.
</div>

<div>
  코분투 10.04라면 기본글꼴이 나눔고딕이니까 nanumgothic이라로 쓰면 기본 글꼴과 통일할 수 있을 겁니다. 글골이 예쁘기도 하고요.^^
</div>

## 더 간단하게 되지만 글꼴은 이상해지는 방법

<div>
  더 간단하게 하는 방법도 있습니다만 글꼴이 이상한 놈이 되므로 비추입니다.
</div>

<div>
  일단 출처를 알려드리고 : <a target="_blank" href="http://kldp.org/node/114592#comment-526881">http://kldp.org/node/114592#comment-526881</a>
</div>

<div>
  터미널에서 아래 명령 입력해 주세요.
</div>

<div>
  <pre class="brush:plain">sudo mv /etc/fonts/conf.d/49-sansserif.conf /root</pre>
</div>

<div>
  위 방법으로 해결하면 글꼴이 방울첸가 뭔가 여튼 잘 안 쓰는 귀여운 글꼴이 됩니다.
</div>

<div>
  나눔고딕같이 원하는 글꼴로 바꾸고 싶다면 아래 글을 참고하세요.
</div>