<?php

// lyrics.php by Moonbase 2019-04-05 (for kPlaylist)
// lyric-api: https://github.com/rhnvrm/lyric-api
// mini.css: https://minicss.org/

$artist = $_GET['artist'];
$title = $_GET['title'];
$album = $_GET['album'];

if (empty($artist) or empty($title)) {
  exit(1);
}

$url = 'http://lyric-api.herokuapp.com/api/find/' . rawurlencode($artist) . '/' . rawurlencode($title);

echo <<<EOT
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Lyrics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
EOT;

$err = '';
try {
  $data = file_get_contents($url);
  if ($data === false) {
    $err = 'Leider nicht verfügbar';
  }
} catch (Exception $e) {
    $err = 'Fehler: ' . $e;
}

// print_r(json_decode($data));
// echo "<br><br>";

echo "<h3>" . $artist . " – " . $title . "</h3>\n";

if ($album) {
  echo "<h4>vom Album " . $album . "</h4>\n";
}

if ($err == '') {
  $characters = json_decode($data);
  if ($characters->err == "none") {
    echo "<pre>";
    echo $characters->lyric;
    echo "</pre>\n";
  } else if ($characters->err == "not found") {
    echo "<p><strong>Für diesen Titel sind noch keine Lyrics vorhanden.</strong></p>\n";
  } else {
    echo "<p><strong>Fehler: " . $characters->err . "</strong></p>\n";
  }
} else {
  echo "<p><strong>" . $err . "</strong></p>\n";
}

echo <<<EOT
    <button type="button" onclick="window.open('', '_self', ''); window.close();">Schließen</button>
    <p><small>Software © 2019 Moonbase — Experimental Lyrics for kPlaylist</small></p>
  </body>
</html>
EOT;

?>