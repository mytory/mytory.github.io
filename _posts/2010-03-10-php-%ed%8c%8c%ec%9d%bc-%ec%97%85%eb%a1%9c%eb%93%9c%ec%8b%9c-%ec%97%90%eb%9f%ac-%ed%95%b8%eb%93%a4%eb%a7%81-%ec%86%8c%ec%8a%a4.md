---
title: '[PHP] 파일 업로드시 에러 핸들링 소스'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/386
aktt_notify_twitter:
  - yes
daumview_id:
  - 37012189
categories:
  - 서버단
tags:
  - PHP
---
파일을 업로드할 때 에러 핸들링은 간단한 소스에서는 신경쓰지 않는 경우가 있는 것 같다.

사실 급할 때는 그냥 &#8216;에러 났다&#8217;고만 해 주고 어떤 종류의 에러인지까지 소스를 짜는 게 귀찮다.

그럴 때를 위해 그냥 에러 핸들링 소스를 만들었다. 필요할 때 긁으면 될 것이다.

<pre class="brush:php">//JSON 형식으로 결과를 리턴한다.
if($_FILES[&#039;userfile&#039;][&#039;error&#039;] &gt; 0){
	echo &#039;{result: -1, &#039;;
	//오류 타입에 따라 echo &#039;msg: "오류종류"}&#039;;
	switch ($_FILES[&#039;userfile&#039;][&#039;error&#039;]){
	case 1: echo &#039;msg: "upload_max_filesize 초과"}&#039;;break;
	case 2: echo &#039;msg: "max_file_size 초과"}&#039;;break;
	case 3: echo &#039;msg: "파일이 부분만 업로드됐습니다."}&#039;;break;
	case 4: echo &#039;msg: "파일을 선택해 주세요."}&#039;;break;
	case 6: echo &#039;msg: "임시 폴더가 존재하지 않습니다."}&#039;;break;
	case 7: echo &#039;msg: "임시 폴더에 파일을 쓸 수 없습니다. 퍼미션을 살펴 보세요."}&#039;;break;
	case 8: echo &#039;msg: "확장에 의해 파일 업로드가 중지되었습니다."}&#039;;break;
	}
}</pre>

<pre class="brush:php">//그냥 결과를 화면에 뿌린다.
if($_FILES[&#039;userfile&#039;][&#039;error&#039;] &gt; 0){
	echo &#039;오류 발생 : &#039;;
	//오류 타입에 따라 echo &#039;오류종류"}&#039;;
	switch ($_FILES[&#039;userfile&#039;][&#039;error&#039;]){
	case 1: echo &#039;upload_max_filesize 초과&#039;;break;
	case 2: echo &#039;max_file_size 초과&#039;;break;
	case 3: echo &#039;파일이 부분만 업로드됐습니다.&#039;;break;
	case 4: echo &#039;파일을 선택해 주세요.&#039;;break;
	case 6: echo &#039;임시 폴더가 존재하지 않습니다.&#039;;break;
	case 7: echo &#039;임시 폴더에 파일을 쓸 수 없습니다. 퍼미션을 살펴 보세요.&#039;;break;
	case 8: echo &#039;확장에 의해 파일 업로드가 중지되었습니다.&#039;;break;
	}
}</pre>

JSON 형태는 ajax 파일 업로드에 사용하면 될 것이고, 그냥 화면에 뿌리는 것은 용도를 다양하게 사용할 수 있을 것이다.

위에 보면 오류 코드에 5번이 없다. 내가 빼먹은 게 아니고 원래 없는 것 같다. 이유는 안 찾아봤다.

<a href="http://php.net/manual/kr/features.file-upload.errors.php" target="_blank">php.net의 오류 코드 설명</a>을 참고하면 좋을 것이다.

참, 위 에러 핸들링은 PHP 4.3부터 도입된 것 같다. php.net을 참고하면 그렇게 써 있는 듯. 영어 달려서 확신은 못하겠다.

에러 코드 6번은 4.3.10과 5.0.3에서 도입된 것 같고, 7번은 5.1.0에서 도입된 듯.

8번 에러는 5.2.0에서 도입된 것 같은데, 번역이 잘 안 된다. PHP 확장이 업로드를 중지시켰다 정도 되는 것 같은데 뭘까.