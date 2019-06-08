---
title: 안드로이드 컬러노트 앱 데이터 추출하기
layout: post
tags: 
  - etc
  - android
---

안드로이드폰을 사용하면서 메모 앱 호환성 때문에 낭패를 겪은 일이 있다. 갤럭시S5 메모 앱에서 데이터를 추출할 방법이 없었다. G5로 갈아탔을 때 이야기다. 그래서 G5에선 동기화가 되는 컬러노트를 사용했다.

최근 아이폰으로 갈아타면서 또 낭패를 겪었다. 컬러노트 앱은 안드로이드만 지원했고, txt 추출도 되지 않았다. txt 추출 기능을 지원하면 메모 앱을 바꿀 것이라는 공포라도 있는지 txt 추출 기능을 지원하는 앱이 많지 않다. (사실 이런 점에선 아이폰의 메모 앱도 마찬가지다.)

다행히 컬러노트에서 메모 db를 뽑아내는 방법을 찾았다. 해외에서도 많이 사용하는 앱인 게 다행이었다.

개발자라면 컬러노트 데이터를 추출하는 게 가능하다.


## 컬러노트 앱 데이터 추출

일단 안드로이드 접속시 사용하는 커맨드라인 툴인 `adb`를 사용해 앱의 데이터를 추출한다.[^adb]

[^adb]: `adb`로 안드로이드폰에 접속하는 법을 모르는 사람은 그것부터 찾아서 공부하고 돌아와야 한다. 여기서 설명할 순 없다. 커맨드라인도 모르는 경우... 역시 그것부터 간단히 사용법을 익히는 게 좋겠다.

~~~ bash
adb backup -noapk com.socialnmobile.dictapps.notepad.color.note
~~~

실행하면 폰에서 승낙하라고 뜬다. 폰이 암호화돼 있는 경우 암호를 입력하라고 나온다. 그런 경우 암호를 입력하자.

실행하고 나면 `backup.ab`라는 파일이 생긴다.


## 앱 데이터 복호화, 압축 해제

추출한 `backup.ab`는 폰이 암호화돼 있었던 경우 암호화돼 있다. 폰이 암호화돼 있지 않았던 경우엔 암호화돼 있지 않을 거다.

이제 [android backup extractor](https://github.com/nelenkov/android-backup-extractor)를 사용해서 backup.ab를 일반적인 tar파일로 만들자. [릴리즈](https://github.com/nelenkov/android-backup-extractor/releases)에 가서 abe-all.jar 파일을 다운로드하면 된다. 그리고 물론 java가 설치돼 있어야 한다. java가 없다면 jre(Java Runtime Environment)를 다운받아 설치한다.

~~~ bash
java -jar abe-all.jar unpack backup.ab backup.tar [password]
~~~

만약 암호화된 ab 파일이라면 `[password]` 부분에 암호를 입력하면 된다. 암호를 `my-password`라고 설정한 경우라면 아래처럼 입력하면 된다. 암호가 없으면 그냥 입력을 안 하는 되는 것 같다.

~~~ bash
java -jar abe-all.jar unpack backup.ab backup.tar my-password
~~~

그럼 이제 `backup.tar` 파일이 만들어진다.

tar 파일은 일반적인 압축 프로그램으로 압축해제할 수 있다. 커맨드라인으로 푸는 방법은 아래와 같다.

~~~ bash
tar xvf backup.tar
~~~

그러면 `apps`라는 폴더가 만들어지면서 압축이 풀린다.


## sqlite db에서 데이터 추출

`⁨apps/⁨com.socialnmobile.dictapps.notepad.color.note⁩/db/colornote.db⁩` 파일을 찾는다. 그리고 [sqlite 클라이언트 프로그램](https://www.google.com/search?q=sqlite+client)으로 해당 파일을 연다. 프로그램은 여러 개가 있으니 찾아 보기 바란다.[^sqlite]

[^sqlite]: 뭔 말인지 모르겠는 분들은 sqlite의 사용법을 간단히 찾아 봐야 할 거다.

그리고 쿼리를 날린다. 쿼리는 아래와 같다.

~~~ sql
SELECT datetime(created_date/1000,'unixepoch') as created, datetime(modified_date/1000,'unixepoch') as modified,note FROM notes ORDER BY created
~~~

그러면 생성일시, 수정일시, 노트가 깔끔하게 정리된 결과물이 나온다. 그걸 csv로 저장한다. 

sqlite는 결과물을 csv로 저장하는 기능을 내장하고 있다. GUI 클라이언트로 접속했다면 메뉴를 찾아 보면 될 테고, 커맨드라인 sqlite 클라이언트로 접속했다면 아래와 같은 명령어를 사용하면 된다.

~~~ sqlite
.headers on
.mode csv
.output colornote.csv
SELECT datetime(created_date/1000,'unixepoch') as created, datetime(modified_date/1000,'unixepoch') as modified,note FROM notes ORDER BY created
.quit
~~~

위 명령어에서 `colornote.csv`는 파일명을 지정해 주는 부분이니 맘대로 쓰면 된다.


## csv를 txt 파일로 변경하기

이제 csv 파일을 얻었으니 여기서 만족해도 된다. 하지만 나는 csv 파일을 개별 txt 파일로 변환하기를 원한다. 그래서 `memos`란 폴더를 만든 뒤, 아래 php 스크립트로 메모를 모두 txt 파일로 변환했다. 스크립트는 내가 짠 것이다.

~~~ php
/** 
 * filename: colornote-csv-to-txt.php
 * author: mytory@gmail.com
 * datetime: 2019-06-08 18:00:00
 */

$rows = [];
if (($handle = fopen('colornote.csv', 'r')) !== false) {
    while (($row = fgetcsv($handle, 0, ',')) !== false) {
        $rows[] = $row;
    }
    fclose($handle);
}

$header = array_shift($rows);
foreach($rows as $i => $row) {
    $rows[$i] = array_combine($header, $row);
}

foreach($rows as $row) {
    $title = trim(preg_replace('/[^ 0-9A-Za-z가-힣-_]/u', '', mb_substr((explode("\n", $row['note'])[0] ?? ''), 0, 20)));
    $date = date('Y-m-d', strtotime($row['created']));
    if ($title) {
        $filename = "{$date} {$title}";
    } else {
        $filename = $date;
    }
    
    while (is_file("memos/{$filename}.txt")) {
        $filename = "{$filename}-";
    }
    file_put_contents("./memos/{$filename}.txt", $row['note']);
}
~~~

그러면 `{날짜} {첫줄 20글자}.txt` 형태로 `memos` 폴더에 텍스트 파일들이 만들어진다(폴더를 미리 만들어 놔야 한다). 대충 빨리 짠 거니 코드를 이해한 뒤 적절히 수정해서 사용해야 할 거다.

역시 커맨드라인에서 아래처럼 명령을 내리면 완료. (위 스크립트를 `colornote-csv-to-txt.php` 파일에 저장했다고 가정한다.) 역시 php를 커맨드라인에서 실행할 수 있게 설치해 놨어야 한다.

~~~ bash
php colornote-csv-to-txt.php
~~~



## 참고자료

- [Exporting Data from ColorNote Android](https://haukerehfeld.de/notes/2017-02-colornote-export/)
- [How do you extract an App's data from a full backup made through “adb backup”?](https://android.stackexchange.com/questions/28481/how-do-you-extract-an-apps-data-from-a-full-backup-made-through-adb-backup/28483?stw=2#28483)
- [android-backup-extractor](https://github.com/nelenkov/android-backup-extractor)
- [How to parse csv in PHP having multiline data in a column](How to parse csv in PHP having multiline data in a column)