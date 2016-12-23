---
title: '[번역] PHP 이미지 업로드 보안: 제대로 하지 않는 방법 PHP Image Upload Security: How Not to Do It'
author: 안형우
layout: post
permalink: /archives/3011
aktt_notify_twitter:
  - no
daumview_id:
  - 36576947
categories:
  - 서버단
tags:
  - PHP
---
[이 글의 제목을 직역하면 'PHP 이미지 업로드 보안: 제대로 하지 않는 방법'이다. 본문에서 보안을 제대로 하지 않는 방법들을 비판하고 자신의 노하우를 제시하는데, 그래서 제목을 풍자적으로 붙인 모양이다. 원문은 [PHP Image Upload Security: How Not to Do It][1] 이다. - 형우]

게임 이야기를 하면서 잠깐 쉬었다가 가자. 웹 개발 세계로 가는 짧은 여행에 관한 게임이다. \[이미지가 업로드되는 과정을 웹 개발 세계로 가는 짧은 여행이라고 비유한 것 같다 - 형우\] (Let’s take a break from talking about games for a brief journey into the world of web development.)

나는 PHP로 일을 좀 해 왔다. 그리고 나는 파일 업로드 보안에 대해 말해 보고 싶다.

파일 업로드는 웹 개발자에게 좀 겁나는 일이다. 누군지도 모를 이들이 아무 파일이나 원하는대로 당신의 소중한 웹서버에 올리도록 허용하는 것이기 때문이다. 이 글에서 나는 오직 이미지 업로드와, 사용자가 당신에게 전달하는 것이 실제 이미지인지 확실히 하는 방법에 대해서만 다룰 것이다.

## Part I: The Evil `$_FILES["file"]["type"]`

몇 번이고, (내가 청년기 때 작성한 코드를 포함해서) 나는 이런 비슷한 코드를 봤다.

<pre class="brush: php; gutter: true; first-line: 1">$valid_mime_types = array(
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
}</pre>

위 코드조각은 이미지인지 검사하기 위해서 업로드된 파일의 마임 타입을 검사한다. 그리고 나서 통과되면 적합한 위치로 파일을 옮긴다. 그러면 뭐가 문제일까? 물론, [파일 업로드 제어][2]에 관한 문서를 읽었다면, `$_FILES["file"]["type"]`에 대한 주의사항을 신경써서 보라. (pay attention to what it has to say about `$_FILES["file"]["type"]`)

> 이 값은 완전히, 클라이언트가 제어 가능하다. PHP 쪽에서 검증할 수 있는 값이 아니다.

웹 보안에서 첫 번째 규칙은 사용자가 전송한 데이터를 절대로 믿지 말라는 것이다. 클라이언트가 이미지라고 말한다고 해서 파일을 서버에 허용하는 것은, 아무것도 훔치지 않겠다고 말한다고 해서 낯선 사람에게 집 열쇠를 맡기는 것과 같은 짓이다. 여기 그런 취약점을 이용한 간단한 스크립트 예제가 있다.

<pre class="brush: php; gutter: true; first-line: 1">// 공격 목표
$host = "127.0.0.1";
$port = 8887;
$page = "/server.php";

// 우리가 업로드할 파일 (content-type에 주목하라) :
$payload =
"------ThisIsABoundary
Content-Disposition: form-data; name=\"file\"; filename=\"evil.php\"
Content-Type: image/jpeg</pre>

위 스크립트는 evil.php 파일을 업로드하도록 하는 표준 HTTP 요청이다. 만약 서버가 업로드 검증을 위해 `$_FILES["file"]["type"]`에 의존한다면 우리가 이미지를 전송받았다는 착각을 하게 될 것이다.

## Part II: 아파치 mod\_mime 모듈과 다중 파일 확장자 기능 (The mod\_mime Apache Module and Multiple File Extensions)

그래, 그러면 해결책은 뭘까? 어떤 사람들은 확장자를 체크한다. 서버가 파일 확장자를 기반으로 적합한 핸들러와 콘텐츠 종류는 결정할 것이기 때문이다. 이런 코드는 대부분의 경우 잘 작동한다.

