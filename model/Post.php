<?php

    class Post {
        private $conn;

        // post properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $author;
        public $body;
        public $created_at;

        // constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // get posts
        public function get_posts(){

            $query = 'SELECT * FROM posts p ORDER BY p.created_at DESC';
            
            // prepare statement and execute query
            $statement = $this->conn->prepare($query);

            $statement->execute();

            return $statement;
        }
    }