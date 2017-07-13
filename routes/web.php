<?php
use Illuminate\Support\Facades\File;
// GUEST ROUTES
Route::group(['middleware' => 'web'], function()
{

    Route::get('/', function () { return view('welcome'); } );
    Route::get('/home', function(){
       return view('home');
    });
    Route::get('/logout', 'Auth\LoginController@logout');



    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');

});


    Route::get('storage/{filename}', function ($filename)
    {
        $path = storage_path('public/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });


// API
Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function()
{



    // ********** TEMPLATE API **************
    Route::resource('/template', 'TemplateController');
    Route::post('/template/duplicate', ['uses' => 'TemplateController@duplicate']);
    Route::get('/template/convertSlug/{slug}', ['uses' => 'TemplateController@slugToId']);



    // ********** FACTORY TEMPLATE API **************
    Route::resource('/factorytemplate', 'FactoryTemplateController');
    Route::get('/factorytemplate/convertSlug/{slug}/', 'FactoryTemplateController@slugToId');


    // ********* SEARCH ENGIN ************
    Route::get('/search/recipient', ['uses' => 'SearchController@searchRecipient']);
    Route::get('/search/region', ['uses' => 'SearchController@searchRegion']);
    Route::get('search/corporate', ['uses' => 'SearchController@searchCorporate']);
    Route::get('search/area', ['uses' => 'SearchController@searchArea']);



    Route::resource('/appendice', 'AppendiceController');
    Route::post('/emailer/sendToMe', ['uses' => 'MailController@sendToMe']);
    Route::post('/emailer/sendToRecipe', ['uses' => 'MailController@sendToRecipient']);
    Route::get('/generate/pdf/{id}/', ['uses' => 'PdfController@generatePdf']);

    // ************* USER MANAGEMENT **********
    Route::post('/user/update/adresse', ['uses' => 'UserController@updateAdresse']);
    Route::patch('/user/update', ['uses' => 'UserController@update']);
    Route::post('/user/updatepicture', ['uses' => 'UserController@updatePicture']);
    Route::post('/user/checkMailReserve', ['uses' => 'UserController@checkMailReserve']);
    Route::post('/addManuallyCorporate', ['uses' => 'CorporateController@addManually']);
    Route::post('/addManuallyCorporateByUser', ['uses' => 'CorporateController@addManuallyByUser']); // corporates added by user on front-end
});



Route::group(['prefix' => '/desk', 'middleware' => ['auth']], function()
{
    Route::get('/', function () { return view('application.default-desk'); } );

});



    Route::post('addManuallyCorporate', ['uses' => 'CorporateController@addManually', 'as' => 'addManuallyCorporate']);

Route::group(['prefix' => '/administrator', 'middleware' => ['auth', 'role:admin']], function()
{

    Route::get('/', function(){ return view('admin.dashboard'); });
    Route::get('/corporate/add', ['uses' => 'CorporateController@indexAddManually']);


});



Auth::routes();

