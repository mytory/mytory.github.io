---
title: PHP에서 JSON 사용하기
author: 안형우
layout: post
permalink: /archives/40
aktt_notify_twitter:
  - yes
daumview_id:
  - 37262839
categories:
  - 서버단
tags:
  - PHP
---
json을 처음 공부하려는 사람이라면, 일단 도움이 되는 기술 문서를 정독하라.

*    <a href="http://www.ibm.com/developerworks/kr/library/wa-ajaxintro10/" target="_blank">Ajax 마스터하기, Part 10: 데이터 전송에 JSON 사용하기</a>
*    <a href="http://www.ibm.com/developerworks/kr/library/wa-ajaxintro11.html" target="_blank">Ajax 마스터하기, Part 11: 서버 측의 JSON</a>

위의 두 기술문서는 IBM에 있는 자료인데, JSON의 개념을 정말 쉽게 잘 써놨다.

## PHP에서 JSON 사용하기 준비물

일단 준비물. js파일은 필요 없다. **JSON은 자바스크립트에 기본으로 내장돼있다.**

> JSON은 네이티브 JavaScript 포맷이고, JavaScript 내에서 JSON 데이터와 작업하기 위해 특별한 API나 툴킷이 필요 없다.  
> &#8211; <a href="http://www.ibm.com/developerworks/kr/library/wa-ajaxintro10/" target="_blank">Ajax 마스터하기, Part 10: 데이터 전송에 JSON 사용하기</a> 중

이걸 강조해 둔 이유는 내가 js파일을 찾느라 시간을 꽤 허비했기 때문이다;;

## PHP 버전 : 5.2.1 이상

PHP 버전이 5.2.1 이상이라면 PHP에도 JSON이 기본으로 내장돼있다. 이 경우에 사용하는 함수는 세 가지다.

> <ul class="chunklist chunklist_book chunklist_children">
>   <li>
>     <a href="http://kr.php.net/manual/en/function.json-decode.php">json_decode</a> — JSON 문자열을 PHP 배열로 바꾼다.
>   </li>
>   <li>
>     <a href="http://kr.php.net/manual/en/function.json-encode.php">json_encode</a> — PHP 배열을 JSON 문자열로 바꾼다.
>   </li>
>   <li>
>     <a href="http://kr.php.net/manual/en/function.json-last-error.php">json_last_error</a> — 마지막으로 일어난 에러를 반환한다.
>   </li>
> </ul>
> 
> <p style="text-align: right;">
>   - <a href="http://kr.php.net/json" target="_blank">PHP.net JSON 매뉴얼 중</a>
> </p>

## PHP 버전 : 5.2.1 미만 4.3 이상

PHP 버전이 5.2.1 미만이고 4.3 이상이라면(혹시 몰라 하는 얘긴데, 자기 php 버전은 phpinfo() 하나만 써주면 나온다.) JSON 라이브러리를 가져와야 한다. 4.3보다 낮으면 아예 지원 안 되는 것 같다. 그런데 요즘 누가 4.3 미만 버전을 쓸까. 걱정할 것 없을 듯.

JSON을 PHP에 설치하는 방법도 있는 것 같은데, 호스팅 업체를 이용하는 경우라면 설치해달라고 전화해야 하고 복잡할 수 있겠다.(사실 이거 설친지 뭔지 잘 알지는 못하겠다. 맨 아래 있는 링크에 들어가보면 설치하는 방법이 있길래 하는 소리다.)

JSON 홈페이지는 json.org인데 여기 가면 난감하다. json 로직을 설명하고 있고, 언어별로 엄청 다양한 라이브러리를 링크해놨는데 그야말로 눈 돌아간다. 여기서 또 PHP용 JSON 라이브러리를 찾느라 애먹었다.

PHP JSON 라이브러리(JSON.php)는 <a href="http://pear.php.net/package/Services_JSON/download/" target="_blank">Package Information: Services_JSON</a>을 다운받으면 된다.

JSON.php 파일에는 Services_JSON 클래스가 있다. 다음 예제처럼 사용하면 된다.

<pre class="brush: php;">require &#039;JSON.php&#039;;

// create a new instance of Services_JSON
$json = new Services_JSON();

