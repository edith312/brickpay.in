<?php
defined('BASEPATH') or exit('No direct script access allowed');

// @ Shiv Web Developer

$route['default_controller'] = 'Home/userLogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ---------Linkedin Login ---------
$route['linkedin_login'] = 'linkedin_login/index';
$route['linkedin_callback'] = 'linkedin_login/callback';
$route['linkedin_success'] = 'linkedin_login/success';
$route['linkedin_logout'] = 'linkedin_login/logout';



$route['choose-role'] = 'Home/choose_role';
// ---------Company Dashboard ---------
$route['company/login'] = 'Home/choose_role';
// $route['company/login'] = 'CompanyAuth/login';
$route['register'] = 'Home/register';
$route['user/login'] = 'Home/userLogin';

$route['company/payment/success'] = 'Home/companyPaymentSuccess';
$route['user/payment/success'] = 'Home/userPaymentSuccess';
$route['project/payment/success'] = 'Home/projectPaymentSuccess';

$route['company/company-delete'] = 'Home/companyDeleteByUser';
$route['company/project-delete'] = 'Home/projectDeleteByUser';
$route['company/brick-delete'] = 'Home/brickDeleteByUser';
$route['company/brick-trash'] = 'Home/brick_trash';
$route['company/brick-restore'] = 'Home/brick_restore';

$route['company/project-trash'] = 'Home/Project_Trash';
$route['company/project-restore'] = 'Home/projectRestore';

$route['company/company-trash'] = 'Home/Company_Trash';
$route['company/company-restore'] = 'Home/CompanyRestore';

$route['company/dashboard'] = 'Home';
$route['company/profile'] = 'Home/profile_update';
$route['company/user_profile'] = 'Home/user_profile';
$route['company/create-company-profile'] = 'Home/create_company_profile';
$route['company/user_preview'] = 'Home/user_preview';
$route['company/company-edit'] = 'Home/companyEdit';
$route['company/create-brick'] = 'Home/post_task';
$route['company/bricks'] = 'Home/posted_task';
$route['company/brick/(:any)/(:any)'] = 'Home/view_posted/$1/$2';

$route['company/create-project'] = 'Home/create_project';
$route['company/edit-project'] = 'Home/projectEdit';
$route['razorpay_checkout'] = 'Home/razorpay_checkout';
$route['company/create-team'] = 'Home/role_employment';
$route['company/create-team-new'] = 'Teams/create';
$route['company/galaxy'] = 'Home/galaxy';
$route['company/3d-world'] = 'Home/threeDWorld';
$route['company/map'] = 'Home/map';
$route['company/school'] = 'Home/school';
$route['company/school/(:any)'] = 'Home/school/$1';
$route['company/school/(:any)/(:any)'] = 'Home/school/$1/$2';
$route['science/chemistry/element/(:any)'] = 'Home/element/$1';
$route['company/degree/(:any)'] = 'Home/degree/$1';
$route['company/industries/department'] = 'Home/department';
$route['company/market-research'] = 'Home/market_research';
$route['company/reverse-process'] = 'Home/reverse_process';
$route['company/crm'] = 'Home/crm';
$route['company/revenue'] = 'Home/revenue';
$route['company/plant-manufacturing-production'] = 'Home/plant_manufacturing_production';
$route['company/police-court'] = 'Home/police_court';
$route['company/medical-identity'] = 'Home/medical_identity';
$route['company/medical-identity-trash'] = 'Home/medical_identity_trash';
$route['company/save-political-data'] = 'Home/save_political_data';




$route['company/participate_bricks'] = 'Home/participate_bricks';
$route['company/project_visualization'] = 'Home/project_visualization';
$route['company/preview_brick'] = 'Home/preview_brick';
$route['company/brick-team-members'] = 'Home/brick_team_members';
$route['company/permission'] = 'Home/permission';
$route['company/check_votingrights'] = 'Home/check_votingrights';

