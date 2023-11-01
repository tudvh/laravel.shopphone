<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Account;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('cus')->check()) {
            return redirect()->route('home.index');
        }

        return view('site.login');
    }

    public function postLogin(Request $req)
    {
        $this->validate($req, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Tên tài khoản không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.'
        ]);

        if (Auth::guard('cus')->attempt($req->only('username', 'password'), $req->has('remember'))) {

            if ($req->link_previous == url()->current()) {

                return redirect()->route('home.index');
            } else {

                return redirect()->to($req->link_previous);
            }
        } else {

            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng. Vui lòng đăng nhập lại!');
        }
    }

    public function register()
    {
        if (Auth::guard('cus')->check()) {
            return redirect()->route('home.index');
        }

        return view('site.register');
    }

    public function postRegister(Request $req)
    {
        $this->validate($req, [
            'last_name' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|regex:/^[0-9]{10,15}$/',
            'email' => 'required | email | unique:account,email',
            'username' => 'required | unique:account,username',
            'password' => 'required',
            'confirm_password' => 'required | same:password',
            'ward_id' => 'required',
            'address' => 'required'
        ], [
            'last_name.required' => 'Họ không được để trống.',
            'first_name.required' => 'Tên không được để trống.',
            'gender.required' => 'Hãy chọn giới tính.',
            'phone_number.required' => 'Số điện thoại không được để trống.',
            'phone_number.regex' => 'Hãy nhập đúng số điện thoại của bạn.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Hãy nhập đúng email của bạn.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'username.required' => 'Tên tài khoản không được để trống.',
            'username.unique' => 'Tên tài khoản đã tồn tại trong hệ thống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'confirm_password.required' => 'Mật khẩu xác nhận không được để trống.',
            'confirm_password.same' => 'Mật khẩu xác nhận phải giống với mật khẩu.',
            'ward_id.required' => 'Hãy chọn Phường/Xã.',
            'address.required' => 'Địa chỉ không được để trống.'
        ]);

        $password = bcrypt($req->password);
        $req->merge(['password' => $password]);

        Account::create($req->all());

        return redirect()->route('home.login')->with('success', 'Tạo tài khoản thành công');
    }

    public function logout()
    {
        Auth::guard('cus')->logout();

        return redirect()->to(url()->previous());
    }
}
