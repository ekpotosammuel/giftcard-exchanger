<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CollectionModeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
|--------------------------------------------------------------------------
| Auth Route
|--------------------------------------------------------------------------
|
*/

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/forget', [ForgetPasswordController::class, 'forget'])->name('forget');
Route::post('/reset', [ResetPasswordController::class, 'reset']);
/*
|--------------------------------------------------------------------------
| Country Route
|--------------------------------------------------------------------------
|
*/
Route::prefix('country')->group(function(){
    Route::get('/', [CountryController::class, 'index']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Profile Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('profile')->group(function(){
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::get('/', [UserProfileController::class, 'index']);
            Route::get('/all/{id}', [UserProfileController::class, 'allProfile']);

        });
        Route::get('/{id}', [UserProfileController::class, 'show']);
        Route::post('/', [UserProfileController::class, 'update']);
    });
    /*
    |--------------------------------------------------------------------------
    | Currency Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('currency')->group(function(){
        Route::get('/', [CurrencyController::class, 'index']);
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::post('/', [CurrencyController::class, 'store']);
            Route::post('/{id}', [CurrencyController::class, 'show']);
            Route::delete('/{id}', [CurrencyController::class, 'SoftDeletes']);
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Role Route
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['middleware' => ['admin.auth']], function(){
        Route::prefix('role')->group(function(){
            Route::get('/', [RoleController::class, 'index']);
            Route::post('/', [RoleController::class, 'store']);
            Route::get('/{id}', [RoleController::class, 'show']);
            Route::post('/{id}', [RoleController::class, 'update']);
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Collection Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('collection')->group(function(){
        Route::get('/', [CollectionModeController::class, 'index']);
    });
    /*
    |--------------------------------------------------------------------------
    | User Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('user')->group(function(){
        Route::delete('/', [UserController::class, 'SoftDeletes']);
    });
    /*
    |--------------------------------------------------------------------------
    | Product Type Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('product-type')->group(function(){
        Route::get('/',         [ProductTypeController::class, 'index']);
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::post('/',        [ProductTypeController::class, 'store']);
            Route::get('/{id}',     [ProductTypeController::class, 'show']);
            Route::post('/{id}',    [ProductTypeController::class, 'update']);
            Route::delete('/{id}',  [ProductTypeController::class, 'SoftDeletes']);
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Product Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('product')->group(function(){
        Route::post('/',     [ProductController::class, 'store']);
        Route::get('/{id}',  [ProductController::class, 'show']);
        Route::get('/',  [ProductController::class, 'userTrade']);
    });
    /*
    |--------------------------------------------------------------------------
    | Image Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('images')->group(function(){
        Route::post('/', [ProductImage::class, 'store']);
    });
    /*
    |--------------------------------------------------------------------------
    | Transaction Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('transaction')->group(function(){
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::get('/all', [TransactionController::class, 'index']);
        });
        Route::get('/', [TransactionController::class, 'userTransaction']);
    });
    /*
    |--------------------------------------------------------------------------
    | Rate Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('rate')->group(function(){
        Route::get('/',        [RateController::class, 'index']);
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::get('/{id}',    [RateController::class, 'show']);
            Route::post('/{id}',   [RateController::class, 'update']);
            Route::delete('/{id}', [RateController::class, 'SoftDeletes']);
         });
    });


    /*
    |--------------------------------------------------------------------------
    | Ticket Type Route
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['middleware' => ['admin.auth']], function(){
        Route::prefix('ticket-type')->group(function(){
            Route::get('/', [TicketTypeController::class, 'index']);
            Route::post('/', [TicketTypeController::class, 'store']);
            Route::get('/{id}', [TicketTypeController::class, 'show']);
            Route::post('/{id}', [TicketTypeController::class, 'update']);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Ticket Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('ticket')->group(function(){
        Route::post('/', [TicketController::class, 'store']);
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::get('/', [TicketController::class, 'index']);
            Route::get('/{id}', [TicketController::class, 'show']);
            // Route::post('/{id}', [TicketController::class, 'update']);
        });

    });


        /*
    |--------------------------------------------------------------------------
    | Status Route
    |--------------------------------------------------------------------------
    |
    */
    Route::prefix('status')->group(function(){
        Route::get('/', [StatusController::class, 'index']);
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::get('/{id}', [StatusController::class, 'show']);
        });

    });

    Route::group(['middleware' => ['admin.auth']], function(){
        Route::prefix('trade')->group(function(){
            Route::get('/pending',     [TradeController::class, 'pending']);
            Route::get('/successful',  [TradeController::class, 'successful']);
            Route::get('/decline',  [TradeController::class, 'decline']);
            Route::get('/all',  [TradeController::class, 'all']);
            Route::get('/{id}',  [TradeController::class, 'show']);
            Route::post('/{id}',  [TradeController::class, 'sell']);
        });
    });

    Route::get('All-Trade',         [TradeController::class, 'allTradeForUser']);
    Route::get('Successful-Trade',  [TradeController::class, 'successfulTradeForUser']);
    Route::get('Pending-Trade',     [TradeController::class, 'pendingTradeForUser']);
    Route::get('Decline-Trade',     [TradeController::class, 'declineTradeForUser']);
    Route::group(['middleware' => ['admin.auth']], function(){
        Route::post('rate/amount/{id}',       [CountryController::class, 'update']);
        Route::get('rate/amount/{id}',       [CountryController::class, 'show']);
    });

    Route::post('/changepassword', [UserController::class, 'changePassword']);


});
