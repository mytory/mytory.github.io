---
title: '[번역] 구글 맞춤 검색, 검색결과를 커스터마이징 하기(데이터 렌더링 서비스)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/504
aktt_notify_twitter:
  - yes
daumview_id:
  - 36975358
categories:
  - 웹 분석과 검색
tags:
  - Google Custom Search
---
<a href="http://googlecustomsearch.blogspot.com/2010/04/custom-data-rendering-in-results.html" target="_blank">[원문 보기]</a>

원문 글쓴 시각 : 2010년 4월 14일 수요일 오전 11시 23분.

(역자 주 : 각주는 모두 내가 단 것이다)

맞춤검색(Custom Search) 서비스를 시작한 이후 우리는 사용자가 설정할 수 있는 것들을 지속적으로 늘려 왔다. ─ 사용자가 검색 순위(ranking)를 바꿀 수 있게 하거나, 상세검색을 제공하고나, 검색 결과에 광고를 넣을 수 있도록 하거나, 모양새를 바꿀 수 있게 하고, <a href="http://googlecustomsearch.blogspot.com/2009/10/plug-n-play-with-custom-search-themes.html" target="_blank">테마</a>를 골라 레이아웃을 바꿀 수 있도록 했다.

우리는 거기서 멈추지 않았다. 우리는 사용자가 <a href="http://googlecustomsearch.blogspot.com/2010/03/synonyms-made-easy.html" target="_blank">동의어</a>를 설정할 수 있도록 했다. 그리고 웹사이트 소유자가 구조(structured) 메타 데이터에 자신들의 컨텐츠를 마크업할 수 있도록 했다. <a href="http://googlecustomsearch.blogspot.com/2009/10/structured-custom-search.html" target="_blank">structured Custom Search</a>를 이용해서, 당신은 다양한 조각들(snippets)을 검색결과에 넣을 수 있다. 예컨대, 조각 그림이나 액션들(actions).

지금, 맞춤검색 요소(element를 맞춤 검색 요소라고 번역했는데 맞는지는 실제 기능을 봐야 겠다. 구글 맞춤검색 요소는 ajax를 이용한 맞춤검색을 의미하고, 실제 element라고 쓴다.)에서 커스텀 검색 자료 렌더링(<a href="http://code.google.com/apis/ajaxsearch/documentation/customsearch/rendering.html" target="_blank">Custom Search data rendering</a>)을 사용하면, 당신은 각 검색 결과를 완벽하게 제어할 수 있다. 검색 페이지에 포함된 간단한 마크업으로, 당신은 검색 결과의 속성들(attributes)을 덮어쓸 수 있고, 각 검색 결과가 어떤 포맷으로 나올지 결정할 수 있고, 조각 그림(thumbnail)의 위치와 크기를 제어할 수 있으며, 검색 결과의 메타데이터를 강조할 수 있다.

아래 스크린샷을 보자. <a href="http://www.scribd.com/" target="_blank">Scribd</a>(문서를 플래시 형태로 제공해 주는 사이트다) 데이터를 기반으로 사용자가 포맷을 결정한 검색 결과의 예제다. 사이즈에 맞게 조각 그림을 조정해서 넣었고, 메타데이터를 포함한 새 줄이 추가됐다. 메타데이터에는 문서 타입 아이콘도 있다.

<img src="/uploads/legacy/old-images/1/cfile2.uf.1855C9474D4BC8DC1F9276.png" class="aligncenter" width="400" height="210" alt="" />

우리는 당신이 맞춤 검색을 활용해서 데이터 렌더링의 힘을 사용하기 바란다. 맞춤검색 요소의 데이터 렌더링 방법을 단계별로 배우고 싶다면, <a href="http://googleajaxsearchapi.blogspot.com/2010/04/rendering-custom-data-in-custom-search.html" target="_blank">Search API blog</a>(이 글이 핵심인 것 같다.)의 글을 읽기 바란다.

글쓴이 : 데이비드 깁슨ㆍ니콜라스 웨인저(소프트웨어 엔지니어)