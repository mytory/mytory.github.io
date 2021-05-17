---
title: 'PHP POST 요청시 배열 길이 제한 문제 - 요청 값이 잘린다!'
layout: post
tags: 
    - PHP
description: POST 요청에서 배열 뒤가 잘리면 php.ini의 max_input_vars 값을 늘려 본다. 기본값이 1000인데, 배열 아이템 개수가 1000개를 넘어간 경우일 수 있다.
---

## 증상

엄청 긴 배열을 한꺼번에 POST로 넘기는 경우가 있었다. 일부가 저장이 되지 않아서 한참을 헤맸다. 알고 보니 `$_POST` 배열의 뒤가 잘렸던 것이다.

엄청 긴 배열이란 아래와 같은 쿼리 스트링 형태를 말한다.

```
display_items[0][x]=1&display_items[0][y]=0&display_items[0][width]=2&display_items[0][height]=12&display_items[0][order]=0&display_items[0][template_id]=normal&display_items[0][content_id]=0&display_items[0][banner_id]=&display_items[0][custom_content]=headline_image 636&display_items[0][id]=28538&display_items[0][display_id]=835&display_items[0][options][image_crop_x]=0&display_items[0][options][image_crop_y]=0&display_items[0][options][image_crop_width]=1&display_items[0][options][image_crop_height]=1&display_items[0][options][image_sizing_unit]=3&display_items[0][options][image_position]=top&display_items[0][options][headline_size]=very-small&display_items[0][options][display_item_class]=&display_items[0][options][show_image]=1&display_items[0][options][show_teaser]=0&display_items[0][options][show_related_articles]=0&display_items[0][options][show_related_article_author]=1&display_items[0][options][related_article_type]=기본&display_items[0][options][show_author_description]=1&display_items[0][options][show_author]=1&display_items[0][options][custom_author]=&display_items[0][options][show_date]=0&display_items[0][options][force_new_mark]=false&display_items[0][options][show_target]=데스크톱/모바일&display_items[0][options][cols]=0&display_items[0][options][display_shortcut]=&display_items[0][options][teaser_length]=30&display_items[0][options][title_tag]=&display_items[0][options][subtitle_head]=&display_items[0][options][title]=&display_items[0][options][subtitle_tail]=&display_items[0][options][relation_ids]=&display_items[0][created_at]=2021-02-03 17:36:42&display_items[0][updated_at]=2021-05-14 16:09:26...(이하 생략)
```

위에서 `display_items[0]`이라는 값이 보일 텐데, 이게 번호 27까지 이어졌다. 그리고 PHP가 받는 데이터는 25번 배열부터 잘렸다.


## 원인

검색을 해 보니 이것이 php.ini의 [`max_input_vars`](https://www.php.net/manual/en/info.configuration.php#ini.max-input-vars) 옵션값에 영향을 받는 문제라는 사실을 알게 됐다. PHP 공식 문서의 설명을 보자.

>  max_input_vars(int): 얼마나 많은 [입력 변수](https://www.php.net/manual/en/language.variables.external.php)가 허용되는지(`$_GET`, `$_POST`, `$_COOKIE` 슈퍼글로벌 변수에 각각 제한이 적용된다). 이 지시자를 사용해서 해시 충돌을 이용한 DOS(denial of service, 서비스 거부) 공격 가능성을 완화시킨다. 이 지시자가 지정한 수를 넘어서는 입력 변수가 있으면 **`E_WARNING`**이 발생하며, 숫자를 초과한 변수는 요청에서 제거된다.

즉, `$_POST` 안의 배열 아이템이 1000개가 넘어가는 순간 이하 내용은 잘렸던 것이다.

## 해결책

php.ini의 `max_input_vars` 옵션의 기본값이 1000이다(우분투의 경우 기본으로 주석처리돼 있다). 1000개까지 post 변수를 받을 수 있는 것이다. 이를 늘리면 일단 해결된다.

php.ini를 건드릴 수 없는 경우라면 .htaccess 파일에 아래 지시값을 적어 해결할 수 있다. 아래는 값을 2000으로 설정한 경우다.

```config
php_value max_input_vars 2000
```


## 근본적 해결책

PHP의 변수 개수에 구애받지 않도록 json 문자열 콘텐츠로 데이터를 넘기면 이런 문제가 발생하지 않는다.

이 경우 PHP 쪽에서는 아래처럼 값을 받으면 된다(물론 프레임워크가 처리해 주지 않는다면 말이다).

```php
json_decode(file_get_contents('php://input'))
```
