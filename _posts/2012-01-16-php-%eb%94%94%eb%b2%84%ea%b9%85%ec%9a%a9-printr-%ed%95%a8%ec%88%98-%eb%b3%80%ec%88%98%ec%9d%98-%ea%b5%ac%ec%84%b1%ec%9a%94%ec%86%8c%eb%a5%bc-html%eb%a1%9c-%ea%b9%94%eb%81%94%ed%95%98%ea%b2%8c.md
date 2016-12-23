---
title: '[PHP] 디버깅용 printr 함수 &#8211; 변수의 구성요소를 HTML로 깔끔하게 출력해 준다'
author: 안형우
layout: post
permalink: /archives/2073
aktt_notify_twitter:
  - yes
daumview_id:
  - 36658457
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/2073-printr.md
categories:
  - 서버단
tags:
  - PHP
  - TIP
---
기본적으로 PHP에는 [`print_r`][1]과 [`var_dump`][2]라는 강력한 함수가 있다. 그러나 좀 불만족스러울 때가 있다. 일단 `print_r()`은 스타일을 매겨 주지 않고, `null`, `true`, `false`를 제대로 표시하지 못한다. `var_dump()`는 `null`, `true`, `false`를 잘 보여 주고 xdebug 같은 것을 사용하면 스타일도 매겨 준다. 하지만 내용물이 긴 경우엔 내용을 생략한다.

디버깅 코드를 곳곳에 넣으면서 디버깅을 해야 하는 경우엔 출력된 놈이 뭔지 모르는 것도 문제다. 즉, 출력된 놈에게 제목을 붙일 수 없는 것도 문제다.

그래서 함수를 하나 만들었다. `printr()`과 `get_printr()`이다. 사용법은 아래와 같다.

    printr($result, "사람 목록");
    

나는 `printr`은 디버깅하면서 임시로 사용하는 용도로 만들었다. 그래서 디버깅이 끝나면 `printr`로 전체 검색을 해서 디버깅 코드를 모두 삭제한다. 그런데 간혹 에러 메시지와 함께 변수를 출력해 주는 게 좋은 경우가 있다. 그래서 남겨 둘 용도로 `debug_print`라는 놈도 만들었다. 스타일만 약간 다르고 사용법은 같다.

그러면 &#8220;사람 목록&#8221;이라는 제목과 함께 `$result`의 내용물이 출력된다. `null`, `true`, `false`인 경우엔 각각 아래처럼 표시해 준다.

    `null`
    `(bool) true`
    `(bool) false`
    

\`까지 표시된다는 말이다. 이상. 코드는 아래와 같다.

    /**
    * 변수의 구성요소를 리턴받는다.
    */
    function get_printr ($var, $title = NULL, $style = NULL, $title_style = NULL) {
    
        if( ! $style){
            $style = "background-color:#000; color:#00ff00; padding:5px; font-size:14px; margin: 5px 0";
        }
    
        if( ! $title_style){
            $title_style = "color:#fff";
        }
    
        $dump = '';
        $dump .= '<div style="text-align: left;">';
        $dump .= "<pre style='$style'>";
        if ($title) {
            $dump .= "<strong style='{$title_style}'>{$title} :</strong> \n";
        }
        if($var === null){
            $dump .= "`null`";
        }else if($var === true){
            $dump .= "`(bool) true`";
        }else if($var === false){
            $dump .= "`(bool) false`";
        }else{
            $dump .= print_r($var, TRUE);
        }
        $dump .= '</pre>';
        $dump .= '</div>';
        return $dump;
    }
    
    /**
    * 변수의 구성요소를 출력한다.
    */
    function printr ($var, $title = NULL, $style = NULL, $title_style = NULL) {
        $dump = get_printr($var, $title, $style, $title_style);
        echo $dump;
    }
    
    /**
    * 변수의 구성요소를 출력하고 멈춘다.
    */
    function printr2 ($var, $title = NULL, $style = NULL, $title_style = NULL) {
        printr($var, $title,  $style, $title_style);
        exit;
    }
    
    /**
    * printr은 임시로 쓰고 지우는 놈인데 이놈은 코드 안에 남겨 둘 생각으로 만든 놈.
    * @param $var
    * @param null $title
    */
    function debug_print($var, $title = NULL){
        $style = "background-color: #ddd; color: #000; padding: 5px; font-size: 14px; margin: 5px 0";
        $title_style = "color: darkred;";
        printr($var, $title, $style, $title_style);
    }
    
    function get_debug_print($var, $title = NULL){
        $style = "background-color: #ddd; color: #000; padding: 5px; font-size: 14px; margin: 5px 0";
        $title_style = "color: darkred;";
        return get_printr($var, $title, $style, $title_style);
    }

 [1]: http://php.net/manual/kr/function.print-r.php
 [2]: http://kr1.php.net/manual/kr/function.var-dump.php