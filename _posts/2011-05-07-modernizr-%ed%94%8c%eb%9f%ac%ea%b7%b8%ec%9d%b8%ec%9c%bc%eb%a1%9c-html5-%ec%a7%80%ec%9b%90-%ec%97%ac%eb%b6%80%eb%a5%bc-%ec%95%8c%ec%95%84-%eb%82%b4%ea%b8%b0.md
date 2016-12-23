---
title: Modernizr 라이브러리로 브라우저의 HTML5 지원 여부 알아 내기 + 플레이스 홀더
author: 안형우
layout: post
permalink: /archives/1213
aktt_notify_twitter:
  - yes
daumview_id:
  - 36724485
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
**요약: [Modernizr를 다운로드][1]한 뒤 헤더에 삽입하고, js 쪽에서 `if(Modernizr.input.placeholder == false){ /*브라우저가 HTML5 플레이스 홀더 기능을 지원하지 않을 때 사용할 코드를 넣는다*/}` 형식으로 사용한다.**

## 어쩌다 Modernizr를 사용하게 됐는가?

새로 제작하는 웹사이트에 야심차게 플레이스 홀더 기능을 사용해 보려고 했다.

<div style="width: 225px" class="wp-caption aligncenter">
  <img class=" " src="https://dl.dropbox.com/u/15546257/blog/mytory/placeholder/example.jpg" alt="" width="215" height="94" /><p class="wp-caption-text">
    플레이스 홀더는 인풋 박스 안에 안내문이 떠 있다가 입력을 위해 클릭을 하면 안내문이 사라지는 기능을 말한다. 레이블을 붙이기 위한 공간이 별도로 필요하지 않으므로 공간 활용에 효율적이다.
  </p>
</div>

그런데 HTML5부터는 placeholder 기능을 기본으로 지원한다. 지금 내가 이 글을 쓰면서 사용하고 있는 크롬은 5 beta부터 placeholder 기능을 지원했다고 한다. 파이어폭스도 3.7부터 지원했다.

이렇게 브라우저가 기본적으로 지원하는 경우에는 간단하게 아래처럼 입력하면 된다.

<pre>&lt;input type="text" placeholder="이메일을 입력하세요" name="email"/&gt;</pre>

그런데 당연히 우리의 IE 시리즈는 placeholder 기능을 지원하지 않는다.(IE9도 말이다.)

자, 그럼 이제 js 플러그인을 사용해야 할 때가 왔다.

그런데 기왕이면 HTML5 기능이 있는 브라우저에서는 HTML5 기능을 이용해서 placeholder 를 구현하고, 그렇지 않은 브라우저에서만 js를 이용해서 구현하고 싶다. 그게 사용자들 트래픽에 덜 부담되니 말이다. 구현하는 쪽에서도 브라우저 기본 기능을 이용하면 더 효과적으로 플레이스홀더를 사용할 수 있다.

(플레이스홀더가 날코딩을 하려고 하면 의외로 까다로운 부분이 많다. 일단 input에 포커스가 들어왔을 때 플레이스홀더를 날려야 한다. 아무것도 입력하지 않고 다시 blur가 되면 플레이스홀더를 살려야 한다. 그러나 입력하는 중간에 나가면 플레이스 홀더를 살리면 안 된다. 플레이스홀더로 value를 사용하고, focus 이벤트에 value를 지우게 만들어 두면 안 된다. 뭔가 입력했던 사용자가 수정을 위해 다시 input에 포커스를 주는 순간 사용자가 이미 입력해 둔 게 날아가기 때문이다. 따라서 label 태그의 위치를 조정해서 플레이스 홀더를 만드는 게 좋다고 하는 사람도 있었다.

플레이스 홀더 기능을 다룬 또 하나의 자세한 글은 [Adding Cross Browser Placeholders To Your Form Fields][2])

이럴 때 바로 [Modernizr 라이브러리][1]를 사용하면 된다.([Modernizr 라이브러리를 사용하지 않고 플레이스홀더 기능 지원 여부를 감지하는 방법][3]도 있다.) 플레이스 홀더 기능을 위해서는, jQuery placeholder plugin을 사용했다.(이 라이브러리는 placeholder 어트리뷰트의 값을 value에 집어 넣어서 사용하게 한다. 그런데, 이렇게 처리하는 바람에 만약 필수로 입력해야 하는 경우인 input에 이 라이브러리를 사용하게 되면 IE에서는 사용자가 값을 입력하지 않은 경우에도 밸리데이션을 통과하게 된다. 따라서 따로 조치를 해야 하게 된다.)

