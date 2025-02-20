<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Booking;

use App\Models\Card;
use App\Models\Cart;
use App\Models\Courses;
use App\Models\Courses_Item;
use App\Models\Courses_Review;
use App\Models\Courses_Time;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rateing;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Story;
use App\Models\User;
use App\Http\Traits\TokenTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{


    use TokenTraits;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function index() {
            $token = $this->generateCustomToken($request)->token;
            Booking::where('token', $token)->update(['customer_id' => Auth::id()]);
            $cards = Card::all();
            $slider = Slider::all();
            $services = Service::all();
            $faqs = Faq::limit(4)->get();
            $products = Product::limit(10)->get();
            $rateings = Rateing::latest()->get();
            return view('web.index' ,get_defined_vars());

        }

    public function home()
    {
    /////////////////////////////////USD/////////////////////////////////////
    // إجمالي حجز الشهر الحالي
    $month_booking = Booking::whereMonth('created_at', now()->month)->sum('total');
    // إجمالي طلبات الشهر الحالي
    $month_order = Order::whereMonth('created_at', now()->month)->sum('total');
    // الإجمالي الكلي للشهر الحالي
    $total = $month_booking + $month_order;
    /////////////////////////////////USD/////////////////////////////////////


    /////////////////////////////////Egp/////////////////////////////////////
    // إجمالي حجز الشهر الحالي
    $month_bookingEGP = Booking::whereMonth('created_at', now()->month)->sum('total');
    // إجمالي طلبات الشهر الحالي
    $month_orderEGP = Order::whereMonth('created_at', now()->month)->sum('total');
    // الإجمالي الكلي للشهر الحالي
    $totalEGP = $month_bookingEGP + $month_orderEGP;
    /////////////////////////////////Egp/////////////////////////////////////










// إجمالي حجز الشهر السابق
$month_booking_last = Booking::whereMonth('created_at', now()->startOfMonth()->subMonth()->month)->sum('total');
// إجمالي طلبات الشهر السابق
$month_order_last = Order::whereMonth('created_at', now()->startOfMonth()->subMonth()->month)->sum('total');
// الإجمالي الكلي للشهر السابق
$last_total = $month_booking_last + $month_order_last;


// حساب التغير في الطلبات بين الشهر الحالي والشهر السابق
$avg_order = ($month_order_last > 0) ? (($month_order - $month_order_last) / $month_order_last) * 100 : 0;
// حساب التغير في الحجوزات بين الشهر الحالي والشهر السابق
$avg_booking = ($month_booking_last > 0) ? (($month_booking - $month_booking_last) / $month_booking_last) * 100 : 0;

// حساب التغير الكلي بين الشهر الحالي والشهر السابق
$avg = ($last_total > 0) ? (($total - $last_total) / $last_total) * 100 : 0;


// عدد الطلبات في الشهر الحالي
$count_order = count(Order::whereMonth('created_at', now()->month)->get());
// عدد الحجوزات في الشهر الحالي
$count_booking = count(Booking::whereMonth('created_at', now()->month)->get());


// عدد الطلبات في الشهر السابق
$count_order_last = Order::whereMonth('created_at', now()->startOfMonth()->subMonth()->month)->count();
// عدد الحجوزات في الشهر السابق
$count_booking_last = Booking::whereMonth('created_at', now()->startOfMonth()->subMonth()->month)->count();

// حساب التغير في عدد الطلبات بين الشهر الحالي والشهر السابق
$avg_count_order = ($count_order_last > 0) ? (($count_order - $count_order_last) / $count_order_last) * 100 : 0;
// حساب التغير في عدد الحجوزات بين الشهر الحالي والشهر السابق
$avg_count_booking = ($month_booking_last > 0) ? (($month_booking - $month_booking_last) / $month_booking_last) * 100 : 0;


// إجمالي المبيعات لكل شهر في السنة الحالية
$totals = [];
for ($month = 1; $month <= 12; $month++) {
    // جمع إجمالي الطلبات والحجوزات لكل شهر
    $total1 = Order::whereMonth('created_at', $month)->whereYear('created_at', now()->year)->sum('total')
           + Booking::whereMonth('created_at', $month)->whereYear('created_at', now()->year)->sum('total');
    $totals[] = $total1;
}


// إجمالي المبيعات لكل شهر في السنة الماضية
$totals3 = [];
for ($month = 1; $month <= 12; $month++) {
    // جمع إجمالي الطلبات والحجوزات لكل شهر في السنة الماضية
    $total3 = Order::whereMonth('created_at', $month)

                   ->whereYear('created_at', now()->year) // السنة السابقة
                   ->count(); //;
    $totals3[] = $total3;
}



// إجمالي المبيعات لكل شهر في السنة الماضية
$totals2 = [];
for ($month = 1; $month <= 12; $month++) {
    // جمع إجمالي الطلبات والحجوزات لكل شهر في السنة الماضية
    $total2 = Order::whereMonth('created_at', $month)

                   ->whereYear('created_at', now()->subYear()->year) // السنة السابقة
                   ->count(); //;
    $totals2[] = $total2;
}

// إجمالي الطلبات للسنة الحالية
$total_order_year = Order::whereYear('created_at', now()->year)->sum('total');
// إجمالي الطلبات للسنة الماضية
$total_order_last_year = Order::whereYear('created_at', now()->subYear()->year)->sum('total');

// إجمالي الحجوزات للسنة الحالية
$total_booking_year = Booking::whereYear('created_at', now()->year)->sum('total');
// إجمالي الحجوزات للسنة الماضية
$total_booking_last_year = Booking::whereYear('created_at', now()->subYear()->year)->sum('total');

// حساب التغير في الحجوزات بين السنة الحالية والسنة الماضية
$avg_booking_year = ($total_booking_last_year > 0) ? (($total_booking_year - $total_booking_last_year) / $total_booking_last_year) * 100 : 0;

// جلب آخر 6 طلبات
$orders = Order::orderBy('id', 'desc')->take(6)->whereYear('created_at', now()->year)->get();
// جلب آخر 6 حجوزات
$bookings = Booking::orderBy('id', 'desc')->take(3)->whereYear('created_at', now()->year)->get();


// إجمالي الحجوزات للسنة الحالية حسب العدد
$total_booking_year_count = Booking::whereYear('created_at', now()->year)->count();
// إجمالي الحجوزات للسنة الماضية حسب العدد
$total_booking_last_year_count = Booking::whereYear('created_at', now()->subYear()->year)->count();

// حساب التغير في عدد الحجوزات بين السنة الحالية والسنة الماضية
$avg_count_booking_year = ($total_booking_last_year_count > 0) ? (($total_booking_year_count - $total_booking_last_year_count) / $total_booking_last_year_count) * 100 : 0;


// جلب الشهر الذي يحتوي على أكبر إجمالي حجوزات للسنة الحالية
$max_month_booking = Booking::selectRaw('SUM(total) as total_sum, MONTH(created_at) as month')
    ->whereYear('created_at', now()->year)

    ->groupBy('month')
    ->orderByDesc('total_sum')
    ->limit(1)
    ->pluck('total_sum')
    ->first();

// جلب الشهر الذي يحتوي على أكبر إجمالي طلبات للسنة الحالية
$max_month_order = Order::selectRaw('SUM(total) as total_sum, MONTH(created_at) as month')
    ->whereYear('created_at', now()->year)

    ->groupBy('month')
    ->orderByDesc('total_sum')
    ->limit(1)
    ->pluck('total_sum')
    ->first();

// جمع أكبر إجمالي حجوزات وطلبات للشهر الحالي
$max_total = $max_month_booking + $max_month_order;


$max_month_order_count = Order::selectRaw('COUNT(*) as order_count, MONTH(created_at) as month')

    ->whereYear('created_at', now()->year)  // تحديد السنة الحالية
    ->groupBy('month')  // تجميع الطلبات حسب الشهر
    ->orderByDesc('order_count')  // ترتيبهم حسب العدد من الأكبر إلى الأصغر
    ->limit(1)  // جلب الشهر الأول الذي يحتوي على أكبر عدد من الطلبات
    ->pluck('order_count')  // إرجاع أكبر عدد من الطلبات
    ->first();


// إجمالي السنة الحالية (مجموع الطلبات والحجوزات لكل شهر)
$totalsCurrentYear = [];
for ($month = 1; $month <= 12; $month++) {
    $totalCurrentMonth =   Booking::whereMonth('created_at', $month)

                ->whereYear('created_at', now()->year)
                ->sum('total');
    $totalsCurrentYear[] = $totalCurrentMonth;
}

// إجمالي السنة الماضية (مجموع الطلبات والحجوزات لكل شهر)
$totalsLastYear = [];
for ($month = 1; $month <= 12; $month++) {
    $totalLastMonth =  Booking::whereMonth('created_at', $month)

                ->whereYear('created_at', now()->subYear()->year)
                ->sum('total');
    $totalsLastYear[] = $totalLastMonth;
}



// إرجاع جميع القيم إلى الـ view
return view('admin.index', get_defined_vars());


    }
    public function contact()
    {
        return view('web.contact');
    }
    public function faq()
    {
        $faqs = Faq::all();
        return view('web.faq' ,get_defined_vars());

    }
    public function about()
    {



        $services = Service::all();

        $cards = Card::all();
        $user = User::findOrFail(1);
        return view('web.about',get_defined_vars());


    }
    public function cart()
    {
        return view('web.cart');
    }



    public function products(Request $request)
    {
        $query = Product::query()
                        ->withAvg('review', 'rate')  ;

        // إذا كان هناك طلب بحث
        if ($request->has('search') && $request->search !== null) {
            $searchTerm = $request->search;
            $query->where('title_en', 'like', '%' . $searchTerm . '%')
                  ->orWhere('title_ar', 'like', '%' . $searchTerm . '%');
        }

        // الفرز
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'popularity':
                    $query->orderBy('review_avg_rate', 'desc'); // ترتيب حسب متوسط التقييم.
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        // التقسيم (Pagination)
        $products = $query->paginate(10);

        return view('web.products',get_defined_vars());
    }




    public function products_details($slug)
    {

        $products = Product::where('slug_en','!=',$slug)->orwhere('slug_ar','!=',$slug)->limit(10)->get();
        if (!$products) {
            abort(404);
        }
        $reviews = Review::limit(10)->get();
        $product = Product::where('slug_en',$slug)->first();

        if (!$product) {
            abort(404);
        }

        $avg1 = Review::where('product_id',  $product->id)->avg('rate');
        $avg = number_format($avg1, 1);
        return view('web.products-details',get_defined_vars());

    }

    public function services()
    {

        $services = Service::all();
        return view('web.services' ,get_defined_vars());


    }
    public function services_details($id)
    {
        $services = Service::all();
        $service = Service::findOrFail($id);
        return view('web.services-details' ,get_defined_vars());

    }


    public function courses(Request $request)
    {
        $query = Courses::query() ->withAvg('review', 'rate')  ;

        // إذا كان هناك طلب بحث
        if ($request->has('search') && $request->search !== null) {
            $searchTerm = $request->search;
            $query->where('name_en', 'like', '%' . $searchTerm . '%')
                  ->orWhere('name_ar', 'like', '%' . $searchTerm . '%');
        }

        // الفرز
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'popularity':
                    $query->orderBy('review_avg_rate', 'desc'); // ترتيب حسب متوسط التقييم.
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        // التقسيم (Pagination)
        $courses = $query->paginate(10);

        return view('web.courses',  get_defined_vars() );

    }
    public function courses_details($slug)
    {

        $reviews = Courses_Review::limit(10)->get();
        $courses = Courses::where('slug_en', 'like', '%' . $slug . '%')
        ->orWhere('slug_ar', 'like', '%' . $slug . '%')->first() ;
        if (!$courses) {
            abort(404);
        }
        $avg1 = Courses_Review::where('course_id',  $courses->id)->avg('rate');
        $avg = number_format($avg1, 1);
        $num1 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>1])->count();
        $num2 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>2])->count();
        $num3 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>3])->count();
        $num4 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>4])->count();
        $num5 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>5])->count();

        $num = 1;

        $items = Courses_Item::where('course_id',  $courses->id)->get();
        $time = Courses_Time::where('course_id',  $courses->id)->get();

        return view('web.courses-details' ,get_defined_vars());

    }

    public function blog(Request $request)
    {
        $blogs = Blog::query()->paginate(10);




        return view('web.blog', ['blogs' => $blogs]);

    }
    public function blog_details($slug)
    {


        $blog = Blog::where('slug_en', 'like', '%' . $slug . '%')
        ->orWhere('slug_ar', 'like', '%' . $slug . '%')->first() ;
        if (!$blog) {
            abort(404);
        }


         $previousBlog = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();

         $nextBlog = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();


        $num = BlogComment::where('blog_id',  $blog->id)->get()->count();



        return view('web.blog-details' ,get_defined_vars());

    }

    public function success_story()
    {

          $story =  Story::first();
        return view('web.story' ,get_defined_vars());


    }
    public function checkout()
    {

        $customer_id = Auth::guard('customer')->user()->id;
        $carts =Cart::where(['customer_id'=>$customer_id])->get();

        return view('web.checkout' ,get_defined_vars());


    }







}
