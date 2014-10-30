---
title: 'SVG 활용 4 &#8211; 미지원 브라우저 대응'
author: 녹풍(綠風, Windgreen)
layout: post
permalink: /archives/11338
mytory_markdown_html:
  - |
    |
        
        <p>이 글은 <a href="http://mytory.local/archives/tag/%eb%a7%88%eb%b2%95-%eb%82%98%eb%ac%b4-%ed%85%8c%eb%a7%88">블로그 디자인을 개편하면서 얻은 경험을 공유하는 글</a>이다. 첫 번째로, <a href="http://mytory.local/archives/tag/svg-%ed%99%9c%ec%9a%a9">SVG 활용에 대한 글</a>을 여러 편으로 나눠서 쓰고 있다.</p>
        
        <h2>SVG를 지원하지 않는 브라우저</h2>
        
        <p>SVG를 지원하지 않는 브라우저는 두 가지 종류가 있다고 봐야 할 거다.</p>
        
        <ol>
        <li>SVG 대신 VML을 지원하는 IE6~8</li>
        <li>그냥 지원하지 않는 브라우저. 예컨대 텍스트 브라우저, 오페라 미니 구버전(최신 버전도 인라인 SVG는 지원 안 한다.)</li>
        </ol>
        
        <h2>일반적인 간편한 대응</h2>
        
        <p>이걸 대응하는 가장 간단한 방법은 Modernizr를 사용하는 것이다. <a href="http://modernizr.com/download/#-svg">Modernizr 웹사이트에 가서 SVG만 체크한 뒤 다운</a>을 받고, 다음 코드를 사용하면 된다!</p>
        
        <pre><code>if(Modernizr.svg){
            // png를 SVG로 교체!
        }
        </code></pre>
        
        <p>인라인 SVG를 사용하는 경우에는 <a href="http://modernizr.com/download/#-inlinesvg-svg">inline svg도 체크하고 다운</a>받아야 한다. 코드는 당연히 아래와 같은 게 추가로 들어가야 할 것이다.</p>
        
        <pre><code>if( ! Modernizr.inlinesvg){
            // png를 SVG로 교체!
        }
        </code></pre>
        
        <p>이러면 간단하다.</p>
        
        <p>SVG를 비트맵 이미지로 교체하는 코드는 js 코드는 알아서 작성하면 될 거다. <code>img</code> 태그에서 확장자만 교체한다거나, <code>data-svg-path</code>라는 속성을 <code>img</code>에 넣어서 변경하게 한다거나 하는 방법이 있을 것이다. 아니면 <code>img</code>를 두 개 준비해서 하나를 날리는 방법도 있다. 여튼간에 방법은 알아서.</p>
        
        <h2>VML</h2>
        
        <p>IE9 이하인 경우엔 VML을 사용하도록 해 주는 방법도 있긴 하다. 나는 그렇게까지 하진 않았다.</p>
        
        <p>내가 SVG를 사용하는 주된 이유는 이벤트 핸들링이 아니라, 레티나 화면 대응이다. 일반적인 데스크톱에서 사용되는 IE6~8에서 굳이 비트맵 이미지를 벡터 이미지로 변경해 보여 줄 필요가 없다. 레티나 해상도 노트북은 크롬북이나 맥북 프로인데 심지어 IE는 이 두 노트북을 지원하지도 않는다. 윈도우8.1에서 레티나 해상도를 지원한다고 하는데, IE10이 설치돼 있을 테니 SVG를 지원할 것이다.</p>
        
        <p>물론 이미지에 이벤트를 걸 생각이라면 이야기는 달라진다. 벡터 이미지에 이벤트를 걸고 IE6까지 지원하게 만든 경우를 본 적이 있다. 이 글에 자세히 나와 있다: <a href="http://playgroundinc.com/blog/the-playground-vector-animation-process/">The Playground Vector Animation Process</a></p>
        
        <p>그런 걸 간단하게 하려면 <a href="http://raphaeljs.com/">라파엘js</a> 라이브러리를 보면 된다.</p>
        
        <h2>적극적 SVG 활용 방식</h2>
        
        <p>js로 SVG 지원 여부를 판단해서 비트맵 이미지를 벡터 이미지로 바꿔 주는 방식은 큰 장점이 있다. js가 꺼져있고 SVG도 지원하지 않는, 잘 알려지지 않은 브라우저에서도 이 방식은 이미지를 안전하게 보여 준다. 예를 들면, 안드로이드 브라우저 2.3 같은 거 말이다. 안드로이드 브라우저는 잘 알려지지 않았다고 할 수 없겠지만, 여튼간에 나도 모르는 이런 브라우저는 많을 거다. 다수가 사용하지는 않더라도 말이다.</p>
        
        <p>그래서 안정적인 서비스가 우선인 경우엔 위 방식대로 사용할 것은 권한다.</p>
        
        <p>그런데 위 방식대로 하면 비트맵 이미지를 다운받다가 SVG로 교체하게 되니까, 즉 트래픽을 추가 소모하게 되니까 왠지 SVG를 지원하는 브라우저들이 억울해진다. 비트맵 이미지가 SVG로 교체되는 순간에 잠깐의 깜빡임도 있다. 비트맵 이미지를 SVG로 교체하는 방식의 단점이다.</p>
        
        <p>개발자들이 주로 들르는 내 블로그는, SVG를 지원하는 브라우저를 우대하기로 했다. 그래서 아래와 같은 접근법을 취했다.</p>
        
        <ol>
        <li>PHP 단에서 IE8 이하와 Opera Mini를 판별해 내서, 그런 경우엔 png를 뿌려 준다.</li>
        <li>위 조건에 해당하지 않는 경우엔 일단 SVG를 뿌린다.</li>
        <li>Modernizr로 SVG 지원 여부를 탐지해서 지원하지 않는 경우엔 png로 교체해 준다.</li>
        </ol>
        
        <p>이렇게 하면 SVG를 지원하지 않으면서 js도 지원하지 않는 브라우저에선 이미지가 깨져 보인다. 극소수일 테지만 있긴 있을 것이다. 내 블로그는 안정적인 서비스가 최우선인 곳은 아니니까 그런 경우는 무시하기로 했다.</p>
        
        <h2>PHP로 브라우저 탐지</h2>
        
        <p><a href="http://stackoverflow.com/a/11957976">PHP로 브라우저를 탐지하는 코드</a>는 Stack Overflow에서 긁은 다음 내가 조금 수정했다.  <a class="simple-footnote" title="safari라고 돼 있는 걸 webkit으로 변경하고, 클래스 방식이던 걸 그냥 함수로 변경했다." id="return-note--1" href="#note--1"><sup>1</sup></a> jQuery 1.3.1에 있는 코드를 PHP로 옮긴 거라고 한다. PHP의 <code>get_browser()</code> 함수는 php.ini에 browscap.ini 경로가 제대로 들어가 있지 않은 경우엔 작동하지 않는다. 내 localhost에서도 그랬고, 잘 작동하지 않는 경우도 꽤 있을 것 같아서 그냥 함수를 가져다 사용하기로 했다.</p>
        
        <pre><code class="php">/**
         * Figure out what browser is used, its version and the platform it is 
         * running on. 
         * The following code was ported in part from JQuery v1.3.1 
         * I modified from http://stackoverflow.com/a/11957976
         * @return array browser info
         */
        function detect_browser($http_user_agent = '') { 
            if( ! $http_user_agent){
                $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
            }
            $userAgent = strtolower($http_user_agent); 
        
            // Identify the browser. Check Opera and Safari first in case of spoof. Let Google Chrome be identified as Safari. 
            if (preg_match('/opera/', $userAgent)) { 
                $name = 'opera'; 
            } 
            if (preg_match('/opera mini/', $userAgent)) { 
                $name = 'opera mini'; 
            } 
            elseif (preg_match('/webkit/', $userAgent)) { 
                $name = 'webkit'; 
            } 
            elseif (preg_match('/msie/', $userAgent)) { 
                $name = 'msie'; 
            } 
            elseif (preg_match('/mozilla/', $userAgent) &amp;&amp; !preg_match('/compatible/', $userAgent)) { 
                $name = 'mozilla'; 
            } 
            else { 
                $name = 'unrecognized'; 
            } 
        
            // What version? 
            if (preg_match('/.+(?:rv|it|ra|ie)[/: ]([d.]+)/', $userAgent, $matches)) { 
                $version = $matches[1]; 
            } 
            else { 
                $version = 'unknown'; 
            } 
        
            // Running on what platform? 
            if (preg_match('/linux/', $userAgent)) { 
                $platform = 'linux'; 
            } 
            elseif (preg_match('/macintosh|mac os x/', $userAgent)) { 
                $platform = 'mac'; 
            } 
            elseif (preg_match('/windows|win32/', $userAgent)) { 
                $platform = 'windows'; 
            } 
            else { 
                $platform = 'unrecognized'; 
            } 
        
            return array( 
                'name'      =&gt; $name, 
                'version'   =&gt; $version, 
                'platform'  =&gt; $platform, 
                'userAgent' =&gt; $userAgent 
            ); 
        }
        </code></pre>
        
        <p>이 브라우저 감지 함수를 바탕으로 아래 SVG 미지원 브라우저 탐지 함수를 만들었다. 물론 모두 탐지하는 게 아니라 오페라 미니와 IE8 이하만 탐지한다. 오페라 미니는 최신 버전에서 SVG를 지원하기는 하지만, 어차피 SVG도 비트맵 이미지로 변경해서 보여 주기 때문에 별 의미가 없다. 그래서 오페라 미니인 경우에도 그냥 png를 뿌리게 한 것이다.</p>
        
        <pre><code class="php">function not_svg_browser(){
            $browser = mbt_detect_browser();
            if($browser['name'] == 'msie' AND $browser['version'] &lt; 9){
                return TRUE;
            }
            if($browser['name'] == 'opera mini'){
                return TRUE;
            }
        }
        </code></pre>
        
        <p>최종적으로는 아래와 같은 코드를 사용하게 됐다.</p>
        
        <pre><code class="php">function get_svg($filepath, $classname = NULL, $type = ''){
            if(isset($_REQUEST['type'])){
                $type = $_REQUEST['type'];
            }
            if(mbt_not_svg_browser() OR $type == 'png'){
                $filepath_png = str_replace('.svg', '.png', $filepath);
                return "&lt;img src='{$filepath_png}' class='{$classname}'&gt;";
            }else{
                return "&lt;img src='{$filepath}' class='{$classname} js-img-svg'&gt;";
            }
        }
        </code></pre>
        
        <p>위 함수에서 세 번째 인자값인 <code>$type</code>은 테스트를 위해 넣은 거다. <code>$type</code>에 <code>png</code>를 넣어 주면 png로 출력되는 웹사이트 모습을 볼 수 있다. <code>str_replace()</code> 함수를 써서 <code>.svg</code>만 <code>.png</code>로 교체하게 한 건 게으르게 코드를 짠 것이다. 물론 간편하다. 내 경우엔 모든 URL을 예상할 수 있는 경우였으니까 마음놓고 <code>str_replace()</code> 함수를 사용했다. 그러나 URL을 예상할 수 없는 경우엔 정공법으로 <code>pathinfo()</code> 함수를 사용해야 한다.</p>
        
        <p><code>svg</code>를 로드한 경우엔 <code>img</code>에 <code>js-img-svg</code>라는 클래스를 붙였다. 이 클래스는 js에서 사용한다.</p>
        
        <p><code>js-</code>라는 접두어는 js에서 사용하는 클래스고 스타일이 매겨지는 건 아니라는 의미로 쓴 것이다. 내가 개인적으로 사용하는 규칙이다.</p>
        
        <h2>js로 대체하기</h2>
        
        <p>PHP로 대응한 뒤, IE8 이하도 아니고, 오페라 미니도 아니면서 SVG를 지원하지 않는 브라우저인 경우엔 js가 SVG를 png로 교체하도록 했다. js 코드는 아래와 같다.</p>
        
        <pre><code>jQuery(document).ready(function($){
            if( ! Modernizr.svg &amp;&amp; is_svg_load()){
                $('.js-img-svg').each(function(){
                    var src = $(this).attr('src');
                    $(this).attr('src', src.replace(/.svg/, '.png'));
                });
            }
        }
        </code></pre>
        
        <p>내 경우엔 inline SVG를 사용하지 않았으니 <code>Modernizr.inlinesvg</code>를 사용하진 않았다.</p>
        
        <p>위 코드를 해석하면, SVG를 지원하지 않는데 SVG를 로드한 경우엔 모든 SVG 코드를 돌면서 <code>src</code> 속성의 <code>.svg</code>를 <code>.png</code>로 교체하는 것이다.</p>
        
        <p>두 번째 줄의 <code>is_svg_load()</code> 함수는 아래와 같다.</p>
        
        <pre><code>var is_svg_load = function(){
            return ($('.js-img-svg').length &gt; 0);
        };
        </code></pre>
        
        <p>위의 PHP <code>get_svg()</code> 함수에서 SVG를 로드한 경우엔 <code>img</code>에 <code>js-img-svg</code>라는 클래스를 붙였는데, 해당 클래스가 존재하면 SVG가 로드된 것으로 간주한다.</p>
        
        <p>나는 이걸 &#8216;적극적 SVG&#8217;라고 이름짓기로 했다. 적극적 SVG 방식의 규칙을 다시 정리하면 아래와 같다.</p>
        
        <h3>적극적 SVG 규칙</h3>
        
        <ol>
        <li>IE8 이하와 오페라 미니는 PHP 쪽에서 png를 뿌린다.</li>
        <li>나머지는 SVG를 뿌린다.</li>
        <li>SVG를 지원하지 않는 브라우저인데 SVG가 로드된 경우 js에서 처리한다.</li>
        <li>js가 꺼져있고, SVG를 지원하지 않는 브라우저는 포기한다.</li>
        </ol>
        
        <h2>인라인 SVG를 이용하는 경우 도움이 될 함수</h2>
        
        <p>앞서 말했듯이 내 블로그엔 처음에는 인라인 SVG를 사용했다. 문서에 긴 svg 태그를 그냥 때려 박으면 코딩할 때 상당히 어지럽다. 따라서
        나는 php 함수를 만들어서 SVG를 읽어 들이게 했다.</p>
        
        <pre><code class="php">function get_inline_svg($filepath, $classname = NULL){
        
            // svg 파일을 읽어 들인다.
            $svg_string = file_get_contents(dirname(__FILE__) . $filepath);
        
            // 읽어들인 svg에서 삭제할 문자열. xml 선언, 문서형 선언, 주석이다.
            $empty_target = array(
                '&lt;?xml version="1.0" encoding="utf-8"?&gt;',
                '&lt;!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --&gt;',
                '&lt;!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"&gt;',
            );
            $svg_string = str_replace($empty_target, array('','',''), $svg_string);
        
            // 클래스명 인자가 넘어왔으면 넣어 준다.
            if($classname){
                $svg_string = str_replace('&lt;svg ', '&lt;svg class="' . $classname . '" ', $svg_string);
            }
        
            return $svg_string;
        }
        </code></pre>
        
        <p>이 함수를 이용해서 아래처럼 sns 아이콘들을 표현했었다. 트래픽이 감당이 안 되서 나중엔 inline SVG를 포기하게 되긴 했지만 말이다.</p>
        
        <pre><code>&lt;ul&gt;
            &lt;li&gt;&lt;a ...&gt;&lt;?php echo get_inline_svg('/images/icon-twitter.svg')?&gt;&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a ...&gt;&lt;?php echo get_inline_svg('/images/icon-facebook.svg')?&gt;&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a ...&gt;&lt;?php echo get_inline_svg('/images/icon-g+.svg')?&gt;&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a ...&gt;&lt;?php echo get_inline_svg('/images/icon-print.svg')?&gt;&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
        </code></pre>
        
        <p>이정도면 미지원 브라우저 대응에 대해서 내가 한 대응과 그 이유는 다 설명했다.</p>
        
        <p>다음 글에서 설명할 것은 SVG에 CSS를 매기고, 이벤트를 걸고, 트랜지션 효과를 주는 것이다. 나도 많이 사용한 건 아니라 적당히만 다룰 것이다.</p>
        
daumview_id:
  - 50543291
mytory_md_path:
  - http://dl.dropboxusercontent.com/u/15546257/mytory-md-content/svg4.md
categories:
  - 서버단
  - 웹 퍼블리싱
tags:
  - IE:인터넷 익스플로러
  - PHP
  - SVG 활용
  - 마법 나무 테마
---
이 글은 [블로그 디자인을 개편하면서 얻은 경험을 공유하는 글][1]이다. 첫 번째로, [SVG 활용에 대한 글][2]을 여러 편으로 나눠서 쓰고 있다.

## SVG를 지원하지 않는 브라우저

SVG를 지원하지 않는 브라우저는 두 가지 종류가 있다고 봐야 할 거다.

1.  SVG 대신 VML을 지원하는 IE6~8
2.  그냥 지원하지 않는 브라우저. 예컨대 텍스트 브라우저, 오페라 미니 구버전(최신 버전도 인라인 SVG는 지원 안 한다.)

## 일반적인 간편한 대응

이걸 대응하는 가장 간단한 방법은 Modernizr를 사용하는 것이다. [Modernizr 웹사이트에 가서 SVG만 체크한 뒤 다운][3]을 받고, 다음 코드를 사용하면 된다!

    if(Modernizr.svg){
        // png를 SVG로 교체!
    }
    

인라인 SVG를 사용하는 경우에는 [inline svg도 체크하고 다운][4]받아야 한다. 코드는 당연히 아래와 같은 게 추가로 들어가야 할 것이다.

    if( ! Modernizr.inlinesvg){
        // png를 SVG로 교체!
    }
    

이러면 간단하다.

SVG를 비트맵 이미지로 교체하는 코드는 js 코드는 알아서 작성하면 될 거다. `img` 태그에서 확장자만 교체한다거나, `data-svg-path`라는 속성을 `img`에 넣어서 변경하게 한다거나 하는 방법이 있을 것이다. 아니면 `img`를 두 개 준비해서 하나를 날리는 방법도 있다. 여튼간에 방법은 알아서.

## VML

IE9 이하인 경우엔 VML을 사용하도록 해 주는 방법도 있긴 하다. 나는 그렇게까지 하진 않았다.

내가 SVG를 사용하는 주된 이유는 이벤트 핸들링이 아니라, 레티나 화면 대응이다. 일반적인 데스크톱에서 사용되는 IE6~8에서 굳이 비트맵 이미지를 벡터 이미지로 변경해 보여 줄 필요가 없다. 레티나 해상도 노트북은 크롬북이나 맥북 프로인데 심지어 IE는 이 두 노트북을 지원하지도 않는다. 윈도우8.1에서 레티나 해상도를 지원한다고 하는데, IE10이 설치돼 있을 테니 SVG를 지원할 것이다.

물론 이미지에 이벤트를 걸 생각이라면 이야기는 달라진다. 벡터 이미지에 이벤트를 걸고 IE6까지 지원하게 만든 경우를 본 적이 있다. 이 글에 자세히 나와 있다: [The Playground Vector Animation Process][5]

그런 걸 간단하게 하려면 [라파엘js][6] 라이브러리를 보면 된다.

## 적극적 SVG 활용 방식

js로 SVG 지원 여부를 판단해서 비트맵 이미지를 벡터 이미지로 바꿔 주는 방식은 큰 장점이 있다. js가 꺼져있고 SVG도 지원하지 않는, 잘 알려지지 않은 브라우저에서도 이 방식은 이미지를 안전하게 보여 준다. 예를 들면, 안드로이드 브라우저 2.3 같은 거 말이다. 안드로이드 브라우저는 잘 알려지지 않았다고 할 수 없겠지만, 여튼간에 나도 모르는 이런 브라우저는 많을 거다. 다수가 사용하지는 않더라도 말이다.

그래서 안정적인 서비스가 우선인 경우엔 위 방식대로 사용할 것은 권한다.

그런데 위 방식대로 하면 비트맵 이미지를 다운받다가 SVG로 교체하게 되니까, 즉 트래픽을 추가 소모하게 되니까 왠지 SVG를 지원하는 브라우저들이 억울해진다. 비트맵 이미지가 SVG로 교체되는 순간에 잠깐의 깜빡임도 있다. 비트맵 이미지를 SVG로 교체하는 방식의 단점이다.

개발자들이 주로 들르는 내 블로그는, SVG를 지원하는 브라우저를 우대하기로 했다. 그래서 아래와 같은 접근법을 취했다.

1.  PHP 단에서 IE8 이하와 Opera Mini를 판별해 내서, 그런 경우엔 png를 뿌려 준다.
2.  위 조건에 해당하지 않는 경우엔 일단 SVG를 뿌린다.
3.  Modernizr로 SVG 지원 여부를 탐지해서 지원하지 않는 경우엔 png로 교체해 준다.

이렇게 하면 SVG를 지원하지 않으면서 js도 지원하지 않는 브라우저에선 이미지가 깨져 보인다. 극소수일 테지만 있긴 있을 것이다. 내 블로그는 안정적인 서비스가 최우선인 곳은 아니니까 그런 경우는 무시하기로 했다.

## PHP로 브라우저 탐지

[PHP로 브라우저를 탐지하는 코드][7]는 Stack Overflow에서 긁은 다음 내가 조금 수정했다. <a class="simple-footnote" title="safari라고 돼 있는 걸 webkit으로 변경하고, 클래스 방식이던 걸 그냥 함수로 변경했다." id="return-note-11338-1" href="#note-11338-1"><sup>1</sup></a> jQuery 1.3.1에 있는 코드를 PHP로 옮긴 거라고 한다. PHP의 `get_browser()` 함수는 php.ini에 browscap.ini 경로가 제대로 들어가 있지 않은 경우엔 작동하지 않는다. 내 localhost에서도 그랬고, 잘 작동하지 않는 경우도 꽤 있을 것 같아서 그냥 함수를 가져다 사용하기로 했다.

<pre><code class="php">/**
 * Figure out what browser is used, its version and the platform it is 
 * running on. 
 * The following code was ported in part from JQuery v1.3.1 
 * I modified from http://stackoverflow.com/a/11957976
 * @return array browser info
 */
function detect_browser($http_user_agent = '') { 
    if( ! $http_user_agent){
        $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
    }
    $userAgent = strtolower($http_user_agent); 

    // Identify the browser. Check Opera and Safari first in case of spoof. Let Google Chrome be identified as Safari. 
    if (preg_match('/opera/', $userAgent)) { 
        $name = 'opera'; 
    } 
    if (preg_match('/opera mini/', $userAgent)) { 
        $name = 'opera mini'; 
    } 
    elseif (preg_match('/webkit/', $userAgent)) { 
        $name = 'webkit'; 
    } 
    elseif (preg_match('/msie/', $userAgent)) { 
        $name = 'msie'; 
    } 
    elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent)) { 
        $name = 'mozilla'; 
    } 
    else { 
        $name = 'unrecognized'; 
    } 

    // What version? 
    if (preg_match('/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches)) { 
        $version = $matches[1]; 
    } 
    else { 
        $version = 'unknown'; 
    } 

    // Running on what platform? 
    if (preg_match('/linux/', $userAgent)) { 
        $platform = 'linux'; 
    } 
    elseif (preg_match('/macintosh|mac os x/', $userAgent)) { 
        $platform = 'mac'; 
    } 
    elseif (preg_match('/windows|win32/', $userAgent)) { 
        $platform = 'windows'; 
    } 
    else { 
        $platform = 'unrecognized'; 
    } 

    return array( 
        'name'      =&gt; $name, 
        'version'   =&gt; $version, 
        'platform'  =&gt; $platform, 
        'userAgent' =&gt; $userAgent 
    ); 
}
</code></pre>

