---
title: 오픈소스 애자일/스크럼 프로젝트 관리 툴, iceScrum 기본 개념과 사용법 익히기
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/11279
mytory_markdown_html:
  - |
    |
        
        <p><a href="http://www.icescrum.org/en/">iceScrum</a>은 <a href="http://ko.wikipedia.org/wiki/%EC%8A%A4%ED%81%AC%EB%9F%BC_(%EC%95%A0%EC%9E%90%EC%9D%BC_%EA%B0%9C%EB%B0%9C_%ED%94%84%EB%A1%9C%EC%84%B8%EC%8A%A4)">스크럼 개념</a>을 적용한 훌륭한 프로젝트 관리 툴이고 오픈소스다. 라이선스는 주로 GNU Affero GPL V3, 부분적으로 LGPL V3라고 웹사이트에 설명돼 있다.</p>
        
        <p>자바로 작성돼 있고, 리눅스에서 tomcat으로 돌리면 되는데, 윈도우나 맥의 경우엔 설치프로그램이 있다. 다운받아서 그냥 실행하면 번거로운 과정 없이 바로 실행된다.</p>
        
        <p>내장 DB를 사용하는 경우엔 데이터베이스도 설정할 게 없는데 실사용하는 경우엔 내장 DB는 권장하지 않는다. 공식 문서에서도 그렇게 말하고 있다. 나도 내장 DB를 사용하다가 데이터를 다 날려 먹은 경험이 있다. 따라서 실사용하려면 반드시 외부 데이터베이스를 사용하라. 외부 데이터베이스를 연결해서 사용하려면 수동으로 설정을 해 줘야 한다.</p>
        
        <p>설치와 설정은 <a href="https://www.kagilum.com/documentation">Documentation</a>을 참고. 여기선 사용법을 설명하는 것이므로 설치 방법은 따로 설명하지 않는다. 검색해 보면 몇 개 나오니까 그거 참고해도 된다. 단, iceScrum 최신 버전은 설정 파일이 groovy 형식이라는 걸 알아 두기 바란다. 옛날 설정 파일 방식을 기준으로 설명하는 옛날 글들이 있으니 잘 비껴 가기를.</p>
        
        <p><a href="https://www.kagilum.com/icescrum-hosting">iceScrum Cloud</a>에 가입해서 사용할 수도 있다. 무료 계정에는 혼자서만 사용할 수 있는 프로젝트 하나를 준다. 이 경우엔 아이디 하나를 팀원 여럿이 공유하며 테스트해 볼 수도 있겠다.</p>
        
        <p>인터페이스가 영문이므로 용어는 그냥 영문으로 표기했다.</p>
        
        <h2>스크럼이란</h2>
        
        <p>스크럼 개념에 대해서는 스크럼으로 검색하면 책이 여러 개 있으니 한 권 골라 읽으면 된다. 툴부터 도입하기보다는 관리 개념을 익히는 게 우선이다.</p>
        
        <p>위키백과의 <a href="http://ko.wikipedia.org/wiki/%EC%8A%A4%ED%81%AC%EB%9F%BC_(%EC%95%A0%EC%9E%90%EC%9D%BC_%EA%B0%9C%EB%B0%9C_%ED%94%84%EB%A1%9C%EC%84%B8%EC%8A%A4)">스크럼 개념</a>을 참고해도 되겠지만, 내가 생각에 스크럼 방법론의 핵심은 일정 기간에 한 번씩 작동하는 버전업된 제품을 내놓기 위해 일정 기간동안 방해받지 않고 전력질주(Sprint)하는 데 있다. 즉, 두 가지가 핵심이다.</p>
        
        <ol>
        <li><strong>스크럼의 목적:</strong> 점진적으로 빠르게 발전하는 제품. 한 전력질주 기간(Sprint)이 끝나면 개선된 제품이 나온다.</li>
        <li><strong>방법:</strong> 한 전력질주 기간(Sprint) 동안은 해당 기간에 처리하기로 한 일만 한다. 누구도 중간에 요구사항을 변경할 수 없다. 누구도 스크럼 팀에 다른 일을 시킬 수 없다. 이렇게 해서 잦은 요구사항 변경을 원천봉쇄한다.</li>
        </ol>
        
        <p>스크럼의 나머지 부분은 이 전력질주를 성공시키기 위한 조언들이다.</p>
        
        <p>아주 간략한 설명이므로 스크럼 관련 책을 꼭 읽기 바란다. 검색하면 많이 나오니 내가 따로 추천하지는 않겠다.</p>
        
        <p>iceScrum은 원래 스크럼의 개념에 약간 변형을 가한 것이다. 예컨대 원래 스크럼 개념에는 Release가 따로 없다. 각 Sprint가 Release다. 그런데 iceScrum은 여러 개의 Sprint로 한 Release를 구성한다. 기본 세팅돼 있는 건 Sprint 6개당 Release 하나다. 또, 원래 스크럼에선 한 달을 Sprint 기간으로 추천하는데 iceScrum에선 2주로 추천한다. 이 글은 원본 스크럼의 개념이 아니라 iceScrum 툴의 개념을 설명한다.</p>
        
        <p>참고로, Sprint 기간을 28일로 하고, Release 기간도 28일로 하면 원래 스크럼 개념대로 iceScrum을 사용하는 게 된다.</p>
        
        <h2>할 일의 기본단위와 흐름</h2>
        
        <p>iceScrum에서 할 일의 기본 단위는 Story다. Story는 또 여러 개의 Task로 나누어서 처리하게 된다. 그러니 Story는 여러 개의 자잘한 할 일로 쪼개질 수 있는 좀 작은 단위 정도로 생각하면 되겠다. 예를 들면 Story는 "공지사항 붙이기" 같은 거고, Task는 "목록 페이지 만들기", "글쓰기 페이지 만들기", "글쓰기 DB 입력 만들기"처럼 상세 할 일이다.</p>
        
        <p>Story는 기술적인 내용뿐 아니라 필요한 기능 전체를 말한다. 개발자뿐 아니라 기획자나 디자이너처럼 프로젝트에 관련된 모든 사람들이 Sandbox에 Story를 제안한다. 이 때 제안은 Story 개념에 맞든 안 맞든 상관없다. Scrum Master가 알아서 정리를 하면 된다.</p>
        
        <p>Sandbox에 제안된 Story들 중 Scrum Master가 승인(Accept)한 것이 Product Backlog에 들어가거나 Feature가 되거나, urgent(긴급) task가 된다. 자세한 건 뒤에 설명한다. 여튼 핵심은 Scrum Master가 승인(Accept)하지 않으면 어떤 Story도 프로젝트의 일부가 될 수 없다는 거다.</p>
        
        <p>Product Backlog에서 각 Story의 Effort를 설정해 주면 이제 그걸 Sprint plan에 할당할 수 있게 된다.</p>
        
        <p>Sprint에 Story들을 할당한 뒤, Activate Sprint 버튼을 누르면 Sprint가 시작된다. 그러면 각 Story별로 Task를 작성할 수 있게 된다.</p>
        
        <p>그래서 구성단위는 <strong>Project > Release > Sprint > Story > Task</strong>다. 즉, 여러 개의 Task로 Story가 구성되고, 여러 개의 Story로 Sprint가 구성된다. 그리고 여러 개의 Sprint로 Release가 구성되고, 여러 개의 Release로 Project가 구성된다.</p>
        
        <h2>페이지와 개념 연결</h2>
        
        <p>각 단위의 설정을 변경하려면 어느 메뉴로 가야 하는지 익히는 게 필요하다. 현재 Task들을 확인하려면 Sprint Plan 탭으로 가야 한다. Sprint를 확인하고 설정을 변경하려면 Release Plan 탭으로 가야 하고, Release를 확인하고 설정을 변경하려면 Timeline으로 가야 한다.</p>
        
        <p>한 Sprint 안에 있는 Story들의 순서를 변경하려면? Release 탭으로 가야 한다. 처음에 이게 좀 헷갈리는데, 적응하면 괜찮을 거다.</p>
        
        <p>iceScrum 전체의 데모를 보는 건 간단하다. <a href="http://tools.icescrum.org/p/ICESCRUM#project">iceScrum 프로젝트를 관리하는 iceScrum 페이지</a>에 가 보면 된다. 우측 상단의 Connect 버튼을 눌러 가입(Registration)하고 로그인하면 Timeline, Release plan, Sprint plan을 볼 수 있고 심지어 Sandbox에 Story를 제안할 수도 있다.</p>
        
        <h2>프로젝트 만들기</h2>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-1.png" alt="iceScrum 기본화면" /></p>
        
        <p>iceScrum에 일단 로그인하면 위와 같은 화면이 나온다. 좌측 상단의 <strong>Project > Create</strong>를 클릭하면 새 프로젝트를 만들 수 있다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-create-project.png" alt="icescrum create project" /></p>
        
        <p>위 이미지는 프로젝트 생성 화면인데, 일일이 설명하지는 않겠다.</p>
        
        <p>정보를 채우고 우측 하단의 'Next' 버튼을 누르면 다음 단계로 넘어간다. Key는 URL에 사용된다.</p>
        
        <h2>Choose your team(팀원 고르기)</h2>
        
        <p>Choose your team 항목에서는 포함할 팀을 고른다. ID로 검색을 해서 추가하면 되는데, 프로젝트를 생성하고 있는 자신의 역할이 뭔지 보자. "PO&amp;SM"이라고 돼 있을 것이다. 이건 Project Owner와 Scrum Master의 약자다.</p>
        
        <h2>Define your practices(프랙티스 정의)</h2>
        
        <p>Define your practices 부분에 좀 복잡한 게 나온다. 이미지를 먼저 보자.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-define-your-practices.png" alt="Define your practices tab" /></p>
        
        <ul>
        <li><strong>Suite used for estimation:</strong> 할 일에 드는 노력을 측정할 때 숫자를 선택하게 되는데, 이 때 셀렉트박스에 1,2,3,4,5,6,7,8,9,10 하는 식으로 숫자가 나오게 할지, 아니면 <a href="http://ko.wikipedia.org/wiki/%ED%94%BC%EB%B3%B4%EB%82%98%EC%B9%98_%EC%88%98">피보나치 수열</a>(1, 2, 3, 5, 8, 13, 21, 34)로 숫자가 나오게 할지 정하는 것이다. 사실 5를 넘어가는 할일에 드는 노력을 정확하게 1단위로 측정하는 건 불가능하니 숫자가 커질수록 어림짐작으로 크게 노력을 잡는 건 합리적으로 보인다. 그래서 난 피보나치 수열로 노력을 선택하는 걸 선호한다.<br />
        한 가지, 염두에 둘 건, 이 때 숫자는 그냥 숫자라는 거다. 팀 내규로 이 숫자가 추상적 노력을 의미하게 할지, 시간을 의미하게 할지, 아니면 1이 10분을 의미하게 할지 그냥 정하면 된다.</li>
        <li><strong>Disable Estimation (effort=1):</strong> 노력 측정을 꺼버리는 옵션이다. 이러면 모든 할일에 드는 노력을 1로 계산한다. 즉, 그냥 할일을 건수로만 취급하는 것이다. 프로젝트 측정을 너무 세부적으로 하면 오히려 측정 피로감이 생길 수 있으니 이렇게 하는 것도 방법중 하나다.</li>
        <li><strong>Hide weekends in charts:</strong> 차트에서 주말을 빼버리는 옵션. 주말에 일 안하면 그래프가 계단형이 돼 이쁘지 않을 거다. 그래프를 미려하게 만들기 위한 옵션이라고 생각하면 되겠다.</li>
        <li><strong>Automatically set a story as done when all its tasks are done:</strong> Story 안의 모든 Task가 완료되면 Story를 완료된 것으로 할지 정하는 것이다. 난 No로 해 놓는다. 모든 Task를 완료했는데 다시 Task가 떠오르는 경우가 있기 때문이다.</li>
        <li><strong>Auto create task on empty story when sprint is activated:</strong> Activate sprint 버튼을 눌러 Sprint를 활성화했을 때 모든 스토리에 기본 Task를 하나씩 박아줄지 정하는 것이다. Task는 기본적으로 Story와 같은 이름으로 생성된다. Task가 하나밖에 없는 간단한 Story들을 많이 사용하는 경우라면 이걸 yes로 해 놨을 때 편할 거다. 이건 프로젝트별로 알아서 정하면 된다.</li>
        <li><strong>Auto assign team member on start task:</strong> Task를 in progress 상태로 만들면, 그렇게 만든 사람에게 자동으로 해당 Task를 할당하게 하는 거다. 할 일을 스크럼 마스터가 할당하는 경우가 많다면 no로 하면 될 테고, 그렇지 않고 자기 할 일을 자기가 직접 고르는 경우가 많다면 yes로 하면 될 것이다.</li>
        <li><strong>Display recurrent tasks:</strong> Sprint Plan 화면에서 recurrent tasks(반복적 task) 항목을 보여 줄지 선택한다. 반복적으로 해야 하는 task가 있다면 yes로 한다. 나는 없어서 no로 했다. 뭐, 규모가 큰 프로젝트에서 하루에 한 번씩 꼭 전체 Test를 수동으로 수행해야 한다면 반복적 Task를 이용할 수도 있겠다.</li>
        <li><strong>Display urgent tasks:</strong> Sprint Plan 화면에서 urgent tasks(긴급 task) 항목을 보여 줄지 선택한다. Sprint는 원래 다른 모든 요구를 무시하고 스프린트 시작 전에 하기로 한 Story들에만 집중하는 프로젝트 관리 방법이다. 그러나 실세계는 생각대로 안 된다. Sprint를 한창 진행중이더라도 웹사이트가 갑자기 뻗었다면 수리를 해야 한다. 그런 task를 적어 넣는 곳이 urgent tasks 항목이다. 유지보수 팀이 따로 있어서 제품 제작팀이 유지보수를 신경쓸 필요가 없는 경우라면 이 항목을 활성화하지 않아도 될 거다. 그렇지 않다면 쓰게 될 테니 활성화하자.</li>
        <li><strong>Limit of urgent tasks in progress(0=no limit):</strong> 긴급 task의 개수를 제한하는 설정이다. 너무 많아지지 않도록 하는 기능일 텐데 취향대로 하자.</li>
        </ul>
        
        <h2>Start your project(프로젝트 시작)</h2>
        
        <p>Define your practices를 다 설정하고 Next 버튼을 누르면 Start your project 화면이 나오는데, 이것도 설정 잘 해야 한다. 아래 이미지를 보자.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-start-your-project.png" alt="iceScrum start your project tab" /></p>
        
        <p>모든 프로젝트에는 여러 개의 Release가 있다. 한 Release는 여러 개의 Sprint로 구성된다. 위 이미지를 보면 Default sprint duration이라는 항목이 있는데, iceScrum에선 이게 기본으로 14로 돼 있다. 내가 본 《스크럼》이라는 책에서는 한 달을 예시로 제시했었다. 여튼 다른 일에 간섭받지 않고 집중해서 프로젝트에 매달린 후 다시 할일들을 선정할 한 기간을 얼마로 정할지 써 주는 건데, 그래서 이걸 14일 단위로 했다면 하나의 Release가 여러 개의 Sprint로 구성되므로 Release는 2주의 정수배로 설정을 하는 게 좋을 거다. 즉, 한 Sprint가 2주라면 한 Release는 2주나 4주, 아니면 6주 식이 되는 게 좋다는 거다. 뭐 그렇다고.</p>
        
        <p>그럼 다음 설명을 보자.</p>
        
        <ul>
        <li><strong>Project start date:</strong> 프로젝트 시작일이다. Sprint와 Release가 딱 맞게 설정하면 좋겠지만, 뭐 별 상관은 없다. 프로젝트 시작일에 Sprint를 activate해야 하는 건 아니니 말이다.</li>
        <li><strong>First sprint start date:</strong> 첫 Sprint 시작일이다. 주단위로 끊는 게 기본적으로는 나을 텐데, 첫 Sprint만 다른 Sprint보다 날수가 적게 할 수도 있으니까 크게 신경쓸 필요는 없다. 첫 Sprint만 수요일에 시작해서 다음주 일요일에 끝나게 하고 그 다음 Sprint부터는 월요일에 시작해서 일요일에 끝나도록 설정하면 된다. 설정은 Release plan에서 수정할 수 있다.</li>
        <li><strong>Default Sprint duration (days):</strong> 한 Sprint가 며칠로 구성되게 할 건지 정하는 거다. 대충 2주로 하는 게 깔끔해 보인다. 한 Sprint 동안은 다른 데 신경쓰지 않고 거기에 집중하는 게 원칙이다. 그리고 한 Sprint가 끝나고 나서야 다음 과제들을 고른다. 너무 길면 이슈를 신속하게 대응할 수 없게 되고, 너무 짧으면 주의가 너무 자주 흐트러질 거다.<br />
        스크럼 원칙상이야 그렇지 않지만 기능상으로는 Sprint별 날짜를 반드시 지켜야 하는 건 아니다. 즉, 수정이 가능하다. 다만 Release에 기본적인 Sprint들을 자동 배정하거나 할 때 Sprint의 기간을 이걸로 사용하게 되니 잘 작성하자.<br />
        이 항목의 값 자체도 나중에 <strong>Project > Practices</strong> 메뉴에서 수정할 수 있다.</li>
        <li><strong>Release end date:</strong> 첫 Release의 종료일을 말하는 거니 크게 신경쓰지 않고 설정하면 된다. 일단 iceScrum에선 기본적으로 12주를 한 Release의 기간으로(즉, 한 Release당 Sprint 6개) 하는데, 이건 프로젝트마다 다를 테니 알아서 잘 설정하라. 나중에 Timeline 페이지에 가서 변경할 수도 있다. 여튼, Sprint랑 아귀가 맞게 설정하면 도움이 될 거다.</li>
        <li><strong>Vision:</strong> 이 프로그램의 비전을 적는 항목이다. 팀원들이 프로젝트의 핵심을 매번 되새길 수 있게 간결한 내용을 적어 넣자. 물론 안 적어도 된다.</li>
        </ul>
        
        <p>여기까지 하면 프로젝트가 만들어진다.</p>
        
        <h2>Dashboard</h2>
        
        <p>아래는 대시보드 화면이다. 별 거 없다. 이거저거 건드려 보면 된다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-dashboard.png" alt="iceScrum dashboard" /></p>
        
        <h2>Sandbox에 Story 제안하기</h2>
        
        <p>할일 관리를 시작하는 곳이 바로 Sandbox다. 여기는 무엇이든 적을 수 있다. 스크럼은 단지 개발자들만의 도구가 아니라, 개발자가 아닌 사람들도 사용하는 도구다. 그리고 그 사람들은 바로 Sandbox에 제안을 한다. 스크럼 마스터는 그 제안을 수용하거나 거부할 수 있다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sandbox.png" alt="iceScrum sandbox" /></p>
        
        <p>위 이미지는 iceScrum 프로젝트의 샌드박스다. 각 스토리 위에 마우스를 올려 놓으면 Description이 툴팁으로 뜬다.</p>
        
        <p>새로운 스토리를 제안하려면 Sandbox 좌측 상단의 New 버튼을 누른다. 그러면 아래와 같은 화면이 나오면서 Story를 작성하게 된다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-add-new-story.png" alt="iceScrum add new story on sandbox" /></p>
        
        <p>Type은 세 종류가 있다. User story, Story defect, Technical story. 굳이 분류없이 사용해도 되지만 알아는 두자.</p>
        
        <ul>
        <li><strong>User story:</strong> 일반적으로 제안하는 기능이다. "QnA 게시판", "자동 로그아웃 기능" 따위.</li>
        <li><strong>Story defect:</strong> 버그를 말한다. "QnA 게시판 확인 두 번 누르면 글 두 번 작성되는 거 수정" 이런 거.</li>
        <li><strong>Technical story:</strong> 아마 기술적인 걸 말할 텐데, "배열을 죄다 객체로 변경" 이런 거 말이다.</li>
        </ul>
        
        <p>Description에 쓰면 마우스를 올렸을 때 툴팁으로 뜨게 된다. 여기에 좀 자세히 적는 게 나중에 도움이 된다.</p>
        
        <p>Story template은 사용해 본 적이 없어서 모르겠지만, 기본 세팅을 해놓은 걸 불러와서 사용하는 거 아닐까 추측한다.</p>
        
        <p>Story attachment는 첨부파일을 넣을 수 있는 기능이다. 그런데 한글 파일명이 문제다. 업로드는 되지만, 다운로드하면 한글이 제대로 안 나온다. 심지어 영문이나 공백없이 한글로만 된 파일명의 파일을 업로드한 뒤 다운로드하면 .hwp 식으로 다운로드가 돼 리눅스나 맥에서는 숨김파일이 되고 만다. 그러니 웬만하면 파일명을 영어로 바꿔서 올리자.</p>
        
        <p>Story notes는 더 길게 적을 수 있는 건데, 이걸 보려면 Story를 클릭해서 들어와야 하므로 번거롭다. 웬만하면 Description에 쓰고 정말 길고 자세한 내용이 있는 경우에만 이걸 사용하자.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-story-icon.png" alt="story icon" /></p>
        
        <p>위 이미지를 한 번 보자. 좌측은 technical story이고 우측은 story defect다. technical story에는 스패너 아이콘이 붙고, Story defect에는 느낌표 아이콘이 붙는다. 위 이미지엔 없지만, 첨부파일이 들어 있는 Story에는 포스트잇 이미지의 좌측 하단에 클립 모양이 나타난다.</p>
        
        <h2>Story 컨텍스트 메뉴</h2>
        
        <p>제안된 스토리에서 역삼각형 모양 위에 마우스를 올려 놓으면 아래 그림처럼 컨텍스트 메뉴가 나타난다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-story-context-on-sandbox.png" alt="iceScrum Story context menu on sandbox" /></p>
        
        <p>컨텍스트 메뉴 항목에서 <a href="http://www.agile-tools.net/acceptancetesting.asp">Acceptance tests</a>는 뭔지 모르겠고 사용해 본 적도 없다. 설명을 보면 Story가 완료된 걸 테스트하는 거라고 하는데, 게시판 Story가 완료되면 "목록 보기 > 글쓰기 > 쓴 글 읽기 > 글 수정하기" 따위의 테스트 단계를 적는 건지도 모르겠다.</p>
        
        <p>Accept as story는 이 Story를 승인해서 Product Backlog로 보내는 기능이다. Product Backlog에 들어가서 Effort를 측정한 Story만이 Sprint로 배치될 수 있다.</p>
        
        <p>Accept as feature는 이 Story를 Feature로 만드는 기능이다. Feature는 카테고리 같은 개념이라고 생각하면 될 듯하다. <a href="http://tools.icescrum.org/p/ICESCRUM#feature/productParkingLotChart">iceScrum의 프로젝트 관리 차트에 가 보면 Feature를 어떻게 활용하는지 볼 수 있다(로그인 필요, 아래 이미지).</a> Story를 제안할 때 이 Story가 속할 Feature를 고를 수 있다.</p>
        
        <p>아래 이미지는 각 Feature별로 몇 퍼센트의 Story를 완료했는지 보여 주는 그래프다.  Y축을 보면 Feature로 어떤 것들이 있는지 알 수 있다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-feature-example.png" alt="iceScrum Feature 예시" /></p>
        
        <p>iceScrum 팀이 만들어 둔 Feature 중 하나는 Exports/Print다(위 이미지상 밑에서 두 번째). Exports/Print Feature에 속한 Story 중 하나는 <a href="http://tools.icescrum.org/p/ICESCRUM/#story/582">Print post-it in sandbox(샌드박스를 포스트잇 형태로 프린트할 수 있게 하기)</a>다.</p>
        
        <p>Feature는 사용하기 나름일 텐데, iceScrum 팀은 Story를 분류하기 위해 사용하는 것으로 사용하고 있다. 이러면 Feature는 프로젝트 시작부터 끝까지 쭉 살아있게 될 것이다.</p>
        
        <p>Update는 수정이다. Copy는 똑같은 걸 하나 더 만드는 거다. 비슷한 Story들을 약간씩 다르게 만들 때 사용한다. Delete를 모를 리는 없겠고.</p>
        
        <p>아, 승인할 때 여러 개의 포스트잇을 선택한 다음 좌측 상단의 Accept 버튼을 눌러서 한꺼번에 승인할 수도 있다. <code>Ctrl+클릭</code>(맥은 <code>Cmd+클릭</code>)을 사용하면 된다. 마우스로 범위를 지정해서 선택할 수도 있다.</p>
        
        <p>Sprint plan 화면에서 Story를 승인하는 방법도 있다. 아래 이미지를 보자.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-drag-and-drop-accept-story.png" alt="drag and drop accept" /></p>
        
        <p>Product Backlog 페이지의 좌측 사이드바에는 Sandbox에 있는 Story들이 나오는데 그걸 드래그 앤 드롭해서 Product Backlog로 옮겨 놓으면 된다.</p>
        
        <h2>Product Backlog</h2>
        
        <p>승인된 할 일들이 모두 모여 있는 곳이 바로 Product Backlog(제품 밀린 일)다. 각 Story의 Effort를 다음과 같이 설정해 주면 된다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-story-effort.png" alt="story effort" /></p>
        
        <p>마우스로 물음표(?)를 클릭하면 이렇게 effort를 설정할 수 있다.</p>
        
        <p>모든 Story의 effort를 설정했다면 팀 회의를 통해서 이번 Sprint에 할 일을 정하자. Product Backlog에 있는 모든 Story를 한 눈에 보려면 Product Backlog 메뉴의 Publish as...를 사용한다. 그러면 다양한 포맷으로 목록을 내보낼 수 있는데, Word 2007 Document(docx)나 OpenDocument Text(odt)를 선택하자. Rich Text Format(rtf)은 그냥 다 깨져 나오고, Portable Document Format(PDF)은 한글이 공백으로 나온다.</p>
        
        <p>워드 포맷으로 추출된 문서를 그대로 인쇄해서 팀원들과 한 부씩 나눠 갖고선 회의를 하자. 그래서 이번 Sprint에 할 일을 정했다면 이제 Sprint Plan 페이지로 가서 Sprint에 Story를 배치하자.</p>
        
        <h2>Sprint Plan</h2>
        
        <p>Sprint Plan 페이지로 가 보면 아래처럼 애초 프로젝트 세팅대로 첫 번째 Sprint가 만들어져 있는 것을 볼 수 있다. 그러나 아직 activate를 하지 않았기 때문에 활성화된 상태는 아니다. Story도 전혀 들어있지 않다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-plan-date.png" alt="Sprint plan date" /></p>
        
        <p>Story를 추가한 뒤에 activate를 해 보자. 물론 Sprint를 activate한 뒤에도 Story를 추가할 수 있다.</p>
        
        <p>Story를 추가하는 방법은 간단하다. 좌측 사이드바에 보면 Product Backlog가 있다. 거기 있는 Story를 드래그앤 드롭으로 Sprint쪽으로 옮기면 된다. 아래 이미지 참고.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-allocate-story.png" alt="Story 배치하기" /></p>
        
        <p>순서는 일단 생각하지 말고 옮겨도 된다. 순서는 나중에 Release Plan 쪽에서 조정할 수 있다.</p>
        
        <p>Effort를 측정하지 않은 Story는 좌측 사이드바에 표시되지 않는다는 점도 알아 둬라.</p>
        
        <p>이번 Sprint에 하기로 한 Story를 모두 배치한 뒤에는 Activate sprint 버튼을 눌러서 Sprint를 활성화한다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-activate-sprint-button.png" alt="activate sprint" /></p>
        
        <p>Activate sprint 버튼을 누르면 정말 활성화할 거냐고 묻는다. 확인을 누르면 Activate sprint 버튼이 Close sprint 버튼으로 변경된다. Sprint가 종료됐을 때 이 버튼을 누르면 된다.</p>
        
        <p>Sprint 종료는 원칙상은 예정된 날짜에 하는 게 맞겠지만, 기능상은 꼭 예정된 날짜에 하지 않아도 된다. iceScrum에서 Sprint는 예정된 날짜를 넘겨도 Close sprint를 하기 전까지는 계속 활성화돼 있다. 예정된 날짜 전에 Close sprint 버튼을 눌러 Sprint를 끝내도 된다. 종료일을 수정할 수도 있다. 즉, 기능상으로는 Sprint 종료일이 표시에 불과하다는 것을 알아 두자.</p>
        
        <h2>Sprint Plan의 컨텍스트 메뉴</h2>
        
        <p>Sprint Plan 페이지에서 각 Story의 역삼각형에 마우스를 올리면 아래 이미지처럼 컨텍스트 메뉴가 나타난다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-context-menu-on-sprint-plan.png" alt="context menu on sprint plan" /></p>
        
        <p>대충 설명해 보자.</p>
        
        <ul>
        <li><strong>Add a task:</strong> 이 Story를 위한 task를 추가한다.</li>
        <li><strong>Update:</strong> 수정</li>
        <li><strong>Copy:</strong> 이 Story를 복사해 Sandbox로 넣는다.</li>
        <li><strong>Dissociate:</strong> Story를 Product Backlog로 돌려 보낸다. Story의 task는 모두 삭제된다. Sprint가 종료될 때 Story를 제거하기 위해 사용한다고 생각하면 되겠다. 물론 진행중일 때도 얼마든 사용할 수는 있다.</li>
        <li><strong>Shift to next sprint:</strong> 말 그대로 다음 Sprint로 보내는 거다.</li>
        <li><strong>Declare as done:</strong> 완료 처리</li>
        </ul>
        
        <p>Story가 모두 완료되면 Sprint를 끝내면 된다. 그런데 Sprint 안에 Story가 다 끝날 거 같지 않으면? 스크럼에선 그런 경우 할일(iceScrum에선 Story가 되겠다)을 줄이라고 말한다. 다음 Sprint에 하면 되니까 말이다.</p>
        
        <h2>Task</h2>
        
        <p>각 Story를 개발자들이 나눠 갖고, 각기 Story를 잘게 쪼개서 task를 만들면 된다.</p>
        
        <p>task에도 effort를 적게 돼 있다. Story의 컨텍스트 메뉴에서 Add a task를 선택해 보자.</p>
        
        <p>나오는 화면은 기본적으로 add new story 화면과 같다. 다른 게 하나 있는데, Remaining time이란 항목이다. 이건 남은 시간을 기록하는 거다. 시작할 때는 해당 Task 총 걸릴 시간을 적으면 된다. 역시 1을 얼마의 시간으로 생각할 건지는 각 팀이 알아서 할 일이다. iceScrum에선 그냥 1을 point라고 부른다.</p>
        
        <p>자, 어떤 Task의 Remaining time이 10point였다고 치자. 작업중에 이걸 변경해 주면 된다. 오늘 9만큼 했고, 내일 1만큼만 처리하면 끝난다고 치자. 그러면 이걸 1로 만들고 퇴근하면 되는 거다. 3point로 기록한 Task를 하루종일 했는데 내일도 2point만큼 더 해야 일이 끝날 것 같다면 퇴근할 때 2point로 Remaining time을 조정하고 가면 되겠다. 이 경우는 하루종일 일을 안 한 게 아니라 애초에 3point로 산정한 게 잘못됐던 것이다. 성취감을 느끼려면 애초에 산정을 잘 하자. 또한 이런 경우가 있으므로 iceScrum을 근태 관리 툴로 사용할 수는 없다는 점도 알아 두자.</p>
        
        <p>나중에 프로젝트 진행 차트를 볼 텐데, 차트에는 이 포인트를 합산한 게 기록된다. 그래서 할 일 포인트가 늘었는지 줄었는지 확인할 수 있다. 그래프가 깔끔하게 아래로 떨어지지 않는다면 Sprint plan을 잘못 세운 것이라고 판단하면 된다.</p>
        
        <p>나 역시 아직 깔끔하게 아래로 떨어지는 그래프를 보지 못했는데, Story를 잘게 나누고 시작을 해도 task를 진행하다 보면 간과했던 게 떠올라서 계속 추가하게 되기 때문이다. 그래서 Sprint가 진행될수록 오히려 task point가 상승하는 경우가 있었다.</p>
        
        <p>task를 드래그 앤 드롭해서 in progress 쪽으로 옮겨 놓으면 task를 시작하는 것이 된다. Done 쪽으로 옮겨 놓으면 해당 task는 완료된 것이 된다.</p>
        
        <h2>팁</h2>
        
        <p>아래는 task들의 예시다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-plan-example.png" alt="Sprint plan example" /></p>
        
        <p>iceScrum을 만드는 팀의 iceScrum의 Sprint plan을 캡쳐한 것인데 재밌는 것을 볼 수 있다. 일단 task의 remaining time을 제대로 적지 않고 사용하고 있다.</p>
        
        <p>다음으로, 캡쳐한 날짜는 2013년 10월 10일인데, 이 Sprint의 종료일은 9월 6일이다. 9월 6일에 종료됐어야 할 Sprint를 한 달 넘게 하고 있는 것이다.</p>
        
        <p>iceScrum 팀이 iceScrum을 잘못 사용하고 있는 것일까? 일단 스크럼 원칙상으로만 본다면 그렇지만, 실제로는 알 수 없다고 보는 게 맞다. 예컨대 맥락상 더 중요한 일을 처리하느라 한 달이 늦게 됐다면 그건 잘 한 게 될 테니 말이다. 평가는 작업한 사람들이 허심탄회한 토론을 통해 할 일이다. 도구는 판단 소스를 제공할 뿐이다.</p>
        
        <h2>Release Plan</h2>
        
        <p>이제 Release Plan 페이지로 가 보자. 일단 각 Sprint가 자동으로 계산돼 배치돼 있는 것을 볼 수 있다.</p>
        
        <p>여기서는 각 Story의 순서를 조정하거나, Story 배치를 할 수 있다. 이번 Sprint에 있는 Story를 특정 Sprint로 보낼 수도 있다. 사이드바의 Product Backlog에서 원하는 Sprint로 Story를 배치할 수도 있다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-release-plan.png" alt="release plan" /></p>
        
        <p>Sprint Plan 페이지에서 작동한 각 Story의 컨텍스트 메뉴도 똑같이 작동한다.</p>
        
        <p>앞서 설명했듯이 Release Plan에서는 Sprint를 수정할 수 있다. 각 Sprint에 있는 역삼각형에 마우스를 올리면 컨텍스트 메뉴가 등장한다. 아래 이미지를 보자.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-context-menu.png" alt="Sprint context menu" /></p>
        
        <ul>
        <li><strong>Open:</strong> 해당 Sprint의 Sprint plan 페이지로 간다.</li>
        <li><strong>Close:</strong> 이 Sprint를 닫는다. Close Sprint와 같은 기능이다. 함부로 하지 말자. 한 번 닫으면 열 수 없다.</li>
        <li><strong>Update:</strong> 이 Sprint를 수정한다. 종료일을 수정할 수 있고, 활성화하지 않은 Sprint라면 시작일도 수정할 수 있다.</li>
        <li><strong>Dissociate all:</strong> 이 Sprint에 완료되지 않은 모든 Story를 모두 Product Backlog로 돌려 보낸다. Sprint 종료일인데 아직 완료 못한 Story가 있을 때, 모든 Story를 Product Backlog로 돌려 보내고 Sprint를 닫으려고 쓰게 될 거다 아마.</li>
        </ul>
        
        <h2>Timeline</h2>
        
        <p>다음으로 볼 주요 페이지는 timeline이다. 아래처럼 생겼다.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-timeline.png" alt="timeline" /></p>
        
        <p>R1으로 표시된 게 Release1이라는 뜻이고 #이 붙은 게 Sprint다. R1 옆에 있는 역삼각형을 누르면 역시 release를 수정할 수 있다.</p>
        
        <h2>Chart</h2>
        
        <p>iceScrum을 사용하면서 재밌는 건 차트다. Sprint 진행 상황을 차트로 보여 준다. Sprint plan, Release plan, Timeline 모두에서 차트를 볼 수 있다. 내 Sprint plan의 차트 하나만 보자.</p>
        
        <p><img src="http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-burnup-chart-in-points.png" alt="timeline" /></p>
        
        <p>이건 burnup chart다. 노란 선은 task의 총 point, 초록 선은 완료된 task의 총 point다. 노란 선이 점점 증가했다는 것은 일을 하면 할수록 task의 point가 많아졌다는 것인데, 내 경우엔 애초에 산정을 잘못해서 발생한 일이다. 처음에 산정을 안 했다가 Sprint를 진행하면서 산정한 경우에도 같은 그래프가 나오기 때문에 그래프만 보고 이게 잘 된 건지 안 된 건지 알 수는 없다.</p>
        
        <p>초록색은 실제 일의 진행속도를 보여 준다. 초록색이 정체해 있는 것만으로는 실제로 일을 안 한 것인지, 일의 포인트를 조정한 것인지 분명치 않다.</p>
        
        <p>예컨대, 2포인트 짜리 task를 끝냈는데, 다른 task의 포인트를 2 늘렸다면 초록 선은 정체한다. 물론 이 때 노란 선은 올라간다. 포인트 총량은 늘어나니까 말이다. 위 이미지에서 노란 선이 86에서 88로 올라갈 때 초록 선은 55에서 55로 멈춰 있는데 그런 일이 일어났음을 짐작할 수 있다.</p>
        
        <p>여튼 가장 좋은 것은 노란 선은 평행선을 그리고 초록 선이 점진적으로 올라가는 것이다. 물론 난 그렇게 된 적이 한 번도 없다.</p>
        
        <h2>마무리</h2>
        
        <p>검색도 있고, 다양한 차트도 있고, Actor 역할도 있고 뭐 다양한 기능이 있지만, 핵심적으로 사용하는 것은 위에 설명한 것이다. 나도 모르는 것도 꽤 있다.</p>
        
        <p>iceScrum은 스크럼 방식에 최적화된 툴이다. 그리고 프로젝트를 관리하는 툴이지 할 일을 관리하는 툴이 아니다. 그래서 나는 그날 그날 들어오는 잡일은 원더리스트(<a href="https://www.wunderlist.com/‎">Wunderlist</a>, 독일어로는 분더리스트라고 읽어야겠지만. 뭐.)로 관리하고 프로젝트에 관해서만 iceScrum을 사용한다.</p>
        
        <p>한 웹사이트를 관리하면서도 그렇게 할 수 있다. 계획을 잡아서 프로젝트를 할 때, 프로젝트 관련 일거리는 iceScrum에 넣고, 그렇지 않은 유지보수 관련 일들은 원더리스트에 넣으면 되는 거다.</p>
        
        <h2>팁2</h2>
        
        <p>iceScrum의 모든 메뉴는 위치를 변경할 수 있다. 드래그 앤 드롭해 봐라.</p>
        
