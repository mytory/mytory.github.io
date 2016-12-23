---
title: '우체국의 우편번호 API를 이용해 우편번호 검색 서비스를 만들어 보자 &#8211; 서버단'
author: 안형우
layout: post
permalink: /archives/1284
aktt_notify_twitter:
  - yes
daumview_id:
  - 36713509
mytory_md_path:
  - 
categories:
  - 서버단
tags:
  - PHP
---
[우체국의 API는 구주소만 서비스한다. 도로명 주소를 검색하려면 [공공데이터포털][1]을 이용해야 한다. 우체국 API를 이용해 구주소를 검색하는 이 예제도 2014-01-10 현재 잘 돌아간다. 공공데이터포털을 이용할 사람은 내가 쓴 [공공데이터포털의 우편번호 API 정리 글][2]을 참고하라.]

<span style="line-height: 1.5em;">예전에 </span><a style="line-height: 1.5em;" title="우편번호 오픈API _ IE에서만 돌아간다?" href="http://mytory.net/archives/420">우체국이 제공하는 우편번호 API</a><span style="line-height: 1.5em;">에 대해 쓴 적이 있었다.</span>

당시 나는 세 가지 문제에 봉착했다.

1.  ajax 호출이 되지 않는다.
2.  테스트를 해 보려고 url로 적으면, IE에서는 보이는데 크롬과 파이어폭스에서는 보이지 않는다.
3.  `file_get_contents`로 긁어도 안 된다.

그래서 포기했었다. 그냥 DB를 이용했다. 그렇게 하니 최신 우편번호를 적용하기 위해 DB를 매번 갱신해 줘야 했다.

시간이 지나고 많은 것을 알게 됐다. 일단 다른 domain에 있는 놈을 ajax 호출하는 것은 안 된다는 것을 알게 됐다. 그래서 1번 문제가 해결됐다.

2번 문제는, `URL`로 접근할 때나 문제지 호출할 때 그 자체로는 문제가 되지 않으며 `POST`로 값을 넘기면 된다는 사실을 알게 됐다. 그래서 해결.

3번 문제는, `file_get_contents`가 `GET` 방식으로만 값을 넘길 수 있어서 그랬던 것이라는 점을 인지했다. 그래서 `file_get_contents`가 아닌, `POST`로 값을 넘겨 응답을 받을 수 있는 PHP 함수를 찾기로 결심!, 그리고 드디어 찾았다.

[▶예제 보기][3] | [▶코드 다운로드][4]

[우체국 우편번호 API 신청 페이지][5]

(최근에 1day1님의 블로그에서 [`file_get_contents` 함수로 우편번호 API를 사용할 수 있게 하는 글][6]을 찾았다. 옵션을 줘야 한다. 저 글에서 제시하는 예제 코드는 아래와 같다.)

<pre class="brush:php">$api_key = "우체국에서 받은 API KEY";
$epost_url = "http://biz.epost.go.kr/KpostPortal/openapi?regkey=$api_key&target=post&query=을지로3가"; 

$opts = array(
  'http'=&gt;array(
    'method'=&gt;"GET",
    'header'=&gt;"Accept-language: ko\r\n"
  )
);

$context = stream_context_create($opts);

$fp = file_get_contents($epost_url , false, $context);</pre>

## cURL로 가져오기

내가 사용한 방법은 PHP의 cURL 라이브러리를 사용한다. 웬만한 호스팅에는 설치돼 있을 거다. 우분투 사용자들이라면 아래 명령어로 간단하게 설치할 수 있다.

<pre>sudo apt-get install php5-curl</pre>

(혹시나 해서 덧붙이는데, 설치한 다음 아파치를 재시작해야 적용된다.)

## cURL을 이용해 웹페이지의 내용을 읽어 오는 함수

이 함수는 [bluesunh님의 노트] cURL Library를 참고했다. (스프링노트 폭파로 링크 유실)

