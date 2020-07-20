<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate();

        for ($i = 1; $i <= 20; $i++) {

            Contact::create([
                'name' => "Pepe $i",
                'surname' => "Perez $i",
                'message' => 'A CKEditor 5 build compiles a specific editor class and a set of plugins. Using builds is the simplest way to include the editor in your application, but you can also use the editor classes and plugins directly for greater flexibility.',
                'email' => 'miemail@gmail.com'
            ]);
        }
    }
}
