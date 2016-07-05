---
title: '[Eclipse PDT] 함수 앞에 붙는 주석의 자동완성 내용을 변경하기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9521
daumview_id:
  - 40991941
  - 40991941
categories:
  - 개발 툴
tags:
  - Eclipse
---
Eclipse를 사용할 때 함수 앞에서 `/**`라고 치고 엔터를 치면 주석을 자동완성해 준다. 아래처럼 말이다.

<pre>/**
 * 메모추가
 * 메모수정도 이력을 추가하는 것이므로 insert 함수로 동작한다.
 * 부모 메모 id를 가지고 있지 않으면 부모 메모 id는 0이다. 수정인 경우 원본이 부모다.
 * @param int $id_person
 * @param array $data memo_content, id_category_memo ...
 * @param int $user_id 로그인한 사용자 id
 */
function add_memo($id_person, $data, $user_id){ ... }</pre>

그런데 난 여기에 `author`와 `since`도 자동으로 넣어 주고 싶었다. 그래서 설정을 찾아 봤고, 찾았다.

<img class="alignnone" alt="" src="/uploads/legacy/eclipse-comment-template.png" width="833" height="802" />

위의 이미지에 있는 것처럼 설정에서 PHP > Code Style > Code Templates > Comment > Method로 들어가서 pattern을 수정해 주면 된다.

`@author`나 `@since`는 PHPDOC에 약속돼 있는 keyword다. ([PHPDOC의 Tag Reference][1] 참고.)

${user}나 ${date}는 Edit를 눌러서 뜨는 창의 하단에 있는 Insert Variable&#8230;을 누르면 찾아 볼 수 있다.

<img class="alignnone" alt="" src="/uploads/legacy/eclipse-comment-template-tag.png" />

편집창에서 자신이 원하는 모양을 만들어 주면 완료. 그러면 이렇게 나온다.

<pre>/**
 * 메모추가
 * 메모수정도 이력을 추가하는 것이므로 insert 함수로 동작한다.
 * 부모 메모 id를 가지고 있지 않으면 부모 메모 id는 0이다. 수정인 경우 원본이 부모다.
 * @param int $id_person
 * @param array $data memo_content, id_category_memo ...
 * @param int $user_id 로그인한 사용자 id
 * @author mytory
 * @since 2013. 3. 2.
 */
function add_memo($id_person, $data, $user_id){ ... }</pre>

 [1]: http://www.phpdoc.org/docs/latest/index.html