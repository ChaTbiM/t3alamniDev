<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/student', 'StudentController@index')->name('student');
Route::get('/teacher', 'TeacherController@index')->name('teacher');
// Route::get('/teacher/schedule', 'TeacherController@index')->name('teacher');
Route::get('/teacher/groups', 'TeacherController@index')->name(
    'teacher.groups'
);

// Route::get('/teacher/{any}', function () {
//     return view('teacher.teacher');
// })->where('any', '^(?!storage).*$');

// Admin  ---------------------------------------------------------------------------------------------

Route::get('login/admin', 'AdminAuth\LoginController@showLoginForm')->name(
    'admin.login'
);
Route::post('login/admin', 'AdminAuth\LoginController@login')->name(
    'admin.login'
);
Route::get(
    'register/admin',
    'AdminAuth\RegisterController@showRegistrationForm'
)->name('admin.register');
Route::post('register/admin', 'AdminAuth\RegisterController@register')->name(
    'admin.register'
);
Route::post('admin/logout', 'AdminAuth\LoginController@logout')->name(
    'admin.logout'
);

Route::get(
    'admin/password/reset',
    'AdminAuth\ForgotPasswordController@showLinkRequestForm'
)->name('admin.password.request');
Route::post(
    'admin/password/email',
    'AdminAuth\ForgotPasswordController@sendResetLinkEmail'
)->name('admin.password.email');
Route::get(
    'admin/password/reset/{token}',
    'AdminAuth\ResetPasswordController@showResetForm'
)->name('admin.password.reset');
Route::post(
    'admin/password/reset',
    'AdminAuth\ResetPasswordController@reset'
)->name('admin.password.update');

Route::get('admin/email/verify', 'AdminAuth\VerificationController@show')->name(
    'admin.verification.notice'
);
Route::get(
    'admin/email/verify/{id}',
    'AdminAuth\VerificationController@verify'
)->name('admin.verification.verify');
Route::get(
    'admin/email/resend',
    'AdminAuth\VerificationController@resend'
)->name('admin.verification.resend');

// Student ---------------------------------------------------------------------------------------------
Route::get('login/student', 'StudentAuth\LoginController@showLoginForm')->name(
    'student.login'
);
Route::post('login/student', 'StudentAuth\LoginController@login')->name(
    'student.login'
);
Route::get(
    'register/student',
    'StudentAuth\RegisterController@showRegistrationForm'
)->name('student.register');
Route::post(
    'register/student',
    'StudentAuth\RegisterController@register'
)->name('student.register');
Route::post('student/logout', 'StudentAuth\LoginController@logout')->name(
    'student.logout'
);

Route::get(
    'student/password/reset',
    'StudentAuth\ForgotPasswordController@showLinkRequestForm'
)->name('student.password.request');
Route::post(
    'student/password/email',
    'StudentAuth\ForgotPasswordController@sendResetLinkEmail'
)->name('student.password.email');
Route::get(
    'student/password/reset/{token}',
    'StudentAuth\ResetPasswordController@showResetForm'
)->name('student.password.reset');
Route::post(
    'student/password/reset',
    'StudentAuth\ResetPasswordController@reset'
)->name('student.password.update');

Route::get(
    'student/email/verify',
    'StudentAuth\VerificationController@show'
)->name('student.verification.notice');
Route::get(
    'student/email/verify/{id}',
    'StudentAuth\VerificationController@verify'
)->name('student.verification.verify');
Route::get(
    'student/email/resend',
    'StudentAuth\VerificationController@resend'
)->name('student.verification.resend');

// //teacher ---------------------------------------------------------------------------------------------
Route::get('login/teacher', 'TeacherAuth\LoginController@showLoginForm')->name(
    'teacher.login'
);
Route::post('login/teacher', 'TeacherAuth\LoginController@login')->name(
    'teacher.login'
);
Route::get(
    'register/teacher',
    'TeacherAuth\RegisterController@showRegistrationForm'
)->name('teacher.register');
Route::post(
    'register/teacher',
    'TeacherAuth\RegisterController@register'
)->name('teacher.register');
Route::post('teacher/logout', 'TeacherAuth\LoginController@logout')->name(
    'teacher.logout'
);

Route::get(
    'teacher/password/reset',
    'TeacherAuth\ForgotPasswordController@showLinkRequestForm'
)->name('teacher.password.request');
Route::post(
    'teacher/password/email',
    'TeacherAuth\ForgotPasswordController@sendResetLinkEmail'
)->name('teacher.password.email');
Route::get(
    'teacher/password/reset/{token}',
    'TeacherAuth\ResetPasswordController@showResetForm'
)->name('teacher.password.reset');
Route::post(
    'teacher/password/reset',
    'TeacherAuth\ResetPasswordController@reset'
)->name('teacher.password.update');

Route::get(
    'teacher/email/verify',
    'TeacherAuth\VerificationController@show'
)->name('teacher.verification.notice');
Route::get(
    'teacher/email/verify/{id}',
    'TeacherAuth\VerificationController@verify'
)->name('teacher.verification.verify');
Route::get(
    'teacher/email/resend',
    'TeacherAuth\VerificationController@resend'
)->name('teacher.verification.resend');

Route::get('teacher/fixed', 'TeacherController@getFixed')->name(
    'getFixedSessions'
);
Route::post('teacher/fixed', 'TeacherController@addFixed')->name(
    'addFixedSessions'
);

Route::get('teacher/simple', 'TeacherController@getSimple')->name(
    'getSimpleSessions'
);
Route::post('teacher/simple', 'TeacherController@addSimple')->name(
    'addSimpleSessions'
);

Route::get('teacher/groups/joined', 'GroupsController@getStudents')->name(
    'getGroupsStudents'
);

Route::get('teacher/groups/search', 'TeacherController@search')->name(
    'searchStudents'
);

// test upload
// Route::get('teacher/test', 'TeacherController@testIndex');
// Route::post('teacher/fixed', 'TeacherController@addFixed')->name('upload');
