---
title: "PHP short open tag를 long open tag로 변환해 주는 스크립트"
layout: post
tags:
  - PHP
description: 아래 코드를 긁어서 convert_short_open_tag.php 파일로 만든 뒤 php convert_short_open_tag.php filepath.php 형식으로 사용하면 된다.
image: /uploads/2018/short-open-tag.png
---

PHP 코드를 작성할 때 모든 서버에서 잘 돌아갈 수 있도록 `<?`가 아니라 `<?php`로 여튼 태그를 쓰는 편이 좋다. (참고: [PHP 짧은 태그(&lt;? ?>)가 좋을까 긴 태그(&lt;?php ?>)가 좋을까?][1])

레거시 코드가 모든 여는 태그를 짧은 태그(`<?`)로 작성했다면 변경이 골치아프다. 찾기 바꾸기로 바꾸는 것은 만만찮고, 오류가 발생할 확률도 크다. 그러나 PHP 언어 자체의 파싱 기능을 이용한다면 100% 신뢰성을 확보하면서 코드를 수정할 수 있다. 아래 스크립트가 바로 그런 스크립트다.

1. 코드를 복사해서 `short-open-tag-converter.php`로 저장한다. 
2. `php.ini`에서 `short_open_tag`를 `On`으로 수정한다. (그렇게 하지 않으면 PHP가 short open tag를 인식하지 못하므로 수정할 수도 없다.)
3. 아래처럼 사용한다. 그러면 해당 파일의 `<?`를 모두 `<?php`로 수정한다.

~~~ bash
php short-open-tag-converter.php target_file_path.php
~~~

해당 파일을 바로 수정하기 때문에 주의해서 사용하라.

위 스크립트는 기본적으로 `<?=`를 `<?php echo `로 변경하지는 않는다. 만약 해당 기능이 필요하다면 해당 부분(45~50번 줄)의 주석을 풀고 사용하면 된다. 

~~~ php
<?php
// This script convert short open tag to long open tag.
// Inspired from https://stackoverflow.com/a/3621669
//
// Source: https://gist.github.com/mytory/5380b6a970ed4c14e16dd1be498e0919
// Usage: php short-open-tag-converter.php target_file_path.php
// Notice: This script change original file.
//
// If you want to change '<?=' to '<?php echo ' uncomment line 45~50.

if (ini_get('short_open_tag') !== '1') {
    fwrite(STDERR, 'ERROR! Change short_open_tag to On in ' . php_ini_loaded_file() . PHP_EOL);
    exit(1);
}

if ($argc === 1) {
    fwrite(STDERR, "ERROR! A file path must be entered." . PHP_EOL);
    fwrite(STDERR, "ex) php {$argv[0]} file_path.php" . PHP_EOL);
    exit(1);
}

$filepath = realpath($argv[1]);

$contents = file_get_contents($filepath) or die;
$tokens = token_get_all($contents);
$tokens[] = array(0x7E0F7E0F,"",-1);

$fixed_contents = '';

foreach ($tokens as $index => $token) {
    if (is_array($token)) {
        list($toktype, $source_code) = $token;
        
        if ($toktype == T_OPEN_TAG) {
            if (($source_code == "<?") && ($tokens[$index+1][0] != T_STRING)) {
                $source_code = "<?php";
                if ($tokens[$index+1][0] != T_WHITESPACE) {
                    $source_code .= " ";
                }
            }
        }

        // <?= to <?php echo
        
        // if ($toktype == T_OPEN_TAG_WITH_ECHO) {
        //     $source_code = "<?php echo";
        //     if ($tokens[$index+1][0] != T_WHITESPACE) {
        //         $source_code .= " ";
        //     }
        // }

        $fixed_contents .= $source_code;
    } else {
        $fixed_contents .= $token;
    }
}

file_put_contents($filepath, $fixed_contents);
~~~

[gist에서 보기][2]

## bash 응용

bash에서는 아래처럼 사용하면 현재 폴더의 서브 폴더에 있는 모든 php 파일을 바꿀 수 있다.

~~~ bash
for f in $(find . -name \*.php); do php short-open-tag-converter.php "$f"; done
~~~

[1]: https://mytory.net/2017/04/12/is-it-better-to-use-the-short-open-tag-in-php.html
[2]: https://gist.github.com/mytory/5380b6a970ed4c14e16dd1be498e0919