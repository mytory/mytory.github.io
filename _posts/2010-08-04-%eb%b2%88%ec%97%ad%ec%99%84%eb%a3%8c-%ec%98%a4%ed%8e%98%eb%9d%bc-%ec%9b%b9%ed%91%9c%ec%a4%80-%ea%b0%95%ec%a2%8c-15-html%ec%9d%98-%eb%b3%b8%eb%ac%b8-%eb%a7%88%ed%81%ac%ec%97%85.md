---
title: '[번역완료] 오페라 웹표준 강좌 15 : HTML의 본문 마크업'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/729
aktt_notify_twitter:
  - yes
daumview_id:
  - 36821819
categories:
  - 웹 퍼블리싱
tags:
  - Web Standard
---
> 이 글은 오페라 웹표준 강좌의 15강, <a href="http://dev.opera.com/articles/view/15-marking-up-textual-content-in-html/" target="_blank">HTML의 본문 마크업</a>을 번역한 것입니다. 원문의 링크를 얻은 곳은 클리어보스입니다.

## 들어가며

이 글에서 나는 본문(body) 콘텐츠를 의미에 따라 표현하는 HTML 기본 사용법을 보여 줄 것이다.

우리는 제목요소(heading)와 문단, 그리고 인용문과 코드 등 일반적으로 사용되는 구조적 요소들을 살펴볼 것이다. 그리고나서 우리는 짧은 인용부호와 강조 같은 inline 형식의 내용(inline content)을 살펴 보고 구식의 표현용 요소를 짧게 살펴본 후 마무리할 것이다. 이 글의 구조는 다음과 같다.

*   빈 칸 &#8211; 최후의 개척지 Space—the final frontier 
*   블럭 레벨 요소 Block level elements 
    *   페이지를 구분하는 헤딩 Page section headings 
    *   기본적인 문단 Generic paragraphs 
    *   다른 자료를 인용하기 Quoting other sources 
    *   이미 정렬해 둔 텍스트 Preformatted Text
*   인라인 요소 Inline elements 
    *   짧은 인용구 Short quotations
    *   강조 Emphasis
    *   기울여서 표시한 텍스트 Italicised text
*   표현용 요소 &#8211; 결코 사용하지 말 것 Presentational elements—never use these
*   요약 Summary

**알림:** 각 예제 코드 뒤에는 “실제 적용된 모습 보기” 링크가 있다. 클릭하면 소스코드를 실제로 렌더링한 것을 볼 수 있다.(정확히 번역이 안 되서 짧게 의역했다. 원문은 : <span class="Apple-style-span" style="font-family: 'trebuchet ms', 'lucida grande', 'lucida sans unicode', arial, helvetica, sans-serif; line-height: 19px; font-size: 13px; color: rgb(17, 17, 17); ">After each code example, there is a “View live examples” link, which when clicked will take you to the actual rendered output of that source code, contained within a different file—it is to view live examples of how the source code is actually rendered in the browser, as well as looking at the code.</span>)

나머지 글은 클리어보스에 있는 <a href="http://www.clearboth.org/15_marking_up_textual_content_in_html/" target="_blank" title="[http://www.clearboth.org/wiki/doku.php?id=document:owsc:15_marking_up_textual_content_in_html]로 이동합니다.">&#8220;오페라 웹표준 강좌 15. HTML의 본문 마크업&#8221;</a>에서 볼 수 있다.