<pre class="brush:php">function fetch_page($url,$param,$cookies=NULL,$referer_url=NULL){
    if(strlen(trim($referer_url)) == 0) $referer_url= $url;
    $curlsession = curl_init ();
    curl_setopt ($curlsession, CURLOPT_URL, $url);
    curl_setopt ($curlsession, CURLOPT_POST, 1);
    curl_setopt ($curlsession, CURLOPT_POSTFIELDS, $param);
    //curl_setopt ($curlsession, CURLOPT_POSTFIELDSIZE, 0);
    curl_setopt ($curlsession, CURLOPT_TIMEOUT, 60);
    if($cookies && $cookies!=""){
        curl_setopt ($curlsession, CURLOPT_COOKIE, $cookies);
    }
    curl_setopt ($curlsession, CURLOPT_HEADER, 1); //헤더값을 가져오기위해 사용합니다. 쿠키를 가져오려고요.
    curl_setopt ($curlsession, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.01; Windows NT 6.0)");
    curl_setopt ($curlsession, CURLOPT_REFERER, "$referer_url"); 

    ob_start();
    $res = curl_exec ($curlsession);
    $buffer = ob_get_contents();
    ob_end_clean();
    $returnVal = array();
    if (!$buffer) {
    	$returnVal['error'] = true;
        $returnVal['content'] = "Curl Fetch Error : ".curl_error($curlsession);
    }else{
    	$returnVal['error'] = false;
        $returnVal['content'] = $buffer;
    }
    curl_close($curlsession);
    return $returnVal;
}</pre>

## 우편번호 오픈 API에서 `xml`을 받아 오는 함수

자, 그럼 이제 우편번호 오픈 API에서 `xml`을 받아 오는 함수를 만들어 보자. 이 함수는 위 함수를 사용한다.

<pre class="brush:php">function get_post_code_xml_by_api($query){
	$query = iconv('utf-8','euc-kr',$query);

	$post_data = array(
	    'target' =&gt; 'post',
	    'regkey' =&gt; '1234567890', //자신의 키를 입력
	    'query' =&gt; $query
	);

	$url = 'http://biz.epost.go.kr/KpostPortal/openapi';
	$param = http_build_query($post_data);
	$result = fetch_page($url,$param);
	$result['content'] = remove_none_xml_word($result['content']);

	return $result;
}</pre>

위에서 regkey 는 [우편번호 오픈 API 웹사이트에 가서 등록][5]을 한 후 받으면 된다.

`$param`을 만드는 데 사용한 [`http_build_query` 함수는 내가 쓴 설명을 참고][7]하면 된다.

$query를 받아서 `iconv` 함수를 이용해 `euc-kr`로 변환해 줬는데, 내가 기본으로 `utf-8` 인코딩을 사용한다고 가정했기 때문이다.

위에서 `return` 직전에 `remove_none_xml_word` 라는 함수가 보일 거다.

그 놈은 `cURL`이 넘겨주는 `header` 값을 지워 버리고 순수 `xml`만 남기기 위한 함수다. 그놈을 만들어 보자.

<pre class="brush:php">function remove_none_xml_word($content){
	$content_array = explode("\n", $content);
	foreach ($content_array as $key =&gt; $value) {
		if(substr(trim($value),0,1)!='&lt;'){
			$content_array[$key]='';
		}
	}
	unset($content_array[0]);
	$content = implode("\n", $content_array);
	return trim($content);
}</pre>

위에서 `unset` 함수를 쓴 이유는, 첫 줄이 빈 줄이기 때문이다. 첫 줄이 빈 줄이면 `XML` 파싱할 때 에러난다.

## 우편번호에 대시(-)를 넣어 주는 함수

우편번호 오픈 API는 우편번호를 그냥 123456형식으로 넘겨 준다. 사이에 -를 넣어 보기 좋게 만들어야 사용자들에게 좋을 거다.

또한 그러면서 앞 번호와 뒷 번호를 구분하기 위해 span으로 감싸고 클래스를 매겼다. postcd1, postcd2 하는 식으로 말이다.

<pre class="brush:php">function add_dash_and_tag_to_postcd($postcd){
	$postcd1=substr($postcd,0,3);
	$postcd2=substr($postcd,3,3);
	return "&lt;span class="postcd1"&gt;$postcd1&lt;/span&gt;-&lt;span class="postcd2"&gt;$postcd2&lt;/span&gt;";
}</pre>

