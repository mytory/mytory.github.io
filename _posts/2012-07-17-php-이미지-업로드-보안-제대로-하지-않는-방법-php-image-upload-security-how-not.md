---
title: '[번역] PHP 이미지 업로드 보안: 제대로 하지 않는 방법'
author: 안형우
layout: post
permalink: /archives/3011
tags:
  - PHP
---
[이 글의 제목을 직역하면 'PHP 이미지 업로드 보안: 제대로 하지 않는 방법'이다. 본문에서 보안을 제대로 하지 않는 방법들을 비판하고 자신의 노하우를 제시하는데, 그래서 제목을 풍자적으로 붙인 모양이다. 원문은 [PHP Image Upload Security: How Not to Do It][1] 이다. - 형우]

게임에 대한 이야기는 잠깐 멈추고, 웹 개발 세계로 짧은 여행을 가 보자.

나는 PHP로 일을 좀 해 왔고, 파일 업로드 보안에 대해 말해 보고 싶다.

파일 업로드는 웹 개발자에게 좀 겁나는 일이다. 누군지도 모를 이들이 아무 파일이나 원하는대로 당신의 소중한 웹서버에 올리도록 허용하는 것이기 때문이다. 이 글에서 나는 오직 이미지 업로드와, 사용자가 당신에게 전달하는 것이 실제 이미지인지 확실히 하는 방법에 대해서만 다룰 것이다.

## Part I: `$_FILES["file"]["type"]`이라는 악마

몇 번이고, (내가 청년기 때 작성한 코드를 포함해서) 나는 이런 비슷한 코드를 봤다.

~~~ php
$valid_mime_types = array(
  "image/gif",
  "image/png",
  "image/jpeg",
  "image/pjpeg",
);

// 업로드된 파일이 실제 이미지인지 체크한다.
// 이미지가 맞으면 올바른 폴더로 옮긴다.
if (in_array($_FILES["file"]["type"], $valid_mime_types)) {
  $destination = "uploads/" . $_FILES["file"]["name"];
  move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
}
~~~

위 코드조각은 이미지인지 검사하기 위해서 업로드된 파일의 마임타입을 검사한다. 그리고 나서 통과되면 적합한 위치로 파일을 옮긴다. 그러면 뭐가 문제일까? 음... [파일 업로드 제어][2]에 관한 문서를 읽었다면, `$_FILES["file"]["type"]`에 대해 하는 말에 주의를 기울여라.

> 이 값은 클라이언트 쪽에서 완전히 제어 가능하다. PHP 쪽에서 검사하는 값이 아니다.

웹 보안에서 첫 번째 규칙은 사용자가 전송한 데이터를 절대로 믿지 말라는 것이다. 클라이언트가 이미지라고 말한다고 해서 파일을 서버에 허용하는 것은, 아무것도 훔치지 않겠다고 말한다고 해서 낯선 사람에게 집 열쇠를 맡기는 것과 같은 짓이다. 여기 그런 취약점을 이용한 간단한 스크립트 예제가 있다.

~~~ php
// The destination for our attack:
$host = "127.0.0.1";
$port = 8887;
$page = "/server.php";
 
// Here we have the file we're uploading (note the content-type):
$payload =
"------ThisIsABoundary
Content-Disposition: form-data; name="file"; filename="evil.php"
Content-Type: image/jpeg
 
<?php phpinfo();
------ThisIsABoundary--";
 
// Finally, craft the request and send it.
$content_length = strlen($payload);
$headers = array(
    "POST {$page} HTTP/1.1",
    "Host: {$host}:{$port}",
    "Connection: close",
    "Content-Length: {$content_length}",
    "User-Agent: Evil Robot",
    "Content-Type: multipart/form-data; boundary=----ThisIsABoundary",
);
 
$request = implode("rn", $headers) . "rnrn" . $payload . "rn";
 
$fp = fsockopen($host, $port, $errno, $errstr)
      or die("ERROR: $errno - $errstr");
fwrite($fp, $request);
~~~

