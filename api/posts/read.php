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

$result = $post->get_posts();
$num = $result->rowCount();

// Check if any posts
if ($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'author' => $author,
        );

        // Push to "data"
        array_push($posts_arr, $post_item);
        // array_push($posts_arr['data'], $post_item);
    }

    echo json_encode($posts_arr);
} else {
    // No resource found
    echo json_encode(
        array('message' => 'Resource not found', 'error' => 404)
    );
}