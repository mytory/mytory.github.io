---
title: Sublime Text 2 세팅(윈도우에서 한글 표시하기, euc-kr 표시하기, FTP 탐색하기)
author: 안형우
layout: post
permalink: /archives/9151
daumview_id:
  - 38969278
categories:
  - 개발 툴
---
[Sublime Text 2][1]는 요새 인기있는 툴이다. 무료로 모든 기능 사용 가능하다. 구입하라는 팝업을 지속적으로 보면 된다. 그리 자주 뜨지는 않는다.

## 윈도우에서 한글 표시하기

**Preferences > Setting &#8211; User**에 아래 코드 추가.

<pre>"font_face": "nanumgothiccoding",</pre>

결과적으로 이렇게 보이면 된다.(2.0.1 기준)

<pre>{
	"font_face": "nanumgothiccoding",
	"ignored_packages":
	[
		"Vintage"
	]
}</pre>

난 나눔고딕 코딩으로 했는데 선호하는 한글 글꼴을 넣으면 된다.

## [EUC-KR 표시하기][2]와[ FTP 탐색하기][3]

EUC-KR 표시하기와 FTP 탐색하기를 같이 쓴 이유는, [Package control][4]을 사용해서 설치하면 되기 때문이다. [Package control][4]에 가서 설치 방법을 보고 시키는대로 한다. 사실 시키는 건 많지 않고 그냥 아래처럼 하면 된다.

Ctrl+\`을 누른 다음 아래 코드를 붙여넣고 엔터.

<pre>import urllib2,os; pf='Package Control.sublime-package'; ipp=sublime.installed_packages_path(); os.makedirs(ipp) if not os.path.exists(ipp) else None; urllib2.install_opener(urllib2.build_opener(urllib2.ProxyHandler())); open(os.path.join(ipp,pf),'wb').write(urllib2.urlopen('http://sublime.wbond.net/'+pf.replace(' ','%20')).read()); print 'Please restart Sublime Text to finish installation'</pre>

그리고 Sublime Text 2를 껐다가 켠다. 그러면 이제 확장을 UI를 통해 설치할 수 있게 된다.

Sublime Text 2를 다시 켰으면 이제 ctrl+shift+p를 눌러서 Package Control을 켠다. 가운데 뭐가 뜰 거다. insall 이라고 치면 Package Control: Install Package라는 놈만 남을 거다. 클릭.

그러면 또 뭐가 좌악 뜬다. sftp라고 치면 Sublime SFTP라는 확장이 나온다. 클릭해서 설치. (이 확장은 Sublime Text 2처럼 구입 권유를 보면서 무료로 사용할 수 있다.)

그 다음 같은 방법을 거쳐서 ConvertToUTF8을 찾아서 설치.

여기까지 하면 세팅 완료다. SFTP는 메뉴의 **File > SFTP/FTP**로 들어가서 서버 설정을 하고 사용하면 된다.

ConvertToUTF8 사용법은? 메뉴의 **File > Set File Encoding to > Korean(EUC-KR)** 을 선택해 주면 EUC-KR로 파일을 읽고 쓰게 된다.

 [1]: http://www.sublimetext.com/2
 [2]: https://github.com/seanliang/ConvertToUTF8#installation
 [3]: http://wbond.net/sublime_packages/sftp/installation
 [4]: http://wbond.net/sublime_packages/package_control