---
title: '[javascript] 배열에서 요소를 제거하고 선택하는 함수 splice()'
author: 안형우
layout: post
permalink: /archives/308
tags:
  - javascript
  - plain javascript
---
일단 `splice()` 함수의 설명에 대해 보자.

[Array.prototype.splice()][1]

[1]: https://developer.mozilla.org/ko/docs/Web/JavaScript/Reference/Global_Objects/Array/splice

아래 코드를 보자.

    var a = [0,1,2,3,4,5];
    //일단 배열 만들고
    var b = a.splice(2,3);
    //2번 배열부터 3개 제거.
    console.log(a);
    //결과 : [0,1,5]
    console.log(b);
    //결과 : [2,3,4]

(`console.log()`의 결과를 보려면 크롬 등 브라우저에서 '요소 검사'를 눌러 패널을 누른 뒤 Console 탭으로 가면 된다.)
    
즉, `splice` 당한 배열에서 지정된 범위 안에 있는 요소들을 빼서 돌려 주는 함수가 `splice()`다.