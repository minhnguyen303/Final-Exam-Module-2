<?php
namespace src\Model;

use Src\Model\Category;
use Src\Model\DBConnect;

class CategoryManager
{
    protected DBConnect $dbConnect;

    public function __construct()
    {
        $this->dbConnect = new DBConnect();
    }

    public function getAllCategory(): array
    {
        $sql = "SELECT * FROM Categories";
        $data = $this->dbConnect->query($sql);
        $categories = [];
        foreach ($data as $item) {
            $categories[] = new Category($item['id'], $item['name']);
        }
        return $categories;
    }

    public function getByID()
    {
        
    }

}