---
title: 'PhpStorm에서 <?php 여는 태그 자동완성 만들기'
layout: post
author: 안형우
tags: 
  - tool
  - phpstorm 
description: 'PhpStorm에서 <?를 입력하고 탭을 누르면 <?php  ?>가 생기고 그 가운데 커서가 위치하게 만들어 보자'
image: /uploads/2017/php-open-tag-live-template.jpg 
---

나는 PHP 여는 태그로 긴 태그(`<?php  ?>)`를 사용한다. 짧은 태그(`<? ?>`)는 작성하지 않는다. 기본으로 `short_open_code`를 비활성화하고 개발하는 게 좋다고 본다. 
[모든 환경에 호환되는 코드를 작성하는 습관을 들이는 편이 좋다고 생각](/2017/04/12/is-it-better-to-use-the-short-open-tag-in-php.html)하기 때문이다.
사실 `short_open_tag = Off`가 [PHP 소스의 php.ini](https://github.com/php/php-src/blob/php-7.1.4/php.ini-production) 기본값이기도 하다.

그래도 `php`라고 더 치는 게 귀찮은 것은 사실, 그래서 자동완성을 만들었다. PhpStorm의 경우 live template이라고 부른다.

## 설정 > Editor > live template

아래 이미지를 참고해서 라이브 템플릿을 만들어 보자.

![](/uploads/2017/php-open-tag-live-template.jpg)

PhpStorm의 설정을 열고, Editor 밑의 live template으로 간다. 그냥 설정의 검색 필드에 live라고만 쳐도 나온다.

만들려고 하는 것은, `<?`라고 쓴 뒤 탭을 누르면 `<?php  ?>`라고 완성되고 여는 태그와 닫는 태그 사이에 커서가 위치해 있게 하는 것이다. 

- 우선 우측의 +를 눌러서 새 항목 추가로 들어간다.
- 하단의 느낌표를 보자. 어떤 언어를 작성할 때 사용할 것인지를 지정하는 것이다. Define을 클릭하면 언어 종류가 뜬다. PHP를 선택하자.
- Abbreviation은 자동완성을 하기 위해 적어야 할 키워드를 말한다. 여기에 `<?`를 적는다.
- Template text는 탭을 눌렀을 때 어떻게 할 지 적는 것이다. `<?php $END$ ?>`라고 넣어 주면, 긴 태그를 출력한 뒤 태그 사이에 커서가 위치하게 된다.
- 우측 하단의 Options에 Expand with는 키워드를 Template text로 확장할 때 사용할 단축키를 선택하는 것인데, 탭이 기본값이므로 수정할 필요가 없다.

저장하고, PHP 파일을 편집해 보자. `<?`라고 적고 탭을 누르면 `<?php  ?>`가 나오고 가운데 커서가 위치하게 되는 것을 볼 수 있을 것이다.
