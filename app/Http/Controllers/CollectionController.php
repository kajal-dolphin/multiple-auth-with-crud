<?php

namespace App\Http\Controllers;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function practiceCollection()
    {   
        //collect() :- Create Collection from an array :- 
        // $createCollection = collect([1, 2, 3]);
        // dd($createCollection);



        //chunk() :- The chunk method breaks the collection into multiple, smaller collections of a given size
        // $chunks = collect([1, 2, 3, 4, 5, 6, 7])->chunk(4);
        // dd($chunks);



        //count() :- The count method returns the total number of items in the collection
        // $countItems = collect([1, 2, 3, 4])->count();
        // dd($countItems);



        //dd() :- The dd method dumps the collection's items and ends execution of the script
        // $dumpOrDie = collect([1, 2, 3, 4]);
        // dd($dumpOrDie);



        // each() :- The each method iterates over the items in the collection and passes each item to a closure
        // $cities = new Collection([
        //     'London', 'Paris', 'New York', 'Toranto', 'Tokyo'
        // ]);

        // $cities->each(function($item, $key) {
        //     // Print each city name
        //     echo $item;
        //     echo "</br>";
        // });



        //filter() :- The filter method filters the collection using the given callback, keeping only those items that 	pass a given truth test
        // $collection = collect([1, 2, 3, 4]);
 
        // $filtered = $collection->filter(function (int $value, int $key) {
        //             return $value > 2;
        // });
    
        // dd($filtered->all());

        // => If no callback is supplied, all entries of the collection that are 	equivalent 	to false will be removed:
	
        //$collection = collect([1, 2, 3, null, false, '', 0, []])->filter()->all();


        //all() :- The all method returns the underlying array represented by the collection
        // $all = collect([1, 2, 3])->all();
        // dd($all);



        //first() :- The first method returns the first element in the collection that passes a given truth test
        // $first = collect([1, 2, 3, 4])->first(function (int $value, int $key) {
        //     return $value > 2;
        // });
        // dd($first);



        //get() :- The get method returns the item at a given key. If the key does not exist, null is returned
        // $get = collect(['name' => 'taylor', 'framework' => 'laravel'])->get('name');
        // dd($get);



        //groupby() :- The groupBy method groups the collection's items by a given key:
        // $collection = collect([
        //     ['account_id' => 'account-x10', 'product' => 'Chair'],
        //     ['account_id' => 'account-x10', 'product' => 'Bookcase'],
        //     ['account_id' => 'account-x11', 'product' => 'Desk'],
        // ]);

        // $groupby = $collection->groupBy('account_id');
        // dd($groupby);



        //implode :- The implode method joins items in a collection. Its arguments depend on the type of items in the collection. 
        //If the collection contains arrays or objects,
        // you should pass the key of the attributes you wish to join, and the "glue" string you wish to place between the values

        // $implode = collect([
        //     ['account_id' => 1, 'product' => 'Desk'],
        //     ['account_id' => 2, 'product' => 'Chair'],
        // ])->implode('product', ', ');
        
        // dd($implode);



        //isEmpty() :- The isEmpty method returns true if the collection is empty; otherwise, false is returned
        // $isEmpty = collect([])->isEmpty();
        // dd($isEmpty);



        // isNotEmpty :- The isNotEmpty method returns true if the collection is not empty; otherwise, false is returned
        //$isNotEmpty = collect([])->isNotEmpty();
        //dd($isNotEmpty);



        //last :- The last method returns the last element in the collection that passes a given truth test
        // $last = collect([1, 2, 3, 4])->last();
        // dd($last);


        

        //map :- The map method iterates through the collection and passes each value to the given callback.
        // The callback is free to modify the item and return it, thus forming a new collection of modified items

        // $collection = collect([1, 2, 3, 4, 5]);
		// $map = $collection->map(function (int $item, int $key) {
        //     return $item * 2;
        // })->all();

        // dd($map);



        //only :- The only method returns the items in the collection with the specified keys
        // $only = collect([
        //     'product_id' => 1,
        //     'name' => 'Desk',
        //     'price' => 100,
        //     'discount' => false
        // ])->only(['product_id', 'name']);
    
        // dd($only);



        //pluck :- The pluck method retrieves all of the values for a given key
        // $pluck = collect([
        //     ['product_id' => 'prod-100', 'name' => 'Desk'],
        //     ['product_id' => 'prod-200', 'name' => 'Chair'],
        // ])->pluck('product_id','name')->all();
    
        // dd($pluck);



        // skip :- The skip method returns a new collection, with the given number of elements removed from the beginning of the collection
        // $skip = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->skip(4)->all();
        // dd($skip);



        //sortby :- The sortBy method sorts the collection by the given key
        // $collection = collect([
        //     ['name' => 'Desk', 'price' => 200],
        //     ['name' => 'Chair', 'price' => 100],
        //     ['name' => 'Bookcase', 'price' => 150],
        // ])->sortBy('price');
        
        // $sortby = $collection->values()->all();
        // dd($sortby);




        // Take :- The take method returns a new collection with the specified number of items:
        // $take = collect([0, 1, 2, 3, 4, 5])->take(3)->all();
        // dd($take);



        //toArray :- The toArray method converts the collection into a plain PHP array
        // $toArray = collect(['name' => 'Desk', 'price' => 200])->toArray();
	    // dd($toArray);



        //toJson :- The toJson method converts the collection into a JSON serialized string
        // $toJson = collect(['name' => 'Desk', 'price' => 200])->toJson();
        // dd($toJson);



        //unique :- The unique method returns all of the unique items in the collection
        // $unique = collect([1, 1, 2, 2, 3, 4, 2])->unique();
        // dd($unique);



        //where :- The where method filters the collection by a given key / value pair
        // $where = collect([
        //     ['product' => 'Desk', 'price' => 200],
        //     ['product' => 'Chair', 'price' => 100],
        //     ['product' => 'Bookcase', 'price' => 150],
        //     ['product' => 'Door', 'price' => 100],
        // ])->where('price', 100)->all();
         
        // dd($where);



        //whereIn :- The whereIn method removes elements from the collection that do not have a specified item value that is contained within the given array
        // $whereIn = collect([
        //     ['product' => 'Desk', 'price' => 200],
        //     ['product' => 'Chair', 'price' => 100],
        //     ['product' => 'Bookcase', 'price' => 150],
        //     ['product' => 'Door', 'price' => 100],
        // ])->whereIn('price', [150, 200])->all();
        
        // dd($whereIn);




        //whereNull :- The whereNull method returns items from the collection where the given key is null
        // $whereNull = collect([
        //     ['name' => 'Desk'],
        //     ['name' => null],
        //     ['name' => 'Bookcase'],
        // ])->whereNull('name')->all();
    
        // dd($whereNull);



        // ******* NUmerical Operation ********

        //avg :- The avg method returns the average value of a given key
        // $average = collect([
        //     ['foo' => 10],
        //     ['foo' => 10],
        //     ['foo' => 20],
        //     ['foo' => 40]
        // ])->avg('foo');
        // dd($average);



        //max :- The max method returns the maximum value of a given key
        // $max = collect([
        //     ['foo' => 10],
        //     ['foo' => 50]
        // ])->max('foo');
        // dd($max);



        //min :- The min method returns the minimum value of a given key
        // $min = collect([
        //     ['foo' => 10],
        //     ['foo' => 50]
        // ])->min('foo');
        // dd($min);



        //sum :- The sum method returns the sum of the value
        // $sum = collect(['10','20','30'])->sum();
        // dd($sum);



        //random :- The random method returns a random item from the collection
        // $random = collect([1, 2, 3, 4, 5])->random();
        // dd($random);




        //range :- The range method returns a collection containing integers between the specified range
        // $range = collect()->range(3, 6)->all();
        // dd($range);
 


        // Numbers in Laravel Helpers

        // Number::abbreviate()
        // The Number::abbreviate method returns the human-readable format of the provided numerical value
        // $number = Number::abbreviate(1000);



        //Number::format()
        //The Number::format method formats the given number into a locale specific string
        // $number = Number::format(100000);
        // $number = Number::format(100000, precision: 2);
        // dd($number);



        //Number::percentage()
        //The Number::percentage method returns the percentage representation of the given value as a string
        // $percentage = Number::percentage(10, precision: 2);
        // dd($percentage);



        // Number::currency()
        // The Number::currency method returns the currency representation of the given value as a string
        // $currency = Number::currency(1000, in: 'EUR');
        // dd($currency);



        // Number::fileSize()
        // The Number::fileSize method returns the file size representation of the given byte value as a string
        // $size = Number::fileSize(1024 * 1024);
        // dd($size);



        // Number::forHumans()
        // The Number::forHumans method returns the human-readable format of the provided numerical value
        // $number = Number::forHumans(489939);
        // dd($number);




        //String methods in laravel helpers 

        //contains :- The Str::contains method determines if the given string contains the given value
        // $contains = Str::contains('This is my name', 'my');
        // dd($contains);


        //length :- The Str::length method returns the length of the given string
        // $length = Str::length('Laravel');
        // dd($length);


        //lower :- The Str::lower method converts the given string to lowercase
        // $converted = Str::lower('LARAVEL');
        // dd($converted);


        //position :- The Str::position method returns the position of the first occurrence of a substring in a string. 
        //If the substring does not exist in the given string, false is returned
        // $position = Str::position('Hello, World!', 'llo');
        // dd($position);


        //random :- The Str::random method generates a random string of the specified length
        // $random = Str::random(40);
        // dd($random);


        //replace :- The Str::replace method replaces a given string within the string
        // $string = 'Laravel 8.x';
        // $replaced = Str::replace('8.x', '9.x', $string);
        // dd($replaced);


        //reverse :- The Str::reverse method reverses the given string
        // $reversed = Str::reverse('Hello World');
        // dd($reversed);


        // slug :- The Str::slug method generates a URL friendly "slug" from the given string
        // $slug = Str::slug('Laravel 5 Framework', '-');
        // dd($slug);



        // substr :- The Str::substr method returns the portion of string specified by the start and length parameters
        // $converted = Str::substr('The Laravel Framework', 3, 7);
        // dd($converted);


        //ucfirst :- The Str::ucfirst method returns the given string with the first character capitalized
        // $string = Str::ucfirst('foo bar');
        // dd($string);



        //wordCount :- The Str::wordCount method returns the number of words that a string contains
        // $wordCount = Str::wordCount('Hello, world!');
        // dd($wordCount);


        // explode :- The explode method splits the string by the given delimiter and returns a collection containing each section of the split string
        // $collection = Str::of('foo bar baz')->explode(' ');
        // dd($collection);


        //isEmpty :- The isEmpty method determines if the given string is empty
        // $isEmpty = Str::of('kajal')->isEmpty();
        // dd($isEmpty);



        // isNotEmpty :- The isNotEmpty method determines if the given string is not empty
        // $isNotEmpty = Str::of('Laravel')->isNotEmpty();
        // dd($isNotEmpty);


        //isJson :- The isJson method determines if a given string is valid JSON
        // $isJson = Str::of('{"first": "John", "last": "Doe"}')->isJson();
        // dd($isJson);



        //remove :- The remove method removes the given value or array of values from the string
        // $remove = Str::of('Arkansas is quite beautiful!')->remove('quite');
        // dd($remove);


        //trim :- The trim method trims the given string
        // $trim = Str::of('  Laravel  ')->trim();
        // dd($trim);


        //when :- The when method invokes the given closure if a given condition is true. The closure will receive the fluent string instance
        // $when = Str::of('Taylor')
        //         ->when(true, function (Stringable $string) {
        //             return $string->append(' Otwell');
        //         });
        // dd($when);

    }
}
