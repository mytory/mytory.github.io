---
title: 워드프레스 메뉴에서 sub-menu를 가진 경우엔 has-child 클래스 붙여 주기
author: 안형우
layout: post
permalink: /archives/10851
daumview_id:
  - 49815176
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스 개발할 때 사용하려고 [mytory-basic][1] 이라는 테마를 만들어 두고 사용하려고 한다. 이 테마는 기본적으로 [OOCSS][2]로 개발하려고 하고 있으며, [BEM 작명법][3]을 따른다. [inuit.css][4](ver 4.1.5)를 사용한다.

그런데 워드프레스의 &#8216;메뉴&#8217; 기능을 사용하니까 문제가 생기는 게, 1단계 `li`와 2단계 `li`를 구분하는 클래스가 없다. 그래서 계층형 클래스를 사용하게 된다. sub-menu를 가진 `li`와 가지지 않은 `li`도 구분이 안 된다.

그래서 일단, 1단계 `li`에 `main-nav__li1`이라는 클래스를 붙였다. 2단계 `li`에까지 붙이는 건 시간 관계상 안 했다. 또한 sub-menu를 가진 `li`에는 `main-nav__li1--has-child`라는 클래스를 붙이도록 만들었다.

이 과정을 공유한다. 이제부터 시작.

작업을 하고 나면 아래처럼 메뉴를 호출하게 된다. (파일은 [`header.php`][5])

    $opt = array(
        // ...
        'walker' => new MBT_Walker_Nav_Menu,
    );
    wp_nav_menu($opt);
    

`walker`라는 옵션에 주목하자. 위 옵션은 쭈욱 돌면서 메뉴를 뿌려 주는 역할을 하는 객체를 넘겨 주는 옵션이다. 웬만해선 건드릴 일이 없다.

전에 한 번 이걸 고치는 예제를 본 적이 있는데 &#8216;이게 도대체 뭐야?&#8217; 하는 생각만 하고 볼 엄두를 못 낸 적이 있다. 그런데 오늘 옵션 쪽을 뜯어 보다 보니, 내가 자세히 보지 않아서 이해를 못 했던 것이라는 걸 깨달았다. 객체를 우리가 직접 짜야 하는 게 아니었다. 복사해서 붙여넣고 조금만 수정해 주면 되는 거였다.

## 기본 `walker`를 뜯어 보자

`wp-includes/nav-menu-template.php` 파일에 있는 `wp_nav_menu` 함수를 살펴 보자. `walker` 옵션의 기본값은 그냥 빈 문자열이다. 뭐지?

219번째 줄에 가 보면 비밀을 알 수 있다(이하 모든 줄번호는 WP 3.6 기준이다).

    $items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
    

`walk_nav_menu_tree`라는 함수에 세 값을 넘겨 주는데, `$args`가 우리가 세팅한 옵션값을 갖고 있는 놈이다. 우린 배열로 세팅해서 넘겼지만, 중간에 객체 형식으로 바뀌어서, 우리가 넘겨 준 `walker` 값은 `$args->walker`에 세팅돼 있다.

`walk_nav_menu_tree` 함수를 살펴 보자.

    function walk_nav_menu_tree( $items, $depth, $r ) {
        $walker = ( empty($r->walker) ) ? new Walker_Nav_Menu : $r->walker;
        $args = array( $items, $depth, $r );
    
        return call_user_func_array( array($walker, 'walk'), $args );
    }
    

간단하게 돼 있다. 세 번째 인자값인 `$r`이 바로 `$args`다. 위 코드의 두 번째 줄을 보면 `$walker`를 세팅하는 게 나온다. 비어 있으면 `Walker_Nav_Menu` 객체를 생성해서 받게 돼 있다. 그렇게 `$walker`라는 변수에 객체를 세팅한 뒤, 3번째 줄에서 `$args`를 세팅해서 `call_user_func_array` 함수로 `$walker->walk($args)`를 호출한다(5번째 줄).

즉, 메뉴를 뿌리는 함수들은 `Walker_Nav_Menu` 객체에 들어 있으며, 이걸 교체해 주면 된다는 말이다. 이제 `Walker_Nav_Menu` 클래스를 뜯어 보자.

## `Walker_Nav_Menu`와 `Walker` 클래스

