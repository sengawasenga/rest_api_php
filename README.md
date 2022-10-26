# PHP CRUD API


This app is all about a CRUD API using vanilla PHP.
We'll use a MySQL database, and we'll connect by using PDO (PHP Data Object).

The core functionality of the API:

1. Display a list of posts.
2. Delete a specific post.
3. Add a brand new post.
4. Update an existing post.


## Getting started

To get started with this API, you just need to fork this repository, then clone it to get access of the code
locally.

### Step 1: Required software installation

1. Install WAMP server or similar software like XAMPP.


### Step 2: Set up database

1. Create a brand new database using WAMP server or similar software like XAMPP, then name it: `restapilaravel`


## API documentation

### Getting started

- Base URL: At present this app can only be run locally and is not hosted as a base URL. The backend app is hosted at the default, `http://rest_api_php/api/`; 
- Authentication: This version of the application does not require authentication or API keys.

### Error Handling

Errors are returned as JSON objects in the following format:

```json
{
    "error": 404,
    "message": "Resource not found"
}
```
The API will return three error types when requests fail:

- 404: Resource Not Found
- 400: Bad request 
- 405: Method not allowed

### Endpoints

#### GET /posts

- Fetches a list of posts from the database.
- Request Arguments: None
- Returns: A JSON object with a single key, data, that contains an array of posts.

`curl http://rest_api_php/api/posts`

```json
{
  "data": [
    {
      "id": 1,
      "title": "Brand new title",
      "content": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.",
      "created_at": "2022-10-26T15:31:19.000000Z",
      "updated_at": "2022-10-26T15:31:19.000000Z"
    }
  ]
}
```


#### GET /posts/{id}

- Get a specific post based on his id
- Return: A JSON object with a single key, data, that contains a specific post.
- Request Arguments: None

`curl http://rest_api_php/api/posts/1`

```json
{
  "data": {
    "id": 1,
    "title": "Brand new title",
    "content": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.",
    "created_at": "2022-10-26T15:31:19.000000Z",
    "updated_at": "2022-10-26T15:31:19.000000Z"
  }
}
```

#### POST /posts

- Create a brand new post
- Request Arguments: Required arguments are: 'title' and 'content'.
- Returns a success message and the id of the new post

`curl http://rest_api_php/api/posts -X POST -H "Content-Type: application/json" -d '{"title":"A new title", "content":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English."}'`

```json
{
    "message": "Resource created successfully.",
    "id": 2
}
```

#### PATCH /posts/{id}

- Update an existing post
- Request Arguments: Required arguments are: 'title' and 'content'.
- Returns a success message and the id of the updated post

`curl http://rest_api_php/api/posts/1 -X PATCH -H "Content-Type: application/json" -d '{"title":"A new title", "content":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English."}'`

```json
{
    "message": "Resource updated successfully.",
    "id": 2
}
```

#### DELETE /posts/{id}

- Deletes a specific post based on his id
- Request arguments: None
- Returns a success message and the id of the deleted question

`curl -X DELETE http://rest_api_php/api/posts/2`

```json
{
    "message": "Resource deleted successfully",
    "id": 2
}
```


