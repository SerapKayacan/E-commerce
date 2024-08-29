# E-Commerce Order and Campaign Management System

This repository contains an API-based order management and campaign system built using Laravel. The project includes controllers for managing users,products, categories, authors, orders,  and campaigns. It also implements various campaign types like 'Buy 2 Pay 1', 'Author Type Discount', and 'Percentage Discount'.

## Features


- ** User, Product, Author, and Category Management**:
  - Manage users, products, categories, authors, orders, and campaigns
  - Create, update, retrieve, and delete operations for users, products,categories , and authors.
- **Order Management**: 
  - Create, update, retrieve, and delete orders.
  - Validate order details and apply applicable campaigns.
  - Calculate total price, discounts, and cargo prices.

- **Campaign Management**: 
  - Create, update, retrieve, and delete campaigns.
  - Support for multiple campaign types:
    - `buy_2_pay_1`: Applies a "buy 2, get 1 free" discount.
    - `author_type_discount`: Applies a percentage discount based on the author type.
    - `percentage_discount`: Applies a percentage discount when the total price exceeds a certain threshold.

## Step 1: Set Up Your Laravel Project

To set up a fresh Laravel project, you can use Composer. Follow the steps below:

1. Git Path:

    ```bash
   https://github.com/SerapKayacan/E-commerce.git
    ```
2. Install Composer:

    ```bash
   composer install
    ```

## Step 2: Configure the Database

After setting up your Laravel project, you'll need to configure the database connection. Follow these steps:

1. Open the `.env` file located in the root of your project.

2. Update the following lines with your database connection details:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=e-commerce
    DB_USERNAME=root
    DB_PASSWORD=
    ```


### User Management

- **GET** `http://e-commerce.test:8080/api/user`  
  Retrieve a list of all users.
  
- **POST** `http://e-commerce.test:8080/api/user`  
  Create a new user.
  **Request:**

  ```json
  
  "name": "string",
  "email": "email",
  "password": "string",
  ```

  
  **Response:**
  ```json

   "message": "User created succesfully.",
  "data":{
        "id": "ID",
        "name": "name",
        "email": "email",
        "password": "Hashed Password",
        "slug": "name-id"
        
      }


- **GET** `http://e-commerce.test:8080/api/user/{id}`  
  Retrieve details of a specific user by its ID.
**Response:**

  ```json
  {
  "user": {
        "id": "ID",
        "name": "name",
        "email": "email",
        "email_verified_at": null,
        "slug": "name-id",
        "created_at": "Created time",
        "updated_at": "Updated time",
        "deleted_at": "Deleted time"
    }

  }
  

- **PUT** `http://e-commerce.test:8080/api/user/{id}`  
  Update an existing user.
   **Request:**

  ```json
  
  "name": "string",
  "email": "email",
  "password": "string"
  ```
  **Response:**
    ```json
     "message": "User Updated succesfully.",
    "data": {
        "id":"ID",
        "name": "name",
        "email": "email",
        "password": "Hashed password",
        "slug": "name-id"
    }

- **DELETE** `http://e-commerce.test:8080/api/user/{id}`  
  Soft delete a specific user by its ID.
    **Response:**

  ```json
  
 
    "message": "User soft deleted successfully.",
    "data": {
        "id": "Deleted User ID",
        "name": "Deleted User Name",
        "email": "Deleted User Email",
        "password": "Hashed Deleted User Password",
        "slug": "Deleted User Slug"
    }



### Product Management

- **GET** `http://e-commerce.test:8080/api/product`  
  Retrieve a list of all products.
  **Response:**
  
