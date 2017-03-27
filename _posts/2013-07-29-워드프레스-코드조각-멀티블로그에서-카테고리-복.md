---
title: '[워드프레스 코드조각] 멀티블로그에서 카테고리 복사 뜨기'
author: 안형우
layout: post
permalink: /archives/10601
daumview_id:
  - 48815277
  - 48815277
categories:
  - WordPress
tags:
  - WordPress Tip
---
그냥 코드에 불과하니 알아서 응용할 것.

<pre>$from_blog_id = 1;
$to_blog_id = 2;

switch_to_blog($from_blog_id);
$cats = get_categories();

switch_to_blog($to_blog_id);
foreach ($cats as $c) {
    $cat_id = wp_insert_term($c-&gt;name, 'category');
    echo var_dump($cat_id);
}</pre>