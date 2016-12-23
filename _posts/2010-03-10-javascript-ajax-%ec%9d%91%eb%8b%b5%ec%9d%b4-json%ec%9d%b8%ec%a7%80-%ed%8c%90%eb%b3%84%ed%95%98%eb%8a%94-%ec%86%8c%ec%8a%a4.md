---
title: javascript, ajax 응답이 json인지 판별하는 소스
author: 안형우
layout: post
permalink: /archives/380
aktt_notify_twitter:
  - yes
daumview_id:
  - 37013012
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<pre class="brush:js">//앞뒤 코드는 생략
 if(/\{/.test(response)){
	JSONObj = eval("("+response+")");  
	//비지니스 로직
}
</pre>

내 사용 의도에서 핵심은 저 <a target="_blank" href="http://mytory.textcube.com/entry/%ED%95%9C%EA%B8%80-%EC%9E%88%EB%8A%94%EC%A7%80-%EA%B2%80%EC%82%AC%ED%95%98%EB%8A%94-%EC%A0%95%EA%B7%9C%EC%8B%9D">test 함수</a>다. &#8216;{&#8216;가 있으면 json으로 판별, 없으면 그냥 자료로 판별한다.

당연히 오류가 있을 수 있는데, 내가 사용한 로직에서는 json인 경우만 {를 응답받으므로 그냥 사용했다.

조언해 주실 분 있다면 조언 부탁드린다.