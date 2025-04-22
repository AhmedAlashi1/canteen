<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\BlogsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\Blog_Type;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    use ImageTrait;

    public function index(BlogsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogTypes = Blog_Type::all();
        return view('dashboard.blogs.create',compact('blogTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        try {
            DB::beginTransaction();
            $image_path = $this->uploadImage('admin', $request->photo);
             Blog::create([
                 'title_en' => $request->input('title'),
                 'title_ar' => $request->input('title_ar'),
                 'desc_en' => $request->input('desc'),
                 'desc_ar' => $request->input('desc_ar'),
                 'date' => $request->input('date'),
                 'by' => $request->input('by'),
                 'image' => $image_path,
                 'short_link' => $request->input('short_link') ?? null,
                 'blog_type_id' => $request->input('blog_type_id'),
                 'content_en' => $request->input('content') ?? null,
                 'content_ar' => $request->input('content_ar') ?? null,
                 'title_html_ar' => $request->input('title_html_ar') ?? null,
                 'title_html_en' => $request->input('title_html_en') ?? null,
                 'desc_html_ar' => $request->input('desc_html_ar') ?? null,
                 'desc_html_en' => $request->input('desc_html_en') ?? null,
                 'key_url' => $request->input('key_url') ?? null,
            ]);
            DB::commit();
            session()->flash('success', __('messages.created successfully.'));
            return redirect()->route('blog.index');
        } catch (\Exception $ex) {
            session()->flash('error', __('messages.An error occurred while creating the blog. Please try again.'));
            return redirect()->route('blog.create');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $blog = Blog::find($id);
            if (!$blog) {
                session()->flash('error', __('messages.The blog is not exist'));
                return redirect()->route('blog.index');
            }
            $blogTypes = Blog_Type::all();
            return view('dashboard.blogs.edit',compact('blog','blogTypes'));
        }catch (\Exception $ex) {
            session()->flash('error', __('messages.There was an error try again'));
            return redirect()->route('blog.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $blog = Blog::findorfail($id);
            if ($request->has('photo')) {
                $image_path = $this->uploadImage('admin', $request->photo);
            } else {
                $image_path = $blog->image;
            }
            $blog->update([
                'title_en' => $request->input('title'),
                'title_ar' => $request->input('title_ar'),
                'desc_en' => $request->input('desc'),
                'desc_ar' => $request->input('desc_ar'),
                'date' => $request->input('date'),
                'by' => $request->input('by'),
                'image' => $image_path,
                'blog_type_id' => $request->input('blog_type_id'),
                'title_html_ar' => $request->input('title_html_ar') ?? null,
                'title_html_en' => $request->input('title_html_en') ?? null,
                'desc_html_ar' => $request->input('desc_html_ar') ?? null,
                'desc_html_en' => $request->input('desc_html_en') ?? null,
                'key_url' => $request->input('key_url') ?? null,
            ]);
            if ($request->input('way_to_add_blog') == 'short_link' && $request->input('short_link') != null) {
                $blog->update([
                    'short_link' => $request->input('short_link'),
                    'content_en' => null,
                    'content_ar' => null,
                ]);
            } else {
                $blog->update([
                    'short_link' => null,
                    'content_en' => $request->input('content'),
                    'content_ar' => $request->input('content_ar'),
                ]);
            }
            DB::commit();
            session()->flash('success', __('messages.updated successfully.'));
            return redirect()->route('blog.index');
        } catch (\Exception $ex) {
            session()->flash('error', __('messages.An error occurred while updating the blog. Please try again.'));
            return redirect()->route('blog.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json('success');
    }

    public function updateDefault($id)
    {
        try {
            $blog = Blog::find($id);
            $blog->is_default ='1';
            $blog->save();
            $blogs = Blog::where('id','!=',$id)->get();
            foreach ($blogs as $blog){
                $blog->update([
                    'is_default'=>'0'
                ]);
            }

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function uploadCkeditorImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('file')->move(public_path('images'), $fileName);
            $url = asset('images/' . $fileName);

            return response()->json([
                'uploaded' => true,
                'link' => $url
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'No file uploaded or invalid file.'
            ]
        ]);
    }


}
