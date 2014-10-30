---
title: 내가 사용하는 font-family. 그리고 XP에서 맑은 고딕 뿌옇게 나오는 문제 회피하는 팁
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/9743
daumview_id:
  - 42050018
mytory_md_path:
  - 
categories:
  - 웹 퍼블리싱
tags:
  - CSS
---
[2013-10-02 추가 : 나눔바른고딕을 맑은 고딕과 나눔고딕보다 앞세웠다. 내 선호에 따라서 ㅋ]

알파벳을 사용하지 않는 탓에 우리는 웹에서 글꼴 활용폭이 넓지 못하다. 한글은 훌륭한 문자 체계지만, 제국주의 지배국이 되지 못했던 조선의 역사 탓에 널리 사용되지 못했고, 그래서 OS 기본 탑재 글꼴도 적다. 알파벳은 웹폰트를 실용화할 수 있는 시대지만, 한글은 글꼴 용량이 큰 탓에 아직은 웹폰트를 대중적으로 사용하기 힘들다.

웹에서 사용할 수 있는 글꼴이 굴림, 돋움 정도로 한정됐던 탓에 이미지 글자가 범람하기도 한 것 같다. 맑은 고딕은 봐 줄 만하지만, 그래 봐야 하나고. 여튼 굴림은 여전히 싫다. (돋움도 싫다!)

나는 그래서 아래와 같이 font-family를 사용한다. (영문 폰트명과 한글 폰트명을 모두 써 주지 않으면 특정 환경에서는 글꼴 인식을 못 하는 경우가 생긴다.)

<pre>body{
  font-family: Ubuntu, Arial,'Apple SD Gothic Neo','애플 SD 고딕 Neo','NanumBarunGothic','NanumBarunGothicOTF','나눔바른고딕','나눔바른고딕OTF','Malgun Gothic','맑은 고딕','NanumGothic','NanumGothicOTF', '나눔고딕','나눔고딕OTF',sans-serif;
  /* for ie7 */
  *font-family: 'Apple SD Gothic Neo','애플 SD 고딕 Neo','NanumBarunGothic','NanumBarunGothicOTF','나눔바른고딕','나눔바른고딕OTF','Malgun Gothic','맑은 고딕','NanumGothic','NanumGothicOTF', '나눔고딕','나눔고딕OTF',sans-serif;
}</pre>

일단 한글 글꼴에서 표현하는 영어 보다는 영어 글꼴에서 표현하는 영어가 낫다. 영어는 우선 내가 좋아하는 [Ubuntu체][1]를 가장 앞에 뒀고, 그 다음으로는 가독성이 좋고 모든 운영체제에 있을 법한 글꼴인 Arial로 표현하도록 했다. (처음엔 Verdana를 골랐었다. 그런데 Verdana에서는 큰 따옴표(“와 ”)가 예쁘게 표현되지 않는다. 그래서 Arial로 변경했다. Verdana는 제이콥 닐슨이 낮은 해상도(ppi) 모니터에서 가장 가독성 좋은 글꼴이라고 소개한 놈이다.)

그 다음은 맥의 산돌고딕neo로 설정했다. 맑은 고딕 글꼴이 있는 맥 사용자들은 있을 테지만, 산돌고딕neo가 있는 윈도우 사용자는 거의 없을 것이기 때문에 맥의 기본 글꼴을 더 우선했다. 맥에서 맑은 고딕으로 웹사이트를 보는 것보다는 산돌고딕neo로 보는 게 나을 거다.

한편, 내가 보기엔 맑은 고딕보다 산돌고딕neo가 더 예쁘기 때문에 앞세운 것이기도 하다. 이유는 간단할 텐데, 더 나중에 나온 글꼴이니까.

네이버에서 내놓은 나눔바른고딕은 스마트폰에서 읽기 좋게 만들었다고 하는데, 데스크톱에서도 가독성이 좋다. 그래서 과감하게 맑은 고딕보다 앞세웠다. 나눔고딕 시리즈 폰트는 맥에 설치하는 패키지를 다운받아서 설치하는 경우엔 뒤에 OTF란 글자가 붙는다. 그래서 `NanumBarunGothicOTF`도 넣은 것이다.

자바스크립트로 처리해 주면 더 좋은 부분이 있는데, 나눔바른고딕은 글꼴 자체에서 자간을 좁게 처리해 뒀다. 그래서 만약 기본으로 자간을 좁게 설정해 뒀다면 나눔바른고딕을 사용할 때는 좀 넓혀 주는 게 좋을 거다. 나는 기본적으로 `-1px` 정도 자간을 좁힌 다음 [font 감지 js][2]를 사용해서 나눔바른고딕인 경우엔 `letter-spacing`을 0으로 설정하는 게 좋은 것 같다.

그 다음, 맑은 고딕 글꼴을 가진 윈도우 사용자를 위해서 맑은 고딕을 설정했다.

단, 주의할 점이 있다. 윈도우XP 구형 버전을 사용하는 사람들은 cleartype 설정이 안 돼 있을 가능성이 있고, 그런 경우엔 맑은 고딕과 나눔고딕이 부옇게 표시된다. 아주 대중적인 서비스를 하는 사이트라면 위 코드는 기본 스타일시트에 적지 않는 게 좋겠다. 기본 스타일시트에는 아래처럼만 적고, 내가 바로 아래쪽에 적은 팁을 활용하라.

<pre>font-family: sans-serif;</pre>

방금 말한 사실을 무시할 만한 사이트거나, 내가 맨 아래 적은 팁을 적용한 사이트라면, 나는 앞서처럼 산돌고딕neo를 적은 다음, 맑은 고딕을 설정하고 그 다음에 나눔고딕을 설정한다. 맑은 고딕이 더 마음에 들기 때문이다. 그 다음으로 내세운 나눔고딕 중엔 나눔바른고딕을 앞세웠다.

그리고 마지막으로 sans-serif라고 써서 앞의 글꼴이 하나도 없는 경우 명조체로 글자가 표현되지 않도록 해 준다. sans-serif는 고딕체를 말한다.

`*`로 시작하는 코드는 IE7 핵이다. IE7은 맨 앞에 적힌 글꼴이 영문 글꼴이면 한글에는 그냥 브라우저 기본 글꼴을 사용해 버린다. 윈도우의 경우엔 굴림이다. 따라서 맨 앞에 한글 글꼴을 적어 준다. IE6는 테스트해 보지 않았다.

## 원래는 글꼴을 지정하지 않았었다

원래 나는 그냥 sans-serif 하나만 지정하자는 주의였다. (워드프레스 관리자 페이지는 그렇게 돼 있다.) 고딕인 걸 알려 주고, 각 OS별 브라우저의 기본 글꼴을 사용하게 하는 게 가장 좋다고 생각했기 때문이다.

경험도 있다. 한겨레 사이트가 예전엔 은돋움을 기본으로 스타일에서 지정을 해 놨었는데, 우분투를 사용하면서 기본 글꼴을 함초롬 바탕으로 사용하던 나에겐 엄청 짜증을 유발했다. 그래서 OS별 브라우저의 기본 글꼴로 사용하도록 font-family를 굳이 지정하지 말자는 생각을 더 강하게 했었다.

이후 리뉴얼을 했지만 지금도 한겨레 사이트는 기본 글꼴을 아래처럼 해 놨다.

<pre>font-family: "굴림",​gulim,​Verdana,​Arial,​AppleGothic,​sans-serif</pre>

애플고딕이 기본 글꼴로 돼 있다. 이러면 아이폰으로 들어갔을 때 혹은 OSX로 들어갔을 때 미려한 산돌고딕neo로 글을 읽을 수 없게 된다.

또한, 어차피 한국인들이 가장 많이 사용하는 OS인 윈도우에서는 굴림이 기본 글꼴인데 굴림이라고 지정해 놓은 것도 이상하다. 이렇게 해 놓으면 내 맥북으로 한겨레 사이트에 들어갔을 때 죄다 굴림으로 글자가 표현된다. 이게 뭔 황당한 짓이야. 난 산돌고딕neo로 읽고 싶다고!

영어 글꼴로 Verdana를 설정해 놓았는데, 굴림 뒤에 배치해 놓은 것도 우습다. 굴림 뒤에 세팅했으니 굴림 글꼴이 있는 컴퓨터에선 어차피 영어가 Verdana로 표현될 일이 없다. 굴림 글꼴이 없는 컴퓨터에서만 영어가 Verdana 글꼴로 우선 표현될 것이다. 글꼴을 막 갖다 붙이다 이렇게 된 것이지 무슨 의도가 있는 코드라고 생각되지 않는다.

사족을 붙이자면 한겨레는 내가 자주 가는 사이트라서 이렇게 써 둔 거다. 한겨레에 악감정이 있는 게 아니고. 조중동 따위는 어떻게 해 놨든 관심도 없다. 내가 OS 기본 글꼴(정확히 말하면 브라우저에서 사용하는 기본 글꼴)을 사이트에서 그냥 사용하도록 놔두는 게 좋겠다고 생각하게 된 배경에는 한겨레 사이트의 나쁜 사례가 강하게 자리잡고 있었다는 걸 이야기하고 싶었던 거고. 여튼 나쁜 사례인 한겨레 얘기는 여기까지 하자.

