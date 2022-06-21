<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|mconsultants/editprofile
*/

Route::get('/', function () {
    // return view('welcome');
     return redirect('/login');
});

Route::get('/testMail72AE25495A7981C40622D49F9A52E4F1565C90F048F59027BD9C8C8900D5C3D8', 'TestController@index')->name('testMail'); 
Route::get('/afterUnsubscribe', 'UnsubscribeController@afterUnsubscribe')->name('afterunsubscribe');
Route::get('/unsubscribe/{user_id}', 'UnsubscribeController@unsubscribe')->name('unsubscribe');
Route::get('/unsubscribeMe/{token}', 'UnsubscribeController@index')->name('unsubscribeMe');
Route::get('/promotionOne', 'PromotionController@addToken')->name('promoOneToken');
Route::get('/worldData', 'Test2Controller@getWorldData')->name('updateWorldData');
Route::get('/testmail', 'Test2Controller@testMailSending')->name('testMail');

Route::get('/genReportAll/{rpId}/{companyId}/{reqId}', 'BuyreportController@downloadAll')->name('reportAllDownload');
Route::get('/genReportAml/{rpId}', 'BuyreportController@repAml')->name('reportAML');
Route::get('/genReportIa/{rpId}', 'BuyreportController@repIa')->name('reportInvestorsAlert');
Route::get('/genReportAm/{rpId}', 'BuyreportController@repAm')->name('reportAdverMedia');

Route::get('/panamaList', 'AlertedrecordsController@panama')->name('panamaList');
Route::get('/offshoreList', 'AlertedrecordsController@offshore')->name('offshoreList');
Route::get('/bahamasList', 'AlertedrecordsController@bahamas')->name('bahamasList');
Route::get('/paradiseList', 'AlertedrecordsController@paradise')->name('paradiseList');

Route::get('/highRisk/{type}', 'AlertedrecordsController@highRisk')->name('highRiskProfile');

//subaccounts
Route::get('/subaccounts', 'SubaccountsController@index')->name('setSubaccounts');
Route::get('/register-sa/{userId}', 'SubaccountsController@setRegistration')->name('registerSubAccount');
Route::post('/registerconfig', 'SubaccountsController@ajxRegistration')->name('AjaxRegistration');
Route::post('/deactivate-sa', 'SubaccountsController@ajxDeactivate')->name('AjaxSADeactivation');

//for social media. public usage
//Route::get('/company/{brand}/{id}/{oppId}/{token}', 'CompanyController@index')->name('companySocialsharing'); #old
Route::get('/company/{brand}/{id}', 'CompanyController@index')->name('companySocialsharing');
Route::get('/fbshare/{id}/{brand}', 'FbshareController@shareOnFB')->name('fbcompanyshare');
Route::get('/company/{id}', 'CompanyController@previewPremiumCompany')->name('PreviewPremiumCompany');
Route::post('/company/follow', 'CompanyController@followCompany')->name('updateFollowCompany');


Auth::routes();
//paypal listener
Route::get('/ipn', 'IpnController@getIpnDataGet')->name('GetIpnDataGet');
Route::post('/ipn', 'IpnController@getIpnDataPost')->name('GetIpnDataPost');
//Route::get('/paypal/ipn', 'IpnController@fetchIpnResponse')->name('fetchIpnResponse');

//request company ownership and company removal
Route::get('/req-own-company/{reqId}/{provId}', 'CompanyOwningRemovalController@reqCompanyOwn')->name('reqCompanyOwn');
Route::get('/req-rem-company/{reqId}/{provId}', 'CompanyOwningRemovalController@reqCompanyRem')->name('reqCompanyRem');
Route::post('/reqown', 'CompanyOwningRemovalController@getDocumentRequest')->name('getDocumentRequest');
Route::post('/reqremove', 'CompanyOwningRemovalController@getRemoveRequest')->name('getRemoveRequest');