- **POST** `http://e-commerce.test:8080/api/product`  
  Create a new product.
   **Request:**

  ```json
  
  {
    
        "product_name": "string",
        "author_id":"Integer",
        "product_category_id": "Integer",
        "barcode": "String",
        "product_status": "0/1",
        "stock_quantity": "Integer",
        "price":"Decimal"
      
   
    }
  ```

  
  **Response:**
  ```json

    "message": "Product created successfully.",
    "data": {
        "id": "ID",
        "product_name": "Product Name",
        "author_id":"Author ID",
        "product_category_id": "Category ID",
        "barcode": "Barcode",
        "product_status": "0/1",
        "stock_quantity": "Quantity",
        "price": "Price",
        "product_slug": "product name-ID",
        "product_image": null,
        "product_id": "ID",
        "category_name": null
    }

 
  

- **GET** `http://e-commerce.test:8080/api/product/{id}`  
  Retrieve details of a specific product by its ID/5.
    **Request:**

  ```json
  
  "product": {
        "id": 5,
        "product_name": "Product Name",
        "author_id": "ID",
        "product_category_id": "Category ID",
        "product_status": "0/1",
        "barcode": "barcode",
        "stock_quantity": "1",
        "price": "33.00",
        "product_slug": "paroduct name-ID",
        "created_at": "2024-08-28T07:10:10.000000Z",
        "updated_at": "2024-08-28T07:10:10.000000Z",
        "deleted_at": null
    }

- **PUT** `http://e-commerce.test:8080/api/product/{id}`  
  Update an existing product.
   **Request:**

  ```json
  
  {
    
        "product_name": "basdg",
        "author_id":2,
        "product_category_id": 8,
        "barcode": "05",
        "product_status": "1",
        "stock_quantity": 3,
        "price": "20.00"
      
   
    }
  ```
  **Response:**
    ```json
    {
    "message": "Product updated successfully.",
    "data": {
        "id":"ID",
        "product_name": "basdg",
        "author_id": 2,
        "product_category_id": 8,
        "barcode": "05",
        "product_status": "1",
        "stock_quantity": 3,
        "price": "20.00",
        "product_slug": "basdg-5",
        "product_image": null,
        "product_id": 5,
        "category_name": null
    }
}
  

- **DELETE** `http://e-commerce.test:8080/api/product/{id}`  
  Soft delete a specific product by its ID.
   **Response:**
    ```json
    {
    "message": "Product soft deleted successfully.",
    "data": {
    "    id": "Deleted Product ID ",
        "product_name": "Deleted Product Name ",
        "author_id": "Deleted Product Author ID",
        "product_category_id": "Deleted Product Category ID",
        "barcode": "Deleted Product Barcode",
        "product_status": "Deleted Product Status",
        "stock_quantity": "Deleted Product Quantity",
        "price": "Deleted Product Price",
        "product_slug": "Deleted Product Slug",
        "product_image": null,
        "product_id": "Deleted Product ID",
        "category_name": "Deleted Product Category Name"
    }
}
  

### Category Management

- **GET** `http://e-commerce.test:8080/api/category`  
  Retrieve a list of all categories.
   

- **POST** `http://e-commerce.test:8080/api/category`  
  Create a new category.
    **Request:**

  ```json
  

    "category_name": "string",
    "category_description": "string",
    "category_status": "0/1"

  ```

  
  **Response:**
  ```json

   {
    "message": "Category created successfully.",
    "data": {
        "id": "ID",
        "category_name": "Category Name",
        "category_description": "Category Description",
        "category_status": "0/1",
        "category_slug": "Category Name-ID"
    }
}

 
  

- **GET** `http://e-commerce.test:8080/api/category{id}`  
  Retrieve details of a specific category by its ID.
    **Response:**
  ```json

   {
    "category": {
        "id": "ID",
        "category_name": "Category Name",
        "category_description": "Category Description",
        "category_status": "0/1",
        "category_slug": "Category Name-ID",
        "created_at": "Created Time",
        "updated_at": "Updated Tİme",
        "deleted_at": "Deleted Tİme"
    }
}


- **PUT** `http://e-commerce.test:8080/api/category/{id}`  
  Update an existing category.
   **Request:**

  ```json
  
  
    "category_name": "String",
    "category_description": "String",
    "category_status": "0/1"

  ```
  **Response:**
    ```json
    {
    "message": "Category Updated Succesfully.",
    "data": {
        "id": "ID",
        "category_name": "Updated Categoy Name",
        "category_description": "Updated Categoy Description",
        "category_status": "0/1",
        "category_slug": "update-categoy-name-ID"
    }
}
  

- **DELETE** `http://e-commerce.test:8080/api/category/{id}`  
  Soft delete a specific category by its ID.
   **Response:**
    ```json
    {
    "message": "Category soft deleted successfully.",
    "data": {
        "id": "Deleted Category ID ",
        "category_name": "Deleted Category Name",
        "category_description": "Deleted Category Description",
        "category_status": "Deleted Category Status",
        "category_slug": "Deleted Category Slug"
    }
}
  
  ### Author Management

- **GET** `http://e-commerce.test:8080/api/author`  
  Retrieve a list of all authors.
   

