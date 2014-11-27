---
title: 공공데이터포털 우편번호 API 신청 절차와 우편번호 API 정리
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/12185
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/12185-postcode.md
categories:
  - 기타
  - 서버단
tags:
  - API
  - TIP
---
우체국의 [우편번호 OPEN API][1]뿐 아니라 [공공데이터포털][2]에서도 우편번호 OPEN API를 제공하게 됐다. 내가 [예전 우체국 API를 이용해서 만든 우편번호 검색][3]도 2014년 1월 10일 현재 제대로 돌아가긴 한다.

그런데 우체국의 OPEN API는 읍면동을 이용한 구주소 조회밖에 제공하지 않기 때문에 도로명주소 우편번호를 검색하려면 공공데이터포털 것을 이용할 수밖에 없다.

공공데이터포털의 우편번호 API는 쓸만한 것 같다. 하지만 신청 절차가 다소 복잡하고, 활용하는 것도 좀 헤맬 수 있게 돼 있다. API 정리도 일목요연하게 돼 있지 않아 산만하다. 이 글은 신청 절차, 신청한 API의 정보를 보는 법, 그리고 API 자체를 일목요연하게 정리해 주는 글이다.

활용 PHP 코드는 다른 글에서 다루려고 한다. (js로도 짤 수는 있을 텐데, 그러면 자신의 인증키가 노출되니까 권장하지 않겠다.)

## 가입하기

여튼 공공데이터포털에 가 보자. 일단 가입을 해야 한다. 가입하고 나서 &#8216;우편번호&#8217;로 검색을 한다. 검색결과에서 OPEN API 탭을 선택하면 우편번호 다운로드 서비스와 지번주소조회 서비스, 도로명주소조회서비스가 나온다. 아래 이미지 참고.

![][4]

검색 결과 목록에서 바로 **활용신청** 버튼을 누른다. 그러면 신청양식이 나온다. 아래 이미지 참고.

![][5]

우편번호 API는 자동승인되는 것 같으니 바로 다음 단계로 진행할 수 있다.

## 인증키 발급받기

신청을 완료했다면 **마이페이지**에 간 다음 좌측 메뉴 **개발계정** 혹은 **운영계정**으로 가서 내가 신청한 것을 선택한다. 나는 &#8216;[승인] 지번주소조회 서비스&#8217;와 &#8216;[승인] 도로명주소조회서비스&#8217;가 있다. 아래 이미지 참고.

![][6]

&#8216;인증키발급프로그램&#8217;을 다운로드. (띄어쓰기는 정부 포털에 있는 걸 그대로 한 거다. 내가 띄어쓰기 잘못한 거 아니다.)

Crtfc\_Key\_guide.zip 라는 파일을 다운로드하고 압축을 풀어서 인증키를 받아야 한다. 윈도우에서만 들오간다. 이 프로그램의 설명서는 압축파일 안에 doc 문서로 들어 있다. 프로그램은 java로 돼 있다. 아마도 java가 설치돼 있어야 돌아갈 듯?

doc 파일 내용은 아래와 같다.

1.  `esb.properties`, `keystore.ImportKey` 파일을 C 드라이브루트에 저장
2.  `esb.properties` 파일의 `id = yourid` 부분의 `yourid` 부분을 자신의 id로 변경
3.  `esb.properties` 파일의 `password = yourpasswd` 부분의 `yourpasswd` 부분을 자신의 password로 변경
4.  `sessionKeyTool.exe` 을 실행
5.  인증키 생성 버튼 클릭
6.  인증키 등록 버튼 클릭, 예를 클릭
7.  인증키 발급 완료

이미지도 있는데 굳이 이미지까지 볼 필요는 없다.

고작 이런 내용이면 html 파일로 만들어도 충분할 텐데 왜 doc로 만들었는지 모르겠다. 워드 띄우기 싫은데 말이다. 사실 이미지 안 넣고 `readme.txt`로 만들어도 충분하다.

인증키를 발급받고 나면 공공데이터포털 웹사이트의 **마이페이지 > 인증키 발급현황**에서 확인할 수 있다.

신청 API 페이지의 서비스정보 항목에 &#8216;인증키발급프로그램&#8217; 링크가 들어있어서 마치 신청 API별로 인증을 받아야 하는 것처럼 보이는데 아니다. 걍 한 번만 받으면 된다.

그리고, 운영계정도 신청하는 거 잊으면 안 될 듯. API 페이지 우측 상단에 버튼 있다.

## 도로명 주소 API 정리

**마이페이지 > OPEN API > &#8216;개발계정&#8217; 혹은 &#8216;운영계정&#8217; > &#8216;[승인] 도로명주소조회서비스&#8217; 혹은 &#8216;[승인] 지번주소조회 서비스&#8217; > 상세기능정보 항목의 &#8216;개발가이드&#8217; 버튼**을 누르면 개발 설명이 나온다. 기술문서라는 이름으로 PDF 다운받는 것도 있는데 이것도 필요했다. 내가 설명하고 있으니 다운받을 필요는 없다.

여기서는 도로명주소조회서비스만 설명한다. 도로명주소조회서비스의 개발가이드에 가 보면 요청 주소가 아래처럼 씌어 있다.

    http://openapi.epost.go.kr/postal/retrieveNewAdressService/retrieveNewAdressService/getNewAddressList
    

요청변수를 정리하면 이렇다.

