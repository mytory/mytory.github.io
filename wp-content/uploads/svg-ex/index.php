<?
include '../../../wp-blog-header.php';
function make_inline($svg){
    $svg = preg_replace('/<style(.*)>((\n|.)*)<\/style>/', '', $svg);
    $svg = preg_replace('/<script(.*)>((\n|.)*)<\/script>/', '', $svg);
    return $svg;
}
$svg_has_viewbox = file_get_contents('has-viewbox.svg');
$svg_has_not_viewbox = str_replace('viewBox="0 0 84 84"', '', $svg_has_viewbox);
?><!doctype html>
<html lang="<?=get_bloginfo('language')?>">
<head>
    <meta charset="UTF-8">
    <title>SVG file and include tag example</title>
    <style>
        h2 {
            margin-top: 2em;
            margin-bottom: 0.5em;
            border-top: 3px solid #999;
            border-bottom: 3px solid #999;
            padding: 0.5em;
            background-color: #eee;
        }
        h2:first-child{
            margin-top: 0;
        }
        svg, img, object, iframe, embed {
            width: 100px;
            border: 1px solid red;
        }
        .height-specified svg,
        .height-specified img,
        .height-specified object,
        .height-specified embed,
        .height-specified iframe
        {
            height: 100px;
        }

        .height-auto svg,
        .height-auto img,
        .height-auto object,
        .height-auto embed,
        .height-auto iframe
        {
            height: auto;
        }
        .ex {
            display: inline-block;
            width: 110px;
        }

        /* for inline svg */
        .circle-obj {
            stroke: #34495E;
            transition: fill 1s;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?if(get_bloginfo('language') != 'ko-KR'){?>
<h1>SVG scale and include tag test</h1>
<h2>Description</h2>
<p>CSS in svg change circle border color from black to wet-asphalt color. Script in svg change circle's fill from gold color to emerald color. After run script, <code>onmouseover</code> on circle, color will change. Color will fade on color change using CSS3 <code>transition</code> property.</p>
<p>If <code>img</code> tag svg's fill is not changed, we can learn <code>img</code> tag don't run script.</p>
<p>And I specified something's height, not specified others. You may learn what happens when <code>height</code> is <code>auto</code>.</p>
<p>svg need viewBox attribute. You can learn what happens if you skip viewBox.</p>
<p>In all cases, css is applied. And except <code>img</code> tag, script is applied.</p>
<p>All SVG image is wrapped by <code>a</code> tag. But <code>a</code> tag only work on inline SVG and <code>img</code> tag.</p>
<p>So, watch below!</p>
<?}else{?>
<h1>SVG 확대/축소와 삽입 태그 테스트</h1>
<h2>설명</h2>
<p>SVG 파일 안에 포함된 CSS는 원의 외곽선 컬러를 검정색에서 젖은 아스팔트색으로 바꾼다. SVG 안에 있는 스크립트는 원의 색깔을 금색에서 에메랄드 색으로 바꾼다. 스크립트가 작동한 이후에도 마우스를 원 위에 올리면 색이 변한다. CSS3 <code>transition</code> 속성으로 색이 변할 때는 1초 동안 은은하게 변하도록 했다.</p>
<p><code>img</code> 태그로 포함한 svg 원의 색은 변하지 않는다. 따라서 우리는 <code>img</code> 태그에 포함된 SVG에서 스크립트가 작동하지 않는다는 것을 알 수 있다.</p>
<p>아래 예제에는 높이를 지정한 것과 지정하지 않은 것이 있다. <code>height</code>를 <code>auto</code>로 했을 때, 무슨 일이 벌어지는 지 알 수 있을 것이다.</p>
<p>SVG에는 <code>viewBox</code>속성이 필요하다. <code>viewBox</code> 속성을 생략하면 어떤 일이 벌어지는 지 보자.</p>
<p>모든 경우에 CSS는 적용되고, <code>img</code> 태그를 제외하고는 script도 적용된다.</p>
<p>모든 SVG 이미지는 <code>a</code> 태그로 둘러싸여 있다. 하지만 <code>a</code> 태그는 오직 인라인 SVG와 <code>img</code> 태그에서만 작동한다.</p>
<p>이제 아래 예제를 보자.</p>
<?}?>
<h2>Code</h2>
<pre>
<?php 
echo htmlspecialchars($svg_has_viewbox);
?>
</pre>
<div class="height-specified">
    <h2>width 100px, height 100px, with viewBox</h2>
    <div class="ex">
        <h3>inline</h3>
        <a href="#" onclick="alert('click!'); return false;"><?=make_inline($svg_has_viewbox)?></a>
    </div>
    
    <div class="ex">
        <h3>img</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><img src="has-viewbox.svg" alt=""></a></p>
    </div>
    <div class="ex">
        <h3>object</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><object data="has-viewbox.svg" type="image/svg+xml"></object></a></p>
    </div>
    <div class="ex">
        <h3>iframe</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><iframe src="has-viewbox.svg"></iframe></a></p>
    </div>
    <div class="ex">
        <h3>embed</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><embed src="has-viewbox.svg" type="image/svg+xml"></a></p>
    </div>
</div>

<div class="height-specified">
    <h2>width 100px, height 100px, without viewBox</h2>
    <div class="ex">
        <h3>inline</h3>
        <a href="#" onclick="alert('click!'); return false;"><?=make_inline($svg_has_not_viewbox)?></a>
    </div>
    <div class="ex">
        <h3>img</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><img src="has-not-viewbox-svg.php" alt=""></a></p>
    </div>
    <div class="ex">
        <h3>object</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><object data="has-not-viewbox-svg.php" type="image/svg+xml"></object></a></p>
    </div>
    <div class="ex">
        <h3>iframe</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><iframe src="has-not-viewbox-svg.php"></iframe></a></p>
    </div>
    <div class="ex">
        <h3>embed</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><embed src="has-not-viewbox-svg.php" type="image/svg+xml"></a></p>
    </div>
</div>


<div class="height-auto">
    <h2>width 100px, height auto, with viewBox</h2>
    <div class="ex">
        <h3>inline</h3>
        <a href="#" onclick="alert('click!'); return false;"><?=make_inline($svg_has_viewbox)?></a>
    </div>
    
    <div class="ex">
        <h3>img</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><img class="not-specified" src="has-viewbox.svg" alt=""></a></p>
    </div>
    <div class="ex">
        <h3>object</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><object class="not-specified" data="has-viewbox.svg" type="image/svg+xml"></object></a></p>
    </div>
    <div class="ex">
        <h3>iframe</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><iframe class="not-specified" src="has-viewbox.svg"></iframe></a></p>
    </div>
    <div class="ex">
        <h3>embed</h3>
        <p><a href="#" onclick="alert('click!'); return false;"><embed class="not-specified" src="has-viewbox.svg" type="image/svg+xml"></a></p>
    </div>
</div>

<div class="height-auto">
    <h2>width 100px, height auto, without viewBox</h2>
    <div class="ex">
        <h3>inline</h3>
        <?=make_inline($svg_has_not_viewbox)?>
    </div>
    <div class="ex">
        <h3>img</h3>
        <p><img class="not-specified" src="has-not-viewbox-svg.php" alt=""></p>
    </div>
    <div class="ex">
        <h3>object</h3>
        <p><object class="not-specified" data="has-not-viewbox-svg.php" type="image/svg+xml"></object></p>
    </div>
    <div class="ex">
        <h3>iframe</h3>
        <p><iframe class="not-specified" src="has-not-viewbox-svg.php"></iframe></p>
    </div>
    <div class="ex">
        <h3>embed</h3>
        <p><embed class="not-specified" src="has-not-viewbox-svg.php" type="image/svg+xml"></p>
    </div>
</div>

<script type="text/javascript">
    function change_fill(){
        var circle_objs = document.getElementsByClassName('circle-obj');
        for (var i = circle_objs.length - 1; i >= 0; i--) {
            var current_fill = circle_objs[i].getAttribute('fill');
            if(current_fill == 'gold'){
                circle_objs[i].setAttribute('fill', '#2ECC71');
            }else{
                circle_objs[i].setAttribute('fill', 'gold');
            }
        };
    }
    change_fill();
</script>
<?if( ! is_super_admin()){?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10285539-1']);
  _gaq.push(['_setDomainName', '<?=str_replace("http://", "", home_url())?>']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?}?>
</body>
</html>