이 브라우저 감지 함수를 바탕으로 아래 SVG 미지원 브라우저 탐지 함수를 만들었다. 물론 모두 탐지하는 게 아니라 오페라 미니와 IE8 이하만 탐지한다. 오페라 미니는 최신 버전에서 SVG를 지원하기는 하지만, 어차피 SVG도 비트맵 이미지로 변경해서 보여 주기 때문에 별 의미가 없다. 그래서 오페라 미니인 경우에도 그냥 png를 뿌리게 한 것이다.

<pre><code class="php">function not_svg_browser(){
    $browser = mbt_detect_browser();
    if($browser['name'] == 'msie' AND $browser['version'] &lt; 9){
        return TRUE;
    }
    if($browser['name'] == 'opera mini'){
        return TRUE;
    }
}
</code></pre>

최종적으로는 아래와 같은 코드를 사용하게 됐다.

<pre><code class="php">function get_svg($filepath, $classname = NULL, $type = ''){
    if(isset($_REQUEST['type'])){
        $type = $_REQUEST['type'];
    }
    if(mbt_not_svg_browser() OR $type == 'png'){
        $filepath_png = str_replace('.svg', '.png', $filepath);
        return "&lt;img src='{$filepath_png}' class='{$classname}'&gt;";
    }else{
        return "&lt;img src='{$filepath}' class='{$classname} js-img-svg'&gt;";
    }
}
</code></pre>

