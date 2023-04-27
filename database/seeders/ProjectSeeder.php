<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<10; $i++) {
            $project = new Project();

            $project->titolo =  $faker->unique()->sentence($faker->numberBetween(3, 5));
            $project->cliente = $faker->sentence(2,true);
            $project->descrizione = $faker->optional()->text(500);
            $project->link = $faker->url();
            $project->slug = Str::slug($project->titolo, '-');
            $project->save();
        }
    }
}
