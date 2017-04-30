<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Owner;
use App\Car;
use App\Phone;
use App\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call('UserTableSeeder');
        //$this->call('OwnerTableSeeder');
        //$this->call('CarsTableSeeder');
        //$this->call('PhonesTableSeeder');
        $this->call('PaymentsTableSeeder');
    }
}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        User::create(['name' => 'Edson Santos', 'email' => 'edson.santos@gmail.com', 'password' => 'debora']);
        User::create(['name' => 'Evelin Xavier', 'email' => 'evelin.xavier@gmail.com', 'password' => '123456']);

    }
}

class OwnerTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('owners')->delete();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++)
        {
            Owner::create([
                'name' => $faker->name($gender = null|'male'|'female'),
                'address' => $faker->address,
                'sector' => $faker->word,
                'payday' => $faker->numberBetween($min = 1, $max = 31),
                'value' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
                'obs' => $faker->text($maxNbChars = 500),
                'timetable' => 'Seg à Sex das 07:00h às 14:00h'
            ]);
        }
    }
}

class CarsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('cars')->delete();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 200; $i++)
        {
            Car::create([
                'brand' => $faker->word,
                'model' => $faker->word,
                'color' => $faker->colorName,
                'plate' => $faker->bothify('???-####'),
                'image' => $faker->lexify('???????????????.jpg'),
                'owner' => $faker->numberBetween($min = 1, $max = 199)
            ]);
        }
    }
}

class PhonesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('phones')->delete();

        $faker = Faker\Factory::create();

        $type = array(1, 2);

        $company = array('Oi', 'TIM', 'Vivo', 'Claro', 'Nextel', 'Correiros', 'PortoTelecon');

        for($i = 0; $i < 200; $i++)
        {
            Phone::create([
                'number' => $faker->bothify('####-####'),
                'type' => $type[array_rand($type)],
                'company' => $company[array_rand($company)],
                'owner_id' => $faker->numberBetween($min = 1, $max = 199)
            ]);
        }
    }
}

class PaymentsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('payments')->delete();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 200; $i++)
        {
            Payment::create([
                'owner_id'     => $faker->numberBetween($min = 1, $max = 199),
                'payment_date' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
                'amount'       => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            ]);
        }
    }
}