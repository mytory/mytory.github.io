---
title: '[북마클릿] GitHub에 있는 MarkDown 파일을 프린트하게 좋게 만드는 Bookmarklet'
author: 안형우
layout: post
permalink: /archives/10052
daumview_id:
  - 44106592
categories:
  - 기타
tags:
  - TIP
---
북마클릿은 즐겨찾기에 등록해서 자바스크립트를 사용할 수 있게 해 주는 놈이다. 클릭하면 기능이 실행된다. 여튼, 북마클릿 원리 설명하는 글은 아니니 패스하고. (생각해 보니 원리 설명글도 하나 있으면 좋겠다는 생각이 든다.)

GitHub는 markdown 파일을 깔끔한 포맷으로 출력해 준다. 요새 [GitHub에 세미나 자료를 축적][1]하고 있는데, GitHub 페이지에서 markdown 파일을 바로 출력하려고 했더니 외장 요소가 다 같이 출력돼 나오려고 하는 거다. 그래서 내용만 남기고 나머지는 다 날려 버리는 북마클릿을 만들었다.

<pre>javascript:(function(){$(".pagehead, .header, .file-history-tease, .breadcrumb, .file .meta, #footer").remove();$(".file").css("border","none");$(".entry-content p").css({margin:0,"text-indent":"1em"});$(".entry-content").css("color","#000")})()</pre>

추가로 `p`는 마진을 다 없애고 붙여 버리며, 들여쓰기를 해 준다. 위 코드로 북마크(즐겨찾기)를 만들고 GitHub의 md 파일을 보는 곳에서 북마클릿을 실행하면 내용만 남는다. 그냥 아래 링크를 북마크바에 직접 끌어다 놔도 된다.

<p style="text-align: center;">
  <a href="javascript:(function(){$('.pagehead, .header, .file-history-tease, .breadcrumb, .file .meta, #footer').remove();$('.file').css('border','none');$('.entry-content p').css({'margin':0, 'text-indent':'1em'})}());">GitHub Printable</a>
</p>

## 코드 설명

<pre>javascript:(function () {
  $('.pagehead, .header, .file-history-tease, .breadcrumb, .file .meta, #footer').remove();
  $('.file').css('border', 'none');
  $('.entry-content p').css({'margin': 0, 'text-indent': '1em'});
  $('.entry-content').css('color', '#000');
}());</pre>

첫 줄은 그냥 내용 외 요소를 다 날려 버리는 스크립트다. `$`는 당연히 `jQuery`다. GitHub가 jQuery를 사용하고 있어서 다행이었다.

둘째 줄은 `border`가 출력되지 않게 처리하는 놈이고, 셋째 줄은 `p`의 마진을 없애고 들여쓰기를 해 주는 놈이다.

넷째 줄은 글자를 검정색으로 바꿔 준다.

앞으로 GitHub에 올라온 쓸만한 마크다운 글들을 쉽게 출력해서 볼 수 있겠다.

 [1]: https://github.com/left21wm/dev-sharing