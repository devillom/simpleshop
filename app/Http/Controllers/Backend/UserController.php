<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Requests;
use Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Backend\UserStoreRequest;
use App\Http\Requests\Backend\UserUpdateRequest;


class UserController extends Controller
{
    /**
     * Users list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::with(['roles'])->orderBy('created_at', 'asc')->get();
        return view('backend.users.index', compact('users'));
    }

    /**
     * User edit form
     *
     * @param Request $request
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $user)
    {
        $user = User::findOrFail($user);
        $roles = Role::lists('name', 'id');
        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user
     *
     * @param UserUpdateRequest $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();
        $user->update(
            [
                'name' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );

        $user->roles()->sync($data['roles']);
        return redirect()->back()->with(['message' => 'Сохранен']);

    }

    /**
     * Create user form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::lists('name', 'id');
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store new user
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|static
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $user = new User();
        return $user->create(
            [
                'name' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );

        $user->roles()->attach($role);

        return redirect()->route('manager.users.edit', ['user' => $user->id])->with(['message' => 'Сохранен']);
    }

    /**
     * Delete user
     *
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, User $user)
    {
        if (Auth::user()->id != $user->id) {
            $user->delete();
            Session::flash('message', 'Пользователь удален');
            return redirect()->route('manager.users.index');
        } else {
            Session::flash('error', 'Вы не можете удалить себя');
            return redirect()->route('manager.users.index');
        }
    }


    public function ban(Request $request, User $user)
    {
        if (Auth::user()->id != $user->id) {
            $user->is_banned = true;
            $user->save();
            Session::flash('message', 'Пользователь заблокирован');
            return redirect()->route('manager.users.index');
        } else {
            Session::flash('error', 'Вы не можете заблокировать себя');
            return redirect()->route('manager.users.index');
        }
    }

    /**
     * Unban user
     *
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unban(Request $request, User $user)
    {

        if (Auth::user()->id != $user->id) {
            $user->is_banned = true;
            $user->save();
            Session::flash('message', 'Пользователь заблокирован');
            return redirect()->route('manager.users.index');
        } else {
            Session::flash('error', 'Вы не можете заблокировать себя');
            return redirect()->route('manager.users.index');
        }
    }
}
