<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subscribe.index');
    }

    public function data()
    {
        $service = Subscribe::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $subscribe= Subscribe::where('email', $request->email)->first();
        if (!$subscribe) {
             $ip = request()->ip();
            $response = Http::get("http://ip-api.com/json/{$ip}");

                $data = $response->json();
                $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)






            $data = $request->all();
            $data['country'] = $country;
            Subscribe::create($data);



                    return response()->json([
                        'status' => 'success',
                        'message' => 'تم تسجيل الدخول بنجاح',

                    ], 200);



            }
                   return response()->json([
                    'status' => 'error',
                    'message' => 'بيانات تسجيل الدخول غير صحيحة.',
                ], 401);

}
}
