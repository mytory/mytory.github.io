---
title: 워드프레스 글 쓸 때 링크 거는 게 작동하지 않는다면?
author: 안형우
layout: post
permalink: /archives/1863
aktt_notify_twitter:
  - yes
daumview_id:
  - 36668730
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스에서 글을 쓰는데 어느 순간부터 링크 버튼이 작동하지 않았다. 에디터 모드와 HTML 모드 모두에서 말이다.

그래서 검색해 봤다. 나 같은 경우야 프로그래머니까 에러메세지로 찾았다.

일반인들에겐 별 소용 없겠지만, 그래도 에러메세지도 여기 쓴다.

<pre>tinyMCEPopup is not defined.</pre>

[검색을 해 봤더니 답이 나왔다.][1]

애드블럭 때문이었다. 저 변수 이름에 Popup이라는 단어가 포함돼 있어서 애드블럭이 차단한 모양이다.

이런 경우 해결책은 애드블럭 화이트리스트에 내 블로그의 관리자모드를 추가해 주는 거다.

그래서 나 같은 경우는 화이트리스트에 아래 문자열을 추가했다.

<pre>mytory.net/wp-admin/</pre>

<div style="width: 509px" class="wp-caption aligncenter">
  <img src="https://dl.dropbox.com/u/15546257/blog/mytory/add-whitelist-to-adblock.png" alt="" width="499" height="512" /><p class="wp-caption-text">
    이 이미지엔 mytory.net 을 넣은 걸로 돼 있는데 나중에 mytory.net/wp-admin/ 으로 수정했다. 내 글엔 애드센스가 달려 있는데 내가 실수로 클릭할 수도 있기 때문에 광고를 제거한다. 그래서 관리자모드에서만 애드블럭이 작동하지 않게 만들려면 관리자모드 URL을 적어 줘야 한다.
  </p>
</div>

<p style="text-align: left;">
  이렇게 하면 글을 쓸 때 다시 링크 버튼이 작동한다.
</p>

 [1]: http://wordpress.org/support/topic/cant-use-insertedit-link-in-visual-mode-tinymcepopup-is-not-defined#post-1136211