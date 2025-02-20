<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{


    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'password');

        if (Auth::guard('customer')->attempt(['email' => $credentials['email'] , 'password' => $credentials['password']])) {
            $customer = Auth::guard('customer')->user();


            $token = $customer->createToken('CustomerToken')->plainTextToken;

            $cookie = cookie('token', json_encode($token), 60 * 24, '/');


            session(['customer_id' => $customer->id]);
            return redirect()->route('booking1.index')->cookie($cookie);
        }
        // return $request;


        return back()->withErrors(['error' => 'بيانات تسجيل الدخول غير صحيحة.']);
    }

    public function logout(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if ($customer) {
            // حذف جميع التوكنات من قاعدة البيانات
            $customer->tokens()->delete();

            // تسجيل خروج المستخدم
            Auth::guard('customer')->logout();
        }

        // حذف الكوكي من المتصفح
        return redirect()->route('customer.login')
            ->withCookie(cookie('token', '', -1, '/'));
    }


    public function dashboard()
    {
        return view('customer.dashboard');
    }


    public function showRegisterForm()
    {
        $country = Country::all();

        return view('customer.register',  get_defined_vars());

    }

    // معالجة التسجيل
    public function store(CustomerRequest  $request)
    {



             $customer = Customer::create($request->all());

            $customer->password = Hash::make($request->password);

            $customer->save();


            Auth::guard('customer')->login($customer);


            $customer = Auth::guard('customer')->user();
            $token = $customer->createToken('CustomerToken')->plainTextToken;

            $cookie = cookie('token', json_encode($token), 60 * 24, '/');



            session(['customer_id' => $customer->id]);


            return redirect()->route('booking1.index')->with('success', __('admin.Registration successful!'))->cookie($cookie);


    }













    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customer.index');
    }

    public function data()
    {
        $customer = Customer::with('country:id,name', 'orders', 'booking') // إذا كنت تستخدم علاقة مع جدول الطلبات
        ->withCount('orders')
        ->withSum('orders', 'total')
        ->withCount('booking')
        ->withSum('booking', 'total')
        ->orderBy('created_at', 'desc')
        ->get(['id', 'name', 'phone', 'country_id', 'photo']);



        return DataTables::of($customer)

            ->make(true);
    }



    /**
     * Display the specified resource.
     */
    public function show(  $id)
    {
        $customer =Customer::findOrFail($id);

    $count1 = $customer->booking->count();
    $total1 = $customer->booking->sum('total');



    $booking =$customer->booking;
    $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');
    $country = Country::all();

    return view('admin.customer.show',get_defined_vars());

    }
    public function getorder($id)
    {

        $booking = Booking::with([
            'customer:id,name,phone,photo',
            'course:id,title_ar,title_en,photo',

 ])
 ->orderBy('created_at', 'desc')
 ->where('customer_id',$id)->get( );

        return DataTables::of($booking)

            ->make(true);


    }
     /**
     * Display the specified resource.
     */
    public function show2($id)
    {
        // $recentDevices = recent_devices::where('customer_id',$id)->orderBy('activity_time', 'desc')->get();

        $customer =Customer::findOrFail($id);

    $count = $customer->orders->count();
    $total = $customer->orders->sum('total');

    $count1 = $customer->booking->count();
    $total1 = $customer->booking->sum('total');



    $order =$customer->order;
    $country = Country::all();
    $order =$customer->order;
    $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');
    return view('admin.customer.show2',get_defined_vars());

    }


     /**
     * Display the specified resource.
     */
    public function show3($id)
    {
        $customer =Customer::findOrFail($id);

        $count = $customer->order->count();
        $total = $customer->order->sum('total');

        $order =$customer->order;


        $address =$customer->address;
        $visa =$customer->visa;
        $country = Country::all();
        $order =$customer->order;
        $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');

        return view('admin.customer.show3',get_defined_vars());

    }


     /**
     * Display the specified resource.
     */
    public function show4($id)
    {
        $customer =Customer::findOrFail($id);

        $count = $customer->orders->count();
        $total = $customer->orders->sum('total');

        $order =$customer->order;
        $country = Country::all();
        $order =$customer->order;
        $date = Carbon::parse($customer->created_at)->format('M d, Y, h:i A (ET)');
        return view('admin.customer.show4',get_defined_vars());

    }



    /**
     * Update the specified resource in storage.
     */
    public function updatepass(Request $request )
    {
        // return $request;
        $request->validate([
            'newPassword' => 'required|string|min:8|confirmed',

        ]);


          $customer = Customer::where("id",$request->id);
        $customer->update([
            'password'=>Hash::make($request->newPassword)
        ]);


    session()->flash('success',  __('admin.Updated Successfully'));

        return redirect()->back(); // يمكنك إعادة توجيه المستخدم إلى الصفحة السابقة
    }


    public function update(CustomerRequest $request,$id)
    {

        // return $request;
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->back()->with('success',__('admin.Updated Successfully'));

    }


}
