---
title: '웹 폰트를 로컬 스토리지에 저장해서 안정성 높이기'
layout: post
tags:
  - tip
  - webfont
---

요샌 웹폰트를 사용할 만한 것 같다. 그러던 차 최근 프로젝트에서 웹폰트를 사용해서, 오래 전에 눈여겨 봤던 [스매싱 매거진의 웹폰트 적용 방식](https://www.smashingmagazine.com/2014/09/improving-smashing-magazine-performance-case-study/)<small>(Deferring Web Fonts 항목을 보면 된다)</small>을 사용해 보기로 했다. 이 방식을 요약하면 이렇다.

- 우리는 디자인을 중시한다. 모바일에서 웹폰트를 사용하지 않게 하는 것은 고려사항이 아니다.
- 웹폰트가 6개, 300KB나 된다.
- [FOUT](http://www.paulirish.com/2009/fighting-the-font-face-fout/) 현상을 피해야 한다.
- HTTP 캐시는 믿을 수 없다. 지멋대로다.
- 폰트를 다운로드하는 동안 글씨가 안 보인다.
-