daumview_id:
  - 50421888
mytory_md_path:
  - http://dl.dropboxusercontent.com/u/15546257/mytory-md-content/icescrum.md
categories:
  - 개발 툴
tags:
  - Program
  - 개발 방법론
---
[iceScrum][1]은 [스크럼 개념][2]을 적용한 훌륭한 프로젝트 관리 툴이고 오픈소스다. 라이선스는 주로 GNU Affero GPL V3, 부분적으로 LGPL V3라고 웹사이트에 설명돼 있다.

자바로 작성돼 있고, 리눅스에서 tomcat으로 돌리면 되는데, 윈도우나 맥의 경우엔 설치프로그램이 있다. 다운받아서 그냥 실행하면 번거로운 과정 없이 바로 실행된다.

내장 DB를 사용하는 경우엔 데이터베이스도 설정할 게 없는데 실사용하는 경우엔 내장 DB는 권장하지 않는다. 공식 문서에서도 그렇게 말하고 있다. 나도 내장 DB를 사용하다가 데이터를 다 날려 먹은 경험이 있다. 따라서 실사용하려면 반드시 외부 데이터베이스를 사용하라. 외부 데이터베이스를 연결해서 사용하려면 수동으로 설정을 해 줘야 한다.

설치와 설정은 [Documentation][3]을 참고. 여기선 사용법을 설명하는 것이므로 설치 방법은 따로 설명하지 않는다. 검색해 보면 몇 개 나오니까 그거 참고해도 된다. 단, iceScrum 최신 버전은 설정 파일이 groovy 형식이라는 걸 알아 두기 바란다. 옛날 설정 파일 방식을 기준으로 설명하는 옛날 글들이 있으니 잘 비껴 가기를.

