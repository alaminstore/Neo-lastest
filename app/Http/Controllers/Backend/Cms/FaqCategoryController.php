<?php

namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\FaqCategory;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $faq_categories = FaqCategory::get();
        return view('backend.cms.faq_categories.faq_categories', compact('faq_categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required | string | max: 200',
        ]);

        $faq_category            = new FaqCategory;
        $faq_category->name      = $request->name;
        if($faq_category->save())
        {
            $notification = array('message' => 'Faq Category added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.faqcategories.index')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $faq_category  = FaqCategory::find($id);
        return response()->json($faq_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function updated(Request $request)
    {
        $request->validate([
            'name'   => 'required | string | max: 200',
        ]);

        $faq_category            = FaqCategory::findOrFail($request->faq_category_id);
        $faq_category->name      = $request->name;
        if($faq_category->save())
        {
            $notification = array('message' => 'Faq Category updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.faqcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $faq_category = FaqCategory::findOrFail($id);
        if($faq_category->delete())
        {
            $notification = array('message' => 'Faq Category deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.faqcategories.index')->with($notification);
    }
}
