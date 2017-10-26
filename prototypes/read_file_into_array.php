<?php
/**
 * Created by PhpStorm.
 * User: ndavis
*/

function input_file_to_csv($file_path, $arr_fields)
{
    /*
     *Take vertically formatted data and pivot it into usable horizontal row oriented data
     * If data is already in standard csv format, skip this function!
     */
    //slurp file into array and get rid of extraneous white space
    $arr_list = file($file_path, 7);
    $csv = format_csv_row($arr_fields);
    $field_count = count($arr_fields);
    foreach ($arr_list as $idx => $line) {
        $test = $idx + 1;
        if ($test % $field_count == 0) {
            $arr_row = [];
            $fid = $field_count - 1;
            for($x = $fid;$x>=0;$x--)
            {
                $arr_row[]=str_replace('"', '""', $arr_list[$idx - $x]);
            }
            $csv.= format_csv_row($arr_row);
        }
    }
    return $csv;
}

/**
 * @param $arr_row
 * @return string
 */
function format_csv_row($arr_row)
{
    $row = "";
    foreach($arr_row as $field)
    {
        $row .= "\"$field\",";
    }
    return trim($row,",")."\n";
}

/**
 * @param $csv
 * @return array
 */
function csv_to_assoc_array($csv){
    $rows = array_map('str_getcsv', explode("\n",trim($csv)));
    $header = array_shift($rows);
    $arr_csv = array();
    foreach ($rows as $row) {
        $arr_csv[] = array_combine($header, $row);
    }
    return $arr_csv;
}

$csv_data = input_file_to_csv('jewel description.txt', ["sku","name","description","price"]);
$arr_data = csv_to_assoc_array($csv_data);
echo "<pre>".print_r($arr_data,true)."</pre>";