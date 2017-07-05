<?php

namespace App\Http\Controllers;

use App\Notifications\ProfileUpdated;
use App\User;
use Illuminate\Notifications\Notifiable;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = auth()->user()->profile()->firstOrNew([]);
        $posts = Post::orderBy('title', 'ASC')
            ->where('user_id',auth()->id())
            ->get();
        return view('users/profile', compact('profile','posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = auth()->user()->profile()->firstOrNew([]);

        $this->validate($request, [
           'description' => 'required|min:10|max:100',
            'nickname' => Rule::unique('user_profiles')->ignore($profile->id),
            'avatar' => [
                'image',/*
                Rule::dimensions([
                    'max_width' => '200',
                    'max_height' => '200'
                ])--- Asi puede ser usado, como arreglo. */
                Rule::dimensions()->maxHeight(800)->maxHeight(800),
            ],
            'featured_post_id' => Rule::exists('posts', 'id')
                ->where('user_id',auth()->id()),
        ]);

        $profile->fill($request->all());

        if ($request->hasFile('avatar')) {
            $profile->avatar = $request->file('avatar')
                ->storeAs("avatars/".auth()->id(), 'avatar.png');
        }
            
        $profile->save();

        auth()->user()->notify(new ProfileUpdated($profile));

        return back();
    }

    public function avatar()
    {
        $profile = auth()->user()->profile; // metodo profile creado en el modelo user.
        $headers = [
            ''
        ];
        return response()->download(
            storage_path("app/{$profile->avatar}"),
            null,
            $headers, ResponseHeaderBag::DISPOSITION_INLINE
        );
    }
}
