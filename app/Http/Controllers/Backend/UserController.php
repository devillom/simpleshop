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
        return view('backend.user.index', compact('users'));
    }

    /**
     * User edit form
     *
     * @param Request $request
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, User $user)
    {
        $roles = Role::lists('name', 'id')->toArray();
        return view('backend.user.edit', compact('user', 'roles'));
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
        $user->update(
            $request->only('email','password')+
            [
                'name' => $request->get('username'),
                'email' => $request->get('email')
            ]
        );

        if($request->has('password')){
            $user->update(
                $request->only('email','password')+
                [
                    'password' => Hash::make($request->get('password'))
                ]
            );
        }
        $user->roles()->sync($request->get('roles'));
        return redirect()->route('manager.user.index')->with(['message' => 'Сохранен']);
    }

    /**
     * Create user form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->toArray();
        return view('backend.user.create', compact('roles'));
    }

    /**
     * Store new user
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|static
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create(
            $request->only('email','password')+
            [
                'name' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]
        );
        $user->roles()->attach($request->get('roles'));
        return redirect()->route('manager.user.index')->with(['message' => 'Сохранен']);
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
            return redirect()->route('manager.user.index');
        } else {
            Session::flash('error', 'Вы не можете удалить себя');
            return redirect()->route('manager.user.index');
        }
    }


    public function ban(Request $request, User $user)
    {
        if (Auth::user()->id != $user->id) {
            $user->is_banned = true;
            $user->save();
            Session::flash('message', 'Пользователь заблокирован');
            return redirect()->route('manager.user.index');
        } else {
            Session::flash('error', 'Вы не можете заблокировать себя');
            return redirect()->route('manager.user.index');
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
        $user->is_banned = false;
        $user->save();
        Session::flash('message', 'Пользователь разблокирован');
        return redirect()->route('manager.user.index');
    }
}
