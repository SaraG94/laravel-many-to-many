<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techs = ['css','html','bootstrap', 'js', 'vue', 'sql', 'php', 'laravel'];
        
        foreach($techs as $tech_name){
            $tech =new Technology();

            $tech->nome = $tech_name;
            $tech->slug = Str::slug($tech_name);

            $tech->save();
        }
    }
}
