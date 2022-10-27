<?php
    // CORS Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST, PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);
    $id = isset($_GET['id']) ? $_GET['id'] : NULL;

    if ($id == NULL) {

        // No id provided...
        echo json_encode(
            array('message' => 'Bad request', 'error' => 400)
        );
        die;

    } else {

        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $post->title = $data->title;
        $post->content = $data->content;
        $post->author = $data->author;

        // update post on the database
        if ($post->update($id)) {
            echo json_encode(
                array('message' => 'Post updated successfully')
            );
        } else {
            echo json_encode(
                array('message' => 'Post could not be updated successfully', 'error' => 422)
            );
        }
    }
    
