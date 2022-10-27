<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

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

        $result = $post->delete($id);

        // check if the post exists
        if ($result = $post->delete($id)) {
            echo json_encode(
                array('message' => 'Resource deleted successfully')
            );
            
        } else {

            // No resource found
            echo json_encode(
                array('message' => 'Resource could not be deleted', 'error' => 422)
            );
        }
    }
