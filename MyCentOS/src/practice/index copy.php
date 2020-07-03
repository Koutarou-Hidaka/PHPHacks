<?php

class Post {
    private $DB_HOST="192.168.33.10";
    private $DB_NAME="php_hacks";
    private $DB_USER="root";
    private $DB_PASSWORD="phpHacks2020@";

    protected function db_access(){
        // PHPがエラーを表示するように設定
        // E_NOTICE 以外の全てのエラーを表示する
        error_reporting(E_ALL & ~E_NOTICE);

        // データベースへの接続
        try {
            $dbh = new PDO('mysql:host='.$this->DB_HOST.';dbname='.$this->DB_NAME, $this->DB_USER, $this->DB_PASSWORD);
            return $dbh;
        } catch (PDOException $e) {
            echo "エラー!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function index(){
        $dbh = $this->db_access();
        // var_dump($dbh);die;
        $sql = 'SELECT * FROM posts';
        $stmt  = $dbh->prepare($sql);
        // var_dump($stmt);die;
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);die;
        return $result;
    }
}

$postmodel  = new Post();
$result = $postmodel->index();
$posts = $result; 

// var_dump($posts[0]["title"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach($posts as $post):?>
    <div>
        <h1><?php echo $post["title"];?></h1>
    </div>
    <div>
        <p><?php echo $post["body"];?></p>
    </div>
<?php endforeach; ?>
</body>
</html>