[iceScrum Cloud][4]에 가입해서 사용할 수도 있다. 무료 계정에는 혼자서만 사용할 수 있는 프로젝트 하나를 준다. 이 경우엔 아이디 하나를 팀원 여럿이 공유하며 테스트해 볼 수도 있겠다.

인터페이스가 영문이므로 용어는 그냥 영문으로 표기했다.

## 스크럼이란

스크럼 개념에 대해서는 스크럼으로 검색하면 책이 여러 개 있으니 한 권 골라 읽으면 된다. 툴부터 도입하기보다는 관리 개념을 익히는 게 우선이다.

위키백과의 [스크럼 개념][2]을 참고해도 되겠지만, 내가 생각에 스크럼 방법론의 핵심은 일정 기간에 한 번씩 작동하는 버전업된 제품을 내놓기 위해 일정 기간동안 방해받지 않고 전력질주(Sprint)하는 데 있다. 즉, 두 가지가 핵심이다.

1.  **스크럼의 목적:** 점진적으로 빠르게 발전하는 제품. 한 전력질주 기간(Sprint)이 끝나면 개선된 제품이 나온다.
2.  **방법:** 한 전력질주 기간(Sprint) 동안은 해당 기간에 처리하기로 한 일만 한다. 누구도 중간에 요구사항을 변경할 수 없다. 누구도 스크럼 팀에 다른 일을 시킬 수 없다. 이렇게 해서 잦은 요구사항 변경을 원천봉쇄한다.

