<?php
include('sql.php');
$conn = mysqli_connect($servername, $username, $password, $database);
$conn->set_charset("utf8");

// زمان ۲ دقیقه قبل
$time_limit = time() - 120;

// گرفتن سرورها
$servers = [];
$res = mysqli_query($conn, "SELECT ip FROM maral_srv_list WHERE yz = 1");
while ($row = mysqli_fetch_assoc($res)) {
  $servers[] = $row['ip'];
}

// گرفتن لیست url ها
$urls = [];
$res = mysqli_query($conn, "SELECT url FROM urls WHERE yz = 1");
while ($row = mysqli_fetch_assoc($res)) {
  $urls[] = $row['url'];
}

// ------------------------------
// مرحله 1: گرفتن تمام رکوردهای 2 دقیقه اخیر فقط با یک کوئری
// ------------------------------

$recent = []; // ساختار: $recent[srv][url] = true;

$q = mysqli_query($conn, "
    SELECT srv, url 
    FROM urls_tracker 
    WHERE time > $time_limit
");

while ($row = mysqli_fetch_assoc($q)) {
  $recent[$row['srv']][$row['url']] = true;
}

// ------------------------------
// مرحله 2: پیدا کردن موارد missing در PHP
// ------------------------------

$inserted = [];
$now = time();

foreach ($servers as $srv) {
  foreach ($urls as $url) {

    // اگر در لیست recent نیست → یعنی رکورد ندارد
    if (!isset($recent[$srv][$url])) {

      // درج رکورد -1
      mysqli_query(
        $conn,
        "INSERT INTO urls_tracker (srv, url, status, time)
                 VALUES ('$srv', '$url', -1, $now)"
      );

      // ذخیره گزارش
      $inserted[] = [
        'srv' => $srv,
        'url' => $url,
        'time' => date("Y-m-d H:i:s", $now)
      ];
    }
  }
}

// ------------------------------
// مرحله 3: چاپ گزارش
// ------------------------------

echo "<pre>";
if (empty($inserted)) {
  echo "هیچ رکوردی درج نشد.\n";
} else {
  echo "رکوردهای درج شده:\n";
  print_r($inserted);
}
echo "</pre>";
