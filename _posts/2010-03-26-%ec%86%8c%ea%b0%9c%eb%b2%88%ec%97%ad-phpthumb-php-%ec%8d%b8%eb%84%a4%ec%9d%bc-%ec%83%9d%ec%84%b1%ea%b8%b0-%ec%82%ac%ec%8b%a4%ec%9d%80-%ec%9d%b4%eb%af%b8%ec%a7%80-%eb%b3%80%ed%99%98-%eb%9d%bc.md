---
title: '[소개:번역] phpThumb() : PHP 썸네일 생성기 &#8211; 사실은 이미지 변환 라이브러리'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/463
aktt_notify_twitter:
  - yes
daumview_id:
  - 36987392
categories:
  - 서버단
tags:
  - PHP
  - phpThumb()
---
phpThumb는 PHP로 이미지를 변환하는 라이브러리(?)인 듯하다. 단순히 썸네일을 만드는 라이브러리는 아닌 것 같다. 이름은 비록 Thumb지만 말이다.

GD와 이미지매직이 설치돼 있으면 온갖 기능을 사용할 수 있다.

아래는 소개를 번역한 것이다.(<a href="http://phpthumb.sourceforge.net/" target="_blank">phpThumb() 홈페이지</a>)

&#8212;&#8212;&#8212;&#8212;-

## phpThumb() <sub>: The PHP thumbnail creator</sub>

**phpThumb()**는 사용중(on the fly)인 이미지(JPEG, PNG, GIF, BMP, etc)로 썸네일을 생성하기 위해 <a href="http://www.php.net/manual/en/ref.image.php" target="_blank">GD library</a>를 사용한다. [썸네일] 출력 사이즈는 설정 가능하다.(원본 이미지보다 커도 되고 작아도 된다.) 썸네일은 원본 이미지 전체를 줄여서 만들 수도 있고, 일부를 잘라서 만들 수도 있다. 만약 GD 2.0 이상 버전이 설치돼 있다면 트루 컬러와 리샘플링을 사용한다. 그렇지 않으면 paletted-color와 nearest-neighbour 리사이징을 사용한다.(이미지 전문용어인 것 같은데 여튼 GD2.0 이상 깔려 있으면 더 질이 좋다는 말인 듯) <a href="http://imagemagick.org/" target="_blank">ImageMagick</a>은 속도를 위해 가능한한 어디서나 사용한다. 만약 GD 기능이 설치돼 있지 않아도 기본 기능은 사용할 수 있다.(ImageMagick이 설치돼 있는 한은 말이다.) 제임스 오스틴의 자바스크립트 API 일부를 이용한 데모 파일이 포함돼 있다.

## 지원하는 원본 이미지 포맷:

*   JPEG(GD나 ImageMagick)
*   PNG (via GD or ImageMagick)
*   GIF (via GD, ImageMagick, or phpthumb.gif.php)
*   BMP (via ImageMagick or phpthumb.bmp.php)
*   ImageMagick이 취급하는 기타 이미지 포맷

## 지원하는 출력(변환) 이미지 포맷:

*   JPEG (via GD or ImageMagick)
*   PNG (via GD or ImageMagick)
*   GIF (via GD or ImageMagick)
*   BMP (via ImageMagick or phpthumb.bmp.php)
*   ICO (via ImageMagick or phpthumb.ico.php)

## 이미지 취급 특징

