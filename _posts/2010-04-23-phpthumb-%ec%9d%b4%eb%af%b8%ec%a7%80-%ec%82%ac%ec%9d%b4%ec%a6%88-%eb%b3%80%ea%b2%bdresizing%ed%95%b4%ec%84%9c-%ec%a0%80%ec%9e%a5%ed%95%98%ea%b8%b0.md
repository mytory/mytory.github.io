---
title: '[phpThumb] 이미지 사이즈 변경(resizing)해서 저장하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/529
aktt_notify_twitter:
  - no
daumview_id:
  - 36964883
categories:
  - 서버단
tags:
  - PHP
  - phpThumb()
---
오늘 phpThumb를 이용해서 이미지를 리사이징한 후 저장하는 걸 만들었다.

생각보다 어려웠다 ㅡㅡ;;

하지만 결국 해냈다.

일단, 내가 사용한 phpThumb의 버전은 phpThumb() v1.7.9-200805132119 이다. 이 점을 알아 두는 게 좋을 것이다.

또한, 이 글을 이해하기 전에 phpThumb.php의 사용법을 먼저 익히는 것이 좋을 것이다. 그러려면 <a href="/?tag=phpthumb" target="_blank">내가 번역한 글들</a>을 보면 좋다. 물론, <a href="http://phpthumb.sourceforge.net/demo/demo/phpThumb.demo.demo.php" target="_blank">phpThumb 사이트의 데모</a>를 꼭 봐야 한다.

<a title="[번역:phpThumb] phpThumb FAQ(1)" href="http://mytory.net/archives/474" target="_blank">내가 번역한 faq(1)</a>의 뒤에서 두 번째 질문, &#8220;Q: 생성한 썸네일을 파일로 저장할 수 있나요?&#8221; 항목을 보면, 객체-오브젝트를 사용하라는 말이 나온다. 즉, phpThumb.class.php를 사용하라는 말이다.

php에서 객체를 사용하는 방법은 낯선 사람들이 좀 있을지 모르겠다. 나도 책보고 공부한 다음 혼자서 객체 활용해 게시판 짜보고 대충 이해갔다.

여튼 사용방법은 간단한데, java의 . 역할을 php에서는 -> 이놈이 한다.

자&#8230; 그리고 java에서는 pakage 선언만 해 주면 경로를 알아서 잘 잡지만 php는 그런 거 없다. class 파일을 include해야 한다. 물론 require해도 된다. include\_once를 사용하면 한 번만 인클루드하기 때문에 두 번 인클루드해서 오류나면 어쩌지 하는 공포에서 벗어날 수 있다. require\_once도 마찬가지다.

자&#8230; 그리하여 짠 코드를 소개한다.

일단 리사이즈 함수를 만들었다. 이 함수는 phpThumb.demo.object.simple.php 을 거의 그대로 갖다 쓴 것이다.

