---
title: '[워드프레스 코드조각] 잠긴글 앞에 붙는 &#8216;잠긴 글&#8217;이라는 글자 떼고 아이콘 붙이기'
author: 안형우
layout: post
permalink: /archives/10517
daumview_id:
  - 47531955
categories:
  - WordPress
tags:
  - WordPress Tip
---
시간이 없어서 코드만.

<pre>function protected_title(){
    global $post;
    $lock_icon = "&lt;i class='icon icon--lock-16'&gt;&lt;/i&gt;";
    return $lock_icon . $post-&gt;post_title;
}
add_filter('protected_title_format', 'protected_title');</pre>

아이콘 스타일은 아래를 참고해서 하면 될 거다.

<pre>.icon {
    margin-right: 0.5em;
    display: inline-block;
    *display: inline;
    *zoom: 1;
}

.icon--lock-16 {
    background: url("images/icon_lock_16.png") 0 0 no-repeat;
    width: 16px;
    height: 16px;
    vertical-align: middle;
}</pre>