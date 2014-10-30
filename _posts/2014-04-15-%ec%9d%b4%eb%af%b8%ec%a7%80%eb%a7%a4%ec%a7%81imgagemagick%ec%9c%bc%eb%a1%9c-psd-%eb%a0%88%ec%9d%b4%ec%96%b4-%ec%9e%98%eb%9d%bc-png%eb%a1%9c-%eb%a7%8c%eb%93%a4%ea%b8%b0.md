---
title: '[ImgageMagick] PSD의 모든 레이어를 한방에 PNG로 뽑기'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12922
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/convert-psd-layers-to-png.md
categories:
  - 기타
tags:
  - Program
---
이미지매직(ImageMagick)은 이미지를 다루는 라이브러리다(magic이 아니라 magick이라고 끝에 k가 붙어 있는 걸 유념하라). 내가 처음 ImageMagick을 만난 건, PHPThumb를 사용하면서였다. 이 놈이 단지 PHP 라이브러리가 아니라 강력한 범용 라이브러리고, 윈도우 GUI도 있으며, 커맨드라인에서도 작동한다는 건 좀 나중에 알았다.

리눅스 등에선 레포지토리에 ImageMagick이 있으므로 우분투 같은 데비안 계열이라면 간단히 아래 명령으로 설치할 수 있다.

    sudo apt-get install imagemagick
    

나머지 리눅스도 레포지토리에서 검색해 보면 나올 거다. 맥도 homebrew나 macport로 설치할 수 있다. 윈도우라면 웹사이트에 가서 설치 파일을 다운받아서 설치하면 된다.

[**ImageMagick 웹사이트**][1]

## 커맨드라인 명령어로 PSD 레이어 전부 따기

ImageMagick에서 이미지 변환을 위해 사용하는 커맨드 라인 명령어는 `convert`다. 이놈이 상당히 강력한 기능들을 갖추고 있는데, 기본적인 사용법은 아주 간단하다.

    convert 바꿀파일 결과물파일명
    

이렇게 하면 확장자를 보고 알아서 판단해서 이미지를 변환한다. 심지어 PDF도 이미지로 변환해 준다. 각 페이지를 한 페이지씩 파일로 만든다(옵션없이 하면 퀄리티가 떨어진다).

친구가 우연히 `convert image.psd image.png`라고 명령을 친 적이 있었다. PSD의 전체 모양을 PNG로 만들려고 친 명령이었는데, 웬걸, 파일이 `image-1.png` 형식으로 마구 생기는 것이다. 모든 레이어를 PNG로 만들어 준 것이다. 세상에! 레이어를 따느라 보냈던 그 수많은 시간들이 허무해지는 순간이었다!

## 윈도우 사용자를 위해 정리

윈도우 사용자는 커맨드라인이 뭔지 잘 모를 수도 있겠다. 그래서 윈도우 커맨드라인에서 사용하는 방법 정리.

1.  `Window키 + R`을 누르면 뭔가 입력하는 창이 뜬다. 거기에 `cmd`라고 쓰고 엔터.
2.  그러면 까만 창이 뜨고 커서가 깜빡대고 있다. 이놈이 바로 윈도우 커맨드라인이다.
3.  커맨드라인에 `cd`라고 쓴 변환할 이미지가 있는 폴더를 탐색기에서 드래그 앤 드롭한다. 그러면 해당 폴더의 경로가 자동으로 써 질 거다. 당연히 드래그 앤 드롭으로 하지 않고 직접 폴더명을 입력해도 된다. 첫 글자(혹은 좀더) 쓴 다음 `Tab` 키를 누르면 자동완성이 된다. 해당 글자로 시작하는 폴더가 많으면 `Tab`을 여러 번 치면 된다. (ex. 커맨드라인에 `cd C:\Users\Administrator\Dropbox` 같은 형식의 문자열이 씌어 있게 되면 성공한 거다.)
4.  엔터치면 아래처럼 위치가 변한 게 표시가 난다. 커서가 깜박버리는 부분의 앞이 현재 위치를 표시해 준다.  
    ![][2]
5.  저 위치에 있는 변환하길 원하는 파일의 이름이 `myimage.psd`라고 가정하자. 그러면 아래처럼 써 준다.  
    `convert myimage.psd myimage.png`

이러면 `myimage-1.png`, `myimage-2.png`&#8230; 하는 식으로 모든 레이어가 PNG 파일로 변환된다. 디자이너나 퍼블리셔들에게 좋은 팁이 될 수 있을 것 같다.

 [1]: http://www.imagemagick.org/
 [2]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/imagemagick-psd.png