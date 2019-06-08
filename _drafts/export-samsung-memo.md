
db를 얻은 다음...

SELECT datetime(createdAt/1000,'unixepoch') as created, datetime(lastModifiedAt/1000,'unixepoch') as modified, title, content FROM memo ORDER BY created


csv 추출한 뒤 


~~~ php
$rows = [];
if (($handle = fopen('samsung-memo.csv', 'r')) !== false) {
    while (($row = fgetcsv($handle, 0, ',')) !== false) {
        $rows[] = $row;
    }
    fclose($handle);
}

$header = array_shift($rows);
foreach ($rows as $i => $row) {
    $rows[$i] = array_combine($header, $row);
}

foreach ($rows as $row) {
    $title = trim(preg_replace('/[^ 0-9A-Za-z가-힣-_]/u', '', mb_substr((explode("\n", $row['title'])[0] ?? ''), 0, 20)));
    $date = date('Y-m-d', strtotime($row['created']));
    if ($title) {
        $filename = "{$date} {$title}";
    } else {
        $filename = $date;
    }

    while (is_file("memos/{$filename}.txt")) {
        $filename = "{$filename}-";
    }

    $content = strip_tags(str_replace(["</p>", '&nbsp;'], ["</p>\n", ' '], $row['content']));

    file_put_contents("./memos/{$filename}.txt", $content);
}
~~~