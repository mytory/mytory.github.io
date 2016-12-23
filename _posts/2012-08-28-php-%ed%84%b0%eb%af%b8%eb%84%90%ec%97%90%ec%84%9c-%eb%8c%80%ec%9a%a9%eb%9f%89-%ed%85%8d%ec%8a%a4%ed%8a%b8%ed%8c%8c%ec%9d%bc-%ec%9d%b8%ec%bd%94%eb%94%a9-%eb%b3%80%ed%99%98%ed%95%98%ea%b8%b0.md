---
title: '[PHP] 터미널에서 대용량 텍스트파일 인코딩 변환하기'
author: 안형우
layout: post
permalink: /archives/3180
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36570861
categories:
  - 서버단
tags:
  - PHP
---
일단 급하신 분들을 위해 변환용 코드만 바로 드린다. 자세한 설명은 변환용 코드 아래쪽을 보면 있다.  
    

  
`$filename` 항목에 타겟 파일명을 적어 주면 된다. 그러면 변환된 파일은 현재 `{원 파일명}({to-encoding}).{원래 확장자}` 로 저장된다. 예컨대, 원래 파일명이 `test.txt`였고 이걸 utf-8로 변환했다면 `test(utf-8).txt`로 변환된다.

문서 변환용이 아니라 DB 인서트문 변환용으로 만든 거라 문서 변환용으로는 적합하지 않을 수 있다. 파일을 자동으로 긁어 오는 것도 아니고 말이다. 실행은 터미널에서 한다. 윈도우라면 `cmd`에서 하면 되고. 위 코드를 `iconv.php`로 저장한 뒤,

<pre>php iconv.php euc-kr utf-8 test.txt</pre>

이런 식으로 실행하면 된다. 만약 `php`가 뭔지 모르겠다고 나오면 `php` 파일이 있는 경로까지 다 적어 주면 된다.

<pre>C:\APM_Setup\Server\PHP5\php.exe iconv.php euc-kr utf-8 test.txt</pre>

이런 식으로 하면 되겠다. 물론 타겟 파일과 `iconv.php`가 같은 폴더에 있어야 한다.

## 자세한 스토리

`phpMyAdmin`으로 `MySQL DB`를 다운받았는데, 이게 인코딩이 `euc-kr`로 돼 있었다. 내가 임포트하려는 `DB`는 `utf-8`이었기 때문에 파일 인코딩을 `euc-kr`이라고 선택을 한 뒤 임포트를 했다. 심지어 [phpMyAdmin의 임포트할 파일의 인코딩을 고르는 옵션에 `euc-kr`이 없어서 phpMyAdmin의 코어 파일을 수정][1]하기까지 했다. 그런데 이번에는 임포트용 DB파일의 1136번째 줄에 오류가 있다고 떴다. 컬럼과 입력할 값의 개수가 맞지 않다는 거다. 뭔소리야 `phpMyAdmin`에서 그대로 다운받은 거란 말야! 심지어 1136번째 줄이라니 ㅡㅡ;; 에디터로 열 수도 없는 용량 600메가짜리 파일을 어쩌란 말인가.

## iconv 함수의 옵션

일단 파일을 분석해야 하니 파일의 인코딩을 변경하기로 했다. [iconv 함수의 설명][2]을 보니 아래와 같은 코드와 함께 옵션을 설명하고 있었다. 완전 모르던 거다.

<pre class="brush: php; gutter: true; first-line: 1">$text = "This is the Euro symbol '€'.";

echo 'Original : ', $text, PHP_EOL;
echo 'TRANSLIT : ', iconv("UTF-8", "ISO-8859-1//TRANSLIT", $text), PHP_EOL;
echo 'IGNORE   : ', iconv("UTF-8", "ISO-8859-1//IGNORE", $text), PHP_EOL;
echo 'Plain    : ', iconv("UTF-8", "ISO-8859-1", $text), PHP_EOL;</pre>

설명은 간단하다. 일단 이 옵션은 원 인코딩에는 있고 변환할 인코딩에는 없는 문자가 있는 경우 어떻게 할 것인지를 지정해 주는 옵션이다. 만약 이런 옵션 없이 인코딩 변환을 시도하면 노티스를 띄우면서 해당 문자 뒤부터는 변환이 되지 않는다. 위 코드의 결과를 보면 이해가 될 거다.

