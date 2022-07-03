<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\ExperienceFolder;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword == '') {
            return view('search.experience');
        }

        $experinceFolders = ExperienceFolder::search($keyword, per_page: 10);
        return view('search.experience_list', compact('experinceFolders'));
    }


    public function show(string $id)
    {
        $experienceFolder = ExperienceFolder::find($id);
        if ($experienceFolder == null) {
            return abort(404);
        }
        $experiences = $experienceFolder->experiences;
        return view('experience.detail', compact('experienceFolder', 'experiences'));
    }

    public function reserve_detail(string $folder_id, string $id)
    {
        $experienceFolder = ExperienceFolder::find($folder_id);
        $experience = Experience::find($id);
        if ($experienceFolder == null || $experience == null) {
            return abort(404);
        }
        return view('experience.reserve', compact('experienceFolder', 'experience'));
    }
}
