---
title: 블로그 이미지를 dropbox public 폴더에 넣으면 트래픽을 절약할 수 있다
author: 안형우
layout: post
permalink: /archives/2314
categories:
  - 기타
tags:
  - TIP
---

## 2017-03-27

드롭박스는 2017년 3월 15일부로 Public link 기능을 중지했다.

----

난 설치형 블로그를 사용하고 있고, 일일 트래픽은 500Mb다. [텍스트 공백 제거와 gzip 압축][1]을 사용하지 않으면 5~6시면 트래픽이 초과된다.

트래픽을 절약하는 또 하나 좋은 방법은 [드롭박스][2]의 Public 폴더를 이용하는 것이다. (드롭박스는 2Gb는 무료고 그 이상을 사용할 경우엔 50Gb의 경우 한 달에 9.99$, 1년에 99.9$를 내야 한다.)

자, Public 폴더는 뭘까? 여기 파일을 넣으면 고유 URL을 받을 수 있다. 고유 URL은 정말 고유해서 바뀌지 않는다. 내가 예전에 [구글의 Picasa 웹서비스를 이용해서 블로그 이미지 트래픽을 줄이는 방법을 설명한 적][3]이 있는데, 그것보다 드롭박스 Public 폴더를 사용하는 게 나은 것 같다. 구글 Picasa는 URL을 제어할 수 있는 방법이 없다. 지금 내 블로그의 이미지 중 깨져 있는 게 상당히 있는게 Picasa의 앨범 하나를 잘못 건드렸다가 URL이 죄다 변하는 바람에 그렇게 된 거다;;

반면 드롭박스의 Public 폴더를 이용하면 URL이 고유하고, 제어 가능하다는 장점이 있다.

## Public 폴더의 트래픽은?

물론 여기도 제한은 있다. 무료인 경우 일일 10Gb까지만 트래픽이 허용된다.(한 번 초과되면 3일 간 퍼블릭 폴더가 닫힌다고 한다.) 9.99$짜리 유료는 150Gb까지 트래픽을 허용한다.(드롭박스와 비슷한 서비스인 sugarsync는 무료 계정은 10Gb, 유료 계정은 250Gb를 일일 트래픽으로 준다.)

10Gb면 내 블로그 일일 트래픽의 20배다. 무료로 이정도 트래픽이면 아주 괜찮다고 할 수 있겠다.

## Public 폴더에 있는 파일의 URL 뽑아 내기

아래 그림을 참고한다.

<div style="width: 598px" class="wp-caption aligncenter">
  <img src="/uploads/legacy/dropbox-public-link.png" alt="" width="588" height="90" /><p class="wp-caption-text">
    드롭박스 클라이언트를 설치한 경우엔 탐색기에서 마우스 우클릭을 해서 뽑으면 된다.
  </p>
</div>

<div style="width: 583px" class="wp-caption aligncenter">
  <img class=" " src="/uploads/legacy/dropbox-web-public-link.png" alt="" width="573" height="293" /><p class="wp-caption-text">
    온라인인 경우 이렇게 Copy public link 버튼을 누르면 된다.
  </p>
</div>

 [1]: https://mytory.net/archives/1048 "[minify] js, css 압축 – 웹사이트 속도 증가, 트래픽 절약"
 [2]: https://mytory.net/archives/1784 "드롭박스 – 특별한 웹하드"
 [3]: https://mytory.net/archives/2002 "[.htaccess] 누가 내 블로그 이미지를 긁어가서 트래픽 초과되는 거 방지하기 (설치형 블로그)"