Route::get('/req-list', 'CompanyOwningRemovalController@adminReqList')->name('adminReqList');
Route::post('/req-approve', 'CompanyOwningRemovalController@adminApproveCompanyReq')->name('adminApproveCompanyReq');
Route::post('/req-reject', 'CompanyOwningRemovalController@adminRejectRequest')->name('adminRejectRequest');

//videochat
Route::get('/vc-end/{channel}', 'VideoChatController@endVideo')->name('vcEndVideo');
Route::get('/vc/{oppId}/{oppType}/{companyOpp}/{companyViewer}', 'VideoChatController@loadVideoPage')->name('vcloadVideoPage');
Route::post('/vc-details', 'VideoChatController@getVideoChatDetails')->name('getVideoChatDetails');

Route::post('/vc-companyDetails', 'VideoChatController@getVideoChatCompanyDetails')->name('getVideoChatCompanyDetails');
Route::get('/vc-companysearch/{companyId}', 'VideoChatController@companySearchVideoChat')->name('companySearchVideoChat');
Route::get('/vc-end-companysearch/{channel}', 'VideoChatController@endVideoCompanySearch')->name('vcEndVideoCompanySearch');


//points
Route::get('/rewards', 'TokenConfirmController@getCreditPoints')->name('CompanyCreditPoints');

//update password
Route::post('/psswrd-update', 'UpdatePasswordController@getData')->name('getPasswordData');
Route::get('/psswrd-set', 'UpdatePasswordController@setData')->name('setPasswordData');

//for updating tour
Route::post('/updateTour', 'TourDetailController@updateTour')->name('updateTour');

//points
Route::get('/rewards', 'TokenConfirmController@getCreditPoints')->name('CompanyCreditPoints');

Route::get('/api/v1/get-opportunities/{accessToken}', 'ApiTokenController@getOpportunities')->name('GetOpportunities');

Route::get('/api/v1/gettoken-transaction/{url}', 'ApiTokenController@validateTransactionUrl')->name('ValidateTransactionUrl');
Route::get('/api/v1/token-validate/{accessToken}', 'ApiTokenController@validateAccessToken')->name('ValidateToken');
Route::get('/api/v1/report-req', 'ReferralController@apiRequestReportER')->name('apiRequestReportER');
Route::get('/api/v1/get-opp/', 'ApiTokenController@getOpportunitiesFree')->name('GetOpportunitiesFree');
Route::get('/api/v1/top-advisers/', 'ApiTokenController@getTopAdvisers')->name('GetTopAdvisers');

Route::post('/accounts-switch', 'HomeController@switchAccount')->name('switchAccount');
Route::get('/countryListings', 'HomeController@getCountries')->name('getCountryList');
Route::get('/search-company', 'ConfigurationController@searchCompany')->name('searchByCompany');
Route::post('/requestreport-company', 'OpportunityController@storeSearchCompany')->name('storeSearchCompany');
Route::get('/referrals', 'HomeController@referralsList')->name('referralsList');
Route::post('/referrals/update', 'HomeController@updateReferStatus')->name('updateReferStatus');

Route::get('/register-ref/{userId}', 'ReferralController@showRefRegistrationForm')->name('registerDynamicReferral');
Route::get('/register-personnel/{usertype}/{token}', 'ReferralController@showRegistrationForm')->name('registerDynamic');

Route::get('/alertedRecords', 'AlertedrecordsController@index')->name('alertedRecordsIndex');

Route::get('/getCompanyNames', 'HomeController@getCompany')->name('getCompanyByNames');
Route::get('/token-confirm-index', 'TokenConfirmController@index')->name('getTokenActivated');


//superadmin
Route::get('/accounts-approval', 'SuperAdminController@approvalPage')->name('approvalPageAdmin');
Route::post('/accounts-saveApproval', 'SuperAdminController@storeApproval')->name('storeApprovalAdmin');
Route::get('/accountsCompanies', 'SuperAdminController@allCompanies')->name('allCompanies');
Route::get('/manage-registration-links', 'SuperAdminController@manageLinks')->name('manageRegsLink');
Route::post('/add-registration-link', 'SuperAdminController@addLinks')->name('addRegsLink');

