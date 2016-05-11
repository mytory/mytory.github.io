---
title: ckeditor에서 jquery ajaxform 사용하게 해 주는 플러그인
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/113
aktt_notify_twitter:
  - yes
daumview_id:
  - 37215732
categories:
  - 서버단
tags:
  - 'FCKEditor &amp; CKEditor'
---
[ckeditor][1]는 엄청 유명한 위지윅 에디터인 fckeditor가 새단장을 한 최신버전이다. fckeditor를 완전히 자바스크립트로만 구현했고, 코어와 플러그인을 구분해서 속도를 향상시켰다고 한다.([ckeditor 데모][2])

다만, 단점이 있는데 file manager가 없다는 점이다. fckeditor에는 파일 매니저가 기본으로 들어있다. 그래서 그림 첨부 같은 것을 할 때, 아래처럼 탐색을 할 수 있었는데, ckeditor에서는 [ckfinder라는 프로그램][3]을 설치해야 한다. 그런데 이건 라이센스가 있는 프로그램이다. 돈 주고 사야 한다.([ckfinder 가격][4])

<img src="/uploads/legacy/old-images/1/cfile10.uf.205F1D504D4BC87224E8D0.png" class="aligncenter" width="580" height="455" alt="" />

어쨌든, 각설하고. 

ckeditor를 사용할 때 ajax로 입력을 하면, 엥- 전송이 안 되는 현상을 발견할 수 있다.(정확히 말하면 난 jquery에서 공식 form 플러그린을 사용했다. 그런데 ajaxForm() 메서드가 안 먹는 것을 알 수 있었다.)

이걸 해결해 주는 플러그인이라고 한다. [예제][5], [사용법][6], [다운로드][7] 모두 나와 있으니 다운받아 사용하면 될 것.

<http://www.fyneworks.com/jquery/CKEditor/>

 [1]: http://ckeditor.com/
 [2]: http://ckeditor.com/demo
 [3]: http://ckfinder.com/
 [4]: http://ckfinder.com/purchase
 [5]: http://www.fyneworks.com/jquery/CKEditor/
 [6]: http://www.fyneworks.com/jquery/CKEditor/#tab-Usage
 [7]: http://www.fyneworks.com/jquery/CKEditor/#tab-Download