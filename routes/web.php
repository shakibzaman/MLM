<?php

use App\Http\Controllers\AccessLogController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MigrationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\SalesStatementController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\BannedIpsController;
use App\Http\Controllers\BlogCategoriesController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\CooponsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\GlobalSettingsController;
use App\Http\Controllers\KycHistoriesController;
use App\Http\Controllers\KycsController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MailSettingsController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionSettingsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupportTicketAnswersController;
use App\Http\Controllers\SupportTicketsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfNotApplicant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\UserBehaveController;
use App\Http\Controllers\Customer\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\FrontPageController;

// Main Page Route
// Route::get('/', [HomePage::class, 'index'])->name('pages-home');
// Route::get('/', [AuthenticatedSessionController::class, 'create'])
//   ->name('pages-home');
Route::get('/', [FrontPageController::class, 'index'])->name('frontpage');
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');
Route::get('register/customer', [CustomerController::class, 'create'])->name('register-customers');
// Route::get('front', [FrontPageController::class, 'index'])->name('frontpage');
Route::post('income-calculate', [FrontPageController::class, 'incomeCalculate'])->name('income-calculate');


// locale
Route::get('/test', [LanguageController::class, 'test']);

use App\Http\Controllers\SeoToolsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SocialLinksController;
use App\Http\Controllers\CompanySettingsController;
use App\Http\Controllers\CustomChatifyMessagesController;
use App\Http\Controllers\Customer\FundTransfer;
use App\Http\Controllers\Customer\FundTransferController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\PluginSettingsController;
use App\Http\Controllers\RankRewardsController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\MonthlyRewardsController;
use App\Http\Controllers\RewardSitesController;
use App\Http\Controllers\RewardSubmitTypesController;
use App\Http\Controllers\RewardTypeMappingsController;
use App\Models\RewardSite;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\Customer\Auth\PasswordController as AuthPasswordController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PointWalletController;
use App\Http\Controllers\PurchaseRequestsController;
use App\Http\Controllers\BooksController;


Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/clear-cache', [CacheController::class, 'clearAllCache'])->name('clear.cache');
Route::get('/pusher', [HomeController::class, 'pusherPage'])->name('pusher.page');

