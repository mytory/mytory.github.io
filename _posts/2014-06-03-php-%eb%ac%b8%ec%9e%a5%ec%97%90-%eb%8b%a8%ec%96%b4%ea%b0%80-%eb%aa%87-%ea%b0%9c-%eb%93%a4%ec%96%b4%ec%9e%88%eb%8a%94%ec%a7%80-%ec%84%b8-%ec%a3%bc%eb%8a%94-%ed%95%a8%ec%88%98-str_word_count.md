---
title: '[PHP] 문장에 단어가 몇 개 들어있는지 세 주는 함수 str_word_count'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/13037
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13037-str-word-count.md
categories:
  - 서버단
tags:
  - PHP
---
말 그대로다. 문장에 단어가 몇 개 들어있는지 세 주는 함수다.

    $string = "세월호 참사 - 이윤 경쟁이 내장된 자본주의 체제에선 재연될 수밖에 없다 - 하지만 박근혜도 책임 있다";
    echo str_word_count($string, 0, '-');
    // 결과는 2
    

함수를 찾아도 잘 안 나와서 세이브해 두는 거다.