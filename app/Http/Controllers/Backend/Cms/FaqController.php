<?php

namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs           = Faq::with('faqCategory')->get();
        $faq_categories = FaqCategory::orderBy('name', 'asc')->get();
        return view('backend.cms.faqs.faqs', compact('faqs', 'faq_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'faq_category_id'   => 'required ',
            'question'          => 'required | string | max: 200',
            'answer'            => 'required ',
        ]);

        $faq                    = new Faq;
        $faq->faq_category_id   = $request->faq_category_id;
        $faq->question          = $request->question;
        $faq->answer            = $request->answer;
        if($faq->save())
        {
            $notification = array('message' => 'Faq added successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.faqs.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq           = Faq::with('faqCategory')->where('faq_id', $id)->first();
        return response()->json($faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $request->validate([
            'faq_category_id'   => 'required ',
            'question'          => 'required | string | max: 200',
            'answer'            => 'required ',
        ]);

        $faq                    = Faq::find($request->faq_id);
        $faq->faq_category_id   = $request->faq_category_id;
        $faq->question          = $request->question;
        $faq->answer            = $request->answer;
        if($faq->save())
        {
            $notification = array('message' => 'Faq updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return redirect()->route('admin.faqs.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        if($faq->delete())
        {
            $notification = array('message' => 'Faq deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return redirect()->route('admin.faqs.index')->with($notification);
    }
}
