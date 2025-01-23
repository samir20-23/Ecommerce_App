### **Service Injection**

**Goal:**  
Create a service that fetches data from a dummy array and inject it into a controller.

**Steps:**

1. Create a service class:
   ```php
   namespace App\Services;

   class ArticleService
   {
       private $articles = [
           1 => ['title' => 'First Article', 'content' => 'This is the first article.'],
           2 => ['title' => 'Second Article', 'content' => 'This is the second article.'],
       ];

       public function getAllArticles()
       {
           return $this->articles;
       }

       public function getArticleById($id)
       {
           return $this->articles[$id] ?? null;
       }
   }
   ```

2. Update `ArticleController` to use the service:
   ```php
   namespace App\Http\Controllers;

   use App\Services\ArticleService;

   class ArticleController extends Controller
   {
       private $articleService;

       public function __construct(ArticleService $articleService)
       {
           $this->articleService = $articleService;
       }

       public function index()
       {
           return response()->json($this->articleService->getAllArticles());
       }

       public function show($id)
       {
           $article = $this->articleService->getArticleById($id);

           if ($article) {
               return response()->json($article);
           }

           return response()->json(['error' => 'Article not found.'], 404);
       }
   }
   ```

3. Test:
   - Visit `/articles` to see all articles.
   - Visit `/articles/1` to see a specific article.