$route['company/taskcompleteupdate'] = 'Home/taskcompleteupdate';
$route['company/addedValuation'] = 'Home/addedValuation';
$route['company/fund_request_for_brick'] = 'Home/fund_request_for_brick'; // @Shiv Web Developer on 04 July 2025
$route['company/fundRequestProcess'] = 'Home/fundRequestProcess'; // @Shiv Web Developer on 04 July 2025
$route['company/add-work-allotment'] = 'Home/add_work_allotment'; // @Shiv Web Developer on 05 July 2025
$route['company/workAllotmentRequestProcess'] = 'Home/workAllotmentRequestProcess'; // @Shiv Web Developer on 05 July 2025
$route['company/add_consultancy_advisory'] = 'Home/add_consultancy_advisory';
$route['company/brickConsultancyRequestProcess'] = 'Home/brickConsultancyRequestProcess'; // @Shiv Web Developer on 09 July 2025
$route['company/send_channel_request'] = 'Home/send_channel_request';
$route['company/network-marketing-chanel-request'] = 'Home/network_marketing_chanel_request';
$route['company/create-channel-name'] = 'Home/create_channel_name';
$route['company/get-all-channel-on-create'] = 'Home/get_all_channel_on_create';
$route['company/moneywallet_transfer'] = 'Home/moneywallet_transfer';
$route['company/brick_voting'] = 'Home/brick_voting';
$route['company/preview_project'] = 'Home/preview_project';
$route['company/board_room'] = 'Home/board_room';
$route['company/project_history'] = 'Home/project_history';
$route['company/create_company'] = 'Home/create_company';
$route['company/management_panel'] = 'Home/management_panel';
$route['company/project-profile'] = 'Home/project_profile';
$route['company/create-team-member'] = 'Home/create_team_member';
$route['company/company-preview'] = 'Home/company_preview';
$route['company/company-team-members'] = 'Home/company_team_members';
$route['company/company-added-valuation'] = 'Home/company_added_valuation';
$route['company/company-financial-year-reports'] = 'Home/company_financial_year_reports';
$route['company/company-cashflow-projection-booking'] = 'Home/company_cashflow_projection_booking';
$route['company/company-bid-over-booking'] = 'Home/company_bid_over_booking';
$route['company/company-profile'] = 'Home/company_profile';
$route['company/project-profile-preview'] = 'Home/project_profile_preview';
$route['company/project-team-members'] = 'Home/project_team_members';
$route['company/project-added-valuation'] = 'Home/project_added_valuation';
$route['company/project-financial-year-reports'] = 'Home/project_financial_year_reports';
$route['company/project-cashflow-projection-booking'] = 'Home/project_cashflow_projection_booking';
$route['company/project-bid-over-booking'] = 'Home/project_bid_over_booking';
$route['company/download-project-pdf'] = 'Home/download_project_pdf';
$route['company/project-press-release'] = 'Home/project_press_release';
$route['company/company-press-release'] = 'Home/company_press_release';
$route['company/user-press-release'] = 'Home/user_press_release';
$route['(:any)/press-release/(:any)'] = 'Home/press_release_view';
$route['company/coordinates'] = 'Home/coordinates';
$route['company/event-management'] = 'Home/event_management';



// CHAT MODULE
// $route['company/chat'] = 'ChatController/index';
$route['company/chat/chat_with_user'] = 'ChatController/chat_with_user';
$route['company/chat/get_chat_users'] = 'ChatController/get_chat_users';




$route['company/setting'] = 'Home/setting';
$route['company/version-delivered'] = 'Home/version_delivered';
$route['company/timestamps'] = 'Home/timestamps';
$route['privacy-policy'] = 'Home/privacy_policy';
$route['disclaimer'] = 'Home/disclaimer';
$route['terms-condition'] = 'Home/terms_condition';
$route['refund'] = 'Home/refund';
$route['contact-us'] = 'Home/contact_us';
$route['company/request-panel'] = 'Home/request_panel';
$route['company/market-place'] = 'Home/market_place';
$route['company/channel-sharing'] = 'Home/channel_sharing';
$route['company/profile_preview'] = 'Home/user_preview';
$route['company/user-profile-resume'] = 'Home/UserProfileResume';
$route['company/add_networth'] = 'Home/add_networth';
$route['company/user_kyc'] = 'Home/user_kyc';
$route['company/brickMarkasCompleted'] = 'Home/brickMarkasCompleted';
$route['company/get_all_make_my_books'] = 'Home/getAllMakeMyBooks';
$route['company/tree-making-search-filter'] = 'Home/tree_making_search_filter';
$route['company/create_brick_tree'] = 'Home/create_brick_tree';
$route['company/get_bricks_by_book_id'] = 'Home/getBricksByBookId';


$route['company/market-tracing'] = 'Home/marketTracing';
$route['company/trash'] = 'Home/trash';



$route['company/tree-making'] = 'Home/TreeMaking';
$route['company/create_my_book_name'] = 'Home/create_myBookName';


$route['company/create_my_movie_name'] = 'Home/create_MyMovieName';
$route['company/get_all_make_my_movies'] = 'Home/getAllMakeMyMovies';
$route['company/get_events_by_movie_id'] = 'Home/getEventsByMovieId';
$route['company/create_event_tree'] = 'Home/create_event_tree';






$route['company/idea'] = 'Home/IdeaPay';
$route['company/idea-trash'] = 'Home/IdeaPayTrash';
$route['company/ideapay-restore'] = 'Home/ideaPay_restore';
$route['company/ideapay-delete'] = 'Home/ideaPay_Delete';

