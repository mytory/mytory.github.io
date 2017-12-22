---
title: "[php] preg_match에서 괄호 검색에 이름 붙이기" 
layout: post
tags: 
  - php
description: 괄호 안에 ?&lt;city&gt; 형식으로 적으면 $matches['city'] 형식으로 받아서 사용할 수 있다.
---

php에서 `preg_match`나 `preg_match_all`을 사용해 정규식으로 문자열을 검색할 때, 괄호 안에 있는 것들을 따로 배열에 담아 주게 된다. 이 때 괄호 안에서 맨 앞에 `?<city>` 형식으로 적어 주게 되면 배열에 키값이 숫자가 아니라 `city` 같은 문자열로 담기게 된다. 아래 예제 참고.

~~~ php
$address = 'One Infinite Loop, Cupertino 95014';
$cityZipCodeRegex = '/^[^,]+,\s*(?<city>.+?)\s*(?<zipCode>\d{5})$/';
preg_match($cityZipCodeRegex, $address, $matches);

saveCityZipCode($matches['city'], $matches['zipCode']);
~~~

문법이 기억나지 않아서 검색해 보면 잘 나오질 않아서 짜증이 나곤 했는데, 마침 Clean Code PHP의 [Use explanatory variables][1](설명적 변수 사용)에서 관련 내용을 발견하게 돼 이번엔 그냥 내 블로그에 저장해야지 생각하게 됐다. 위의 예제 코드는 Clean Code PHP에서 가져온 것이다. 

[1]: https://github.com/jupeter/clean-code-php#use-explanatory-variables



