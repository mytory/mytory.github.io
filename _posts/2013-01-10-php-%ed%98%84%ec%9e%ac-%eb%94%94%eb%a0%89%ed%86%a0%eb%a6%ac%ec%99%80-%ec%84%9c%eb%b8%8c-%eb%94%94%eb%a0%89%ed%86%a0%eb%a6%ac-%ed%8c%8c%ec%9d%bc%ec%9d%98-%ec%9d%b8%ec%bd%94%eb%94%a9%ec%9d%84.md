---
title: '[PHP] 현재 디렉토리와 서브 디렉토리 파일의 인코딩을 변경해 주는 PHP Script'
author: 안형우
layout: post
permalink: /archives/9120
daumview_id:
  - 38819275
categories:
  - 서버단
tags:
  - PHP
---
맥에서 텍스트 파일을 폴더째로 Encoding 변환하려니까 찾기가 힘들었다. 뭔가 Shell Script는 있는데, 난 익숙하질 않고. 그래서 그냥 php 스크립트를 만들었다. 서버에 놓고 웹브라우저로 접속하면 되게 만들었다. 아마 그냥 쉘에서 실행시켜도 되긴 할 텐데 해 보진 않았다.

사용법은 아래와 같다.

<pre>iconv_all_file('.', 'euc-kr','utf-8', true);</pre>

함수는 아래와 같다.

<pre>function iconv_all_file($dir, $input, $output, $subdir = false){
  echo "기존 파일을 덮어 씁니다.&lt;br&gt;";

  $ext_arr = array('txt','php','html','htm','js','css','java','jsp','asp','md');

  $dir = realpath(trim($dir));

  echo "{$dir}에 있는 파일 변환을 시작합니다.&lt;br&gt;";

  if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
      if($entry == '.' || $entry == '..'){
        continue;
      }

      $fullpath = $dir . '/' . $entry;

      //변환
      if(is_file($fullpath)){

        //현재 이 파일이면 넘어감
        if($fullpath == __FILE__){
          continue;
        }

        //지정된 확장자가 아니면 넘어감.
        $ext = strtolower(pathinfo($fullpath, PATHINFO_EXTENSION));
        if( ! in_array($ext, $ext_arr) ){
          echo "{$fullpath} : 대상 확장자가 아니므로 변환하지 않고 넘어갑니다.&lt;br&gt;";
          continue;
        }

        $content = file_get_contents($fullpath);
        $content = iconv($input,$output,$content);
        $fp = fopen($fullpath, 'w');
        $result = fwrite($fp, $content);
        fclose($fp);
        if($result &gt;= 0){
          echo "&lt;div style='color:green'&gt;{$fullpath} 변환 완료.({$result}bytes)&lt;/div&gt;";
        }else{
          echo "&lt;div style='color:red'&gt;{$fullpath} 변환 실패.&lt;/div&gt;";
        }
      }else if($subdir == true AND is_dir($fullpath)){
        //서브 디렉토리 처리
        iconv_all_file($fullpath, $input, $output);
      }
    }
    closedir($handle);
  }else{
    echo "opendir 실패&lt;br&gt;";
  }
}</pre>