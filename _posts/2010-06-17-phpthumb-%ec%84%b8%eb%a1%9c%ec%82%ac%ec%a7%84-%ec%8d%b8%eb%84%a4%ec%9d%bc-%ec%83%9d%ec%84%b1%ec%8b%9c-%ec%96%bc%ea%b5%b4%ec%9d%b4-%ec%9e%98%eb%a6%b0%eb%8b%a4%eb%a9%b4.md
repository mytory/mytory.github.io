---
title: phpThumb 세로사진 썸네일 생성시 얼굴이 잘린다면?
author: 안형우
layout: post
permalink: /archives/679
aktt_notify_twitter:
  - yes
daumview_id:
  - 36864241
categories:
  - 서버단
tags:
  - PHP
  - phpThumb()
---
phpThumb 덕에 썸네일 걱정없이 산지 몇 주가 됐습니다. <div>
  철저하게 API를 분석, 공부하고 프로그램을 설치한 게 큰 도움이 된 것 같습니다.
</div>

<div>
  그런데 문제가 생겼습니다.
</div>

<div>
  사람 얼굴이 있는 세로사진으로 가로 모양의 썸네일을 생성하니까 사람 얼굴이 잘려 버리는 것이었습니다.
</div>

<div>
  아래를 참고하세요.
</div>

<div>
  <div style="width: 310px" class="wp-caption aligncenter">
    <img src="/uploads/legacy/old-images/1/cfile22.uf.180D9C494D4BC950264C00.jpg" width="300" height="464" alt="" /><p class="wp-caption-text">
      △이게 원본입니다. 클릭하면 이 사진이 있는 기사로 갑니다.
    </p>
  </div>
</div>

<div>
  <div style="width: 80px" class="wp-caption aligncenter">
    <img src="/uploads/legacy/old-images/1/cfile26.uf.132592484D4BC9512F1E9F.jpg" width="70" height="50" alt="" /><p class="wp-caption-text">
      △가로 70px, 세로 50px의 썸네일을 생성하자 이렇게 노회찬 진보신당 대표의 얼굴이 잘려 버립니다.
    </p>
  </div>
</div>

<div>
  분명히 자를 때 위치를 조정하는 방법이 있을 거라고 생각하고 다시 phpThumb의 API를 뒤졌습니다.
</div>

<div>
  역시 있었습니다. 두 가지 방법이 있었습니다. 그 중에 효율적이라고 생각하는 방법을 알려드리겠습니다.
</div>

## 사진 잘라서 썸네일 만들 때 위치를 정하는 방법

<div>
  일단, 수정한 결과는 아래처럼 됐습니다.
</div>

<div>
  <div style="width: 80px" class="wp-caption aligncenter">
    <img src="/uploads/legacy/old-images/1/cfile10.uf.111D52524D4BC95126CF3F.jpg" width="70" height="50" alt="" /><p class="wp-caption-text">
      △수정한 후 모습입니다. 세로사진인 경우 약간 위쪽을 자르도록 했습니다.
    </p>
  </div>
</div>

<div>
  이걸 하면서 <a href="http://phpthumb.sourceforge.net/demo/demo/phpThumb.demo.demo.php#x4" target="_blank">참고한 데모 페이지는 여기</a>입니다.
</div>

<div>
  그리고 위 사진의 주소는 아래와 같습니다.
</div>

<div>
  http://www.left21.com/phpThumb/phpThumb.php?w=70&sx=0&sy=30&sw=300&sh=214&src=/Photo/left21_0034/left21_0034_10.jpg
</div>

<div>
  자, 아래 표는 위에서 사용한 각 변수들을 나타냅니다.(<a href="http://phpthumb.sourceforge.net/demo/docs/phpthumb.readme.txt" target="_blank">phpThumb readme.txt</a>의 parameters 항목을 참고하면 됩니다.)
</div>

