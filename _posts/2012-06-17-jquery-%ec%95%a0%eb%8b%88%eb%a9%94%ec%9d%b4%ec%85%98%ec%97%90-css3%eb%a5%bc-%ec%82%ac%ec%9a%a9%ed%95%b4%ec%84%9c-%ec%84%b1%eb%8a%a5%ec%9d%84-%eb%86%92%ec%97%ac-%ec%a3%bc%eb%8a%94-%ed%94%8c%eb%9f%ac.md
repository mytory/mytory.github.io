---
title: '[jQuery] 애니메이션에 CSS3를 사용해서 성능을 높여 주는 플러그인 &#8211; jquery.animate-enhanced plugin'
author: 안형우
layout: post
permalink: /archives/2628
aktt_notify_twitter:
  - yes
daumview_id:
  - 36598740
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - jQuery
---
CSS3에는 애니메이션 관련한 효과들이 추가됐다. 그리고 최신 브라우저들은 이를 지원한다.

웹에서 애니메이션은 성능과 연관된다. 모바일에서는 특히 그렇다. 그런데 운좋게도, 가장 많은 사람들이 사용하는 아이폰은 CSS3를 지원한다. 그렇다면 jQuery 애니메이션을 사용할 때, CSS3를 지원하는 경우에는 CSS3를 사용하게 하면 좋지 않을까?

그걸 구현한 플러그인이 있다. 바로, [jquery.animate-enhanced plugin][1] 이다.

사용법은 너무나 간단하다. js 파일을 다운받고, 그냥 script 태그로 넣어 준다. 그럼 끝이다. 그렇게 하면 알아서 jQuery animate 함수를 확장한다. 그래서 CSS3를 지원하는 브라우저의 경우엔 CSS3를 사용하고, 그렇지 않은 경우엔 그냥 js 애니메이션을 사용하게 한다. 한 마디로 짱이다.

또한, jQuery의 slideDown, slideUp, fadeIn, fadeOut 같은 함수들은 내부적으로 animate 함수를 사용하므로 이 플러그인을 적용하면 자동으로 저 함수들도 확장된다고 보면 된다. 

## animate 함수에 추가되는 옵션

이 플러그인을 사용하면 animate 함수에 다음 세 옵션을 추가로 사용할 수 있다. 이것만 알면 이 플러그인 사용법은 다 아는 것이다.

## 사용법

사용법은 [jQuery animate() 함수][2]와 같다. 하지만 3가지 새 파라미터가 추가된다. 이 파라미터들은 모두 선택값이며, 일반적으로는 건드리지 않아도 아무 문제가 없다.

*   **avoidTransforms**: (Boolean)  
    기본적으로 플러그인은 left와 top 위치를 CSS3 스타일의 -webkit-transform( 혹은 그에 해당하는 것)으로 변경한다. 하드웨어 가속을 사용하기 위해서다. 이 옵션을 true로 하면 그렇게 하지 않게 된다.
*   **useTranslate3d**: (Boolean)  
    기본적으로 이 플러그인은 2d translation을 사용한다. 더 많은 브라우저가 이걸 지원하기 때문이다. translate3d를 true로 놓으면 그렇게 하지 않는다. 아이폰/아이패드 개발시 추천한다. ([이유를 알고 싶다면 클릭][3])
*   **leaveTransforms**: (Boolean)  
    기본적으로 이 플러그인은 애니메이션이 일어날 때 left나 top 프로퍼티를 사용하게 되면, (위의 옵션에 따라 2d나 3d로) CSS3 transform의 translate 효과를 사용하게 된다. 그런데 만약 움직이는 놈이 다른 레이아웃에 종속적이라면, 전환 효과가 끝난 다음, 이 값들을 제거하고 원래의 left와 top 값으로 만든다. 이걸 **true**로 놓으면 이 기능을 사용하지 않게 된다.

이정도 설명이면 충분할 거라고 생각한다. 사실 난 아래 세 옵션은 사용할 일이 없을 것 같다. 그냥 script 태그에 넣고 끝냈다. 성능이 좀 향상된 것 같아 좋다.

 [1]: http://playground.benbarnett.net/jquery-animate-enhanced/
 [2]: http://api.jquery.com/animate/
 [3]: http://www.benbarnett.net/2010/08/30/writing-html-and-css-for-mobile-safari-just-the-same-old-code/