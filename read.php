<?php
header('Content-Type: text/html; charset=utf-8');

$conn = mysqli_connect("localhost","cip13a", "", "cip13adb");

// EUC-KR을 UTF-8로 변환하는 함수
function convert($str) { return iconv("EUC-KR", "UTF-8", $str); }
function han($s){ return reset(json_decode('{"s":"'.$s.'"}')); }
function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

function my_json_encode($arr) {
    //convmap since 0x80 char codes so it takes all multibyte codes (above ASCII 127). So such characters are being "hidden" from normal json_encoding
    array_walk_recursive($arr, function (&$item, $key) { 
        if (is_string($item)) {
            $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); 
        }
    });

    return mb_decode_numericentity(json_encode($arr), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
}

$id=$_GET['id'];

if (!$id) { // all array
    $records = mysqli_query($conn,"select * from 00member");

    $data = array();
    
    while($row = mysqli_fetch_assoc($records)) {
        $data[] = array_map("convert", $row); 
        //$data[] = $row; 
    }
    
    //$encode = json_encode($data)
    //printf (to_han($encode));
    echo my_json_encode($data);

} else { // selection array
    $records = mysqli_query($conn,"select * from 00member where id='$id'");

    $data = array();
    
    while($row = mysqli_fetch_assoc($records)) {
        $data[] = array_map("convert", $row); 
        //$data[] = $row;
    }
    
    //$encode = json_encode($data)
    //printf (to_han($encode));
    echo my_json_encode($data);
}

mysqli_close($conn);

?>