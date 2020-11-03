                <h1 class="h2 text-dark">読書ログの登録</h1>
                <form action="create.php" method="POST">
                    <!-- ここにエラー処理 begins-->
                    <?php if (count($errors)) : ?>
                        <ul class="alert alert-warning ml-4 error_message" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <li class="error_message"><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <!-- ここにエラー処理 ends-->
                    <div class="form-group">
                        <label for="title">書籍名</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo $review['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="author">著者名</label>
                        <input type="text" name="author" id="author" class="form-control" value="<?php echo $review['author'] ?>">
                    </div>
                    <div class="form-group">
                        <label>読書状況</label>
                        <div class="status__wrapper">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status1" value="未読" <?php echo ($review['status'] === '未読' ? 'checked' : '') ?>>
                                <label class="label__status" for="status1">未読</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status2" value="読んでる" <?php echo ($review['status'] === '読んでる' ? 'checked' : '') ?>>
                                <label class="label__status" for="status2">読んでる</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status3" value="読了" <?php echo ($review['status'] === '読了' ? 'checked' : '') ?>>
                                <label class="label__status" for="status3">読了</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rating">評価（5点満点の整数）</label>
                        <input type="number" name="rating" id="rating" class="form-control" value="<?php echo $review['rating'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="comment">感想</label>
                        <textarea type="text" name="comment" id="comment" rows="10" class="form-control" value="<?php echo $review['comment'] ?>"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">登録する</button>
                </form>