*   원본 이미지는 로컬 서버의 물리적 파일이거나 HTTP에 있는 원격 파일, 혹은 데이터베이스에서 취급되는 파일일 수 있다.[즉, 원본 이미지는 어디서나 가져올 수 있다는 거]
*   GIF는 파비앙 에츠버(Fabien Ezber)가 만든 GIF Util class나 ImageMagick 덕분에 GD 버전에 상관없이 지원한다. (만약 GD가 기본적으로 GIF를 지원하지 않는다고 해도 말이다.)
*   BMP 이미지는 ImageMagick이 없어도 취급할 수 있다.
*   ImageMagick이 사용가능하면 GD만 설치된 경우보다 더 큰 이미지를 다룰 수 있다. GD만 설치된 경우네는 PHP 메모리 제한의 영향을 받는다. GD가 지원하지 않는 이미지 포맷도 취급할 수 있다.(mageMagick (if available) can be called to generate thumbnails for source images larger than PHP&#8217;s memory limitation would allow a GD-only thumbnailer to do, or for image formats that GD does not support.)
*   ImageMagick만 설치돼 있다면 GD가 없는 서버에서도 phpThumb의 기본적 기능은 작동할 것이다.
*   HTTP 썸네일 생성은 원본 이미지를 가진 사이트가 다른 사이트에서 자신의 서버에 있는 이미지를 사용하지 못하도록 차단해 둔 경우 제한될 수 있다.(완전의역:HTTP thumbnail creation can be limited to the current (or other list of) domain to prevent other sites from using your server to create their thumbnails.)
*   다른 도메인에 [있는 이미지에서] 썸네일을 [추출해 자신의 사이트에 보이도록] 연결하는 것은 워터마크가 찍히거나 차단될 수 있다.(이건 phpThumb의 기능을 좀더 알아야 무슨 말인지 알아먹겠다. Linking to thumbnails from another domain can be prevented or watermarked.)
*   썸네일은 서버 부담을 줄이기 위해 캐시할 수 있다. 다양한 사이즈의 원본 이미지는 구분해서 캐시할 수 있다. (로컬에 있는) 원본 이미지를 수정하면 캐시는 자동으로 업데이트된다.
*   내장 EXIF 썸네일(이 있으면) 썸네일하는 소스로 그대로 추출해 사용할 수 있다. 만약 원본 이미지가 PHP 허용 메모리보다 크면 말이다.
*   이미지를 회전시킬 수 있다. 임의의 각도 되고, 얼굴이나 풍경사진은 자동 회전도 된다.
*   이미지 자르기도 된다. 픽셀 지정도 되고 원본 이미지 대비 퍼센트 지정도 된다.
*   PNG를 선택했을 때, 가능한 상태라면, 알파 채널로 안티 앨리어싱된 변환 결과물이 나온다.
*   이미지의 질은 출력 byte 크기에 따라서 자동 조정된다.
*   몇몇 필터를 사용할 수 있다.(대부분은 GD2.0 이상과 PHP4.3이상, 혹은 ImageMagick이 필요하다.) 
    *   썸네일에 워터마크 이미지나 텍스트를 1/10 정밀도로 얹을 수 있다.
    *   외곽선이나 프레임을 얹을 수 있다.
    *   썸네일은 원본 소스의 크기에 상관없이 고정될 수 있다. 이 경우 배경색은 미리 설정된 색으로 채운다. 모서리는 선택적으로 둥글게 할 수 있다.(수평과 수직은 둥글게 하는 게 서로 독립적이다.)
    *   Torstein의 phpUnsharpMask 함수 덕분에 언샵 마스크 샤프닝을 사용할 수 있다.
    *   그 외의 필터 
        *   마스크 파일에서 알파 채널 마스크 뽑기(Alpha channel mask from mask file)
        *   자동 대비 / 레벨
        *   베벨 엣지
        *   흐리게
        *   밝기
        *   Colorize to *target color* by amount(뭔 기능이냐)
        *   대비
        *   드롭 쉐도우(그림자)
        *   엣지 디텍트(모서리 찾기?)
        *   수직 / 수평 뒤집기
        *   감마
        *   스레이스케일
        *   Mean Removal
        *   Negative color
        *   Reduce Color Depth(색상 깊이 깎기?)
        *   둥근 모서리
        *   Saturation
        *   세피아 효과
        *   Smooth
        *   Threshold
        *   화이트 밸런스

예시가 있는 <a href="http://phpthumb.sourceforge.net/demo/demo/phpThumb.demo.demo.php" target="_blank">데모 페이지</a>를 보세요