스크럼의 나머지 부분은 이 전력질주를 성공시키기 위한 조언들이다.

아주 간략한 설명이므로 스크럼 관련 책을 꼭 읽기 바란다. 검색하면 많이 나오니 내가 따로 추천하지는 않겠다.

iceScrum은 원래 스크럼의 개념에 약간 변형을 가한 것이다. 예컨대 원래 스크럼 개념에는 Release가 따로 없다. 각 Sprint가 Release다. 그런데 iceScrum은 여러 개의 Sprint로 한 Release를 구성한다. 기본 세팅돼 있는 건 Sprint 6개당 Release 하나다. 또, 원래 스크럼에선 한 달을 Sprint 기간으로 추천하는데 iceScrum에선 2주로 추천한다. 이 글은 원본 스크럼의 개념이 아니라 iceScrum 툴의 개념을 설명한다.

참고로, Sprint 기간을 28일로 하고, Release 기간도 28일로 하면 원래 스크럼 개념대로 iceScrum을 사용하는 게 된다.

## 할 일의 기본단위와 흐름

iceScrum에서 할 일의 기본 단위는 Story다. Story는 또 여러 개의 Task로 나누어서 처리하게 된다. 그러니 Story는 여러 개의 자잘한 할 일로 쪼개질 수 있는 좀 작은 단위 정도로 생각하면 되겠다. 예를 들면 Story는 &#8220;공지사항 붙이기&#8221; 같은 거고, Task는 &#8220;목록 페이지 만들기&#8221;, &#8220;글쓰기 페이지 만들기&#8221;, &#8220;글쓰기 DB 입력 만들기&#8221;처럼 상세 할 일이다.

