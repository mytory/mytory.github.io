---
title: '[php]폴더 확인해서 없으면 만드는 함수'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/394
aktt_notify_twitter:
  - yes
daumview_id:
  - 37009747
categories:
  - 서버단
tags:
  - PHP
---
<pre class="brush:php">function make_if_no_folder($folder){
  if(!is_dir($folder)){
    mkdir($folder, 0755);
  }
}</pre>

뭐, 이정도면 되려나. 필요할 때 긁어 쓰려고 갈무리.

업로드 폴더의 퍼미션은, StarHost[링크 깨짐 - 2012-09-25]라는 데를 보니 755(소유자는 읽기/쓰기/실행 모두, 소유 그룹과 기타는 읽기/실행만)를 권장하고 있어서 따라함. 맞죠?