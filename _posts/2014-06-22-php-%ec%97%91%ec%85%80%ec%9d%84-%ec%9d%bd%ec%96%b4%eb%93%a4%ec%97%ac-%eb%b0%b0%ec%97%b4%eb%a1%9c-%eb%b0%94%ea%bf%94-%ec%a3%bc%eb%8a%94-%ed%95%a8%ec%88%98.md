---
title: '[PHP] 엑셀을 읽어들여 배열로 바꿔 주는 함수'
author: 안형우
layout: post
permalink: /archives/13076
mytory_md_path:
  - https://dl.dropboxusercontent.com/u/15546257/mytory-md-content/13076-excel-to-array.md
categories:
  - 서버단
tags:
  - PHP
  - PHPExcel
---
이 함수는 기본적으로 [PHPExcel 라이브러리][1]를 사용한다.

시트를 돌면서 배열로 만들어 리턴한다. 시트가 하나인 경우도 그렇게 하니 배열 안의 배열로 들어가게 될 거다.

`init_php_excel()`에 들어있는 PHPExcel의 경로는 변경을 해 줘야 한다. 에러 관련 코드도 알아서 적절히 변경하라.

    /**
     * phpexcel lib init
     */
    function init_php_excel() {
        error_reporting( E_ALL );
        ini_set( 'display_errors', true );
        ini_set( 'display_startup_errors', true );
        if( ! defined('EOL')){
            define( 'EOL', ( PHP_SAPI == 'cli' ) ? PHP_EOL : '<br />' );
        }
        date_default_timezone_set( 'Asia/Seoul' );
        require_once dirname( __FILE__ ) . '/php-lib/PHPExcel/Classes/PHPExcel.php';
    }
    
    
    /**
     * 엑셀을 읽어들여 배열을 만든 뒤 리턴.
     * 엑셀의 지정된 줄을 key값으로 한 배열들을 묶어서 배열로 만들어 준다.
     * @param $input_file_name 경로를 포함한 엑셀 파일
     * @param int $key_row_index 몇 번째 행을 제목행으로 사용할 것인지
     * @return array
     */
    function get_arr_from_xls ($input_file_name, $key_row_index = 1) {
        global $objPHPExcel;
    
        if ( ! isset($objPHPExcel)) {
            init_php_excel();
        }
    
        $objPHPExcel = PHPExcel_IOFactory::load($input_file_name);
    
        $iterator = $objPHPExcel->getWorksheetIterator();
    
        $sheets = array();
        while($iterator->valid()){
            $objWorksheet = $iterator->current();
            $sheet_title = $objWorksheet->getTitle();
    
            $sheet = array ();
            foreach ($objWorksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE);
    
                $row_index = $row->getRowIndex();
    
                // 배열의 key로 사용할 제목행 앞의 행은 무시한다.
                if ($row_index < $key_row_index) {
                    continue;
                }
    
                // $key_row_index에 설정된 줄의 값을 불러와서 배열의 key로 사용한다.
                if ($row_index == $key_row_index) {
                    $column_title_arr = array ();
                    foreach ($cellIterator as $cell) {
                        $column_index = $cell->getColumn();
                        $column_title_arr[$column_index] = str_replace("\n", '', trim($cell->getCalculatedValue()));
                    }
                    continue;
                }
    
                foreach ($cellIterator as $cell) {
                    $column_index = $cell->getColumn();
                    $column_title = $column_title_arr[$column_index];
                    if ($column_title == '') {
                        continue;
                    }
    
                    $sheet[$row_index][$column_title] = $cell->getCalculatedValue();
                }
            }
            $sheets[$sheet_title] = $sheet;
    
            $iterator->next();
        }
    
        // 엑셀 하단에 빈 행들이 들어가는 경우가 있다. 그거 해제.
        foreach ($sheets as $sheet_title => $sheet) {
            foreach ($sheet as $key => $data) {
                $empty_arr = TRUE;
                foreach ($data as $value) {
                    if (!empty($value)) {
                        $empty_arr = FALSE;
                    }
                }
                if ($empty_arr) {
                    unset($sheets[$sheet_title][$key]);
                }
            }
        }
        return $sheets;
    }

 [1]: https://phpexcel.codeplex.com/