<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        Question::updateOrCreate(
            ['title' => 'First name'],
            [
                'slug' => 'first_name',
                'description' => 'Please set first name?',
                'required' => true,
                'type' => Question::STRING_TYPE,
                'min' => 3,
                'max' => 128
            ]
        );
        Question::updateOrCreate(
            ['title' => 'Last name'],
            [
                'slug' => 'last_name',
                'description' => 'Please insert first name?',
                'required' => true,
                'type' => Question::STRING_TYPE,
                'min' => 3,
                'max' => 64
            ]
        );
        Question::updateOrCreate(
            ['title' => 'Date of birth'],
            [
                'slug' => 'birthday',
                'description' => 'Please insert your birthday?',
                'required' => true,
                'type' => Question::DATE_TYPE,
            ]
        );
        Question::updateOrCreate(
            ['title' => 'Gender'],
            [
                'slug' => 'gender',
                'description' => 'Please choose your gender?',
                'required' => true,
                'type' => Question::STRING_TYPE,
                'min' => 3,
                'max' => 30
            ]
        );
        Question::updateOrCreate(
            ['title' => 'Country'],
            [
                'slug' => 'country',
                'description' => 'Please choose your country?',
                'required' => true,
                'type' => Question::STRING_TYPE,
            ]
        );
        Question::updateOrCreate(
            ['title' => 'State'],
            [
                'slug' => 'state',
                'description' => 'Please choose your state?',
                'required' => true,
                'type' => Question::STRING_TYPE,
                'min' => 3,
                'max' => 128
            ]
        );
        Question::updateOrCreate(
            ['title' => 'City'],
            [
                'slug' => 'city',
                'description' => 'Please choose your city?',
                'required' => true,
                'type' => Question::STRING_TYPE,
                'min' => 3,
                'max' => 128
            ]
        );
        Question::updateOrCreate(
            ['title' => 'Zip code'],
            [
                'slug' => 'zip_code',
                'description' => 'Please insert zip code?',
                'required' => true,
                'type' => Question::STRING_TYPE,
                'min' => 5,
                'max' => 5
            ]
        );
        Question::updateOrCreate(
            ['title' => 'Some other question'],
            [
                'slug' => 'some_question',
                'description' => 'Example of not required question?',
                'required' => false,
                'type' => Question::STRING_TYPE,
                'min' => 3,
                'max' => 128
            ]
        );
    }
}
