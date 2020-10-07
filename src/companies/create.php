<?php
require_once __DIR__ . '/lib/mysqli.php';

function createCompany($link, $company)
{
    $sql = <<<EOT
INSERT INTO companies (
name,
  establishment_date,
  founder
  ) VALUES (
      "{$company['name']}",
      "{$company['establishment_date']}",
      "{$company['founder']}"
  )
EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to create company');
        error_log('Debugging Error:' . mysqli_error($link));
    }
}
//HTTPメソッドがPOSTだったら
// var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = [
        'name' => $_POST['name'],
        'establishment_date' => $_POST['establishment_date'],
        'founder' => $_POST['founder']
    ];
    $link = dbConnect();
    //データベースにデータを登録する
    createCompany($link, $company);
    //データベースとの処理を切断する
    mysqli_close($link);
    // var_export(100);
}
header("Location:index.php");
