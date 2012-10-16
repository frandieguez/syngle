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

$page   = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
$items  = array_key_exists('items', $_GET) ? $_GET['items'] : 10;
$search = array_key_exists('search', $_GET) ? $_GET['search'] : '';
$wordsSubset = array();

$offset = ($page - 1) * $items;

if (!empty($search)) {
    $words = array_filter($words, function($item) {
        global $search;
        return levenshtein($item, $search) < 3;
    });
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
    'next_page' => $page+1,
    'prev_page' => $page-1,
    'words'     => $wordsSubset,
    'search'    => $search,
);

header('Content-type: application/json');
echo json_encode($finalResult);