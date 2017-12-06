<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Mail\OrderShipped;
use App\Mail\UserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendEmailReminder(Request $request)
    {
        $id = 7; // điền 1 mã id bất kỳ của user trong bảng users
        $user = User::findOrFail($id);
        Mail::to($user)->send(new UserEmail());
    }
}