Route::middleware(['auth', 'verified'])->group(function () {

  Route::get('/chart-data', [ChartController::class, 'getChartData']);
  Route::get('notifications', [NotificationController::class, 'adminNotification'])->name('notification');

  Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
  Route::get('/export-database', [MigrationController::class, 'export'])->name('database.export');
  Route::get('/database-migration', [MigrationController::class, 'showImportForm'])->name('import.database.form');
  Route::post('/import-database', [MigrationController::class, 'importDatabase'])->name('import.database');
  Route::get('admin/logininfo', [\App\Http\Controllers\Admin\LoginInfoController::class, 'admin'])->name('admin.logininfo');
  Route::get('admin/logininfo/data', [\App\Http\Controllers\Admin\LoginInfoController::class, 'admindata'])->name('admin.logininfo.data');
  Route::get('user/logininfo', [\App\Http\Controllers\Admin\LoginInfoController::class, 'user'])->name('user.logininfo');
  Route::get('user/logininfo/data', [\App\Http\Controllers\Admin\LoginInfoController::class, 'userdata'])->name('user.logininfo.data');
  Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->names('manage-member-customers');
  Route::get('admin/users-datatable', [\App\Http\Controllers\Admin\CustomerController::class, 'datatable'])->name('users.datatable');
  Route::get('users/paid', [\App\Http\Controllers\Admin\CustomerController::class, 'paid'])->name('manage-member-customer-paid');
  Route::get('admin/users-paid', [\App\Http\Controllers\Admin\CustomerController::class, 'paidData'])->name('users.paiddata');
  Route::get('users/monthly-subscriber', [\App\Http\Controllers\Admin\CustomerController::class, 'monthlySubscriber'])->name('manage-member-customer-monthlySubscriber');
  Route::get('users/users-monthly-subscriber', [\App\Http\Controllers\Admin\CustomerController::class, 'monthlySubscriberData'])->name('users.monthlySubscriberData');
  Route::get('users/monthly-subscription-inactive', [\App\Http\Controllers\Admin\CustomerController::class, 'monthlySubscriptionInactive'])->name('manage-member-customer-monthlySubscriber-inactive');
  Route::get('users/users-monthly-subscription-inactive', [\App\Http\Controllers\Admin\CustomerController::class, 'monthlySubscriptionInactiveData'])->name('users.monthlySubscriptionInactiveData');
  Route::get('users/monthly-unsubscriber', [\App\Http\Controllers\Admin\CustomerController::class, 'monthlyUnsubscriber'])->name('manage-member-customer-monthlyUnsubscriber');
  Route::get('users/users-monthly-unsubscriber', [\App\Http\Controllers\Admin\CustomerController::class, 'monthlyUnsubscriberData'])->name('users.monthlyUnsubscriberData');
  Route::get('users/free', [\App\Http\Controllers\Admin\CustomerController::class, 'free'])->name('manage-member-customer-free');
  Route::get('users/users-free', [\App\Http\Controllers\Admin\CustomerController::class, 'freeData'])->name('users.freeData');
  Route::get('users/banned', [\App\Http\Controllers\Admin\CustomerController::class, 'banned'])->name('users.banned');
  Route::get('users/users-banned', [\App\Http\Controllers\Admin\CustomerController::class, 'bannedData'])->name('users.bannedData');
  Route::get('users/email-unverified', [\App\Http\Controllers\Admin\CustomerController::class, 'emailUnverified'])->name('manage-member-customer-emailUnverified');
  Route::get('users/users-email-unverified', [\App\Http\Controllers\Admin\CustomerController::class, 'emailUnverifiedData'])->name('users.emailUnverifiedData');
  Route::get('users/number-unverified', [\App\Http\Controllers\Admin\CustomerController::class, 'numberUnverified'])->name('manage-member-customer-numberUnverified');
  Route::get('users/users-number-unverified', [\App\Http\Controllers\Admin\CustomerController::class, 'numberUnverifiedData'])->name('users.numberUnverifiedData');
  Route::get('users/with-balance', [\App\Http\Controllers\Admin\CustomerController::class, 'withBalance'])->name('manage-member-customer-withBalance');
  Route::get('users/users-with-balance', [\App\Http\Controllers\Admin\CustomerController::class, 'withBalanceData'])->name('users.withBalanceData');
  Route::get('users/top-recruiters', [\App\Http\Controllers\Admin\CustomerController::class, 'topRecruiter'])->name('users.topRecruiter');
  Route::get('users/top-recruiters-data', [\App\Http\Controllers\Admin\CustomerController::class, 'topRecruiterData'])->name('users.topRecruiterData');
  Route::get('users/ranking', [\App\Http\Controllers\Admin\UserRankingController::class, 'index'])->name('users.ranking');
  Route::get('users/ranking-data', [\App\Http\Controllers\Admin\UserRankingController::class, 'data'])->name('users.rankingData');
  // Balance Transfer
  Route::get('balance/transfer/{type?}', [FundTransferController::class, 'fundTransferList'])->name('balance_transfer_list');
  Route::get('balance/transfer/show/{id}', [FundTransferController::class, 'fundTransferShow'])->name('balance_transfer_show');
  Route::put('balance/transfer/update/{id}', [FundTransferController::class, 'fundTransferUpdate'])->name('balance_transfer_update');

  // Extra Rewards

  Route::get('extra/rewards/{type?}', [RewardSitesController::class, 'extraRewardList'])->name('extraReward_list');
  Route::get('extra/reward/show/{id}', [RewardSitesController::class, 'extraRewardShow'])->name('extraReward_show');
  Route::put('extra/reward/update/{id}', [RewardSitesController::class, 'extraRewardUpdate'])->name('extraReward_update');

  // Point Wallet

  Route::get('point/convert/{type?}', [PointWalletController::class, 'pointWalletList'])->name('pointWallet_list');
  Route::get('point/convert/show/{id}', [PointWalletController::class, 'pointWalletShow'])->name('pointWallet_show');
  Route::put('point/convert/update/{id}', [PointWalletController::class, 'pointWalletUpdate'])->name('pointWallet_update');


  // Applied Coupon List
  Route::get('apllied/coupon/list/{type?}', [CouponsController::class, 'appliedCouponList'])->name('appliedCouponList');
  Route::get('apllied/coupon/show/{id}', [CouponsController::class, 'applyCouponShow'])->name('apply_coupon_show');
  Route::put('apllied/coupon/update/{id}', [CouponsController::class, 'appliedCouponUpdate'])->name('appliedCoupon_update');

  Route::get('payment/success', [DepositsController::class, 'success'])->name('payment.success');
  Route::get('payment/cancel', [DepositsController::class, 'cancel'])->name('payment.cancel');
  Route::get('payment/fail', [DepositsController::class, 'fail'])->name('payment.fail');

  Route::get('users/rating-score', [\App\Http\Controllers\Admin\CustomerController::class, 'ratingScore'])->name('users.ratingScore');
  Route::get('users/rating-score-data', [\App\Http\Controllers\Admin\CustomerController::class, 'ratingScoreData'])->name('users.ratingScoreData');
  // Email sending
  Route::get('users/send-email', [\App\Http\Controllers\Admin\EmailController::class, 'create'])->name('users.email');
  Route::post('users/send-email', [\App\Http\Controllers\Admin\EmailController::class, 'sendEmail'])->name('users.email.send');

  // Sitemap
  Route::get('/sitemap/list', [SitemapController::class, 'index'])->name('sitemap.index');
  Route::get('/sitemap/upload', [SitemapController::class, 'showUploadForm'])->name('sitemap.upload.form');
  Route::post('/sitemap/upload', [SitemapController::class, 'upload'])->name('sitemap.upload');
  Route::get('/sitemap/download/{fileName}', [SitemapController::class, 'download'])->name('sitemap.download');
  Route::get('/sitemap/delete/{fileName}', [SitemapController::class, 'delete'])->name('sitemap.delete');

  // Access log
  Route::get('/access-logs', [AccessLogController::class, 'index'])->name('rollPermission-access-logs');
  // reward
  Route::get('lifetime-reward', \App\Http\Controllers\LifetimeRewardController::class)->name('reward.lifetime');
  Route::get('monthly-reward', [MonthlyRewardsController::class, 'monthlyReward'])->name('reward.monthly');
  Route::get('reward-log', [\App\Http\Controllers\RewardLogController::class, 'index'])->name('reward.log');
  Route::get('reward-chart', [\App\Http\Controllers\RewardChartController::class, 'index'])->name('reward.chart');
  // membership management
  Route::get('users/membership-plan', [\App\Http\Controllers\Admin\MembershipController::class, 'index'])->name('users.membership');
  Route::get('users/switch-membership', [\App\Http\Controllers\Admin\MembershipController::class, 'switchPlan'])->name('users.membership.switch');
  Route::post('users/switch-membership', [\App\Http\Controllers\Admin\MembershipController::class, 'UpdatePlan'])->name('users.membership.update');
  Route::get('users/membership-log', [\App\Http\Controllers\Admin\MembershipController::class, 'log'])->name('users.membership.log');

  // subscription management
  Route::get('users/subscription-package', [\App\Http\Controllers\Admin\SubscriptionController::class, 'index'])->name('users.subscription');
  Route::get('users/switch-subscription', [\App\Http\Controllers\Admin\SubscriptionController::class, 'switchPlan'])->name('users.subscription.switch');
  Route::post('users/switch-subscription', [\App\Http\Controllers\Admin\SubscriptionController::class, 'UpdatePlan'])->name('users.subscription.update');
  Route::get('users/subscription-log', [\App\Http\Controllers\Admin\SubscriptionController::class, 'log'])->name('users.subscription.log');
  Route::get('users/disable-subscription', [\App\Http\Controllers\Admin\SubscriptionController::class, 'disable'])->name('users.subscription.disable');
  Route::post('users/disable-subscription', [\App\Http\Controllers\Admin\SubscriptionController::class, 'disableSub'])->name('users.subscription.postdisable');
  // sales statement
  Route::get('sales-statement', [SalesStatementController::class, 'index'])->name('sales-statement');
  Route::get('sales-statement-data', [SalesStatementController::class, 'data'])->name('sales-statement.data');
  Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
  Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::get('profile/setting', [ProfileController::class, 'setting'])->name('profile.setting');
  Route::get('verify/password/change', [ProfileController::class, 'showVerify'])->name('verify.email');
  Route::post('/verify-code', [ProfileController::class, 'verifyCode'])->name('change-password.verify-code');
  Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::get('password/reset', [PasswordController::class, 'edit'])->name('password.edit');
  Route::put('update/password', [PasswordController::class, 'update'])->name('update.password');
  Route::get('pending-withdraw-requests', [\App\Http\Controllers\Admin\WithdrawController::class, 'pending'])->name('pending.withdraw.requests');
  Route::get('approved-withdraw-requests', [\App\Http\Controllers\Admin\WithdrawController::class, 'approved'])->name('approved.withdraw.requests');
  Route::get('rejected-withdraw-requests', [\App\Http\Controllers\Admin\WithdrawController::class, 'rejected'])->name('rejected.withdraw.requests');
  Route::get('withdraw-requests-log', [\App\Http\Controllers\Admin\WithdrawController::class, 'all'])->name('all.withdraw.requests');
  Route::post('change-withdraw-ststue', [\App\Http\Controllers\Admin\WithdrawController::class, 'changeStatus'])->name('change-withdraw-status');

  Route::get('online-user', [UserBehaveController::class, 'onlineUser'])->name('userBehave-online-user');
  Route::get('activity-log', [ActivityLogController::class, 'activityLog'])->name('userBehave-activity-log');

  Route::get('admin-login-log', [ActivityLogController::class, 'adminLogingLog'])->name('logingInfo-adminLoging-Log');
  Route::get('customer-login-log', [ActivityLogController::class, 'customerLogingLog'])->name('logingInfo-customerLoging-Log');

  Route::resource('roles', RoleController::class);
  Route::resource('users', UserController::class);
  Route::resource('permissions', PermissionController::class);
  Route::group([
    'prefix' => 'support_tickets',
  ], function () {
    Route::get('/', [SupportTicketsController::class, 'index'])
      ->name('support_tickets.support_ticket.index');
    Route::get('/open', [SupportTicketsController::class, 'index'])
      ->name('support_tickets.support_ticket.open');
    Route::get('/answered', [SupportTicketsController::class, 'answered'])
      ->name('support_tickets.support_ticket.answered');
    Route::get('/closed', [SupportTicketsController::class, 'closed'])
      ->name('support_tickets.support_ticket.closed');
    Route::get('/create', [SupportTicketsController::class, 'create'])
      ->name('support_tickets.support_ticket.create');
    Route::get('/show/{supportTicket}', [SupportTicketsController::class, 'show'])
      ->name('support_tickets.support_ticket.show')->where('id', '[0-9]+');
    Route::get('/{supportTicket}/edit', [SupportTicketsController::class, 'edit'])
      ->name('support_tickets.support_ticket.edit')->where('id', '[0-9]+');
    Route::post('/', [SupportTicketsController::class, 'store'])
      ->name('support_tickets.support_ticket.store');
    Route::put('support_ticket/{supportTicket}', [SupportTicketsController::class, 'update'])
      ->name('support_tickets.support_ticket.update')->where('id', '[0-9]+');
    Route::delete('/support_ticket/{supportTicket}', [SupportTicketsController::class, 'destroy'])
      ->name('support_tickets.support_ticket.destroy')->where('id', '[0-9]+');
    Route::post('/support_ticket/close', [SupportTicketsController::class, 'close'])
      ->name('support_tickets.support_ticket.close');
  });

  Route::get('/notification/settings', [PluginSettingsController::class, 'notificationSetting'])
    ->name('notification_settings');

  // referral

  Route::group([
    'prefix' => 'referrals',
  ], function () {
    Route::get('/', [\App\Http\Controllers\ReferralController::class, 'index'])->name('referral.index');
    Route::get('/genealogy-tree', [\App\Http\Controllers\ReferralController::class, 'genealogy'])->name('referral.genealogy');
    Route::get('/active', [\App\Http\Controllers\ReferralController::class, 'active'])->name('referral.active');
    Route::get('/active/data', [\App\Http\Controllers\ReferralController::class, 'activeData'])->name('referral.active.data');
    Route::get('/inactive', [\App\Http\Controllers\ReferralController::class, 'inactive'])->name('referral.inactive');
    Route::get('/inactive/data', [\App\Http\Controllers\ReferralController::class, 'inactiveData'])->name('referral.inactive.data');
  });

  Route::post('lifetime-activation', [\App\Http\Controllers\Admin\MembershipController::class, 'lifetimeActivation']);
  Route::post('monthly-activation', [\App\Http\Controllers\Admin\MembershipController::class, 'monthlyActivation']);

  Route::group([
    'prefix' => 'books',
  ], function () {
    Route::get('/', [BooksController::class, 'index'])
      ->name('books.book.index');
    Route::get('/create', [BooksController::class, 'create'])
      ->name('books.book.create');
    Route::get('/show/{book}', [BooksController::class, 'show'])
      ->name('books.book.show')->where('id', '[0-9]+');
    Route::get('/{book}/edit', [BooksController::class, 'edit'])
      ->name('books.book.edit')->where('id', '[0-9]+');
    Route::post('/', [BooksController::class, 'store'])
      ->name('books.book.store');
    Route::put('book/{book}', [BooksController::class, 'update'])
      ->name('books.book.update')->where('id', '[0-9]+');
    Route::delete('/book/{book}', [BooksController::class, 'destroy'])
      ->name('books.book.destroy')->where('id', '[0-9]+');
  });
});


