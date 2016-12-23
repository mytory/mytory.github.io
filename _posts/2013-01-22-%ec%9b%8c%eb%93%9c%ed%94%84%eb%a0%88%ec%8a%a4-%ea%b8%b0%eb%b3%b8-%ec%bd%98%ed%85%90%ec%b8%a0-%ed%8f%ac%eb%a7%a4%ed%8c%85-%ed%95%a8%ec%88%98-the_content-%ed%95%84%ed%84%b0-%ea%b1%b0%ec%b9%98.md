---
title: '[워드프레스] 기본 콘텐츠 포매팅 함수 &#8211; the_content 필터 거치지 않고 the_content 효과 내기'
author: 안형우
layout: post
permalink: /archives/9232
daumview_id:
  - 39348474
categories:
  - WordPress
tags:
  - WordPress Tip
---
이거 뭐라고 표현해야 할지 모르겠는데 여튼간에, 기본 콘텐츠 포매팅 함수라고 대충 써 봤다. 그니까 뭐냐면&#8230; 각종 플러그인들이 `the_content()`를 건드리기 전의 순수한 `the_content()`를 말하는 거다.

예컨대, 팝업을 띄운다고 하자. 내용을 입력하고 첫 화면에 띄우고 싶다. 그런데 줄바꿈 한 건 `p`로 감싸고 싶고, SNS 버튼 플러그인이 붙여 준 SNS 버튼은 떼버리고 싶다. 어떻게 해야 할까? `the_content` 필터를 통과시키면 SNS 버튼이 붙어 버리고, 통과시키지 않으면 줄바꿈이 되지 않는다! 줄바꿈뿐이 아니다. 큰따옴표도 제대로 표현되지 않고, 워드프레스가 제공하는 Content Formatting에 관련한 여러 가지 효과를 모두 제대로 사용할 수 없게 된다. SNS 버튼 플러그인 때문에!

방법이 있다. 워드프레스는 Open Source니 검색을 했다. `the_content`로 전체 파일 검색을 한 거다. 그러니, `the_content` 필터에 기본 세팅되는 함수들을 찾을 수 있었다.(워드프레스 3.5 기준 `wp-includes/default-filters.php` 파일의 135라인) 그렇다. 이 함수들을 그냥 주욱 써 주면 되는 것이다.

아래 코드처럼 써 주면 된다.

<pre>$popover_content = wptexturize($popover_content);
$popover_content = convert_smilies($popover_content);
$popover_content = convert_chars($popover_content);
$popover_content = wpautop($popover_content);
$popover_content = shortcode_unautop($popover_content);
$popover_content = prepend_attachment($popover_content);
echo $popover_content;</pre>

각 함수들의 설명은 워드프레스 코드를 뜯어 보면 나온다. 이클립스에서 코드 점프 하면 된다. 내가 궁금했던 건 단순 줄바꿈을 `br`과 `p` 태그로 변경해 주는 거였는데, 그 함수는 `wpautop()`였다. `wptexturize()`는 `'`와 `"`를 `‘`,`’`와 `“`,`”`로 바꿔 주는 함수다.

뭐, 이정도면 됐겠지?