<pre class="brush:php ; gutter: true; first-line: 1; highlight: [24]">//phpThumbResizeFunction.php
function resizeImage($phpThumb, $source_file_name, $thumbnail_width, $output_filename){
	//$thumbnail_width = 100;

	// set data source -- do this first, any settings must be made AFTER this call
	if (is_uploaded_file($source_file_name)) {
		$phpThumb-&gt;setSourceFilename($source_file_name);

		echo "소스 파일 $source_file_name 세팅됐음.";

	} else {
		$phpThumb-&gt;setSourceData(file_get_contents($_SERVER[&#039;DOCUMENT_ROOT&#039;].&#039;/phpThumb/images/disk.jpg&#039;));

	}

	// PLEASE NOTE:
	// You must set any relevant config settings here. The phpThumb
	// object mode does NOT pull any settings from phpThumb.config.php

	//$phpThumb-&gt;setParameter(&#039;config_document_root&#039;, str_replace($_SERVER[&#039;PHP_SELF&#039;],&#039;&#039;,$_SERVER[&#039;SCRIPT_FILENAME&#039;]));
	//$phpThumb-&gt;setParameter(&#039;config_cache_directory&#039;, $phpThumb-&gt;getParameter(&#039;config_document_root&#039;).&#039;/Photo_thumbnail_cache&#039;);

	// set parameters (see "URL Parameters" in phpthumb.readme.txt)
	$phpThumb-&gt;setParameter(&#039;w&#039;, $thumbnail_width);
	//$phpThumb-&gt;setParameter(&#039;fltr&#039;, &#039;gam|1.2&#039;);
	//$phpThumb-&gt;setParameter(&#039;fltr&#039;, &#039;wmi|../watermark.jpg|C|75|20|20&#039;);

	// generate & output thumbnail
	if ($phpThumb-&gt;GenerateThumbnail()) { // this line is VERY important, do not remove it!
		if ($phpThumb-&gt;RenderToFile($output_filename)) {
			// do something on success
			echo &#039;Successfully rendered to "&#039;.$output_filename.&#039;"&#039;;
			return $output_filename;
		} else {
			// do something with debug/error messages
			echo &#039;error1&#039;;
			echo &#039;Failed:&lt;pre&gt;&#039;.implode("\n\n", $phpThumb-&gt;debugmessages).&#039;&lt;/pre&gt;&#039;;
		}
	} else {
		echo &#039;error2&#039;;
		// do something with debug/error messages
		echo &#039;Failed:&lt;pre&gt;&#039;.$phpThumb-&gt;fatalerror."\n\n".implode("\n\n", $phpThumb-&gt;debugmessages).&#039;&lt;/pre&gt;&#039;;
	}
}</pre>

위 함수에서는 너비만 지정해서 리사이즈했다. 하이라이트한 부분이 그 부분이다.(24번 줄) 24번 줄로 돌아가서 찾아 보기 귀찮은 사람은 아래 코드를 보면 된다.

<pre class="brush:php">// set parameters (see "URL Parameters" in phpthumb.readme.txt)
$phpThumb-&gt;setParameter(&#039;w&#039;, $thumbnail_width);</pre>

<a href="http://phpthumb.sourceforge.net/demo/docs/phpthumb.readme.txt" target="_blank">phpthumb.readme.txt</a> 의 URL Parameters 부분을 참고해서 Parameter를 set하면 된다. 가로 사이즈뿐 아니라 세로 사이즈도 정할 수 있고, 심지어 이미지를 회전할 수도 있다. 흑백처리할 수도 있고 말이다. 근데 사실 위 문서를 보는 것보다 <a href="http://phpthumb.sourceforge.net/demo/demo/phpThumb.demo.demo.php" target="_blank">phpThumb 데모</a>를 보는 편이 더 빠르게 이해할 수 있다. 여튼, 위 함수를 알아서 고쳐 쓰면 된다.

자, 위의 함수가 있으니 이제 함수를 사용해 보자. 그러려면 일단, phpThumb의 클래스를 인클루드하고, 위 함수도 인클루드해야 한다. 그리고 phpThumb의 객체 인스턴스를 생성하고, 몇 가지 세팅을 해 준 후 사용하면 된다.

<pre class="brush:php">//resizeAction.php
include &#039;phpThumb.class.php&#039;;
include &#039;phpThumbResizeFunction.php&#039;;
$phpThumb = new phpThumb();
$phpThumb-&gt;setParameter(&#039;config_imagemagick_path&#039;, &#039;이미지매직 변환파일 경로&#039;);
// 우분투는 이미지매직의 변환파일 경로가 /usr/bin/convert 다.
$phpThumb-&gt;setParameter(&#039;config_document_root&#039;, &#039;도큐먼트 루트 절대경로를 적어 준다.&#039;);
$phpThumb-&gt;setParameter(&#039;config_cache_directory&#039;, &#039;캐시 디렉토리의 풀 경로를 적어 준다.&#039;);
//당연히 캐시 디렉토리의 퍼미션은 777로 설정돼 있어야 한다.(644인가 해도 된다는데 모르니깐;; 777이 미심쩍은 분들은 찾아 보길)
/**
 * resizeImage 함수 사용법
 * resizeImage($phpThumb 오브젝트, $_FILES[&#039;파라미터name&#039;][&#039;tmp_name&#039;], 가로 사이즈 정수값, &#039;리사이즈 파일을 생성할 절대경로와 파일명&#039;);
 * 이렇게 하면 리사이즈한 파일의 절대경로를 리턴해 준다.
 * @var unknown_type
 */
$output = resizeImage($phpThumb, $_FILES[&#039;userfile&#039;][&#039;tmp_name&#039;] , 540, $_SERVER[&#039;DOCUMENT_ROOT&#039;].&#039;/Photo_thumbnail_cache/&#039;.$_FILES[&#039;userfile&#039;][&#039;name&#039;]);</pre>

자, 눈치있는 분들은 얘가 input file을 받는 놈이라는 것을 아실 것이다.

그럼 파일을 resizeAction.php로 보내는 html을 짜 보자.

<pre class="brush:html">&lt;form action="resizeAction.php" enctype="multipart/form-data" method="post"&gt;
&lt;input name="userfile" type="file"&gt;
&lt;input type="submit"&gt;</pre>

뭐, 대충 이렇게 짜면 될 것이다.

## 오류 하나가 있었다.

phpThumb의 오류인지 내 설정에 문제가 있는지 모르겠는데, 여튼 계속 중간에 `$_FILES['userfile']['tmp_name']`의 값이 사라지는 것이었다. 그러면서 아래와 같은 에러 메시지를 뿜었다.

<pre class="brush:plain">"" does not exist</pre>

자, phpThumb 객체는 에러가 나면 상당히 자세한 debug 메시지를 뿌려 준다. 눈이 돌아갈 정도다. 근데, 어려워할 필요 없다. 메시지의 대부분은 성공적인 처리를 했다는 debug 메시지다. 전부 에러 메시지는 아니라는 말이다.

따라서 메시지를 차근차근 읽어 나가면서 에러가 난 부분을 찾아야 한다. 나는 바로 아래 메시지 부분에서 에러의 단초를 확인할 수 있었다.

<pre class="brush:plain">skipping GetImageSize() because $this-&gt;sourceFilename is empty in file "phpthumb.class.php" on line 2932</pre>

번역해 보자. $this->sourceFilename이 비었기 때문에 GetimageSize를 걍 넘어간다는 거다. 즉, 중간 어디에선가 tmp\_name이 유실됐다는 거다.($\_FILES\['userfile'\]\['tmp_name'\]은 html에서 파일을 받아서 임시로 저장하는 파일명이다. 자동 생성되며 /tmp/phpBYur13 따위로 이름이 정해진다. 파일을 원하는 위치로 옮기고 나면 삭제된다.)

추적을 해 보니 아래 놈이 문제였다.

<pre class="brush:php">//phpThumb.class.php 816째 줄에 있는 놈
$this-&gt;sourceFilename =
$this-&gt;ResolveFilenameToAbsolute($this-&gt;sourceFilename);
//이놈을 주석처리했다.</pre>

위 코드를 보면 $this->ResolveFilenameToAbsolute($this->sourceFilename); 이 부분이 있는데, 즉, ResolveFilenameToAbsolute 이 함수가 $sourceFilename 을 먹어버리고 빈 값을 리턴한 것이다.

그래서 위 부분을 주석처리했더니 해결됐다.

위 함수는 파일의 절대경로를 구하는 것인데, 어차피 tmp_name이 절대경로를 가져가니까 없어도 상관없었다. 만약 반드시 필요했다면 수정하는 게 좋았겠지만 이정도로 만족이다.