위 스크립트는 `evil.php` 파일을 업로드하도록 하는 표준 HTTP 요청이다. 만약 서버가 업로드 검증을 위해 `$_FILES["file"]["type"]`에 의존한다면 우리가 이미지를 전송받았다는 착각을 하게 될 것이다.

## Part II: 아파치 `mod_mime` 모듈과 다중 파일 확장자

그래, 그러면 해결책은 뭘까? 어떤 사람들은 확장자를 체크한다. 서버가 파일 확장자를 기반으로 적합한 핸들러와 콘텐츠 유형을 결정할 것이기 때문이다. 이런 코드는 대부분의 경우 잘 작동한다.

~~~ php
$valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png");

$file_extension = strrchr($_FILES["file"]["name"], ".");

// 올라온 파일이 실제로 이미지인지 체크한다.
// 만약 이미지라면 저장 폴더로 옮긴다.
if (in_array($file_extension, $valid_file_extensions)) {
  $destination = "uploads/" . $_FILES["file"]["name"];
  move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
}
~~~

이렇게 하면 서버 설정에 따라서는 안전할 수도 있다. 이걸 알아야 하는데, 아파치는 [같은 파일에 대해 다중 파일 확장자][3]를 설정하도록 할 수 있다. [다중 파일 확장자 기능은 `welcome.html.en`, `welcome.html.ko` 하는 식으로 확장자를 두 개 연달아 붙여서 주로 언어 유형과 마임타입을 아파치가 동시에 인지할 수 있도록 하는 기능이다. 주의할 점도 있는데, `world.php.html` 식으로 사용하면 php 핸들러가 이 파일을 해석하고, 마임타입은 text/html이 된다. - 형우] 이 기능은 파일명으로 다국어와 콘텐트 유형을 한 번에 파악하게 하는 데 유용할지 몰라도, 이 기능을 모르는 개발자를 보안 취약점에 노출시킨다.

다중 파일 확장자 취약점을 이용하는 데는 별 기술이 필요한 게 아니다. 아무 PHP 파일이나 골라서 이름 끝에 끝에 .jpg를 추가한 다음 취약한 서버에 업로드해 봐라. 그리고 브라우저로 그 파일을 열어 보는 거다. 이러면 아파치가 스크립트를 돌리고 그 결과가 나타난다. 식은 죽 먹기다.

## Part III: 이미지로 위장한 스크립트

조작된 마임타입과 추가 파일 확장자에 주의를 기울이는 사람들은 종종 `getimagesize()` 같은 것을 사용해서 업로드된 파일이 실제로 이미지 파일인지 확인한다.

~~~ php
if (@getimagesize($_FILES["file"]["tmp_name"]) !== false) {
  $destination = "uploads/" . $_FILES["file"]["name"];
  move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
}
~~~

확실히, 이미지는 해로울 수 없나? 내 말은, 이 아기 고양이를 보라는 거다 :

<p style="text-align: center;">
  <a href="http://nullcandy.com/demo/kittens/kitten.jpg.php" target="_blank"><img class="aligncenter" alt="" src="http://nullcandy.com/demo/kittens/kitten.jpg" width="188" height="250" /></a>
</p>

저 아기 고양이는 누구도 해칠 수 없다, 그치? 화이트햇 해커 아기 고양이를 만난 걸 다행으로 여겨라. [화이트햇(하얀 모자) 해커는 블랙햇(검은 모자) 해커에 대비되는 말이다. 공익 혹은 학업 목적으로 해킹을 하며 방어 전략을 구축하는 사람을 말한다. - 형우]

이제 그림을 클릭하고 무슨 일이 벌어지는지 보자. (새 창에서 열린다.)  똑같은 아기 고양이가 나와야 할 거다. 하지만 이번엔, 내가 그걸 PHP 스크립트로 돌리고 있다. 이걸 하기 위해 나는 멋진 jhead tool을 사용했다. 그리고 나는 원본 아기 고양이 그림 안에 메시지를 내장했다. 내 메시지는 이렇게 보일 거다 :

