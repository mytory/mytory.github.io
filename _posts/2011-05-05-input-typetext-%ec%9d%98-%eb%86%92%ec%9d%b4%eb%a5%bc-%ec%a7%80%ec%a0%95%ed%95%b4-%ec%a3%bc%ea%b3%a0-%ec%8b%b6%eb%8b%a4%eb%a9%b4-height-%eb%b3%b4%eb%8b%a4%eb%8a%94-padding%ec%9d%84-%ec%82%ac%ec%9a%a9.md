---
title: input type=text 의 높이를 지정해 주고 싶다면 height 보다는 padding을 사용하라
author: 안형우
layout: post
permalink: /archives/1207
aktt_notify_twitter:
  - yes
daumview_id:
  - 36728498
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
input 박스의 사이즈가 크면 보기도 좋고 클릭해서 입력하기도 좋다.

미적인 것과 사용성 둘 다를 충족하는 좋은 방법이라고 생각한다.

그런데 css로 height 를 지정하면 난감한 일이 발생하곤 한다.

높이가 높은데 커서가 맨 위에 딱 붙어 있게 되는 것이다.

아래는 모두 `height: 25px`을 input에 준 경우다.<span style="text-align: center;"> </span>

<div style="width: 233px" class="wp-caption aligncenter">
  <img class=" " src="/uploads/legacy/input-text/ie6-8%EC%9D%80%20%EC%99%BC%EC%AA%BD%EC%9C%84%EC%AA%BD%EC%9D%84%20%EB%94%B1%20%EB%B6%99%EC%9D%B8%EB%8B%A4.png" alt="" width="223" height="76" /><p class="wp-caption-text">
    IE6부터 8은 입력 필드 왼쪽위로 텍스트가 딱 붙어 버리는 초난감한 사태가 발생한다
  </p>
</div>

<div style="width: 220px" class="wp-caption aligncenter">
  <img class=" " src="/uploads/legacy/input-text/%ED%8C%8C%EC%9D%B4%EC%96%B4%ED%8F%AD%EC%8A%A4%20input%EC%9D%80%20%EA%B8%80%EC%9E%90%EB%A5%BC%20%EC%9C%84%EC%95%84%EB%9E%98%20%EA%B0%80%EC%9A%B4%EB%8D%B0%EB%A1%9C%20%EC%A0%95%EB%A0%AC%ED%95%B4%20%EC%A4%80%EB%8B%A4.png" alt="" width="210" height="72" /><p class="wp-caption-text">
    파이어폭스4는 위아래를 기준으로 가운데 오게 정렬해 준다. 왼쪽은 딱 붙지만 IE처럼 흉하지는 않다.
  </p>
</div>

<div style="width: 216px" class="wp-caption aligncenter">
  <img class=" " src="/uploads/legacy/input-text/ie9%EC%9D%80%20%EA%B7%B8%EB%82%98%EB%A7%88%20%EC%A2%80%20%EB%82%AB%EB%8B%A4.png" alt="" width="206" height="78" /><p class="wp-caption-text">
    IE9은 그나마 좀 낫다
  </p>
</div>

이건 IE7에서 padding을 5px로 지정한 놈이다.

<div style="width: 225px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/input-text/padding-5px.jpg" alt="" width="215" height="94" /><p class="wp-caption-text">
    IE7에서 padding 5px 지정
  </p>
</div>

어떤 브라우저든지 `padding:5px`인 게 `height`를 지정하는 것보다 더 낫다.

submit 버튼과 입력 박스가 서로 줄이 좀 안 맞는 게 있는데, 이건 submit 버튼에 `vertical-align: top` 을 줘서 해결한다.

## 인풋 박스 높이를 지정하면서 보기좋게 만드는 다른 방법

[@dohoons 님이 알려 준 방법][1]이다.

height를 지정하고 line-height를 height와 동일하게 지정해 주면 된다고 한다.

 [1]: https://twitter.com/dohoons/status/66049468788768768