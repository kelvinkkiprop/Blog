<?php

use Illuminate\Database\Seeder;

//Add
use App\Other\PostCategory;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Defaults
         $post_categories = [
            ['name'=>'Agriculture'],
            ['name'=>'Architecture'],
            ['name'=>'Arts'],
            ['name'=>'Books & Literature'],
            ['name'=>'Building & Construction'],
            ['name'=>'Business & Economics'],
            ['name'=>'Charity/Aid/Welfare'],
            ['name'=>'Defence'],
            ['name'=>'Education & Training'],
            ['name'=>'Employment'],
            ['name'=>'Energy'],
            ['name'=>'Engineering'],
            ['name'=>'Entertainment'],
            ['name'=>'Environment'],
            ['name'=>'Ethnic'],
            ['name'=>'Elections'],
            ['name'=>'Fitness & Exercise'],
            ['name'=>'Food & Beverage'],
            ['name'=>'Trade, Manufacturing & Industralization'],
            ['name'=>'Games & Gaming'],
            ['name'=>'Gambling'],
            ['name'=>'Government & Legal'],
            ['name'=>'Hospitality'],
            ['name'=>'Human Resources'],
            ['name'=>'Immigration'],
            ['name'=>'Indigenous'],
            ['name'=>'Information Technology (IT)'],
            ['name'=>'Insurance'],
            ['name'=>'Lifestyle '],
            ['name'=>'News'],
            ['name'=>'Media'],
            ['name'=>'Medical'],
            ['name'=>'Oil & Mining'],
            ['name'=>'People'],
            ['name'=>'Photography'],
            ['name'=>'Police, Crime & Courts'],
            ['name'=>'Property & Real Estate'],
            ['name'=>'Real stories'],
            ['name'=>'Regions & Countries'],
            ['name'=>'Religion'],
            ['name'=>'Research & Development'],
            ['name'=>'Retail/Online Retail'],            
            ['name'=>'Science'],
            ['name'=>'Shows'],
            ['name'=>'Sport'],
            ['name'=>'Talk'],
            ['name'=>'Tech'],
            ['name'=>'Transport'],
            ['name'=>'Travel & Tourism'],
            ['name'=>'Weather'],
            ['name'=>'Wedding'],
            ['name'=>'Writing'],
            ['name'=>'Youth']            
        ];
        PostCategory::insert($post_categories);  
    }
}
