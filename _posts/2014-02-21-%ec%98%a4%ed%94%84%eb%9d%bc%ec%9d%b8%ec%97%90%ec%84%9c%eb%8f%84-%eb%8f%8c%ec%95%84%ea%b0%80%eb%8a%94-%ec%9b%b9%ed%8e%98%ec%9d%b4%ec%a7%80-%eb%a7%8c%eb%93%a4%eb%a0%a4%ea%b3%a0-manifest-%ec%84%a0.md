---
title: manifest 선언시 네트워크로 받을 게 다른 도메인이고 여러 개고 계속 변한다면 이렇게 하면 된다
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12616
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12616-manifest.md
categories:
  - 웹 퍼블리싱
tags:
  - html5
---
참고한 글은 [&#8216;How To Build A CLI Tool With Node.js And PhantomJS&#8217;][1]랑 [&#8216;HTML5 App cache 적용시 주의해야할 점…&#8217;][2]이다.

가계부 웹앱을 만들고 있는데, 마지막으로 manifest 선언을 해 주려고 했다. manifest는 네트워크가 끊긴 상태에서도 브라우저가 접근할 수 있도록 강력한 캐시를 하는 HTML5 기능이다. menifest 파일에 캐시할 파일, 하지 않을 파일, 네트워크가 끊긴 경우 대체해서 보여 줄 것(FALLBACK)을 적어 줘서 구현한다. 자세한 건 위의 글들을 참고하시고.

근데 작동을 안 하더라. 맨 윗줄에 `CACHE MANIFEST`라고 적는 걸 빼먹어서 그랬다.

근데 적용을 하고 나니 CACHE 선언돼 있는 파일 말고는 받아 오질 않는다. `CACHE:` 밑에 선언된 놈 말고는 다 없는 놈 취급한다는 말이 사실이었던 것. 근데 내가 만든 웹앱은 드롭박스 API를 사용하니 반드시 드롭박스의 js 파일을 받아 와야 했다. 다른 도메인에 있는 파일인데&#8230; 그래서 여튼 `NETWORK:`라고 쓰고 그 밑에 dropbox js의 URL을 적어 봤다. 안 됐다.

헐랭 뭐지&#8230; 어떡해야 하지&#8230;

해법은 간단했다. 캐시할 파일 목록은 `CACHE:` 선언 밑에 다 적고, **나머지 네트워크로 받을 게 추가로 여러 개 있고 계속 변한다면 그냥 이렇게 써 준다.**

    NETWORK:
    *
    

그러니까 캐시에 선언된 놈 말고는 다 잘 가져온다.

 [1]: http://coding.smashingmagazine.com/2014/02/12/build-cli-tool-nodejs-phantomjs/
 [2]: http://b.mytears.org/2010/09/2272