<h1 class="h2 text-dark mt-4 mb-4"><?php echo $title; ?></h1>
<a href="new.php">読書ログを登録する</a>
<main>
    <?php if (count($reviews) > 0) : ?>
        <?php foreach ($reviews as $review) : ?>
            <section>
                <h2>
                    <?php echo escape($review['title']); ?>
                </h2>
                <div>著者：<?php echo escape($review['author']); ?>&nbsp;|&nbsp;
                    読書状況：<?php echo escape($review['status']); ?>&nbsp;|&nbsp;
                    評価：<?php echo escape($review['rating']); ?></div>
                <p><?php echo escape($review['comment']); ?></p>
            </section>
        <?php endforeach; ?>
    <?php else : ?>
        <p>本の登録がありません。</p>
    <?php endif; ?>

</main>

</body>

</html>
