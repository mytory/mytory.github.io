---
title: 그리스몽키 GreaseMonkey로 워드프레스 태그 전체를 삭제하는 방법
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2988
aktt_notify_twitter:
  - yes
daumview_id:
  - 36584782
categories:
  - WordPress
tags:
  - WordPress Tip
---
오늘 크롬의 그리스몽키인 탐퍼몽키(Tampermonkey)를 이용해서 워드프레스 태그 전체를 삭제했다.

원래 sql 쿼리 날려서 지울까 했는데 불안했다. 실제로 웹에 떠도는 놈으로 쿼리를 날려 봤더니 태그뿐 아니라 카테고리도 일부 날아갔다. 그래서 sql은 사용하지 않기로 했다.

태그가 1000개쯤 있었다. 이걸 손으로 지우면 **전체선택 > 일괄작업에서 삭제 선택 > 적용** 이 짓을 50여 번 반복해야 했다.

그런데 문득 그리스몽키(탐퍼몽키(Tampermonkey))가 떠올랐고 코드를 짰다. 아래와 같은 코드였다.

<pre class="brush: javascript; gutter: true; first-line: 1">// ==UserScript==
// @name       워드프레스 태그 페이지에서 전체 삭제
// @namespace  http://use.i.E.your.homepage/
// @version    0.1
// @description  enter something useful
// @require    http://code.jquery.com/jquery-latest.js
// @match      http://mytory.net/wp-admin/edit-tags.php?taxonomy=post_tag*
// @copyright  2012+, You
// ==/UserScript==

if(jQuery(&#039;#the-list tr&#039;).length &gt; 1){
    jQuery(&#039;.wp-list-table thead input&#039;).click();
    jQuery(&#039;[name="action"]&#039;).val(&#039;delete&#039;).change();
    jQuery(&#039;#posts-filter&#039;).submit();
}</pre>

이렇게 했더니 tag가 다 날아갈 때까지 알아서 돌아가기 시작했다. 그래서 컴터 혼자 일한지 대략 3분만에 모든 태그를 지워버릴 수 있었다.

물론, 태그가 1개만 남는 경우엔 그 1개는 지우지 않고 스크립트가 멈춘다. 그러나 뭐 그건 손으로 지워 주면 되지.

## 태그는 왜 전부 삭제했는지?

태그는 방문자가 글을 좀더 잘 분류해서 볼 수 있도록 돕는 거다. 카테고리보다 좀더 다층적으로 분류를 볼 수 있으므로 대략 100개 내외로 유지하면 된다고 한다. 물론 이 수치는 사이트마다 다를 거다. 그러나 중요한 것은 태그 역시 기획되어야 한다는 거다.

내가 그동안 입력한 태그는 카테고리와 중복되거나 쓸모없는 태그가 너무 많았다. 예를 들어 지금 이 글에 &#8220;태그 삭제&#8221;라는 태그를 붙이는 식이었다. 대체 &#8220;태그 삭제&#8221;라는 분류가 필요한 이유가 없다.

또한 해당 태그에 속한 글 목록은 여러 중복 콘텐츠 문제를 낳아 검색엔진 최적화에 안 좋을 수 있다.

그래서 차라리 태그를 다 지우고 태그의 명확한 기준을 만든 다음 다시 시작하자는 생각이 들었다. 우선 드는 생각은, 카테고리명을 태그에 또 써도 될까 하는 거다. 아예 태그를 그냥 활용하지 말까 하는 생각도 든다. 카테고리가 잘 분류돼 있다면 태그가 필요할까? 검색도 잘 돼 있는데 말이다. 여튼 고민해 봐야겠다.

*2012-07-08 추가 : 구글 아날리틱스 통계를 확인해 보니 태그 페이지로 들어온 방문수는 1%밖에 되지 않았다. 즉, 1000명 중 10명만 태그 페이지를 본 것이다. 중복 콘텐츠를 제거해서 검색 순위가 오른다면 10명을 잃는 것보다 더 큰 이득이 있겠지.