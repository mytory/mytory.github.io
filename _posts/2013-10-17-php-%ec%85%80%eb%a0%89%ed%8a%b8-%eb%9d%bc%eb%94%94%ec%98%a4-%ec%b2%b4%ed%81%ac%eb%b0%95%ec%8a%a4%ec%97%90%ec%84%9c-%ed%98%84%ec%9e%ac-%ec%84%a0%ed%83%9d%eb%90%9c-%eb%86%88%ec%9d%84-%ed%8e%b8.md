---
title: '[PHP] 셀렉트, 라디오, 체크박스에서 현재 선택된 놈을 편하게 체크하도록 해 주는 함수'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/11454
daumview_id:
  - 50554201
mytory_md_path:
  - http://dl.dropboxusercontent.com/u/15546257/mytory-md-content/if-selected.md
categories:
  - 서버단
  - 웹 퍼블리싱
tags:
  - PHP
---
`checkbox`나 `radio`, `select` 폼 코딩을 할 때 귀찮고 코드가 길어지는 게 수정할 때다. 현재 DB에 들어있는 값을 선택된 상태로 수정 화면을 출력해 줘야 하기 때문이다.

내가 만든 `attr_checked()`와 `attr_selected()` 함수를 사용하면 상대적으로 편해진다.

## 사용법

    <?php attr_selected($form_value, $db_value); ?>
    <?php attr_checked($form_value, $db_value); ?>
    

아래는 사용 예시다.

    <select name="회원구분">
        <option value="정회원" <?php attr_selected('정회원', $row[회원구분])?>></option>
        <option value="준회원" <?php attr_selected('준회원', $row[회원구분])?>></option>
    </select>
    

`attr_selected()`와 `attr_checked()` 함수 모두 사용법이 같다. 출력해 주는 값이 `selected`냐 `checked`냐 하는 차이만 있다.

## 파라미터

*   **`$form_value`**  
    (string) (required) 현재 `option`이나 `radio`, `checkbox`의 값.
*   **`$db_value`**  
    (string|array) (required) DB에 들어있는 값. 복수선택된 `checkbox`인 경우엔 값을 배열로 넘기면 된다.

## 함수 코드

<pre><code class="php">/**
 * input:checkbox나 input:radio 에서 값을 비교해 checked를 출력.
 * @param  string       $form_value 현재 input의 value
 * @param  string|array $db_value DB에 저장된 값 혹은 값들의 배열
 * @return boolean
 */
function attr_checked($form_value, $db_value){
  if(is_equal_or_in($form_value, $db_value)){
    echo 'checked';
  }
}

/**
 * selectbox 에서 값을 비교해 checked를 출력.
 * @param  string       $form_value 현재 select &gt; option의 value
 * @param  string|array $db_value DB에 저장된 값 혹은 값들의 배열
 * @return boolean
 */
function attr_selected($form_value, $db_value){
  if(is_equal_or_in($form_value, $db_value)){
    echo 'selected';
  }
}

/**
 * input:checkbox, input:radio, select 에서, 현재 값을 표시해 줄 때, 현재 값이 저장된 값과 같은지 
 * 혹은 저장된 값들 중에 포함돼 있는지(checkbox의 경우) 확인하는 함수.
 * HTML 길이를 줄이기 위해 만든 거다.
 * @param  string       $form_value 현재 input의 value
 * @param  string|array $db_value DB에 저장된 값 혹은 값들의 배열
 * @return boolean
 */
function is_equal_or_in($form_value, $db_value){
  if(is_array($db_value)){
    return in_array($form_value, $db_value);
  }else{
    return $form_value == $db_value;
  }
}
</code></pre>