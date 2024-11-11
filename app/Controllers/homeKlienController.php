<?php

namespace App\Controllers;
use App\Models\klienModel;

class homeKlienController extends BaseController
{
    public function forumView(): string
    {
        $loggedInUsername = session()->get('username');
    
        $klienModel = new KlienModel();
        $klienData = $klienModel->where('username', $loggedInUsername)->first();
        return view('forumKlien', ['userData' => $klienData]);
    }

}
