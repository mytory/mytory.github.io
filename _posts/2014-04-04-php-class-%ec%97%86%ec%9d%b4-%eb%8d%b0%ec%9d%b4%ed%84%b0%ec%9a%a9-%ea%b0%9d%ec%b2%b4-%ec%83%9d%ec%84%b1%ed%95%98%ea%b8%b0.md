---
title: '[PHP] Class 없이 데이터용 객체 생성하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12844
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12844-php-create-object-without-class.md
categories:
  - 서버단
tags:
  - PHP
---
가끔 예외 처리 등을 위해서 데이터만 들어있는 객체를 생성해야 할 때가 있다. 이런 경우 Class까지 만드는 건 프로젝트의 구조를 혼란스럽게 만든다. 일반적으로 사용하지도 않을 클래스를 만드는 것이니 말이다. 이런 경우 간단하게 배열을 객체로 변환해서 사용하면 된다. 방법은 간단한다.

    if( ! $user){
        $user = (object) array(
            'data' => (object) array(
                'ID' => $reg->post_author,
                'user_login' => "삭제된 사용자",
                'user_email' => "삭제된 사용자",
                'display_name' => mb_substr($reg->post_title, 1, 3, "utf-8")
            )
        );
    }
    

위 코드는 내가 실제로 사용한 코드다.

**즉, `array`를 만들고 앞에 `(object)`라고 써서 데이터 타입을 변환해 주면 된다.** 객체를 배열로 만들고 싶을 때는 반대로, `(array)`라고 써 주면 된다.