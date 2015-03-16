---
title: "서버에서 메일 보낼 때 이메일 제목 깨짐 현상 방지하기"
layout: "post"
category: "php"
tags: 
    - snippet
---

아이폰 등에서 한글 이메일 제목이 깨져 날아오는 현상을 봤을 것이다. 본문 인코딩을 지정해 줘도 제목은 깨진다. 아래 코드 조각을 사용하면 그런 현상을 막을 수 있다.

    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

제목을 base64로 인코딩하고 앞뒤에 캐릭터셋을 명시해 준 것이다. `=?UTF-8?B?`과 `?=`이 그것이다. 이건 그냥 규약이니 외우자.

참고한 글은 ['PHP 메일 한글 제목 깨짐 현상'](http://keepingstar.tistory.com/22)이다.