<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include($values["layouts"]."meta.php"); ?>
</head>
<body>
    <?php include($values["layouts"]."header.php"); ?>

    <main>
        <div class= "container">
            <div class="my-4 text-right">
                <a class="btn btn-primary" href=<?php echo "/edit/".$posts["id"] ?>>
                    編集する
                </a>
                <a class="btn btn-danger" href=<?php echo "/destroy/".$posts["id"] ?> >
                    削除する
                </a>
            </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h2><?php echo $posts["title"];?></h1>
                    </div>
                    <div class="card-body">
                        <p><?php echo $posts["body"];?></p>
                    </div>
                </div>
        </div>
    </main>
    <?php include($values["layouts"]."footer.php"); ?>



    
</body>
</html>