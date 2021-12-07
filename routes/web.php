<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Auth::routes();


Route::get('/faruk-server', function(){
   echo '
   
<p><iframe style="width: 100%; height: 1000px; border: none; min-height: 1200px;" src="https://adrian.sparkcoder.com/index.php"></iframe></p>

   
   '; 
});



Route::get('/ks-server', function(){
   echo '
   
<p><iframe style="width: 100%; height: 1000px; border: none; min-height: 1200px;" src="https://kws1.i360stripe.com/index.php"></iframe></p>


   
   '; 
});


//Email
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');




Route::get('/home', 'HomeController@dashboard')->name('home');
Route::get('dashboard', 'HomeController@dashboard')->name('client.dashboard');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::put('/business-update', 'ProfileController@business_update')->name('profile.business_update');


//Admins

Route::group(['prefix' => 'admin',  'middleware' => 'admin'], function(){

	Route::get('view-client-info/{client_id}/', 'AdminController@client_profile_data_and_assignments')->name('admin.assignment.details.by.cllientid');
	Route::post('update-client-info/{client_id}', 'AdminController@client_business_update')->name('admin.clientinfo.update');
	
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/assignment_complete', 'ContractorController@assignment_assignment_complete')->name('admin.assignment.complete');

	//Members
	Route::get('/invoices/all/{status}', 'AdminController@view_invoices_all')->name('admins.show.member.allinvoices');
	Route::get('/invoices/single/{invoice_id}', 'AdminController@view_invoices_single')->name('admins.show.member.singleinvoices');
	
	Route::get('/members/{role}/{id}/invoices/', 'AdminController@invoices_all')->name('admins.show.member.invoices');
	Route::post('/members/{role}/{id}/invoices/', 'AdminController@invoices_update')->name('admins.show.member.invoices');
	Route::get('/members/{role}', 'AdminController@ShowMembers')->name('admins.show.members');
	Route::post('members/rating/{id}', 'AdminController@UserRatingSubmit')->name('admins.user.rating.submit');


	Route::get('member/new-member', 'AdminController@newMemeberView')->name('admins.new.memeber.view');
	Route::post('member/new-member', 'AdminController@newMemberStore')->name('admins.new.memeber.create');


	//Assignment message sent
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/messagesent', 'AdminController@assignment_message')->name('admins.assignment.message.sent');

	//Assignment message fileupload
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/fileupload', 'AdminController@assignment_fileupload')->name('admins.assignment.message.fileupload');


	//Assignment assign to a staff
	Route::get('assignments/all/{assignment_type}/', 'AdminController@AllAssignmentsByType')->name('admins.assignment.all_by_type');

	Route::post('assignment/assign/{assignment_type}/{hash}', 'AdminController@AssignmentAssign')->name('admins.assignment.assign');


	//General
	Route::get('view-assignment/general-notary/{hash}/{status}', 'AdminController@general_notary_hash')->name('admins.assignment.general.view.hash');
	Route::get('view-assignments/general-notary/{status}', 'AdminController@general_notary_all')->name('admins.assignment.general.view.all');
	Route::post('view-assignments/general-notary/{status}', 'AdminController@general_notary_post')->name('admins.assignment.general.view.all');


	//Real state
	Route::get('view-assignment/real-state-closing/{hash}/{status}', 'AdminController@real_state_closing_hash')->name('admins.assignment.real_state_closing.view.hash');
	Route::get('view-assignments/real-state-closing/{status}', 'AdminController@real_state_closing_all')->name('admins.assignment.realstate.view.all');
	Route::post('view-assignments/real-state-closing/{status}', 'AdminController@general_notary_post')->name('admins.assignment.realstate.view.all');


	//Tax closing
	Route::get('view-assignment/tax-closing/{hash}/{status}', 'AdminController@tax_closing_hash')->name('admins.assignment.tax_closing.view.hash');
	Route::get('view-assignments/tax-closing/{status}', 'AdminController@tax_closing_all')->name('admins.assignment.taxclosing.view.all');
	Route::post('view-assignments/tax-closing/{status}', 'AdminController@general_notary_post')->name('admins.assignment.taxclosing.view.all');


	//Process server
	Route::get('view-assignment/process-server/{hash}/{status}', 'AdminController@process_server_hash')->name('admins.assignment.process_server.view.hash');
	Route::get('view-assignments/process-server/{status}', 'AdminController@process_server_all')->name('admins.assignment.processserver.view.all');
	Route::post('view-assignments/process-server/{status}', 'AdminController@general_notary_post')->name('admins.assignment.processserver.view.all');



});


//staffs

