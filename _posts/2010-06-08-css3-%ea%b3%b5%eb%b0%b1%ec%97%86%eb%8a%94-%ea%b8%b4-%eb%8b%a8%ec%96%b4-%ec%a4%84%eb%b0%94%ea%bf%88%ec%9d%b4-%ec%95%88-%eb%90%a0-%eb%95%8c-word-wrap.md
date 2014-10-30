---
title: '[CSS3] 공백없는 긴 단어 줄바꿈이 안 될 때 word-wrap'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/665
aktt_notify_twitter:
  - yes
daumview_id:
  - 36869337
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - CSS3
---
그럴 때는 <a href="http://www.webdesignerwall.com/tutorials/word-wrap-force-text-to-wrap/" target="_blank">word-wrap: break-word</a> 를 사용하면 되는 것 같다. <a href="http://www.webdesignerwall.com/demo/word-wrap/" target="_blank">예제는 여기서</a> 볼 수 있다. <div>
  이건 <a href="http://www.w3.org/TR/css3-text/#word-wrap" target="_blank">css3 프로퍼티</a>다.
</div>

<div>
  하지만, 현재 IE6 이상, 사파리(그래서 아마 크롬도), Firefox 3.1 이상은 지원한고 한다.(<a href="http://www.css3.info/preview/word-wrap/" target="_blank">출처</a>)
</div>

<div>
  그리고 Firefox 테이블에서 이게 제대로 작동 안 한다는 말도 있는 것 같은데, <a href="http://stackoverflow.com/questions/1258416/word-wrap-in-a-html-table" target="_blank">여기서 토론을 볼 수 있다.</a>
</div>