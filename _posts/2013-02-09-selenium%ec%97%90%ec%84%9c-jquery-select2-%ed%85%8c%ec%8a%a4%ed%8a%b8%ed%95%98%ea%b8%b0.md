---
title: Selenium에서 jQuery Select2 테스트하기
author: 안형우
layout: post
permalink: /archives/9376
daumview_id:
  - 40159653
categories:
  - 개발 툴
---
[Select2][1]는 졸라 멋진 라이브러다. 물론 IE 하위 버전을 제대로 지원하지 않는데, 뭐 상관 없다. IE 하위 버전에선 그냥 일반적인 셀렉트 박스를 출력해 주면 되니까 말이다.

Select2 라이브러리를 이용해 만든 페이지를 Selenium으로 테스트 자동화를 하려고 하니까 도대체가 제대로 작동을 안 하는 거다. 혹시나? Select2와 Selenium 두 개 다 광범한 사용자층이 있으니까 나 같은 고민을 한 사람이 있지 않을까? 싶어서 검색을 해 봤다. 와우! 있었다. 핵심은 mouseUp 이벤트였다.

그래서 결과적으로 아래처럼 적어 주면 된다. Selenium의 기본 문법을 설명하지는 않겠다.

<table>
  <tr>
    <td>
      keyDown
    </td>
    
    <td>
      css=#s2id_email_server .select2-input
    </td>
    
    <td>
      g
    </td>
  </tr>
  
  <tr>
    <td>
      mouseUp
    </td>
    
    <td>
      css=.select2-results .select2-result-selectable:nth-child(5)
    </td>
    
    <td>
    </td>
  </tr>
</table>

 [1]: http://ivaynberg.github.com/select2/