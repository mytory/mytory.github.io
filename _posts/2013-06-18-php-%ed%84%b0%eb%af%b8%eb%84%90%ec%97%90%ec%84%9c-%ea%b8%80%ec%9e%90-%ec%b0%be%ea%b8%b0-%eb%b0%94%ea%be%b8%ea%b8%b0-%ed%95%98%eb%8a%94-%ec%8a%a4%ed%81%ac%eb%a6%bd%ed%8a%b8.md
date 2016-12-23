---
title: '[PHP] 터미널에서 글자 찾기 바꾸기 하는 스크립트'
author: 안형우
layout: post
permalink: /archives/10384
daumview_id:
  - 46302593
categories:
  - 서버단
tags:
  - PHP
---
워드프레스를 로컬에서 작업하려면 DB를 다운받아서 홈 url을 변경한 다음 다시 임포트를 해야 한다. 그런데 DB가 작으면 모르겠는데, 용량이 몇십 메가씩 나가는 경우엔 좀 골치가 아프다.

윈도우에선 Editplus가 웬만큼 큰 파일을 다 열어 준다. 그런데 기가 단위가 넘어가는 경우엔 Editplus로도 골치아프다.

맥이나 리눅스는 더하다. 몇십 메가만 되도 에디터들이 버벅댄다. 터미널 에디터는 어떤지 모르겠지만 여튼간에 GUI 텍스트 에디터들은 그렇다.

찾기바꾸기만 하면 되는데! PHP 스크립트를 만들어야겠다고 생각한 건, 터미널에서도 PHP를 돌릴 수 있다는 걸 알게 된 이후였다. 그리고 요즘엔 터미널 스크립트로 인자값을 받는 방법도 알게 됐다. 터미널을 열심히 사용하고 있기도 하다. 우와 그렇게 하니 신세계가 펼쳐졌다.

아래 스크립트는 PHP로 텍스트파일을 받아서 문자열을 찾기 바꾸기하는 스크립트다. 사용법은 아래와 같다.

    php str_replace.php ~/Download/mytory.sql "mytory.net" "mytory.net"
    

그러면 순식간에 문자열을 바꿔 준다. 만세! 한 줄씩 읽어들여서 변경하기 때문에 아무리 큰 파일이라도 감당해 낸다. 문자열을 변경한 파일은 원래 파일명 뒤에 `-replaced`라고 붙여 준다. 위 예시의 경우 `mytory-replaced.sql`이라는 파일을 생성하게 될 거다.

소스는 github에도 올려 뒀다. 저장소는 [str_replace.php][1]다.

    // filename : str_replace.php
    if($argc != 4){
        echo "invalid arg! ex) php {$argv[0]} /path/to/filename\n \"before string\" \"after string\"\n";
        exit(0);
    }
    
    $fullpath = $argv[1];
    $before_string = $argv[2];
    $after_string = $argv[3];
    $pathinfo = pathinfo(realpath($fullpath));
    $newpath = $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $pathinfo['filename'] . '-replaced.' . $pathinfo['extension'];
    
    if( ! is_file($fullpath)){
        echo "There is not $fullpath.\n";
        exit(0);
    }
    
    $fr = fopen($fullpath, "rb") or die("fopen to read failed.\n");
    $fw = fopen($newpath, "w") or die("fopen to write failed.\n");
    
    while( ! feof($fr)) {
        fwrite($fw, str_replace($before_string, $after_string, fgets($fr)));
    }
    fclose($fr) or die("read file handle fclose failed");
    fclose($fw) or die("write file handle fclose failed");
    
    echo "str_replace complete! $newpath is generated!\n";

 [1]: https://github.com/mytory/str_replace.php