Route::get('/transferCompany', 'SuperAdminController@getTransferCompany')->name('GetTransferCompany');
Route::post('/viewUserCompany', 'SuperAdminController@viewAjxCompany')->name('ViewAjxCompany');
Route::post('/addUserCompany', 'SuperAdminController@addAjxCompany')->name('AddAjxCompany');
Route::post('/transferUserCompany', 'SuperAdminController@transferAjxCompany')->name('TransferAjxCompany');
Route::post('/selectedUserCompany', 'SuperAdminController@selectedUserCompany')->name('SelectedUserCompany');
Route::post('/transferSelectedCompany', 'SuperAdminController@transferSelectedCompany')->name('TransferSelectedCompany');
Route::post('/addTokenSelectedCompany', 'SuperAdminController@addTokenSelectedCompany')->name('AddTokenSelectedCompany');
Route::get('/tokenCompany', 'SuperAdminController@getTokenCompany')->name('GetTokenCompany');

//chat history
Route::post('/chatProcess', 'ChatHistoryController@process')->name('chatProcess');
Route::post('/chatProcess2', 'ChatHistoryController@process2')->name('chatProcess2');
Route::post('/chatHeadProcess', 'ChatHistoryController@processHead')->name('chatProcessHead');
Route::post('/chatChangeStatus', 'ChatHistoryController@changeStatus')->name('chatSetStatus');

//credit
Route::post('/credit/spend', 'CreditController@getChatCredit')->name('getChatCredit');
Route::get('/advisor', 'GamificationController@listOfAdvisers')->name('listOfAdvisers');

//redeeming points
Route::post('/redemp-rewards', 'GamificationController@redeemRewards')->name('redeemRewards');
Route::post('/redeem-details', 'GamificationController@redeemDetails')->name('redeemDetails');
Route::post('/redeem-approval', 'GamificationController@redeemGetApproved')->name('redeemGetApproved');
Route::post('/redeem-approvalAP', 'GamificationController@redeemGetApprovedAP')->name('redeemGetApprovedAP');
Route::post('/redemp-entlevel', 'GamificationController@redeemRewardsEntLevel')->name('redeemEnterpriseRewards');

//approval by AP
Route::get('/redeem-accpay', 'GamificationController@finalApproverList')->name('APfinalApproverList');
Route::get('/redeem-accpay-preview/{requestId}', 'GamificationController@apPrintPreview')->name('APapproverPrintPreview');

//staff
Route::get('/thomson', 'ThomsonController@search')->name('thomsonSearch');
Route::get('/thomson/history', 'ThomsonController@history')->name('thomsonHistory');
Route::post('/thomson', 'ThomsonController@searchFound')->name('thomsonSearchFound');
Route::post('/thomsonCompanySearch', 'ThomsonController@searchFoundCompany')->name('searchFoundCompany');

Route::post('/thomsonreuters/search', 'CompanyprofileController@searchThomsonReuters')->name('searchThomsonReuters');
Route::get('/thomson-getNationality', 'ThomsonController@getNationality')->name('getNationality');
Route::get('/thomson-getCountryLocation', 'ThomsonController@getCountryLocation')->name('getCountryLocation');
Route::get('/thomson-print/{id}', 'ThomsonController@printPreview')->name('printPreview');
Route::post('/tr-tagging', 'ThomsonController@trProcess')->name('trTagging');
Route::post('/tr-deleting', 'ThomsonController@trDelete')->name('trDeleting');
Route::get('/thomson-pdfprint/{ids}', 'ThomsonController@pdfPrintDownload')->name('downloadPdf');
Route::get('/thomson-pdfcaseprint/{ids}', 'ThomsonController@pdfcasePrintDownload')->name('downloadPdf');

Route::get('/refinitive/history/{ids}', 'ThomsonController@refinitiveHistory')->name('refinitiveHistory');

