<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\AboutUsBanner;
use App\Models\Aboutusslider;
use App\Models\Blog;
use App\Models\ContactusInfo;
use App\Models\Contractus;
use App\Models\Faq;
use App\Models\Faqbanner;
use App\Models\FaqCategory;
use App\Models\GeneralSetting;
use App\Models\Media;
use App\Models\NewsletterContent;
use App\Models\PrivacyBanner;
use App\Models\Privacypolicy;
use App\Models\ProductInfo;
use App\Models\ProductItem;
use App\Models\Slider;
use App\Models\Termscondition;
use App\Models\TermsConditionBanner;
use App\Models\Testimonial;
use App\Models\Whoweare;

use function count;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use function time;

class FrontController extends Controller
{
    public function index()
    {

        $new_arrival_products   = ProductItem::join('product_infos','product_infos.product_item_id', 'product_items.product_item_id')
                                            ->select('product_items.*')
                                            ->where('product_items.new_arrival', 1)
                                            ->groupBy('product_infos.product_item_id')
                                            ->orderBy('product_info_id','DESC')
                                            ->get()
                                            ->take(20);

        $popular_products   = ProductItem::join('product_infos','product_infos.product_item_id', 'product_items.product_item_id')
                                            ->select('product_items.*')
                                            ->groupBy('product_infos.product_item_id')
                                            ->orderBy('popular_count','DESC')
                                            ->get()
                                            ->take(20);

        $new_arrival_product_info_min_price = $this->productMinInfo($new_arrival_products);
        $new_arrival_product_infos          = $this->productInfos($new_arrival_products);

        $popular_product_info_min_price = $this->productMinInfo($popular_products);
        $popular_product_infos          = $this->productInfos($popular_products);

        $blogs = Blog::with('user','blogCategory','blogReview')
                        ->withCount(['blogReview as blog_review_count' => function ($query) {
                            $query->where('status', 1);
                        }])
                        ->orderBy('blog_id','DESC')
                        ->get()
                        ->take(5);
        $sliders   = Slider::orderBy('slider_id', 'desc')->get();
        $medias    = Media::orderBy('media_id', 'desc')->get()->take(3);
        $testimonails = Testimonial::orderBy('testimonial_id', 'desc')->get();
        $subscribtion = NewsletterContent::get();
        return view('front.home.index',
            compact('new_arrival_products','new_arrival_product_info_min_price',
                'new_arrival_product_infos', 'popular_products','popular_product_info_min_price',
                'popular_product_infos', 'blogs', 'sliders', 'medias', 'testimonails','subscribtion')
        );
    }

    public function aboutus()
    {
        $aboutus_banner   = AboutUsBanner::orderBy('id', 'desc')->get();
        $sliders   = Aboutusslider::orderBy('id', 'desc')->get();
        $whowe = Whoweare::get();
        return view('front.aboutus.aboutus',compact('aboutus_banner','sliders','whowe'));
    }

    public function contactus()
    {
        $banner = Contractus::get();
        $contactus_info = ContactusInfo::get();
        return view('front.contactus.contactus',compact('banner','contactus_info'));
    }

    public function contactusSend(Request $request)
    {

        $data = $this->validate($request,[
            'name'            => 'required | string | max:100',
            'email'           => 'required | email | max:190',
            'message'         => 'required | string',
        ]);



        // $receiver_email = \Config::get('mail.from.address');
        // Mail::send('emails.contact', [ 'request'=> $request ], function($message) use ($request, $receiver_email)
        // {
        //     $message->to($receiver_email);
        //     $message->subject('Contact: '. $request->subject);
        //     $message->from($request->email);
        // });
        $admin_mail = 'customercare@neo-bazaar.com';
        Mail::to($admin_mail)->send(new ContactMail($data));

        $notification = array('message' => 'Your message send successfully', 'alert-type'=> 'success');
        return redirect()->route('contactus')->with($notification);
    }


    public function page($page)
    {
        $page_data = '';
        $page_title = '';
        $terms = Termscondition::get();
        $privacy = Privacypolicy::get();
        $banner_terms = TermsConditionBanner::get();
        $banner_privacy = PrivacyBanner::get();
        if($page == 'terms-conditions')
        {

            $page_title = 'Terms & Conditions';
        }
        if($page == 'privacy-policy')
        {

            $page_title = 'Privacy Policy';
        }

        return view('front.pages.pages',compact('page_data','page_title', 'page', 'privacy','terms','banner_terms','banner_privacy'));
    }

    public function compare()
    {
        $product_id =  session()->get('compare');
        $compare_products = [];
        if($product_id)
        {
            $compare_products    = Product::with('category')->whereIn('id',$product_id)->get();
        }
        return view('front.compares.compares', compact('compare_products'));
    }

    public function compareAdd($id)
    {
        $product        = Product::where('id',$id)->firstOrFail();
        $compares       = \session()->get('compare');
        $exit           = false;
        $compareCount   = false;

        if($compares)
        {
            if(count($compares) >= 1)
            {
                if(array_key_exists($id,$compares))
                {
                    $exit = true;
                }
            }

            if(count($compares) < 3)
            {
                $compares[$id]  = $id ;

                Session::put('compare', $compares);
            }
            else
            {
                $compareCount = true;
            }

        }
        else
        {
            $compares[$id]  = $id ;

            Session::put('compare', $compares);
        }

        return response()->json(['compareCount' => $compareCount, 'exit' =>$exit, 'compareAdd']);
    }

    public function compareRemove($id)
    {
        $compares       = \session()->get('compare');

        if($key = array_search($id,$compares))
        {
            $set_compare = \array_diff($compares, [$key]);

            Session::forget('compares');
            Session::put('compare', $set_compare);

            $notification = array('message' => 'Compare Product removed successfully', 'alert-type'=> 'success');
        }
        else
        {
            $notification = array('message' => 'This product not found!', 'alert-type'=> 'error');
        }

        return redirect()->route('compares')->with($notification);
    }

    public function productMinInfo($products)
    {
        $product_info_min_price  = [];
        foreach ($products as $product)
        {
            $product_info_min_price[$product->product_item_id] = ProductInfo::where('product_item_id', $product->product_item_id)
                ->get()
                ->min('price');
        }
        return $product_info_min_price;
    }

    public function productInfos($products)
    {
        $product_infos           = [];
        foreach ($products as $product)
        {
            $product_infos[$product->product_item_id]          = ProductInfo::with('productWeight')
                ->where('product_item_id', $product->product_item_id)
                ->get();
        }
        return $product_infos;
    }

    public function faq()
    {
        $banner = Faqbanner::get();
        $faq_categories   = FaqCategory::with('faqAll')->get();
        return view('front.faq.faq', compact('faq_categories','banner'));
    }

    public function notice(){
        return view('front.verify');
    }
}
