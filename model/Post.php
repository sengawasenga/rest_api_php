<?php

    class Post {
        private $conn;
        private $table = 'posts';

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

            $query = 'SELECT
                        c.name as category_name,
                        p.id,
                        p.category_id,
                        p.title,
                        p.body,
                        p.author,
                        p.created_at
                    FROM ' . $this->table . ' p
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                    ORDER BY
                        p.created_at DESC';
            
            // prepare statement
            $statement = $this->conn->prepare($query);

            // execute query
            $statement->execute();

            return $statement;
        }
    }