<pre class="brush: php; gutter: true; first-line: 1">$valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png");

$file_extension = strrchr($_FILES["file"]["name"], ".");

// 올라온 파일이 실제로 이미지인지 체크한다.
// 만약 이미지라면 저장 폴더로 옮긴다.
if (in_array($file_extension, $valid_file_extensions)) {
  $destination = "uploads/" . $_FILES["file"]["name"];
  move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
}</pre>

이렇게 하면 서버 설정에 따라서는 안전할 수도 있다. 이걸 알아야 하는데, 아파치는 [같은 파일에 대해 다중 파일 확장자][3]를 설정하도록 할 수 있다. [이 기능이 뭔지를 알아야 잘 해석할 수 있을 것 같은데, 아마 확장자를 두 개 붙여서 두 개의 파일 형식으로 아파치가 이해할 수 있게 하는 기능인가 보다. - 형우] 이 기능은 언어와 내용 형식을 한 번에 판단하도록 하는 파일 이름을 허용하는 데는 유용할 수도 있지만, 이 기능을 인지하지 못하는 개발자에게 보안 취약점이 된다. (Apache can be configured to interpret [multiple file extensions for the same file.][3] While it might be useful for allowing a filename to determine both language and content type at once, it also presents a security vulnerability to developers who are unaware of this feature.)

다중 파일 확장자 취약점을 이용하는 데는 별 기술이 필요한 게 아니다. 아무 PHP 파일이나 골라서 이름 끝에 끝에 .jpg를 추가한 다음 취약한 서버에 업로드해 봐라. 그리고 브라우저로 그 파일을 열어 보는 거다. 이러면 아파치가 스크립트를 돌리고 그 결과가 나타난다. 식은 죽 먹기다.

## Part III: 이미지로 위장한 스크립트

조작된 마임타입과 추가 파일 확장자에 주의를 기울이는 사람들은 종종 getimagesize() 같은 것을 사용해서 업로드된 파일이 실제로 이미지 파일인지 확인한다.

<pre class="brush: php; gutter: true; first-line: 1">if (@getimagesize($_FILES["file"]["tmp_name"]) !== false) {
  $destination = "uploads/" . $_FILES["file"]["name"];
  move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
}</pre>

설마, 이미지는 위험하지 않을 거라고 생각하나? 내 말은, 이 새끼 고양이를 보라는 거다 :

<p style="text-align: center;">
  <a href="http://nullcandy.com/demo/kittens/kitten.jpg.php" target="_blank"><img class="aligncenter" alt="" src="http://nullcandy.com/demo/kittens/kitten.jpg" width="188" height="250" /></a>
</p>

저 새끼고양이는 누구도 해칠 수 없다. 물론이다. 늘 하얀 새끼고양이만 만날 수 있길 바란다. (Surely, an image can’t be harmful? I mean, look at this kitten: That kitten could never hurt anyone, right? Just count yourself lucky that it’s a white hat kitten.)

이제 그림을 클릭하고 무슨 일이 벌어지는지 보자. (새 창에서 열린다.)  똑같은 새끼고양이가 나와야 할 거다. 하지만 이번엔, 내가 그걸 PHP 스크립트로 돌리고 있다. 이걸 하기 위해 나는 멋진 jhead tool을 사용했다. 그리고 나는 원본 새끼 고양이 그림 안에 메시지를 내장했다. 내 메시지는 이렇게 보일 거다 :

<pre class="brush: php; gutter: true; first-line: 1">&lt;?php blahblahblah(); __halt_compiler();</pre>

`__halt_compiler()` 함수를 저 위치에서 호출함으로써, PHP가 이미지 데이터를 해석하고 파싱 에러를 출력하는 사고가 발생하지 않도록 한다. 이게 실제 이미지 데이터가 출력되기 전에 출력이 멈추는 이유다. 내가 실제로 쓴 걸 보고 싶다면, 새끼 고양이 이미지를 다운로드(마우스 우클릭 후, 다른 이름으로 저장을 선택)해서, 주로 사용하는 텍스트 에디터로 열어 보면 된다.

