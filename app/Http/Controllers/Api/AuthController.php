<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);
         if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
              $customer = Auth::guard('customer')->user();


              // إنشاء جلسة للمستخدم
              session(['customer_id' => $customer->id]);
             $token = $customer->createToken('CustomerToken')->plainTextToken;
// return redirect('https://admin.hoda-academy.com/booking1')->route()
            return response()->json([
                'status' => 'success',
                'message' => 'تم تسجيل الدخول بنجاح',
                'customer' => $customer,
                'token' => $token,
                'redirect_url' => 'https://admin.hoda-academy.com/booking1',
            ], 200);
        }

        // إذا فشلت عملية تسجيل الدخول
        return response()->json([
            'status' => 'error',
            'message' => 'بيانات تسجيل الدخول غير صحيحة.',
        ], 401);
    }


    public function register(Request $request)
    {

        // return$request;
        try {
            // التحقق من صحة البيانات المدخلة
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:150|unique:customers,email',
                'phone' => 'required|string|unique:customers,phone',
                'password' => 'required|string|min:8|confirmed',
                'age' => 'required|integer|min:1',
                'country_id' => 'required|exists:countries,id',
            ]);

            // إنشاء المستخدم الجديد
            $customer = Customer::create($request->all());

            $customer->password = Hash::make($request->password);

            $customer->save();

            // إنشاء توكن للمستخدم الجديد
            $token = $customer->createToken('CustomerToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'تم إنشاء الحساب بنجاح',
                'customer' => $customer,
                'token' => $token,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ في البيانات المدخلة',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ غير متوقع',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return response()->json([
           'status' =>'success',
           'message' => 'تم تسجيل الخروج بنجا��',
        ], 200);
    }
}
