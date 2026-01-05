# PHP_Laravel12_Database_Seeder

# Step 1 : Install Laravel 12 and Create project
# Use command
```php
Composer create-project laravel/laravel  PHP_Laravel12_Database_Seeder
```
# Step 2: Setup database for.env file
```php
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=your database name
 DB_USERNAME=root
 DB_PASSWORD=
 ```
# Step 3: Create seeder  command
```php
php artisan make:seeder AdminUserSeeder
```
```php

<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
  
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Hardik',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
```
# Step 4:Run migration and single seeder for terminal
```php
php  artisan migrate
```
```php

php artisan db:seed --class=AdminUserSeeder
```
<img width="1576" height="407" alt="image" src="https://github.com/user-attachments/assets/2387c6d0-5fb3-4687-a584-a72a13f681fd" />

 