//dashboard
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/homeSubConsul', 'HomeController@subConsultant')->name('homeSubConsultant');
Route::get('/homeMasterConsul', 'HomeController@masterConsultant')->name('homeMasterConsultant');
Route::get('/homeStaff', 'HomeController@ebosStaff')->name('ebosStaff');
Route::get('/accounts', 'HomeController@accounts')->name('accounts');#get all accounts
Route::get('/homeAdmin', 'HomeController@adminDashboard')->name('adminDashboard');
Route::post('/home/companyAdd', 'HomeController@addCompany')->name('homeAddCompany');
Route::post('/home/companySelect', 'HomeController@selectCompany')->name('homeSelectCompany');
Route::get('/homeSales', 'HomeController@ebosSales')->name('ebosSales');
Route::get('/homeAP', 'HomeController@ebosAP')->name('ebosAP');
Route::get('/homeSA', 'HomeController@ebosSA')->name('ebosSA');
Route::get('/samanage/{company_id}', 'SubaccountsController@manageSelectedCompany')->name('ManageSelectedCompany');

//consultant
Route::get('/consultants', 'ConsultantsController@index')->name('indexConsultantFAreport');
Route::get('/consultants/viewprofile', 'ConsultantsController@viewProfile')->name('viewProfileSC');
Route::get('/consultants/editprofile', 'ConsultantsController@editProfile')->name('editProfileSC');
Route::post('/consultants/storeprofile', 'ConsultantsController@storeProfile')->name('storeProfileSC');
Route::get('/consultants/billing', 'ConsultantsController@billing')->name('billingSC');
Route::post('/consultant/billing/create', 'ConsultantsController@billingStore')->name('createBillingSC');
Route::post('/consultant/billing/update', 'ConsultantsController@billingUpdate')->name('updateBillingSC');

Route::get('/consultants/commission', 'ConsultantsController@commission')->name('commissionSC');
Route::get('/consultants/pending-projects', 'ConsultantsController@pendingProjects')->name('pendingProjectsSC');
Route::get('/consultants/ongoing-projects', 'ConsultantsController@ongoingProjects')->name('ongoingProjectsSC');
Route::get('/consultants/archived-projects', 'ConsultantsController@archivedProjects')->name('archivedProjectsSC');
Route::post('/consultants/updateProject', 'ConsultantsController@updateProject')->name('updateProjectSC');
Route::post('/consultants/updateOngoingProject', 'ConsultantsController@updateOngoingProject')->name('updateOngoingProjectSC');
Route::post('/consultants/profile-requester', 'ConsultantsController@getRequesterInformation')->name('getRequesterInformation');
Route::post('/consultants-profile/uploadProfileImgSC', 'ConsultantsController@uploadProfileSC')->name('uploadProfileImgSC');
Route::post('/consultants/uploadCertificationsSC', 'ConsultantsController@uploadCertificationsSC')->name('uploadCertificationsSC');

//master consultant
Route::get('/mconsultants/viewprofile', 'MasterConsultantsController@viewProfile')->name('viewProfileMC');
Route::get('/mconsultants/editprofile', 'MasterConsultantsController@editProfile')->name('editProfileMC');
Route::post('/mconsultants/storeprofile', 'MasterConsultantsController@storeProfile')->name('storeProfileMC');
Route::get('/mconsultants/projectOverview', 'MasterConsultantsController@projectOverview')->name('projectOverviewMC');
Route::get('/mconsultants/projectPending', 'MasterConsultantsController@projectPending')->name('projectPendingMC');
Route::get('/mconsultants/projectOngoing', 'MasterConsultantsController@projectOngoing')->name('projectOngoingMC');
Route::get('/mconsultants/projectCompleted', 'MasterConsultantsController@projectCompleted')->name('projectCompletedMC');

Route::post('/mconsultants/saveProject', 'MasterConsultantsController@saveProject')->name('saveProjectMC');
Route::post('/mconsultants-profile/uploadProfileImgMC', 'MasterConsultantsController@uploadProfileMC')->name('uploadProfileImgMC');
Route::post('/mconsultants/uploadCertificationsMC', 'MasterConsultantsController@uploadCertificationsMC')->name('uploadCertificationsMC');
Route::post('/mconsultants/updateDuedate', 'MasterConsultantsController@updateDuedate')->name('updateDuedateMC');

