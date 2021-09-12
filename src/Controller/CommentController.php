<?php


require(__DIR__.'./../Entity/Comment.php') ;



class CommentController
{

    public function getComment($id){
        $comment = new Comment();
        return $comment->getComment($id);


    }

    public function newComment($content,$id){
        $comment = new Comment($content,$id);
        return $comment->create();


    }

    public function delete($id){
        $comment = new Comment();
        return $comment->delete($id);


    }

    public function edit($content,$id){
        $comment = new Comment();
        $parameters = [
            'content'=>$content,
            'id' => $id,
            'updatedAt'=> date('d/m/Y')
        ];

        return $comment->update($parameters);

    }




}