<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\App\Dashboard\Deposito;
use App\Http\Livewire\App\Dashboard\P2pLending;
use App\Http\Controllers\DataNominatifPembiayaan;
use App\Http\Livewire\App\Dashboard\P2p\Data\Register;
use App\Http\Livewire\App\Dashboard\NominatifPembiayaan;
use App\Http\Livewire\App\Dashboard\P2p\Data\Detail as LendingDetail;

use App\Http\Livewire\App\Dashboard\Transaksi\TransaksiAngsuran;
use App\Http\Livewire\App\Dashboard\P2p\Analisa\QuickAnalysisIndex;
use App\Http\Livewire\App\Dashboard\P2p\Analisa\QuickAnalysisDetail;
use App\Http\Livewire\App\Dashboard\P2p\Analisa\AnalisaKeuangan;
use App\Http\Livewire\App\Dashboard\P2p\ActivityCalendar;
// use App\Http\Livewire\App\Dashboard\P2p\Analisa\AnalisaKeuanganDetail;
use App\Http\Livewire\App\Dashboard\P2p\AnalisaKeuangan\Index as AnalisaKeuanganIndex;
use App\Http\Livewire\App\Dashboard\P2p\AnalisaKeuangan\Register as AnalisaKeuanganRegister;
use App\Http\Livewire\App\Dashboard\P2p\AnalisaKeuangan\Detail as AnalisaKeuanganDetail;

// data borrower
use App\Http\Livewire\App\Dashboard\P2p\DataBorrower\Index as BorrowerIndex;
use App\Http\Livewire\App\Dashboard\P2p\DataBorrower\Register as BorrowerRegister;
use App\Http\Livewire\App\Dashboard\P2p\DataBorrower\Detail as BorrowerDetail;


use App\Http\Livewire\App\Dashboard\P2p\DataFintech\Index as FintechIndex;
use App\Http\Livewire\App\Dashboard\P2p\DataFintech\Register as FintechRegister;
use App\Http\Livewire\App\Dashboard\P2p\DataFintech\Detail as FintechDetail;


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
    // return view('welcome');
    return redirect()->route('dashboard.p2p-lending');
});

Route::group(['middleware' => 'guest'], function(){

    //login
    Route::get('/dashboard/login',Login::class)->name('dashboard.login');

});

Route::get('/admin/login',function(){
    return redirect()->route('dashboard.login');
});

Route::group(['middleware' => 'auth'], function(){

    Route::get('/admin/login',function(){
        return redirect()->route('dashboard.login');
    });
    //dashboard p2p-lending
    Route::get('/dashboard/p2p-lending',P2pLending::class)->name('dashboard.p2p-lending');
    Route::get('/dashboard/deposito',Deposito::class)->name('dashboard.deposito');
    Route::get('/dashboard/nominatif-pembiayaan',NominatifPembiayaan::class)->name('dashboard.nominatif-pembiayaan');
    Route::get('/dashboard/nominatif-pembiayaan/data/{status}',[DataNominatifPembiayaan::class,'data'])->name('dashboard.nominatif-pembiayaan.data');
    Route::get('/logout',Logout::class)->name('dashboard.logout');
    Route::get('/transaksi/angsuran',TransaksiAngsuran::class)->name('transaksi.angsuran');
    Route::get('/analisa/quick-analysis',QuickAnalysisIndex::class)->name('analisa.quick-analysis');
    Route::get('/analisa/analisa-keuangan',AnalisaKeuanganIndex::class)->name('analisa.keuangan');
    Route::get('/analisa/analisa-keuangan/register',AnalisaKeuanganRegister::class)->name('analisa.keuangan.register');
    Route::get('/analisa/analisa-keuangan/detail/{id}',AnalisaKeuanganDetail::class)->name('analisa.keuangan.detail');
    Route::get('/dashboard/activity-calendar',ActivityCalendar::class)->name('dashboard.activity-calendar');
    
    Route::get('/data/borrower/detail/{id}',BorrowerDetail::class)->name('data.borrower.detail');
    Route::get('/data/borrower',BorrowerIndex::class)->name('data.borrower');


    // Route::get('/analisa/analisa-keuangan-detail/{id}',AnalisaKeuanganDetail::class)->name('analisa.keuangan.detail');
    Route::get('/analisa/quick-analysis-detail/{id}',QuickAnalysisDetail::class)->name('analisa.quick-analysis.detail');
    Route::get('/data/register', Register::class)->name('data.register');
    Route::get('/data/detail/{id}', LendingDetail::class)->name('data.detail');

    Route::get('/data/finteches',FintechIndex::class)->name('data.finteches');
    Route::get('/data/finteches/register',FintechRegister::class)->name('data.fintech.register');
    Route::get('/data/finteches/detail/{id}',FintechDetail::class)->name('data.fintech.detail');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/admin/login',function(){
        return redirect()->route('dashboard.login');
    });
});
