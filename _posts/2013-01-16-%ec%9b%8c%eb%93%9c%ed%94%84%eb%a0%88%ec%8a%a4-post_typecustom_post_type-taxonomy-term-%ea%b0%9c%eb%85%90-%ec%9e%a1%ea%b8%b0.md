---
title: 워드프레스, post_type(custom_post_type), taxonomy, term 개념
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9176
daumview_id:
  - 39075051
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스를 CMS 툴로 사용하기 위해 거쳐야 하는 거의 필수적인 고급 기능이 바로 custom\_post\_type과 taxonomy다.

custom\_post\_type이야 이름만 봐도 알 수 있을 것이다. 웹사이트를 만들다 보면 단지 글로만 이루어져 있는 웹사이트는 별로 없다. 출판사만 봐도, 공지사항의 post\_type이야 post로 할 수 있을 텐데, 책까지 post로 처리하긴 뭐하다. 서평은 post로 처리해야 할까 reivew로 처리해야 할까? 이럴 때 custom\_post_type을 사용해서 book이라는 아이템을 만들 수 있다.

taxonomy는 생소할 텐데, 번역하면 &#8216;분류&#8217;다. 각 포스트을 어떻게 분류할 것인가 정하는 게 taxonomy다. 워드프레스 공식 문서를 보면 taxonomy를 설명할 때 책을 분류하는 예를 든다. 아래 표에 예시를 들었다.

마지막으로, 내가 헷갈렸던 것은 term이라는 놈이었다. 공식 문서에서 별다른 설명을 아직 못 봤기 때문이다. 코드를 살펴보며 알게 됐다. term은 바로 구체적인 taxonomy를 가리키는 것이었다.

이제 아래 표를 보자.

<table>
  <tr>
    <th>
      post_type
    </th>
    
    <th>
      taxonomy
    </th>
    
    <th>
      term
    </th>
  </tr>
  
  <tr>
    <td>
      post
    </td>
    
    <td>
      category
    </td>
    
    <td>
      웹 서버
    </td>
  </tr>
  
  <tr>
    <td>
      post
    </td>
    
    <td>
      category
    </td>
    
    <td>
      웹 클라이언트
    </td>
  </tr>
  
  <tr>
    <td>
      post
    </td>
    
    <td>
      tag
    </td>
    
    <td>
      PHP
    </td>
  </tr>
  
  <tr>
    <td>
      post
    </td>
    
    <td>
      tag
    </td>
    
    <td>
      javascript
    </td>
  </tr>
  
  <tr>
    <td>
      book
    </td>
    
    <td>
      publisher
    </td>
    
    <td>
      한빛미디어
    </td>
  </tr>
  
  <tr>
    <td>
      book
    </td>
    
    <td>
      publisher
    </td>
    
    <td>
      책갈피
    </td>
  </tr>
  
  <tr>
    <td>
      book
    </td>
    
    <td>
      author
    </td>
    
    <td>
      최준선
    </td>
  </tr>
  
  <tr>
    <td>
      book
    </td>
    
    <td>
      author
    </td>
    
    <td>
      알렉스 캘리니코스
    </td>
  </tr>
</table>

이 이상 더 설명할 건 별로 없다. 나머지는 워드프레스 공식 문서를 보면서 구체적으로 활용을 하면 되는 거다.

이렇게 기억하자.

post_type은 책을 말하고, taxonomy는 각종 분류 기준을 말한다. 예컨대 책을 분류하는 기준이 되는 필자, 출판사 같은 것들. 제빙기의 경우 제조사를 기준으로 분류할 수 있을 거다.

term은 구체적인 taxonomy를 말한다. 필자 taxonomy의 term에는 최준선과 알렉스 캘리니코스가 있는 것이다. 카테고리 taxonomy의 term에는 웹 서버나 웹 클라이언트가 있는 거고, 태그 taxonomy의 term에는 PHP, javascript 같은 것이 있는 것이다.

이 정도면 이해 됐을 것이다.