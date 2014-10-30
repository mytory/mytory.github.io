---
title: '[워드프레스] 이미지 썸네일 만들어서 URL 가져오는 함수'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10164
daumview_id:
  - 44914461
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스는 썸네일이 없는 경우 그냥 전체 사이즈 이미지를 리턴한다. 그러면 한 2000픽셀짜리 이미지를 HTML에서 100px로 렌더링하는 비극적인 사태가 벌어진다. 이미지 썸네일 목록이라면 한 페이지에서 30MB를 다운로드하게 될 지도 모른다.

그러니 그런 사태를 방지하기 위해서는 HTML에서 보여 줄 사이즈에 딱 맞는 썸네일을 서버에서 생성한 뒤 URL을 돌려 줘야 한다. 그걸 해 주는 함수다. 인자값은 첨부파일의 `$post_id`(워드프레스에선 첨부파일 정보도 post 테이블에 저장된다.), 원하는 너비와 높이다.

<pre>function mytory_get_thumb_src($attachment_id, $width, $height){
    $filepath = get_attached_file($attachment_id);
    $upload_path = wp_upload_dir();
    $basedir = $upload_path['basedir'];

    // filepath가 $basedir까지 포함하고 있는 경우가 있음.
    $filepath = str_replace($basedir, '', $filepath);
    $fullpath = $basedir . $filepath;
    if( ! is_file($fullpath)){
        return FALSE;
    }
    $pathinfo = pathinfo($fullpath);
    $new_fullpath = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . "-{$width}x{$height}" . '.' . $pathinfo['extension'];
    if( ! is_file($new_fullpath)){
        $image = wp_get_image_editor($fullpath);
        if ( ! is_wp_error( $image ) ) {
            $image-&gt;resize( $width, $height, false );
            $image-&gt;save( $new_fullpath );
        }
    }
    $new_filepath = str_replace($basedir, '', $new_fullpath);
    return $upload_path['baseurl'] . $new_filepath;
}</pre>

또한, 워드프레스에서 이미지를 갖고 작업할 때는 `$image = wp_get_image_editor($fullpath);`로 시작을 한다. 이 함수는 [WP\_Image\_Editor][1] 클래스를 반환하는데, 이 클래스는 이미지를 아주 쉽게 편집할 수 있도록 API가 매우 잘 정리돼 있다.

 [1]: http://codex.wordpress.org/Class_Reference/WP_Image_Editor