Story는 기술적인 내용뿐 아니라 필요한 기능 전체를 말한다. 개발자뿐 아니라 기획자나 디자이너처럼 프로젝트에 관련된 모든 사람들이 Sandbox에 Story를 제안한다. 이 때 제안은 Story 개념에 맞든 안 맞든 상관없다. Scrum Master가 알아서 정리를 하면 된다.

Sandbox에 제안된 Story들 중 Scrum Master가 승인(Accept)한 것이 Product Backlog에 들어가거나 Feature가 되거나, urgent(긴급) task가 된다. 자세한 건 뒤에 설명한다. 여튼 핵심은 Scrum Master가 승인(Accept)하지 않으면 어떤 Story도 프로젝트의 일부가 될 수 없다는 거다.

Product Backlog에서 각 Story의 Effort를 설정해 주면 이제 그걸 Sprint plan에 할당할 수 있게 된다.

Sprint에 Story들을 할당한 뒤, Activate Sprint 버튼을 누르면 Sprint가 시작된다. 그러면 각 Story별로 Task를 작성할 수 있게 된다.

그래서 구성단위는 **Project > Release > Sprint > Story > Task**다. 즉, 여러 개의 Task로 Story가 구성되고, 여러 개의 Story로 Sprint가 구성된다. 그리고 여러 개의 Sprint로 Release가 구성되고, 여러 개의 Release로 Project가 구성된다.

## 페이지와 개념 연결

각 단위의 설정을 변경하려면 어느 메뉴로 가야 하는지 익히는 게 필요하다. 현재 Task들을 확인하려면 Sprint Plan 탭으로 가야 한다. Sprint를 확인하고 설정을 변경하려면 Release Plan 탭으로 가야 하고, Release를 확인하고 설정을 변경하려면 Timeline으로 가야 한다.

한 Sprint 안에 있는 Story들의 순서를 변경하려면? Release 탭으로 가야 한다. 처음에 이게 좀 헷갈리는데, 적응하면 괜찮을 거다.

iceScrum 전체의 데모를 보는 건 간단하다. [iceScrum 프로젝트를 관리하는 iceScrum 페이지][5]에 가 보면 된다. 우측 상단의 Connect 버튼을 눌러 가입(Registration)하고 로그인하면 Timeline, Release plan, Sprint plan을 볼 수 있고 심지어 Sandbox에 Story를 제안할 수도 있다.

## 프로젝트 만들기

![iceScrum 기본화면][6]

iceScrum에 일단 로그인하면 위와 같은 화면이 나온다. 좌측 상단의 **Project > Create**를 클릭하면 새 프로젝트를 만들 수 있다.

![icescrum create project][7]

위 이미지는 프로젝트 생성 화면인데, 일일이 설명하지는 않겠다.

정보를 채우고 우측 하단의 &#8216;Next&#8217; 버튼을 누르면 다음 단계로 넘어간다. Key는 URL에 사용된다.

## Choose your team(팀원 고르기)

