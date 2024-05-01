<?php

// Include database connection configuration
include_once 'db_config.php';

// Set headers to allow cross-origin requests (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Check the request method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Handle GET request to retrieve products
        // Implement your logic to fetch products from the database
        echo json_encode(array("message" => "GET request to retrieve products"));
        break;
    case 'POST':
        // Handle POST request to add a new product
        // Parse JSON input
        $data = json_decode(file_get_contents("php://input"));
        
        // Validate input fields (example validation, adjust as needed)
        if (empty($data->name) || empty($data->description) || empty($data->price)) {
            http_response_code(400); // Bad request
            echo json_encode(array("message" => "Incomplete data. Please provide product name, description, and price."));
            break;
        }
        
        // Sanitize input data (example sanitization, adjust as needed)
        $name = htmlspecialchars(strip_tags($data->name));
        $description = htmlspecialchars(strip_tags($data->description));
        $price = floatval($data->price);

        // Insert new product into the database
        // Implement your logic to insert data into the 'products' table
        // Example SQL query (adjust table and column names as needed)
        $query = "INSERT INTO products (name, description, price) VALUES (:name, :description, :price)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        
        if ($stmt->execute()) {
            http_response_code(201); // Created
            echo json_encode(array("message" => "Product added successfully."));
        } else {
            http_response_code(500); // Internal server error
            echo json_encode(array("message" => "Unable to add product. Please try again later."));
        }
        break;
    case 'PUT':
        // Handle PUT request to update a product
        // Implement your logic to update a product in the database
        echo json_encode(array("message" => "PUT request to update a product"));
        break;
    case 'DELETE':
        // Handle DELETE request to delete a product
        // Implement your logic to delete a product from the database
        echo json_encode(array("message" => "DELETE request to delete a product"));
        break;
    default:
        // Invalid request method
        http_response_code(405); // Method not allowed
        echo json_encode(array("message" => "Invalid request method."));
}

?>
