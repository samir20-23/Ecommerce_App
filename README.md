

# Product Watch & Smart Watches Admin Panel

This application is an **Admin Panel** for managing products and smart watches. It allows you to perform basic CRUD (Create, Read, Update, Delete) operations on products, such as adding new products, updating existing ones, and deleting them. The application is built with **Laravel** (PHP) for the backend and **Vue.js** for the frontend.

## Features

- **Manage Products:** Add, update, and delete products (including smart watches).
- **CRUD Operations:** Perform operations on products (create, read, update, delete).
- **Image Upload:** Upload product images along with their details.
- **Vue.js Integration:** Admin panel with real-time updates using Vue.js.

## Installation Guide

### Prerequisites

Make sure you have the following software installed on your computer:
- **Node.js** (for managing JavaScript packages)
- **npm** (Node Package Manager)
- **Composer** (for PHP package management)
- **Laravel** (PHP Framework)

If you don’t have them, follow these steps to install:

1. [Install Node.js and npm](https://nodejs.org/en/download/)
2. [Install Composer](https://getcomposer.org/)
3. [Install Laravel](https://laravel.com/docs/8.x/installation)

### Step 1: Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/your-username/product-watch-admin.git
cd product-watch-admin
```

### Step 2: Install PHP Dependencies

Next, install the required PHP dependencies using Composer:

```bash
composer install
```

### Step 3: Configure Environment

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### Step 4: Set Up Database

Make sure your `.env` file is properly configured with your database credentials.

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Run the migrations to set up the database:

```bash
php artisan migrate
```

### Step 5: Install Node.js Dependencies

Now, install the required Node.js dependencies:

```bash
npm install
```

### Step 6: Compile Assets

To compile and build your assets (Vue.js, CSS, etc.), run the following command:

```bash
npm run dev
```

This will compile your assets and make the application ready for use.

### Step 7: Run the Laravel Development Server

Start the Laravel server:

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000/admin` in your browser to access the Admin Panel.

## Usage

### Admin Panel

Once logged in, you’ll have access to the admin dashboard where you can:

1. **View Products:** View a list of all products and smart watches in the system.
2. **Add a Product:** Use the "Create" button to add a new product or smart watch by providing the title, description, price, stock quantity, and image.
3. **Edit a Product:** Edit product details such as title, description, price, and stock.
4. **Delete a Product:** Remove a product from the database.

The application is built using **Vue.js** for dynamic interactions, and the data is fetched and displayed in real-time.

### Frontend

The frontend is a Vue.js application that handles the display and interaction with the products. It uses **Axios** to communicate with the Laravel backend, which provides the data for the products.

- **Vue Components:** The primary component for managing products is `ProductManager`.
- **Axios:** It fetches the product data and handles the CRUD operations via API requests.

### Example Usage

1. **Add a New Product:**
    - Navigate to the “Create” page.
    - Fill in the product details (title, description, price, stock).
    - Upload an image if needed.
    - Submit the form to create a new product.

2. **View Products:**
    - Navigate to the product list page where you can see all available products.
    - You can edit or delete any product from this list.

## Technologies Used

- **Laravel:** Backend framework (PHP).
- **Vue.js:** Frontend framework (JavaScript).
- **Axios:** For handling API requests.
- **MySQL:** Database to store product data.
- **Bootstrap:** For styling the application.

## Contributing

Feel free to fork this repository, make improvements, and create a pull request. For any questions or issues, open an issue in the GitHub repository.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