Choose your team 항목에서는 포함할 팀을 고른다. ID로 검색을 해서 추가하면 되는데, 프로젝트를 생성하고 있는 자신의 역할이 뭔지 보자. &#8220;PO&SM&#8221;이라고 돼 있을 것이다. 이건 Project Owner와 Scrum Master의 약자다.

## Define your practices(프랙티스 정의)

Define your practices 부분에 좀 복잡한 게 나온다. 이미지를 먼저 보자.

![Define your practices tab][8]

*   **Suite used for estimation:** 할 일에 드는 노력을 측정할 때 숫자를 선택하게 되는데, 이 때 셀렉트박스에 1,2,3,4,5,6,7,8,9,10 하는 식으로 숫자가 나오게 할지, 아니면 [피보나치 수열][9](1, 2, 3, 5, 8, 13, 21, 34)로 숫자가 나오게 할지 정하는 것이다. 사실 5를 넘어가는 할일에 드는 노력을 정확하게 1단위로 측정하는 건 불가능하니 숫자가 커질수록 어림짐작으로 크게 노력을 잡는 건 합리적으로 보인다. 그래서 난 피보나치 수열로 노력을 선택하는 걸 선호한다.  
    한 가지, 염두에 둘 건, 이 때 숫자는 그냥 숫자라는 거다. 팀 내규로 이 숫자가 추상적 노력을 의미하게 할지, 시간을 의미하게 할지, 아니면 1이 10분을 의미하게 할지 그냥 정하면 된다.
*   **Disable Estimation (effort=1):** 노력 측정을 꺼버리는 옵션이다. 이러면 모든 할일에 드는 노력을 1로 계산한다. 즉, 그냥 할일을 건수로만 취급하는 것이다. 프로젝트 측정을 너무 세부적으로 하면 오히려 측정 피로감이 생길 수 있으니 이렇게 하는 것도 방법중 하나다.
*   **Hide weekends in charts:** 차트에서 주말을 빼버리는 옵션. 주말에 일 안하면 그래프가 계단형이 돼 이쁘지 않을 거다. 그래프를 미려하게 만들기 위한 옵션이라고 생각하면 되겠다.
*   **Automatically set a story as done when all its tasks are done:** Story 안의 모든 Task가 완료되면 Story를 완료된 것으로 할지 정하는 것이다. 난 No로 해 놓는다. 모든 Task를 완료했는데 다시 Task가 떠오르는 경우가 있기 때문이다.
*   **Auto create task on empty story when sprint is activated:** Activate sprint 버튼을 눌러 Sprint를 활성화했을 때 모든 스토리에 기본 Task를 하나씩 박아줄지 정하는 것이다. Task는 기본적으로 Story와 같은 이름으로 생성된다. Task가 하나밖에 없는 간단한 Story들을 많이 사용하는 경우라면 이걸 yes로 해 놨을 때 편할 거다. 이건 프로젝트별로 알아서 정하면 된다.
*   **Auto assign team member on start task:** Task를 in progress 상태로 만들면, 그렇게 만든 사람에게 자동으로 해당 Task를 할당하게 하는 거다. 할 일을 스크럼 마스터가 할당하는 경우가 많다면 no로 하면 될 테고, 그렇지 않고 자기 할 일을 자기가 직접 고르는 경우가 많다면 yes로 하면 될 것이다.
*   **Display recurrent tasks:** Sprint Plan 화면에서 recurrent tasks(반복적 task) 항목을 보여 줄지 선택한다. 반복적으로 해야 하는 task가 있다면 yes로 한다. 나는 없어서 no로 했다. 뭐, 규모가 큰 프로젝트에서 하루에 한 번씩 꼭 전체 Test를 수동으로 수행해야 한다면 반복적 Task를 이용할 수도 있겠다.
*   **Display urgent tasks:** Sprint Plan 화면에서 urgent tasks(긴급 task) 항목을 보여 줄지 선택한다. Sprint는 원래 다른 모든 요구를 무시하고 스프린트 시작 전에 하기로 한 Story들에만 집중하는 프로젝트 관리 방법이다. 그러나 실세계는 생각대로 안 된다. Sprint를 한창 진행중이더라도 웹사이트가 갑자기 뻗었다면 수리를 해야 한다. 그런 task를 적어 넣는 곳이 urgent tasks 항목이다. 유지보수 팀이 따로 있어서 제품 제작팀이 유지보수를 신경쓸 필요가 없는 경우라면 이 항목을 활성화하지 않아도 될 거다. 그렇지 않다면 쓰게 될 테니 활성화하자.
*   **Limit of urgent tasks in progress(0=no limit):** 긴급 task의 개수를 제한하는 설정이다. 너무 많아지지 않도록 하는 기능일 텐데 취향대로 하자.

## Start your project(프로젝트 시작)

Define your practices를 다 설정하고 Next 버튼을 누르면 Start your project 화면이 나오는데, 이것도 설정 잘 해야 한다. 아래 이미지를 보자.

![iceScrum start your project tab][10]

모든 프로젝트에는 여러 개의 Release가 있다. 한 Release는 여러 개의 Sprint로 구성된다. 위 이미지를 보면 Default sprint duration이라는 항목이 있는데, iceScrum에선 이게 기본으로 14로 돼 있다. 내가 본 《스크럼》이라는 책에서는 한 달을 예시로 제시했었다. 여튼 다른 일에 간섭받지 않고 집중해서 프로젝트에 매달린 후 다시 할일들을 선정할 한 기간을 얼마로 정할지 써 주는 건데, 그래서 이걸 14일 단위로 했다면 하나의 Release가 여러 개의 Sprint로 구성되므로 Release는 2주의 정수배로 설정을 하는 게 좋을 거다. 즉, 한 Sprint가 2주라면 한 Release는 2주나 4주, 아니면 6주 식이 되는 게 좋다는 거다. 뭐 그렇다고.

그럼 다음 설명을 보자.

*   **Project start date:** 프로젝트 시작일이다. Sprint와 Release가 딱 맞게 설정하면 좋겠지만, 뭐 별 상관은 없다. 프로젝트 시작일에 Sprint를 activate해야 하는 건 아니니 말이다.
*   **First sprint start date:** 첫 Sprint 시작일이다. 주단위로 끊는 게 기본적으로는 나을 텐데, 첫 Sprint만 다른 Sprint보다 날수가 적게 할 수도 있으니까 크게 신경쓸 필요는 없다. 첫 Sprint만 수요일에 시작해서 다음주 일요일에 끝나게 하고 그 다음 Sprint부터는 월요일에 시작해서 일요일에 끝나도록 설정하면 된다. 설정은 Release plan에서 수정할 수 있다.
*   **Default Sprint duration (days):** 한 Sprint가 며칠로 구성되게 할 건지 정하는 거다. 대충 2주로 하는 게 깔끔해 보인다. 한 Sprint 동안은 다른 데 신경쓰지 않고 거기에 집중하는 게 원칙이다. 그리고 한 Sprint가 끝나고 나서야 다음 과제들을 고른다. 너무 길면 이슈를 신속하게 대응할 수 없게 되고, 너무 짧으면 주의가 너무 자주 흐트러질 거다.  
    스크럼 원칙상이야 그렇지 않지만 기능상으로는 Sprint별 날짜를 반드시 지켜야 하는 건 아니다. 즉, 수정이 가능하다. 다만 Release에 기본적인 Sprint들을 자동 배정하거나 할 때 Sprint의 기간을 이걸로 사용하게 되니 잘 작성하자.  
    이 항목의 값 자체도 나중에 **Project > Practices** 메뉴에서 수정할 수 있다.
*   **Release end date:** 첫 Release의 종료일을 말하는 거니 크게 신경쓰지 않고 설정하면 된다. 일단 iceScrum에선 기본적으로 12주를 한 Release의 기간으로(즉, 한 Release당 Sprint 6개) 하는데, 이건 프로젝트마다 다를 테니 알아서 잘 설정하라. 나중에 Timeline 페이지에 가서 변경할 수도 있다. 여튼, Sprint랑 아귀가 맞게 설정하면 도움이 될 거다.
*   **Vision:** 이 프로그램의 비전을 적는 항목이다. 팀원들이 프로젝트의 핵심을 매번 되새길 수 있게 간결한 내용을 적어 넣자. 물론 안 적어도 된다.

여기까지 하면 프로젝트가 만들어진다.

## Dashboard

아래는 대시보드 화면이다. 별 거 없다. 이거저거 건드려 보면 된다.

![iceScrum dashboard][11]

## Sandbox에 Story 제안하기

할일 관리를 시작하는 곳이 바로 Sandbox다. 여기는 무엇이든 적을 수 있다. 스크럼은 단지 개발자들만의 도구가 아니라, 개발자가 아닌 사람들도 사용하는 도구다. 그리고 그 사람들은 바로 Sandbox에 제안을 한다. 스크럼 마스터는 그 제안을 수용하거나 거부할 수 있다.

![iceScrum sandbox][12]

위 이미지는 iceScrum 프로젝트의 샌드박스다. 각 스토리 위에 마우스를 올려 놓으면 Description이 툴팁으로 뜬다.

새로운 스토리를 제안하려면 Sandbox 좌측 상단의 New 버튼을 누른다. 그러면 아래와 같은 화면이 나오면서 Story를 작성하게 된다.

![iceScrum add new story on sandbox][13]

Type은 세 종류가 있다. User story, Story defect, Technical story. 굳이 분류없이 사용해도 되지만 알아는 두자.

