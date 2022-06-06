<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

//古い画像を削除するため
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::find($user->id);
        $books = Book::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('users.show', compact('user', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /*$inputs = request()->validate([
            'name' => 'required|max:255',
            'profile_image' => 'required|max:1024',
            'email' => ['required', 'email', 'max:255', Rule::unique('user')->ignore($user->id)],
            'password' => 'required|confirmed|max:255|min:8',
            'password_confirmation' => 'required|same:password',
            'introduction' => 'required|max:255',
        ]);

        //パスワードはハッシュ化してDBに保存
        $inputs['password'] = Hash::make($inputs['password']);

        $user->introduction = $inputs['introduction'];
        if (request('profile_image')) {
            if ($user->profile_image !== 'default.png') {
                $old_image = 'public/images/' . $user->profile_image;
                Storage::delete($old_image);
            }
            $name = request()->file('profile_image')->getClientOriginalName();
            //getClientOriginalNameでファイル名を取得（アップロード時に元々のファイル名はなくなる）
            $file = request()->file('profile_image')->storeAs('public/images', $name);
            //$nameの名前で指定した場所に保存
            $user->profile_image = $name;
            //$nameの名前でDBに保存
        }*/
        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        if (request('profile_image')) {
            if ($user->profile_image !== 'default.png') {
                $oldimage = 'public/images/' . $user->profile_image;
                Storage::delete($oldimage);
            }
            $name = request()->file('profile_image')->getClientOriginalName();
            //getClientOriginalNameでファイル名を取得（アップロード時に元々のファイル名はなくなる）
            $file = request()->file('profile_image')->storeAs('public/images', $name);
            //$nameの名前で指定した場所に保存
            $user->profile_image = $name;
            //$nameの名前でDBに保存
        }

        $user->save();
        return redirect()->route('users.show', compact('user'))->with('message', 'プロフィールを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
