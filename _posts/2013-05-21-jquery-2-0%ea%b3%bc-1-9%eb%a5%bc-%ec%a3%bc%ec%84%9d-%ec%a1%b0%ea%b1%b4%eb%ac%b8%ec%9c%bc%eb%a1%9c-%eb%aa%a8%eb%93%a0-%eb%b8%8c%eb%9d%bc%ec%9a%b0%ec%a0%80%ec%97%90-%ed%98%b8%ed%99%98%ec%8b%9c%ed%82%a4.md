---
title: jQuery 2.0과 1.9를 주석 조건문으로 모든 브라우저에 호환시키기
author: 안형우
layout: post
permalink: /archives/10176
daumview_id:
  - 44963554
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
<pre>&lt;!--[if !IE]&gt; --&gt;
&lt;script src="jquery-2.0.0.min.js"&gt;&lt;/script&gt;
&lt;!-- &lt;![endif]--&gt;
&lt;!--[if lt IE 9]&gt;
&lt;script src="jquery-1.9.1.min.js"&gt;&lt;/script&gt;
&lt;![endif]--&gt;
&lt;!--[if gte IE 9]&gt;
&lt;script src="jquery-2.0.0.min.js"&gt;&lt;/script&gt;
&lt;![endif]--&gt;</pre>

일단 이렇게 하면 IE9과 그 외 브라우저에서는 2.0.0을, IE8 이하에서는 1.9.1을 로드하게 된다. 주석 조건문으로 처리했으니 특별히 추가 로딩 부담이 발생하지도 않는다.

단, 이렇게만 하면 파이어폭스와 크롬의 구버전에서 어떤 일이 생길지는 모르겠다.

검색을 해 보니 이런 말이 있다.([FIREFOX 3.6 NOT SUPPORTED IN JQUERY 2.0? comment:13][1])

> Ah, thanks for identifying the disconnect there Nao. As others have pointed out, we technically &#8220;dropped support&#8221; for FF3.6 around the time 1.8 came out. (When 1.7 came out, FF4 had just come out, IIRC. By the time 1.8 came out, FF 12 was the current version.) So that&#8217;s why it wasn&#8217;t mentioned in any blog posts wrt to 1.9.

번역은 잘 못하겠고, 대충 이런 말인데,

> 파이어폭스 3.6은 jQuery 1.8쯤에서 지원을 끊었다. jQuery 1.7이 나왔을 때 파이어폭스 4가 나왔다. jQuery 1.8이 나왔을 때 파이어폭스 최신 버전은 12였다. 그래서 jQuery 1.9가 나왔을 때 별다른 언급이 없었던 거다.

뭐 대충 이런 말이다. 이런 거 말고는 찾기가 힘들다. jQuery 버전별 브라우저 서포트를 찾아 보면 도움이 될 지도 모르겠다는 생각은 드는데, 필요하면 찾으려고 생각중이다. 끝!

 [1]: http://bugs.jquery.com/ticket/13404#comment:13