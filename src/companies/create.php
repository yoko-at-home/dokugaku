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
function validate($company)
{
    $errors = [];
    if (!strlen($company['name'])) {
        $errors['name'] = '会社名を入力してください';
    } elseif (strlen($company['name']) > 255) {
        $errors['name'] = '会社名は255文字以内で入力してください';
    }
    // var_dump($company['establishment_date']);
    $dates = explode('-', $company['establishment_date']);
    if (!strlen($company['establishment_date'])) {
        $errors['establishment_date'] = '設立日を入力してください';
    } elseif (count($dates) !== 3) {
        $errors['establishment_date'] = '設立日を正しい形式で入力してください';
    } elseif (!checkdate($dates[1], $dates[2], $dates[0])) {
        $errors['establishment_date'] = '設立日を正しい日付で入力してください';
    }
    if (!strlen($company['founder'])) {
        $errors['founder'] = '代表名を入力してください';
    } elseif (strlen($company['founder']) > 100) {
        $errors['founder'] = '代表名は100文字以内で入力してください';
    }
    return $errors;
}
//HTTPメソッドがPOSTだったら
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = [
        'name' => $_POST['name'],
        'establishment_date' => $_POST['establishment_date'],
        'founder' => $_POST['founder']
    ];

    $errors = validate($company);
    if (!count($errors)) {
        $link = dbConnect();
        createCompany($link, $company);
        mysqli_close($link);
        header("Location:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会社情報の登録</title>
</head>

<body>
    <h1>会社情報の登録</h1>
    <form action="create.php" method="POST">
        <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div>
            <label for="name">会社名</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="establishment_date">設立日</label>
            <input type="date" name="establishment_date" id="establishment_date">
        </div>
        <div>
            <label for="founder">代表者</label>
            <input type="text" name="founder" id="founder">
        </div>
        <button type="submit">登録する</button>
        </div>
    </form>
</body>

</html>
