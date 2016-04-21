---
title: '[PHP] 파일과 텍스트 다운로드 함수'
layout: post
tags:
  - PHP
---

맨날 만들어 쓰기 귀찮아서 제일 시간 많이 들여 만든 걸 갖다 놓는다.

<pre>
/**
 * Download file from path and mimetype.
 *
 * @param      $path
 * @param      $mimetype
 * @param null $filename
 */
function download_file ($path, $mimetype, $filename = NULL) {
    if (empty($filename)) {
        $filename = pathinfo($path, PATHINFO_BASENAME);
    }

    if (!strstr($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
        $filename = rawurlencode($filename);
    }

    header('cache-control: no-cache');
    header("Content-Type: $mimetype");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Length: " . filesize($path));
    readfile($path);
}

/**
 * Download text file from string.
 *
 * @param $filename
 * @param $string
 */
function download_txt($filename, $string){
    header('cache-control: no-cache');
    header('Content-Type: text/plain');
    header("Content-Disposition: attachment; filename={$filename}");
    header("Content-Length: " . strlen($string));
    echo $string;
}
</pre>

[gist 링크](https://gist.github.com/mytory/92369219da87edf851e195775fe64264#file-download-functions-php)