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



### User Management

- **GET** `http://e-commerce.test:8080/api/user`  
  Retrieve a list of all users.

  **Response:**

  ```json
  {
      "data": [
          {
              "name": "Serap Kayacan",
              "email": "kayacan@gmail.com",
              "password": "$2y$12$An6cMkNxvpBa34ryJYXQJuXwbNIpep3/PRxwv3rvLu/Gcok3uszC.",
              "slug": "serap-kayacan-1"
          },
          {
              "name": "Ahmet Yılmaz",
              "email": "ahmet@gmail.com",
              "password": "$2y$12$QEG5ipp3FZt653ytlOLkFumOKojiulCpSR8VqZIbyRZM/dDRs4qMO",
              "slug": "ahmet-yilmaz-2"
          },
          {
              "name": "Bahar Özçelik",
              "email": "bahar@gmail.com",
              "password": "$2y$12$G7vfjy/CrOSxZvg52OXY3uhKvtioiiWB/FRm385VcENe.F2sUJ.uS",
              "slug": "bahar-ozcelik-3"
          },
          {
              "name": "Aynur Deniz",
              "email": "aynur55@gmail.com",
              "password": "$2y$12$5TpE8l1s6kPp.P35PmYb/uSikHk3TWY.wheA2t7gEKtDCrvwBBJuW",
              "slug": "aynur-deniz-4"
          },
          {
              "name": "Deniz Aslan",
              "email": "deniz11@gmail.com",
              "password": "$2y$12$uN5pjktvrx.GCfJRjn8Mp.tOZpc42ef0dctit6tc5hoQ6xR49859e",
              "slug": "deniz-aslan-5"
          },
          {
              "name": "Ayça Şimşek",
              "email": "ayca22@gmail.com",
              "password": "$2y$12$vF0sG54NfPYinmeRA9b/4ew3f4wnQCmSSyxvDq41kRfBFluz7hgle",
              "slug": "ayca-simsek-6"
          }
      ]
  }


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
        "id": 5,
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
        "name": "Deleted User Name",
        "email": "Deleted User Email",
        "password": "Hashed Deleted User Password",
        "slug": "Deleted User Slug"
    }



### Product Management

- **GET** `http://e-commerce.test:8080/api/product`  
  Retrieve a list of all products.
  **Response:**

  ```json
  {
    "data": [
        {
            "product_name": "İnce Memed",
            "author_id": 1,
            "product_category_id": 1,
            "barcode": "12Ak34df",
            "product_status": "1",
            "stock_quantity": 10,
            "price": "48.75",
            "product_slug": "ince-memed-1",
            "product_image": null,
            "product_id": 1,
            "category_name": "Roman"
        },
        {
            "product_name": "Tutunamayanlar",
            "author_id": 2,
            "product_category_id": 1,
            "barcode": "15afew23",
            "product_status": "1",
            "stock_quantity": 20,
            "price": "90.30",
            "product_slug": "tutunamayanlar-2",
            "product_image": null,
            "product_id": 2,
            "category_name": "Roman"
        },
        {
            "product_name": "Kürk Mantolu Madonna",
            "author_id": 3,
            "product_category_id": 1,
            "barcode": "15s9806t34",
            "product_status": "1",
            "stock_quantity": 4,
            "price": "9.10",
            "product_slug": "kurk-mantolu-madonna-3",
            "product_image": null,
            "product_id": 3,
            "category_name": "Roman"
        },
        {
            "product_name": "Fareler ve İnsanlar",
            "author_id": 4,
            "product_category_id": 1,
            "barcode": "15sasfe9t34",
            "product_status": "1",
            "stock_quantity": 8,
            "price": "35.75",
            "product_slug": "fareler-ve-insanlar-4",
            "product_image": null,
            "product_id": 4,
            "category_name": "Roman"
        },
        {
            "product_name": "Şeker Portakalı",
            "author_id": 5,
            "product_category_id": 1,
            "barcode": "16787ujght34",
            "product_status": "1",
            "stock_quantity": 1,
            "price": "33.00",
            "product_slug": "seker-portakali-5",
            "product_image": null,
            "product_id": 5,
            "category_name": "Roman"
        },
        {
            "product_name": "Sen Yola Çık Yol Sana Görünür",
            "author_id": 6,
            "product_category_id": 2,
            "barcode": "1679ret34",
            "product_status": "1",
            "stock_quantity": 7,
            "price": "28.50",
            "product_slug": "sen-yola-cik-yol-sana-gorunur-6",
            "product_image": null,
            "product_id": 6,
            "category_name": "Kişisel Gelişim"
        },
        {
            "product_name": "Kara Delikler",
            "author_id": 7,
            "product_category_id": 3,
            "barcode": "1547ret34",
            "product_status": "1",
            "stock_quantity": 2,
            "price": "39.00",
            "product_slug": "kara-delikler-7",
            "product_image": null,
            "product_id": 7,
            "category_name": "Bilim"
        },
        {
            "product_name": "Allah De Ötesini Bırak",
            "author_id": 8,
            "product_category_id": 4,
            "barcode": "234eret34",
            "product_status": "1",
            "stock_quantity": 18,
            "price": "39.60",
            "product_slug": "allah-de-otesini-birak-8",
            "product_image": null,
            "product_id": 8,
            "category_name": "Din Tasavvuf"
        },
        {
            "product_name": "Aşk 5 Vakittir",
            "author_id": 9,
            "product_category_id": 4,
            "barcode": "7876tıret34",
            "product_status": "1",
            "stock_quantity": 9,
            "price": "42.00",
            "product_slug": "ask-5-vakittir-9",
            "product_image": null,
            "product_id": 9,
            "category_name": "Din Tasavvuf"
        },
        {
            "product_name": "Benim Zürafam Uçabilir",
            "author_id": 10,
            "product_category_id": 5,
            "barcode": "1sfcs56t54",
            "product_status": "1",
            "stock_quantity": 12,
            "price": "27.30",
            "product_slug": "benim-zurafam-ucabilir-10",
            "product_image": null,
            "product_id": 10,
            "category_name": "Çocuk ve Gençlik"
        },
        {
            "product_name": "Kuyucaklı Yusuf",
            "author_id": 3,
            "product_category_id": 1,
            "barcode": "154yg456t54",
            "product_status": "1",
            "stock_quantity": 2,
            "price": "10.40",
            "product_slug": "kuyucakli-yusuf-11",
            "product_image": null,
            "product_id": 11,
            "category_name": "Roman"
        },
        {
            "product_name": "Kamyon - Seçme Öyküler",
            "author_id": 3,
            "product_category_id": 6,
            "barcode": "wegsvre6t54",
            "product_status": "1",
            "stock_quantity": 9,
            "price": "9.75",
            "product_slug": "kamyon-secme-oykuler-12",
            "product_image": null,
            "product_id": 12,
            "category_name": "Öykü"
        },
        {
            "product_name": "Kendime Düşünceler",
            "author_id": 11,
            "product_category_id": 7,
            "barcode": "wtf4w456t54",
            "product_status": "1",
            "stock_quantity": 1,
            "price": "14.40",
            "product_slug": "kendime-dusunceler-13",
            "product_image": null,
            "product_id": 13,
            "category_name": "Felsefe"
        },
        {
            "product_name": "Denemeler - Hasan Ali Yücel Klasikleri",
            "author_id": 12,
            "product_category_id": 7,
            "barcode": "156hugbg54",
            "product_status": "1",
            "stock_quantity": 4,
            "price": "24.00",
            "product_slug": "denemeler-hasan-ali-yucel-klasikleri-14",
            "product_image": null,
            "product_id": 14,
            "category_name": "Felsefe"
        },
        {
            "product_name": "Animal Farm",
            "author_id": 13,
            "product_category_id": 1,
            "barcode": "sdvcdw456t54",
            "product_status": "1",
            "stock_quantity": 1,
            "price": "17.50",
            "product_slug": "animal-farm-15",
            "product_image": null,
            "product_id": 15,
            "category_name": "Roman"
        },
        {
            "product_name": "Dokuzuncu Hariciye Koğuşu",
            "author_id": 14,
            "product_category_id": 1,
            "barcode": "dfbgpş6t54",
            "product_status": "0",
            "stock_quantity": 0,
            "price": "18.50",
            "product_slug": "dokuzuncu-hariciye-kogusu-16",
            "product_image": null,
            "product_id": 16,
            "category_name": "Roman"
        }
    ]
}
  

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
  Retrieve details of a specific product by its ID.
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
    **Response:**

  ```json
  {
    "data": [
        {
            "category_name": "Roman",
            "category_description": "Roman Kitapları.",
            "category_status": "1",
            "category_slug": "roman"
        },
        {
            "category_name": "Kişisel Gelişim",
            "category_description": "Kişisel Gelişim Kitapları.",
            "category_status": "1",
            "category_slug": "kisisel-gelisim"
        },
        {
            "category_name": "Bilim",
            "category_description": "Bilim Kitapları. ",
            "category_status": "1",
            "category_slug": "bilim"
        },
        {
            "category_name": "Din Tasavvuf",
            "category_description": "Din Tasavvuf Kitapları",
            "category_status": "1",
            "category_slug": "din-tasavvuf"
        },
        {
            "category_name": "Çocuk ve Gençlik",
            "category_description": "Çocuk ve Gençlik Kitapları",
            "category_status": "1",
            "category_slug": "cocuk-ve-genclik"
        },
        {
            "category_name": "Öykü",
            "category_description": "Öykü Kitapları",
            "category_status": "1",
            "category_slug": "oyku"
        },
        {
            "category_name": "Felsefe",
            "category_description": "Felsefe Kitapları",
            "category_status": "1",
            "category_slug": "felsefe"
        }
    ]
}
  

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
        "category_name": "Deleted Category Name",
        "category_description": "Deleted Category Description",
        "category_status": "Deleted Category Status",
        "category_slug": "Deleted Category Slug"
    }
}
  
  ### Author Management

