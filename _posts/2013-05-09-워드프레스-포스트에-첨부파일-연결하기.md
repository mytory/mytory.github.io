---
title: '[워드프레스] 포스트에 첨부파일 연결하기'
author: 안형우
layout: post
permalink: /archives/10104
daumview_id:
  - 44364590
categories:
  - WordPress
tags:
  - WordPress Tip
---
<pre>$attach_id = wp_insert_attachment($attachment, $uploaded['file'], $post_id);</pre>

이렇게 사진 정보를 넣을 때 3번째 인자값으로 원하는 post의 id를 적어 주면 된다. 그러면 첨부파일이 해당 포스트에 연결된다.

`$uploaded['file']`은 `wp_handle_upload()`의 결과물이다.

관리자 페이지 미디어 항목의 해당 파일에 가 보면 확인할 수 있다.

또한 이렇게 연결한 놈을 클라이언트쪽에서 불러오려면 아래 코드를 참고하면 된다.

    $args = array(
        'post_type' => 'attachment',
        'numberposts' => null,
        'post_status' => null,
        'post_parent' => $post->ID
    );
    $attachments = get_posts($args);
    
    if($attachments){?>
        <p>
            첨부파일 :
            <a href="<?=wp_get_attachment_url($attachments[0]->ID)?>">
                <?=apply_filters('the_title', $attachments[0]->post_title);?>
            </a>
        </p>
    <?}?>