// convert a complexe value to JSON notation, and send it to the browser
$value = array(&#039;foo&#039;, &#039;bar&#039;, array(1, 2, &#039;baz&#039;), array(3, array(4)));
$output = $json-&gt;encode($value);

print($output);
// prints: ["foo","bar",[1,2,"baz"],[3,[4]]]

// accept incoming POST data, assumed to be in JSON notation
$input = file_get_contents(&#039;php://input&#039;, 1000000);
$value = $json-&gt;decode($input);</pre>

일단 Services_JSON 객체를 $json이란 이름으로 생성하고, 함수를 호출해서 사용하는 것이다.

배열 안에 배열을 저장하는 형태로 PHP 배열을 만들고, $json->encode($array) 함수를 사용하면 된다.

## JavaScript를 사용할 때 주의할 점

보통은 Ajax를 사용할 때 JSON을 사용할 것으로 생각된다. 그렇다면, 일단 문자열을 JSON 객체로 만들어서 사용할 텐데, myJsonObject를 JSON 객체라고 치자. 내용을 호출하려면 다음과 같은 방식이 돼야 할 것이다.

<pre class="brush: javascript; gutter: true; first-line: 1">myJsonObject.Child[0].name</pre>

여기서 강조하고 싶은 것은, Child가 여러 개일 경우에는 배열이고, 따라서 당연히 배열을 호출해야 한다는 것이다. 이걸 까먹을 때가 많아서 굳이 적었다.

예컨대 다음과 같은 JSON 문자열을 JSON 객체로 만들었다고 치자.

<pre class="brush: jscript;">var people =
  { "programmers": [
    { "firstName": "Brett", "lastName":"McLaughlin", "email": "brett@newInstance.com" },
    { "firstName": "Jason", "lastName":"Hunter", "email": "jason@servlets.com" },
    { "firstName": "Elliotte", "lastName":"Harold", "email": "elharo@macfaq.com" }
   ],
  "authors": [
    { "firstName": "Isaac", "lastName": "Asimov", "genre": "science fiction" },
    { "firstName": "Tad", "lastName": "Williams", "genre": "fantasy" },
    { "firstName": "Frank", "lastName": "Peretti", "genre": "christian fiction" }
   ],
  "musicians": [
    { "firstName": "Eric", "lastName": "Clapton", "instrument": "guitar" },
    { "firstName": "Sergei", "lastName": "Rachmaninoff", "instrument": "piano" }
   ]
  }</pre>

그렇다면 이런 식으로 호출해야 하는 것이다.

<pre class="brush: jscript;">people.programmers[0].lastName;
people.authors[1].genre			// Value is "fantasy"
people.musicians[3].lastName		// Undefined. This refers to the fourth entry, and there isn&#039;t one
people.programmers.[2].firstName	// Value is "Elliotte"</pre>

## ajax에서 JSON 문자열을 받았을 때 JSON 객체로 만드는 명령어

이건 쉽게 구할 수 있겠지만 보관 차원에서 적어 둔다.

<pre class="brush: jscript;highlight: [8]; ">function callback(){
	//readystate 요청 상태 -- 4 : complete
	if(xmlHttp.readyState == 4){
	//서버의 응답 상태 : 200 : ok
		if(xmlHttp.status == 200){
		// responseText -- 서버에서 응답한 데이터.
			var jsonData=xmlHttp.responseText;
			var myJSONObject=e v a l(&#039;(&#039;+jsonData+&#039;)&#039;);
		}
	}
}</pre>

8번 라인이 중요한데, JSON 문자열인 jsonData를 eval 함수를 이용해 가공한다. 자꾸 보안 문제를 일으킬 수 있다고 해서 `e v a l` 이라고 띄워서 썼다. 실제 코드로 사용할 때는 붙여 사용하면 된다.

## EUC-KR PHP JSON 한글 처리

JSON은 무조건 UTF-8이어야 한다. 그런데 한글 인코딩이 EUC-KR이라면 피곤하다. 이럴 때 사용할 수 있는 방법으로 누군가 urlencode(), urldecode() 함수로 처리하는 방법을 적어뒀길래 링크한다.

<p style="text-align: center;">
  PHP 에서 JSON 사용하기(지금은 글이 사라졌다.)
</p>

이 분 코드는 다음과 같다.

<pre class="brush: php;">$val = array(urlencode("에혀~"), "1", 23);
$output = json_encode($val);
echo urldecode($output)."\n";

//결과
//["에혀~","1",23]</pre>