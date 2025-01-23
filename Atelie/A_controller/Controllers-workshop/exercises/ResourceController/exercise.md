### **Resource Controller**

**Goal:**  
Create a resource controller for managing "Articles" and implement methods to:
- List all articles.
- Show a single article.
- Delete an article.

**Steps:**

1. Generate the resource controller:
   ```bash
   php artisan make:controller ArticleController --resource
   ```

2. Add methods in `ArticleController`:
   ```php
   namespace App\Http\Controllers;

   use Illuminate\Http\Request;

   class ArticleController extends Controller
   {
       private $articles = [
           1 => ['title' => 'First Article', 'content' => 'This is the first article.'],
           2 => ['title' => 'Second Article', 'content' => 'This is the second article.'],
       ];

       public function index()
       {
           return response()->json($this->articles);
       }

       public function show($id)
       {
           if (isset($this->articles[$id])) {
               return response()->json($this->articles[$id]);
           }

           return response()->json(['error' => 'Article not found.'], 404);
       }

       public function destroy($id)
       {
           if (isset($this->articles[$id])) {
               unset($this->articles[$id]);
               return response()->json(['message' => 'Article deleted.']);
           }

           return response()->json(['error' => 'Article not found.'], 404);
       }
   }
   ```

3. Add resource routes in `routes/web.php`:
   ```php
   use App\Http\Controllers\ArticleController;

   Route::resource('articles', ArticleController::class);
   ```

4. Test:
   - `GET /articles` - Lists all articles.
   - `GET /articles/1` - Shows the first article.
   - `DELETE /articles/1` - Deletes the first article.
