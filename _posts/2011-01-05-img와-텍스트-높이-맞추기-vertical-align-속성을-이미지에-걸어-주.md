---
title: 'img와 텍스트 높이 맞추기 : vertical-align 속성을 이미지에 걸어 주기'
author: 안형우
layout: post
permalink: /archives/797
categories:
  - 웹 퍼블리싱
tags:
  - CSS
modified_date: 2021-01-05 15:13:00
---
텍스트 사이에 이미지를 넣을 때 골치아픈 문제가 있다. 텍스트 높이와 이미지 높이를 같게 해도 이미지가 꼭 위로 튀어 올라가는 문제가 있다.

<img src="/uploads/legacy/old-images/1/cfile25.uf.143F2D4A4D4BC96B3248BE.png" width="253" height="29" />

<p class="text-center">텍스트와 <code>img</code>를 그냥 한 줄에 넣으면 이렇게 높이가 어긋난다.</p>

이 때 과거에 사용했던 속성은 `<img align="absmiddle" src="…">`([참고](https://www.w3.org/MarkUp/Test/Img/imgtest.html)) 이었다고 한다. 그러나 `align="absmiddle"` 속성은 비표준이다.

따라서 앞으로는 css 속성인 [`vertical-align`](https://developer.mozilla.org/ko/docs/Web/CSS/vertical-align) 을 사용하자.

**`vertical-align` 은 `img`에 걸어 줘야 한다.** `img`의 부모에 걸어 줘 봤자 무용지물이다. 속성연 여러 가지가 있는데, `top`, `middle`, `bottom`을 써 보면서 적당한 높이를 고르자. `top`을 썼더니 텍스트와 높이가 일치하는 것을 확인했다. 아래는 각각을 적용했을 때 결과다.

<img src="/uploads/legacy/old-images/1/cfile29.uf.19502B4F4D4BC96B278622.png" width="253" height="25" />

<p class="text-center"><code>vertical-align: top</code></p>

<img src="/uploads/legacy/old-images/1/cfile23.uf.150FAE564D4BC96B2C99EF.png" width="254" height="32" />

<p class="text-center"><code>vertical-align: middle</code></p>

<img src="/uploads/legacy/old-images/1/cfile22.uf.1570C4514D4BC96B1E8768.png" width="249" height="29" />

<p class="text-center"><code>vertical-align: bottom</code></p>

참고: `vertical-align`은 오로지 `inline`과 `table-cell` 엘리먼트에만 적용된다.