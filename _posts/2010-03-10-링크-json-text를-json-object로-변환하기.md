---
title: '[링크] JSON Text를 JSON Object로 변환하기'
author: 안형우
layout: post
permalink: /archives/381
aktt_notify_twitter:
  - yes
daumview_id:
  - 37012816
categories:
  - 웹 퍼블리싱
tags:
  - javascript
  - plain javascript
---
<a href="http://blog.outsider.ne.kr/257" target="_blank">JSON Text를 JSON Object로 변환하기</a>

여기 보면 <a href="http://www.json.org/" target="_blank">json 홈페이지</a>에서 제공하는 JSON.parse() 메서드도 설명돼 있다. <a href="https://github.com/douglascrockford/JSON-js/blob/master/json2.js" target="_blank">json2.js</a>(<a href="http://crockford.com/" target="_blank">Douglas Crockford</a>가 만들었다고 한다)를 다운받으면 사용할 수 있는데, eval보다 안전하게 JSON을 파싱해 준다고 한다. 단, JSON의 원래 문법에 맞게 따옴표로 키값과 값을 모두 잘 싸줘야 한다.