<?php

// CORS headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);
$id = isset($_GET['id']) ? $_GET['id'] : NULL;

if ($id == NULL) {

    // No id provided...
    echo json_encode(
        array('message' => 'Bad request', 'error' => 400)
    );
    die;

} else {

    $result = $post->show($id);
    $num = $result->rowCount();

    // check if the post exists
    if ($num > 0) {

        $row = $result->fetch(PDO::FETCH_ASSOC);
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'author' => $author,
        );

        echo json_encode($post_item);

    } else {

        // No resource found
        echo json_encode(
            array('message' => 'Resource not found', 'error' => 404)
        );
    }

}