*   **User story:** 일반적으로 제안하는 기능이다. &#8220;QnA 게시판&#8221;, &#8220;자동 로그아웃 기능&#8221; 따위.
*   **Story defect:** 버그를 말한다. &#8220;QnA 게시판 확인 두 번 누르면 글 두 번 작성되는 거 수정&#8221; 이런 거.
*   **Technical story:** 아마 기술적인 걸 말할 텐데, &#8220;배열을 죄다 객체로 변경&#8221; 이런 거 말이다.

Description에 쓰면 마우스를 올렸을 때 툴팁으로 뜨게 된다. 여기에 좀 자세히 적는 게 나중에 도움이 된다.

Story template은 사용해 본 적이 없어서 모르겠지만, 기본 세팅을 해놓은 걸 불러와서 사용하는 거 아닐까 추측한다.

Story attachment는 첨부파일을 넣을 수 있는 기능이다. 그런데 한글 파일명이 문제다. 업로드는 되지만, 다운로드하면 한글이 제대로 안 나온다. 심지어 영문이나 공백없이 한글로만 된 파일명의 파일을 업로드한 뒤 다운로드하면 .hwp 식으로 다운로드가 돼 리눅스나 맥에서는 숨김파일이 되고 만다. 그러니 웬만하면 파일명을 영어로 바꿔서 올리자.

Story notes는 더 길게 적을 수 있는 건데, 이걸 보려면 Story를 클릭해서 들어와야 하므로 번거롭다. 웬만하면 Description에 쓰고 정말 길고 자세한 내용이 있는 경우에만 이걸 사용하자.

![story icon][14]

위 이미지를 한 번 보자. 좌측은 technical story이고 우측은 story defect다. technical story에는 스패너 아이콘이 붙고, Story defect에는 느낌표 아이콘이 붙는다. 위 이미지엔 없지만, 첨부파일이 들어 있는 Story에는 포스트잇 이미지의 좌측 하단에 클립 모양이 나타난다.

## Story 컨텍스트 메뉴

제안된 스토리에서 역삼각형 모양 위에 마우스를 올려 놓으면 아래 그림처럼 컨텍스트 메뉴가 나타난다.

![iceScrum Story context menu on sandbox][15]

컨텍스트 메뉴 항목에서 [Acceptance tests][16]는 뭔지 모르겠고 사용해 본 적도 없다. 설명을 보면 Story가 완료된 걸 테스트하는 거라고 하는데, 게시판 Story가 완료되면 &#8220;목록 보기 > 글쓰기 > 쓴 글 읽기 > 글 수정하기&#8221; 따위의 테스트 단계를 적는 건지도 모르겠다.

Accept as story는 이 Story를 승인해서 Product Backlog로 보내는 기능이다. Product Backlog에 들어가서 Effort를 측정한 Story만이 Sprint로 배치될 수 있다.

Accept as feature는 이 Story를 Feature로 만드는 기능이다. Feature는 카테고리 같은 개념이라고 생각하면 될 듯하다. [iceScrum의 프로젝트 관리 차트에 가 보면 Feature를 어떻게 활용하는지 볼 수 있다(로그인 필요, 아래 이미지).][17] Story를 제안할 때 이 Story가 속할 Feature를 고를 수 있다.

아래 이미지는 각 Feature별로 몇 퍼센트의 Story를 완료했는지 보여 주는 그래프다. Y축을 보면 Feature로 어떤 것들이 있는지 알 수 있다.

![iceScrum Feature 예시][18]

iceScrum 팀이 만들어 둔 Feature 중 하나는 Exports/Print다(위 이미지상 밑에서 두 번째). Exports/Print Feature에 속한 Story 중 하나는 [Print post-it in sandbox(샌드박스를 포스트잇 형태로 프린트할 수 있게 하기)][19]다.

Feature는 사용하기 나름일 텐데, iceScrum 팀은 Story를 분류하기 위해 사용하는 것으로 사용하고 있다. 이러면 Feature는 프로젝트 시작부터 끝까지 쭉 살아있게 될 것이다.

Update는 수정이다. Copy는 똑같은 걸 하나 더 만드는 거다. 비슷한 Story들을 약간씩 다르게 만들 때 사용한다. Delete를 모를 리는 없겠고.

아, 승인할 때 여러 개의 포스트잇을 선택한 다음 좌측 상단의 Accept 버튼을 눌러서 한꺼번에 승인할 수도 있다. `Ctrl+클릭`(맥은 `Cmd+클릭`)을 사용하면 된다. 마우스로 범위를 지정해서 선택할 수도 있다.

Sprint plan 화면에서 Story를 승인하는 방법도 있다. 아래 이미지를 보자.

![drag and drop accept][20]

Product Backlog 페이지의 좌측 사이드바에는 Sandbox에 있는 Story들이 나오는데 그걸 드래그 앤 드롭해서 Product Backlog로 옮겨 놓으면 된다.

## Product Backlog

승인된 할 일들이 모두 모여 있는 곳이 바로 Product Backlog(제품 밀린 일)다. 각 Story의 Effort를 다음과 같이 설정해 주면 된다.

![story effort][21]

마우스로 물음표(?)를 클릭하면 이렇게 effort를 설정할 수 있다.

모든 Story의 effort를 설정했다면 팀 회의를 통해서 이번 Sprint에 할 일을 정하자. Product Backlog에 있는 모든 Story를 한 눈에 보려면 Product Backlog 메뉴의 Publish as&#8230;를 사용한다. 그러면 다양한 포맷으로 목록을 내보낼 수 있는데, Word 2007 Document(docx)나 OpenDocument Text(odt)를 선택하자. Rich Text Format(rtf)은 그냥 다 깨져 나오고, Portable Document Format(PDF)은 한글이 공백으로 나온다.

워드 포맷으로 추출된 문서를 그대로 인쇄해서 팀원들과 한 부씩 나눠 갖고선 회의를 하자. 그래서 이번 Sprint에 할 일을 정했다면 이제 Sprint Plan 페이지로 가서 Sprint에 Story를 배치하자.

## Sprint Plan

Sprint Plan 페이지로 가 보면 아래처럼 애초 프로젝트 세팅대로 첫 번째 Sprint가 만들어져 있는 것을 볼 수 있다. 그러나 아직 activate를 하지 않았기 때문에 활성화된 상태는 아니다. Story도 전혀 들어있지 않다.

![Sprint plan date][22]

Story를 추가한 뒤에 activate를 해 보자. 물론 Sprint를 activate한 뒤에도 Story를 추가할 수 있다.

Story를 추가하는 방법은 간단하다. 좌측 사이드바에 보면 Product Backlog가 있다. 거기 있는 Story를 드래그앤 드롭으로 Sprint쪽으로 옮기면 된다. 아래 이미지 참고.

![Story 배치하기][23]

순서는 일단 생각하지 말고 옮겨도 된다. 순서는 나중에 Release Plan 쪽에서 조정할 수 있다.

Effort를 측정하지 않은 Story는 좌측 사이드바에 표시되지 않는다는 점도 알아 둬라.

이번 Sprint에 하기로 한 Story를 모두 배치한 뒤에는 Activate sprint 버튼을 눌러서 Sprint를 활성화한다.

![activate sprint][24]

Activate sprint 버튼을 누르면 정말 활성화할 거냐고 묻는다. 확인을 누르면 Activate sprint 버튼이 Close sprint 버튼으로 변경된다. Sprint가 종료됐을 때 이 버튼을 누르면 된다.

Sprint 종료는 원칙상은 예정된 날짜에 하는 게 맞겠지만, 기능상은 꼭 예정된 날짜에 하지 않아도 된다. iceScrum에서 Sprint는 예정된 날짜를 넘겨도 Close sprint를 하기 전까지는 계속 활성화돼 있다. 예정된 날짜 전에 Close sprint 버튼을 눌러 Sprint를 끝내도 된다. 종료일을 수정할 수도 있다. 즉, 기능상으로는 Sprint 종료일이 표시에 불과하다는 것을 알아 두자.

## Sprint Plan의 컨텍스트 메뉴

Sprint Plan 페이지에서 각 Story의 역삼각형에 마우스를 올리면 아래 이미지처럼 컨텍스트 메뉴가 나타난다.

![context menu on sprint plan][25]

대충 설명해 보자.

*   **Add a task:** 이 Story를 위한 task를 추가한다.
*   **Update:** 수정
*   **Copy:** 이 Story를 복사해 Sandbox로 넣는다.
*   **Dissociate:** Story를 Product Backlog로 돌려 보낸다. Story의 task는 모두 삭제된다. Sprint가 종료될 때 Story를 제거하기 위해 사용한다고 생각하면 되겠다. 물론 진행중일 때도 얼마든 사용할 수는 있다.
*   **Shift to next sprint:** 말 그대로 다음 Sprint로 보내는 거다.
*   **Declare as done:** 완료 처리

Story가 모두 완료되면 Sprint를 끝내면 된다. 그런데 Sprint 안에 Story가 다 끝날 거 같지 않으면? 스크럼에선 그런 경우 할일(iceScrum에선 Story가 되겠다)을 줄이라고 말한다. 다음 Sprint에 하면 되니까 말이다.

## Task

각 Story를 개발자들이 나눠 갖고, 각기 Story를 잘게 쪼개서 task를 만들면 된다.

task에도 effort를 적게 돼 있다. Story의 컨텍스트 메뉴에서 Add a task를 선택해 보자.

