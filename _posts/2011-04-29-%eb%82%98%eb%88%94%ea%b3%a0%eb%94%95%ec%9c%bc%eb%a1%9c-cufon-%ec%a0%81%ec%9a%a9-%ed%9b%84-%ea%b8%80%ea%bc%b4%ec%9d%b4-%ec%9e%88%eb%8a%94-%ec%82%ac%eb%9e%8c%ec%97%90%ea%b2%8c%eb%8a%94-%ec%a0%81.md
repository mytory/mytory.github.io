---
title: 나눔고딕으로 Cufon 적용 후, 나눔고딕이나 맑은 고딕이 있는 사람에게는 적용하지 않기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1169
aktt_notify_twitter:
  - yes
daumview_id:
  - 36736098
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
사용되는 라이브러리는 [jquery.font][1] 다. 이놈은 사용자가 해당 글꼴을 갖고 있는지 감지해 준다.

이 글을 찾아 오신 분들 중에는 [Cufon][2]이 뭔지 모르는 분이 없을 거라 생각한다. (Cufon은 텍스트를 받아 글자를 그려 주는 라이브러리다.)

아래 함수를 이용하면, 나눔고딕이나 맑은 고딕 글꼴이 있는 경우 Cufon을 아예 건너뛰게 된다. 당연히 트래픽이 절약된다.(나눔고딕은 붙여 쓰고, 맑은 고딕은 띄어 쓴다.)

<pre class="brush:js">function iHaveFont(){
	return ($.font.test(&#039;나눔고딕&#039;) == true || $.font.test(&#039;맑은 고딕&#039;) == true);
}

if(iHaveFont() == false){
	$(&#039;&lt;script/&gt;&#039;,{
		type: &#039;text/javasript&#039;,
		src: &#039;/js-lib/cufon/cufon.js&#039;
	}).appendTo(&#039;head&#039;);

	$(&#039;&lt;script/&gt;&#039;,{
		type: &#039;text/javasript&#039;,
		src: &#039;/js-lib/cufon/NanumGothic_600.font.js&#039;
	}).appendTo(&#039;head&#039;);
}

$(document).ready(function() {
	if(iHaveFont() == false){
		Cufon.replace(&#039;.cufon&#039;);
	}
});</pre>

가운데 있는 if문 안에 있는 코드는 script를 생성하는 방법이다. 이 방법은 [&#8216;[번역] 아름답게 jQuery 엘리먼트 생성하기 Beautiful Element Creation with jQuery&#8217;][3]에 잘 설명돼 있다.

내가 맨 처음 제시한 방법은 `document.write('<script type="text/javascript" src="..."></script>')` 형식으로 직접 코드를 쓰는 방식이었다. 그러나 이 방법을 사용하니까, 불러오지 않아도 되는 조건인데도 자바스크립트 파일을 불러오는 것이었다. 그래서 방식을 바꿨다.

## 참고사항

Cufon의 트래픽을 절약하기 위해서 [js와 css를 압축해 내보내는 방법][4]도 참고할 만하다.

만약 [PHP4를 사용하는 사람이라면 내가 설명한 편법을 사용][5]하는 것도 괜찮은 해법이 된다.

 [1]: http://mytory.local/archives/118 "폰트가 설치돼 있는지 확인해 주는 javascript"
 [2]: https://github.com/sorccu/cufon/wiki/
 [3]: http://mytory.local/archives/829 "[번역] 아름답게 jQuery 엘리먼트 생성하기 Beautiful Element Creation with jQuery"
 [4]: http://mytory.local/archives/1048 "[minify] js, css 압축 – 웹사이트 속도 증가, 트래픽 절약"
 [5]: http://mytory.local/archives/1161 "거대한 용량의 Cufon 글꼴 js 파일로 걱정인데 php 버전이 낮아 minify를 사용하지 못하는 사람을 위한 편법"