## HTML을 뿌려 주는 함수

이런 함수들을 바탕으로 이제 HTML을 뿌려 주는 함수를 만들어 보자.

<pre class="brush:php">function print_postcode_table($xml){
	?&gt;
	&lt;table class="postcode"&gt;&lt;tbody&gt;
	&lt;?php
	    foreach ($xml-&gt;itemlist-&gt;item as $value) {
	    	$postcd = add_dash_and_tag_to_postcd($value-&gt;postcd);
	    	echo '&lt;tr&gt;';
	    	echo "&lt;td&gt;&lt;a class='address' href='#{$value-&gt;postcd}'&gt;{$value-&gt;address}&lt;/a&gt;&lt;/td&gt;";
	    	echo "&lt;td&gt;&lt;a class='postcd' href='#{$value-&gt;postcd}'&gt;{$postcd}&lt;/a&gt;&lt;/td&gt;";
	    	echo '&lt;/tr&gt;';
	    }
	?&gt;
	&lt;/tbody&gt;&lt;/table&gt;
	&lt;?php
}</pre>

`print_postcode_table` 함수는 [simpleXML][8]의 node를 받아서 `table` 형태로 주소와 우편번호를 뿌려 주는 함수다.

가운데 있는 `foreach`가 왜 저런 모양이 됐는지는 실행부를 보면 알 수 있을 것이다.

## 실행부

이제 실행부다. 위 함수들을 functions_postcode.php 에 넣었다고 가정하자.

<pre class="brush:php">include_once 'include/functions_postcode.php';
header('Content-Type:text/html;charset=utf-8');

if(!empty($_GET['query'])){
	$result = get_post_code_xml_by_api($_GET['query']);	

	if ($result['error'] == false){
		$xml = new SimpleXMLElement($result['content']);
		if(count($xml-&gt;itemlist-&gt;item) == 0){
			echo '결과가 없습니다';
		}else{
			print_postcode_table($xml);
		}
	}
	else {
		echo '에러 발생: ' . $result['content'];
	}
}else{
	echo '검색어를 입력하세요.';
}</pre>

우편번호 오픈 API의 인코딩은 `euc-kr`이다. 하지만 나는 `utf-8`로 무조건 페이지를 만든다.

물론 `SimpleXMLElement` 클래스를 생성하면, 지가 알아서 `euc-kr`인 `xml`을 `utf-8`로 변경한다.

그런데 한국 브라우저들은 인코딩 선언이 특별히 없는 경우 기본 인코딩을 `euc-kr`로 한다. 그래서 `header`쪽에 인코딩 선언을 넣어 줬다.(둘째 줄) 이 놈은 html로 뿌려줄 용도기 때문에 `content-type`은 `text/html`이다.

나머지 `if`문은 다 이해가 될 것이라고 생각한다.

일단 이렇게 하면 `search_post.php?query=삼천포` 형식으로 URL을 적었을 때 훌륭한 테이블로 결과값이 펼쳐질 것이다.

특히 `js`로 주소를 넣고 빼고 하는 것을 제어할 수 있도록, 테이블에 클래스를 넣었고, 내용은 `a` 태그로 감쌌다. `a`의 클래스는 무엇을 감싸고 있냐에 따라 각각 `address`, `postcd1`, `postcd2` 다. 우편번호를 삽입하는 부분은 이것을 참고하면 된다.

그러면 우편번호 API 활용법 서버단 끝이다.

[▶예제 보기][3] | [▶코드 다운로드][4]

 [1]: https://www.data.go.kr/
 [2]: http://mytory.net/archives/12185 "공공데이터포털 우편번호 신청 절차와 API 정리"
 [3]: /wp-content/uploads/code-example/postcode/
 [4]: /wp-content/uploads/code-example/postcode/postcode.7z
 [5]: http://biz.epost.go.kr/openapi/openapi_request.jsp?subGubun=sub_3&subGubun_1=cum_38&gubun=m07
 [6]: http://blog.1day1.org/465
 [7]: http://mytory.net/archives/1279 "[PHP] 배열을 URL GET 변수로 만들어 주는 함수 http_build_query"
 [8]: http://www.php.net/manual/kr/book.simplexml.php