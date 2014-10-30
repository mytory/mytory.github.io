---
title: '[우분투] 컴피즈 마우스 포인터 변경이 안 될 때(부분만 변경될 때)'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/746
aktt_notify_twitter:
  - yes
daumview_id:
  - 36817283
categories:
  - 기타
tags:
  - Ubuntu
  - Ubuntu Family
---
컴피즈의 버그가 원인이라고 합니다. <div>
  마우스 포인터 변경을 해도 커서 포인터는 바뀌고 그냥 포인터는 안 바뀌고 막 이런 경우가 있습니다. 일관성 없는 포인터 변경 때문에 열라 짜증나게 되죠. 그래도 제가 명색이 프로그래먼데 오기가 생겼습니다. 그래서 과감하게 영어로 검색을 했죠!
</div>

<div>
  (참고로 컴피즈 설정 관리자의 일반 탭에 있는 cursor theme 항목은 10.04로 오면서 사라진 것 같습니다.) <div>
    <div>
      <a href="http://www.webupd8.org/2010/08/how-to-change-mouse-cursor-theme-in.html" target="_blank">http://www.webupd8.org/2010/08/how-to-change-mouse-cursor-theme-in.html</a>
    </div>
    
    <div>
      여기서 보니깐 방법이 나와 있네요. 하지만 창 띄워서 하는 게 아니라 직접 명령어를 입력해야 하는 거라 권장하긴 좀 뭣하네요.
    </div>
    
    <div>
      일단, 원하는 아이콘 테마 이름을 숙지합니다.
    </div>
    
    <div>
      아이콘 테마 이름은 <stong>모양 > 사용자 설정 > 포인터에 가면 확인해 볼 수 있습니다. 아래 이미지를 확인하세요.</stong>
    </div>
    
    <div>
      <img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/old-images/1/cfile23.uf.1412E1564D4BC960288927.png" class="aligncenter" width="540" height="373" alt="" />
    </div>
    
    <div>
      여기서 원하는 놈을 선택해 줍니다.
    </div>
    
    <h2>
      방법1
    </h2>
    
    <div>
      자, 그다음 터미널을 열든가 아님 Alt+F2 를 눌러서 명령줄을 입력할 수 있게 합니다.
    </div>
    
    <div>
      거기에 아래 코드를 입력하고 엔터 칩니다.
    </div>
    
    <div>
      <pre class="brush:plain">gksu gedit /usr/share/icons/default/index.theme</pre>
    </div>
    
    <div>
      그러면 gedit가 뜨면서 내용이 나오는데요, 이 중에 inherits 항목을 찾습니다. 대충 아래처럼 돼 있을 거예요.
    </div>
    
    <div>
      <pre class="brush:plain">Inherits = oxy-black</pre>
    </div>
    
    <div>
      저 oxy-black이 바로 아이콘 커서 테마 이름이죠. 원하는 놈을 써 줍니다.
    </div>
    
    <div>
      위에서 링크한 글의 필자는 지우고 하지 말고 맨 앞에 #를 붙이고 아래에 새로 쓰라고 조언하네요. 저도 그게 더 좋다고 생각합니다. #를 붙이면 영향을 못 미치게 되거든요,
    </div>
    
    <div>
      그러면 아래처럼 될 거예요. 저는 oxy-black을 whiteglass로 바꿨답니다.
    </div>
    
    <div>
      <pre class="brush:plain">#Inherits = oxy-black
Inherits = whiteglass
</pre>
    </div>
    
    <div>
      자, 저장하고요.
    </div>
    
    <div>
      <h2>
        방법2
      </h2>
    </div>
    
    <div>
      아니면 터미널에서 마우스 테마를 선택하는 방법이 있습니다.
    </div>
    
    <div>
      자, 터미널에 이 명령어를 입력해 줍니다.
    </div>
    
    <div>
      <pre class="brush:plain">sudo update-alternatives --config x-cursor-theme</pre>
    </div>
    
    <div>
      나오는 것들 중에 아까 선택한 놈으로 테마를 선택해 줍니다. 저 같은 경우는 whiteglass를 선택하면 되겠죠?
    </div>
    
    <div>
      <h2>
        방법1,2중 하나를 한 다음 마지막으로 적용시키려면
      </h2>
    </div>
    
    <div>
      그 다음 이번엔 터미널보다 Alt+F2를 권합니다. 아래 명령을 입력하고 엔터.
    </div>
    
    <div>
      <pre class="brush:plain">compiz --replace</pre>
    </div>
    
    <div>
      그러면 화면이 깜빡깜빡하고 커서가 원하는 놈으로 바뀝니다.
    </div>
    
    <div>
      올레~
    </div>
  </div>
</div>

<div>
  <b>단, 주의할 점은 &#8211; 모양에서 선택한 마우스테마와 방법1,2에서 선택한 테마가 같아야 마우스 커서가 온전히 바뀝니다.</b>
</div>

<div>
</div>