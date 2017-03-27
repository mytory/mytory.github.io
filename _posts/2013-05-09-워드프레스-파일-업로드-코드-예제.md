---
title: '[워드프레스] 파일 업로드 코드 예제'
author: 안형우
layout: post
permalink: /archives/10107
daumview_id:
  - 44362917
categories:
  - WordPress
tags:
  - WordPress Tip
---
말 그대로 예제다. 시간이 없어서 설명은 생략하고 코드만.

<pre><code class="php">if( ! empty($_FILES)){
  $wp_upload_dir = wp_upload_dir();

  require_once(ABSPATH . 'wp-admin/includes/file.php');
  $fileinfo = wp_handle_upload($_FILES['첨부파일'], array('test_form' =&gt; FALSE ));
  $wp_filetype = wp_check_filetype(basename($fileinfo['file']), null );

  $attachment = array(
    'guid' =&gt; $wp_upload_dir['url'] . '/' . basename($fileinfo['file']),
    'post_mime_type' =&gt; $wp_filetype['type'],
    'post_title' =&gt; preg_replace('/\.[^.]+$/', '', basename($fileinfo['file'])),
    'post_content' =&gt; '',
    'post_status' =&gt; 'inherit'
  );

  $attach_id = wp_insert_attachment( $attachment, $fileinfo['file'], $post_id);

  require_once(ABSPATH . 'wp-admin/includes/image.php');
  $attach_data = wp_generate_attachment_metadata( $attach_id, $fileinfo['file'] );
  wp_update_attachment_metadata( $attach_id, $attach_data );
}</code></pre>

클라이언트 쪽은 다음 코드를 참고. 역시 시간이 없어서 `foreach`를 못 돌렸다. 알아서 돌리길.

<pre><code class="php">$args = array(
  'post_type' =&gt; 'attachment',
  'numberposts' =&gt; null,
  'post_status' =&gt; null,
  'post_parent' =&gt; $post-&gt;ID
);
$attachments = get_posts($args);

if($attachments){?&gt;
  &lt;p&gt;
    첨부파일 :
    &lt;a href="&lt;?=wp_get_attachment_url($attachments[0]-&gt;ID)?&gt;"&gt;
      &lt;?=apply_filters('the_title', $attachments[0]-&gt;post_title);?&gt;
    &lt;/a&gt;
  &lt;/p&gt;
&lt;?}?&gt;</code></pre>