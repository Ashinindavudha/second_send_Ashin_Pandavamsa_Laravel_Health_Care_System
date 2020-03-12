<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Disease;
use App\Model\Admin\Doctor;
use App\Model\Admin\Post;
use Gate;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    use MediaUploadingTrait;
    
    public function index()
    {
        $posts = Post::all();
        return view('admin.doctor_information_post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post_doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $diseases = Disease::all()->pluck('name', 'id');

        return view('admin.doctor_information_post.create', compact('post_doctors', 'diseases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_doctor = Post::create($request->all());
        $post_doctor->diseases()->sync($request->input('diseases', []));

        if ($request->input('logo', false)) {
            $post_doctor->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.doctor_information_post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $post = Post::where('id',$id)->first();
        $post_doctors = Doctor::all()->pluck('name', 'id');
        $diseases = Disease::all()->pluck('name', 'id');
        $post->load('diseases');

        return view('admin.doctor_information_post.edit', compact('post_doctors', 'diseases', 'post'));
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

        $post=Post::find($id);
        $post->update($request->all());
        $post->diseases()->sync($request->input('diseases', []));

        if ($request->input('logo', false)) {
            if (!$post->logo || $request->input('logo') !== $post->logo->file_name) {
                $post->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($post->logo) {
            $post->logo->delete();
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();

        return back();
    }
}
