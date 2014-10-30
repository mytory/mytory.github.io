---
title: 윈도우7, 권한이 없다며 프로그램 설치가 안 될 때 You may not have the necessary permissions to use all the features of the program you are about to run.
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1871
aktt_notify_twitter:
  - yes
daumview_id:
  - 36667491
categories:
  - 기타
tags:
  - TIP
---
오늘 뭔가를 설치하려고 exe 확장자를 가진 놈을 실행했더니 위와 같은 창이 뜨면서 설치가 안 됐다.

전에도 몇 번 나를 귀찮게 한 적이 있었기 때문에, 검색을 해 봤다.

그리고 역시나 또 답을 찾았다. [파이어폭스가 설치되지 않는다는 질문에 대한 답][1]이었다. 증상은 나랑 같았다.

답은 이랬다.

> 1.  시작 버튼을 눌러라.
> 2.  검색 박스에 UAC 라고 써라.
> 3.  &#8216;사용자 계정 컨트롤 설정 변경&#8217;을 클릭해라.
> 4.  만약 현재 값이 기본값으로 설정돼 있다면, 알리지 않음으로 만들어라.(맨 밑으로 드래그하면 된다.) 그리고 확인을 눌러라.
> 5.  만약 현재 값이 알리지 않음으로 돼 있다면, 기본값으로 변경해라.
> 6.  변경 후 확인을 누르고 나간 다음에는 다시 원하는 값으로 변경해도 된다. (기본값이든 알리지 않음이든)
> 7.  이렇게 한 다음, 프로그램을 설치해 봐라.

뭐, 버그나 이런 건가 보다.

여튼 성가신 문제가 해결됐다.

<div style="width: 770px" class="wp-caption aligncenter">
  <img src="https://dl.dropbox.com/u/15546257/blog/mytory/window-user-account-control.jpg" alt="" width="760" height="560" /><p class="wp-caption-text">
    왼쪽 눈금에 있는 놈을 드래그해서 설정값을 변경하고 확인을 누르면 된다.
  </p>
</div>

 [1]: http://www.fixkb.com/2010/10/you-may-not-have-necessary-permissions.html