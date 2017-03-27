---
title: '[워드프레스] 테마에서 템플릿 파일 매칭 순서'
author: 안형우
layout: post
permalink: /archives/10119
daumview_id:
  - 44522043
categories:
  - WordPress
tags:
  - WordPress Tip
---
워드프레스는 테마 거의 전부를 커스터마이징할 수 있다. 커스터마이징을 하고 싶으면 아래 표를 참고해서 테마 폴더에 원하는 걸 매칭되는 이름으로 파일로 만들어 주면 된다. 이 표는 [《워드프레스 제대로 파기》][1]의 75페이지에 있는 내용을 거의 그대로 옮긴 것이다. 물론 [The WordPress Theme Files Execution Hierarchy][2]나 [WordPress.org의 Template Hierarchy][3]를 봐도 똑같은 내용이 나온다. 그러나 표로 일목요연하게 정리한 것은 《워드프레스 제대로 파기》의 75페이지에 있는 표다. 내가 재정리해도 되겠지만, 이렇게 정리가 잘 된 게 있는데 특별히 그럴 필요는 없을 것 같다.

| 페이지 타입     | 템플릿 파일 순서                                                                                    |
| ---------- | -------------------------------------------------------------------------------------------- |
| 404        | 404.php → index.php                                                                          |
| Search     | search.php → index.php                                                                       |
| Taxonomy   | taxonomy-{tax}-{term}.php → taxonomy-{tax}.php → taxonomy.php → archive.php → index.php      |
| Home       | home.php → index.php                                                                         |
| Attachment | {mime-type}.php → attachment.php → single.php → index.php                                    |
| Single     | single-{post-type}.php → single.php → index.php                                              |
| Page       | {custom-template}.php → page-{slug}.php → page-{id}.php → page.php → index.php               |
| Category   | category-{slug}.php → category-{id}.php → category.php → archive.php → index.php             |
| Tag        | tag-{slug}.php → tag-{id}.php → tag.php → archive.php → index.php                            |
| Author     | author-{author-nicename}.php → author-{author-id}.php → author.php → archive.php → index.php |
| Date       | date.php → archive.php → index.php                                                           |
| Archive    | archive-{post-type}.php → archive.php → index.php                                            |

예컨대, 검색 결과 페이지를 손보고 싶으면 `search.php`를 손보면 되는 거다. 404 페이지를 손보고 싶으면 `404.php`를 손보면 된다. (없으면 만들고 말이다.)

Alex Callinicos라는 필자가 있고, 이 필자가 쓴 글의 목록을 보여 줄 때는 단지 목록뿐이 아니라 맨 위에 특별한 디자인을 넣고 싶다고 가정하자. `author.php`에 `if`문을 사용할 수도 있겠지만, 이 필자만을 위한 파일을 만들 수도 있다. 필자 페이지의 템플릿 파일 중 최우선순위에 있는 `author-{author-nicename}.php`를 주목하자. Alex Callinicos의 nicename이 `alex-callinicos`라고 치자. 그러면 `author-alex-callinicos.php` 라는 파일을 만들어서 작업하면 되는 거다.

뭐, 대충 이정도.

 [1]: http://books.webactually.com/digwp/?page_id=2
 [2]: http://wp.tutsplus.com/tutorials/the-wordpress-theme-files-execution-hierarchy/
 [3]: http://codex.wordpress.org/Template_Hierarchy