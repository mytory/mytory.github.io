---
title: "[PHP] error_reporting, 에러만 나오게 하기"
layout: "post"
category: "php"
tags: 
    - snippet
---

작업하고 있는 사이트가 notice랑 warning은 너무 많아서 error만 보이게 하고 작업을 해야 한다. 그런데 분명히 에러인데 에러 표시가 안 되는 경우가 있었다. 그냥 덩그러니 `asdf`만 쳐 넣은 경우. 그래서 찾아 봤더니 세팅을 이렇게 해 줘야 하더라.

이건 PHP 코드에서 런타임에 박을 때. 

	error_reporting(E_ERROR | E_PARSE);

이건 php.ini에 박을 때.

    error_reporting = E_ERROR & E_PARSE