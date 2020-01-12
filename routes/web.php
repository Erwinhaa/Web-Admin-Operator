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
});

Auth::routes();
//History Controller
Route::get('/history','HistoryController@index');
Route::post('/historysaldo/cari','HistoryController@cari');
Route::get('/ticketinfo','HistoryController@listticket');
Route::get('/ticketinfo/{id}','HistoryController@infoticket');
Route::post('/historyticket/cari','HistoryController@cariticket');
Route::get('/transaksi/{id}','HistoryController@infokeuangan');
Route::post('/transaksi/cari','HistoryController@caritransaksi');

Route::get('/transaksiop','OrderOpController@infokeuangan');
Route::post('/transaksiop/cari','OrderOpController@caritransaksi');
//Ticket Controller
Route::get('/order/custom','TicketController@index');
Route::get('/ticket/{id}','TicketController@indexticket');  
Route::get('/ganti/{tid}/lantai/{lid}','TicketController@gantiticket');
Route::post('/order/cari','TicketController@cari');
Route::post('/gantislot/ganti','TicketController@gantislotticket');
//Operator Controller
Route::get('/operator/login','Auth\OperatorLoginController@showLoginForm')->name('operator.login');
Route::post('/operator/login','Auth\OperatorLoginController@login')->name('operator.login.submit');
Route::get('/operator','OperatorController@index')->name('operator.dashboard');
Route::get('/operator/lantai/{id}','OperatorController@indexlantai');//
Route::get('/opprofile','OperatorController@profile');//Halaman Profile Operator
Route::get('/algorit','OperatorController@algo');//Untuk Check Ocr
Route::get('/tutupgedung','OperatorController@tutupgedung');//Untuk Tutup Gedung
//Gedung Controller
Route::get('/gedung/{id}/tambah','GedungController@create');
Route::get('/gedung/{id}','GedungController@infogedung');
Route::post('/gedung/store','GedungController@store');
Route::post('/gedung/update','GedungController@update');  
Route::get('/gedung','GedungController@gedung');
//Saldo Controller
Route::get('/saldo','SaldoController@info');//List User
Route::get('/saldo/{id}','SaldoController@infouser');//Specific Info Saldo User
Route::post('/saldo/tambah','SaldoController@tambah');//Fungsi Untuk Tambah Saldo
Route::post('/saldo/cari','SaldoController@cari');//Fungsi Untuk Cari Data
//SlotAdminController
Route::get('/slot/custom','SlotParkirController@custom');//List Gedung
Route::post('/slot/editlantai','SlotParkirController@editlantai');
route::get('/slot/{id}','SlotParkirController@index');//
Route::get('/slotparkir/{id}','LantaiController@slotindex');//Info Detail Slot
route::post('/slot/show','SlotParkirController@show');
Route::get('/slot/{id}/add','SlotParkirController@tambah10');//Tambah Slot Parkir
Route::post('/slot/delete','SlotParkirController@delete');
Route::post('/slotparkir/editinfo','SlotParkirController@store');   
Route::post('/slotparkir/deleteinfo','SlotParkirController@store1'); 
ROute::post('/slot/cari','SlotParkirController@cari');
Route::post('/slot/tambahlantai','SlotParkirController@tambahlantai');
//AdminController
Route::get('/userinfo','AdminController@infouser');
Route::post('/userinfo/search','AdminController@searchuser');
Route::get('/admin','AdminController@Index')->name('admin.dashboard');
Route::get('/slotoperator/{id}/deleteconfirm','AdminController@deleteconfirm');
Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/daftarop','AdminController@daftar');
Route::post('/daftarop/store','AdminController@store');
Route::get('/operatorinfo','AdminController@opindex');
Route::post('/operatorinfo/search','AdminController@search');
Route::get('/slotoperator/{id}/edit','AdminController@edit');
Route::get('/useroperator/{id}/edit','AdminController@datauser');
Route::post('/slotoperator/delete','AdminController@hapus');
Route::post('/slotoperator/ganti','AdminController@ganti');
Route::get('/slotoperator/{id}','AdminController@infooperator');
Route::post('/slotoperator/edit','AdminController@editaccount');
Route::get('/userinfo/{id}','AdminController@datauser');
//OperatorSlotController
Route::get('/opslotoperator/layout/','OperatorSlotController@index');
Route::get('/opslotlantai/{id}','OperatorSlotController@indexlantai');
Route::post('/opslot/deletelantai','OperatorSlotController@deletelantai');
Route::post('/opslot/tambahlantai','OperatorSlotController@tambahlantai');
Route::post('/opslot/editlantai','OperatorSlotController@editlantai');
Route::get('/opslot/{id}/add','OperatorSlotController@tambah10');
Route::post('/opslot/delete','OperatorSlotController@delete10');
//SlotOperatorParkirController
Route::get('/lantaisetpintuop/{id}','SlotOperatorParkirController@indexpintu');
Route::post('/lantaisetpintuop/tambah','SlotOperatorParkirController@tambahpintu');
Route::get('/lantaisetarahop/{id}','SlotOperatorParkirController@indexarah');
Route::post('/lantaisetarahop/tambah','SlotOperatorParkirController@tambaharah');
Route::get('/lantaideleteitemop/{id}','SlotOperatorParkirController@indexdeleteitem');
Route::post('/lantaideleteitemop/delete','SlotOperatorParkirController@deleteitem');
Route::get('/oplantaitest/{id}','SlotOperatorParkirController@indextambah');
Route::get('/oplantaitestdelete/{id}','SlotOperatorParkirController@indexdelete');
Route::post('/oplantaitest/tambah','SlotOperatorParkirController@tambah');
Route::post('/oplantaitest/delete','SlotOperatorParkirController@delete');
Route::get('/opslotparkir/{id}','SlotOperatorParkirController@indexslot');
Route::post('/opslotparkir/editinfo','SlotOperatorParkirController@store');   
Route::post('/opslotparkir/deleteinfo','SlotOperatorParkirController@store1'); 
//Lantai Controller
Route::get('/lantaideleteitem/{id}','LantaiController@deleteitem');
Route::post('/lantaideleteitem/delete','LantaiController@itemdelete');
Route::get('/lantaisetpintu/{id}','LantaiController@setpintu');
Route::post('/lantaisetpintu/tambah','LantaiController@tambahpintu');
Route::get('/lantaisetarah/{id}','LantaiController@setarah');
Route::post('/lantaisetarah/tambah','LantaiController@tambaharah');
Route::post('/lantaitest/tambah','LantaiController@tambahtest');
Route::post('/lantaitestdelete/delete','LantaiController@deletetest');
Route::get('/lantaitestdelete/{id}','LantaiController@index2');
Route::get('/lantai/{id}','LantaiController@index');
Route::get('/lantaitest/{id}','LantaiController@index1');
Route::post('/slot/deletelantai','SlotParkirController@deletelantai');
Route::post('/lantai/tambahlayout','LantaiController@tambah');