~~~ php
<?php blahblahblah(); __halt_compiler();
~~~

`__halt_compiler()` 함수를 저 위치에서 호출함으로써, PHP가 이미지 데이터를 해석하고 파싱 에러를 출력하는 사고가 발생하지 않도록 한다. 이게 실제 이미지 데이터가 출력되기 전에 출력이 멈추는 이유다. 내가 실제로 쓴 걸 보고 싶다면, 새끼 고양이 이미지를 다운로드(마우스 우클릭 후, 다른 이름으로 저장을 선택)해서, 즐겨 쓰는 텍스트 에디터로 열어 보면 된다.

## Part IV: 끝

위에 있는 보안 검사는 확실히 쓸모없는 건 아니다. 업로드된 게 확실히 이미지이길 바란다면, 그게 확실히 이미지인지 검사하는 건 좋은 일이다. 보안을 위해 여러 단계를 두는 건 늘 좋은 일이다. 하지만 우리 방어막을 뚫고 몰래 들어올 수 있는 PHP 스크립트는 어떻게 해야 할까?

우리 목표는 단지 업로드된 파일이 이미지인지 확인하는 것만이 아니다. 서버가 어떤 스크립트 핸들러도 실행하지 않도록 하는 것이다. 내가 즐겨 쓰는 방법은 아파치의 [`ForceType`](http://httpd.apache.org/docs/2.0/mod/core.html#forcetype) 지시자다.

~~~
ForceType application/octet-stream

<FilesMatch "(?i)\.jpe?g$">
    ForceType image/jpeg
</FilesMatch>

<FilesMatch "(?i)\.gif$">
    ForceType image/gif
</FilesMatch>

<FilesMatch "(?i)\.png$">
    ForceType image/png
</FilesMatch>
~~~

이 코드를 업로드 디렉토리의 `.htaccess` 파일 안에 넣어라. 그러면 이미지를 자신의 기본 핸들러하고만 연관되도록 할 것이다. 다른 모든 것들은 바이트 스트림으로만 해석되고, 어떤 핸들러도 실행되지 않을 것이다.

나는 더 나아가 “PHP 끄기(turn PHP off)” 해법(`php_flag engine off`)을 사용한다. 서버에 perl, python 등을 돌리고 있는 경우에 그렇게 하면 **모든** 스크립트 핸들러를 한 방에 끌 수 있다. 물론, 안전을 위해 두 방법을 다 사용할 수도 있다.

더 나은 해법은 파일을 웹 디렉토리 바깥에 둬서 파일이 전혀 해석되지 않게 하는 것이다. 그러면 파일을 요청 받아서, 연관된 파일을 파일시스템에서 찾고, 올바른 헤더와 함께 출력해 줄 수 있는 스크립트를 짜야 한다. 물론 사용자 입력을 기반으로 파일을 내보내는 것은 그것 자체의 보안 취약점이 존재하지만, 그것은 또 다른 이야기다.

마지막으로 중요한 것 하나만 더 말하자면, 항상 업로드된 파일의 이름을 변경해야 한다는 것이다. 파일명을 무작위로 하면 공격자가 우리를 농락하기 훨씬 더 힘들어지고, `.htaccess`나 `.user.ini` 파일을 덮어쓸 필요가 없어진다. `.htaccess`나 `.user.ini` 파일을 덮어쓰는 건 별로 좋은 일이 아니다.

웹에는 보안에 관해 많은 자료들이 있다. 만약 자료를 더 보고 싶다면 [<abbr title="The Open Web Application Security Project">OWASP</abbr>](https://www.owasp.org/index.php/Main_Page)를 살펴 봐라. [OWASP Cheat Sheet 페이지](https://www.owasp.org/index.php/Cheat_Sheets)를 곧장 살펴 보는 것도 좋다.

 [1]: http://nullcandy.com/php-image-upload-security-how-not-to-do-it/
 [2]: http://www.php.net/manual/en/features.file-upload.post-method.php
 [3]: http://httpd.apache.org/docs/2.0/mod/mod_mime.html#multipleext