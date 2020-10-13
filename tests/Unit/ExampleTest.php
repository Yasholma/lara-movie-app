<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    private $users;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = collect([
            ['id' => 1, 'name' => 'Joe', 'age' => 8, 'salary' => 30],
            ['id' => 2, 'name' => 'Mark', 'age' => 10, 'salary' => 20],
            ['id' => 3, 'name' => 'Smith', 'age' => 12, 'salary' => 45],
        ]);
    }


    /** @test */
    public function get_the_average_of_a_user()
    {
        // $totalAge = 0;
        // foreach ($users as $user) {
        //     $totalAge += $user['age'];
        // }

        // $avgAge = $totalAge / count($users);

        $avgAge = $this->users->average('age');

        $this->assertEquals(10, $avgAge);
    }

    /** @test */
    public function the_array_contains_a_user_with_a_given_age()
    {
        $containsSomeValue = false;

        // foreach ($this->users as $user) {
        //     if ($user['age'] === 8) {
        //         $containsSomeValue = true;
        //         break;
        //     }
        // }

        // $containsSomeValue = $this->users->contains(function ($u) {
        //     return $u['age'] === 12;
        // });

        // $containsSomeValue = $this->users->contains(fn ($u) => $u['age'] === 12);

        $containsSomeValue = $this->users->contains('age', 12);

        $this->assertTrue($containsSomeValue);
    }

    /** @test */
    public function get_the_lowest_age_of_a_user()
    {
        $minAge = $this->users->min('age');

        dump($minAge);

        $this->assertEquals(8, $minAge);
    }

    /** @test */
    public function can_find_the_mode()
    {
        $array = [1, 2, 3, 4, 3, 2, 1, 2, 1, 2, 3, 2, 6, 7, 8];

        // $frequent = [];

        // foreach ($array as $item) {
        //     if (!isset($frequent[$item])) {
        //         $frequent[$item] = 0;
        //     }
        //     $frequent[$item]++;
        // }

        // arsort($frequent);
        // $mode = array_key_first($frequent);

        $mode = collect($array)->mode()[0];

        $this->assertEquals(2, $mode);
    }

    /** @test */
    public function we_can_get_users_name()
    {
        // $usernames = [];

        // foreach ($this->users as $u) {
        //     $usernames[$u['id']] = $u['name'];
        // }

        $usernames = $this->users->pluck('name', 'id');

        $this->assertEquals('Joe', $usernames[1]);
        $this->assertEquals('Mark', $usernames[2]);
    }

    /** @test */
    public function we_can_get_the_total_users_salary()
    {
        $totalSalary = $this->users->pluck('salary')->reduce(
            fn ($total, $curr) =>
            $total + $curr,
            0
        );

        $this->assertEquals(95, $totalSalary);
    }

    /** @test */
    public function we_only_unique_results()
    {
        $people = ['John', 'Glene', 'Glene', 'John', 'Sarah', 'Queen'];

        $uniquePeople = collect($people)->unique();

        $this->assertEquals(4, $uniquePeople->count());
        $this->assertContains('John', $uniquePeople);
    }
}
