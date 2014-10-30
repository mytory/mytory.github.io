---
title: '[워드프레스] load-scripts.php에서 Uncaught SyntaxError: Unexpected token ILLEGAL 라는 에러가 발생할 때'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10095
daumview_id:
  - 44328887
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스로 웹사이트를 만들고 있는데 로컬에서 작업을 하다가 관리자 페이지로 들어가니까 레이아웃이 죄다 깨져 나왔다. 자바스크립트가 제대로 작동을 하지 않는 것이었다. 이건 뭔가 싶어서 js 콘솔을 열어 보니 웬걸 에러 메시지가 떠 있었다.

    Uncaught SyntaxError: Unexpected token ILLEGAL
    

위치는 `load-scripts.php`의 첫 번째 줄. 뭔 일인가 싶어서 이거저거 해 봤지만 전혀 먹히지 않았다.

load-scripts.php는 js를 받아서 최소화(minify)를 해 주는 파일이다. 저기에서 js 파일들을 받아서 뿌리는 거다. 소스보기를 해서 load-scripts.php로 검색을 해 보고 들어가면 최소화된 js를 발견할 수 있을 거다. 그런데 들어가 보니 알 수 없는 문자들로 깨져 있었다. 이건 뭐지&#8230;

결국 검색을 해 보니 같은 문제를 겪은 사람들이 꽤 있다는 것을 알 수 있었다. [해법][1]은 간단하다. 캐시를 지우면 된다. 쿠키까지 지울 것도 없다. 크롬 같은 경우 **도구 > 인터넷 사용정보 삭제**를 누르고 캐시에만 체크한 후 확인을 누르면 된다. 그러니 그 다음부터는 잘 나온다. 왜 캐시가 문제가 됐던 건지는 모르겠는데 여튼 해결.

 [1]: http://stackoverflow.com/questions/11916987/uncaught-syntaxerror-unexpected-token-illegal-load-scripts-php1