<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class CollectionExample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collection:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function example()
    {
        /** all() and toArray() */
        // dump(collect([1, 2, 3, 4])->all());
        // dump(collect([
        //     collect([4, 5, 6, 6]),
        //     collect([2, 3, 4, 5])
        // ])->toArray());

        /** average() */
        // $data = [10, 20, 40, 50];
        // dump("Average " . collect($data)->average());
        // $data = [
        //     ["price" => 10, "tax" => 500, "active" => true],
        //     ["price" => 20, "tax" => 100, "active" => false],
        //     ["price" => 30, "tax" => 200, "active" => true],
        // ];
        // dump(collect($data)->average(function ($value) {
        //     if ($value['active']) {
        //         return $value['price'] + $value['tax'];
        //     }
        // }));

        // dump(
        //     collect($data)
        //         ->filter(fn ($value) => $value['active'])
        //         ->average(fn ($value) => $value['price'] + $value['tax'])
        // );

        /** Chunk */
        // $data = [1, 2, 3, 4, 5];
        // // dump(collect($data)->chunk(4)->first()->toArray());
        // dump(collect($data)->chunk(4)->toArray());

        /** Chunk */
        // $data = [
        //     collect([4, 5, 6, 6, collect([1, 2, 3, 4])]),
        //     collect([2, 3, 4, 5])
        // ];
        // dump(collect($data)->collapse());

        /** Chunk */
        // $data = [
        //     'name',
        //     'age'
        // ];
        // dump(collect($data)->combine(['John Doe', 26]));

        /** Concat */
        // $data = [
        //     'name',
        //     'age'
        // ];
        // dump(collect($data)->concat(['John Doe', 26]));
        // dump(collect(['John Doe', 26, ...$data]));

        /** Contains and ContainsStrict */
        // dump(collect([
        //     ['key' => 'value']
        // ])->contains('key', 'value'));

        // Similar to some in JS
        // dump(collect([1, 2, 3, 4, 5])->contains(function ($value, $key) {
        //     return $value > 4;
        // }));

        // dump(collect(['0020'])->contains(20));
        // dump(collect(['20'])->containsStrict(20));

        /** count */
        // $data = [1, 2 => [8, 9], 3, 5];

        // return collect($data)->count();

        /** crossjoin */
        // $collection = collect([1, 2]);
        // $list = ['a', 'b'];
        // return $collection->crossJoin(['a', 'b'], ['c', 'd']);
        // $collection = collect(['Honda', 'Toyota', 'Benz']);

        // return $collection->crossJoin(['automatic', 'manual'], ['white', 'black'])->count();

        /** dd */
        // return collect([1, 2, 3, 4])->dump()
        //     ->map(function ($item) {
        //         return $item * 3;
        //     })->dump()
        //     ->mapWithKeys(function ($item) {
        //         return [$item + 10 => $item];
        //     })->reverse();

        // Reversing a string in php
        // return collect(str_split("Hello World"))->reverse()->join("");

        /** diff */
        // $collection = collect([1, 2, 3, 4]);
        // return $collection->diff([2, 4, 6]);

        // $fruitsColl = collect([10 => 'apple', 20 => 'banana', 25 => "orange"]);
        // return $fruitsColl->diffAssoc([20 => "banana", 25 => "orange"]);
        // return $fruitsColl->diffKeys([20 => "banana", 25 => "oranges"]);

        /** diffUsing | diffAssocUsing */
        // $collection = collect([10 => "Apples", 25 => "Oranges", 50 => "Mango"]);
        // return $collection->diffKeys([.1, .25], function ($a, $b) {
        //     return $a === (int)($b * 100) ? 0 : -1;
        // });

        // return $collection->diffAssocUsing(['.1' => "Apples", '.25' => "Oranges"], function ($a, $b) {
        //     return $a === (int)($b * 100) ? 0 : -1;
        // });

        // return $collection->diffKeysUsing(['.1' => "Apples", '.25' => "Oranges"], function ($a, $b) {
        //     return $a === (int)($b * 100) ? 0 : -1;
        // });

        // $users = collect(['user-345', 'user-222', 'user-123']);

        // return $users->diffUsing(['user222'], function ($source, $it) {
        //     $inUser = str_replace("-", "", $source);
        //     return $inUser === $it ? 0 : -1;
        // });

        /** each and eachSpread */
        // return collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->each(function ($value) {
        //     dump($value);
        // });

        // return collect([
        //     ['honda', 'uk', 34],
        //     ['toyota', 'france', 21],
        //     ['benz', 'nigeria', 10],
        // ])->eachSpread(function ($model, $loc, $num) {
        //     dump("I have {$num} {$model} in {$loc}");
        // });

        /** filter */
        // return collect([1, 2, 3, 4, "", 0, false, null])->filter();

        /** first */
        // return collect([1, 2, 3, 4, 5])->first(function ($item) {
        //     return $item % 5 == 0;
        // }, 1);

        /** firstWhere */
        // return collect([
        //     ['name' => 'honda', 'loc' => 'uk',  'num' => 34],
        //     ['name' => 'toyota', 'loc' => 'china',  'num' => 10],
        //     ['name' => 'benz', 'loc' => 'us',  'num' => 20],
        // ])->firstWhere('num', '>', 10);

        /** groupBy */
        // return collect([
        //     ['product' => 'apples', 'price' => 10],
        //     ['product' => 'orange', 'price' => 20],
        //     ['product' => 'mangoes', 'price' => 30],
        //     ['product' => 'guava', 'price' => 30],
        // ])->groupBy('price');

        /** isEmpty | isNotEmpty */
        // return collect([12, 3])->isEmpty();
        // return collect([null])->isNotEmpty();

        /** last */ // opposite of first

        /** mapInto */
        // return collect([1, 2, 3, 4])->mapInto(Converter::class)->map(function ($item) {
        //     return $item->toCentemeters();
        // });

        // return collect([1, 2, 3, 4, 5, 6, 7])
        //     ->chunk(2)
        //     ->mapSpread(function ($a, $b) {
        //         return $a * $b;
        //     });

        // return collect([1, 2, 5, 10, 16, 3, 4])->max();
        // return collect([1, 2, 5, 10, 16, 3, 4, 8])->sort()->dump()->median();

        // return collect([1, 2, 3, 4])->nth(2, 1);

        // return collect([1, 2, 3, 4])->only(1, 0, 3);

        // return collect([
        //     ["product" => "apples", "price" => 50, "qty" => 5],
        //     ["product" => "banana", "price" => 20, "qty" => 100],
        //     ["product" => "orange", "price" => 200, "qty" => 25],
        //     ["product" => "lemon", "price" => 40, "qty" => 15],
        // ])->map(function ($item) {
        //     return Arr::only($item, ['product', 'price', 'qty']);
        // });

        // return collect([1, 2, 3, 4])->reverse()->values();

        // return collect([
        //     ['product' => 'hp', 'price' => 200],
        //     ['product' => 'mac', 'price' => 300],
        //     ['product' => 'dell', 'price' => 220],
        // ])->sortByDesc('price');

        // return collect([1, 2, 3, 4])->take(2);

        // return collect([1, 2, 3, 4])->reverse()->tap(function ($collection) {
        //     return $collection
        //         ->reverse()
        //         ->dump()
        //         ->each(function ($val) {
        //             dump($val);
        //         });
        // });

        // $range = Collection::times(5, function () {
        //     return factory(User::class)->make([
        //         Hash::make('password')
        //     ]);
        // })->toArray();

        // return $range;

        // return collect([1, 2, 3, 5])->toJson(JSON_PRETTY_PRINT);

        // return Collection::unwrap($this->;);
        // return $this->mergeArray([1, 2], [2, 3]);
        $data = [
            ['product' => 'apple', 'price' => '60',],
            ['product' => 'banana', 'price' => '80',],
            ['product' => 'orange', 'price' => '55',],
            ['product' => 'mango', 'price' => '90',],
            ['product' => 'lemon', 'price' => '50',]
        ];
        // return collect(
        //     $data
        // )->whereBetween('price', [55, 80]);

        // return collect($data)->whereNotBetween('price', [55, 80]);

        // return collect($data)->mapWithKeys(function ($value, $key) {
        //     return [$key => $value];
        // })->dump();
    }

    public function mergeArray($arr1, $arr2)
    {
        return array_merge($arr1, $arr2);
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dump($this->example());
    }
}

class Converter
{
    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function toCentemeters()
    {
        return $this->amount * 2.54;
    }
}