*   **`searchSe`** : 검색어 구분(`dong`(지번 주소), `road`(도로명 주소), `post`(우편번호))
*   **`srchwrd`** : 검색어(`단어+공백+숫자` ex. 용암동 10, 낙가산로 22)
*   **`encoding`** : 인코딩 방식(`utf-8`, 기본은 `iso8859-1`)
*   **`serviceKey`** : 인증키

어떻게 찾아 정리했는지 몇 마디만 하고 가자. 개발가이드에는 URL만 나와 있고 요청변수는 `searchSe`(검색구분)과 `srchwrd`(검색어)라고만 돼 있다. 가능한 값이 뭔지는 씌어 있지 않다. 어쩌라는 거지;; 헤맨 결과 아까 기술문서 항목에서 다운받은 PDF에 검색어 구분(검색구분은 검색어 구분이다. 검색 결과 구분이 아니다.) 항목이 씌어 있는 것을 발견했다. 아놔&#8230;

그러나 인증키는 어떻게 넣어야 하는지 찾을 수 없었는데, 인증키 요청 변수명은 개발가이드 상단의 J2EE 개발 가이드 doc 문서에서 변수명을 보고 유추했다;; 썅;; 이따위로 할래.

J2EE doc를 보면 암호화 설명도 막 있고 그런데 다른 API에서 사용하는 거 같다. 우편번호 같은 경우엔 암호화 같은 거 없으니까 그냥 URL에 GET변수로 넘기면 잘 작동한다.

### 요청 URL 예시

아래는 검색결과가 있는 URL 예시다. 검색어는 무조건 `단어+공백+숫자` 조합이어야 한다. 아니면 검색이 안 된다.

    // 구주소 번지로 검색
    http://openapi.epost.go.kr/postal/retrieveNewAdressService/retrieveNewAdressService/getNewAddressList?searchSe=dong&srchwrd=용암동 10&encoding=utf-8&serviceKey=인증키
    
    // 신주소로 정확히 검색
    http://openapi.epost.go.kr/postal/retrieveNewAdressService/retrieveNewAdressService/getNewAddressList?searchSe=road&srchwrd=낙가산로 22&encoding=utf-8&serviceKey=인증키
    
    // 신주소 50-x 중 50만 입력하면 검색 잘 됨
    http://openapi.epost.go.kr/postal/retrieveNewAdressService/retrieveNewAdressService/getNewAddressList?searchSe=road&srchwrd=단재로350번길 50&encoding=utf-8&serviceKey=인증키
    
    // 신주소 단재로 350번길 5도 없고 5-x도 없으므로 검색 안 됨.
    http://openapi.epost.go.kr/postal/retrieveNewAdressService/retrieveNewAdressService/getNewAddressList?searchSe=road&srchwrd=단재로350번길 5&encoding=utf-8&serviceKey=인증키
    

아래는 에러가 뜨는 검색 URL 예시다.

    http://openapi.epost.go.kr/postal/retrieveNewAdressService/retrieveNewAdressService/getNewAddressList?searchSe=road&srchwrd=낙가산로&encoding=utf-8&serviceKey=인증키
    //errMsg : 검색할 도로명과 건물번호를 정확히 입력하십시오! * 검색(입력)방법: 찾고자 하는 주소 : 서울특별시 종로구 세종로 17 세종문화회관 입력 예시 : 도로명 건물번호 => 세종로 17
    

### 응답 XML 구조

응답 XML은 아래와 같다. 아래는 `단재로350번길 50`으로 검색한 결과다. 검색 결과 목록은 두 개를 넘지만 데이터 구조만 보면 되니까 생략했다.

    <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
    <NewAddressListResponse>
        <cmmMsgHeader>
            <requestMsgId></requestMsgId>
            <responseMsgId></responseMsgId>
            <responseTime>20140110:11305145</responseTime>
            <successYN>Y</successYN>
            <returnCode>00</returnCode>
            <errMsg></errMsg>
        </cmmMsgHeader>
        <newAddressList>
            <zipNo>360-186</zipNo>
            <lnmAdres>충청북도 청주시 상당구 단재로350번길 50-6 (평촌동)</lnmAdres>
            <rnAdres>충청북도 청주시 상당구 평촌동 20-1</rnAdres>
        </newAddressList>
        <newAddressList>
            <zipNo>360-186</zipNo>
            <lnmAdres>충청북도 청주시 상당구 단재로350번길 50-8 (평촌동)</lnmAdres>
            <rnAdres>충청북도 청주시 상당구 평촌동 21</rnAdres>
        </newAddressList>
    </NewAddressListResponse>
    

적당히 XML 파싱해서 사용하면 된다.

## 평가

*   검색 결과에 우편번호와 구주소, 신주소가 모두 나와서 좋다. 
*   URL 입력만으로 잘 받을 수 있으니 좋음.
*   속도 빠름.
*   고작 우편번호 받는데 왜 인증키를 넣게 했는지 모르겠음. js만으로 구현하기가 껄끄럽게 됐음.
*   검색어 조건이 너무 까다로움. 난 용암동만 입력해도 결과가 나오면 좋겠는데. 결과값이 너무 많이 나와서 안 좋은가?;;
*   정부 API 문서 정리는 신경좀 써야겠음.

 [1]: http://biz.epost.go.kr/customCenter/custom/custom_10.jsp?subGubun=sub_3&subGubun_1=cum_18&gubun=m07
 [2]: https://www.data.go.kr/
 [3]: http://mytory.net/archives/1284
 [4]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/postcode/postcode1.png
 [5]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/postcode/postcode2.png
 [6]: http://dl.dropboxusercontent.com/u/15546257/blog/mytory/postcode/postcode3.png