$route['company/ip-and-tech-transfer'] = 'Home/IpAndTechTransfer';
$route['company/ip-tech-transfer-trash'] = 'Home/ipTechTransfer_trash';
$route['company/ip-tech-transfer-restore'] = 'Home/ipTechTransfer_restore';
$route['company/ip-tech-transfer-delete'] = 'Home/ipTechTransfer_Delete';


$route['company/buyrent'] = 'Home/BuyRent';
$route['company/artifical-family'] = 'Home/ArtificalFamily';
$route['company/trlphdpostdoc'] = 'Home/trlphdpostdoc';

$route['company/trlphdpostdoc-trash'] = 'Home/trlphdpostdoc_trash';
$route['company/trlphdpostdoc-restore'] = 'Home/trlphdpostdoc_restore';
$route['company/trlphdpostdoc-delete'] = 'Home/trlphdpostdocDelete';
// FORM 2 SUBMISSION
$route['company/trllevelspost'] = 'Home/trllevelsPost';
$route['company/trllevels-trash'] = 'Home/trllevelsTrash';
$route['company/trllevels-restore'] = 'Home/trllevelsRestore';
$route['company/trllevels-delete'] = 'Home/trllevelsDelete';
$route['company/trllevel-edit'] = 'Home/trllevelEdit';
$route['company/trllevelsupdate'] = 'Home/trllevelsUpdate';






// MY CALENDAR FUNCTIONALITY
$route['calendar'] = 'calendar/index';
$route['calendar/data-feeding-panel'] = 'calendar/data_feeding_panel';
$route['calendar/data-feeding-panel-future'] = 'calendar/data_feeding_panel_future';
$route['calendar/events'] = 'calendar/events';
$route['calendar/create_events_tree'] = 'calendar/create_events_tree';
// $route['calendar/create'] = 'calendar/create';
// $route['calendar/update/(:num)'] = 'calendar/update/$1';
// $route['calendar/delete/(:num)'] = 'calendar/delete/$1';



$route['notification'] = 'Home/notification';
$route['wallet'] = 'Home/wallet';
$route['active_bids'] = 'Home/active_bids';
$route['manage_tasks'] = 'Home/manage_tasks';
$route['manage_bidders'] = 'Home/manage_bidders';
$route['manage-tasks'] = 'Home/manage_tasks';
$route['manage-bidders'] = 'Home/manage_bidders';
$route['active-bids'] = 'Home/active_bids';
$route['post-task'] = 'Home/post_task';

// GOOGLE CALENDAR API
$route['company/my-calendar'] = 'GoogleCalendar';
$route['company/oauth'] = 'GoogleCalendar/oauth';
$route['calendar/create_brick'] = 'GoogleCalendar/CreateCalendarBrick';

// -------------Freelancer Dashboard -----------
$route['frelancer/registration'] = 'Freelancer/registration';
$route['applied_task'] = 'Freelancer/applied_task';
$route['available_task'] = 'Freelancer/available_task';
$route['freelancer/dashboard'] = 'Freelancer/dashboard';
$route['freelancer_login'] = 'Freelancer/freelancer_login';
$route['my_wallet'] = 'Freelancer/my_wallet';
$route['freelancer_notification'] = 'Freelancer/freelancer_notification';




// ================== Admin Dashboard =====================

$route['admin'] = 'AdminAuth/admin';
$route['admin/dashboard'] = 'AdminHome/dashboard';
$route['admin/logout'] = 'AdminAuth/adminLogout';


$route['admin/project-creators'] = 'AdminHome/projectCreators';
$route['admin/project-consultant'] = 'AdminHome/projectConsultant';
$route['admin/user-kyc'] = 'AdminHome/userKyc';
$route['admin/user_kycStatusUpdate'] = 'AdminHome/user_kycStatusUpdate';
$route['admin/deleteFreelancerUser'] = 'AdminHome/deleteFreelancerUser';
$route['admin/police-court'] = 'AdminHome/police_court';
$route['admin/map'] = 'AdminHome/map';
$route['admin/school'] = 'AdminHome/school';
$route['admin/school/(:any)'] = 'AdminHome/school/$1';
$route['admin/school/(:any)/(:any)'] = 'AdminHome/school/$1/$2';
$route['admin/science/chemistry/element/(:any)'] = 'AdminHome/element/$1';
$route['admin/degree/(:any)'] = 'AdminHome/degree/$1';
$route['admin/industries/department'] = 'AdminHome/department';
$route['admin/market-research'] = 'AdminHome/market_research';
$route['admin/reverse-process'] = 'AdminHome/reverse_process';
$route['admin/total-projects'] = 'AdminHome/total_projects';
$route['admin/celebrity-management'] = 'AdminHome/celebrity_management';
$route['admin/event-management'] = 'AdminHome/event_management';
$route['admin/data-feeding-panel'] = 'AdminHome/data_feeding_panel';


// @ Shiv Web Developer
