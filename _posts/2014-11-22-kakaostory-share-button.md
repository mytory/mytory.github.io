---
title: "URL만으로 카카오스토리 공유버튼 만들기"
layout: "post"
category: "etc"
tags: 
    - TIP
---

한국 중년들이 가장 많이 사용하는 SNS는 아마도 카카오스토리로 알고 있다. 그래서 내 생각엔 트위터보다 중시해야 하는 거 같던데, 뭐 내가 통계를 아는 건 아니고. 

여튼 그래서 카카오스토리 공유 버튼을 만드는데, 카카오톡 API를 졸라 뒤지고 막 이랬다. 뭐 공유하는데 로그인도 신경써야 하고 등등 좀 골치가 아팠다. 그래서 대충 만들어 놨더니만 아놔 클릭하자마자 링크만 공유되고 코멘트를 붙일 수가 없는 거다. 젠장 뭐야 이거 하고 있는 찰나. 웬걸 페이스북 공유 URL처럼 카카오스토리도 공유 URL이 있었다. 썅. 개발자 사이트에서 편하게 찾을 수 있게 해 주면 안 되나?

아래처럼 URL을 쓰면 링크가 공유된다.

    https://story.kakao.com/share?url=http%3A%2F%2Fstrike222.github.io%2Findex.html

아 뭔가 허탈함. 그니까 공유 주소 뒤에 `?url=페이지주소-URL-인코딩` 이렇게 해 주면 되는 거였다. 졸라. 아래는 실제 예시.

[현재 페이지 카카오스토리 공유](https://story.kakao.com/share?url=http%3A%2F%2Fmytory.net%2Fetc%2F2014%2F11%2F22%2Fkakaostory-share-button.html)