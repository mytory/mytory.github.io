---
title: PHP에서 JSON 사용하기
author: 안형우
layout: post
permalink: /archives/40
tags:
  - PHP
---

json을 처음 공부하려는 사람이라면, 일단 도움이 되는 기술 문서를 정독하라.

*    [Ajax 마스터하기, Part 10: 데이터 전송에 JSON 사용하기][ajax10]
*    [Ajax 마스터하기, Part 11: 서버 측의 JSON][ajax11]

[ajax10]: http://cafe.daum.net/withJava/2EHZ/27
[ajax11]: http://cafe.daum.net/withJava/2EHZ/28

위의 두 기술문서는 IBM에 있는 자료인데, JSON의 개념을 정말 쉽게 잘 써놨다. [2016-12-30: 원본글이 사라졌다. 찾을 수 없었는데, 다음 카페에 퍼놓은 글을 찾을 수 있었다. 펌글이 반가울 때도 있다니. 지금은 json이 그리 복잡한 것이 아니라는 것을 알고 있으며 좀더 간단하게 설명할 방법이 있지 않을까 싶지만, 이건 내가 초보중에도 왕초보인 시절에 참고했던 자료라 지금 초보인 분들에게 도움이 될까 싶어서 그대로 링크를 살려 둔다. 글 자체는 초보 입장에서 이해하기 쉽게 잘 씌어 있다.]

## PHP에서 JSON 사용하기 준비물

일단 준비물. js 라이브러리는 필요 없다. **JSON은 자바스크립트에 기본으로 내장돼있다.** JSON이란 말 자체가 '자바스크립트 객체 표기법(JavaScript Object Notation)'의 약어다. js 배열과 객체를 다뤄 봤다면 JSON을 다루기 위한 기본은 돼 있는 것이다.

> JSON은 네이티브 JavaScript 포맷이고, JavaScript 내에서 JSON 데이터와 작업하기 위해 특별한 API나 툴킷이 필요 없다.  
> ― [Ajax 마스터하기, Part 10: 데이터 전송에 JSON 사용하기][ajax10] 중

이걸 강조해 둔 이유는 내가 js 라이브러리를 찾느라 시간을 꽤 허비했기 때문이다;;

## PHP 버전 : 5.2 이상

PHP 버전이 5.2 이상이라면 PHP에도 JSON 파서가 기본으로 내장돼있다. 이 경우에 사용하는 함수는 세 가지다.

