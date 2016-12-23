---
title: 워드프레스에서 Custom Field(post_meta)로 포스트 검색하기
author: 안형우
layout: post
permalink: /archives/8448
daumview_id:
  - 36521953
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스의 Custom Field(코드에선 주로 `post_meta`라고 표현)는 훌륭한 개념이다. 포스트엔 모든 글에 통용되는 공통의 정보만을 넣고, 그 외는 Custom Field에 넣어서 자유롭게 Post의 기타 정보를 취급할 수 있도록 해 주니 말이다. 제로보드 등에서 column을 여분으로 10개쯤 놔 두고 그걸 사용하게 했던 것에 비하면 훨씬 더 유연한 구조라고 할 수 있겠다.

일단 Custom Field에 대해서는 안다고 가정하고 이야기하겠다. Custom Field를 사용하다가 막힌 부분은 바로 Custom Field를 바탕으로 Post를 불러 와야 하는 상황이었다. 방법이야 찾으면 있겠지. 그런데 간단하게 되는 건 아니니 막힌 거다. 특히, &#8216;워드프레스에 그런 코드가 있었던가?&#8217; 하는 생각이 먼저 들었던 거다. 사용했던 코드라는 게 `get_post()` 이런 거밖에 없으니까 말이다.

여하튼, 이 경우엔 책의 덕을 봤다. 웹액추얼리북스에서 나온 [《워드프레스 제대로 파기》][1]가 방법을 알려 줬다. 워드프레스에선 `WP_Query` 클래스가 DB에서 가져오는 역할을 한다. 저 책은` WP_Query` 클래스의 인자값으로 Custom Field 파라미터를 넣어 주는 방법을 알려 줬다. 그리고 나는 워드프레스 공식 매뉴얼에서 그 부분을 찾았다.

[`WP_Query` 매뉴얼의 Custom Field Parameters][2] 부분이다. 링크를 클릭해 들어가서 파라미터 사용법과 예제를 모두 보면 이해가 될 거다. 이상.

 [1]: http://books.webactually.com/digwp/?page_id=2
 [2]: http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters