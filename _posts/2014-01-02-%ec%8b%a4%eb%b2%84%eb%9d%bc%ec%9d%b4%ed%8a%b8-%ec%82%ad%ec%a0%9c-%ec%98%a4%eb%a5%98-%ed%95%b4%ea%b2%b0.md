---
title: 실버라이트 삭제 오류 해결
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12120
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12120-silverlight.md
categories:
  - 기타
tags:
  - Program
  - TIP
---
나는 윈도우 업데이트를 꼬박꼬박 한다. 그런데 한 달쯤인가, 업데이트가 계속 제대로 안 되는 거다. 실버라이트 업데이트였다.

그래서 지우고 다시 깔려고 하는데, 지우는 것도 안 됐다. 뭔 원본 파일을 찾을 수 없다면서 원본 파일의 경로를 계속 요구했다. 이놈이?

짜증나서 놔두다가 검색을 해 봤는데 [MS에서 설명을 제공][1]하고 있었다. 프로그램 삭제 방법을 설명서로 써야 하는 게 웃기긴 했지만, 그래도 설명을 하고 있으니 다행.

설명에 나온 것 중 &#8220;직접 문제 해결&#8221;을 이용해서 쉽게 해결할 수 있었다. 간단히 말하면 `CMD` 파일 만들어서 마우스 우클릭한 다음 &#8216;관리자 권한으로 실행&#8217;을 선택하면 기존에 설치돼 있는 실버라이트가 삭제된다는 거다.

뭐, `CMD` 파일은 손쉽게 메모장으로 만들 수 있지만, 내가 만든 걸 공유한다.

[▷ CleanSilverlight.cmd 다운로드][2]

위 파일을 다운받은 뒤 압축을 푼 다음 나오는 파일을 마우스 우클릭한다. 그럼 &#8220;관리자 권한으로 실행&#8221;이라는 게 있다. 클릭한다. 윈도우XP의 경우엔 &#8220;관리자 권한으로 실행&#8221;이 없는데 아마 그냥 더블클릭하면 될 것 같다. 아님 말고. 난 7이다.

이렇게 실버라이트를 삭제하고, [Silverlight 설치 페이지][3]에 가서 최신 버전을 다운받아 다시 설치하면 된다.

나도 이렇게 하니까 더이상 보기 싫은 업데이트 실패 메시지 안 뜬다.

 [1]: http://support.microsoft.com/kb/2608523/ko
 [2]: https://dl.dropboxusercontent.com/u/15546257/blog/mytory/CleanSilverlight.7z
 [3]: http://www.microsoft.com/getsilverlight/get-started/install/default.aspx