Route::group(['middleware' => ['auth:customer', '2fa', 'userverified'], 'prefix' => 'user'], function () {

  Route::get('notifications', [NotificationController::class, 'index'])->name('customer.notification');
  Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard')->middleware('capture_user_agent');
  Route::post('enroll-lifetime-package', [\App\Http\Controllers\Customer\CustomerController::class, 'enroll_lifetime_package'])->name('customer.enroll.lifetime');
  Route::post('enroll-monthly-package', [\App\Http\Controllers\Customer\CustomerController::class, 'enroll_monthly_package'])->name('customer.enroll.monthly');
  Route::get('profile', [\App\Http\Controllers\Customer\CustomerController::class, 'profile'])->name('customer.profile');
  Route::get('subscribers', [\App\Http\Controllers\Customer\CustomerController::class, 'subscribers'])->name('customer.subscribers');
  ROute::get('withdraw-requests', [\App\Http\Controllers\Customer\WithdrawController::class, 'index'])->name('customer.withdraw.index');
  ROute::get('withdraw-request/create', [\App\Http\Controllers\Customer\WithdrawController::class, 'create'])->name('customer.withdraw.create');
  ROute::post('withdraw-request/store', [\App\Http\Controllers\Customer\WithdrawController::class, 'store'])->name('customer.withdraw.store');
  Route::get('pending-withdraw-requests', [\App\Http\Controllers\Customer\WithdrawController::class, 'pending'])->name('customer.pending.withdraw.requests');
  Route::get('approved-withdraw-requests', [\App\Http\Controllers\Customer\WithdrawController::class, 'approved'])->name('customer.approved.withdraw.requests');
  Route::get('rejected-withdraw-requests', [\App\Http\Controllers\Customer\WithdrawController::class, 'rejected'])->name('customer.rejected.withdraw.requests');
  Route::get('/faqs', [FaqsController::class, 'faqs'])->name('customer.faq');
  Route::get('/earnings', [\App\Http\Controllers\Customer\EarningsController::class, 'index'])->name('customer.earnings');
  Route::get('/earnings/data', [\App\Http\Controllers\Customer\EarningsController::class, 'data'])->name('customer.earnings.data');
  Route::get('/earnings/search', [\App\Http\Controllers\Customer\EarningsController::class, 'search'])->name('customer.earnings.search');
  Route::get('/deductions', [\App\Http\Controllers\Customer\DeductionController::class, 'index'])->name('customer.deductions');
  Route::get('/deductions/data', [\App\Http\Controllers\Customer\DeductionController::class, 'data'])->name('customer.deductions.data');
  Route::get('deposits/create', [DepositsController::class, 'create'])
    ->name('user.deposits.deposit.create');
  Route::get('deposits/list', [DepositsController::class, 'customerDepositList'])
    ->name('user.deposits.deposit.list');

  Route::get('manual/payment/instruction/{gateway}', [PaymentController::class, 'manualPaymentInstruction'])
    ->name('user.manual.payment.instruction');
  Route::get('deposits/type/{type}', [DepositsController::class, 'depositType'])
    ->name('deposits.deposit.type');
  Route::get('kycs/create', [KycsController::class, 'create'])
    ->name('customer.customer-kyc-create');
  Route::get('kycs/view', [KycsController::class, 'view'])
    ->name('customer.customer-kyc-view');

  Route::post('/password/verify', [AuthPasswordController::class, 'verifyPassword'])->name('customer.password.verify');

  Route::get('payment/page/{id}', [PaymentController::class, 'paymentPage'])->name('payment.page');
  Route::post('payment/process', [PaymentController::class, 'paymentProcess'])->name('payment.process');


  Route::get('activate-lifetime-package', [\App\Http\Controllers\Customer\MembershipController::class, 'activeLifetimePackage'])->name('customer.activeLifetimePackage.create');
  Route::Post('activate-lifetime-package', [\App\Http\Controllers\Customer\MembershipController::class, 'activeLifetimePackageStore'])->name('customer.activeLifetimePackage.store');
  Route::get('activate-monthly-package', [\App\Http\Controllers\Customer\MembershipController::class, 'activeMonthlyPackage'])->name('customer.activeMonthlyPackage.create');
  Route::Post('activate-monthly-package', [\App\Http\Controllers\Customer\MembershipController::class, 'activeMonthlyPackageStore'])->name('customer.activeMonthlyPackage.store');

  Route::get('profile', [CustomerProfileController::class, 'index'])->name('user.profile.show');
  Route::get('edit/profile', [CustomerProfileController::class, 'edit'])->name('user.profile.edit');
  Route::get('profile/settings', [CustomerProfileController::class, 'setting'])->name('user.profile.setting');
  Route::put('profile', [CustomerProfileController::class, 'update'])->name('user.profile.update');
  Route::put('password/change', [CustomerProfileController::class, 'updatePassword'])->name('user.password.update');
  Route::get('verify/password/change', [CustomerProfileController::class, 'showVerify'])->name('user.verify.email');
  Route::post('/verify-code', [CustomerProfileController::class, 'verifyCode'])->name('user.change-password.verify-code');
  Route::post('/user/2fa-toggle', [CustomerProfileController::class, 'toggle2FA'])->name('user.2fa.toggle');
  Route::get('/profile/referrals', [CustomerProfileController::class, 'referrals'])->name('user.profile.referrals');
  Route::get('/profile/kyc', [CustomerProfileController::class, 'kyc'])->name('user.profile.kyc');
  Route::post('profile/kyc', [CustomerProfileController::class, 'kycStore'])->name('user.profile.kyc.store');
  Route::get('/kycs/{kyc}/edit', [KycsController::class, 'customerEdit'])->name('user-kyc-edit')->where('id', '[0-9]+');
  Route::put('/kycs/kyc/{kyc}', [KycsController::class, 'customerKycUpdate'])
    ->name('user-kyc-update')->where('id', '[0-9]+');

  Route::get('fund/transfer', [FundTransferController::class, 'index'])->name('user.fund.transfer');
  Route::post('fund/transfer', [FundTransferController::class, 'sendMoney'])->name('user.fund.transfer.store');

  Route::get('extra/rewards', [RewardSitesController::class, 'extraRewards'])->name('user.extra.rewards');
  Route::post('extra/reward/store', [RewardSitesController::class, 'extraRewardStore'])->name('user.extra.rewards.store');
  Route::get('coupons', [CouponsController::class, 'userCoupon'])->name('user.coupon.show');
  Route::post('apply/coupons', [CouponsController::class, 'applyCoupon'])->name('user.apply.coupon');

  Route::get('point/wallet', [PointWalletController::class, 'getPointWallet'])->name('user.point.wallet');
  Route::post('point/wallet', [PointWalletController::class, 'convertPointWallet'])->name('user.convert.points');

  // Route::get('/payment/{package_id}/{package_price}', [PaymentController::class, 'showPaymentPage'])->name('payment.page');

  // membership
  Route::get('membership-plan', [\App\Http\Controllers\Customer\MembershipController::class, 'index'])->name('customer.membership');
  Route::get('upgrade-membership-plan', [\App\Http\Controllers\Customer\MembershipController::class, 'upgrade'])->name('customer.upgrade.membership');
  Route::get('downgrade-membership-plan', [\App\Http\Controllers\Customer\MembershipController::class, 'upgrade'])->name('customer.downgrade.membership');
  Route::get('switch-subscription', [\App\Http\Controllers\Customer\MembershipController::class, 'switchPlan'])->name('customer.membership.switch');
  Route::post('switch-membership', [\App\Http\Controllers\Customer\MembershipController::class, 'UpdatePlan'])->name('customer.membership.update');
  Route::get('membership-log', [\App\Http\Controllers\Customer\MembershipController::class, 'log'])->name('customer.membership.log');

  // referral

  Route::get('badges', [RankRewardsController::class, 'badges'])->name('customer.badges');
  Route::get('invite-earn', [\App\Http\Controllers\Customer\EarnController::class, 'index'])->name('customer.earn');

  // reward partner
  Route::get('top-recruiters-partners', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'topRecruiters'])->name('customer.top.recruiter.partner');
  Route::get('top-subscriber-partners', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'topSubscribers'])->name('customer.top.subscriber.partner');
  Route::get('last-3m-active-partners', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'active3m'])->name('customer.last.3m.active.partner');
  Route::get('last-6m-active-partners', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'active6m'])->name('customer.last.6m.active.partner');
  Route::get('last-1y-active-partners', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'active1y'])->name('customer.last.1y.active.partner');
  Route::get('all-time-active-partners', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'allTimeActive'])->name('customer.all.time.active.partner');
  Route::get('all-time-inactive-partners', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'allTimeInactive'])->name('customer.all.time.inactive.partner');
  // reward team

  // reward partner
  Route::get('top-recruiters-team', [\App\Http\Controllers\Customer\RewardTeamController::class, 'topRecruiters'])->name('customer.top.recruiter.team');
  Route::get('top-subscriber-team', [\App\Http\Controllers\Customer\RewardTeamController::class, 'topSubscribers'])->name('customer.top.subscriber.team');
  Route::get('last-3m-active-team', [\App\Http\Controllers\Customer\RewardTeamController::class, 'active3m'])->name('customer.last.3m.active.team');
  Route::get('last-6m-active-team', [\App\Http\Controllers\Customer\RewardTeamController::class, 'active6m'])->name('customer.last.6m.active.team');
  Route::get('last-1y-active-team', [\App\Http\Controllers\Customer\RewardTeamController::class, 'active1y'])->name('customer.last.1y.active.team');
  Route::get('all-time-active-team', [\App\Http\Controllers\Customer\RewardTeamController::class, 'allTimeActive'])->name('customer.all.time.active.team');
  Route::get('all-time-inactive-team', [\App\Http\Controllers\Customer\RewardTeamController::class, 'allTimeInactive'])->name('customer.all.time.inactive.team');

  Route::post('give-reward', [\App\Http\Controllers\Customer\RewardPartnerController::class, 'give'])->name('give-reward');
  //reward



  Route::get('lifetime-reward', \App\Http\Controllers\LifetimeRewardController::class)->name('customer.reward.lifetime');
  Route::get('monthly-reward', [MonthlyRewardsController::class, 'monthlyReward'])->name('customer.reward.monthly');
  Route::get('reward-log', [\App\Http\Controllers\RewardLogController::class, 'index'])->name('customer.reward.log');
  Route::get('reward-chart', [\App\Http\Controllers\RewardChartController::class, 'index'])->name('customer.reward.chart');

  Route::get('badges', [RankRewardsController::class, 'badges'])->name('customer.badges');
  Route::get('invite-earn', [\App\Http\Controllers\Customer\EarnController::class, 'index'])->name('customer.earn');

  Route::group([
    'prefix' => 'referrals',
  ], function () {
    Route::get('/', [\App\Http\Controllers\ReferralController::class, 'referrals'])->name('customer.referral.index');
    Route::get('/downline-list', [\App\Http\Controllers\ReferralController::class, 'index'])->name('customer.referral.downline');
    Route::get('/genealogy-tree', [\App\Http\Controllers\ReferralController::class, 'genealogy'])->name('customer.referral.genealogy');
    Route::get('/data', [\App\Http\Controllers\ReferralController::class, 'referralData'])->name('customer.referral.data');
  });
  Route::group([
    'prefix' => 'support_tickets',
  ], function () {
    Route::get('/', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'index'])
      ->name('user.support_tickets.support_ticket.index');
    Route::get('/open', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'index'])
      ->name('user.support_tickets.support_ticket.open');
    Route::get('/answered', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'answered'])
      ->name('user.support_tickets.support_ticket.answered');
    Route::get('/closed', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'closed'])
      ->name('user.support_tickets.support_ticket.closed');
    Route::get('/create', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'create'])
      ->name('user.support_tickets.support_ticket.create');
    Route::get('/show/{supportTicket}', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'show'])
      ->name('user.support_tickets.support_ticket.show')->where('id', '[0-9]+');
    Route::get('/{supportTicket}/edit', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'edit'])
      ->name('user.support_tickets.support_ticket.edit')->where('id', '[0-9]+');
    Route::post('/', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'store'])
      ->name('user.support_tickets.support_ticket.store');
    Route::put('support_ticket/{supportTicket}', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'update'])
      ->name('user.support_tickets.support_ticket.update')->where('id', '[0-9]+');
    Route::delete('/support_ticket/{supportTicket}', [\App\Http\Controllers\Customer\SupportTicketsController::class, 'destroy'])
      ->name('user.support_tickets.support_ticket.destroy')->where('id', '[0-9]+');

    Route::get('translation-details/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'show_transaction'])->name('translation.show');
  });

  Route::get('download-book', [BooksController::class, 'download'])->name('customer.book.download');
});


