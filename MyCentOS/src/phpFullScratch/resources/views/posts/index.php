<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include($values["layouts"]."meta.php"); ?>
</head>
<body>
    <?php include($values["layouts"]."header.php"); ?>

    <main>
        <div class= "container">
            <div class="my-4">
                <a class="btn btn-primary" href="/create" >
                    投稿を新規作成する
                </a>
            </div>
            <?php foreach($posts as $post):?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h2><?php echo $post["title"];?></h1>
                    </div>
                    <div class="card-body">
                        <p><?php echo $post["body"];?></p>

                        <a class="card-link" href=<?php echo "/show/".$post["id"];?>>
                            詳細をみる
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include($values["layouts"]."footer.php"); ?>



    
</body>
</html>