<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageUserController extends Controller
{
    public function index(): Response
    {
        return response('Admin ManageUserController@index (TODO)', 200);
    }

    public function updateCredentials(Request $request, User $user): RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
