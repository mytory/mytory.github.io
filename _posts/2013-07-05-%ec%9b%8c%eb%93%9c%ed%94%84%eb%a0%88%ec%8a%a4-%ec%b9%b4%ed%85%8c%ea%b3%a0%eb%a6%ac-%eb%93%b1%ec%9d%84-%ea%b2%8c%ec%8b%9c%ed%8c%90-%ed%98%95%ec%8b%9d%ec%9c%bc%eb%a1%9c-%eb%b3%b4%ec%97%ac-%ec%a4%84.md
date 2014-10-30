---
title: '[워드프레스] 카테고리 등을 게시판 형식으로 보여 줄 때 앞에 붙일 번호에 사용할 숫자를 가져 오는 함수'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10502
daumview_id:
  - 47481390
categories:
  - WordPress
tags:
  - WordPress Tip
---
<pre>if( ! function_exists('fu_get_count_no')){

   /**
    * 카테고리 등을 게시판 형식으로 보여 줄 때 앞에 붙일 번호에 사용할 숫자를 가져 오는 함수다.
    * 맨 윗쪽에 붙일 번호를 가져오므로, 루프돌면서 $count_no-- 를 해 주면 된다.
    * @return mixed
    */
    function fu_get_count_no(){
        global $wp_query;
        $paged = ( $wp_query-&gt;query_vars['paged'] ? $wp_query-&gt;query_vars['paged'] : 1 );
        return $wp_query-&gt;found_posts - ( $wp_query-&gt;query_vars['posts_per_page'] * ($paged - 1) );
    }
}</pre>