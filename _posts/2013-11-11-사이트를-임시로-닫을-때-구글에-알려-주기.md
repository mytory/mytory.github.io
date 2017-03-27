---
title: 사이트를 임시로 닫을 때 구글에 알려 주기
author: 안형우
layout: post
permalink: /archives/11692
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/11692-site-temp-unavailable.md
daumview_id:
  - 51043875
categories:
  - 서버단
tags:
  - SEO
---
점검이나 사이트 이전 등으로 사이트를 불가피하게 잠시 닫아야 하는 경우(downtime)가 있다. 이런 경우 사이트를 그냥 내려 버리면 검색 순위에 악영향을 미칠 수 있다.

이럴 때 대처법을 구글 웹마스터 센터에서 알려 주고 있다 : [How to deal with planned site downtime][1]

## 정상적인 페이지로 보내자

**404(Not Found)나 503(Service Unavailable)가 뜨지 않도록 하자** : redirect를 하든 &#8220;사이트 점검중입니다&#8221;를 띄우든 해서 어쨌든 정상적인 응답을 하도록 하라는 거다.

## 재접속 시일을 알려 주자

[Retry-After header][2]를 알려 주자. 그러면 구글봇이 그 시각 이후에 다시 크롤링을 하러 온다고 한다.

Retry-After header의 문법은 아래와 같다.

    Retry-After  = "Retry-After" ":" ( HTTP-date | delta-seconds )
    

예제는 이렇다.

    Retry-After: Fri, 31 Dec 1999 23:59:59 GMT
    Retry-After: 120
    

뒤 예제는 120초, 즉 2분 뒤에 다시 오라는 것이다.

## 503(Service Unavailable) 코드와 Retry-After 헤더를 섞어서 사용하는 경우

서비스가 아주 잠깐 멈춘 게 아니라 공사중이거나 하드웨어 유지보수 작업 중이거나 뭐 이런 경우라면 HTTP 상태 코드로 503을 보내는 게 도움이 된다고 한다.

PHP에서 아래처럼 쓰면 서비스가 잠깐 멈췄으니까 2011년 8월 8일 18시 27분 이후에 다시 오라는 메시지가 된다.

    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Retry-After: Sat, 8 Oct 2011 18:27:00 GMT');
    

물론, 503 코드가 너무 오래 지속되면 구글은 해당 페이지가 영구적으로 서비스 불능 상태에 빠진 것으로 판단하고 검색 색인에서 페이지를 날려 버릴 것이다.

 [1]: http://googlewebmastercentral.blogspot.kr/2011/01/how-to-deal-with-planned-site-downtime.html
 [2]: http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.37