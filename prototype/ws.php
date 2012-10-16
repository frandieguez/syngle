<?php
/**
 * This file is part of the Onm package.
 *
 * (c)  Fran Dieguez <fran@openhost.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/
$words = file_get_contents(__DIR__.'/../data/words.gl.dat');
$words = explode(PHP_EOL, $words);
$totalWords = count($words);

$page   = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
$items  = array_key_exists('items', $_GET) ? $_GET['items'] : 10;
$search = array_key_exists('search', $_GET) ? $_GET['search'] : '';
$levenshteinSearch = array_key_exists('levenshtein', $_GET) ? true : false;
$wordsSubset = array();

$offset = ($page - 1) * $items;


if (!empty($search)) {
    if (!$levenshteinSearch) {
        $words = array_filter($words, function($item) {
            global $search;
            return levenshtein($item, $search) < 3;
        });
    } else {
        $words = array_filter($words, function($item) {
            global $search;
            preg_match("/$search/", $item, $matches);
            return count($matches) > 0;
        });
    }
}

$result = array_slice($words, $offset, $items);


$i = 0;
foreach ($result as $value) {
    $object = new stdClass();
    $value = iconv('ISO-8859-1', 'UTF-8', $value);
    $object->id = $offset+1+$i;
    $object->title = $value;
    $wordsSubset[] = $object;
    $i++;
}

$finalResult = array(
    'prev_page' => ($page-1 > 0) ? ($page-1) : null,
    'next_page' => ($totalWords > ($items * ($page -1)) )? ($page+1) : null,
    'words'     => $wordsSubset,
    'search'    => $search,
);

header('Content-type: application/json');
echo json_encode($finalResult);