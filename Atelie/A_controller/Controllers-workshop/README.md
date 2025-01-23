# Laravel Controllers Workshop

Welcome to the **Laravel Controllers Workshop**! This repository contains everything you need to learn and master Laravel controllers, from basic concepts to advanced features.

---

## Table of Contents

1. [Workshop Overview](#workshop-overview)
2. [Prerequisites](#prerequisites)
3. [Setup Instructions](#setup-instructions)
4. [Workshop Outline](#workshop-outline)
5. [Hands-On Exercises](#hands-on-exercises)
6. [Resources](#resources)
7. [Contributing](#contributing)
8. [License](#license)

---

## Workshop Overview

### **Objective**
By the end of this workshop, participants will:
- Understand the role of controllers in Laravel's MVC architecture.
- Learn to create and manage controllers, including resource and single-action controllers.
- Apply middleware and dependency injection in controllers.

### **Who Is This For?**
This workshop is designed for developers who:
- Have basic knowledge of Laravel and PHP.
- Want to improve their Laravel skills, especially in organizing logic within controllers.

---

## Prerequisites

Before starting, make sure you have:
- **Laravel Installed**: A Laravel 10+ project set up. [Installation Guide](https://laravel.com/docs/10.x/installation)
- **PHP**: Version 8.1 or higher.
- **Composer**: For managing dependencies.
- **Node.js & npm**: For frontend dependencies (optional).

---

## Setup Instructions

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/Tribak-Ayoub/Tutorials-Laravel.git
   cd Tutorials-Laravel
   ```

2. **Set Up a Laravel Project**:
   Navigate to the `Controllers-workshop/LaravelProject/` folder and install dependencies:
   ```bash
   cd LaravelProject
   composer install
   ```

3. **Configure the Environment**:
   Copy the `.env.example` file to `.env` and configure your database credentials:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run the Project**:
   ```bash
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000` to confirm the project is running.

---

## Workshop Outline

### **1. Introduction to Controllers**
- What are controllers?
- Role in MVC.

### **2. Creating a Basic Controller**
- Using `php artisan make:controller`.
- Linking routes to controller methods.

### **3. Resource Controllers**
- What is a resource controller?
- Creating CRUD operations.

### **4. Middleware and Controllers**
- Applying middleware to restrict access.
- Example: Authentication middleware.

### **5. Advanced Topics**
- Dependency injection.
- Single-action controllers.
- API resource Routes.
- Customizing Missing Model Behavior.
- Soft Deleting Models.
- Specifying the Resource Model.
- Generating Form Requests.
- Partial Resource Routes.
- Naming Resource Routes.
- Controller Namespacing.

---

## Hands-On Exercises

1. **Basic Controller**: Create a controller that returns a greeting message.
2. **Resource Controller**: Build a controller to manage a "Task" resource.
3. **Middleware**: Apply authentication middleware to restrict access to certain methods.
4. **Dependency Injection**: Inject a service into a controller and use it to fetch data.

Each exercise is detailed in the `exercises/` directory.

---

## Resources

- **Laravel Documentation**: [Controllers](https://laravel.com/docs/controllers)
- **Workshop Docs**: Available in the `docs/` directory.
- **Exercices**: Check the `exercices/` folder for reference implementations.

---

## Contributing

We welcome contributions to improve this workshop! To contribute:
1. Fork the repository.
2. Create a new branch for your feature/fix.
3. Submit a pull request describing your changes.

---

## License

This workshop is licensed under the [MIT License](LICENSE). Feel free to use and modify the materials as needed.
