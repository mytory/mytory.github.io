---
title: '[php] json에서 엔터값이 문제된다면, 임시방편으로 다음 함수를&#8230;'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/597
aktt_notify_twitter:
  - yes
daumview_id:
  - 36923085
categories:
  - 서버단
tags:
  - PHP
---
별로 좋아하는 방식의 해결책은 아니다. 하지만 고육지책으로 사용했다.

<pre class="brush:php">function parse_for_json($text) { 
    // Damn pesky carriage returns... 
    $text = str_replace("\r\n", "\n", $text); 
    $text = str_replace("\r", "\n", $text); 
 
    // JSON requires new line characters be escaped 
    $text = str_replace("\n", "\\n", $text); 
    return $text; 
} 
</pre>

<a target="_blank" href="http://sir.co.kr/bbs/board.php?bo_table=tip_jquery&wr_id=210">출처는 여기</a>다.