## Part IV: 끝

위에 있는 보안 검사는 확실히 쓸모없는 건 아니다. 업로드된 게 확실히 이미지이길 바란다면, 그게 확실히 이미지인지 검사하는 건 좋은 일이다. 보안을 위해 여러 단계를 두는 건 늘 좋은 일이다. 하지만 우리 방어막을 뚫고 몰래 들어올 수 있는 PHP 스크립트는 어떻게 해야 할까?

우리 목표는 단지 업로드된 파일이 이미지인지 확인하는 것만이 아니다. 서버가 어떤 스크립트 핸들러도 실행하지 않도록 하는 것이다. 내가 즐겨 쓰는 방법은 아파치의 <a href="http://httpd.apache.org/docs/2.0/mod/core.html#forcetype" target="_blank"><code>ForceType</code></a> directive 다.

<pre class="brush: xml; title: ; notranslate">ForceType application/octet-stream

&lt;FilesMatch "(?i)\.jpe?g$"&gt;
    ForceType image/jpeg
&lt;/FilesMatch&gt;

&lt;FilesMatch "(?i)\.gif$"&gt;
    ForceType image/gif
&lt;/FilesMatch&gt;

&lt;FilesMatch "(?i)\.png$"&gt;
    ForceType image/png
&lt;/FilesMatch&gt;</pre>

이 코드를 업로드 디렉토리의 `.htaccess` 파일 안에 넣어라. 그러면 이미지를 자신의 기본 핸들러하고만 연관되도록 할 것이다. [이미지 확장자가 붙은 놈은 이미지로만 인식한다는 뜻이다. - 형우] 다른 모든 것들이 바이트 스트림으로만 해석되고, 핸들러는 실행되지 않을 것이다. (Everything else will be served as a plain byte stream and no handlers will be run.)

나는 더 나아가 &#8220;turn PHP off&#8221; 해법(`php_flag engine off`)을 사용한다. 서버에 perl, python 등을 돌리고 있는 경우에 그렇게 하면 **모든** 스크립트 핸들러를 한 방에 끌 수 있다. 물론, 안전을 위해 두 방법을 다 사용할 수도 있다.

더 나은 해법은 파일을 웹 디렉토리 바깥에 둬서 파일이 전혀 해석되지 않게 하는 것이다. 그러면 파일을 요청 받아서, 연관된 파일을 파일시스템에서 찾고, 올바른 헤더와 함께 출력해 줄 수 있는 스크립트를 짜야 한다. 물론 사용자 입력[요청]을 기반으로 파일을 내보내는 것은 그것 자체의 보안 취약점이 존재하지만, 그것은 또 다른 이야기다. [파일 다운로드 스크립트로 파일을 다운받게 하는 건 URL 조작 등의 공격을 당할 수 있다. - 형우]

마지막으로 중요한 거 하나만 더 말하자면, 항상 업로드된 파일의 이름을 변경해야 한다는 것이다. 공격자가 우릴 농락하기 힘들어지도록 이름을 무작위로 골라야 한다. 그리고 `.htaccess` 나 `.user.ini` 파일을 아무도 덮어쓸 수 없도록 해야 한다. (neither of which be a good thing 이 뒤에 붙어 있는데 뭔 말인지 모르겠음 &#8211; 형우)

웹에는 보안에 관해 많은 자료들이 있다. 만약 자료를 더 보고 싶다면 <a href="https://www.owasp.org/index.php/Main_Page" target="_blank"><abbr title="The Open Web Application Security Project">OWASP</abbr></a>를 살펴 봐라. <a href="https://www.owasp.org/index.php/Cheat_Sheets" target="_blank">OWASP Cheat Sheet 페이지</a>를 곧장 살펴 보는 것도 좋다.

 [1]: http://nullcandy.com/php-image-upload-security-how-not-to-do-it/
 [2]: http://www.php.net/manual/en/features.file-upload.post-method.php
 [3]: http://httpd.apache.org/docs/2.0/mod/mod_mime.html#multipleext