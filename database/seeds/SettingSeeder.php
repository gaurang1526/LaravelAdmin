<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'id' => 1,
            'sitename' => 'Admin Web',
            'logo' => 'AdminLTELogo.png',
            'small_logo' => 'AdminLTELogo.png',
            'address' => 'Tridhya Tech Pvt. Ltd. Ahmedabad',
            'contact_number' => '1234567890',
            'primary_color' => '#007bff',
            'secondary_color' => '#6c757d',
        ]);
    }
}
