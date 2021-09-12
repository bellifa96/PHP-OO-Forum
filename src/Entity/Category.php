<?php
declare(strict_types=1);

include(__DIR__ . './../Bdd/dbFunction.php');

class Category
{
    private $id;
    private ?string $name;
    private $bd;

    /**
     * @param $name
     */
    public function __construct(?string $name = null)
    {
        $this->bd = new dbFunction();
        $this->name = $name;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function create()
    {

        if (!empty($this->title) && !empty($this->content) && !empty($this->categories) && !empty($this->userId)) {
            $parameters = ['name' => $this->name];
            return $this->bd->newCategory($parameters);
        }
        return false;
    }

    public function getPosts()
    {
        // TODO
    }

    public static function all()
    {
        return (new dbFunction)->getCategories();
    }

    public function update($parameters)
    {
        return $this->bd->updateCategory($parameters);

    }

    public function delete($id)
    {
        return $this->bd->deleteCategory($id);
    }


}