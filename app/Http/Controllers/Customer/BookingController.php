<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\StripeTrait;
use App\Models\Booking;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class BookingController extends Controller
{
    use PaypalTrait;
    use StripeTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $paid = Booking::where('payment', '1')->where('customer_id',$customer_id)->count();
        $pending = Booking::where('payment', '2')->where('customer_id',$customer_id)->count();
        $failed = Booking::where('payment', '3')->where('customer_id',$customer_id)->count();
        $cancelled = Booking::where('payment', '4')->where('customer_id',$customer_id)->count();
        return view('customer.booking.index',get_defined_vars());

    }

    public function data()
    {

        $customer_id = Auth::guard('customer')->user()->id;

 $booking = Booking::with([
    'customer:id,name,phone,photo',
    'course:id,title_ar,title_en,photo',

])
->orderBy('created_at', 'desc')
->where('customer_id',$customer_id)
->get( );
        return DataTables::of($booking)

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }







}
