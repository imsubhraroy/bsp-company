<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // India
        $india = Country::create(['name' => 'India', 'code' => 'IN']);

        $maharashtra = State::create(['country_id' => $india->id, 'name' => 'Maharashtra']);
        City::create(['state_id' => $maharashtra->id, 'name' => 'Mumbai']);
        City::create(['state_id' => $maharashtra->id, 'name' => 'Pune']);
        City::create(['state_id' => $maharashtra->id, 'name' => 'Nagpur']);

        $karnataka = State::create(['country_id' => $india->id, 'name' => 'Karnataka']);
        City::create(['state_id' => $karnataka->id, 'name' => 'Bangalore']);
        City::create(['state_id' => $karnataka->id, 'name' => 'Mysore']);
        City::create(['state_id' => $karnataka->id, 'name' => 'Mangalore']);

        $delhi = State::create(['country_id' => $india->id, 'name' => 'Delhi']);
        City::create(['state_id' => $delhi->id, 'name' => 'New Delhi']);
        City::create(['state_id' => $delhi->id, 'name' => 'Central Delhi']);
        City::create(['state_id' => $delhi->id, 'name' => 'South Delhi']);

        $bengal = State::create(['country_id' => $india->id, 'name' => 'West Bengal']);
        City::create(['state_id' => $bengal->id, 'name' => 'Kolkata']);
        City::create(['state_id' => $bengal->id, 'name' => 'Howrah']);
        City::create(['state_id' => $bengal->id, 'name' => 'Darjeeling']);
    }
}
