---
title: '[PHP] 파일명에서 숫자만 남기고 앞부분은 다른 문자열 붙여 주는 스크립트'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10085
daumview_id:
  - 44262128
categories:
  - 서버단
tags:
  - PHP
---
이미지로 된 여러 jpg 파일이 `사진1.jpg`, `사진-2.jpg`, &#8230;, `IMG10.jpg` 형식으로 돼 있을 때 정렬을 맞추려고 일일이 파일명 바꾸는 거 맨날 하기 귀찮아서 만든 스크립트다. 물론 윈도우에선 XnView로 맨날 처리했지만. 맥에서 쓰려고.

터미널에서 사용하면 되고, 사용법은 아래와 같다.

<pre>php rename.php myfolder 새사진</pre>

이렇게 사용하면 myfolder에 있는 모든 파일(!)이 `새사진01.jpg` 형식으로 파일명이 바뀐다. 자리수는 알아서 맞춘다. 만약 1부터 100까지 있다면 `001`로 맞춘다.

아래는 소스.

<pre>if($argc != 3){
  echo "invalid!\n";
  echo "Usage: php rename.php {dir} {prefix}\n";
  echo "ex. php rename.php . mypic\n";
  exit(0);
}
$this_file = $argv[0];
$dir = realpath($argv[1]);
$prefix = $argv[2];

if($handle = opendir($dir)){
  $files = array();
  $number_length = 0;
  while(false !== ($entry = readdir($handle))){
    if($entry == '.' || $entry == '..' || $entry == $this_file || is_dir($dir . '/' . $entry)){
      continue;
    }
    $this_len = strlen(preg_replace("/[^0-9]/", '', $entry));
    if($this_len &gt; $number_length){
      $number_length = $this_len;
    }
    $files[] = $entry;
  }

  foreach ($files as $entry) {
    $ext = pathinfo($entry, PATHINFO_EXTENSION);
    $number = sprintf("%0{$number_length}d", preg_replace("/[^0-9]/", '', $entry));
    $new_name = $prefix . $number;
    if( ! empty($ext)){
      $new_name .= '.' . $ext;
    }
    rename($dir . '/' . $entry, $new_name);
  }
  echo "done!\n";
}else{
  echo "can't open dir {$dir}.\n";
}</pre>