//business new and opportunities
Route::get('/businessnews/list', 'BusinessOpportunityNewsController@list')->name('businessnewsList');
Route::get('/businessnews', 'BusinessOpportunityNewsController@index')->name('businessnewsIndex');
Route::post('/businessnews/store', 'BusinessOpportunityNewsController@store')->name('businessnewsStore');
Route::post('/businessnews/save', 'BusinessOpportunityNewsController@saveNews')->name('saveBusinessNews');
Route::post('/businessnews/del', 'BusinessOpportunityNewsController@delNews')->name('delBusinessNews');
Route::get('/businessnews/retcontent/{id}', 'BusinessOpportunityNewsController@retNewsContent')->name('retNewsContent');
Route::get('/businessnews/retNewsDetails/{id}', 'BusinessOpportunityNewsController@retNewsDetails')->name('retNewsDetails');
Route::post('/businessnews/update', 'BusinessOpportunityNewsController@updateNews')->name('updateNews');

//Staff Approval for Opportunities
Route::get('/opportunity/approval/{status}', 'OpportunityController@approval')->name('opportunityApproval');
Route::get('/opportunity/editApprovalBuild/{id}', 'OpportunityController@editApprovalBuild')->name('opportunityEditApprovalBuild');
Route::get('/opportunity/editApprovalSellOffer/{id}', 'OpportunityController@editApprovalSellOffer')->name('opportunityEditApprovalSellOffer');
Route::get('/opportunity/editApprovalBuy/{id}', 'OpportunityController@editApprovalBuy')->name('opportunityEditApprovalBuy');
Route::post('/opportunity/approved', 'OpportunityController@approved')->name('opportunityApproved');
Route::get('/opportunity/getCurrencyBasedID/{amount}/{original_currency}/{currency_now}', 'OpportunityController@getCurrencyBasedID')->name('getCurrencyBasedID');

//business news
Route::get('/businessnews/approval/{status}', 'BusinessOpportunityNewsController@approval')->name('businessNewsApproval');
Route::get('/businessnews/editApprovalNews/{id}', 'BusinessOpportunityNewsController@editApprovalNews')->name('BusinessNewsEditApproval');
Route::post('/businessnews/approved', 'BusinessOpportunityNewsController@approved')->name('businessNewsApproved');

//rewards
// Route::get('/rewards/approval/{status}', 'GamificationController@approval')->name('rewardApproval');
Route::get('/rewards/approval/pending', 'GamificationController@approvalPending')->name('rewardApprovalPending');
Route::get('/rewards/approval/approved', 'GamificationController@approvalApproved')->name('rewardApprovalApproved');
Route::post('/rewards/approved', 'GamificationController@approved')->name('rewardApproved');

//opportunities
Route::get('/opportunity', 'OpportunityController@index')->name('opportunityIndex');

Route::get('/opportunity/chatbox', 'OpportunityController@chatbox')->name('opportunityChat');
Route::get('/opportunity/select', 'OpportunityController@select')->name('opportunitySelect');
Route::post('/opportunity/premium', 'OpportunityController@premiumPurchase')->name('PremiumPurchase');
Route::post('/opportunity/alertFreeAccount', 'OpportunityController@alertFreeAccount')->name('AlertFreeAccount');
Route::post('/opportunity/OppotunityUpdate', 'OpportunityController@updateOpportunityDetail')->name('updateOpportunityDetail');

Route::get('/opportunity/build', 'OpportunityController@buildNew')->name('opportunityNewBuild');
Route::get('/opportunity/editBuild/{id}', 'OpportunityController@editBuild')->name('opportunityEditBuild');
Route::post('/opportunity/build/create', 'OpportunityController@storeBuild')->name('opportunityStoreNewBuild');
Route::get('/opportunity/deleteBuild/{id}', 'OpportunityController@deleteBuild')->name('opportunityDeleteBuild');
Route::post('/opportunity/privacyOption', 'OpportunityController@privacyOption')->name('opportunityPrivacyOption');

