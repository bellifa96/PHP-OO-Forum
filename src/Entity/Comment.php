<?php

class Comment
{
    private  $content;
    private  $createdAt;
    private  $updatedAt;
    private  $user;
    private  $post;

    /**
     * @param $content
     * @param $createdAt
     * @param $updatedAt
     * @param User $user
     * @param Post $post
     */
    public function __construct($content, $createdAt, $updatedAt, User $user, Post $post)
    {
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->user = $user;
        $this->post = $post;
    }

}