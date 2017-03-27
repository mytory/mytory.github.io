---
title: 모든 트위터 글을 페이스북 페이지로 자동 발행하기
author: 안형우
layout: post
permalink: /archives/4859
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36535292
categories:
  - 서버단
tags:
  - PHP
---
*이 방법은 개발자에게 적합한 방법이다.

나는 원래 RSS Graffiti를 이용해서 트위터 글을 페이스북 페이지로 보냈었다. RSS Graffiti는 이 과정을 잘 처리해 줬다. 그런데 2012년 10월 15일부터 그 서비스가 중단됐다. 트위터의 API 정책 변경 때문이다. 트위터에게 인증을 받지 않으면 트위터 API를 사용할 수 없단다.

그래서 내가 새롭게 접근한 방법은 트위터의 RSS 피드를 재가공해서 RSS Graffiti에게 전달하는 방법이다. 이런 방법 없이 트위터 글을 페이스북 페이지로 보내려고 하니까 제대로 지원하는 걸 찾기 힘들어서 내가 직접 한 거다.

일단, 서버에서 cURL을 지원해야 하고 웹서버가 있어야 한다. 공짜 웹서버 찾아 보면 많이 있으니 웹서버가 없는 개발자라도 그런 걸 활용하면 될 거다.

RSS Graffiti 사용법은 따로 쓰지 않았다. 페이스북에서 검색해서 앱 설치하고 세팅하면 된다. 개발자라면 설명없이 할 수 있을 거다. 페이지 계정이 아니라 그냥 사용자 계정으로만 쓸 수 있으니 참고.

## 내 트위터 RSS를 가져와 가공해 주는 PHP 파일 만들기

자신의 트위터 RSS는 오늘(2012년 10월 21일) 기준으로 아래 형식이다.

<pre>http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=내id</pre>

위의 내id 부분에 그냥 자신의 아이디를 쓰면 된다.

cURL을 이용해서 트위터 피드를 긁은 다음 PHP의 SimpleXML 파서를 이용해서 가공했다. 코드는 아래와 같다.

<pre class="brush: php; gutter: true; first-line: 1">//압축 전송으로 트래픽을 절약한다.
ob_start("ob_gzhandler");

//콘텐츠 종류가 RSS+XML이고 인코딩이 utf-8이라고 알려 준다.
header("Content-type: application/rss+xml; charset=utf-8");

//텍스트로 있는 링크에 a 태그를 붙여서 실제 링크로 만들어 주는 함수
function linkfy($s) {
  return preg_replace(&#039;@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@&#039;, &#039;&lt;a href="$1"&gt;$1&lt;/a&gt;&#039;, $s);
}

// 텍스트를 받아서 첫 번째로 나오는 URL을 리턴해 주는 함수다.
function extract_link($s) {
  preg_match(&#039;@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@&#039;, $s, $matches);
  if( count($matches) &gt; 0 ){
	return $matches[0];
  }else{
	return FALSE;
  }
}

// 내 트위터 RSS
$url = &#039;http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=my_twitter_id&#039;;

// cURL로 트위터 RSS XML을 받아 온다.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$tweets = curl_exec($ch);
curl_close($ch);

// SimpleXML을 이용해서 XML을 PHP 객체와 배열로 만든다. 
// http://www.php.net/manual/en/simplexml.examples-basic.php 참고
$xmldom = new SimpleXMLElement($tweets);

$item_count = count($xmldom-&gt;channel-&gt;item);

// 트위터 글에 링크가 있으면 RSS의 목적지 URL을 그 링크로 대체한다.
// 이렇게 하지 않으면 RSS의 목적지 URL이 트위터 글이 된다.
for($i = 0; $i &lt; $item_count; $i++){
	$desc = $xmldom-&gt;channel-&gt;item[$i]-&gt;description;
	$new_guid = extract_link($desc);
	//링크가 잘려서 들어가는 경우가 있다. 링크 길이 검사.
	if( $new_guid AND strlen($new_guid)&gt;19 ){
		$xmldom-&gt;channel-&gt;item[$i]-&gt;guid = $new_guid;
		$xmldom-&gt;channel-&gt;item[$i]-&gt;link = $new_guid;
	}
	if( strlen($new_guid)&gt;19 ){
		$xmldom-&gt;channel-&gt;item[$i]-&gt;description = linkfy($desc);
	}
}

//SimpleXML 객체를 XML 문자열로 바꿔서 출력한다.
echo $xmldom-&gt;asXML();</pre>

위 코드를 적당한 파일을 만들어서 넣는다. `twitter-rss.php` 따위로 말이다. 그리고 RSS Graffiti 앱에 가서 위 URL을 넣어 준다. 그래서 내 트위터 RSS의 URL은 `mytory.net/twitter-rss.php` 가 됐다.

내 설정 결과는 아래 이미지를 참고한다.

<p style="text-align: center;">
  <img class="aligncenter" src="/uploads/legacy/rssgraffiti-twitter.png" alt="" width="680" height="663" />
</p>