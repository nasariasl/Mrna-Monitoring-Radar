<?php
// اتصال به دیتابیس
include('sql.php');
$conn = mysqli_connect($servername, $username, $password, $database);
$conn->set_charset("utf8");

// زمان ۲ دقیقه قبل
$time_limit = time() - 120;

// گرفتن لیست سرورها
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

// آماده کردن statement برای چک
$checkStmt = mysqli_prepare(
  $conn,
  "SELECT COUNT(*) FROM urls_tracker WHERE srv = ? AND url = ? AND time > ?"
);

// آماده کردن statement برای insert
$insertStmt = mysqli_prepare(
  $conn,
  "INSERT INTO urls_tracker (srv, url, status, time) VALUES (?, ?, -1, ?)"
);

// Loop روی هر سرور و هر URL
foreach ($servers as $srv) {
  foreach ($urls as $url) {

    // bind برای چک
    mysqli_stmt_bind_param($checkStmt, "ssi", $srv, $url, $time_limit);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_bind_result($checkStmt, $count);
    mysqli_stmt_fetch($checkStmt);
    mysqli_stmt_free_result($checkStmt);

    // اگر هیچ رکوردی نبود → insert
    if ($count == 0) {
      $now = time();
      mysqli_stmt_bind_param($insertStmt, "ssi", $srv, $url, $now);
      mysqli_stmt_execute($insertStmt);
    }
  }
}

echo "OK - Missing records inserted.";
