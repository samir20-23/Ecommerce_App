### **Basic Controller**

**Goal:**  
Create a `HelloController` with a `greet` method that returns "Hello, [name]!" where `[name]` is passed from the route.

**Steps:**

1. Create the controller:
   ```bash
   php artisan make:controller HelloController
   ```

2. Define the `greet` method in `HelloController`:
   ```php
   namespace App\Http\Controllers;

   class HelloController extends Controller
   {
       public function greet($name)
       {
           return "Hello, {$name}!";
       }
   }
   ```

3. Add a route in `routes/web.php`:
   ```php
   use App\Http\Controllers\HelloController;

   Route::get('/hello/{name}', [HelloController::class, 'greet']);
   ```

4. Test:  
   Visit `http://your-laravel-app/hello/John`. You should see:  
   **"Hello, John!"**