- **GET** `http://e-commerce.test:8080/api/author`  
  Retrieve a list of all authors.
   **Response:**
    ```json
  {
    "data": [
        {
            "author_type": "Local",
            "author_name": "Yaşar Kemal"
        },
        {
            "author_type": "Local",
            "author_name": "Oğuz Atay"
        },
        {
            "author_type": "Local",
            "author_name": "Sabahattin Ali "
        },
        {
            "author_type": "Foreign",
            "author_name": "John Steinback"
        },
        {
            "author_type": "Foreign",
            "author_name": "Jose Mauro De Vasconcelos"
        },
        {
            "author_type": "Local",
            "author_name": "Hakan Mengüç"
        },
        {
            "author_type": "Foreign",
            "author_name": "Stephen Hawking"
        },
        {
            "author_type": "Local",
            "author_name": "Uğur Koşar"
        },
        {
            "author_type": "Local",
            "author_name": "Mehmet Yıldız"
        },
        {
            "author_type": "Local",
            "author_name": "Mert Arık"
        },
        {
            "author_type": "Foreign",
            "author_name": "Marcus Aurelius"
        },
        {
            "author_type": "Foreign",
            "author_name": "Michel de Montaigne"
        },
        {
            "author_type": "Foreign",
            "author_name": "George Orwell"
        },
        {
            "author_type": "Local",
            "author_name": "Peyami Safa"
        }
    ]
}

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
        "author_type": "Deleted Author Type ",
        "author_name": "Deleted Author Name"
    }
}

### Order Management

- **GET** `http://e-commerce.test:8080/api/order`  
  Retrieve a list of all orders with associated user and order items.
    **Response:**
    ```json
  [
    {
        "id": 1,
        "order_status": "Pending",
        "user_id": 2,
        "campaign_id": 2,
        "cargo_price": "22.00",
        "total_price": "78.00",
        "discount_price": "34.00",
        "created_at": "2024-08-28T08:49:54.000000Z",
        "updated_at": "2024-08-28T08:49:54.000000Z",
        "deleted_at": null,
        "user": null,
        "order_items": []
    },
    {
        "id": 2,
        "order_status": "Canceled",
        "user_id": 4,
        "campaign_id": 1,
        "cargo_price": "35.00",
        "total_price": "89.00",
        "discount_price": "12.00",
        "created_at": "2024-08-28T08:49:54.000000Z",
        "updated_at": "2024-08-28T08:49:54.000000Z",
        "deleted_at": null,
        "user": {
            "id": 4,
            "name": "Aynur Deniz",
            "email": "aynur55@gmail.com",
            "email_verified_at": null,
            "slug": "aynur-deniz-4",
            "created_at": "2024-08-28T08:49:53.000000Z",
            "updated_at": "2024-08-28T08:49:53.000000Z",
            "deleted_at": null
        },
        "order_items": [
            {
                "id": 2,
                "order_id": 2,
                "product_id": 2,
                "order_quantity": 3,
                "order_price": "56.90",
                "created_at": "2024-08-28T08:49:54.000000Z",
                "updated_at": "2024-08-28T08:49:54.000000Z",
                "deleted_at": null,
                "product": null
            }
        ]
    },
    {
        "id": 3,
        "order_status": "Canceled",
        "user_id": 1,
        "campaign_id": 3,
        "cargo_price": "34.00",
        "total_price": "80.00",
        "discount_price": "56.00",
        "created_at": "2024-08-28T08:49:54.000000Z",
        "updated_at": "2024-08-28T08:49:54.000000Z",
        "deleted_at": null,
        "user": {
            "id": 1,
            "name": "Serap Kayacan",
            "email": "kayacan@gmail.com",
            "email_verified_at": null,
            "slug": "serap-kayacan-1",
            "created_at": "2024-08-28T08:49:53.000000Z",
            "updated_at": "2024-08-28T08:49:53.000000Z",
            "deleted_at": null
        },
        "order_items": [
            {
                "id": 1,
                "order_id": 3,
                "product_id": 1,
                "order_quantity": 5,
                "order_price": "34.90",
                "created_at": "2024-08-28T08:49:54.000000Z",
                "updated_at": "2024-08-28T08:49:54.000000Z",
                "deleted_at": null,
                "product": {
                    "id": 1,
                    "product_name": "İnce Memed",
                    "author_id": 1,
                    "product_category_id": 1,
                    "product_status": "1",
                    "barcode": "12Ak34df",
                    "stock_quantity": 10,
                    "price": "48.75",
                    "product_slug": "ince-memed-1",
                    "created_at": "2024-08-28T08:49:54.000000Z",
                    "updated_at": "2024-08-28T08:49:54.000000Z",
                    "deleted_at": null
                }
            }
        ]
    }
]

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

  ```

  
  **Response:**
  ```json

 {
    "message": "Order placed succesfully",
    "data": {
        "order_status": "'in:Pending,Deliverd,Out of delivery,Canceled,Accepted'",
        "user_id": "User ID",
        "campaign_id": "Campaign ID",
        "cargo_price": "Cargo Price",
        "total_price": "Total Price",
        "discount_price": "Discount Price"
    }
```

