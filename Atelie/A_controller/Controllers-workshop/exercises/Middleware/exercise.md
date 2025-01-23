### **Middleware**

**Goal:**  
Restrict access to the `edit` and `update` methods of the "Articles" controller.

**Steps:**

1. Create middleware:
   ```bash
   php artisan make:middleware AuthenticatedMiddleware
   ```

2. Define the logic in `AuthenticatedMiddleware`:
   ```php
   namespace App\Http\Middleware;

   use Closure;

   class AuthenticatedMiddleware
   {
       public function handle($request, Closure $next)
       {
           // Example: Check if the user is logged in
           if (!$request->user()) {
               return response()->json(['error' => 'Unauthorized.'], 401);
           }

           return $next($request);
       }
   }
   ```

3. Register the middleware in `app/Http/Kernel.php`:
   ```php
   protected $routeMiddleware = [
       'auth.custom' => \App\Http\Middleware\AuthenticatedMiddleware::class,
   ];
   ```

4. Apply middleware to the `edit` and `update` methods in `ArticleController`:
   ```php
   public function __construct()
   {
       $this->middleware('auth.custom')->only(['edit', 'update']);
   }
   ```

5. Test:
   - Access `edit` or `update` methods without being "authenticated." You should receive a 401 error.
