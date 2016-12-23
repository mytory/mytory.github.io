---
title: '&lt; 따위 글자를 원래대로 돌려주는 php함수 &#8211; htmlspecialchars_decode.php 구현함수'
author: 안형우
layout: post
permalink: /archives/247
aktt_notify_twitter:
  - yes
daumview_id:
  - 37113595
categories:
  - 서버단
tags:
  - PHP
---
먼저, 출처는 [http://jacking.x-y.net/entry/htmlspecialchars-htmlspecialcharsdecode-사용][1]&nbsp;이다.

cut_len따위의 이름으로 만들어진, 문자열을 잘라 주는 함수를 많이들 다뤄 봤을 거다. 인코딩도 귀찮은 일이지만, & l t ; 나 & g t ; 같은 글자들이 중간에 잘리는 게 보기 싫게 잘리는 경우가 있다. 게다가 저런 아이들은 4글자로 처리가 되니 저런 아이들이 들어 있는 경우는 의도한 것보다 더 짧게 잘린다.

그걸 해결하려면 아래처럼 코드를 작성하면 될 터.

<pre class="brush:php">$text=&#039;&lt;조선일보&gt;는 쓰레깁니다.&#039;;
$text=htmlspecialchars_decode($text);
$text=cut_len($text);
$text=htmlspecialchars($text);
return $text;
</pre>

뭐 이런 식으로다가 말이다. 그런데 한 가지 문제가 있다. <a href="http://php.net/manual/en/function.htmlspecialchars-decode.php" target="_blank">htmlspecialchars_decode는 PHP5부터 있는 함수</a>다. PHP4에서 불가피하게 돌려야 하는 홈페이지는 위 함수를 사용할 수 없고 알아서 만들어 써야 한다.

나도 그럴까 생각했지만, PHP 함수를 js로 구현해 놓은 것도 발견한 마당에 PHP5의 함수를 누군가 구현해 놓은 게 분명 있을 거라 생각, 검색을 해 봤는데 찾은 것이다.

코드는 아래와 같다.

<pre class="brush:php">//for php4
function htmlspecialchars_decode($string, $quote_style = null)
    {
        // Sanity check
        if (!is_scalar($string)) {
            user_error(&#039;htmlspecialchars_decode() expects parameter 1 to be string, &#039; .
                gettype($string) . &#039; given&#039;, E_USER_WARNING);
            return;
        }

        if (!is_int($quote_style) && $quote_style !== null) {
            user_error(&#039;htmlspecialchars_decode() expects parameter 2 to be integer, &#039; .
                gettype($quote_style) . &#039; given&#039;, E_USER_WARNING);
            return;
        }

        // Init
        $from   = array(&#039;&&#039;, &#039;&lt;&#039;, &#039;&gt;&#039;);
        $to     = array(&#039;&&#039;, &#039;&lt;&#039;, &#039;&gt;&#039;);

        // The function does not behave as documented
        // This matches the actual behaviour of the function
        if ($quote_style & ENT_COMPAT || $quote_style & ENT_QUOTES) {
            $from[] = &#039;"&#039;;
            $to[]   = &#039;"&#039;;

            $from[] = &#039;&#039;&#039;;
            $to[]   = "&#039;";
        }

        return str_replace($from, $to, $string);
    }
</pre>

그럼, 도움이 됐길.

[덧] 이 글을 작성하고 나니 PHP4에서도 작동하는 함수를 발견할 수 있었다;; 아래 링크를 참고하라.

<http://www.php.net/manual/en/function.html-entity-decode.php>

[덧2] 위 html-entity-decode 함수를 사용하니까 깨지는 글자가 발생했다. 그래서 htmlspecialchars_decode 함수를 사용하기로 했다.

 [1]: http://jacking.x-y.net/entry/htmlspecialchars-htmlspecialcharsdecode-%EC%82%AC%EC%9A%A9