<?php
session_start();

// $cart=[
    
//     [
       // key => value
//     //product_id => amount

//     ]
// ]


$course_id=$_POST["course_id"];

$newItem=[
    $course_id=>1
];


if(!isset($_SESSION["cart"])){
    $_SESSION["cart"]=[];
}



$product_exist=0; //flag

foreach($_SESSION["cart"] as $value){
    if(array_key_exists($course_id,$value)){
        $product_exist=1;
        break;
    }
}

if($product_exist==0){
    array_push($_SESSION["cart"],$newItem);
}


$data=[
    "count"=>count($_SESSION["cart"])
];

echo json_encode($data);

?>