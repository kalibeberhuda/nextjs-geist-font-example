<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Language extends Controller
{
    public function change()
    {
        $locale = $this->request->getPost('locale');
        if (in_array($locale, ['en', 'id'])) {
            session()->set('locale', $locale);
        }
        return redirect()->back();
    }
}