Route::get('/opportunity/selloffer', 'OpportunityController@sellNew')->name('opportunitySellOffer');
Route::get('/opportunity/editSellOffer/{id}', 'OpportunityController@editSellOffer')->name('opportunityEditSellOffer');
Route::post('/opportunity/selloffer/create', 'OpportunityController@storeSellOffer')->name('opportunityStoreSellOffer');

Route::get('/opportunity/deleteSell/{id}', 'OpportunityController@deleteSell')->name('opportunityDeleteSell');

Route::get('/opportunity/buy', 'OpportunityController@buyNew')->name('opportunityBuy');
Route::get('/opportunity/editBuy/{id}', 'OpportunityController@editBuy')->name('opportunityEditBuy');
Route::post('/opportunity/buy/create', 'OpportunityController@storeBuy')->name('opportunityStoreBuy');

Route::get('/opportunity/deleteBuy/{id}', 'OpportunityController@deleteBuy')->name('opportunityDeleteBuy');

Route::get('/opportunity/explore', 'OpportunityController@explore')->name('opportunityExploreIndex');
Route::get('/opportunity/details', 'OpportunityController@details')->name('opportunityDetailsIndex');
Route::get('/opportunity/hashtag/{hashTag}', 'OpportunityController@getHashtag')->name('opportunityExploreHashtag');

Route::get('/opportunity/exploreKey/{key}', 'OpportunityController@exploreKey')->name('opportunityExploreKey');
Route::get('/opportunity/exploreCountry/{key}', 'OpportunityController@exploreCountry')->name('opportunityExploreCountry');
Route::get('/opportunity/exploreMy/{industry}/{business}', 'OpportunityController@exploreMy')->name('opportunitySearchMy');

Route::get('/opportunity/request/{oppType}/{oppId}', 'OpportunityController@requestReport')->name('opportunityRequest');
Route::post('/opportunity/request/store', 'OpportunityController@storeRequestReport')->name('opportunityStoreRequest');

//profile routes
Route::post('/approveprofile/viewUser', 'CompanyprofileController@viewUser')->name('viewingProfileUser');
Route::get('/approveprofile/viewUser', 'CompanyprofileController@viewUser')->name('viewingProfileUserHome');
Route::get('/profile/viewer/{companyId}', 'CompanyprofileController@viewer')->name('viewingUserProfile');
Route::get('/profile/view', 'CompanyprofileController@view')->name('viewingProfile');

Route::get('/profile/edit', 'CompanyprofileController@edit')->name('editProfile');
Route::get('/profile/create', 'CompanyprofileController@edit')->name('editcreateProfile');
Route::post('/profile/create', 'CompanyprofileController@store')->name('storeProfile');
Route::post('/profile/processPDF', 'CompanyprofileController@processPDF')->name('processPDF');
Route::post('/profile/uploadProfileImg', 'CompanyprofileController@uploadProfile')->name('uploadProfileImg');
Route::post('/profile/uploadAwards', 'CompanyprofileController@uploadAwards')->name('uploadAwards');
Route::post('/profile/uploadPurchaseInvoices', 'CompanyprofileController@uploadPurchaseInvoices')->name('uploadPurchaseInvoices');
Route::post('/profile/uploadSalesInvoies', 'CompanyprofileController@uploadSalesInvoices')->name('uploadSalesInvoies');
Route::post('/profile/uploadCertifications', 'CompanyprofileController@uploadCertifications')->name('uploadCertifications');
Route::post('/profile/delUploadedFile', 'CompanyprofileController@deleteUploadedFile')->name('delUploadedFile');
Route::post('/profile/uploadImgBanner', 'CompanyprofileController@uploadBannerFile')->name('uploadingBanner');
Route::get('/profile/contacts', 'CompanyContactsController@index')->name('indexContacts');
Route::post('/profile/contacts/create', 'CompanyContactsController@store')->name('createContacts');
Route::get('/profile/contacts/create', 'CompanyContactsController@index')->name('indexCreateContacts');
Route::get('/profile/billing', 'CompanyBillingController@index')->name('indexBilling');
Route::post('/profile/billing/create', 'CompanyBillingController@store')->name('createBilling');
Route::get('/profile/billing/create', 'CompanyBillingController@index')->name('createBill');
Route::post('/profile/billing/update', 'CompanyBillingController@update')->name('updateBilling');
Route::get('/profile/paymentHistory', 'CompanyPaymentController@index')->name('indexPaymentHistory');

