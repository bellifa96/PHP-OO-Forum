<?php
include(__DIR__ . './../Bdd/dbFunction.php');

class Comment
{
    private $content;
    private $createdAt;
    private $updatedAt;
    private $user;
    private $post;
    private $bd;

    /**
     * @param $content
     * @param $post
     */
    public function __construct($content = null, $post = null)
    {
        $this->content = $content;
        $this->createdAt = date('d/m/Y');
        $this->updatedAt = date('d/m/Y');
        $this->user = $_SESSION['id'];
        $this->post = $post;
        $this->bd = new dbFunction();

    }

    public function create()
    {

        if (!empty($this->content) && !empty($this->post)) {
            $parameters = [
                'content' => $this->content,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
                'userId' => $this->user,
                'postId' => $this->post,
            ];
            return $this->bd->newComment($parameters);
        }
    }


    public function update($parameters)
    {
        return $this->bd->updateComment($parameters);
    }

    public function delete($id)
    {
        return $this->bd->deleteComment($id);
    }

    public function getComment($id)
    {
        return $this->bd->getComment($id);
    }


}