<pre>Original : This is the Euro symbol '€'.
TRANSLIT : This is the Euro symbol 'EUR'.
IGNORE   : This is the Euro symbol ''.
Plain    :
Notice: iconv(): Detected an illegal character in input string in .\iconv-example.php on line 7
This is the Euro symbol '</pre>

출력할 인코딩의 뒤에 `//TRANSLIT` 이라고 붙이면, 출력할 인코딩에 없는 문자인 경우 나름의 번역을 해 준다. 이 경우에는 유로화 표시를 `EUR`로 번역해서 인코딩 변환을 했다. 훌륭하다. `//IGNORE`라고 붙이면 해당 문자를 변환하지 않는다. 만약 아무 옵션도 주지 않는다면 해당 문자 뒤부터는 문장 자체가 변환되지 않는다.

그래서 처음엔 `UTF-8//TRANSLIT` 이라고 출력 인코딩을 설정했다. 그리고 이제 1136번째 줄을 봐야 하는데&#8230; 터미널에서 보는 방법이 있을 것 같았다.

## 대용량 텍스트 파일, 터미널에서 특정 줄만 보기

찾아 보니 역시 명령어가 있었다.

<pre class="brush: bash; gutter: true; first-line: 1">head -1140 target.txt | tail -10</pre>

`head -1140 파일명` 명령어는 시작부터 1140번째 줄까지만 출력하라는 이야기다.

위에선 약간 응용을 해서 명령어 구조가 다른데 `tail -10 파일명` 이렇게 쓰면 끝에서 앞으로 10줄만 출력하라는 이야기다.

자, 다음 `|` 가 위 응용의 핵심이다. `|` 는 터미널에서 사용되는 놈인데 &#8216;파이프&#8217;라고 읽는다. 이 파이프는 앞의 `head` 명령어를 통해 1140번째 줄까지 출력한 내용을 마치 파일인 것처럼 `tail` 명령어의 인자값으로 넘겨 준다. 그래서 `tail` 명령어의 인자값은 생략됐다. `-10` 옵션만 있는 거다.

자, `head` 명령어를 통해 1140줄짜리 가상의 파일이 생겼다. 그리고 이걸 `tail` 명령어로 뒤에서 10줄만 읽으라고 했다. 그럼? 1131번째 줄부터 1140줄까지만 화면에 출력되게 되는 것이다. 와우~ 멋져!

## 실마리

파일을 출력하고 꼼꼼히 뜯어 보니 실마리가 보였다. 일단 `SQL` 오류가 났던 이유는 `SQL`의 입력값 본문에 아래와 같은 식의 문장이 포함돼 있어서였다.

<pre>나는 나는 자라서 ''선생님''이 될 테야</pre>

어찌된 일인지 큰 따옴표가 있어야 할 자리에 작은 따옴표 두 개가 들어가 있었던 것이다. 그래서 이번엔 `UTF-8`로 변환하지 않은 `EUC-KR` 파일을 출력시켜 봤다. 터미널이 `UTF-8`로 돼 있어서 한글 부분은 왕창 깨져 나오긴 했지만 근처에 있는 특수문자들을 실마리로 해서 같은 부분에 대체 무슨 문자가 있었던 건지 찾아 봤다. 역시나! `“` 라는 문자가 `''`로 번역된 것이었다. 아마도 표준적인 `“` 이 아니라 뭔가 이상한 `“` 을 쓴 모양이다. (흔히 아래아 한글에서 이상한 특수문자를 넣어서 문서를 작성한 뒤 붙여넣기를 하면 저런 경우가 생길 수 있다.)

그럼 어쩔 수 없다. 일일이 찾아 바꿀 수도 없으니, `UTF-8//IGNORE` 로 변환하기로 했다. 그렇게 변환을 했고, 결과는? 성공! `phpMyAdmin`에서 임포트를 하니 잘만 들어갔다.

아마 처음에 `phpMyAdmin`에서 임포트할 파일의 인코딩을 `EUC-KR`로 선택하고 넣었을 때 오류가 발생했던 이유는 `phpMyAdmin`에서 파일을 변환할 때 `//TRANSLIT` 옵션을 사용하기 때문인 것 같다.

이상. `phpMyAdmin`과 `iconv` 함수에 대해 공부 한 번 잘 했다.

 [1]: http://mytory.net/archives/3162 "phpMyAdmin 3.5.2에서 import할 때 Character set of the file에 euc-kr이 없다면"
 [2]: http://www.php.net/manual/kr/function.iconv.php