<?php
session_start();

class AddToCart
{
    public $product_id;
    public $product_name;
    public $product_price;
    public $product_quantity=1;

    function __construct($product_id,$product_name,$product_price,$product_quantity) 
      {
        $this->id = $product_id;
        $this->name = $product_name;
        $this->price = $product_price;
        $this->quantity = $product_quantity;
      }
}

class ArrayOfCart {
    
    public function addToCart($object)
    {   // Checking if id is already present or not
        if(array_key_exists($object->id,$_SESSION['productArray']))
        {
            $_SESSION['productArray'][$object->id]->quantity = $_SESSION['productArray'][$object->id]->quantity +1;
        }
        else
        {
            $_SESSION['productArray'][$object->id] =$object;
        }
    }
    // Display function
    public function display()
    {
        foreach($_SESSION['productArray']  as $key => $val)
        {
            echo '<tr style="text-align:center"><td>'.$val->id.'</td><td>'.$val->name.'</td><td>'.$val->price*$val->quantity.'</td><td>'.$val->quantity.'</td><td><button id="deleteRow">Delete</button></td></tr>';   
    }
    }
}

// Displaying products
if(isset($_POST['ids'])){
    $product_id = $_POST['ids'];
    $pnam = $_POST['names'];
    $pric = $_POST['prices'];
    $quan = $_POST['quant'];
    $product = new AddToCart($product_id,$pnam,$pric,$quan);
    $cart = new ArrayOfCart();
    $cart->addToCart($product);
    $cart->display();
}


// deleting products
if(isset($_POST['delvalue']))
{
    $product_id = $_POST['delvalue'];
    unset($_SESSION['productArray'][$product_id]);
    $cart = new ArrayOfCart();
    $cart->display();
}
?>