- **POST** `http://e-commerce.test:8080/api/author`  
  Create a new author.
     **Request:**

  ```json
  

    "author_type": "in:Local,Foreign",
    "author_name": "string"

  ```

  
  **Response:**
  ```json

  {
    "message": "Author created succesfully.",
    "data": {
         "id": "ID",
        "author_type": "Created Author Type",
        "author_name": "Created Author Name"
    }
}
}

 

- **GET** `http://e-commerce.test:8080/api/author/{id}`  
  Retrieve details of a specific author by its ID.
    **Response:**
  ```json

  {
    "author": {
        "id": 5,
        "author_type": "Author Type",
        "author_name": "Author Name",
        "created_at": "Author Created Time",
        "updated_at": "Author Updated Time",
        "deleted_at": null
    }
}

- **PUT** `http://e-commerce.test:8080/api/author/{id}`  
  Update an existing author.
    **Request:**

  ```json
  
  
    "author_type": "in:Local,Foreign",
    "author_name": "Author Name"


  ```
  **Response:**
    ```json
    {
    "message": "Author Updated succesfully.",
    "data": {
         "id": "ID",
        "author_type": "Updated Author Type",
        "author_name": "Updated Author Name"
    }
}

- **DELETE** `http://e-commerce.test:8080/api/author/{id}`  
  Soft delete a specific author by its ID.
    **Response:**
    ```json
  {
    "message": "Author soft deleted successfully.",
    "data": {
         "id": "Deleted Author ID ",
        "author_type": "Deleted Author Type ",
        "author_name": "Deleted Author Name"
    }
}

### Order Management

- **GET** `http://e-commerce.test:8080/api/order`  
  Retrieve a list of all orders with associated user and order items.
   

