<?php

use Illuminate\Support\Facades\Route;

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




Route::get('/p1', function () {

    $employees = collect([
        [
            'name' => 'John',
            'email' => 'john3@example.com',
            'sales' => [
                ['customer' => 'The Blue Rabbit Company', 'order_total' => 7444],
                ['customer' => 'Black Melon', 'order_total' => 1445],
                ['customer' => 'Foggy Toaster', 'order_total' => 700],
            ],
        ],
        [
            'name' => 'Jane',
            'email' => 'jane8@example.com',
            'sales' => [
                ['customer' => 'The Grey Apple Company', 'order_total' => 203],
                ['customer' => 'Yellow Cake', 'order_total' => 8730],
                ['customer' => 'The Piping Bull Company', 'order_total' => 3337],
                ['customer' => 'The Cloudy Dog Company', 'order_total' => 5310],
            ],
        ],
        [
            'name' => 'Dave',
            'email' => 'dave1@example.com',
            'sales' => [
                ['customer' => 'The Acute Toaster Company', 'order_total' => 1091],
                ['customer' => 'Green Mobile', 'order_total' => 2370],
            ],
        ],
    ]);
    
    $collection= $employees->pluck('sales.*.order_total','name');
    
    $collection = $collection->map(function($value,$key){
        return $key = max($value);
    });
    $employeeName = array_key_first($collection->sort()->reverse()->toArray());
    
    return $employeeName;
    
    });


Route::get('/p2', function () {

    $scores = collect ([
        ['score' => 76, 'team' => 'A'],
        ['score' => 62, 'team' => 'B'],
        ['score' => 82, 'team' => 'C'],
        ['score' => 86, 'team' => 'D'],
        ['score' => 91, 'team' => 'E'],
        ['score' => 67, 'team' => 'F'],
        ['score' => 67, 'team' => 'G'],
        ['score' => 82, 'team' => 'H'],
    ]);

$groupedByValue = $scores->sortByDesc('score')->groupBy('score')->collapse();


$hashMap = $groupedByValue->pluck('score');

$groupedByValue=$groupedByValue->map(function ($value, $key) use ($hashMap) { 

    return ["Team"=>$value['team'],"Score" => $value['score'], "Rank" =>$hashMap->search($value['score'])+1];
});

return($groupedByValue);
   
});



