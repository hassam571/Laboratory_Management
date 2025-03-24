<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\DebitController;
// use App\Http\Controllers\CreditController;
use App\Http\Controllers\Admin\LcController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\UserViewController;
use App\Http\Controllers\Admin\TestRangeController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Sampler\SamplerController;
use App\Http\Controllers\Admin\StaffPanelController;
use App\Http\Controllers\Admin\TestCategoryController;
use App\Http\Controllers\Receptionist\DebitController;
use App\Http\Controllers\Receptionist\StockController;
use App\Http\Controllers\Admin\ExternalPanelController;
use App\Http\Controllers\Receptionist\CreditController;
use App\Http\Controllers\Reporter\TestReportController;
use App\Http\Controllers\Admin\ReferenceRangeController;
use App\Http\Controllers\Receptionist\TestSaveController;
use App\Http\Controllers\Admin\ReferenceRangeChildController;
use App\Http\Controllers\Receptionist\ReceptionistController;

Route::get('/auth/staff/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('signin', [AuthController::class, 'login'])->name('login.post');
Route::post('patient/login', [AuthController::class, 'loginp'])->name('patient.login.post');
Route::get('patient/login', [AuthController::class, 'patient'])->name('patient.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/permission-denied', [AuthController::class, 'roleerror'])->name('auth.errors.role');


Route::get('patient/dashboard', function() {
    return view('patient.pages.dashboard');
})->name('patient.dashboard');



Route::middleware(['auth'])->group(function () {


    Route::prefix('admin')->middleware(['role:admin'])->group(function () {

        Route::get('/', [UserController::class, 'adminDashboard'])->name('admin.dashboard');

        Route::prefix('loyalty-card')->group(function () {
            Route::get('/pending', [LcController::class, 'pending'])->name('admin.lc.pending');
            Route::get('/aloted', [LcController::class, 'aloted'])->name('admin.lc.aloted');
            Route::post('/store', [LcController::class, 'store'])->name('admin.loyalty.store');
            Route::delete('/{id}', [LcController::class, 'destroy'])->name('admin.lc.destroy');
            Route::get('discount', [\App\Http\Controllers\Admin\LcController::class, 'discount'])->name('admin.lc.discount');
        });




        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
            Route::put('/status/{id}', [UserController::class, 'updateStatus'])->name('admin.users.updateStatus');
        });

        Route::prefix('tests')->group(function () {
            Route::get('/index', [TestController::class, 'index']);
            Route::get('/create', [TestController::class, 'create']);
            Route::get('/edit', [TestController::class, 'edit']);
        });

        Route::prefix('external')->group(function () {
            Route::get('/add', [ExternalPanelController::class, 'add'])->name('admin.external.add');
            Route::get('/view', [ExternalPanelController::class, 'view'])->name('admin.external.view');
            Route::post('/store', [ExternalPanelController::class, 'store'])->name('admin.external.store');
            Route::get('/edit/{id}', [ExternalPanelController::class, 'edit'])->name('admin.external.edit');
            Route::put('/update/{id}', [ExternalPanelController::class, 'update'])->name('admin.external.update');
            Route::delete('/destroy/{id}', [ExternalPanelController::class, 'destroy'])->name('admin.external.destroy');
        });

        Route::prefix('staff')->group(function () {
            Route::get('/add', [StaffPanelController::class, 'create'])->name('admin.staff.add');
            Route::post('/store', [StaffPanelController::class, 'store'])->name('admin.staff.store');
            Route::get('/view', [StaffPanelController::class, 'index'])->name('admin.staff.view');
            Route::get('/edit/{id}', [StaffPanelController::class, 'edit'])->name('admin.staff.edit');
            Route::put('/update/{id}', [StaffPanelController::class, 'update'])->name('admin.staff.update');
            Route::delete('/destroy/{id}', [StaffPanelController::class, 'destroy'])->name('admin.staff.destroy');
        });

        Route::prefix('testcategory')->group(function () {
            Route::get('/', [TestCategoryController::class, 'index'])->name('admin.testcategory.index');
            Route::get('/create', [TestCategoryController::class, 'create'])->name('admin.testcategory.create');
            Route::post('/store', [TestCategoryController::class, 'store'])->name('admin.testcategory.store');
            Route::get('/edit/{id}', [TestCategoryController::class, 'edit'])->name('admin.testcategory.edit');
            Route::put('/update/{id}', [TestCategoryController::class, 'update'])->name('admin.testcategory.update');
            Route::delete('/destroy/{id}', [TestCategoryController::class, 'destroy'])->name('admin.testcategory.destroy');
        });

        Route::prefix('test')->group(function () {
            Route::get('/', [TestController::class, 'index'])->name('admin.test.index');
            Route::get('/create', [TestController::class, 'create'])->name('admin.test.create');
            Route::post('/store', [TestController::class, 'store'])->name('admin.test.store');
            Route::get('/edit/{id}', [TestController::class, 'edit'])->name('admin.test.edit');
            Route::put('/update/{id}', [TestController::class, 'update'])->name('admin.test.update');
            Route::delete('/destroy/{id}', [TestController::class, 'destroy'])->name('admin.test.destroy');
        });

        Route::prefix('testrange')->group(function () {
            // Show all test ranges
            Route::get('/', [TestRangeController::class, 'index'])->name('admin.testrange.index');

            // Create multiple reference ranges
            Route::get('/create', [TestRangeController::class, 'create'])->name('admin.testrange.create');
            Route::post('/store', [TestRangeController::class, 'store'])->name('admin.testrange.store');

            // Edit / Update a single row
            Route::get('/edit/{id}', [TestRangeController::class, 'edit'])->name('admin.testrange.edit');
            Route::put('/update/{id}', [TestRangeController::class, 'update'])->name('admin.testrange.update');

            // Delete a single row
            Route::delete('/destroy/{id}', [TestRangeController::class, 'destroy'])->name('admin.testrange.destroy');
        });
        Route::prefix('referral')->group(function () {
            Route::get('/', [ReferralController::class, 'index'])->name('admin.referral.index');
            Route::get('/create', [ReferralController::class, 'create'])->name('admin.referral.create');
            Route::post('/store', [ReferralController::class, 'store'])->name('admin.referral.store');
            Route::get('/edit/{id}', [ReferralController::class, 'edit'])->name('admin.referral.edit');
            Route::put('/update/{id}', [ReferralController::class, 'update'])->name('admin.referral.update');
            Route::delete('/destroy/{id}', [ReferralController::class, 'destroy'])->name('admin.referral.destroy');
        });
        Route::get('/revoke/reports', [UserViewController::class, 'viewrevokeReports'])->name('admin.revoked');
        Route::get('/pending/reports', [UserViewController::class, 'viewpendingReports'])->name('admin.pending');
        Route::get('/approved   /reports', [UserViewController::class, 'viewacceptedReports'])->name('admin.accepted');
        Route::get('/report/view/{reportId}', [UserViewController::class, 'viewReport'])->name('report.views');
    });







    Route::middleware('role:receptionist')->prefix('receptionist')->group(function () {

        Route::get('/', [UserController::class, 'receptionistDashboard'])->name('receptionist.dashboard');
        Route::get('/testsave', [TestSaveController::class, 'showForm'])
            ->name('testsave.showForm');
            Route::get('pay-pending/{customerId}', [ReceptionistController::class, 'payPending'])
    ->name('receptionist.pay.pending');
        Route::get('/customers', [ReceptionistController::class, 'index'])->name('receptionist.customers');
        Route::get('/customers/revoked', [ReceptionistController::class, 'revoked'])->name('receptionist.customers.revoked');
        Route::get('/customers/{id}',  [ReceptionistController::class, 'show'])->name('receptionist.customer.details');



        // Handle form submission
        Route::post('/testsave', [TestSaveController::class, 'store'])
            ->name('testsave.store');
        Route::get('/tests/search', [TestSaveController::class, 'search'])
            ->name('tests.search');
        Route::get('/test-categories/{testCat}/tests', [TestSaveController::class, 'getTestsByCategory']);
        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
        Route::post('/stock', [StockController::class, 'store'])->name('stock.store');
        Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy');

        Route::get('/debit', [DebitController::class, 'index'])->name('debit.index');
        Route::get('/debit/create', [DebitController::class, 'create'])->name('debit.create');
        Route::post('/debit/store', [DebitController::class, 'store'])->name('debit.store');
        Route::delete('/debit/{debit}', [DebitController::class, 'destroy'])->name('debit.destroy');

        // Credit Routes
        Route::get('/credit', [CreditController::class, 'index'])->name('credit.index');
        Route::get('/credit/create', [CreditController::class, 'create'])->name('credit.create');
        Route::post('/credit/store', [CreditController::class, 'store'])->name('credit.store');
        Route::delete('/credit/{credit}', [CreditController::class, 'destroy'])->name('credit.destroy');
    });



    Route::middleware('role:reporter')->prefix('reporter')->group(function () {

        Route::get('/', [UserController::class, 'reporterDashboard'])->name('reporter.dashboard');
        Route::get('/reports', [TestReportController::class, 'index'])->name('reporter.reports');
        // Route::get('/reporter/test-details/{customerId}', [TestReportController ::class, 'testDetails'])->name('reporter.test.details');
        Route::get('/reporter/view-test-details/{customerId}', [TestReportController::class, 'viewTestDetails'])->name('reporter.viewTestDetails');
        Route::get('/report/test/{addTestId}/{customerId}', [TestReportController::class, 'showTestReport'])->name('report.test');

        Route::post('/report/store', [TestReportController::class, 'store'])->name('report.store');
        Route::get('/reporter/reports', [TestReportController::class, 'viewAllReports'])->name('reporter.viewreports');
        Route::get('/revoke/reports', [TestReportController::class, 'viewrevokeReports'])->name('reporter.revoked');
        Route::get('/reporter/report/{reportId}/edit', [TestReportController::class, 'editReport'])->name('reporter.editReport');
        Route::put('/reporter/report/{reportId}/update', [TestReportController::class, 'updateReport'])->name('reporter.updateReport');
        Route::get('/report/view/{reportId}', [TestReportController::class, 'viewReport'])->name('report.view');
        Route::post('/report/update/{reportId}', [TestReportController::class, 'updateReport'])->name('report.update');

    });









    Route::middleware('role:sampler')->prefix('sampler')->group(function () {

        Route::get('/', [UserController::class, 'samplerDashboard'])->name('sampler.dashboard');
        Route::get('/pending-tests', [SamplerController::class, 'pendingTests'])->name('sampler.pendingTests');
        Route::get('/test-details/{id}', [SamplerController::class, 'testDetails'])->name('sampler.testDetails');
        Route::post('/sampler/collect-sample', [SamplerController::class, 'collectSample'])->name('sampler.collectSample');
    });








    Route::middleware('role:manager')->prefix('manager')->group(function () {

        Route::get('/', [UserController::class, 'managerDashboard'])->name('manager.dashboard');
        Route::get('/pending-reports', [ManagerController::class, 'pendingReports'])->name('pendingReports');
        Route::get('/view-report/{reportId}', [ManagerController::class, 'viewReport'])->name('viewReport');
        Route::post('/update-sign-status/{reportId}', [ManagerController::class, 'updateSignStatus'])->name('manager.update-sign-status');
        Route::get('/revoked-reports', [ManagerController::class, 'showRevokedReports'])->name('manager.revoked-reports');
        Route::get('/accepted-reports', [ManagerController::class, 'showAcceptedReports'])->name('manager.accepted-reports');
    });








    // Route::middleware('role:patient')->prefix('patient')->group(function () {

    //     Route::get('/', [UserController::class, 'patientDashboard'])->name('patient.dashboard');
    // });
});
