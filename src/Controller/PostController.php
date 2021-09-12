<?php


require(__DIR__.'./../Entity/Post.php') ;



class PostController
{


    public function index(){
        $posts = new Post();
        return $posts->getPosts();


    }
    public function userPosts(){
        $posts = new Post();
        return $posts->getUserPosts();


    }

    public function newPost($title,$content,$categories){
        $post = new Post($title,$content,$categories);
        return $post->create();


    }
    public function show($id){
        $post = new Post();
        $data ['post'] = $post->getPost($id);
        $data ['comments'] = $post->getComments($id);

       // var_dump($data);die;
        return $data;



    }
    public function edit($title,$content,$categories,$id){

        $parameters = [
            'title'=> $title,
            'content'=> $content,
            'categories'=> $categories,
            'id'=> $id,
            'updatedAt' => date('d/m/Y')
        ];
        $post = new Post();
        return $post->update($parameters);

    }
    public function delete($id){

        $post = new Post();
       return $post->delete($id);


    }


    public function newComment($content,$id){
        $comment = new Comment($content,$id);
        return $comment->create();


    }

}