Route::get('/profile/paymentHistoryPdf/{companyId}/{reportType}', 'CompanyPaymentController@generatePdf')->name('PaymentHistoryPdf'); //added by daryl 3-16-2020

Route::get('/profile/socialAccounts', 'CompanySocialAccountsController@index')->name('indexSocialAccounts');
Route::post('/profile/socialAccounts/create', 'CompanySocialAccountsController@store')->name('createSocialAccounts');

Route::get('/profile/deactivatePage', 'CompanyprofileController@deactivatePage')->name('deactivateAccountPage');
Route::post('/profile/deactivate', 'CompanyprofileController@deactivate')->name('deactivateAccount');
Route::post('/profile/saveKeyManagement', 'CompanyprofileController@saveKeyManagementPersonnel')->name('saveKM');
Route::post('/profile/editKeyManagement', 'CompanyprofileController@editKeyManagementPersonnel')->name('editKM');
Route::post('/profile/deleteKeyManagement', 'CompanyprofileController@deleteKeyManagementPersonnel')->name('deleteKM');

Route::get('/profile/printPreviewTokenPurchased/{companyId}', 'CompanyPaymentController@printPreviewPurchased')->name('printPreviewPurchased');
Route::get('/profile/printPreviewTokenSpent/{companyId}', 'CompanyPaymentController@printPreviewSpent')->name('printPreviewSpent');

Route::post('/profile/editFileExpiryDate', 'CompanyprofileController@updateFileExpiryDate')->name('updateFileExpiry');

//configuration routes
Route::get('/sysconfig', 'ConfigurationController@index')->name('sysIndex');
Route::post('/sysconfig/update', 'ConfigurationController@update')->name('sysUpdate');
Route::get('/sysconfig/assignConsultants', 'ConfigurationController@assignConsultants')->name('assignConsultants');
Route::post('/sysconfig/storeConsultants', 'ConfigurationController@storeConsultants')->name('storeConsultants');
Route::post('/sysconfig/editConsultants', 'ConfigurationController@editConsultants')->name('editConsultants');
Route::post('/sysconfig/delConsultants', 'ConfigurationController@delConsultants')->name('delConsultants');
Route::get('/sysconfig/reportTemplate', 'ConfigurationController@reportGenTemplates')->name('reportTemplates');
Route::post('/sysconfig/reportupdate', 'ConfigurationController@reportUpdate')->name('rep_update');

//mailbox
Route::post('/mailbox/notification', 'MailboxController@notification')->name('emailNotification');
Route::get('/mailbox/list', 'MailboxController@list')->name('mailList');
Route::get('/mailbox/compose', 'MailboxController@compose')->name('mailCompose');
//Route::post('/mailbox/createCompose', 'MailboxController@createCompose')->name('mailCreateCompose');
//Route::get('/mailbox/createCompose', 'MailboxController@createCompose')->name('mailCreateCompose');
Route::post('/mailbox/storeCompose', 'MailboxController@storeCompose')->name('mailStoreCompose');
Route::get('/mailbox/sentMail', 'MailboxController@sentMail')->name('sentMail');

//buying option
Route::get('/mailbox/buyingOption', 'MailboxController@composeBuyingOption')->name('ComposeBuyingOption');
Route::post('/mailbox/storeEnterpriseCompose', 'MailboxController@storeEnterpriseCompose')->name('StoreEnterpriseCompose');