Route::get('/2fa', [\App\Http\Controllers\Email2faController::class, 'create'])->name('customer.2fa')->middleware('auth:customer');
Route::post('/2fa', [\App\Http\Controllers\Email2faController::class, 'verify'])->name('customer.2fa.verify')->middleware('auth:customer');
Route::post('/2fa-resend', [\App\Http\Controllers\Email2faController::class, 'resend'])->name('customer.2fa.resend')->middleware('auth:customer');
Route::get('/set-locale/{locale}', [LocaleController::class, 'setLocale'])->name('set.locale');

require __DIR__ . '/auth.php';
require __DIR__ . '/customer-auth.php';

Route::group([
  'prefix' => 'countries',
], function () {
  Route::get('/', [CountriesController::class, 'index'])
    ->name('countries.country.index');
  Route::get('/create', [CountriesController::class, 'create'])
    ->name('countries.country.create');
  Route::get('/show/{country}', [CountriesController::class, 'show'])
    ->name('countries.country.show')->where('id', '[0-9]+');
  Route::get('/{country}/edit', [CountriesController::class, 'edit'])
    ->name('countries.country.edit')->where('id', '[0-9]+');
  Route::post('/', [CountriesController::class, 'store'])
    ->name('countries.country.store');
  Route::put('country/{country}', [CountriesController::class, 'update'])
    ->name('countries.country.update')->where('id', '[0-9]+');
  Route::delete('/country/{country}', [CountriesController::class, 'destroy'])
    ->name('countries.country.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'notices',
], function () {
  Route::get('/', [NoticesController::class, 'index'])
    ->name('notices.notice.index');
  Route::get('/create', [NoticesController::class, 'create'])
    ->name('notices.notice.create');
  Route::get('/show/{notice}', [NoticesController::class, 'show'])
    ->name('notices.notice.show')->where('id', '[0-9]+');
  Route::get('/{notice}/edit', [NoticesController::class, 'edit'])
    ->name('notices.notice.edit')->where('id', '[0-9]+');
  Route::post('/', [NoticesController::class, 'store'])
    ->name('notices.notice.store');
  Route::put('notice/{notice}', [NoticesController::class, 'update'])
    ->name('notices.notice.update')->where('id', '[0-9]+');
  Route::delete('/notice/{notice}', [NoticesController::class, 'destroy'])
    ->name('notices.notice.destroy')->where('id', '[0-9]+');
});


Route::group([
  'prefix' => 'coopons',
], function () {
  Route::get('/', [CooponsController::class, 'index'])
    ->name('coopons.coopon.index');
  Route::get('/create', [CooponsController::class, 'create'])
    ->name('coopons.coopon.create');
  Route::get('/show/{coopon}', [CooponsController::class, 'show'])
    ->name('coopons.coopon.show')->where('id', '[0-9]+');
  Route::get('/{coopon}/edit', [CooponsController::class, 'edit'])
    ->name('coopons.coopon.edit')->where('id', '[0-9]+');
  Route::post('/', [CooponsController::class, 'store'])
    ->name('coopons.coopon.store');
  Route::put('coopon/{coopon}', [CooponsController::class, 'update'])
    ->name('coopons.coopon.update')->where('id', '[0-9]+');
  Route::delete('/coopon/{coopon}', [CooponsController::class, 'destroy'])
    ->name('coopons.coopon.destroy')->where('id', '[0-9]+');
});



Route::get('/kycs', [KycsController::class, 'index'])
  ->name('customer-kyc-index');
Route::get('/kycs/get/{type}', [KycsController::class, 'typeList'])
  ->name('customer-kyc-type');
Route::get('/kycs/view', [KycsController::class, 'view'])
  ->name('customer-kyc-view');
Route::get('/kycs/create', [KycsController::class, 'create'])
  ->name('customer-kyc-create');
Route::get('/kycs/show/{kyc}', [KycsController::class, 'show'])
  ->name('customer-kyc-show')->where('id', '[0-9]+');
Route::get('/kycs/{kyc}/edit', [KycsController::class, 'edit'])
  ->name('customer-kyc-edit')->where('id', '[0-9]+');
Route::post('/kycs', [KycsController::class, 'store'])
  ->name('customer-kyc-store');
Route::put('/kycs/kyc/{kyc}', [KycsController::class, 'update'])
  ->name('customer-kyc-update')->where('id', '[0-9]+');
Route::delete('/kycs/kyc/{kyc}', [KycsController::class, 'destroy'])
  ->name('customer-kyc-destroy')->where('id', '[0-9]+');


Route::group([
  'prefix' => 'kyc_histories',
], function () {
  Route::get('/', [KycHistoriesController::class, 'index'])
    ->name('kyc_histories.kyc_history.index');
  Route::get('/create', [KycHistoriesController::class, 'create'])
    ->name('kyc_histories.kyc_history.create');
  Route::get('/show/{kycHistory}', [KycHistoriesController::class, 'show'])
    ->name('kyc_histories.kyc_history.show')->where('id', '[0-9]+');
  Route::get('/{kycHistory}/edit', [KycHistoriesController::class, 'edit'])
    ->name('kyc_histories.kyc_history.edit')->where('id', '[0-9]+');
  Route::post('/', [KycHistoriesController::class, 'store'])
    ->name('kyc_histories.kyc_history.store');
  Route::put('kyc_history/{kycHistory}', [KycHistoriesController::class, 'update'])
    ->name('kyc_histories.kyc_history.update')->where('id', '[0-9]+');
  Route::delete('/kyc_history/{kycHistory}', [KycHistoriesController::class, 'destroy'])
    ->name('kyc_histories.kyc_history.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'deposits',
], function () {
  Route::get('/', [DepositsController::class, 'index'])
    ->name('deposits.deposit.index');
  Route::get('/type/{type}', [DepositsController::class, 'depositType'])
    ->name('deposits.deposit.type');
  Route::get('/show/{deposit}', [DepositsController::class, 'show'])
    ->name('deposits.deposit.show')->where('id', '[0-9]+');
  Route::get('/{deposit}/edit', [DepositsController::class, 'edit'])
    ->name('deposits.deposit.edit')->where('id', '[0-9]+');
  Route::post('/', [DepositsController::class, 'store'])
    ->name('deposits.deposit.store');
  Route::put('deposit/{deposit}', [DepositsController::class, 'update'])
    ->name('deposits.deposit.update')->where('id', '[0-9]+');
  Route::delete('/deposit/{deposit}', [DepositsController::class, 'destroy'])
    ->name('deposits.deposit.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'support_ticket_answers',
], function () {
  Route::get('/', [SupportTicketAnswersController::class, 'index'])
    ->name('support_ticket_answers.support_ticket_answer.index');
  Route::get('/create', [SupportTicketAnswersController::class, 'create'])
    ->name('support_ticket_answers.support_ticket_answer.create');
  Route::get('/show/{supportTicketAnswer}', [SupportTicketAnswersController::class, 'show'])
    ->name('support_ticket_answers.support_ticket_answer.show')->where('id', '[0-9]+');
  Route::get('/{supportTicketAnswer}/edit', [SupportTicketAnswersController::class, 'edit'])
    ->name('support_ticket_answers.support_ticket_answer.edit')->where('id', '[0-9]+');
  Route::post('/', [SupportTicketAnswersController::class, 'store'])
    ->name('support_ticket_answers.support_ticket_answer.store');
  Route::put('support_ticket_answer/{supportTicketAnswer}', [SupportTicketAnswersController::class, 'update'])
    ->name('support_ticket_answers.support_ticket_answer.update')->where('id', '[0-9]+');
  Route::delete('/support_ticket_answer/{supportTicketAnswer}', [SupportTicketAnswersController::class, 'destroy'])
    ->name('support_ticket_answers.support_ticket_answer.destroy')->where('id', '[0-9]+');
});
Route::group([
  'prefix' => 'global_settings',
], function () {
  Route::get('/', [GlobalSettingsController::class, 'index'])
    ->name('site_settings-global_settings-index');
  Route::get('/create', [GlobalSettingsController::class, 'create'])
    ->name('site_settings-global_settings-create');
  Route::get('/show/{globalSetting}', [GlobalSettingsController::class, 'show'])
    ->name('site_settings-global_settings-show')->where('id', '[0-9]+');
  Route::get('/{globalSetting}/edit', [GlobalSettingsController::class, 'edit'])
    ->name('site_settings-global_settings-edit')->where('id', '[0-9]+');
  Route::post('/', [GlobalSettingsController::class, 'store'])
    ->name('site_settings-global_settings-store');
  Route::put('global_setting/{globalSetting}', [GlobalSettingsController::class, 'update'])
    ->name('site_settings-global_settings-update')->where('id', '[0-9]+');
  Route::delete('/global_setting/{globalSetting}', [GlobalSettingsController::class, 'destroy'])
    ->name('site_settings-global_settings-destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'permission_settings',
], function () {
  Route::get('/', [PermissionSettingsController::class, 'index'])
    ->name('permission_settings.permission_setting.index');
  Route::get('/create', [PermissionSettingsController::class, 'create'])
    ->name('permission_settings.permission_setting.create');
  Route::get('/show/{permissionSetting}', [PermissionSettingsController::class, 'show'])
    ->name('permission_settings.permission_setting.show')->where('id', '[0-9]+');
  Route::get('/{permissionSetting}/edit', [PermissionSettingsController::class, 'edit'])
    ->name('permission_settings.permission_setting.edit')->where('id', '[0-9]+');
  Route::post('/', [PermissionSettingsController::class, 'store'])
    ->name('permission_settings.permission_setting.store');
  Route::put('permission_setting/{permissionSetting}', [PermissionSettingsController::class, 'update'])
    ->name('permission_settings.permission_setting.update')->where('id', '[0-9]+');
  Route::delete('/permission_setting/{permissionSetting}', [PermissionSettingsController::class, 'destroy'])
    ->name('permission_settings.permission_setting.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'mail_settings',
], function () {
  Route::get('/', [MailSettingsController::class, 'index'])
    ->name('mail_settings.mail_setting.index');
  Route::get('/mail/check', [MailSettingsController::class, 'mailCheck'])
    ->name('mail_settings.mail_setting.mail_check');
  Route::post('/mail/check', [MailSettingsController::class, 'sendMailCheck'])
    ->name('mail_settings.mail_setting.post_mail');
  Route::get('/create', [MailSettingsController::class, 'create'])
    ->name('mail_settings.mail_setting.create');
  Route::get('/show/{mailSetting}', [MailSettingsController::class, 'show'])
    ->name('mail_settings.mail_setting.show')->where('id', '[0-9]+');
  Route::get('/{mailSetting}/edit', [MailSettingsController::class, 'edit'])
    ->name('mail_settings.mail_setting.edit')->where('id', '[0-9]+');
  Route::post('/', [MailSettingsController::class, 'store'])
    ->name('mail_settings.mail_setting.store');
  Route::put('mail_setting/{mailSetting}', [MailSettingsController::class, 'update'])
    ->name('mail_settings.mail_setting.update')->where('id', '[0-9]+');
  Route::delete('/mail_setting/{mailSetting}', [MailSettingsController::class, 'destroy'])
    ->name('mail_settings.mail_setting.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'banned_ips',
], function () {
  Route::get('/', [BannedIpsController::class, 'index'])
    ->name('banned_ips.banned_ip.index');
  Route::get('/create', [BannedIpsController::class, 'create'])
    ->name('banned_ips.banned_ip.create');
  Route::post('/', [BannedIpsController::class, 'store'])
    ->name('banned_ips.banned_ip.store');
  Route::delete('/banned_ip/{bannedIp}', [BannedIpsController::class, 'destroy'])
    ->name('banned_ips.banned_ip.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'blog_categories',
], function () {
  Route::get('/', [BlogCategoriesController::class, 'index'])
    ->name('blog_categories.blog_category.index');
  Route::get('/create', [BlogCategoriesController::class, 'create'])
    ->name('blog_categories.blog_category.create');
  Route::get('/show/{blogCategory}', [BlogCategoriesController::class, 'show'])
    ->name('blog_categories.blog_category.show')->where('id', '[0-9]+');
  Route::get('/{blogCategory}/edit', [BlogCategoriesController::class, 'edit'])
    ->name('blog_categories.blog_category.edit')->where('id', '[0-9]+');
  Route::post('/', [BlogCategoriesController::class, 'store'])
    ->name('blog_categories.blog_category.store');
  Route::put('blog_category/{blogCategory}', [BlogCategoriesController::class, 'update'])
    ->name('blog_categories.blog_category.update')->where('id', '[0-9]+');
  Route::delete('/blog_category/{blogCategory}', [BlogCategoriesController::class, 'destroy'])
    ->name('blog_categories.blog_category.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'blogs'
], function () {
  Route::get('/', [BlogsController::class, 'index'])
    ->name('blogs.blog.index');
  Route::get('/create', [BlogsController::class, 'create'])
    ->name('blogs.blog.create');
  Route::get('/show/{blog}', [BlogsController::class, 'show'])
    ->name('blogs.blog.show')->where('id', '[0-9]+');
  Route::get('/{blog}/edit', [BlogsController::class, 'edit'])
    ->name('blogs.blog.edit')->where('id', '[0-9]+');
  Route::post('/', [BlogsController::class, 'store'])
    ->name('blogs.blog.store');
  Route::put('blog/{blog}', [BlogsController::class, 'update'])
    ->name('blogs.blog.update')->where('id', '[0-9]+');
  Route::delete('/blog/{blog}', [BlogsController::class, 'destroy'])
    ->name('blogs.blog.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'seo_tools',
], function () {
  Route::get('/', [SeoToolsController::class, 'index'])
    ->name('seo_tools.seo_tool.index');
  Route::get('/create', [SeoToolsController::class, 'create'])
    ->name('seo_tools.seo_tool.create');
  Route::get('/show/{seoTool}', [SeoToolsController::class, 'show'])
    ->name('seo_tools.seo_tool.show')->where('id', '[0-9]+');
  Route::get('/{seoTool}/edit', [SeoToolsController::class, 'edit'])
    ->name('seo_tools.seo_tool.edit')->where('id', '[0-9]+');
  Route::post('/', [SeoToolsController::class, 'store'])
    ->name('seo_tools.seo_tool.store');
  Route::put('seo_tool/{seoTool}', [SeoToolsController::class, 'update'])
    ->name('seo_tools.seo_tool.update')->where('id', '[0-9]+');
  Route::delete('/seo_tool/{seoTool}', [SeoToolsController::class, 'destroy'])
    ->name('seo_tools.seo_tool.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'social_links',
], function () {
  Route::get('/', [SocialLinksController::class, 'index'])
    ->name('social_links.social_link.index');
  Route::get('/create', [SocialLinksController::class, 'create'])
    ->name('social_links.social_link.create');
  Route::get('/show/{socialLink}', [SocialLinksController::class, 'show'])
    ->name('social_links.social_link.show')->where('id', '[0-9]+');
  Route::get('/{socialLink}/edit', [SocialLinksController::class, 'edit'])
    ->name('social_links.social_link.edit')->where('id', '[0-9]+');
  Route::post('/', [SocialLinksController::class, 'store'])
    ->name('social_links.social_link.store');
  Route::put('social_link/{socialLink}', [SocialLinksController::class, 'update'])
    ->name('social_links.social_link.update')->where('id', '[0-9]+');
  Route::delete('/social_link/{socialLink}', [SocialLinksController::class, 'destroy'])
    ->name('social_links.social_link.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'company_settings',
], function () {
  Route::get('/', [CompanySettingsController::class, 'index'])
    ->name('company_settings.company_setting.index');
  Route::get('/create', [CompanySettingsController::class, 'create'])
    ->name('company_settings.company_setting.create');
  Route::get('/show/{companySetting}', [CompanySettingsController::class, 'show'])
    ->name('company_settings.company_setting.show')->where('id', '[0-9]+');
  Route::get('/{companySetting}/edit', [CompanySettingsController::class, 'edit'])
    ->name('company_settings.company_setting.edit')->where('id', '[0-9]+');
  Route::post('/', [CompanySettingsController::class, 'store'])
    ->name('company_settings.company_setting.store');
  Route::put('company_setting/{companySetting}', [CompanySettingsController::class, 'update'])
    ->name('company_settings.company_setting.update')->where('id', '[0-9]+');
  Route::delete('/company_setting/{companySetting}', [CompanySettingsController::class, 'destroy'])
    ->name('company_settings.company_setting.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'user_settings',
], function () {
  Route::get('/', [UserSettingsController::class, 'index'])
    ->name('user_settings.user_setting.index');
  Route::get('/create', [UserSettingsController::class, 'create'])
    ->name('user_settings.user_setting.create');
  Route::get('/show/{userSetting}', [UserSettingsController::class, 'show'])
    ->name('user_settings.user_setting.show')->where('id', '[0-9]+');
  Route::get('/{userSetting}/edit', [UserSettingsController::class, 'edit'])
    ->name('user_settings.user_setting.edit')->where('id', '[0-9]+');
  Route::post('/', [UserSettingsController::class, 'store'])
    ->name('user_settings.user_setting.store');
  Route::put('user_setting/{userSetting}', [UserSettingsController::class, 'update'])
    ->name('user_settings.user_setting.update')->where('id', '[0-9]+');
  Route::delete('/user_setting/{userSetting}', [UserSettingsController::class, 'destroy'])
    ->name('user_settings.user_setting.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'plugin_settings',
], function () {
  Route::get('/', [PluginSettingsController::class, 'index'])
    ->name('plugin_settings.plugin_setting.index');
  Route::get('/create', [PluginSettingsController::class, 'create'])
    ->name('plugin_settings.plugin_setting.create');
  Route::get('/show/{pluginSetting}', [PluginSettingsController::class, 'show'])
    ->name('plugin_settings.plugin_setting.show')->where('id', '[0-9]+');
  Route::get('/{pluginSetting}/edit', [PluginSettingsController::class, 'edit'])
    ->name('plugin_settings.plugin_setting.edit')->where('id', '[0-9]+');
  Route::post('/', [PluginSettingsController::class, 'store'])
    ->name('plugin_settings.plugin_setting.store');
  Route::put('plugin_setting/{pluginSetting}', [PluginSettingsController::class, 'update'])
    ->name('plugin_settings.plugin_setting.update')->where('id', '[0-9]+');
  Route::delete('/plugin_setting/{pluginSetting}', [PluginSettingsController::class, 'destroy'])
    ->name('plugin_settings.plugin_setting.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'rank_rewards',
], function () {
  Route::get('/', [RankRewardsController::class, 'index'])
    ->name('rank_rewards.rank_reward.index');
  Route::get('/create', [RankRewardsController::class, 'create'])
    ->name('rank_rewards.rank_reward.create');
  Route::get('/show/{rankReward}', [RankRewardsController::class, 'show'])
    ->name('rank_rewards.rank_reward.show')->where('id', '[0-9]+');
  Route::get('/{rankReward}/edit', [RankRewardsController::class, 'edit'])
    ->name('rank_rewards.rank_reward.edit')->where('id', '[0-9]+');
  Route::post('/', [RankRewardsController::class, 'store'])
    ->name('rank_rewards.rank_reward.store');
  Route::put('rank_reward/{rankReward}', [RankRewardsController::class, 'update'])
    ->name('rank_rewards.rank_reward.update')->where('id', '[0-9]+');
  Route::delete('/rank_reward/{rankReward}', [RankRewardsController::class, 'destroy'])
    ->name('rank_rewards.rank_reward.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'faqs',
], function () {
  Route::get('/', [FaqsController::class, 'index'])
    ->name('faqs.faq.index');
  Route::get('/create', [FaqsController::class, 'create'])
    ->name('faqs.faq.create');
  Route::get('/show/{faq}', [FaqsController::class, 'show'])
    ->name('faqs.faq.show')->where('id', '[0-9]+');
  Route::get('/{faq}/edit', [FaqsController::class, 'edit'])
    ->name('faqs.faq.edit')->where('id', '[0-9]+');
  Route::post('/', [FaqsController::class, 'store'])
    ->name('faqs.faq.store');
  Route::put('faq/{faq}', [FaqsController::class, 'update'])
    ->name('faqs.faq.update')->where('id', '[0-9]+');
  Route::delete('/faq/{faq}', [FaqsController::class, 'destroy'])
    ->name('faqs.faq.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'reward_sites',
], function () {
  Route::get('/', [RewardSitesController::class, 'index'])
    ->name('reward_sites.reward_site.index');
  Route::get('/create', [RewardSitesController::class, 'create'])
    ->name('reward_sites.reward_site.create');
  Route::get('/show/{rewardSite}', [RewardSitesController::class, 'show'])
    ->name('reward_sites.reward_site.show')->where('id', '[0-9]+');
  Route::get('/{rewardSite}/edit', [RewardSitesController::class, 'edit'])
    ->name('reward_sites.reward_site.edit')->where('id', '[0-9]+');
  Route::post('/', [RewardSitesController::class, 'store'])
    ->name('reward_sites.reward_site.store');
  Route::put('reward_site/{rewardSite}', [RewardSitesController::class, 'update'])
    ->name('reward_sites.reward_site.update')->where('id', '[0-9]+');
  Route::delete('/reward_site/{rewardSite}', [RewardSitesController::class, 'destroy'])
    ->name('reward_sites.reward_site.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'reward_submit_types',
], function () {
  Route::get('/', [RewardSubmitTypesController::class, 'index'])
    ->name('reward_submit_types.reward_submit_type.index');
  Route::get('/create', [RewardSubmitTypesController::class, 'create'])
    ->name('reward_submit_types.reward_submit_type.create');
  Route::get('/show/{rewardSubmitType}', [RewardSubmitTypesController::class, 'show'])
    ->name('reward_submit_types.reward_submit_type.show')->where('id', '[0-9]+');
  Route::get('/{rewardSubmitType}/edit', [RewardSubmitTypesController::class, 'edit'])
    ->name('reward_submit_types.reward_submit_type.edit')->where('id', '[0-9]+');
  Route::post('/', [RewardSubmitTypesController::class, 'store'])
    ->name('reward_submit_types.reward_submit_type.store');
  Route::put('reward_submit_type/{rewardSubmitType}', [RewardSubmitTypesController::class, 'update'])
    ->name('reward_submit_types.reward_submit_type.update')->where('id', '[0-9]+');
  Route::delete('/reward_submit_type/{rewardSubmitType}', [RewardSubmitTypesController::class, 'destroy'])
    ->name('reward_submit_types.reward_submit_type.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'reward_type_mappings',
], function () {
  Route::get('/', [RewardTypeMappingsController::class, 'index'])
    ->name('reward_type_mappings.reward_type_mapping.index');
  Route::get('/create', [RewardTypeMappingsController::class, 'create'])
    ->name('reward_type_mappings.reward_type_mapping.create');
  Route::get('/show/{rewardTypeMapping}', [RewardTypeMappingsController::class, 'show'])
    ->name('reward_type_mappings.reward_type_mapping.show')->where('id', '[0-9]+');
  Route::get('/{rewardTypeMapping}/edit', [RewardTypeMappingsController::class, 'edit'])
    ->name('reward_type_mappings.reward_type_mapping.edit')->where('id', '[0-9]+');
  Route::post('/', [RewardTypeMappingsController::class, 'store'])
    ->name('reward_type_mappings.reward_type_mapping.store');
  Route::put('reward_type_mapping/{rewardTypeMapping}', [RewardTypeMappingsController::class, 'update'])
    ->name('reward_type_mappings.reward_type_mapping.update')->where('id', '[0-9]+');
  Route::delete('/reward_type_mapping/{rewardTypeMapping}', [RewardTypeMappingsController::class, 'destroy'])
    ->name('reward_type_mappings.reward_type_mapping.destroy')->where('id', '[0-9]+');
});


Route::group([

  'prefix' => 'monthly_rewards',
], function () {
  Route::get('/', [MonthlyRewardsController::class, 'index'])
    ->name('monthly_rewards.monthly_reward.index');
  Route::get('/create', [MonthlyRewardsController::class, 'create'])
    ->name('monthly_rewards.monthly_reward.create');
  Route::get('/show/{monthlyReward}', [MonthlyRewardsController::class, 'show'])
    ->name('monthly_rewards.monthly_reward.show')->where('id', '[0-9]+');
  Route::get('/{monthlyReward}/edit', [MonthlyRewardsController::class, 'edit'])
    ->name('monthly_rewards.monthly_reward.edit')->where('id', '[0-9]+');
  Route::post('/', [MonthlyRewardsController::class, 'store'])
    ->name('monthly_rewards.monthly_reward.store');
  Route::put('monthly_reward/{monthlyReward}', [MonthlyRewardsController::class, 'update'])
    ->name('monthly_rewards.monthly_reward.update')->where('id', '[0-9]+');
  Route::delete('/monthly_reward/{monthlyReward}', [MonthlyRewardsController::class, 'destroy'])
    ->name('monthly_rewards.monthly_reward.destroy')->where('id', '[0-9]+');
  Route::post('disburse', [MonthlyRewardsController::class, 'disburse'])->name('monthly_rewards.monthly_reward.disburse');
});
Route::group([
  'prefix' => 'coupons',
], function () {
  Route::get('/', [CouponsController::class, 'index'])
    ->name('coupons.coupon.index');
  Route::get('/create', [CouponsController::class, 'create'])
    ->name('coupons.coupon.create');
  Route::get('/show/{coupon}', [CouponsController::class, 'show'])
    ->name('coupons.coupon.show')->where('id', '[0-9]+');
  Route::get('/{coupon}/edit', [CouponsController::class, 'edit'])
    ->name('coupons.coupon.edit')->where('id', '[0-9]+');
  Route::post('/', [CouponsController::class, 'store'])
    ->name('coupons.coupon.store');
  Route::put('coupon/{coupon}', [CouponsController::class, 'update'])
    ->name('coupons.coupon.update')->where('id', '[0-9]+');
  Route::delete('/coupon/{coupon}', [CouponsController::class, 'destroy'])
    ->name('coupons.coupon.destroy')->where('id', '[0-9]+');
});

Route::group([
  'prefix' => 'purchase_requests',
], function () {
  Route::get('/', [PurchaseRequestsController::class, 'index'])
    ->name('purchase_requests.purchase_request.index');

  Route::get('/show/{purchaseRequest}', [PurchaseRequestsController::class, 'show'])
    ->name('purchase_requests.purchase_request.show')->where('id', '[0-9]+');
  Route::get('/{purchaseRequest}/edit', [PurchaseRequestsController::class, 'edit'])
    ->name('purchase_requests.purchase_request.edit')->where('id', '[0-9]+');

  Route::get('/{purchaseRequest}/approve', [PurchaseRequestsController::class, 'approve'])
    ->name('purchase_requests.purchase_request.approve')->where('id', '[0-9]+');
  Route::get('/{purchaseRequest}/reject', [PurchaseRequestsController::class, 'reject'])
    ->name('purchase_requests.purchase_request.reject')->where('id', '[0-9]+');

  Route::put('purchase_request/{purchaseRequest}', [PurchaseRequestsController::class, 'update'])
    ->name('purchase_requests.purchase_request.update')->where('id', '[0-9]+');
  Route::delete('/purchase_request/{purchaseRequest}', [PurchaseRequestsController::class, 'destroy'])
    ->name('purchase_requests.purchase_request.destroy')->where('id', '[0-9]+');
});
