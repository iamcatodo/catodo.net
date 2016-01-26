<?php
die();
$day = time();

$start = strtotime("19-10-2015");
$end   = strtotime("28-10-2015");

// API service available only during the event
if ($day < $start || $day > $end) {
  http_response_code(404);
  exit();
}

// if the data is empty
if (!isset($_POST['data'])) {
  http_response_code(422);
  exit();
}

$farchive = "list.php";
$data = $_POST['data'];

// extract image from data in base64
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

if (!file_exists($farchive)) {
  $archive = array();
} else {
  $archive = require $farchive;
}

do {
  $id = uniqid();
} while (isset($archive[$id]));

file_put_contents(__DIR__ . "/images/$id.jpg", $data);

$size = getimagesize(__DIR__ . "/images/$id.jpg");
if (false === $size) {
  http_response_code(422);
  exit();
}
var_dump($size);

// store the image into the "database"
$archive[] = [
    'id'       => $id,
    'time'     => time(),
    'filesize' => strlen($data)
];

file_put_contents("list.php", '<?php return ' . var_export($archive, true) . ';');
echo json_encode([ 'id' => $id ]);
