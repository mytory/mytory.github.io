---
title: '[번역] HTML 유효성 검사하기(Validating)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/434
aktt_notify_twitter:
  - yes
daumview_id:
  - 36991283
categories:
  - 웹 퍼블리싱
tags:
  - HTML
---
# <a target="_blank" href="http://dev.opera.com/articles/view/24-validating-your-html/">24: Validating your HTML[원문]</a>

BY <a target="_blank" href="http://dev.opera.com/author/1477930">MARK NORMAN FRANCIS</a> · 2008년 9월 26일

<div style="padding: 20px; background: #ddd;">
  <p>
    [역자 주 : 이 번역은 전문번역이라기 보다는 실무자들에게 도움을 주기 위해서 한 것입니다. 따라서 표준 번역 용어를 신경쓰지 않고 많이 사용하는 용어법을 기준으로 번역했습니다. 예컨대, validation은 많은 경우 밸리데이션으로 번역했습니다. validate라는 동사는 &#8216;유효성 검사를 하다&#8217;로 번역했고, validator는 &#8216;유효성 검사기&#8217;로 번역했지만 또 많은 경우에는 밸리데이터로 그대로 읽었습니다. 그편이 덜 어색한 경우 그렇게 했습니다. invalid는 &#8216;잘못된&#8217;으로 번역한 경우도 있지만 &#8220;유효성 검사를 통과하지 못한&#8221;으로 번역한 경우가 더 많습니다.
  </p>
  
  <p>
    번역 내용을 보면 [] 안에 들어있는 문장들이 있을 것입니다. 이해를 돕기 위해 제가 추가한 부분입니다. 영어로는 표현이 되는데 한글로는 부연이 필요한 경우, 긴 영어 문장을 잘게 나누면서 동사가 더 필요하게 된 경우 등에 []를 덧붙였습니다. 의미가 그렇게 틀리지는 않을 것으로 생각합니다.
  </p>
  
  <p>
    마지막으로, 의역이 심하게 많다는 점을 알려드립니다. 오역도 있을 것입니다. 그러나 전체 내용에서 크게 왜곡한 부분은 없을 것이라고 생각한다는 점을 말씀드립니다. 번역중 오역이 의심되는 부분은 각주에 원문을 붙였는데, 각주가 붙지 않은 부분에서도 오역이 얼마든지 있을 수 있습니다.
  </p>
  
  <p>
    그럼, 부족한 번역이지만 많은 분들께 도움이 됐으면 합니다.]
  </p>
</div>

## 들어가며

지금까지 오면서 HTML 페이지를 좀 만들었을 것이다. 아마 당신이 보기에는 괜찮게 보일 것이다. 하지만 몇 가지 문제가 있다. 이런 문제점을 찾고, 이 페이지들이(혹은 미래에 당신이 만들 페이지가) 여러 브라우저들에서도 에러 없이 제대로 보이도록 할 수 있는 가장 좋은 방법은 무엇일까? 

유효성 검사(validation)(역자 주 : 보통은 W3C에서 제공하는 유효성 검사 툴을 통과시키는 걸 말한다. 바로 뒤에 설명이 나온다.)이 답이다. 사이트의 코드를 검증할 수 있도록 제공하는 툴은 여러 개가 있다. W3C 외에 몇 군데서 제공을 하고 있다. 당신이 사용할 수 있는 가장 일반적인 세 가지 유효성 검사기(validators)는 다음과 같다 :

*   <a target="_blank" href="http://validator.w3.org/">W3C 마크업 밸리데이터</a> : 이 툴은 당신이 제출한 문서의 (x)html doctype을 바탕으로 문서의 어떤 부분이 doctype을 위반했는지 지적해 준다. (즉, 제출한 HTML에서 그곳에 에러가 있다.)
*   <a target="_blank" href="http://validator.w3.org/checklink">W3C 링크 체커</a> : 이것은 제출한 문서를 전부 훑어 보고서, 모든 링크가 깨지지 않고 제대로 있는지 테스트한다.(깨졌다는 것은, href 값이 가리키고 있는 문서가 존재하지 않는 경우를 말한다.)
*   <a target="_blank" href="http://jigsaw.w3.org/css-validator/">W3C CSS 밸리데이터</a> : 아마 금방 눈치챘을 텐데, 이것은 CSS(혹은 HTML/CSS) 문서를 훑어 보고 CSS 스펙을 제대로 지켰는지 체크한다.

이 글에서 첫 번째 것에 대해 말할 텐데, 사용법과 자주 발생하는 유효성 검사 결과를 어떻게 해석하는지를 보여 줄 것이다. 링크 체커(Link Checker)는 아주 명확하다.[명확한 결과를 돌려 주니까 굳이 설명할 필요가 없다는 뜻인 듯] 그리고 CSS 밸리데이터는 이 글과 이 코스의 뒤에 나오는 CSS 관련 글을 읽은 다음에는 어느정도 스스로 이해할 줄 알아야 한다.

이 글의 구조는 다음과 같다 : 

*   에러
*   밸리데이션이란 무엇인가?
*   왜 유효성 검사를 하는가?
*   각각의 브라우저들은 유효성 검사를 통과하지 못하는 HTML을 서로 다르게 해석한다 
    *   쿽스모드(Quirksmode)
*   페이지 유효성 검사 방법 
    *   W3C HTML 밸리데이터
*   요약
*   더 많은 유효성 검사기(Further tools to check out)
*   연습문제

<div>
  나머지 글은 클리어보스의 <a href="http://www.clearboth.org/24_validating_your_html/" target="_blank" title="[http://www.clearboth.org/wiki/doku.php?id=document:owsc:24_validating_your_html]로 이동합니다.">&#8220;오페라 웹표준 강좌&nbsp;24. HTML 유효성 검사&#8221;</a>에서 볼 수 있다. 이렇게 하는 건 원문을 하나로 유지하기 위해서다.
</div>