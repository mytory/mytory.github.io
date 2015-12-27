---
layout: post
title: "크롬, 다운로드 상태바 없애는 키보드 단축키"
categories:
- 기타
tag:
- TIP
---

난 웹브라우징할 때 마우스를 잘 사용하지 않는다. 내가 손이 약해 그런지 몰라도, 검지 관절이 아프기 때문이다. 그래서 [Vimium](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb) 같은 확장을 사용해 마우스 없이 웹브라우징을 한다.

그런데, 크롬에서 뭔가를 다운받았을 때 하단에 다운로드 상태바가 남아 있는 것은 좀 성가시다. 다운받을 때야 상태를 알 수 있으니 좋다. 그런데 다운로드가 끝난 뒤에도 계속 남아서 파일을 보여 주고 있는 것이다. 마우스로 x를 누르면 내려가지만 귀찮은 일이다. 키보드에서 손을 떼기 싫다.

이걸 제거하는 방법을 찾아 다녔는데, [Always Close Downloads](https://chrome.google.com/webstore/detail/always-clear-downloads/cpbmgiffkljiglnpdbljhlenaikojapc) 확장 말고는 별 게 없다. 그런데 Always Close Downloads 확장은, 다운로드가 끝난 걸 인지하기 어렵게 만들어서 별로였다.

[맥에서 매크로를 만드는 방법](http://rocketink.net/2013/06/close-google-chrome-downloads.html)도 있었는데, 난 맥이 없다.

그런데 의외로 쉽게 발견했다. 방법은 바로, <kbd>Ctrl</kbd> + <kbd>j</kbd>를 누르는 것이다. 그러면 전체 다운로드 목록 탭이 열린다. 그러면서 다운로드 상태바가 사라진다. 와우~ 이제 다시 <kbd>Ctrl</kbd> + <kbd>w</kbd>를 눌러서 다운로드 목록 탭을 닫으면 원래 탭으로 돌아온다. 

결론.

<pre>
Ctrl + j, Ctrl + w
</pre>