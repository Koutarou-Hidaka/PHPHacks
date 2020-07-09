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

    protected function validation($data_title, $data_body){
        $error = array(); #$errorに空の配列を入れている
        
        if (empty($data_title) || ctype_space($data_title)){//ctype_space・・・空白やタブなどの空文字
            $error[] = "タイトルを入力してください。";
        }
        if (empty($data_body) || ctype_space($data_body)){//ctype_space・・・空白やタブなどの空文字
            $error[] = "本文を入力してください。";
        }
        if (strlen($data_body) > 140){  //strlen・・・文字列の長さを数える
            $error[] = "本文は140字以内で入力してください。";
        }

        return $error;
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

    public function store(){
        $post = array(
            "title" => $_POST['title'],
            "body" => $_POST['body'],
        );

        $error = $this->validation($post['title'], $post['body']);

        if (count($error)){
            //createにエラーログを飛ばす
        }else{

            $dbh = $this->db_access();

            try{
                $dbh->beginTransaction();//以下の処理を一連の処理とまとめて、この間($dbh-comit()が完了するまで)にエラーが起きたらエラーを吐く
                $sql = 'INSERT INTO posts(title, body) VALUES(:title, :body)';//:(title, :body)プレースフォルダ・・・実際の内容を後から挿入するために、とりあえず仮に確保した場所

                $stmt  = $dbh->prepare($sql);
                 //値の置き換え bindValue ($パラメータID, $バインドする値 [, $PDOデータ型定数] )
                $stmt->bindValue(':title', $post['title'], PDO::PARAM_STR);
                $stmt->bindValue(':body', $post['body'], PDO::PARAM_STR);
                $stmt->execute();

                $dbh->commit();
            } catch(PDOException $Exception) {//引数・・・なんのエラーをキャッチするのか
                $stmt->rollback();
            }
        }
        
        $result = array($post, $error);

        return $result;
    }

    public function show($article_id){
        $dbh = $this->db_access();
      
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt  = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function edit($article_id){
        $dbh = $this->db_access();
      
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt  = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($article_id){
        $post = array(
            "title" => $_POST['title'],
            "body" => $_POST['body'],
            "id"  => $article_id,   
        );

        $error = $this->validation($post['title'], $post['body']);

        if (count($error)){
            //
        }else{

            $dbh = $this->db_access();
            // echo __LINE__."<br>";
            // var_dump($article_id);die;
            try{
                $dbh->beginTransaction();//以下の処理を一連の処理とまとめて、この間($dbh-comit()が完了するまで)にエラーが起きたらエラーを吐く
                
                $sql = 'UPDATE posts SET title= :title, body = :body WHERE id= :id';//:(title, :body)プレースフォルダ・・・実際の内容を後から挿入するために、とりあえず仮に確保した場所

                $stmt  = $dbh->prepare($sql);
                $stmt->bindValue(':title', $post['title'], PDO::PARAM_STR);
                $stmt->bindValue(':body', $post['body'], PDO::PARAM_STR);
                $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);
                $stmt->execute();

                $dbh->commit();
            } catch(PDOException $Exception) {//引数・・・なんのエラーをキャッチするのか
                $stmt->rollback();
            }
        }
        
        $result = array($post, $error);

        return $result;
    }

    public function destroy($article_id){
        $dbh = $this->db_access();
        // echo __LINE__;var_dump($article_id);die;
        
        $sql = 'DELETE  FROM posts WHERE id = :id';
        $stmt  = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 実行したら返す値がないため不要

        return "OK";//なにも返ってこないので"ok"といれる
    }


}