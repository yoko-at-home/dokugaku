<h1 class="h2 text-dark mt-4 mb-4"><?php echo $title; ?></h1>
<a href="new.php">会社情報を登録する</a>
<main>
    <?php if (count($companies) > 0) : ?>
        <?php foreach ($companies as $company) : ?>
            <section>
                <h2>
                    <?php echo $company['name']; ?>
                </h2>
                <div>創業：<?php echo $company['establishment_date']; ?>年&nbsp;|&nbsp;
                    代表：<?php echo $company['founder']; ?></div>
            </section>
        <?php endforeach; ?>
    <?php else : ?>
        <p>会社情報が登録されていません。</p>
    <?php endif; ?>

</main>

</body>

</html>