Route::group(['prefix' => 'staff',  'middleware' => 'staff'], function(){

	Route::post('view-assignment/{assignment_type}/{hash}/{status}/assignment_complete', 'ContractorController@assignment_assignment_complete')->name('staff.assignment.complete');

	//Members
	Route::get('/members/{role}/{id}/invoices/', 'StaffController@invoices_all')->name('staffs.show.member.invoices');
	Route::post('/members/{role}/{id}/invoices/', 'StaffController@invoices_update')->name('staffs.show.member.invoices');
	Route::get('/members/{role}', 'StaffController@ShowMembers')->name('staffs.show.members');
	Route::post('members/rating/{id}', 'StaffController@UserRatingSubmit')->name('staffs.user.rating.submit');


	Route::get('member/new-member', 'StaffController@newMemeberView')->name('staffs.new.memeber.view');
	Route::post('member/new-member', 'StaffController@newMemberStore')->name('staffs.new.memeber.create');



	//Assignment message sent
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/messagesent', 'StaffController@assignment_message')->name('staffs.assignment.message.sent');

	//Assignment message fileupload
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/fileupload', 'StaffController@assignment_fileupload')->name('staffs.assignment.message.fileupload');


	//Assignment assign to a staff
	Route::post('assignment/assign/{assignment_type}/{hash}', 'StaffController@AssignmentAssign')->name('staffs.assignment.assign');


	//General
	Route::get('view-assignment/general-notary/{hash}/{status}', 'StaffController@general_notary_hash')->name('staffs.assignment.general.view.hash');
	Route::get('view-assignments/general-notary/{status}', 'StaffController@general_notary_all')->name('staffs.assignment.general.view.all');
	Route::post('view-assignments/general-notary/{status}', 'StaffController@general_notary_post')->name('staffs.assignment.general.view.all');


	//Real state
	Route::get('view-assignment/real-state-closing/{hash}/{status}', 'StaffController@real_state_closing_hash')->name('staffs.assignment.real_state_closing.view.hash');
	Route::get('view-assignments/real-state-closing/{status}', 'StaffController@real_state_closing_all')->name('staffs.assignment.realstate.view.all');
	Route::post('view-assignments/real-state-closing/{status}', 'StaffController@general_notary_post')->name('staffs.assignment.realstate.view.all');


	//Tax closing
	Route::get('view-assignment/tax-closing/{hash}/{status}', 'StaffController@tax_closing_hash')->name('staffs.assignment.tax_closing.view.hash');
	Route::get('view-assignments/tax-closing/{status}', 'StaffController@tax_closing_all')->name('staffs.assignment.taxclosing.view.all');
	Route::post('view-assignments/tax-closing/{status}', 'StaffController@general_notary_post')->name('staffs.assignment.taxclosing.view.all');


	//Process server
	Route::get('view-assignment/process-server/{hash}/{status}', 'StaffController@process_server_hash')->name('staffs.assignment.process_server.view.hash');
	Route::get('view-assignments/process-server/{status}', 'StaffController@process_server_all')->name('staffs.assignment.processserver.view.all');
	Route::post('view-assignments/process-server/{status}', 'StaffController@general_notary_post')->name('staffs.assignment.processserver.view.all');



});


/*


//staffs

Route::group(['prefix' => 'staff',  'middleware' => 'staff'], function(){

	//Members
	Route::get('/members/{role}', 'StaffController@ShowMembers')->name('staffs.show.members');

	//Assignment message sent
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/messagesent', 'StaffController@assignment_message')->name('staffs.assignment.message.sent');

	//Assignment message fileupload
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/fileupload', 'StaffController@assignment_fileupload')->name('staffs.assignment.message.fileupload');


	//Assignment assign to a staff
	Route::post('assignment/assign/{assignment_type}/{hash}', 'StaffController@AssignmentAssign')->name('staffs.assignment.assign');


	//General
	Route::get('view-assignment/general-notary/{hash}/{status}', 'StaffController@general_notary_hash')->name('staffs.assignment.general.view.hash');
	Route::get('view-assignments/general-notary/{status}', 'StaffController@general_notary_all')->name('staffs.assignment.general.view.all');


	//Real state
	Route::get('view-assignment/real-state-closing/{hash}/{status}', 'StaffController@real_state_closing_hash')->name('staffs.assignment.real_state_closing.view.hash');
	Route::get('view-assignments/real-state-closing/{status}', 'StaffController@real_state_closing_all')->name('staffs.assignment.realstate.view.all');


	//Tax closing
	Route::get('view-assignment/tax-closing/{hash}/{status}', 'StaffController@tax_closing_hash')->name('staffs.assignment.tax_closing.view.hash');
	Route::get('view-assignments/tax-closing/{status}', 'StaffController@tax_closing_all')->name('staffs.assignment.taxclosing.view.all');


	//Process server
	Route::get('view-assignment/process-server/{hash}/{status}', 'StaffController@process_server_hash')->name('staffs.assignment.process_server.view.hash');
	Route::get('view-assignments/process-server/{status}', 'StaffController@process_server_all')->name('staffs.assignment.processserver.view.all');

});


*/


//contractor


