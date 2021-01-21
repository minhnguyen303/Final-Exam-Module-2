<?php
namespace src\Model;

use Src\Model\DBConnect;
use Src\Model\Product;

class ProductManager
{
    protected DBConnect $dbConnect;

    public function __construct()
    {
        $this->dbConnect = new DBConnect();
    }

    public function getAllProduct(): array
    {
        $sql = "SELECT Products.id,Products.name,Products.categoryId,Products.price,Products.amount,Products.createdDate,Products.description,Categories.name as productCategory FROM Products JOIN Categories ON Products.categoryId = Categories.id";
        $data = $this->dbConnect->query($sql);
        $products = [];
        foreach ($data as $item) {
            $product = new Product($item['id'], $item['name'],$item['categoryId'],$item['price'],$item['amount'],$item['createdDate'],$item['description']);
            $product->setCategory($item['productCategory']);
            $products[] = $product;
        }
        return $products;
    }

    public function createProduct(Product $product)
    {
        $id = $product->getId();
        $name = $product->getName();
        $categoryId = $product->getCategoryId();
        $price = $product->getPrice();
        $amount = $product->getAmount();
        $createdDate = $product->getName();
        $description = $product->getDescription();
        $sql = "INSERT INTO `Products`(`name`, `categoryId`, `price`, `amount`, `description`) VALUES ('$name','$categoryId','$price','$amount','$description')";
        $this->dbConnect->execute($sql);
    }

    public function getProduct($id): array
    {
        $sql = "SELECT * FROM Products where id='$id'";
        return $this->dbConnect->query($sql);
    }

    public function updateProduct($id,Product $data)
    {
        $name = $data->getName();
        $categoryId = $data->getCategoryId();
        $price = $data->getPrice();
        $amount = $data->getAmount();
        $description = $data->getDescription();
        $sql = "UPDATE Products SET name='$name', categoryId='$categoryId', price='$price', amount='$amount', description='$description' WHERE id='$id'";
        $this->dbConnect->execute($sql);
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM Products WHERE id='$id'";
        $this->dbConnect->execute($sql);
    }
}