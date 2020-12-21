<?php

function filterData($input) {

    global $con;
    $con_f = $con;

    $search = array(
        '@<script[^>]*?>.*?</script>@si',
        '@<[\/\!]*?[^<>]*?>@si',
        '@<style[^>]*?>.*?</style>@siU',
        '@<![\s\S]*?--[ \t\n\r]*>@'
    );

    $wipe = array(

        "+union+",
        "%20union%20",
        "/union/*",
        ' union ',
        "union",
        "sql",
        "mysql",
        "database",
        "cookie",
        "coockie",
        "select",
        "from",
        "where",
        "benchmark",
        "concat",
        "table",
        "into",
        "by",
        "values",
        "exec",
        "shell",
        "truncate",
        "wget",
        "/**/"

    );

    $output = preg_replace($search, '', $input);
    $output = str_replace($wipe,'',$output);

    return mysqli_real_escape_string($con_f,trim($output));

}