- **POST** `http://e-commerce.test:8080/api/order`  
  Create a new order with the provided user and order items.
   **Request:**

  ```json
  

   {
    "user_id": "Integer",
    "order_items": [
        {
            "product_id": "Integer",
            "order_quantity": "Integer"
        },
        {
            "product_id": "Integer",
            "order_quantity": "Integer"
        }
    ]
}


  
  **Response:**
  ```json

 {
    "message": "Order placed succesfully",
    "data": {
        "id": "ID",
        "order_status": "'in:Pending,Deliverd,Out of delivery,Canceled,Accepted'",
        "user_id": "User ID",
        "campaign_id": "Campaign ID",
        "cargo_price": "Cargo Price",
        "total_price": "Total Price",
        "discount_price": "Discount Price"
    }
```

- **GET** `http://e-commerce.test:8080/api/order/{id}`  
  Retrieve details of a specific order by its ID/5.
  **Response:**
  ```json


    "message": "Order retrieved successfully",
    "data": {
        "id": 4,
        "order_status": "Pending",
        "user_id": 2,
        "campaign_id": 1,
        "cargo_price": "10.00",
        "total_price": "38.60",
        "discount_price": "9.10",
        "created_at": "2024-08-28T10:44:08.000000Z",
        "updated_at": "2024-08-28T10:44:08.000000Z",
        "deleted_at": null,
        "order_items": [
            {
                "id": 3,
                "order_id": 4,
                "product_id": 11,
                "order_quantity": 1,
                "order_price": "10.40",
                "created_at": "2024-08-28T10:44:08.000000Z",
                "updated_at": "2024-08-28T10:44:08.000000Z",
                "deleted_at": null,
                "product": {
                    "id": 11,
                    "product_name": "Kuyucaklı Yusuf",
                    "author_id": 3,
                    "product_category_id": 1,
                    "product_status": "1",
                    "barcode": "154yg456t54",
                    "stock_quantity": 0,
                    "price": "10.40",
                    "product_slug": "kuyucakli-yusuf-11",
                    "created_at": "2024-08-28T10:44:05.000000Z",
                    "updated_at": "2024-08-28T10:47:01.000000Z",
                    "deleted_at": null
                }
            },
            {
                "id": 4,
                "order_id": 4,
                "product_id": 3,
                "order_quantity": 2,
                "order_price": "18.20",
                "created_at": "2024-08-28T10:44:08.000000Z",
                "updated_at": "2024-08-28T10:44:08.000000Z",
                "deleted_at": null,
                "product": null
            }
        ],
        "user": null
    }


- **PUT** `http://e-commerce.test:8080/api/order/{id}`  
  Update the status of an existing order.
    **Request:**

  ```json
  
    "order_status": "in:Pending,Deliverd,Out of delivery,Canceled,Accepted"

  ```

  
  **Response:**
  ```json


    "message": "Order status updated successfully",
    "data": {
        "id": "ID",
        "order_status": "Updated Order Status",
        "user_id": "Updated Order User ID",
        "campaign_id":"Updated Order User Campaign",
        "cargo_price": "Updated Order Cargo Price",
        "total_price": "Updated Order Total Price",
        "discount_price": "Updated Order Discount Price"
    



- **DELETE** `http://e-commerce.test:8080/api/order/{id}`  
  Soft delete a specific order by its ID.
  **Response:**
  ```json


   {
    "message": "Order soft deleted successfully.",
    "data": {
        "id": "Deleted Order ID",
        "order_status": "Deleted Order Status",
        "user_id": "Deleted Order User ID",
        "campaign_id": "Deleted Order Campaign ID",
        "cargo_price": "Deleted Order Cargo Price",
        "total_price": "Deleted Order Total Price",
        "discount_price": "Deleted Order Discount Price"
    }
}

### Campaign Management

- **GET** `http://e-commerce.test:8080/api/campaign`  
  Retrieve a list of all campaigns with associated rules.
    
- **POST** `http://e-commerce.test:8080/api/campaign`  
  Create a new campaign based on the provided type and rules./Create for Buy 2 Pay 1 Campaign
    **Request:**

  ```json

    "campaign_type": "buy_2_pay_1",
    "campaign_name": "string",
    "author_id": "Integer",
    "category_id":"Integer"

  ```

  
  **Response:**
  ```json


    "message": "Campaign created succesfuly",
    "data": {
         "id": "ID",
        "campaign_name": "Created Campaign Name",
        "campaign_status": "Active-/Passive",
        "updated_at": "Campaign Updated Time",
        "created_at": "Campaing Created Time",
        "id": "ID"
    

 Create a new campaign based on the provided type and rules./Create for Local Author Discount Campaign
  **Request:**

  ```json
  
{
    "campaign_type": "author_type_discount",    
    "campaign_name": "string",  
    "author_type":"in:Local,Foreign",
    "discount_value":"numeric"

  
    
}
   
  ```
  
  **Response:**
  ```json


   {
    "message": "Campaign created succesfuly",
    "data": {
         "id": "ID",
        "campaign_name": "Created Campaign Name",
        "campaign_status":"Active-/Passive",
        "updated_at": "Campaign Updated Time",
        "created_at": "Campaing Created Time",
        "id": "ID"
    }
}
 ```
Create a new campaign based on the provided type and rules./Create for Percentage Discount Campaign
  **Request:**

  ```json
  
{
    "campaign_type": "percentage_discount", 
    "campaign_name":"string",   
    "min_total_price":"numeric",
    "discount_value":"numeric" 
}
    
 ```

  **Response:**
  ```json

  {
    "message": "Campaign created succesfuly",
    "data": {
        "id": "ID",
        "campaign_name": "percentage",
        "campaign_status":"Active-/Passive",
        "updated_at": "Campaign Updated Time",
        "created_at": "Campaing Created Time",
        "id": "ID"
    }
}
 ```

- **GET** `http://e-commerce.test:8080/api/campaign/{id}`  
  Retrieve details of a specific campaign by its ID/2.

   **Response:**
  ```json


    "message": "Campaign retrieved successfully",
    "data": {
        "id": 2,
        "campaign_name": "Local Author Discount",
        "campaign_status": "Active",
        "created_at": "2024-08-28T10:44:05.000000Z",
        "updated_at": "2024-08-28T10:44:05.000000Z",
        "deleted_at": null,
        "campaign_rules": [
            {
                "id": 2,
                "campaign_id": 2,
                "author_id": null,
                "category_id": null,
                "campaign_type": "author_type_discount",
                "author_type": "Local",
                "discount_type": "Percentage",
                "discount_value": "5.00",
                "min_total_price": null,
                "campaign_rules_status": "Active",
                "created_at": "2024-08-28T10:44:05.000000Z",
                "updated_at": "2024-08-28T10:44:05.000000Z",
                "deleted_at": null
            }
        ]
}


- **DELETE** `http://e-commerce.test:8080/api/campaign/{id}`   
  Soft delete a specific campaign by its ID.

   **Response:**
  ```json

    "message": "Campaign soft deleted successfully.",
    "data": {
        "id": "Deleted Campaign ID",
        "campaign_name": "Deleted Campaign Name",
        "campaign_status": "Deleted Campaign Status",
        "created_at": "Campaign Created Time",
        "updated_at": "Campaign Updated Time",
        "deleted_at": "Campaign Deleted Time"
    }


