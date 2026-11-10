<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['user', 'event'])
            ->latest()
            ->paginate(10);

        return view('admin.registrations.index', compact('registrations'));
    }
}
