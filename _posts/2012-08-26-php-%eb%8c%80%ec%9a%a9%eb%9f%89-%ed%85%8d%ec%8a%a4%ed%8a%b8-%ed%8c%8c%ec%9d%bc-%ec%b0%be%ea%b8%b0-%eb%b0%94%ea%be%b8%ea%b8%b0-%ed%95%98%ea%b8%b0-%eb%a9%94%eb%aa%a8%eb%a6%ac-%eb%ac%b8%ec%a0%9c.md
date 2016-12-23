---
title: '[PHP] 터미널에서 대용량 텍스트 파일 찾기 바꾸기 하기 (메모리 문제 없이)'
author: 안형우
layout: post
permalink: /archives/3168
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36572522
categories:
  - 서버단
tags:
  - PHP
---
`MySQL4`에서 `5`로 넘어오면서 테이블을 만들 때 `TYPE=MyISAM` 이라고 쓰던 걸 `ENGINE=MyISAM` 으로 쓰게 됐다고 한다. (정확한 버전대는 모르겠다.)

여튼간에 4에서 돌아가는 DB가 백업파일을 압축해서 받으니까 한 160메가쯤 됐다. 압축을 푸니 600메가쯤 된다. `TYPE=MyISAM` 부분에서 에러를 뿜으며 임포트가 안 된다. 골치가 아팠다.

에디트플러스에서 열어 봤다. 메모리 부족으로 프로그램이 꺼진다. 결국 스크립트를 돌리는 방법밖에 없는 것 같다는 생각을 했다.

그래서 처음엔 PHP의 `file_get_contents` 함수를 사용했다. 그런데 파일이 대용량이니까 `php.ini`에 들어가서 메모리를 1기가나 할당해 줘도 뻗어버린다. (`memory_limit = 1024M` 로 수정했다는 말이다.) 에러 메시지는 아래와 같았다.

<pre>PHP Fatal error:  Allowed memory size of 838860800 bytes exhausted (tried to allocate 638960364 bytes)</pre>

뭔가 순차적으로 읽어서 조작하는 방법은 없나? 하고 찾아 봤다. file 함수 말고 fopen 함수를 사용하면 될 것 같아서 관련 코드를 찾았다. 찾은 코드를 살짝 변경했다. 일단 `str_replace`를 하게 했고, 그 뒤 `echo` 로 바뀐 문자열을 출력해 주게 했다. 그리고 이걸 파일로 만들도록 쉘의 기본 기능인 `>` 명령어를 사용했다. 그렇게 하니 `php.ini`에 설정된 메모리 한계가 128M이었는데도 뻗지 않고 잘 돌아갔다.

## 쉘의 기본 기능인 `>` 명령어

<pre>명령어 &gt; 파일명</pre>

이런 형식으로 쓰면 출력이 화면으로 되지 않고 파일로 되는 기능 말이다. 예를 들면

<pre>ls &gt; ls.txt</pre>

이렇게 써 주면 `ls.txt` 파일이 생성된다. 아무 것도 출력은 안 되고 말이다. `ls.txt` 파일을 열어 보면 파일 목록이 들어가 있는 것을 볼 수 있다. 맥 OSX와 리눅스의 터미널, 윈도우의 CMD에서 모두 작동한다. (아, 윈도우 CMD엔 ls가 없으니 dir로 테스트해 봐라. PHP 실행파일은 역시 php일 텐데 안 되면 php5로도 해 보고 뭐, 여튼 자신이 프로그래머라면 PHP의 실행 파일 찾는 건 어렵지 않을 거다.)

여튼간에, 그래서 코드와 쉘 명령어는 아래와 같다.

## 메모리 걱정 없는 PHP 문자열 변환 코드

실제 코드는 아래와 같다. 아래 코드로 PHP 파일을 하나 만든다. 그리고 그걸 콘솔에서 실행하는데, 실행 결과를 `txt` 파일로 저장하게 하면 되는 거다. 웹 서버에서 실행하라는 이야기가 아니라 콘솔에서 CLI로 실행하라는 말이다.

<pre class="brush: php; gutter: true; first-line: 1">&lt;? // 파일명 : str_replace.php

$filename = "mydump.sql";
$fp = fopen($filename, "rb") or die("fopen failed");

while( ! feof($fp)) {
	echo str_replace("TYPE=MyISAM","ENGINE=MyISAM",fgets($fp));
}
fclose($fp) or die("fclose failed");
?&gt;</pre>

`feof($handle)`는 파일의 끝에 도달했는지 묻는 함수다. 끝이면 `TRUE`를, 그렇지 않으면 `FALSE`를 반환한다. 에러가 발생했다면? `TRUE`를 반환한다.

`fgets($handle)`은 파일을 한 줄씩 읽어들이는 함수다. `fgets($handle, 1024)` 형식으로 몇 바이트씩 읽어들일지도 정해줄 수 있다. 위 코드에선, 한 줄씩 읽어야 변환을 제대로 할 수 있기 때문에 한 줄씩 읽도록 했다.

만약 줄바꿈을 다 없애야 한다면? 그럼 또 골때릴 것 같은데 &#8230; 일단 방법은 모르겠다. 아는 분은 알려 주기 바란다.

## 콘솔에서 실행하는 방법

콘솔에서는 아래처럼 실행하면 된다.

<pre class="brush: bash; gutter: true; first-line: 1">php str_replace.php &gt; mydump.replaced.sql</pre>

물론 `mydump.sql` 과 `str_replace.php` 는 같은 폴더에 있어야 하고 실행 역시 해당 폴더로 가서 해 주면 되겠다.