나오는 화면은 기본적으로 add new story 화면과 같다. 다른 게 하나 있는데, Remaining time이란 항목이다. 이건 남은 시간을 기록하는 거다. 시작할 때는 해당 Task 총 걸릴 시간을 적으면 된다. 역시 1을 얼마의 시간으로 생각할 건지는 각 팀이 알아서 할 일이다. iceScrum에선 그냥 1을 point라고 부른다.

자, 어떤 Task의 Remaining time이 10point였다고 치자. 작업중에 이걸 변경해 주면 된다. 오늘 9만큼 했고, 내일 1만큼만 처리하면 끝난다고 치자. 그러면 이걸 1로 만들고 퇴근하면 되는 거다. 3point로 기록한 Task를 하루종일 했는데 내일도 2point만큼 더 해야 일이 끝날 것 같다면 퇴근할 때 2point로 Remaining time을 조정하고 가면 되겠다. 이 경우는 하루종일 일을 안 한 게 아니라 애초에 3point로 산정한 게 잘못됐던 것이다. 성취감을 느끼려면 애초에 산정을 잘 하자. 또한 이런 경우가 있으므로 iceScrum을 근태 관리 툴로 사용할 수는 없다는 점도 알아 두자.

나중에 프로젝트 진행 차트를 볼 텐데, 차트에는 이 포인트를 합산한 게 기록된다. 그래서 할 일 포인트가 늘었는지 줄었는지 확인할 수 있다. 그래프가 깔끔하게 아래로 떨어지지 않는다면 Sprint plan을 잘못 세운 것이라고 판단하면 된다.

나 역시 아직 깔끔하게 아래로 떨어지는 그래프를 보지 못했는데, Story를 잘게 나누고 시작을 해도 task를 진행하다 보면 간과했던 게 떠올라서 계속 추가하게 되기 때문이다. 그래서 Sprint가 진행될수록 오히려 task point가 상승하는 경우가 있었다.

task를 드래그 앤 드롭해서 in progress 쪽으로 옮겨 놓으면 task를 시작하는 것이 된다. Done 쪽으로 옮겨 놓으면 해당 task는 완료된 것이 된다.

## 팁

아래는 task들의 예시다.

![Sprint plan example][26]

iceScrum을 만드는 팀의 iceScrum의 Sprint plan을 캡쳐한 것인데 재밌는 것을 볼 수 있다. 일단 task의 remaining time을 제대로 적지 않고 사용하고 있다.

다음으로, 캡쳐한 날짜는 2013년 10월 10일인데, 이 Sprint의 종료일은 9월 6일이다. 9월 6일에 종료됐어야 할 Sprint를 한 달 넘게 하고 있는 것이다.

iceScrum 팀이 iceScrum을 잘못 사용하고 있는 것일까? 일단 스크럼 원칙상으로만 본다면 그렇지만, 실제로는 알 수 없다고 보는 게 맞다. 예컨대 맥락상 더 중요한 일을 처리하느라 한 달이 늦게 됐다면 그건 잘 한 게 될 테니 말이다. 평가는 작업한 사람들이 허심탄회한 토론을 통해 할 일이다. 도구는 판단 소스를 제공할 뿐이다.

## Release Plan

이제 Release Plan 페이지로 가 보자. 일단 각 Sprint가 자동으로 계산돼 배치돼 있는 것을 볼 수 있다.

여기서는 각 Story의 순서를 조정하거나, Story 배치를 할 수 있다. 이번 Sprint에 있는 Story를 특정 Sprint로 보낼 수도 있다. 사이드바의 Product Backlog에서 원하는 Sprint로 Story를 배치할 수도 있다.

![release plan][27]

Sprint Plan 페이지에서 작동한 각 Story의 컨텍스트 메뉴도 똑같이 작동한다.

앞서 설명했듯이 Release Plan에서는 Sprint를 수정할 수 있다. 각 Sprint에 있는 역삼각형에 마우스를 올리면 컨텍스트 메뉴가 등장한다. 아래 이미지를 보자.

![Sprint context menu][28]

*   **Open:** 해당 Sprint의 Sprint plan 페이지로 간다.
*   **Close:** 이 Sprint를 닫는다. Close Sprint와 같은 기능이다. 함부로 하지 말자. 한 번 닫으면 열 수 없다.
*   **Update:** 이 Sprint를 수정한다. 종료일을 수정할 수 있고, 활성화하지 않은 Sprint라면 시작일도 수정할 수 있다.
*   **Dissociate all:** 이 Sprint에 완료되지 않은 모든 Story를 모두 Product Backlog로 돌려 보낸다. Sprint 종료일인데 아직 완료 못한 Story가 있을 때, 모든 Story를 Product Backlog로 돌려 보내고 Sprint를 닫으려고 쓰게 될 거다 아마.

## Timeline

다음으로 볼 주요 페이지는 timeline이다. 아래처럼 생겼다.

![timeline][29]

R1으로 표시된 게 Release1이라는 뜻이고 #이 붙은 게 Sprint다. R1 옆에 있는 역삼각형을 누르면 역시 release를 수정할 수 있다.

## Chart

iceScrum을 사용하면서 재밌는 건 차트다. Sprint 진행 상황을 차트로 보여 준다. Sprint plan, Release plan, Timeline 모두에서 차트를 볼 수 있다. 내 Sprint plan의 차트 하나만 보자.

![timeline][30]

이건 burnup chart다. 노란 선은 task의 총 point, 초록 선은 완료된 task의 총 point다. 노란 선이 점점 증가했다는 것은 일을 하면 할수록 task의 point가 많아졌다는 것인데, 내 경우엔 애초에 산정을 잘못해서 발생한 일이다. 처음에 산정을 안 했다가 Sprint를 진행하면서 산정한 경우에도 같은 그래프가 나오기 때문에 그래프만 보고 이게 잘 된 건지 안 된 건지 알 수는 없다.

초록색은 실제 일의 진행속도를 보여 준다. 초록색이 정체해 있는 것만으로는 실제로 일을 안 한 것인지, 일의 포인트를 조정한 것인지 분명치 않다.

예컨대, 2포인트 짜리 task를 끝냈는데, 다른 task의 포인트를 2 늘렸다면 초록 선은 정체한다. 물론 이 때 노란 선은 올라간다. 포인트 총량은 늘어나니까 말이다. 위 이미지에서 노란 선이 86에서 88로 올라갈 때 초록 선은 55에서 55로 멈춰 있는데 그런 일이 일어났음을 짐작할 수 있다.

여튼 가장 좋은 것은 노란 선은 평행선을 그리고 초록 선이 점진적으로 올라가는 것이다. 물론 난 그렇게 된 적이 한 번도 없다.

## 마무리

검색도 있고, 다양한 차트도 있고, Actor 역할도 있고 뭐 다양한 기능이 있지만, 핵심적으로 사용하는 것은 위에 설명한 것이다. 나도 모르는 것도 꽤 있다.

iceScrum은 스크럼 방식에 최적화된 툴이다. 그리고 프로젝트를 관리하는 툴이지 할 일을 관리하는 툴이 아니다. 그래서 나는 그날 그날 들어오는 잡일은 원더리스트([Wunderlist][31], 독일어로는 분더리스트라고 읽어야겠지만. 뭐.)로 관리하고 프로젝트에 관해서만 iceScrum을 사용한다.

한 웹사이트를 관리하면서도 그렇게 할 수 있다. 계획을 잡아서 프로젝트를 할 때, 프로젝트 관련 일거리는 iceScrum에 넣고, 그렇지 않은 유지보수 관련 일들은 원더리스트에 넣으면 되는 거다.

## 팁2

iceScrum의 모든 메뉴는 위치를 변경할 수 있다. 드래그 앤 드롭해 봐라.

 [1]: http://www.icescrum.org/en/
 [2]: http://ko.wikipedia.org/wiki/%EC%8A%A4%ED%81%AC%EB%9F%BC_(%EC%95%A0%EC%9E%90%EC%9D%BC_%EA%B0%9C%EB%B0%9C_%ED%94%84%EB%A1%9C%EC%84%B8%EC%8A%A4)
 [3]: https://www.kagilum.com/documentation
 [4]: https://www.kagilum.com/icescrum-hosting
 [5]: http://tools.icescrum.org/p/ICESCRUM#project
 [6]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-1.png
 [7]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-create-project.png
 [8]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-define-your-practices.png
 [9]: http://ko.wikipedia.org/wiki/%ED%94%BC%EB%B3%B4%EB%82%98%EC%B9%98_%EC%88%98
 [10]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-start-your-project.png
 [11]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-dashboard.png
 [12]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sandbox.png
 [13]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-add-new-story.png
 [14]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-story-icon.png
 [15]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-story-context-on-sandbox.png
 [16]: http://www.agile-tools.net/acceptancetesting.asp
 [17]: http://tools.icescrum.org/p/ICESCRUM#feature/productParkingLotChart
 [18]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-feature-example.png
 [19]: http://tools.icescrum.org/p/ICESCRUM/#story/582
 [20]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-drag-and-drop-accept-story.png
 [21]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-story-effort.png
 [22]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-plan-date.png
 [23]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-allocate-story.png
 [24]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-activate-sprint-button.png
 [25]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-context-menu-on-sprint-plan.png
 [26]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-plan-example.png
 [27]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-release-plan.png
 [28]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-context-menu.png
 [29]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-timeline.png
 [30]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/icescrum/icescrum-sprint-burnup-chart-in-points.png
 [31]: https://www.wunderlist.com/‎