<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //return $next($request);
        $user = Auth::user();
        dump("Отладочная информация : ".$user);
        //sleep(5);

        //if (Auth::check()) {
            // Пользователь вошёл в систему...
            $user = Auth::user();
            //dump('пользователь в системе, перенаправление на окно просмотра панели администратора...');
            //if (Auth::user()['email'] === 'kutyovas@yandex.ru') {
            /*if (!$user->is_admin) {
                return redirect('/');
            } else {*/
            //Мы использовали фассад Auth,
            // но еще информацию о пользователе можно получить из запроса $request->user();
            if(!Auth::user()->isAdmin()){
                //dd('not admin');
                return redirect('/');
                //return redirect()->route('admin.home');
            }
        //dd(Auth::user()->isAdmin());
                return $next($request);
            //}//}

            //!!! важно, здесь надо просто продолжить, а не делать редирект
            //return redirect()->route('user');return redirect()->route('user', ['user' => $user]);
        //} else {
            //dump('пользователь не в системе, перенаправление на окно главной страницы...');
            //sleep(7);
            //return redirect('/');
            //return redirect()->route('loginAdmin');
            //метод get при перенаправке, а у нас считывание формы, поэтому просто показываем представление:

            //return response()->view('admin.loginAdmin', compact('user'));
       // }
    }

    /*
     if (Auth::guard('admin')->check()) {
  return redirect('/admin/dashboard');
}else{
  return redirect('/admin/login');
}*/
}
