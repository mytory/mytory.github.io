---
title: trac 에서 svn 저장소 등 환경변수 변경됐을 때 resync하기
author: 안형우
layout: post
permalink: /archives/613
aktt_notify_twitter:
  - yes
daumview_id:
  - 36917820
categories:
  - 기타
tags:
  - TIP
---
일단 직접 trac.ini를 고쳐 줘야 한다. <div>
  {trac 경로}/{프로젝트_이름}/conf/trac.ini 를 수정해 주자.
</div>

<div>
  퍼미션이 없다면, sudo 명령으로 해결하면 되겠다.
</div>

<div>
  위의 {프로젝트_이름} 부분엔 당연히 자신의 프로젝트 이름을 써야 할 것이다. {trac 경로}도 마찬가지라는 점을 모르지는 않겠지.
</div>

<div>
  여튼 trac.ini에 들어가서 아래로 쭈욱~ 내려가면 repository_dir이라는 항목이 나오는데 거기서 dir을 바꿔 준다.
</div>

<div>
  그렇게 하고, trac이 자동으로 인식해서 잘 바꿔 주면 좋겠지만, 그렇지 않은 경우는 resync를 해 줘야 한다. 이건 뭐 설정 파일을 다시 인식시키는 작업이라고 생각하면 되는 것 같다.
</div>

<div>
  <pre class="brush:plain">sudo trac-admin {trac 경로}/{프로젝트_이름} resync</pre>
  
  <p>
    </div> <div>
      위 형식으로 쓰면 된다. 그럼 만사오케.
    </div>