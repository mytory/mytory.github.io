---
title: '[PHP] sql injection 방어 함수, mysql_real_escape_string'
author: 안형우
layout: post
permalink: /archives/961
aktt_notify_twitter:
  - yes
daumview_id:
  - 36762712
categories:
  - 서버단
tags:
  - PHP
---
[PHP 공식 한글 설명 : mysql\_real\_escape_string][1]

SQL 인젝션 공격은 ID나 PASSWORD 입력칸에 SQL문을 넣어서 DB를 터는 것을 말한다.

PHP 공식 웹사이트에는 SQL 인젝션 공격의 예로 아래와 같은 것을 들어 놓고 있다.

<pre class="brush:php">// 유저가 있는지 DB에서 체크하는 쿼리
$query = "SELECT * FROM users WHERE user=&#039;{$_POST[&#039;username&#039;]}&#039; AND password=&#039;{$_POST[&#039;password&#039;]}&#039;";
mysql_query($query);

// $_POST[&#039;password&#039;]를 체크할 수 없게 되고, 어떤 유저든 허용하게 된다. 예를 들면:
$_POST[&#039;username&#039;] = &#039;aidan&#039;;
$_POST[&#039;password&#039;] = "&#039; OR &#039;&#039;=&#039;";

// MySQL에 이런 쿼리가 전송된다는 것을 의미한다:
echo $query;
//SELECT * FROM users WHERE user=&#039;aidan&#039; AND password=&#039;&#039; OR &#039;&#039;=&#039;&#039;</pre>

mysql\_real\_escape_string 함수는 바로 이런 공격을 막아 주는 함수다.

PHP 공식 웹사이트에는 아래를 모범 예제로 들고 있다.

<pre class="brush:php">if (isset($_POST[&#039;product_name&#039;]) && isset($_POST[&#039;product_description&#039;]) && isset($_POST[&#039;user_id&#039;])) {
    // 접속
    $link = mysql_connect(&#039;mysql_host&#039;, &#039;mysql_user&#039;, &#039;mysql_password&#039;);

    if(!is_resource($link)) {

        echo "서버 접속 실패\n";
        // ... 오류를 적절히 기록

    } else {

        // ON일 경우 magic_quotes_gpc/magic_quotes_sybase 효과 제거

        if(get_magic_quotes_gpc()) {
            $product_name        = stripslashes($_POST[&#039;product_name&#039;]);
            $product_description = stripslashes($_POST[&#039;product_description&#039;]);
        } else {
            $product_name        = $_POST[&#039;product_name&#039;];
            $product_description = $_POST[&#039;product_description&#039;];
        }

        // 안전한 질의 만들기
        $query = sprintf("INSERT INTO products (`name`, `description`, `user_id`) VALUES (&#039;%s&#039;, &#039;%s&#039;, %d)",
                    mysql_real_escape_string($product_name, $link),
                    mysql_real_escape_string($product_description, $link),
                    $_POST[&#039;user_id&#039;]);

        mysql_query($query, $link);

        if (mysql_affected_rows($link) &gt; 0) {
            echo "Product inserted\n";
        }
    }
} else {
    echo "Fill the form property\n";
}</pre>

위와 같은 방식으로 사용하면 된다.

 [1]: http://www.php.net/manual/kr/function.mysql-real-escape-string.php