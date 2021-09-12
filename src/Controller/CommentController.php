<?php
declare(strict_types=1);

require(__DIR__ . './../Entity/Comment.php');


class CommentController
{

    public function getComment($id)
    {
        return (new Comment)->getComment($id);
    }

    public function newComment($content, $id)
    {
        return (new Comment($content, $id))->create();
    }

    public function delete($id)
    {
        return (new Comment)->delete($id);
    }

    public function edit($content, $id)
    {
        return (new Comment)->update([
            'content' => $content,
            'id' => $id,
            'updatedAt' => date('d/m/Y')
        ]);
    }


}