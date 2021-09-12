<?php
declare(strict_types=1);

require(__DIR__ . './../Entity/Post.php');


class PostController
{

    public function index()
    {
        return (new Post)->getPosts();
    }

    public function userPosts()
    {
        return (new Post)->getUserPosts();
    }

    public function newCategory($name)
    {
        return (new Category($name))->create();
    }

    public function newPost($title, $content, $category_id)
    {
        return (new Post($title, $content, $category_id))->create();
    }

    public function show($id)
    {
        $post = new Post;
        return [
            'post' => $post->getPost($id),
            'comments' => $post->getComments($id)
        ];
    }

    public function edit($title, $content, $category_id, $id)
    {
        return (new Post)->update([
            'title' => $title,
            'content' => $content,
            'category_id' => $category_id,
            'id' => $id,
            'updatedAt' => date('d/m/Y')
        ]);
    }

    public function editCategory($name, $id)
    {
        return (new Category)->update([
            'name' => $name,
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        return (new Post)->delete($id);
    }

    public function deleteCategory($id)
    {
        return (new Category)->delete($id);
    }

    public function newComment($content, $id)
    {
        return (new Comment($content, $id))->create();
    }

}