(위에서 지적한 jQuery placeholder plugin의 한계를 극복하기 위해서는 [In-Field-Labels-jQuery-Plugin][4] 을 사용해 보는 것도 좋을 것 같다. 이 플러그인은 label 요소를 이용해 플레이스홀더 효과를 낸다. 자바스크립트를 이용하는 것이고, HTML5 네이티브 기능을 이용하지 못한다는 점이 있지만, Modernizr와 섞어서 사용하면 훌륭할 것이다.)

## Modernizr 라이브러리 사용법

Modernizr 라이브러리는 HTML5 기능을 구현해 주는 라이브러리가 아니다. 사용자가 사용중인 브라우저가 HTML5의 특정 기능을 지원하는지 감지해 주는 역할을 한다.

일단 modernizr-x.x.min.js 를 페이지에 불러오면 모든 게 끝이다. 따로 호출해주고 할 게 없다.

그러면 파이어버그를 통해 한 번 보자. 자바스크립트 콘솔을 활성화한 다음, Modernizr 하고 입력하면 Modernizr 객체가 갖고 있는 다양한 변수를 만날 수 있다. 이름이 매우 직관적이므로 골라서 사용하면 된다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/placeholder/modernizr-firebug.jpg" alt="" width="166" height="512" />
</p>

나는 Modernizr.input.placeholder 라고 썼다. 파이어버그 콘솔에서 엔터를 쳐 보면 true나 false를 반환한다는 것을 눈으로 확인할 수 있다.

<p style="text-align: center;">
  <img class="aligncenter" src="https://dl.dropbox.com/u/15546257/blog/mytory/placeholder/modernizr.placeholder.jpg" alt="" width="216" height="266" />
</p>

그러면 이제 사용법을 눈치챘을 거다.

바로 아래와 같은 코드를 사용한다.

<pre class="brush:js">if(Modernizr.input.placeholder == false){
  /*브라우저가 HTML5 플레이스 홀더 기능을
  지원하지 않을 때 사용할 코드를 넣는다*/
}</pre>

나는 jQuery placeholder plugin을 사용했으므로, 아래와 같이 코드를 작성했다.

<pre class="brush:js">if(Modernizr.input.placeholder == false){
	document.write(&#039;&lt;script src="jquery.placeholder.js" type="text/javascript"&gt;&lt;/script&gt;&#039;);
	$("input[placeholder]").placeholder();
}</pre>

`$("input[placeholder]")`는 placeholder라는 어트리뷰트를 가진 input을 선택하는 jQuery 선택자다.

이렇게 하면, 브라우저에 따라 선택적으로 HTML5 기능을 지원하는 걸 훌륭하게 할 수 있다!

물론 자바스크립트를 끄고 들어온다면 좌절이다;; 이상.

## CSS쪽 활용법

또한 Modernizr는 HTML5 지원 여부에 따라 html에 class를 붙여 준다. 당장 파이어폭스4에서 Modernizr를 구동해 보면, 아래처럼 나온다.

<div style="width: 522px" class="wp-caption aligncenter">
  <img class=" " src="https://dl.dropbox.com/u/15546257/blog/mytory/placeholder/modernizr-html-class.jpg" alt="" width="512" height="184" /><p class="wp-caption-text">
    html 태그에 온갖 클래스가 붙은 걸 확인할 수 있다.
  </p>
</div>

no-cssreflections 라는 class가 보일 거다. css reflection 을 지원하지 않는다는 의미로 보면 되겠다.(나도 그게 뭔지는 모른다.)

그럼, CSS쪽에 이런 식으로 적어 주면 되는 거다.

<pre class="brush:css">.no-cssreflections .target {
  /* cssreflections를 지원하지 않는 경우 스타일 */
}
.cssreflections .target {
  /* cssreflections를 지원하는 경우 스타일 */
}</pre>

이상!

역시 더 많은 정보는 [Modernizr Docs][5]를 참고하는 게 좋겠다.

 [1]: http://www.modernizr.com/
 [2]: http://www.webgeekly.com/tutorials/jquery/creating-a-cross-browser-form-field-placeholder/
 [3]: http://www.cssnewbie.com/cross-browser-support-for-html5-placeholder-text-in-forms/
 [4]: https://github.com/dcneiner/In-Field-Labels-jQuery-Plugin/
 [5]: http://www.modernizr.com/docs/