<?php

namespace Database\Seeders;

use App\Models\ExperienceComment;
use App\Models\ExperienceFolder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExperienceComment::create([
            'user_id' => 1,
            'experience_folder_id' => 1,
            'content' => 'こんにちは',
            'rate' => 4,
        ]);
        ExperienceComment::create([
            'user_id' => 1,
            'experience_folder_id' => 1,
            'content' => 'すばらしい！！！',
            'rate' => 5,
        ]);
        ExperienceComment::create([
            'user_id' => 1,
            'experience_folder_id' => 2,
            'content' => 'こんにちは!!!',
            'rate' => 4,
        ]);
        ExperienceComment::create([
            'user_id' => 1,
            'experience_folder_id' => 2,
            'content' => 'とても良いです',
            'rate' => 5,
        ]);
        ExperienceComment::create([
            'user_id' => 1,
            'experience_folder_id' => 3,
            'content' => 'こんにちは',
            'rate' => 4,
        ]);
        
        $folders = ExperienceFolder::all();
        foreach ($folders as $folder) {
            $experience_folder_id = $folder->id;
            $average_rate = ExperienceComment::where('experience_folder_id', $experience_folder_id)->avg('rate');
            ExperienceFolder::where('id', $experience_folder_id)->update(['average_rate' => $average_rate ?? 0]);
        }
    }
}