//test Controller

Route::get('/transaksi','SlotParkirController@customed');//List Gedung
Route::post('/listgedung/cari','SlotParkirController@caried');//List Gedung
//Test Api 
Route::get('/testlogin','TestApiController@login');
//Notifikasi Controller
Route::get('/notif','NotifikasiController@notifikasi');
Route::get('/notif/{id}','NotifikasiController@indexnotifikasi');
Route::post('/notif/cari','NotifikasiController@cari');
Route::post('/notif/ganti','NotifikasiController@ganti');
//Mode Test Controller 
//==============================================================================
//User Controller
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','HomeController@profile')->name('Profile');

//Mobil Controller
Route::get('/mobil/tambah','HomeController@tambah')->name('TambahMobil');
Route::get('/mobil','MobilController@index');
Route::get('/mobil/{id}/edit','MobilController@edit');
Route::post('/mobil/store','MobilController@store')->name('AddData');
Route::post('/mobil/update','MobilController@update');  
route::get('/mobil/{id}/hapus','MobilController@hapus');

//ajax api 
route::view('admin/test','lantai.data',[
    'ticket' => App\Ticket::all()
]);
Route::get('/operatoz/lantai/{id}','TestApiController@lantai');
Route::get('/datalistticket','TestApiController@data');

//UserControllerTest
Route::get('/user/gedung','UserTest\GedungTestController@listgedung');
Route::get('/testocr','UserTest\GedungTestController@testocr');
Route::get('/user/gedung/{id}','UserTest\GedungTestController@infogedung');
Route::get('user/lantai/{id}','UserTest\GedungTestController@infolantai');
Route::get('/user/slot/{sid}','UserTest\GedungTestController@infopesan');
Route::get('/mobil/share','UserTest\GedungTestController@infoshare');
Route::post('/mobil/share/cari','UserTest\GedungTestController@carimobil');
Route::get('/cancelorder','UserTest\GedungTestController@indexcancel');
Route::get('/mobil/{iduser}/share/{id}','UserTest\GedungTestController@indexshare');
Route::get('/kirimnotif','UserTest\GedungTestController@sendnotif');
Route::get('/kirimnotif/{id}/lantai/{lid}','UserTest\GedungTestController@ubahslot');