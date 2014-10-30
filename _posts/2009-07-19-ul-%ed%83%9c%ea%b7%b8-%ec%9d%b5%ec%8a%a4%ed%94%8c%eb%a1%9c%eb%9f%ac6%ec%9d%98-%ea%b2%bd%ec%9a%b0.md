---
title: UL 태그, 익스플로러6의 경우
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/8
aktt_notify_twitter:
  - yes
daumview_id:
  - 37274099
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
익스플로러6는 **아마도**&nbsp;UL 태그 안에 LI나 OL, UL 등 목록에 관련된 태그 외에는 허용하지 않는 것 같다.

예컨대,

<pre title="code" class="brush: xhtml;">&lt;ul&gt;
  &lt;li&gt;하하하&lt;/li&gt;
  &lt;div&gt;이런!&lt;/div&gt;
  &lt;li&gt;저런!&lt;/div&gt;
&lt;/ul&gt;</pre>

이런 식으로 만들어져 있는 태그가 있다면, 익스플로러6는

<pre title="code" class="brush: php;">&lt;UL&gt;&lt;LI&gt;하하하
&lt;DIV&gt;이런!&lt;/DIV&gt;
&lt;LI&gt;저런! &lt;/LI&gt;&lt;/UL&gt;</pre>

이렇게 이해하게 됩니다.

그 결과는? 아래 같은 계층 구조가 만들어지게 되죠.

<img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile2.uf.184DBC4C4D4BC862282530.jpg" class="alignleft" width="185" height="129" alt="" />

<ttml tt\_class="fileone" tt\_w="185px" tt\_h="129px" tt\_alt="" tt\_link="" tt\_filename="cfile2.uf.184DBC4C4D4BC862282530.jpg" tt\_caption="" tt\_align="left" tt_type="img"></ttml>그러면, 뭔가 문제가 생기겠죠.

어제 디자인하다가 이런 문제 때문에 곯머리를 앓았습니다.

UL 안에 DIV를 넣었기 때문임을 어렴풋이 감지하고, DIV를 LI로 교체하니까 문제가 깔끔하게 해결됐습니다.

UL과 익스플로러6 때문에 지금 고생하는 분이 있다면 한 번 UL 안에 LI 등 목록 관련 태그 외에 들어가 있는 것은 없는지 확인해 보세요.

물론, 제 정보가 부정확한 것이라 틀릴 수 있습니다만, 혹시 li에 문제가 있다면 이런 식으로 수정해 보는 것도 좋을 것입니다.