그런데 내가 기본 글꼴로 놔 두자 주의에서 맑은 고딕을 사용할 수 있다면 사용하도록 하자는 주의로 입장을 바꾼건 시절이 많이 흘렀기 때문이다. 2009년까지만 해도 맑은 고딕이 뿌옇게 표현되는 경우가 상당히 많았다. 이제 시절이 많이 흘러, 윈도우7의 사용률이 많이 높아졌고, 맑은 고딕을 기본으로 해도 뿌옇게 표현되는 경우가 거의 없으니 기본 글꼴을 맑은 고딕으로 할 만하지 않나 하는 생각이 있다. (굴림이 싫다!)

그럼에도 불구하고 대중적인 서비스에서는 맑은 고딕이나 나눔고딕을 지정하지 않는 게 좋다고 생각한다. 여전히 아주 적지는 않은 유저들의 컴퓨터에서 맑은 고딕과 나눔고딕은 뿌옇게 표현된다. (내 블로그는 개발자 전용 블로그니까 상관 없다고 본다.)

그럴 땐 기본 스타일시트에서는 맑은 고딕과 나눔 고딕을 빼고 sans-serif만 써 놓은 다음 아래 팁을 활용하는 게 좋겠다. 그리고 그렇게 되면 기본 스타일시트에 산돌고딕neo도 굳이 표기해 줄 필요가 없다. 최신 OSX에서는 산돌고딕neo가 기본 한글 글꼴이니 말이다. Verdana도 명기할 필요가 없다. 영어 글자가 한글 글꼴로 나오는 걸 막으려고 영어 글꼴을 앞세운 건데, 어차피 한글 글꼴이 다 빠지게 되니 말이다.

이렇게 되면, 내가 맨 위에 써 놓은 font-family는 아래 팁에서 적용하면 된다.

## 대중적인 사이트에서 맑은 고딕과 나눔고딕을 설정하기

대중적인 사이트라도 맑은 고딕과 나눔고딕을 설정하고 싶을 것이다. 방법이 없는 것은 아니다.

OS를 탐지해서 윈도우XP가 아니라면 스타일을 추가하는 방법도 있다. 여러 방법을 쓸 수 있을 텐데, 여튼간에 서버단이나 JS에서 User Agent를 검사해서 XP인지 아닌지를 탐지하면 될 거다. XP 미만인 경우는 극소수일 테니 그냥 XP만 탐지해서 XP가 아니면 맑은 고딕과 나눔고딕을 사용하면 될 거라고 본다. 리눅스나 OSX는 어차피 렌더링 잘 하니까 사용해도 상관 없다.

코드 자체는 각자 알아서들 짜시길. (시간 되면 올릴까;;)

### js 라이브러리를 사용하는 방법

약간 한계가 있는 js 라이브러리가 있다. 이건 범용적으로 사용 가능한데, canvas를 이용해서 글꼴을 부드럽게 만드는지 그렇지 않은지 감지하는 기법이다. 즉, 윈도우에서 클리어타입을 사용하는지 사용하지 않는지 탐지하는 것이다. 그래서 클리어타입을 사용하긴 하지만 글꼴이 지나치게 뿌옇게 나오는 경우를 탐지하기 위해서 사용할 수는 없다.

한계는 있는 라이브러리지만, XP인지 탐지하는 것보다 더 원칙에 충실하다고 볼 수 있다. 영어로 된 글인데, 사용법만 보는 건 쉬우니까. 글을 링크하겠다.

*   [How to Detect Font-Smoothing Using JavaScript][3] &#8211; 처음 기법을 만든 사람이다.
*   [Font Smoothing Detection&#8230; Modernizr Style!][4] &#8211; 위 기법을 활용해서 Modernizr 플러그인으로 만든 사람의 글이다.

위 두 개 중 선호하는 방법을 사용하면 된다고 본다.

 [1]: http://font.ubuntu.com/
 [2]: http://mytory.local/archives/118 "폰트가 설치돼 있는지 확인해 주는 javascript"
 [3]: http://www.useragentman.com/blog/2009/11/29/how-to-detect-font-smoothing-using-javascript/
 [4]: http://wellcaffeinated.net/articles/2012/01/25/font-smoothing-detection-modernizr-style