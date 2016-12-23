---
title: '[워드프레스 코드조각] 멀티링규얼 프레스 글들 한 방에 연결하기'
author: 안형우
layout: post
permalink: /archives/10506
daumview_id:
  - 47495203
categories:
  - WordPress
tags:
  - WordPress Tip
---
멀티링규얼 프레스는 내가 보기에 가장 깔끔한 다국어 사이트 운영 플러그인이다. 기본 기능은 공짜로 사용할 수 있다. 이미 운영중인 사이트를 다른 언어로 내고 싶은데, 페이지를 모두 연결해야 한다면 아래 코드를 분석해서 사용하면 된다. 

멀리팅규얼 프레스 사용자라면 연결한다는 게 무슨 의미인지 알 거고, 일일이 연결하는 게 얼마나 노가다인지도 알 거다.

아래는 완전히 예제 코드다. 보고 분석해서 사용해야 한다.

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );
    
    $wp_query = new WP_Query($args);
    
    $m = new Multilingual_Press();
    
    foreach ($wp_query->posts as $post) {
        $postdata = array(
            'post_title' => $post->post_title,
            'post_content' => $post->post_content,
            'post_author' => $post->post_author,
            'post_type' => $args['post_type'],
            'post_status' => 'draft',
            'post_name' => $post->post_name,
        );
        $meta_keys = array(
            'product_detail',
            'packing_method',
            'volume',
            'flavor',
            'usage__dosage',
            'efficacy__effect',
            'ingredients',
        );
        $metas = get_post_meta($post->ID);
    
        switch_to_blog(3);
        $post_id = wp_insert_post($postdata);
        foreach ($meta_keys as $key) {
            update_post_meta($post_id, $key, $metas[$key][0]);
        }
        switch_to_blog(1);
    
        $m->set_linked_element($post->ID, $post->ID, 1, '', 1);
        $m->set_linked_element($post_id, $post->ID, 1, '', 3);
    }