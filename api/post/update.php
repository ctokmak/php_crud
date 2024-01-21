<?php
// Headers
header('Access-Control-Allow-Origin: * ');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$directory = basename(dirname(__FILE__));

include_once '../../config/Database.php';
include_once "../../models/".$directory.".php";

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
//$post = new Post($db);
$post = new $directory($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

// Set ID to Update
$post->id = $data->id;

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Update post
if($post->update()){
    echo json_encode(array('message' => 'Post updated'));
} else {
    echo json_encode(
        array('message' => 'Post not updated'));
}