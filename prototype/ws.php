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
$search = array_key_exists('search', $_GET) ? $_GET['search'] : 1;

$offset = ($page - 1) * $items;
$result = array_slice($words, $offset, $items);

$i = 0;
foreach ($result as $value) {
    $object = new stdClass();
    $value = iconv('ISO-8859-1', 'UTF-8', $value);
    $object->id = $offset+1+$i;
    $object->title = $value;
    $finalResult[] = $object;
    $i++;
}

header('Content-type: application/json');
echo json_encode($finalResult);