---
title: 'CSS3 버튼 &#8211; 워드프레스 Underscores 테마(?)에서 약간 개량'
author: 안형우
layout: post
permalink: /archives/4898
aktt_notify_twitter:
  - yes
aktt_tweeted:
  - 1
daumview_id:
  - 35977871
categories:
  - 웹 퍼블리싱
tags:
  - CSS
  - CSS3
---
CSS3로 버튼을 만들면 깔쌈하게 만들 수 있다. IE7,8에서도 그닥 보기 싫게는 안 나오도록 하면 실전에서 써먹을 수 있다.[ CSS3 버튼만 모아놓은 블로그 글][1]도 있더라.

여튼, 요새 워드프레스로 제빙기 판매 웹사이트를 만들고 있는데, [Underscores][2]라는 워드프레스 테마 제작용 테마에서 출발했다. Underscores는 워드프레스 제작사인 오토매틱에서 제공하는 테마다. 테마 만들기 편하라고 제공하는 거다. 테마 만들기 편하면 사람들이 양질의 테마를 많이 만들 거고, 그러면 워드프레스 생태계가 풍성해지고 뭐 그런 거다.

여튼, 이 테마에 CSS3 버튼이 괜찮더라. 그런데 padding이 너무 넓어서 좀 줄였다. padding이 많이 들어가게 하고 싶다면 big-button 클래스를 붙이면 된다. 내가 손좀 본 거다.

그리고 원래 테마에선 a 태그로 버튼을 만들 수는 없다. 약간 손봤다. a 태그에 css-button 클래스를 붙이면 a 태그도 버튼이 된다. 내 블로그 공유 버튼에 사용하려고 긁어와 봤는데, 작동을 잘 하는 걸 보니 쓸만하다. 이런 모양으로 구현된다.

![][3]

IE7과 8에서 비슷하게 구현하려면 아마 [html5shiv][4]라는 라이브러리를 사용해야 할 거다.

코드는 아래.

<pre class="brush: css; gutter: true; first-line: 1">/* button */
a.css-button,
a.css-button:link,
a.css-button:hover,
a.css-button:active,
a.css-button:visited {
	color: black;
	text-decoration: none;
}
a.css-button,
button,
input,
select,
textarea {
	font-size: 100%; /* Corrects font size not being inherited in all browsers */
	margin: 0; /* Addresses margins set differently in IE6/7, F3/4, S5, Chrome */
	vertical-align: baseline; /* Improves appearance and consistency in all browsers */
	*vertical-align: middle; /* Improves appearance and consistency in all browsers */
}
a.css-button,
button,
input {
	line-height: normal; /* Addresses FF3/4 setting line-height using !important in the UA stylesheet */
	*overflow: visible;  /* Corrects inner spacing displayed oddly in IE6/7 */
}
a.css-button,
button,
html input[type="button"],
input[type="reset"],
input[type="submit"] {
	border: 1px solid #ccc;
	border-color: #ccc #ccc #bbb #ccc;
	border-radius: 3px;
	background: #e6e6e6;
	-webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5), inset 0 15px 17px rgba(255,255,255,0.5), inset 0 -5px 12px rgba(0,0,0,0.05);
	-moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5), inset 0 15px 17px rgba(255,255,255,0.5), inset 0 -5px 12px rgba(0,0,0,0.05);
	box-shadow: inset 0 1px 0 rgba(255,255,255,0.5), inset 0 15px 17px rgba(255,255,255,0.5), inset 0 -5px 12px rgba(0,0,0,0.05);
	color: rgba(0,0,0,.8);
	cursor: pointer; /* Improves usability and consistency of cursor style between image-type &#039;input&#039; and others */
	-webkit-appearance: button; /* Corrects inability to style clickable &#039;input&#039; types in iOS */
	font-size: 12px;
	line-height: 1;
	padding: 3px 10px;
	text-shadow: 0 1px 0 rgba(255,255,255,.8);
}
a.css-button.big-button,
button.big-button,
html input[type="button"].big-button,
input[type="reset"].big-button,
input[type="submit"].big-button {
	padding: 1em 1.5em;
}
a.css-button:hover,
button:hover,
html input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover {
	border-color: #ccc #bbb #aaa #bbb;
	-webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), inset 0 15px 17px rgba(255,255,255,0.8), inset 0 -5px 12px rgba(0,0,0,0.02);
	-moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), inset 0 15px 17px rgba(255,255,255,0.8), inset 0 -5px 12px rgba(0,0,0,0.02);
	box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), inset 0 15px 17px rgba(255,255,255,0.8), inset 0 -5px 12px rgba(0,0,0,0.02);
}
a.css-button:focus,
button:focus,
html input[type="button"]:focus,
input[type="reset"]:focus,
input[type="submit"]:focus,
button:active,
html input[type="button"]:active,
input[type="reset"]:active,
input[type="submit"]:active {
	border-color: #aaa #bbb #bbb #bbb;
	-webkit-box-shadow: inset 0 -1px 0 rgba(255,255,255,0.5), inset 0 2px 5px rgba(0,0,0,0.15);
	-moz-box-shadow: inset 0 -1px 0 rgba(255,255,255,0.5), inset 0 2px 5px rgba(0,0,0,0.15);
	box-shadow: inset 0 -1px 0 rgba(255,255,255,0.5), inset 0 2px 5px rgba(0,0,0,0.15);
}</pre>

 [1]: http://zoomzum.com/10-latest-css3-buttons-with-source-code/ "10 Latest CSS3 Buttons With Source Code"
 [2]: http://underscores.me/ "Underscores | A Starter Theme for WordPress"
 [3]: /uploads/legacy/underscores-css3-button.png
 [4]: https://github.com/aFarkas/html5shiv