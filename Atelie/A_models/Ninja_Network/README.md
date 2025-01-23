Got it! Let's focus on the **first 5 examples** in detail:

---

### 1. **Global Scopes**

A **global scope** allows you to apply a query condition automatically to **every query** made for a model. This is useful for applying consistent filtering across all queries.

#### Use Case:
Imagine you have a `User` model with an `active` column. You want to ensure that only active users are retrieved unless explicitly overridden.

#### Implementation:
1. Create a `Scope` class:
   ```php
   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Database\Eloquent\Scope;

   class ActiveScope implements Scope
   {
       public function apply(Builder $builder, Model $model)
       {
           $builder->where('active', 1);
       }
   }
   ```

2. Apply the scope in your model:
   ```php
   use Illuminate\Database\Eloquent\Model;

   class User extends Model
   {
       protected static function booted()
       {
           static::addGlobalScope(new ActiveScope());
       }
   }
   ```

3. Now, every query on `User` will include `where('active', 1)` by default:
   ```php
   // Automatically adds "where active = 1"
   $users = User::all();
   ```

4. To override the global scope, use `withoutGlobalScope`:
   ```php
   $allUsers = User::withoutGlobalScope(ActiveScope::class)->get();
   ```

---

### 2. **Custom Eloquent Collections**

By default, when you query a model, the result is returned as an instance of `Illuminate\Database\Eloquent\Collection`. You can customize this collection by extending the `Collection` class and overriding the `newCollection` method in your model.

#### Use Case:
Suppose you want to add a method to filter active users directly from a collection.

#### Implementation:
1. Create a custom collection class:
   ```php
   use Illuminate\Database\Eloquent\Collection;

   class UserCollection extends Collection
   {
       public function active()
       {
           return $this->filter(fn($user) => $user->active);
       }
   }
   ```

2. Modify the model to use the custom collection:
   ```php
   class User extends Model
   {
       public function newCollection(array $models = [])
       {
           return new UserCollection($models);
       }
   }
   ```

3. Usage:
   ```php
   $users = User::all();
   $activeUsers = $users->active(); // Calls the custom method
   ```

---

### 3. **Mutators and Accessors**

Mutators and accessors allow you to customize how you interact with model attributes. Accessors let you modify attribute values when they are retrieved, while mutators modify attribute values before they are saved to the database.

#### Accessor:
Customizes the value when retrieved.

1. Example:
   ```php
   class User extends Model
   {
       public function getFullNameAttribute()
       {
           return "{$this->first_name} {$this->last_name}";
       }
   }
   ```

2. Usage:
   ```php
   $user = User::find(1);
   echo $user->full_name; // Automatically combines first_name and last_name
   ```

---

#### Mutator:
Customizes the value before saving.

1. Example:
   ```php
   class User extends Model
   {
       public function setPasswordAttribute($value)
       {
           $this->attributes['password'] = bcrypt($value);
       }
   }
   ```

2. Usage:
   ```php
   $user = new User();
   $user->password = 'plainpassword'; // Automatically hashes the password
   $user->save();
   ```

---

### 4. **Query Scopes**

Query scopes allow you to define reusable query conditions as methods in your model. There are two types:
- **Local Scopes** (most common)
- **Dynamic Scopes**

#### Local Scope:
1. Add a scope method in your model:
   ```php
   class User extends Model
   {
       public function scopeActive($query)
       {
           return $query->where('active', 1);
       }

       public function scopeCreatedThisMonth($query)
       {
           return $query->whereMonth('created_at', now()->month);
       }
   }
   ```

2. Usage:
   ```php
   $activeUsers = User::active()->get();
   $usersThisMonth = User::active()->createdThisMonth()->get();
   ```

---

#### Dynamic Scope:
You can also pass parameters to scopes for more flexibility.

1. Example:
   ```php
   class User extends Model
   {
       public function scopeOfType($query, $type)
       {
           return $query->where('type', $type);
       }
   }
   ```

2. Usage:
   ```php
   $admins = User::ofType('admin')->get();
   ```

---

### 5. **Custom Relationships**

Eloquent relationships are powerful, but sometimes you need to add custom logic to them. Laravel allows you to create custom relationship methods.

#### Use Case:
Retrieve a user's most recent or most liked post.

#### Implementation:
1. Add custom relationships in your model:
   ```php
   class User extends Model
   {
       public function latestPost()
       {
           return $this->hasOne(Post::class)->latestOfMany();
       }

       public function mostLikedPost()
       {
           return $this->hasOne(Post::class)->ofMany('likes', 'max');
       }
   }
   ```

2. Usage:
   ```php
   $user = User::find(1);
   $latestPost = $user->latestPost; // Gets the user's latest post
   $mostLikedPost = $user->mostLikedPost; // Gets the user's most liked post
   ```

#### Advanced Example:
If you want to filter posts by a specific condition:
```php
class User extends Model
{
    public function postsByCategory($categoryId)
    {
        return $this->hasMany(Post::class)->where('category_id', $categoryId);
    }
}
```

Usage:
```php
$user = User::find(1);
$techPosts = $user->postsByCategory(3)->get(); // Posts in category 3
```

---

Let me know which of these you’d like to dive even deeper into, or if you want examples tailored to a specific scenario!