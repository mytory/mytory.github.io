---
title: 브라우저의 스타일 간섭 없애기
author: 안형우
layout: post
permalink: /archives/24
aktt_notify_twitter:
  - yes
daumview_id:
  - 37266044
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
브라우저에 있는 기본 스타일을 제거하는 css다. 기본으로 이 css를 집어넣고 디자인을 시작하는 게 편하다. 기록용으로 놔둔다. 아래 코드는 <a target="_blank" href="http://www.aladdin.co.kr/shop/wproduct.aspx?ISBN=8979144784">《CSS비밀 메뉴얼》 (2007)</a>의 441p를 참고했다.

이 책의 저자는 <a target="_blank" href="http://tantek.com/log/2004/undohtml.css">탄텍 셀릭의 기법</a>도 추천하고 있다.

<pre title="code" class="brush: css;">body, h1, h2, h3, h4, h5, h6, p, ol, ul, form, blockquote{
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, pre, code{
	font-size: 1em;
}
a{
	text-decoration: none;
}
a img{
	border: none;
}
h1{
	margin-top: 5px;
	font-size: 2.5em;	
}
</pre>