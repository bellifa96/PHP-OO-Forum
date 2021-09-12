<?php

include(__DIR__.'./../Bdd/dbFunction.php');

class Post
{
  private $id;
  private $title;
  private $content;
  private $createdAt;
  private $updatedAt;
  private $categories;
  private $userId;
  private $bd;

    /**
     * @param $title
     * @param $content
     * @param $categories
     */
    public function __construct($title= null, $content= null,$categories= null)
    {
        $this->bd = new dbFunction();
        $this->title = $title;
        $this->content = $content;
        $this->categories = $categories;
        $this->createdAt = date('d/m/Y');
        $this->updatedAt = date('d/m/Y');
        $this->userId = $_SESSION['id'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function create(){

        if(!empty($this->title) && !empty($this->content) && !empty($this->categories) && !empty($this->userId)){
            $parameters = ['title'=>$this->title,
                'content'=>$this->content,
                'categories'=>$this->categories,
                'createdAt'=>$this->createdAt,
                'updatedAt'=>$this->updatedAt,
                'userId'=>$this->userId
            ];
            return $this->bd->newPost($parameters);
        }
        return false;
    }

    public function getPosts(){
        return $this->bd->getPosts();
    }

    public function getUserPosts(){
        return $this->bd->getUserPosts();
    }

    public function getPost($id){
        return $this->bd->getPost($id);
    }

    public function getComments($id){
        return $this->bd->getComments($id);
    }

    public function update($parameters){
        return $this->bd->updatePost($parameters);

    }

    public function delete($id){
        return $this->bd->deletePost($id);
    }


}