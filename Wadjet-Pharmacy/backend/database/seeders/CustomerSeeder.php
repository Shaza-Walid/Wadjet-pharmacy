<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'Yasmin Hassan', 'email' => 'yasmin.hassan@gmail.com', 'phone' => '01012345001', 'address' => '12 Al Nasr St, Nasr City, Cairo'],
            ['name' => 'Omar Khaled', 'email' => 'omar.khaled@gmail.com', 'phone' => '01098765002', 'address' => '5 Al Horreya Rd, Sharqia'],
            ['name' => 'Nourhan Samir', 'email' => 'nourhan.samir@gmail.com', 'phone' => '01123456003', 'address' => '34 Corniche St, Alexandria'],
            ['name' => 'Ahmed Mostafa', 'email' => 'ahmed.mostafa@gmail.com', 'phone' => '01234567004', 'address' => '8 Gamaet El Dewal St, Giza'],
            ['name' => 'Salma Tarek', 'email' => 'salma.tarek@gmail.com', 'phone' => '01055512005', 'address' => '21 Tahrir St, Downtown, Cairo'],
            ['name' => 'Mahmoud Reda', 'email' => 'mahmoud.reda@gmail.com', 'phone' => '01166612006', 'address' => '17 Al Thawra St, Sharqia'],
            ['name' => 'Hana Ibrahim', 'email' => 'hana.ibrahim@gmail.com', 'phone' => '01277712007', 'address' => '3 Abbas El Akkad St, Nasr City'],
            ['name' => 'Youssef Adel', 'email' => 'youssef.adel@gmail.com', 'phone' => '01088812008', 'address' => '9 Sultan Hussein St, Alexandria'],
            ['name' => 'Rana Fathy', 'email' => 'rana.fathy@gmail.com', 'phone' => '01199912009', 'address' => '45 Makram Ebeid St, Nasr City'],
            ['name' => 'Karim Nabil', 'email' => 'karim.nabil@gmail.com', 'phone' => '01011112010', 'address' => '6 El Merghany St, Heliopolis'],
            ['name' => 'Dina Wael', 'email' => 'dina.wael@gmail.com', 'phone' => '01022212011', 'address' => '27 Talaat Harb St, Downtown, Cairo'],
            ['name' => 'Tarek Fouad', 'email' => 'tarek.fouad@gmail.com', 'phone' => '01033312012', 'address' => '14 Port Said St, Zagazig, Sharqia'],
            ['name' => 'Marwa Ashraf', 'email' => 'marwa.ashraf@gmail.com', 'phone' => '01044412013', 'address' => '2 Al Geish St, Faisal, Giza'],
            ['name' => 'Amr Sameh', 'email' => 'amr.sameh@gmail.com', 'phone' => '01055512014', 'address' => '31 El Nozha St, Sharqia'],
            ['name' => 'Nadine Emad', 'email' => 'nadine.emad@gmail.com', 'phone' => '01156739854', 'address' => '19 Fouad St, Alexandria'],
        ];

        foreach ($customers as $customer) {
            Customer::create([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
                'address' => $customer['address'],
                'password' => 'password123',
            ]);
        }
    }
}