Route::post('/mailbox/storeReply', 'MailboxController@storeReply')->name('mailStoreReply');
Route::get('/mailbox/setReply/{id}', 'MailboxController@setReply')->name('mailSetReply');


// changes by mojahed July 8, 2019
//Route::get('/mailbox/list', 'MailboxController@list')->name('mailList');
//Route::get('/mailbox/compose', 'MailboxController@compose')->name('mailCompose');
Route::get('/mailbox/createCompose', 'MailboxController@createCompose')->name('mailCreateCompose');
Route::get('/mailbox/emails', 'MailboxController@emailList')->name('getEmailList');

Route::get('/mailbox/createReferal', 'MailboxController@createReferal')->name('createReferals');
Route::post('/mailbox/sendReferal', 'MailboxController@sendReferal')->name('sendReferals');

//request report approve page
Route::get('/reports/approve/{reqID}/{companyID}/{sourceID}', 'ConfigurationController@reqApprovalPage')->name('reqApprovalPage');
Route::post('/reports/requestApprove', 'RequestReportController@reqApprovalPage')->name('requestApproveExecute');
Route::post('/reports/requestReject', 'RequestReportController@reqRejectPage')->name('requestRejectExecute');
//http://localhost/prokakis//reports/approve/MQ==/Mg==/NQ==

//reports
Route::get('/reports/requesters/', 'RequestReportController@requestersSummaryList')->name('requestersSummaryList');

Route::get('/reports', 'ReportsController@index')->name('reportIndex');
Route::get('/monitoring/list', 'OngoingMonitoringController@list')->name('ongoMoniList');
Route::get('/reports/status', 'ReportsController@list')->name('listingStatusReports');
Route::get('/reports/buyTokens', 'ReportsController@buyTokens')->name('reportsBuyTokens');
Route::get('/reports/buyCredits', 'ReportsController@buyTokens')->name('reportsBuyCredits');
Route::post('/reports/topUpTokens', 'ReportsController@topUpTokens')->name('reportsTopUpTokens');

//Currency monetary
Route::post('/currency/accountUpdate', 'CurrencyController@updateAccount')->name('updateCurrency');

//Audti Trail Log
Route::post('/auditTrail/log', 'AuditTrailerLogController@index')->name('saveAuditTrailLog');
Route::get('/auditTrailLog/view', 'AuditTrailerLogController@view')->name('viewAuditTrailLog');

//report request
Route::get('/reports/requestUpdate/{id}', 'RequestReportController@requestCompanyUpdate')->name('requestCompanyUpdate');
Route::get('/reports/requestDiscontinue/{id}', 'RequestReportController@requestDiscontinue')->name('requestDiscontinue');
Route::get('/reports/requestCompleted/{id}', 'RequestReportController@requestCompleted')->name('requestCompleted');
Route::get('/reports/requestDownload/{id}', 'RequestReportController@requestDownload')->name('requestDownload');

Route::get('/buyTokens/success', 'BuytokenController@buyTokensSuccess')->name('reportsBuyTokensSuccess');
Route::get('/buyTokens/cancel', 'BuytokenController@buyTokensCancel')->name('reportsBuyTokensCancel');

Route::get('/buyReport/setBuy', 'BuyreportController@setBuy')->name('setBuyReport');
Route::post('/buyReport/setBuy', 'BuyreportController@setBuy')->name('setBuyReport');  //generate pdf report
Route::post('/buyReport/storeBuy', 'BuyreportController@storeBuy')->name('storeBuyReport');
Route::get('/buyReport/download/{companyId}/{reqId}', 'BuyreportController@downloadReport')->name('downloadReport'); //generate pdf report

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
//$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

// USER CORE HISTORY
Route::get('/coreAccountsHistory', 'HomeController@coreAccountsHistory')->name('coreAccountsHistory');

$this->post('authlogin', 'Auth\LoginController@login')->name('authlogin');
$this->post('login', 'Auth\AuthController@authenticate')->name('loginauth');

//API 
Route::get('refinitive', 'Api\ThomsonApiController@refinitive')->name('refinitive');