> - [`json_decode`](http://php.net/manual/kr/function.json-decode.php) — JSON 문자열을 PHP 배열로 바꾼다.
> - [`json_encode`](http://php.net/manual/kr/function.json-encode.php) — PHP 배열을 JSON 문자열로 바꾼다.
> - [`json_last_error`](http://php.net/manual/kr/function.json-last-error.php) — 마지막으로 일어난 에러 코드를 반환한다.
> - [`json_last_error_msg`](http://php.net/manual/kr/function.json-last-error-msg.php) — 마지막으로 일어난 에러 메시지를 반환한다.
>
> [PHP.net JSON 매뉴얼](http://php.net/manual/kr/book.json.php) 중

아래처럼 사용하면 된다.

### JSON 문자열로 PHP 객체나 배열 만들기

    // === parse json string ===
    $json_string = '{ "programmers": [
            { "firstName": "Brett", "lastName":"McLaughlin", "email": "brett@newInstance.com" },
            { "firstName": "Jason", "lastName":"Hunter", "email": "jason@servlets.com" }
        ],
        "authors": [
            { "firstName": "Isaac", "lastName": "Asimov", "genre": "science fiction" },
            { "firstName": "Frank", "lastName": "Peretti", "genre": "christian fiction" }
        ] }';

    // parse to php object
    $data_object = json_decode($json_string);

    // parse to php array
    $data_array = json_decode($json_string, true);

    // echo
    var_dump($data_object);
    var_dump($data_array);

    // handle error
    if (json_last_error() > 0) {
        echo json_last_error_msg() . PHP_EOL;
    }

### PHP 객체나 배열로 JSON 문자열 만들기

    // === php array to json ===
    $my_array = array (
    'programmers' => 
    array (
        array (
        'firstName' => 'Brett',
        'lastName' => 'McLaughlin',
        'email' => 'brett@newInstance.com',
        ),
        array (
        'firstName' => 'Jason',
        'lastName' => 'Hunter',
        'email' => 'jason@servlets.com',
        ),
    ),
    'authors' => 
    array (
        array (
        'firstName' => 'Isaac',
        'lastName' => 'Asimov',
        'genre' => 'science fiction',
        ),
        array (
        'firstName' => 'Frank',
        'lastName' => 'Peretti',
        'genre' => 'christian fiction',
        ),
    ),
    );

    $my_object = (object) $my_array;

    // encode php array to json string
    $my_array_json_string = json_encode($my_array);
    $my_object_json_string = json_encode($my_object);

    // echo. 결과는 같다.
    var_dump($my_array_json_string);
    var_dump($my_object_json_string);

    // handle error
    if (json_last_error() > 0) {
        echo json_last_error_msg() . PHP_EOL;
    }

## PHP 버전 : 5.2 미만 4.3 이상

PHP 버전이 5.2 미만 4.3 이상이고[^version] JSON 확장이 설치돼 있지 않다면 설치를 하거나 라이브러리를 사용해야 한다. 4.3보다 낮으면 아예 지원 안 되는 것 같다.

[^version]: 혹시 몰라 하는 얘긴데, 자기 php 버전은 `phpinfo();` 함수를 실행하거나 커맨드라인에서 `php -v`라고 치면 나온다.

나는 JSON 라이브러리를 찾으러 [json.org](http://json.org/json-ko.html)에 들어갔었는데... 데이터 포맷을 설명하고 있는 곳이라 난감했다. json 로직을 설명하고 있고, 언어별로 엄청 다양한 라이브러리를 링크해놨는데 그야말로 눈 돌아간다. 이곳은 JSON이라는 포맷 자체에 관심이 있는 경우에 들어가자.

PHP 버전이 5.2보다도 낮고, JSON도 설치돼 있지 않은 황당한 경우라면, 다음 두 가지 방법을 사용한다.

- pecl[^pear]을 이용해 json 확장을 설치한다. 호스팅 업체를 이용하는 경우라면 설치해달라고 전화하자.
- pear에도 PHP JSON 라이브러리가 있다. [Services_JSON][pear-json]을 다운받으면 된다.

[pear-json]: http://pear.php.net/package/Services_JSON/download/

[^pear]: 모던(modern) PHP에서는 패키지 관리자로 composer를 사용하지만, 이전에는 pear와 pecl이 대표적인 패키지 관리자였다. 패키지 관리자라는 게 뭐냐면... PHP의 각종 확장과 라이브러리를 다운 받아서 설치하기 쉽게 해 주는 프로그램이라고 생각하면 된다. 대충 앱스토어라고 생각해도 되고, 리눅스를 써 봤다면 `apt-get`이나 `yum`, `zypper` 같은 것을 떠올리면 된다. 당연한 말이지만 GUI 인터페이스는 없고, 커맨드라인으로 실행한다. pecl은 C로 작성해 PHP 버전에 맞게 컴파일해야 하는 확장을 설치해 준다. pear는 PHP로 작성한, 다운받아 사용할 수 있는 패키지를 설치하게 해 준다. (모던 PHP의 패키지 관리자인 composer는 역시 PHP로 작성된 것들을 다운 받아 설치한다.)

버전이 4.3보다 낮으면 그냥 포기하든가... 다른 글을 찾아 보자. 난 4.3 미만에서의 해법은 찾지 않았다.

`JSON.php` 파일에는 Services_JSON 클래스가 있다. 다음 예제처럼 사용하면 된다.

    require 'JSON.php';

    // Services_JSON 인스턴스 생성
    $json = new Services_JSON();

    // 복잡한 값을 JSON 표기법으로 변환하고 브라우저로 보낸다
    $value = array('foo', 'bar', array(1, 2, 'baz'), array(3, array(4)));
    $output = $json->encode($value);

    print($output);
    // prints: ["foo","bar",[1,2,"baz"],[3,[4]]]

    // 들어오는 POST 데이터를 받는다. JSON 표기법으로 가정한다.
    $input = file_get_contents('php://input', 1000000);
    $value = $json->decode($input);

일단 `Services_JSON` 객체를 `$json`이란 이름으로 생성하고, 함수를 호출해서 사용하는 것이다.

PHP 배열을 만들고, `$json->encode($array)` 메서드를 사용하면 된다.


## js에서 json 파싱 후 객체 사용시 주의할 점.

ajax를 사용할 때 보통은 데이터 전송 포맷으로 JSON을 사용할 것이다. 그렇다면, 일단 문자열을 JSON 객체로 만들어서 사용할 텐데, `myJsonObject`를 JSON 객체라고 치자. js에서 내용을 호출하려면 다음과 같은 방식이 돼야 할 것이다. (물론 보통은 저렇게 복잡하게 사용할 일은 없을 것이다.)

    myJsonObject.Child[0].name

여기서 강조하고 싶은 것은, Child가 여러 개일 경우에는 배열이고, 따라서 당연히 배열을 호출해야 한다는 것이다. 이걸 까먹을 때가 많아서 굳이 적었다.

예컨대 다음과 같은 JSON 문자열을 JSON 객체로 만들었다고 치자.

    var people =
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
    }

그렇다면 이런 식으로 호출해야 하는 것이다.

    people.programmers[0].lastName;
    people.authors[1].genre            // 값은 "fantasy"
    people.musicians[3].lastName        // 값은 Undefined. 이것은 4번째 엔트리를 가리키며 거기엔 아무 것도 없다.
    people.programmers.[2].firstName    // 값은 "Elliotte"


## ajax에서 JSON 문자열을 받았을 때 JSON 객체로 만들기

사실 jQuery를 사용하면 알아서 서버 문자열을 JSON으로 파싱해 주니 이런 것까지 신경쓸 이유는 없을 것이다. 그러나 만약 JSON 문자열을 직접 다뤄야 하는 경우라면 유용하다.

### IE8 이상에선 `JSON.parse()` 사용

만약 `{"firstName": "Eric"}`이라는 JSON 형태의 문자열이 있다면, 이걸 js 쪽에서 객체로 변환하는 방법은 간단하다. 아래처럼 `JSON.parse()` 함수를 사용한다.

    var jsonData = JSON.parse('{"firstName": "Eric"}');
    
역으로 js 객체를 JSON 문자열로 변환할 때는 `JSON.stringify()` 함수를 사용한다.

    var jsonString = JSON.stringify(jsonData);
    
`jsonString`에는 `{"firstName":"Eric"}`이라는 문자열이 담긴다.

### IE7까진 `eval()` 사용

IE7까진 js에 `JSON` 객체가 없었다. 그냥 `eval()` 함수를 사용해 JSON 문자열을 js 객체로 변환해야 했다. 당연히 jQuery를 사용하면 아래와 같은 코드를 만날 일이 없다. jQuery 없이 ajax를 사용할 때 쓰는 함수다.

<pre>
function parseJSON(){
    //readystate 요청 상태 -- 4 : complete
    if (xmlHttp.readyState == 4) {
        //서버의 응답 상태 : 200 : ok
        if (xmlHttp.status == 200) {
            // responseText -- 서버에서 응답한 데이터.
            var jsonData = xmlHttp.responseText;
            <mark>var myJSONObject = eval('('+jsonData+')');</mark>
        }
    }
}
</pre>

8번 라인이 중요한데, JSON 문자열인 jsonData를 eval 함수를 이용해 가공한다.


## euc-kr PHP JSON 한글 처리

JSON은 무조건 UTF-8이어야 한다. 그런데 한글 인코딩이 euc-kr이라면 피곤하다. 이럴 때 사용할 수 있는 방법으로 누군가 `urlencode()`, `urldecode()` 함수로 처리하는 방법을 적어뒀길래 링크해 놨었는데 글이 사라졌다. ('PHP 에서 JSON 사용하기'라는 제목의 글이었다.)

이 분 코드는 다음과 같았다.

    $val = array(urlencode("에혀~"), "1", 23);
    $output = json_encode($val);
    echo urldecode($output)."\n";

    //결과
    //["에혀~","1",23]
