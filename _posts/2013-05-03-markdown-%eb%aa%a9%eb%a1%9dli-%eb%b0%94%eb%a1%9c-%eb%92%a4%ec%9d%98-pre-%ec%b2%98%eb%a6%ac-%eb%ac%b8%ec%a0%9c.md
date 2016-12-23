---
title: MarkDown, 목록(li) 바로 뒤의 pre 처리 문제
author: 안형우
layout: post
permalink: /archives/10048
daumview_id:
  - 44105430
categories:
  - 기타
tags:
  - TIP
---
다음과 같은 마크다운 문서가 있다.

<pre>- `data-action` 어트리뷰트가 어떤 자바스크립트 코드를 호출할지 결정한다.
- 버튼을 클릭하면 버튼의 아이디를 토대로 메뉴를 찾는다.

    $('#btn-new').click(function(){
        $(this).addClass('is-pressed');
        $('#menu-' + $(this).id.substr(4)).removeClass('is-hidden');
    });</pre>

목록 뒤엔 네 칸을 띄운 코드가 들어가 있으니 `pre`요소로 표시돼야 할 거다. 그런데 왠걸, 그렇지 않고 `p`로 감싸 버린다. 그래서 고정폭 글꼴로 나오지도 않고, 심지어 한 줄로 나와 버린다. ([구글에서 markdown online으로 검색][1]해서 아무데나 들어간 다음 테스트해 보면 될 거다.)

왜일까? 검색을 해서 대충 알아 보니 `li` 뒤에 한 줄 띄고 처음 오는 줄은 p로 감싸는 게 마크다운의 원래 규칙이라고 한다.

> If list items are separated by blank lines, Markdown will wrap the items in `<p>` tags in the HTML output.
> 
> &#8211; [Answer to &#8220;Markdown formatting bug with code blocks in lists&#8221;][2]

## 해결책은?

그래, 뭐 그게 원래 규칙이라고 하고. 그럼 어쩌라는 건가?

뭐, 공백줄을 넣지 않고 그냥 엔터 한 번 치는 것도 방법이긴 한데, 그러면 `li`에 딸린 것처럼 보일 것이다.

그렇다면 해결책은?! 나는 그냥 간단히 해결하기로 했다. `pre` 태그로 감싸는 거다. 간결한 마크다운 문법을 희생하는 것처럼 보이겠지만, 이걸 해결하느라 내용을 고치거나, 편법을 쓰는 것보다는 `pre` 태그로 감싸 버리는 게 나에겐 더 간결하게 느껴진다. 공백없이 HTML을 사용하면 마크다운 파싱을 하지 않는다.

그래서 수정하면 다음과 같다.

<pre>- `data-action` 어트리뷰트가 어떤 자바스크립트 코드를 호출할지 결정한다.
- 버튼을 클릭하면 버튼의 아이디를 토대로 메뉴를 찾는다.

&lt;pre&gt;&lt;code&gt;$('#btn-new').click(function(){
    $(this).addClass('is-pressed');
    $('#menu-' + $(this).id.substr(4)).removeClass('is-hidden');
});&lt;/code&gt;&lt;/pre&gt;</pre>

 [1]: https://www.google.co.kr/search?q=markdown+online&aq=f&oq=markdown+online
 [2]: http://meta.stackoverflow.com/questions/19624/markdown-formatting-bug-with-code-blocks-in-lists/74115#74115