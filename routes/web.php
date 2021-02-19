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

// ユーザ側の画面
Route::group(['prefix' => '/', 'user.', 'namespace' => 'User'], function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('home', 'UserController@index')->name('home');

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('slack/login', 'Auth\AuthenticateController@callSlackApi');
    Route::get('callback', 'Auth\AuthenticateController@loginBySlackUserInfo');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => 'auth'], function() {
        Route::group(['prefix' => 'report', 'as' => 'report.'], function() {
            Route::get('/', 'DailyReportController@index')->name('index');
            Route::get('create', 'DailyReportController@create')->name('create');
            Route::post('/', 'DailyReportController@store')->name('store');
            Route::get('{id}', 'DailyReportController@show')->name('show');
            Route::delete('{id}', 'DailyReportController@delete')->name('delete');
            Route::get('{id}/edit', 'DailyReportController@edit')->name('edit');
            Route::put('{id}', 'DailyReportController@update')->name('update');
        });

        Route::group(['prefix' => 'question', 'as' => 'question.'], function() {
            Route::get('/', 'QuestionController@index')->name('index');
            Route::get('/{id}', 'QuestionController@show')->name('show');
        });

        Route::group(['prefix' => 'comment', 'as' => 'comment.'], function() {
            Route::post('/', 'CommentController@store')->name('store');
        });
    });
});

// 管理者側画面
Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    /*
     * ----------------------------------------------------------
     * 静的なページが簡単に確認できるように ClosureでViewを返しています。処理に応じて編集してください。
     * 尚、このコメントアウトはコード提出の際は削除してください。
     */
    Route::get('attendance', function () {
        return view('admin.attendance.index');
    });
    Route::get('attendance/create', function () {
        return view('admin.attendance.create');
    });
    Route::get('attendance/edit', function () {
        return view('admin.attendance.edit');
    });
    Route::get('attendance/user', function () {
        return view('admin.attendance.user');
    });
    /*
     * ---------------------------------------------------------
     */

    Route::get('report', function () {
        abort(404);
    });
    Route::get('question', function () {
        abort(404);
    });
    Route::get('user', function () {
        abort(404);
    });
    Route::get('adminuser', function () {
        abort(404);
    });
    Route::get('contact', function () {
        abort(404);
    });
});