위 함수에서 세 번째 인자값인 `$type`은 테스트를 위해 넣은 거다. `$type`에 `png`를 넣어 주면 png로 출력되는 웹사이트 모습을 볼 수 있다. `str_replace()` 함수를 써서 `.svg`만 `.png`로 교체하게 한 건 게으르게 코드를 짠 것이다. 물론 간편하다. 내 경우엔 모든 URL을 예상할 수 있는 경우였으니까 마음놓고 `str_replace()` 함수를 사용했다. 그러나 URL을 예상할 수 없는 경우엔 정공법으로 `pathinfo()` 함수를 사용해야 한다.

`svg`를 로드한 경우엔 `img`에 `js-img-svg`라는 클래스를 붙였다. 이 클래스는 js에서 사용한다.

`js-`라는 접두어는 js에서 사용하는 클래스고 스타일이 매겨지는 건 아니라는 의미로 쓴 것이다. 내가 개인적으로 사용하는 규칙이다.

## js로 대체하기

PHP로 대응한 뒤, IE8 이하도 아니고, 오페라 미니도 아니면서 SVG를 지원하지 않는 브라우저인 경우엔 js가 SVG를 png로 교체하도록 했다. js 코드는 아래와 같다.

    jQuery(document).ready(function($){
        if( ! Modernizr.svg && is_svg_load()){
            $('.js-img-svg').each(function(){
                var src = $(this).attr('src');
                $(this).attr('src', src.replace(/\.svg/, '.png'));
            });
        }
    }
    

내 경우엔 inline SVG를 사용하지 않았으니 `Modernizr.inlinesvg`를 사용하진 않았다.

위 코드를 해석하면, SVG를 지원하지 않는데 SVG를 로드한 경우엔 모든 SVG 코드를 돌면서 `src` 속성의 `.svg`를 `.png`로 교체하는 것이다.

두 번째 줄의 `is_svg_load()` 함수는 아래와 같다.

    var is_svg_load = function(){
        return ($('.js-img-svg').length > 0);
    };
    

위의 PHP `get_svg()` 함수에서 SVG를 로드한 경우엔 `img`에 `js-img-svg`라는 클래스를 붙였는데, 해당 클래스가 존재하면 SVG가 로드된 것으로 간주한다.

나는 이걸 &#8216;적극적 SVG&#8217;라고 이름짓기로 했다. 적극적 SVG 방식의 규칙을 다시 정리하면 아래와 같다.

### 적극적 SVG 규칙

1.  IE8 이하와 오페라 미니는 PHP 쪽에서 png를 뿌린다.
2.  나머지는 SVG를 뿌린다.
3.  SVG를 지원하지 않는 브라우저인데 SVG가 로드된 경우 js에서 처리한다.
4.  js가 꺼져있고, SVG를 지원하지 않는 브라우저는 포기한다.

## 인라인 SVG를 이용하는 경우 도움이 될 함수

앞서 말했듯이 내 블로그엔 처음에는 인라인 SVG를 사용했다. 문서에 긴 svg 태그를 그냥 때려 박으면 코딩할 때 상당히 어지럽다. 따라서 나는 php 함수를 만들어서 SVG를 읽어 들이게 했다.

<pre><code class="php">function get_inline_svg($filepath, $classname = NULL){

    // svg 파일을 읽어 들인다.
    $svg_string = file_get_contents(dirname(__FILE__) . $filepath);

    // 읽어들인 svg에서 삭제할 문자열. xml 선언, 문서형 선언, 주석이다.
    $empty_target = array(
        '&lt;?xml version="1.0" encoding="utf-8"?&gt;',
        '&lt;!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --&gt;',
        '&lt;!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"&gt;',
    );
    $svg_string = str_replace($empty_target, array('','',''), $svg_string);

    // 클래스명 인자가 넘어왔으면 넣어 준다.
    if($classname){
        $svg_string = str_replace('&lt;svg ', '&lt;svg class="' . $classname . '" ', $svg_string);
    }

    return $svg_string;
}
</code></pre>

이 함수를 이용해서 아래처럼 sns 아이콘들을 표현했었다. 트래픽이 감당이 안 되서 나중엔 inline SVG를 포기하게 되긴 했지만 말이다.

    <ul>
        <li><a ...><?php echo get_inline_svg('/images/icon-twitter.svg')?></a></li>
        <li><a ...><?php echo get_inline_svg('/images/icon-facebook.svg')?></a></li>
        <li><a ...><?php echo get_inline_svg('/images/icon-g+.svg')?></a></li>
        <li><a ...><?php echo get_inline_svg('/images/icon-print.svg')?></a></li>
    </ul>
    

이정도면 미지원 브라우저 대응에 대해서 내가 한 대응과 그 이유는 다 설명했다.

다음 글에서 설명할 것은 SVG에 CSS를 매기고, 이벤트를 걸고, 트랜지션 효과를 주는 것이다. 나도 많이 사용한 건 아니라 적당히만 다룰 것이다.

<div class="simple-footnotes">
  <p class="notes">
    Notes:
  </p>
  
  <ol>
    <li id="note-11338-1">
      safari라고 돼 있는 걸 webkit으로 변경하고, 클래스 방식이던 걸 그냥 함수로 변경했다. <a href="#return-note-11338-1">&#8617;</a>
    </li>
  </ol>
</div>

 [1]: http://mytory.local/archives/tag/%eb%a7%88%eb%b2%95-%eb%82%98%eb%ac%b4-%ed%85%8c%eb%a7%88
 [2]: http://mytory.local/archives/tag/svg-%ed%99%9c%ec%9a%a9
 [3]: http://modernizr.com/download/#-svg
 [4]: http://modernizr.com/download/#-inlinesvg-svg
 [5]: http://playgroundinc.com/blog/the-playground-vector-animation-process/
 [6]: http://raphaeljs.com/
 [7]: http://stackoverflow.com/a/11957976