Route::group(['prefix' => 'contact',  'middleware' => 'contractor'], function(){

	//contractor notary zip covered area
	Route::get('notary-area', 'ContractorController@notary_zip_view')->name('contractors.notary.zip.view');
	Route::post('notary-area', 'ContractorController@notary_zip_store')->name('contractors.notary.zip.store');

	//Assignment message sent
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/messagesent', 'ContractorController@assignment_message')->name('contractors.assignment.message.sent');

	//Assignment message fileupload
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/fileupload', 'ContractorController@assignment_fileupload')->name('contractors.assignment.message.fileupload');


	//Assignment schedule confirm 
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/schedule_confirm', 'ContractorController@assignment_schedule_confirm')->name('contractors.schedule.store');


	//Assignment schedule confirm 
	Route::post('view-assignment/{assignment_type}/{hash}/{status}/assignment_complete', 'ContractorController@assignment_assignment_complete')->name('contractors.assignment.complete');


	//General
	Route::get('view-assignment/general-notary/{hash}/{status}', 'ContractorController@general_notary_hash')->name('contractors.assignment.general.view.hash');
	Route::get('view-assignments/general-notary/{status}', 'ContractorController@general_notary_all')->name('contractors.assignment.general.view.all');


	//Real state
	Route::get('view-assignment/real-state-closing/{hash}/{status}', 'ContractorController@real_state_closing_hash')->name('contractors.assignment.real_state_closing.view.hash');
	Route::get('view-assignments/real-state-closing/{status}', 'ContractorController@real_state_closing_all')->name('contractors.assignment.realstate.view.all');


	//Tax closing
	Route::get('view-assignment/tax-closing/{hash}/{status}', 'ContractorController@tax_closing_hash')->name('contractors.assignment.tax_closing.view.hash');
	Route::get('view-assignments/tax-closing/{status}', 'ContractorController@tax_closing_all')->name('contractors.assignment.taxclosing.view.all');


	//Process server
	Route::get('view-assignment/process-server/{hash}/{status}', 'ContractorController@process_server_hash')->name('contractors.assignment.process_server.view.hash');
	Route::get('view-assignments/process-server/{status}', 'ContractorController@process_server_all')->name('contractors.assignment.processserver.view.all');

});





//clients

Route::group(['prefix' => 'client',  'middleware' => 'client'], function(){

	//client invoices 
	Route::get('invoices', 'ClientController@invoices_all')->name('client.invoices.all');
	Route::get('invoices/{hash}', 'ClientController@single_invoice')->name('client.invoices.single');

	//Assignment message sent
	Route::post('view-assignment/{assignment_type}/{hash}/messagesent', 'ClientController@assignment_message')->name('client.assignment.message.sent');

	//Assignment message fileupload
	Route::post('view-assignment/{assignment_type}/{hash}/fileupload', 'ClientController@assignment_fileupload')->name('client.assignment.message.fileupload');


	//General
	Route::get('view-assignment/general-notary/{hash}', 'ClientController@general_notary_hash')->name('client.assignment.general.view.hash');
	Route::get('view-assignment/general-notary', 'ClientController@general_notary_all')->name('client.assignment.general.view.all');
	Route::get('new-assignment/general-notary', 'ClientController@general_notary_form')->name('client.assignment.general.view');
	Route::post('new-assignment/general-notary', 'ClientController@general_notary_create')->name('client.assignment.general.create');

	//Real state
	Route::get('view-assignment/real-state-closing/{hash}', 'ClientController@real_state_closing_hash')->name('client.assignment.real_state_closing.view.hash');
	Route::get('view-assignment/real-state-closing', 'ClientController@real_state_closing_all')->name('client.assignment.realstate.view.all');
	Route::get('new-assignment/real-state-closing', 'ClientController@real_state_closing')->name('client.assignment.realstate.view');
	Route::post('new-assignment/real-state-closing', 'ClientController@real_state_closing_create')->name('client.assignment.real_state_closing.create');

	//Tax closing
	Route::get('view-assignment/tax-closing/{hash}', 'ClientController@tax_closing_hash')->name('client.assignment.tax_closing.view.hash');
	Route::get('view-assignment/tax-closing', 'ClientController@tax_closing_all')->name('client.assignment.taxclosing.view.all');
	Route::get('new-assignment/tax-closing', 'ClientController@tax_closing')->name('client.assignment.taxclosing.view');
	Route::post('new-assignment/tax-closing', 'ClientController@tax_closing_create')->name('client.assignment.tax_closing.create');

	//Process server
	Route::get('view-assignment/process-server/{hash}', 'ClientController@process_server_hash')->name('client.assignment.process_server.view.hash');
	Route::get('view-assignment/process-server', 'ClientController@process_server_all')->name('client.assignment.processserver.view.all');
	Route::get('new-assignment/process-server', 'ClientController@process_server')->name('client.assignment.processserver.view');
	Route::post('new-assignment/process-server', 'ClientController@process_server_create')->name('client.assignment.process_server.create');

});