<div>
  <table style="width:450px;height:40px;border:none;" bgcolor="#aaaaaa" cellspacing="1" cellpadding="0">
    <tr bgcolor="#ffffff">
      <td width="135">
        &nbsp;<b>변수명</b>
      </td>
      
      <td width="135">
        <b>&nbsp;뭔가?</b>
      </td>
      
      <td width="135">
        <b>&nbsp;무엇의 약자인가?</b>
      </td>
    </tr>
    
    <tr bgcolor="#ffffff">
      <td width="135">
        &nbsp;w
      </td>
      
      <td width="135">
        가로 사이즈겠죠
      </td>
      
      <td width="135">
        width
      </td>
    </tr>
    
    <tr bgcolor="#ffffff">
      <td width="135">
        &nbsp;sx
      </td>
      
      <td width="135">
        x축 시작위치
      </td>
      
      <td width="135">
        source x &#8211; left side of source rectangle
      </td>
    </tr>
    
    <tr bgcolor="#ffffff">
      <td width="135">
        &nbsp;sy
      </td>
      
      <td width="135">
        y축 시작위치
      </td>
      
      <td width="135">
        source y &#8211; top side of source rectangle
      </td>
    </tr>
    
    <tr bgcolor="#ffffff">
      <td width="135">
        &nbsp;sw
      </td>
      
      <td width="135">
        x축 길이
      </td>
      
      <td width="135">
        source width &#8211; width of source rectangle
      </td>
    </tr>
    
    <tr bgcolor="#ffffff">
      <td width="135">
        &nbsp;sh
      </td>
      
      <td width="135">
        y축 길이
      </td>
      
      <td width="135">
        source height &#8211; height of source rectangle
      </td>
    </tr>
    
    <tr bgcolor="#ffffff">
      <td width="135">
        &nbsp;src
      </td>
      
      <td width="135">
        사진 주소
      </td>
      
      <td width="135">
        source
      </td>
    </tr>
  </table>
  
  <p>
    자, 위의 변수들을 조합하면 원본 사진을 원하는 위치로 자른 다음 축소하는 게 가능해지는 겁니다.
  </p>
</div>

<div>
  그림으로 표현하면 아래처럼 되겠죠.
</div>

<div>
  <img src="/uploads/legacy/old-images/1/cfile22.uf.15420D4E4D4BC951323B43.jpg" class="aligncenter" width="300" height="464" alt="" />
</div>

<div>
  sx, sy, sw, sh 를 이용하면 원본 이미지를 자를 수 있습니다. 만약
</div>

<div>
  <pre class="brush:plain">/phpThumb.php?src=filename.jpg&sx=0&sy=30&sw=300&sh=214</pre>
</div>

<div>
  이렇게 썼다면, 위에서 네모칸을 친대로 이미지가 잘려서 표시될 겁니다.
</div>

<div>
  sx는 자르기 시작할 x축 위치를 의미합니다.
</div>

<div>
  sy는 자르기 시작할 y축 위치를 의미합니다.
</div>

<div>
  sw는 자를 넓이를 의미합니다.
</div>

<div>
  sh는 자를 높이를 의미합니다.
</div>

<div>
  그래서 위 주소처럼 쓴다면?
</div>

<div>
  x축 0와 y축 30에서 자르기 시작해, 가로로 300px, 세로로 214px을 잘라라. 하는 게 되죠.
</div>

<div>
  그 결과 아래처럼 표시되는 겁니다.
</div>

<div>
  <img src="/uploads/legacy/old-images/1/cfile4.uf.130CBE494D4BC9512866E7.jpg" class="aligncenter" width="300" height="214" alt="" />
</div>

<div>
  그리고 마지막으로, w=70 이라고 넣어 준다면?
</div>

<div>
  그러면 아래처럼 위 이미지가 축소되는 것입니다.
</div>

<div>
  <img src="/uploads/legacy/old-images/1/cfile10.uf.111D52524D4BC95126CF3F.jpg" class="aligncenter" width="70" height="50" alt="" />
</div>

<div>
  참 쉽죠잉?
</div>

## 기본적으로 자를 사이즈는 프로그램쪽에서 해 줘야

<div>
  자, 여기서 php 등 프로그램 쪽에서 sh를 계산해 줘야 할 필요가 있습니다.
</div>

<div>
  가로 사이즈가 300인 아이도 있겠죠, 500인 아이도 있겠죠.
</div>

<div>
  모든 썸네일을 70&#215;50 으로 만들고 싶습니다. 그러면 어떻게 할까요?
</div>

<div>
  일단 sx=0 으로 하고 sw는 그냥 기본 width를 넣으면 될 겁니다. 이건 php 등에서 <a href="http://bombfox.egloos.com/1065290" target="_blank">이미지 사이즈를 구하는 함수를 사용</a>하면 되겠죠.
</div>

<div>
  자, 가로 사이즈에 맞춰서 자를 세로 사이즈를 구해야 합니다.
</div>

<div>
  그러면? php라면 아래처럼 계산하면 되겠죠.
</div>

<div>
  <pre class="brush:php">$sh = $가로사이즈 * ( 50 / 70 )</pre>
</div>

<div>
</div>

<div>
</div>