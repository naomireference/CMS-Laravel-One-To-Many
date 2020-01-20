<?php

use App\Post;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
ONE TO MANY RELATIONSHIP CRUD

    //Step 1:
        php artisan make:model Post -m

    //Step 2: Add code to 'database/migrations/2020_01_20_063501_create_posts_table.php':
        $table->integer('user_id')->unsigned()->nullable()->index();
        $table->string('title');
        $table->text('body');

    //Step 3:
        php artisan migrate

    //Step 4: Add code to 'app/User.php'
        public function posts(){
            return $this->hasMany('App\Post');
        }

    //Step 5: Add code to 'app/Post.php"
        protected $fillable = ['title', 'body'];
*/
    
    //Routes:
    //I. Inserting Data
        Route::get('/create', function(){
            $user = User::findOrFail(1);

            $post = new Post(['title'=>'My first post with Edwin Diaz 2', 'body'=>'I love Laravel with Edwin Diaz 2']);
            
            $user->posts()->save($post);

            echo "created";
        });

    //II. Reading Data
        Route::get('/read', function(){
            $user = User::findOrFail(1);

            foreach($user->posts as $post){
                echo $post->title . "<br>";
            }
        });

    //III. Updating Data
        Route::get('/update', function(){
            $user = User::find(1);
            $user->posts()->whereId(1)->update(['title'=>'I love Laravel', 'body'=>'This is awesome, thank you Edwin']);

            echo "updated";
        });