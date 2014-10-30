---
title: '[워드프레스 플러그인] 내 트위터를 다 모아 주는 Tweet Collection'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/10433
daumview_id:
  - 46671243
categories:
  - WordPress
tags:
  - My WordPress Plugin
---
원래 내가 이 블로그를 처음 만들었을 때, 용도는 두 가지였다. 내가 공부한 걸 적는 것과, 유용한 링크를 저장하는 것이었다.

이 중 링크를 저장하는 것은 트위터 쪽으로 옮기는 것이 여러 모로 편하겠다는 생각을 하게 됐다. 짧은 글을 블로그에 계속 적는 게 시간이 꽤 걸리는 일이었기 때문이다. 트위터로 퍼가는 북마클릿을 활용하면 짧은 시간에 링크를 저장할 수 있었다.

그런데 문제가 하나 있었다. 트위터 내 계정에 올린 글들이 따로 검색이 안 되는 것이다. 그래서 트위터에 올린 모든 트윗을 내 블로그에 저장하면 되겠다는 아이디어를 떠올리고 만들게 된 게 바로 이 플러그인이다.

## 기능

이 플러그인은 20분에 한 번씩 지정한 계정으로 접속해서 트윗을 긁어 온다. 내가 필요해서 만든 만큼, 트윗을 개별적으로 검색할 수 있도록 만들었다. 트윗 검색 위젯을 사용하면 트윗을 검색할 수 있다. 개별 트윗으로 검색된다.

예전에 내가 사용했던 플러그인은 일주일 간의 트윗을 모아서 하나의 포스트로 발행해 주는 것이었다. 트윗이 개별로 검색되지 않아 불편했다. 이 플러그인은 그래서 트윗을 개별적으로 검색해 준다.

다음으로 내가 원했던 것은 트윗을 페이스북 페이지로 보내는 기능이었다. 그리고 페이스북 페이지에서 내 트윗을 클릭하면 트위터 웹사이트로 이동하는 것이 아니라, 트윗에서 언급한 링크로 이동하는 것이 내가 원하는 것이었다. 그런 기능이 있는 플러그인이나 트위터 앱, 페이스북 앱을 찾을 수 없었기 때문에 내가 직접 만들어서 사용을 했었다. 트위터 RSS를 긁은 다음, 링크를 추출해서 RSS의 link를 바꿔치기하는 방식으로 구현했다.

그런데 얼마 전 트위터 API가 업그레이드되면서 트위터 RSS를 더이상 활용할 수 없게 됐다. 그래서 어쩔 수 없이 워드프레스에 수집된 tweet들을 바탕으로 RSS를 구성하도록 했고, 이 플러그인에 해당 기능을 추가했다.

그래서 이 플러그인의 기능은 크게 다섯 가지다.

*   트윗을 20분마다 한 번씩 긁어 와서 개별 `tweet`으로 저장한다.
*   개별 트윗을 **개별적으로 검색**할 수 있다.
*   트윗 **아카이브** 페이지가 제공된다.
*   트윗 검색 위젯과 트윗 아카이브 **위젯**을 제공한다.
*   트윗 **RSS**를 제공한다. 이 RSS는 다양한 용도로 활용할 수 있을 거다. 나 같은 경우는 페이스북의 RSS Graffiti와 연동해서 페이스북 페이지로 트윗을 보내는 데 활용한다.

이상.

*   [Tweet Collecton 워드프레스 플러그인 페이지][1]
*   [Tweet Collection GitHub 저장소][2]

아래는 스크린샷이다.

![][3]

![][4]

![][5]

![][6]

![][7]

 [1]: http://wordpress.org/plugins/tweet-collection/
 [2]: https://github.com/mytory/tweet-collection
 [3]: http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/screenshot-1.png
 [4]: http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/screenshot-2.png
 [5]: http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/screenshot-3.png
 [6]: http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/screenshot-4.png
 [7]: http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/screenshot-5.png