`Walker_Nav_Menu` 클래스는 `wp-includes/nav-menu-template.php` 파일의 17번째 줄부터 정의돼 있다. 아래처럼 시작한다.

    class Walker_Nav_Menu extends Walker {
    

여기서 알 수 있는 것은, `Walker_Nav_Menu`가 `Walker`를 상속한다는 것이다. 아까 `walk` 함수를 호출해서 메뉴를 그린다고 했는데, `Walker_Nav_Menu`에는 `walk` 함수가 없다. 그럼 부모 클래스인 `Walker` 클래스에 있을 것이다. 그리로 찾아 가 보자.

`Walker` 클래스는 `wp-includes/class-wp-walker.php` 파일의 15번째 줄에 정의돼 있다. `walk` 함수도 갖고 있다. 174번째 줄이다.

`walk` 함수를 뜯어 보다가 230번째 줄에서 찾던 걸 찾았다. 아래 코드다.

    foreach ( $top_level_elements as $e )
        $this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
    

탑 레벨 요소면 `display_element` 함수에 `$children_elements`를 넣어서 뿌리게 되는 거다. 와우!

`$e`가 바로 탑 레벨 요소의 정보고, `$e->classes` 배열에 클래스 이름이 들어간다. 좋아! 여기를 고칠까? 아니다. 여긴 워드프레스 코어 파일이다. 코어 파일을 직접 수정하면 워드프레스를 버전업할 때 내가 수정한 게 사라진다. 테마에서 해결해야 한다.

지금 고쳐야 하는 건 `walk` 함수니까, `Walker_Nav_Menu` 클래스를 상속받는 새로운 클래스를 만들어서 `wp_nav_menu` 함수의 `walk` 옵션에 넘겨 주면 되겠다. 클래스를 만들어 보자.

    // Walker_Nav_Menu 클래스를 상속. MBT는 Mytory Basic Theme.
    class MBT_Walker_Nav_Menu extends Walker_Nav_Menu{
    
        // 주석은 생략
        function walk( $elements, $max_depth) {
            // walk 함수를 그대로 복사했다.
        }
    }
    

이렇게 간단한 구조다. 나는 [`functions-nav.php`][6]라고 파일을 만들어서 위 코드를 넣었고, `functions.php`에서 인클루드했다.

다음으로 할 일은, `MBT_Walker_Nav_Menu` 클래스의 `walk` 함수 일부를 수정하는 것이다. `foreach ( $top_level_elements as $e )` 부분을 찾아가서 두 줄을 아래처럼 수정했다. 도움을 주기 위해 주석을 달았다. 실제 코드엔 이런 주석 없다.

    foreach ( $top_level_elements as $e ){
    
        // 탑 레벨이니까 1번째 li임을 나타내기 위해 li1이라고 클래스 붙임.
        $e->classes[] = 'main-nav__li1';
    
        // $children_elements가 있으면 추가로 has-child라고 클래스 붙임.
        if( ! empty($children_elements[$e->ID])){
            $e->classes[] = 'main-nav__li1--has-child';
        }
    
        // 아래는 원 코드와 같음.
        $this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
    }
    

오케이. 이렇게 하고 나서 아래처럼 메뉴를 호출해 주면 된다.

    $opt = array(
        'theme_location' => 'main-nav', 
        'walker' => new MBT_Walker_Nav_Menu,
    );
    wp_nav_menu($opt); 
    

그러면 모든 탑 레벨 `li`에는 `main-nav__li1`이라는 클래스가 붙고, sub-menu를 가진 `li`에는 `main-nav__li1--has-child`라는 클래스가 추가로 붙는다.

나머지 응용은 각자 알아서. depth에 따라 `li`에 숫자를 붙이는 것도 만들고 싶지만, 시간 관계상 끝이다.

 [1]: https://github.com/mytory/wp-mytory-basic-theme
 [2]: http://mytory.net/archives/8949
 [3]: http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/
 [4]: http://inuitcss.com
 [5]: https://github.com/mytory/wp-mytory-basic-theme/blob/bc593d2dfbcfbfabf0d8e480e499ef0a36d5cc9a/header.php
 [6]: https://github.com/mytory/wp-mytory-basic-theme/blob/7de411fce7573cb484c5f147fb23b2b53a97e1d9/functions-nav.php