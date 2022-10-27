<?php

    class Post {
        private $conn;

        // post properties
        public $id;
        public $title;
        public $author;
        public $content;
        public $created_at;

        // constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // get posts
        public function read(){

            $query = 'SELECT * FROM posts p ORDER BY p.created_at DESC';
            
            // prepare statement and execute query
            $statement = $this->conn->prepare($query);

            $statement->execute();

            return $statement;
        }

        // show a specific post
        public function show($id) {
            $query = 'SELECT * FROM posts WHERE id=' . $id;

            // prepare statement and execute query
            $statement = $this->conn->prepare($query);

            $statement->execute();

            return $statement;
        }

        // store a specific post on the database
        public function store() {
            // Create query
            $query = 'INSERT INTO posts SET title = :title, content = :content, author = :author';

            // Prepare statement
            $statement = $this->conn->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->content = htmlspecialchars(strip_tags($this->content));
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind data
            $statement->bindParam(':title', $this->title);
            $statement->bindParam(':content', $this->content);
            $statement->bindParam(':author', $this->author);

            // Execute query
            if ($statement->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $statement->error);

            return false;
        }
    }