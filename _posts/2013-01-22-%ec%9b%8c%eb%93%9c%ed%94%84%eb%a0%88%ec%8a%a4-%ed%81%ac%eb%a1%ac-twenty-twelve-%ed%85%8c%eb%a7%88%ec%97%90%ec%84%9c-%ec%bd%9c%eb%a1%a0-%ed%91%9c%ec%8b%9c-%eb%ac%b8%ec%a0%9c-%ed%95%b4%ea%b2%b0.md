---
title: '[워드프레스] 크롬, Twenty Twelve 테마에서 :(콜론) 표시 문제 해결 &#8211; text-rendering: optimizeLegibility'
author: 안형우
layout: post
permalink: /archives/9225
daumview_id:
  - 39317549
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스의 새 기본 테마인 Twenty Twelve 테마는 멋지다. Minimalism이라고나 할까.

근데 크롬에서 한글에 :표시가 되는 문제가 있다. 아래 이미지 참고.

<img class="aligncenter" alt="" src="/uploads/legacy/twenty-twelve-colon-problem.png" width="656" height="190" />

이걸 해결하려면, `wp-content/themes/twentytwelve/style.css` 파일을 열어서 아래 코드를 찾는다. 484번째 줄이다.

<pre>body {
  font-size: 14px;
  font-size: 1rem;
  font-family: Helvetica, Arial, sans-serif;
  /* text-rendering: optimizeLegibility; */
  color: #444;
}</pre>

그리고 위에 표시된 것처럼 `text-rendering: optimizeLegibility;` 앞뒤로 `/*`와 `*/`를 넣어서 주석 처리를 한다. (아니면 그냥 그 줄을 지우면 된다.) 그러면 더이상 콜론이 생기지 않는다.

## text-rendering: optimizeLegibility

[text-rendering: optimizeLegibility][1]라는 CSS 속성은 비표준 속성인데, 크롬과 파폭에서 지원한다. Legibility는 가독성이란 뜻이다. 즉, 텍스트를 렌더링할 때 가독성을 최적화해서 렌더링하라는 속성이다. 이 옵션을 줬을 때 영어에서 결과물은 아래와 같다. Live Example 표에서 3번째 줄과 4번째 줄을 비교하면 어떤 차이가 생기는지 알 수 있다.

<img class="aligncenter" alt="" src="/uploads/legacy/css-text-rendering.png" width="652" height="415" />

영어 YoW의 간격이 읽기 좋게 조정되는 걸 볼 수 있다.

그런데 한글에서는 이런 게 없고, 굴림체에서는 이상한 현상만 발생하게 되는 거다. 그나마 IE에서는 이 속성 자체를 지원하지 않으니까 아무 이상이 안 생기는 거고, 크롬에서는 이 속성을 지원하는데 뭔가 버그가 있으니까 문제가 생기는 것이다. (파폭은 이 속성을 지원하지만, :이 생기지 않는다.)

이상이다.

## 참고

이 글은 [&#8216;Twenty Twelve 테마에서 한글이 이상하게 보일때 (콜론(:)이 생길 때)&#8217;][2]와 [Mozilla 개발자 네트워크 : text-rendering][1]을 참고해서 썼다.

&nbsp;

 [1]: https://developer.mozilla.org/ko/docs/CSS/text-rendering
 [2]: http://www.tigiminsight.com/119