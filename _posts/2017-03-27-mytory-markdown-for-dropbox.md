---
title: '[Mytory Markdown for Dropbox] 드롭박스 API로 마크다운 파일을 연결해 워드프레스에 글을 올리는 플러그인'
layout: post
tags:
- wordpress
image: /uploads/2017-03/mytory-markdown-for-dropbox.jpg
description: 드롭박스 API를 이용해 드롭박스에 있는 마크다운 파일을 불러와서 워드프레스 내용을 채우는 플러그인을 만들었다. 기존 퍼블릭 링크 사용자들에게는 이전 기능을 제공한다.
date_modified: 2017-03-27 15:51:36
---

## 기존 Mytory Markdown 플러그인에 문제가 생겼다

2013년 10월 23일에 Mytory Markdown 플러그인의 첫 커밋을 했다. 만들고 나서 워드프레스 플러그인 등록을 한 것이니, 아마 그 전에 며칠 동안 개발을 했을 것이다.

드롭박스의 퍼블릭 링크를 이용한 것이었다. 퍼블릭 링크의 원리는 간단한데, 그냥 드롭박스의 `Public`이라는 폴더에 파일을 올리면 static 서버에 올린 것처럼 URL로 파일에 접근할 수 있게 되는 것이다. html 파일은 렌더링해 보여 줬다. 이 기능을 이용해서 웹사이트를 구축하는 솔루션도 있었다. 무료 사용자에게도 하루 20GB의 트래픽을 줬으니까 뭐 쓸만했다.

문제는 드롭박스가 이 기능을 죽이는 방향으로 정책을 잡고 있었다는 데 있다. 

어느 시점부터는 가입자들이 수동으로 퍼블릭 링크를 활성화해야만 퍼블릭 링크를 사용할 수 있게 됐고, 또 어느 시점부터는 유료 사용자 외에는 퍼블릭 링크를 활성화할 수 없게 했다. 무료 사용자라면 기존에 퍼블릭 링크를 사용하던 사람들만 사용할 수 있게 된 것이다.

그래서 2015년 7월 29일에 드롭박스 퍼블릭 링크 url뿐 아니라 모든 url을 사용할 수 있도록 조치했다. Github raw URL을 활용하라고 권했다.

그리고 최근인 2017년 3월 15일, 무료 사용자들의 모든 퍼블릭 링크 기능이 작동 중단됐다.

## 드롭박스 API를 이용한 플러그인 구상

내가 사용하려고 만든 플러그인인데 상당히 호응이 좋았다. 지금도 100명 정도가 활성화해 놨다고 나온다. 리뷰도 몇 개 달렸고, 기능 제안도 몇 개 들어왔다. 몇 개는 반영했다.

애착이 있어서 드롭박스 퍼블릭 링크로 사용하던 사람들이 이대로 내 플러그인을 사용 중단하게 하고 싶진 않았다. 그래서 Mytory Markdown for Dropbox라는 플러그인을 구상했다. 

로직은 간단하다. 드롭박스 API에 연결한다, 드롭박스에 있는 마크다운 파일을 고른다, 내용을 업데이트한다.

기존에 있던 자동 업데이트 기능은 까다로워서 새 플러그인에서는 뺐다. 대신 글쓴이가 보기 화면에서 직접 업데이트를 할 수 있게 만들었다. 소개 동영상을 만들었으니 한 번 보시라.

<div class="video-container"><div class="video-container__inner">
<iframe width="560" height="315" src="https://www.youtube.com/embed/fc-ROSH8Eng?rel=0" frameborder="0" allowfullscreen></iframe>
</div></div>


## 기존 퍼블릭 링크 사용자들에게 이전 기능을 제공한다

Mytory Markdown과 Mytory Markdown for Dropbox 플러그인을 모두 활성화하고, Mytory Markdown의 마크다운 파일 경로에 'dropboxusercontent'라는 문자열이 있으면 이전(migration) 기능이 활성화된다. 귀찮게 하는 알림도 떠서 못 보고 지나칠 수 없게 만들었다. 

기능 자체는 기존 url을 api 기반의 폴더 경로로 변환해 주는 간단한 기능인데, 여튼 사용자가 살짝 검토한 다음에 변환하면 되게 해 놨다. 

이전 기능 동영상은 이거다.

<div class="video-container"><div class="video-container__inner">
<iframe width="560" height="315" src="https://www.youtube.com/embed/ZmPWMBvGuS4?rel=0" frameborder="0" allowfullscreen></iframe>
</div></div>



## 개발하면서 배운 점

개발하면서 배운 점은 차차 자세히 쓰면 좋을 것 같다. 우선 간단히만 쓴다.

### OAuth 2.0의 두 가지 인증 방식

OAuth 2.0 인증을 공부하고 구현해 본 건 처음이었다. 원래 SNS와 서비스를 결합하는 데 약간 거부감이 있어서 그렇게 하지 않았었는데, 이번 건 별 수 없었으니 말이다. 

OAuth 사용자 인증 방식에 두 가지 종류가 있다는 것을 알았다. 

- code flow: 드롭박스 페이지에서 code를 출력해 주고 사용자가 직접 서비스에 복붙한다. Mytory Markdown for Dropbox에선 이 방법을 사용해야 했다. token flow를 사용하면 `return_url`이 필수인데 이놈이 반드시 `https`여야 하기 때문이다. 
- token flow(혹은 implicit grant flow): 사용자가 관여하는 부분이 없다. 그냥 드롭박스 페이지에 가서 예스를 누르고 원래 웹사이트로 돌아오면 끝이다. 나머지는 서버가 처리한다. 


### http로 드롭박스에 요청을 보낼 때

http로 드롭박스에 요청을 보낼 때 Content-Type이 `application/json`인 경우 데이터를 대체 어떻게 보내라는 건지 헷갈렸다. 웬걸, 그냥 json문자열을 post 방식을 이용해서 통으로 문자열로 보내는 거였다. 키-값 쌍이 *아니고* 말이다. 이걸 몰라서 3~4시간을 삽질했다.


## 후기

드롭박스 PHP SDK가 공식으로 제공되진 않고, 커뮤니티 버전으로 있긴 한데, 워드프레스는 PHP 5.2까지 지원해야 하므로 사용하지 않았다. 그냥 HTTP 호출과 js를 사용했다. OAuth를 HTTP 호출로 사용하는 코드를 작성해 본 건 도움이 됐다.

여튼, 이상. 3월 15일에 퍼블릭 링크 기능이 정지되고 부채감이 마음을 짓눌렀는데, 이제 좀 살 것 같다. 12일이나 늦게 대안을 출시한 것이지만, 늦게나마 출시해서 다행이다.








