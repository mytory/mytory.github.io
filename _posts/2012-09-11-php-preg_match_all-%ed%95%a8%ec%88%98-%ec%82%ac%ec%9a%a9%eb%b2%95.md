---
title: '[PHP] preg_match_all 함수 사용법'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/3252
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 36559265
categories:
  - 서버단
tags:
  - PHP
---
일단, [PHP.net의 preg\_match\_all 공식 설명][1]을 참고했다.

이 함수는 기본적으로 정규식에 맞는 문자열을 배열어 넣어주는 함수다. 어떤 방식으로 넣을지 옵션을 줄 수 있다. 옵션이 세 개인데, 다음 예제 코드에 각각 다른 옵션을 이해할 수 있도록 해 뒀다. 정규식에 대한 이해는 기본으로 있다고 가정한다.

<pre class="brush: php; gutter: true; first-line: 1">$subject = &#039;&lt;ul&gt;
	&lt;li&gt;&lt;a href="/#issuebar"&gt;메인기사&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href="/#special-article-section"&gt;특집기사&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a class="toggle-recommand" href="/#shortcut-recommand"&gt;추천기사&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href="/9_subscribe.php?from=mainNav"&gt;정기구독&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href="/B_support.php?from=mainNav"&gt;후원&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;&#039;;
$pattern = &#039;/"\/#(.+)"/&#039;;
preg_match_all($pattern, $subject, $matches1, PREG_PATTERN_ORDER);
preg_match_all($pattern, $subject, $matches2, PREG_SET_ORDER);
preg_match_all($pattern, $subject, $matches3, PREG_OFFSET_CAPTURE);
echo &#039;&lt;pre&gt;&#039;;
echo &#039;&lt;h1&gt;$subject : &lt;/h1&gt;&#039;;
print_r(htmlspecialchars($subject));
echo &#039;&lt;h1&gt;PREG_PATTERN_ORDER : &lt;/h1&gt;&#039;;
print_r($matches1);
echo &#039;&lt;h1&gt;PREG_SET_ORDER : &lt;/h1&gt;&#039;;
print_r($matches2);
echo &#039;&lt;h1&gt;PREG_OFFSET_CAPTURE : &lt;/h1&gt;&#039;;
print_r($matches3);
echo &#039;&lt;/pre&gt;&#039;;</pre>

이렇게 코드를 넣으면 아래와 같이 출력이 된다.

배열이 좀 많아서 골치가 아플 텐데, 우선 전체 정규식에 매치된 놈은 앞부분에 넣어 주고, 정규식에 포함된 각 괄호들을 뒷부분에 넣어 주는 것으로 이해하면 된다. 위에선 정규식을 `/"\/#(.+)"/` 이렇게 집어 넣었는데, `(.+)`가 바로 뒷부분 배열에 들어간 놈이다. 괄호로 여러 개가 묶여 있다면 여러 개를 반환해 준다.

`PREG_PATTERN_ORDER` 로 옵션을 줬을 때는 일단 앞의 배열에 전체 정규식에 매칭된 놈들을 한꺼번에 넣어 주고, 뒤의 배열에는 괄호에 맞는 놈을 또 한꺼번에 넣어 준다. 괄호가 여러 개라면 뒤에 계속 배열을 더 붙여서 넣어 줄 거다. 이 예제의 경우 전체 정규식에 맞는 놈은 3개고, 괄호는 하나니까 원소 3개짜리 배열 2개가 들어 있는 것이다.

`PREG_SET_ORDER`로 하면 전체 정규식에 맞는 놈, 각 괄호에 맞는 놈을 한 배열씩 만들어서 차례로 넣어 준다. 이 예제의 경우 전체 정규식에 맞는 놈은 3개고, 괄호는 하나니까 원소 2개짜리 배열 3개가 들어 있다.

`PREG_OFFSET_CAPTURE`는 문자열의 위치를 함께 넣어 반환해 주는 것이다. `PREG_PATTERN_ORDER`로 결과를 반환해 주면서 문자열의 위치도 함께 반환해 줬는데, `PREG_SET_ORDER` 형태로 반환받고 싶다면 `preg_match_all($pattern, $subject, $matches4, PREG_SET_ORDER + PREG_OFFSET_CAPTURE);` 형태로 사용하면 된다.

질문이 있으면 댓글 달아 주길.

<pre class="brush: text; gutter: true">$subject : 

&lt;ul&gt;
	&lt;li&gt;&lt;a href="/#issuebar"&gt;메인기사&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href="/#special-article-section"&gt;특집기사&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a class="toggle-recommand" href="/#shortcut-recommand"&gt;추천기사&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href="/9_subscribe.php?from=mainNav"&gt;정기구독&lt;/a&gt;&lt;/li&gt;
	&lt;li&gt;&lt;a href="/B_support.php?from=mainNav"&gt;후원&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

PREG_PATTERN_ORDER : 

Array
(
    [0] =&gt; Array
        (
            [0] =&gt; "/#issuebar"
            [1] =&gt; "/#special-article-section"
            [2] =&gt; "/#shortcut-recommand"
        )

    [1] =&gt; Array
        (
            [0] =&gt; issuebar
            [1] =&gt; special-article-section
            [2] =&gt; shortcut-recommand
        )

)
PREG_SET_ORDER : 

Array
(
    [0] =&gt; Array
        (
            [0] =&gt; "/#issuebar"
            [1] =&gt; issuebar
        )

    [1] =&gt; Array
        (
            [0] =&gt; "/#special-article-section"
            [1] =&gt; special-article-section
        )

    [2] =&gt; Array
        (
            [0] =&gt; "/#shortcut-recommand"
            [1] =&gt; shortcut-recommand
        )

)
PREG_OFFSET_CAPTURE : 

Array
(
    [0] =&gt; Array
        (
            [0] =&gt; Array
                (
                    [0] =&gt; "/#issuebar"
                    [1] =&gt; 18
                )

            [1] =&gt; Array
                (
                    [0] =&gt; "/#special-article-section"
                    [1] =&gt; 66
                )

            [2] =&gt; Array
                (
                    [0] =&gt; "/#shortcut-recommand"
                    [1] =&gt; 154
                )

        )

    [1] =&gt; Array
        (
            [0] =&gt; Array
                (
                    [0] =&gt; issuebar
                    [1] =&gt; 21
                )

            [1] =&gt; Array
                (
                    [0] =&gt; special-article-section
                    [1] =&gt; 69
                )

            [2] =&gt; Array
                (
                    [0] =&gt; shortcut-recommand
                    [1] =&gt; 157
                )

        )

)</pre>

 [1]: http://www.php.net/manual/kr/function.preg-match-all.php