- **GET** `http://e-commerce.test:8080/api/order/{id}`  
  Retrieve details of a specific order by its ID.
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
   **Response:**
  ```json


  [
    {
        "id": 1,
        "campaign_name": "Buy 2 Pay 1",
        "campaign_status": "Active",
        "created_at": "2024-08-28T10:44:05.000000Z",
        "updated_at": "2024-08-28T10:44:05.000000Z",
        "deleted_at": null,
        "campaign_rules": [
            {
                "id": 1,
                "campaign_id": 1,
                "author_id": 3,
                "category_id": 1,
                "campaign_type": "buy_2_pay_1",
                "author_type": null,
                "discount_type": "Free",
                "discount_value": null,
                "min_total_price": null,
                "campaign_rules_status": "Active",
                "created_at": "2024-08-28T10:44:05.000000Z",
                "updated_at": "2024-08-28T10:44:05.000000Z",
                "deleted_at": null,
                "author": {
                    "id": 3,
                    "author_type": "Local",
                    "author_name": "Sabahattin Ali ",
                    "created_at": "2024-08-28T10:44:05.000000Z",
                    "updated_at": "2024-08-28T10:44:05.000000Z",
                    "deleted_at": null
                }
            }
        ]
    },
    {
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
                "deleted_at": null,
                "author": null
            }
        ]
    },
    {
        "id": 3,
        "campaign_name": "Percentage Discount",
        "campaign_status": "Active",
        "created_at": "2024-08-28T10:44:05.000000Z",
        "updated_at": "2024-08-28T10:44:05.000000Z",
        "deleted_at": null,
        "campaign_rules": [
            {
                "id": 3,
                "campaign_id": 3,
                "author_id": null,
                "category_id": null,
                "campaign_type": "percentage_discount",
                "author_type": null,
                "discount_type": "Percentage",
                "discount_value": "5.00",
                "min_total_price": "200.00",
                "campaign_rules_status": "Passive",
                "created_at": "2024-08-28T10:44:05.000000Z",
                "updated_at": "2024-08-28T10:44:05.000000Z",
                "deleted_at": null,
                "author": null
            }
        ]
    }
]
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


- **DELETE** http://e-commerce.test:8080/api/campaign/{id}`  
  Soft delete a specific campaign by its ID.

   **Response:**
  ```json

    "message": "Campaign soft deleted successfully.",
    "data": {
        "id": 3,
        "campaign_name": "Deleted Campaign Name",
        "campaign_status": "Deleted Campaign Status",
        "created_at": "Campaign Created Time",
        "updated_at": "Campaign Updated Time",
        "deleted_at": "Campaign Deleted Time"
    }


## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/repository-name.git
