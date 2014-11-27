---
title: dekiwiki, Sharing violation on path /var/www/dekiwiki/bin/cache/luceneindex/default-queue/data_1.bin
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/1763
aktt_notify_twitter:
  - yes
daumview_id:
  - 36677474
categories:
  - 기타
tags:
  - TIP
---
[데키위키][1]는 유용한 위키 프로그램이다. FCKEditor를 사용하기 때문에 초보자도 쉽게 글을 쓸 수 있다.

그런데 아래와 같은 에러 메세지가 나오면서 위키 검색이 되지 않았다. 사실 에러 메세지는 훨씬 복잡했고, 거기서 message 부분을 딴 거다.

([데키위키 오류 관련해서 누적하는 글][2]도 있는데 이건 그냥 글을 따로 써서 검색에 잡히게 하는 편이 낫겠다고 생각했다.)

<pre>Sharing violation on path /var/www/dekiwiki/bin/cache/luceneindex/default-queue/data_1.bin</pre>

그래서 [구글링을 했더니 금세 해결책][3]이 나왔다.

> Try this:  
> 1. Stop MindTouch  
> 2. Kill the index by deleting it. rm -rf luceneindex  
> 3. Start MindTouch and queue the rebuild

한 마디로 일단 마인드터치(데키위키를 이르는 말이다)를 정지시키고, luceneindex 폴더를 삭제하고, 다시 시작하라는 말이다.

사용하고 있는 게 우분투 리눅스라면 아래 명령을 차례로 쳐 주면 되겠다. 스크립트를 사용하면되겠다.

<pre>/etc/init.d/dekiwiki stop
rm -rf /var/www/dekiwiki/bin/cache/luceneindex
/etc/init.d/dekiwiki start</pre>

이렇게 하고 관리 패널로 들어가서 Cache Management 에 가면 루신이 검색 인덱스를 재생성하고 있을 거다. 시간은 좀 걸린다.

이상.

 [1]: http://www.mindtouch.com/
 [2]: http://mytory.net/archives/233 "dekiwiki 오류와 해결책 계속 쓰는 페이지"
 [3]: http://forums.developer.mindtouch.com/showthread.php?8065-Search-index-empty-error-after-upgrading-to-Olympic&p=41121#post41121