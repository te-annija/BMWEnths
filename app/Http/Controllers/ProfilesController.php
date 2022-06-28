<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('id', $id)->first();
        $this->authorize('view', $profile );
        if(Profile::find($id))
        {
           return view('profile.view')
            ->with('profile', Profile::where('id', $id)->first())
            ->with('posts', Post::where('user_id', $profile->id)->orderBy('updated_at', 'asc')->limit(2)->get());
        }
        else return redirect('/');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::where('id', $id)->first();
        $this->authorize('update', $profile);
        return view('profile.edit')
        ->with('profile', Profile::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::where('id', $id)->first();
        $this->authorize('update', $profile);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'description' => 'nullable',
            'model' => 'nullable|max:25',
            'type' => 'nullable',
            'year' => 'nullable|numeric|min:1900|max:2022',
            'engine' => 'nullable|numeric',
            'power' => 'nullable|numeric',
            'file' => 'nullable|mimes:jpg,png,jpeg',
        ]);
        if ($validator->fails()) {
            return redirect('profile/'.$id.'/edit')
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($request->file))
        {
            $newImageName = uniqid() . '-' . $request->name . '.' . $request->file->extension();
            $request->file->move(public_path('images/profile'), $newImageName);
        }
        else $newImageName = $profile->image_path;
        if($newImageName != 'default_img.jpg' && $newImageName != $profile->image_path) File::delete(public_path('images/profile/'.$profile->image_path));

        if(!File::exists(public_path('images/profile/'.$newImageName))) $newImageName = 'default_img.jpg';


        User::where('id', $profile->user_id)->update([
            'name'=> $request->input('name'),
        ]);

        $profile->update([
                'description' => $request->input('description'),
                'BMW_model' => $request->input('model'),
                'body_type' => $request->input('type'),
                'year' => $request->input('year'),
                'engine' => $request->input('engine'),
                'power' => $request->input('power'),
                'image_path' => $newImageName,
            ]);
        return redirect('/profile/'.$id)
        ->with('message', 'Your profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $profile = Profile::where('id', $id)->first();
        $this->authorize('delete', $profile);
        $userid = $profile->user_id;
        if ($profile->image_path != 'default_img.jpg') File::delete(public_path('images/profile/' . $profile->image_path));
        $profile->delete();


        if (User::find($userid)) {
            $user = User::find($id);
            $user->delete();
            return redirect('/');
        } else {
            return redirect('/');
        }
    }
}
