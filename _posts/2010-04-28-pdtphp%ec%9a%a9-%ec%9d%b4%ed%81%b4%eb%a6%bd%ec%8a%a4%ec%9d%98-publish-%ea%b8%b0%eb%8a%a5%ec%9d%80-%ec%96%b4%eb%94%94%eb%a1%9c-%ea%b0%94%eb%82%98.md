---
title: PDT(PHP용 이클립스)의 publish 기능은 어디로 갔나
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/545
aktt_notify_twitter:
  - yes
daumview_id:
  - 36963204
categories:
  - 개발 툴
tags:
  - Eclipse
---
<a href="http://www.ibm.com/developerworks/kr/library/tutorial/os-eclipse-europa2/section4.html" target="_blank">IBM의 PDT(PHP용 이클립스) 설명</a>을 보다가 PDT에도 java용 이클립스처럼 publish 기능이 있다는 걸 알게 됐다.

<div>
  이건 좋은 기능이라고 생각했다.
</div>

<div>
  예컨대, 개발을 할 때, 이미 많이 사용하고 있는 홈페이지라면&#8230;
</div>

<div>
  개발용으로 필요한 건 소스코드뿐인데, 그동안 축적돼 있던 게시판의 사진들까지 모두 소스코드가 있는 폴더에 담아 두고 개발을 하느라고 svn 돌리기도 성가시고 여간 귀찮은 게 아니었다. svn이 무식하게 사용자들이 업로드한 그림파일 1만 개를 모두 기록하고 있는 건 상상도 하기 싫은 일이다.
</div>

<div>
  그렇다고 그림파일을 다 지우면 테스트를 할 때 또 성가신 경우가 있다. 그림파일을 보면서 작업을 해야 하는 경우도 있기 때문이다. 대표적으로 사진 갤러리를 만들 때, 그림 업로드 로직을 만들 때 등등.
</div>

<div>
  그런데 만약 소스코드와 서버의 실제 publish되는 폴더를 구분해서 사용한 수 있다면 위 문제가 해결된다.
</div>

<div>
  그래서 좋다고 생각하고 publish 기능을 설정하려고 했다.
</div>

<div>
  <div style="width: 510px" class="wp-caption aligncenter">
    <img src="/uploads/legacy/old-images/1/cfile6.uf.164C4D4C4D4BC8F22F4E47.jpg" alt="" width="500" height="305" /><p class="wp-caption-text">
      △이게 IBM 설명에 나와 있는 스크린샷이다. 그런데...
    </p>
  </div>
  
  <div style="width: 535px" class="wp-caption aligncenter">
    <img src="/uploads/legacy/old-images/1/cfile29.uf.1941264E4D4BC8F133D659.png" alt="" width="525" height="319" /><p class="wp-caption-text">
      △내 PDT에는 Publish Projects to this Server 를 설정하는 항목이 없었다.
    </p>
  </div>
</div>

<div>
  그런데 설정하는 항목이 없었다. 엥? 뭥미.
</div>

<div>
  그럼 publish 기능은 쓸모 없는 기능이란 말인가?
</div>

<div>
  구글신에게 물어봤다. 역시 <a href="http://wiki.eclipse.org/PDT/FAQ#Can_I_publish_.28a_selection_of.29_individual_files_at_any_given_moment_with_an_easy_user_action.3F" target="_blank">해답</a>을 내려 주셨다.
</div>

<div>
  <div>
    <blockquote>
      <p>
        <strong>PDT에서 서버로 파일을 어떻게 발행(publish)하죠?</strong>
      </p>
      
      <div>
        PDT2.0부터, 더이상 빌트인 기능이 없습니다. 이미 존재하는, RSE라는 더 강력한 솔루션이 나왔기 때문에 사라졌습니다. 당신은 <a href="http://wiki.eclipse.org/TM_and_RSE_FAQ" target="_blank">RSE</a>를 이용해서 파일을 발행할 수 있습니다.
      </div>
      
      <div>
        <a href="http://wiki.eclipse.org/TM_and_RSE_FAQ" target="_blank">RSE</a>를 설치하려면 설명서의 <a href="http://wiki.eclipse.org/TM_and_RSE_FAQ#Download.2C_Installation_and_Bug_Reports" target="_blank">&#8216;다운로드, 설치, 버그 보고&#8217;</a> 부분을 참고하세요.
      </div>
    </blockquote>
    
    <p>
      그래서 <a href="http://download.eclipse.org/tm/downloads" target="_blank">RSE를 설치</a>해 보기로 했다. 설치하면 또 쓰겠다.
    </p>
  </div>
</div>