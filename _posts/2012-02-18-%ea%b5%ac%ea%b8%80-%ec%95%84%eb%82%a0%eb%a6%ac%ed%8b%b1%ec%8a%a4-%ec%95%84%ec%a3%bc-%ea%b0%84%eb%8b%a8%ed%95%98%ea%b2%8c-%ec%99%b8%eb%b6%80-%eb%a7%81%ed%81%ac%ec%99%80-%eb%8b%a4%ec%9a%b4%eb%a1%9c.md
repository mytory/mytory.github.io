---
title: '[구글 아날리틱스] 아주 간단하게 외부 링크와 다운로드 추적하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/2279
aktt_notify_twitter:
  - yes
daumview_id:
  - 36623293
categories:
  - 웹 분석과 검색
tags:
  - Google Analytics
  - Web Analytics
---
워드프레스 플러그인 중에 [Google Analyticator][1]라는 게 있다. [포럼][2]도 있다. 여기 있는 코드를 활용하면 아주 간단하게 추적을 할 수 있다. (워드 프레스를 사용하는 사람이라면 설치하고 설정에서 활성화해 주면 끝이다.)

위 플러그인을 다운받아 압축을 풀면 external-tracking.js 라는 파일도 있다. 이게 외부 링크와 다운로드 링크를 추적하는 코드다. 이놈을 그냥 파일에 넣으면 되는데, 코드 두 줄을 위에 삽입해 줘야 한다.

플러그인 설정은 js에 쓸 수가 없기 때문에 js파일에 포함돼 있지 않은 거다. 그래서 수동으로 넣어 줘야 하는 거다. 코드는 간단하다.

<pre class="brush: javascript; gutter: true; first-line: 1">var analyticsFileTypes = [&#039;pdf&#039;,&#039;zip&#039;,&#039;mp3&#039;];
var analyticsEventTracking = &#039;enabled&#039;;</pre>

이렇게 파일의 맨 위에다 넣는다. 위의 파일타입 부분에 원하는 파일 타입들을 넣어 주면 되겠다. 그리고 페이지에 포함한다. 그러면 끝!

그래서 완성된 결과물은 아래와 같다. 아래 코드를 복사해서 js 파일을 만들면 된다.

<pre class="brush: javascript; gutter: true; first-line: 1">var analyticsFileTypes = [&#039;pdf&#039;,&#039;zip&#039;,&#039;mp3&#039;];
var analyticsEventTracking = &#039;enabled&#039;;

jQuery(document).ready(function() {
  jQuery(&#039;a&#039;).each(function() {
    var a = jQuery(this);
    var href = a.attr(&#039;href&#039;);
    
    // Check if the a tag has a href, if not, stop for the current link
    if ( href == undefined )
      return;
    
    var url = href.replace(&#039;http://&#039;,&#039;&#039;).replace(&#039;https://&#039;,&#039;&#039;);
    var hrefArray = href.split(&#039;.&#039;).reverse();
    var extension = hrefArray[0].toLowerCase();
    var hrefArray = href.split(&#039;/&#039;).reverse();
    var domain = hrefArray[2];
    var downloadTracked = false;
  
     // If the link is a download
    if (jQuery.inArray(extension,analyticsFileTypes) != -1) {
      // Mark the link as already tracked
      downloadTracked = true;
      
      // Add the tracking code
      a.click(function() {
        if ( analyticsEventTracking == &#039;enabled&#039; ) {
          _gaq.push([&#039;_trackEvent&#039;, &#039;Downloads&#039;, extension.toUpperCase(), href]);
        } else
          _gaq.push([&#039;_trackPageview&#039;, analyticsDownloadsPrefix + url]);
      });
    }
    
    // If the link is external
     if ( ( href.match(/^http/) ) && ( !href.match(document.domain) ) && ( downloadTracked == false ) ) {
        // Add the tracking code
      a.click(function() {
        if ( analyticsEventTracking == &#039;enabled&#039; ) {
          _gaq.push([&#039;_trackEvent&#039;, &#039;Outbound Traffic&#039;, href.match(/:\/\/(.[^/]+)/)[1], href]);
        } else
          _gaq.push([&#039;_trackPageview&#039;, analyticsOutboundPrefix + url]);
      });
    }
  });
});</pre>

 [1]: http://wordpress.org/extend/plugins/google-analyticator/
 [2]: http://wordpress.org/support/plugin/google-analyticator