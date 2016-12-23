---
title: '[PHP] 텍스트 링크에 a 태그를 붙여서 실제 링크로 만들어 주는 함수'
author: 안형우
layout: post
permalink: /archives/4862
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36535282
categories:
  - 서버단
tags:
  - PHP
---
이 함수는 어디선가 긁은 거고, 당연히 완전하지 않다. 내가 만든 게 아니다.

<pre class="brush: php; gutter: true; first-line: 1">//텍스트로 있는 링크에 a 태그를 붙여서 실제 링크로 만들어 주는 함수
function linkfy($s) {
  return preg_replace(&#039;@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@&#039;, &#039;&lt;a href="$1"&gt;$1&lt;/a&gt;&#039;, $s);
}</pre>

이런 것도 발견했다.

<pre class="brush: php; gutter: true; first-line: 1">function convert_to_clickable($text){
  // Finds all http/https/ftp/ftps links that are not part of an existing html anchor
  if (preg_match_all(&#039;~\b(?&lt;!href="|"&gt;)(?:ht|f)tps?://\S+(?:/|\b)~i&#039;, $text, $matches))
  {
    //checking for URLs
    foreach ($matches[0] as $match)
    {
      $clickable_link = "&lt;a href=\" $match \"&gt; $match &lt;/a&gt;";
      $text = str_replace($match, $clickable_link, $text);

    }

  }

  //checking for emails
  if( preg_match_all(&#039;/[a-z0-9]+([\\+_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i&#039;,
      $text, $matches) ) {

    foreach( $matches[0] as $match ) {
      $clickable_link = "&lt;a href=\"mailto:$match\"&gt; $match &lt;/a&gt;";
      $text = str_replace($match, $clickable_link, $text );
    }
  }

  return $text;
}</pre>

출처는 <https://github.com/eyedol/linkfy> 다.