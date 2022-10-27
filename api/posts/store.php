<?php
    // CORS Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->content = $data->content;
    $post->author = $data->author;

    // store post on the database
    if ($post->store()) {
        echo json_encode(
            array('message' => 'Post stored successfully')
        );
    } else {
        echo json_encode(
            array('message' => 'Post could not be stored successfully', 'error' => 422)
        );
    }
