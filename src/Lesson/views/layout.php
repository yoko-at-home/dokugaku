<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="stylesheets/css/app.css">
</head>

<body>
    <div class="container">
        <header class="container-lg shadow-sm p-3">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand text-dark " href="index.php">
                    <h1>読書ログ</h1>
                </a>
            </nav>
        </header>
        <div class="container-lg">
            <div class="navbar">&nbsp;</div>
            <div class="ml-5">
                <?php include $content; ?>
            </div>
        </div>
        <footer>&nbsp;</footer>
    </div>
</body>

</html>
