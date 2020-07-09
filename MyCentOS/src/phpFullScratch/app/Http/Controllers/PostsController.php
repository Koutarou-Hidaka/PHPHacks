<?php

class PostsController{

    // コンストラクタの定義
    public function __construct($models, $views){

        $this->models = $models;
        $this->views = $views;
    }
    public function init(){

        $values = array(
            "layouts" => $this->views."layouts/",
        );
        return $values;
    }
    public function index(){

        $values = $this->init();
        
        include($this->models.'Post.php');
        $postmodel  = new Post();
        $result = $postmodel->index();

        $posts = $result; 
        include($this->views."posts/index.php");
    }
    public function create(){
        $values = $this->init();
        include($this->views."posts/create.php");
    }

    public function store(){

        $values = $this->init();
        
        include($this->models.'Post.php');
        $postmodel  = new Post();
        $result = $postmodel->store();
        $post = $result[0];
        $error = $result[1];
        
        
        if (count($error)){
            include($this->views."posts/create.php");
        }else{
            header('Location: http://192.168.33.10/');
        }

    }
    public function show($article_id){

        $values = $this->init();

        include($this->models.'Post.php');
        $postmodel  = new Post();
        $result = $postmodel->show($article_id);

        $posts = $result[0];

        include($this->views."posts/show.php");
    }

    public function edit($article_id){
        $values = $this->init();

        include($this->models.'Post.php');
        $postmodel  = new Post();
        $result = $postmodel->edit($article_id);

        $posts = $result[0];
        
        include($this->views."posts/edit.php");

    }

    public function update($article_id){
        // var_dump($article_id);die;
        $values = $this->init();

        include($this->models.'Post.php');
        $postmodel  = new Post();
        $result = $postmodel->update($article_id);

        $posts = $result[0];
        // var_dump($posts);die;
        $error = $result[1];

        include($this->views."posts/edit.php");
    }

    public function destroy($article_id){
        $values = $this->init();
        include($this->models.'Post.php');
        $postmodel  = new Post();
        $result = $postmodel->destroy($article_id);
        

        // include($this->views."posts/edit.php"); 戻るビューがないためheader関数を使ってリダイレクトする
        // httpから始まる絶対パスでも、.から始まる相対パスでもOK
        header('Location: http://192.168.33.10/');

    }

}




?>