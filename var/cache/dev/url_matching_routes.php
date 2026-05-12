<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/chatbot/query' => [[['_route' => 'admin_chatbot_query', '_controller' => 'App\\Controller\\Admin\\ChatBotController::query'], null, ['POST' => 0], null, false, false, null]],
        '/api/discussions' => [
            [['_route' => 'app_api_forumapi_listdiscussions', '_controller' => 'App\\Controller\\Api\\ForumApiController::listDiscussions'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_api_forumapi_creatediscussion', '_controller' => 'App\\Controller\\Api\\ForumApiController::createDiscussion'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/messages' => [[['_route' => 'app_api_forumapi_createmessage', '_controller' => 'App\\Controller\\Api\\ForumApiController::createMessage'], null, ['POST' => 0], null, false, false, null]],
        '/api/notifications' => [[['_route' => 'app_api_notificationapi_listnotifications', '_controller' => 'App\\Controller\\Api\\NotificationApiController::listNotifications'], null, ['GET' => 0], null, false, false, null]],
        '/api/notifications/unread' => [[['_route' => 'app_api_notificationapi_listunreadnotifications', '_controller' => 'App\\Controller\\Api\\NotificationApiController::listUnreadNotifications'], null, ['GET' => 0], null, false, false, null]],
        '/api/notifications/mark-all-read' => [[['_route' => 'app_api_notificationapi_markallasread', '_controller' => 'App\\Controller\\Api\\NotificationApiController::markAllAsRead'], null, ['PUT' => 0], null, false, false, null]],
        '/api/reports' => [
            [['_route' => 'app_api_reportapi_listreports', '_controller' => 'App\\Controller\\Api\\ReportApiController::listReports'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_api_reportapi_createreport', '_controller' => 'App\\Controller\\Api\\ReportApiController::createReport'], null, ['POST' => 0], null, false, false, null],
        ],
        '/dashboard' => [[['_route' => 'dashboard_index', '_controller' => 'App\\Controller\\DashboardController::dashboardIndex'], null, null, null, false, false, null]],
        '/dashboard/users/add' => [
            [['_route' => 'dashboard_users_add', '_controller' => 'App\\Controller\\DashboardController::usersAdd'], null, null, null, false, false, null],
            [['_route' => 'user_add', '_controller' => 'App\\Controller\\DashboardController::userAdd'], null, null, null, false, false, null],
        ],
        '/dashboard/users/create' => [[['_route' => 'dashboard_users_create', '_controller' => 'App\\Controller\\DashboardController::createUser'], null, ['POST' => 0], null, false, false, null]],
        '/dashboard/widgets/data' => [[['_route' => 'dashboard_widgets_data', '_controller' => 'App\\Controller\\DashboardController::widgetsData'], null, null, null, false, false, null]],
        '/dashboard/widgets/static' => [[['_route' => 'dashboard_widgets_static', '_controller' => 'App\\Controller\\DashboardController::widgetsStatic'], null, null, null, false, false, null]],
        '/dashboard/add/quizz' => [[['_route' => 'add_quizz', '_controller' => 'App\\Controller\\DashboardController::addQuizz'], null, null, null, false, false, null]],
        '/dashboard/add/course' => [[['_route' => 'add_course', '_controller' => 'App\\Controller\\DashboardController::addCourse'], null, null, null, false, false, null]],
        '/dashboard/add/event' => [[['_route' => 'add_event', '_controller' => 'App\\Controller\\DashboardController::addEvent'], null, null, null, false, false, null]],
        '/dashboard/add/post' => [[['_route' => 'add_post', '_controller' => 'App\\Controller\\DashboardController::addPost'], null, null, null, false, false, null]],
        '/dashboard/orders' => [[['_route' => 'ecommerce_orders', '_controller' => 'App\\Controller\\DashboardController::orders'], null, null, null, false, false, null]],
        '/dashboard/users/datatable' => [[['_route' => 'user_datatable', '_controller' => 'App\\Controller\\DashboardController::userDatatable'], null, null, null, false, false, null]],
        '/dashboard/events/datatable' => [[['_route' => 'event_datatable', '_controller' => 'App\\Controller\\DashboardController::eventDatatable'], null, null, null, false, false, null]],
        '/dashboard/feeds/datatable' => [[['_route' => 'feed_datatable', '_controller' => 'App\\Controller\\DashboardController::feedDatatable'], null, null, null, false, false, null]],
        '/dashboard/courses/datatable' => [[['_route' => 'course_datatable', '_controller' => 'App\\Controller\\DashboardController::courseDatatable'], null, null, null, false, false, null]],
        '/dashboard/quizzes/datatable' => [[['_route' => 'quizz_datatable', '_controller' => 'App\\Controller\\DashboardController::quizzDatatable'], null, null, null, false, false, null]],
        '/dashboard/reclamations/datatable' => [[['_route' => 'reclamation_datatable', '_controller' => 'App\\Controller\\DashboardController::reclamationDatatable'], null, null, null, false, false, null]],
        '/dashboard/charts/apex' => [[['_route' => 'charts_apex_chart', '_controller' => 'App\\Controller\\DashboardController::chartsApex'], null, null, null, false, false, null]],
        '/dashboard/charts/chartjs' => [[['_route' => 'charts_chartjs', '_controller' => 'App\\Controller\\DashboardController::chartsChartjs'], null, null, null, false, false, null]],
        '/dashboard/maps/google' => [[['_route' => 'map_google_maps', '_controller' => 'App\\Controller\\DashboardController::mapGoogle'], null, null, null, false, false, null]],
        '/dashboard/maps/vector' => [[['_route' => 'map_vector_maps', '_controller' => 'App\\Controller\\DashboardController::mapVector'], null, null, null, false, false, null]],
        '/admin/dashboard' => [[['_route' => 'admin_dashboard', '_controller' => 'App\\Controller\\DashboardController::adminDashboard'], null, null, null, false, false, null]],
        '/admin/users' => [[['_route' => 'admin_users', '_controller' => 'App\\Controller\\DashboardController::adminUsers'], null, null, null, false, false, null]],
        '/admin/users/add' => [[['_route' => 'admin_users_add', '_controller' => 'App\\Controller\\DashboardController::addUser'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/debug/roles' => [[['_route' => 'debug_roles', '_controller' => 'App\\Controller\\DashboardController::debugRoles'], null, null, null, false, false, null]],
        '/dashboard/users/roles' => [[['_route' => 'user_roles', '_controller' => 'App\\Controller\\DashboardController::userRoles'], null, null, null, false, false, null]],
        '/dashboard/courses/categories' => [[['_route' => 'course_categories', '_controller' => 'App\\Controller\\DashboardController::courseCategories'], null, null, null, false, false, null]],
        '/dashboard/quizzes/results' => [[['_route' => 'quizz_results', '_controller' => 'App\\Controller\\DashboardController::quizzResults'], null, null, null, false, false, null]],
        '/dashboard/support/tickets' => [[['_route' => 'support_tickets', '_controller' => 'App\\Controller\\DashboardController::supportTickets'], null, null, null, false, false, null]],
        '/dashboard/support/faq' => [[['_route' => 'faq_management', '_controller' => 'App\\Controller\\DashboardController::faqManagement'], null, null, null, false, false, null]],
        '/dashboard/reports/sales' => [[['_route' => 'reports_sales', '_controller' => 'App\\Controller\\DashboardController::reportsSales'], null, null, null, false, false, null]],
        '/dashboard/reports/users' => [[['_route' => 'reports_users', '_controller' => 'App\\Controller\\DashboardController::reportsUsers'], null, null, null, false, false, null]],
        '/dashboard/reports/courses' => [[['_route' => 'reports_courses', '_controller' => 'App\\Controller\\DashboardController::reportsCourses'], null, null, null, false, false, null]],
        '/dashboard/settings/general' => [[['_route' => 'settings_general', '_controller' => 'App\\Controller\\DashboardController::settingsGeneral'], null, null, null, false, false, null]],
        '/dashboard/settings/security' => [[['_route' => 'settings_security', '_controller' => 'App\\Controller\\DashboardController::settingsSecurity'], null, null, null, false, false, null]],
        '/dashboard/settings/notifications' => [[['_route' => 'settings_notifications', '_controller' => 'App\\Controller\\DashboardController::settingsNotifications'], null, null, null, false, false, null]],
        '/dashboard/settings/theme' => [[['_route' => 'settings_theme', '_controller' => 'App\\Controller\\DashboardController::settingsTheme'], null, null, null, false, false, null]],
        '/dashboard/products' => [[['_route' => 'ecommerce_products', '_controller' => 'App\\Controller\\DashboardController::ecommerceProducts'], null, null, null, false, false, null]],
        '/dashboard/customers' => [[['_route' => 'dashboard_customers', '_controller' => 'App\\Controller\\DashboardController::ecommerceCustomers'], null, null, null, false, false, null]],
        '/forum' => [[['_route' => 'forum_index', '_controller' => 'App\\Controller\\ForumController::index'], null, null, null, true, false, null]],
        '/forum/new' => [[['_route' => 'forum_new_discussion', '_controller' => 'App\\Controller\\ForumController::newDiscussion'], null, null, null, false, false, null]],
        '/forum/search' => [[['_route' => 'forum_search', '_controller' => 'App\\Controller\\ForumController::search'], null, null, null, false, false, null]],
        '/connect/google' => [[['_route' => 'connect_google', '_controller' => 'App\\Controller\\OAuthController::connect'], null, null, null, false, false, null]],
        '/connect/google/check' => [[['_route' => 'connect_google_check', '_controller' => 'App\\Controller\\OAuthController::connectCheck'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_homepage', '_controller' => 'App\\Controller\\PageController::index'], null, null, null, false, false, null]],
        '/profile' => [[['_route' => 'app_profile', '_controller' => 'App\\Controller\\ProfileController::index'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/forgot-password' => [[['_route' => 'app_forgot_password', '_controller' => 'App\\Controller\\SecurityController::forgotPassword'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\SecurityController::register'], null, null, null, false, false, null]],
        '/app/emailbox' => [[['_route' => 'app_emailbox', '_controller' => 'App\\Controller\\SecurityController::emailbox'], null, null, null, false, false, null]],
        '/app/emailread' => [[['_route' => 'app_emailread', '_controller' => 'App\\Controller\\SecurityController::emailread'], null, null, null, false, false, null]],
        '/app/chat_box' => [[['_route' => 'app_chat_box', '_controller' => 'App\\Controller\\SecurityController::chatBox'], null, null, null, false, false, null]],
        '/test-login-page' => [[['_route' => 'test_login_page', '_controller' => 'App\\Controller\\TestController::testLogin'], null, null, null, false, false, null]],
        '/create-admin' => [[['_route' => 'app_create_admin', '_controller' => 'App\\Controller\\SecurityController::createAdmin'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/a(?'
                    .'|pi/(?'
                        .'|discussions/([^/]++)(?'
                            .'|(*:236)'
                            .'|/(?'
                                .'|pin(*:251)'
                                .'|solve(*:264)'
                                .'|lock(*:276)'
                                .'|messages(*:292)'
                            .')'
                        .')'
                        .'|messages/([^/]++)(?'
                            .'|(*:322)'
                            .'|/vote(*:335)'
                        .')'
                        .'|notifications/(?'
                            .'|([^/]++)(?'
                                .'|/read(*:377)'
                                .'|(*:385)'
                            .')'
                            .'|count(*:399)'
                        .')'
                        .'|reports/([^/]++)/status(*:431)'
                    .')'
                    .'|dmin/users/edit/([^/]++)(*:464)'
                .')'
                .'|/dashboard/users/(?'
                    .'|update/([^/]++)(*:508)'
                    .'|delete/([^/]++)(*:531)'
                .')'
                .'|/forum/(?'
                    .'|category/([^/]++)(*:567)'
                    .'|discussion/([^/]++)(?'
                        .'|(*:597)'
                        .'|/(?'
                            .'|edit(*:613)'
                            .'|delete(*:627)'
                            .'|vote/([^/]++)(*:648)'
                        .')'
                    .')'
                    .'|message/([^/]++)/(?'
                        .'|edit(*:682)'
                        .'|delete(*:696)'
                        .'|reply(*:709)'
                    .')'
                    .'|vote/([^/]++)/([^/]++)(*:740)'
                .')'
                .'|/reset\\-password/([^/]++)(*:774)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        236 => [
            [['_route' => 'app_api_forumapi_getdiscussion', '_controller' => 'App\\Controller\\Api\\ForumApiController::getDiscussion'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'app_api_forumapi_updatediscussion', '_controller' => 'App\\Controller\\Api\\ForumApiController::updateDiscussion'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_api_forumapi_deletediscussion', '_controller' => 'App\\Controller\\Api\\ForumApiController::deleteDiscussion'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        251 => [[['_route' => 'app_api_forumapi_pindiscussion', '_controller' => 'App\\Controller\\Api\\ForumApiController::pinDiscussion'], ['id'], ['POST' => 0], null, false, false, null]],
        264 => [[['_route' => 'app_api_forumapi_solvediscussion', '_controller' => 'App\\Controller\\Api\\ForumApiController::solveDiscussion'], ['id'], ['POST' => 0], null, false, false, null]],
        276 => [[['_route' => 'app_api_forumapi_lockdiscussion', '_controller' => 'App\\Controller\\Api\\ForumApiController::lockDiscussion'], ['id'], ['POST' => 0], null, false, false, null]],
        292 => [[['_route' => 'app_api_forumapi_listmessages', '_controller' => 'App\\Controller\\Api\\ForumApiController::listMessages'], ['id'], ['GET' => 0], null, false, false, null]],
        322 => [
            [['_route' => 'app_api_forumapi_updatemessage', '_controller' => 'App\\Controller\\Api\\ForumApiController::updateMessage'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_api_forumapi_deletemessage', '_controller' => 'App\\Controller\\Api\\ForumApiController::deleteMessage'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        335 => [[['_route' => 'app_api_forumapi_votemessage', '_controller' => 'App\\Controller\\Api\\ForumApiController::voteMessage'], ['id'], ['POST' => 0], null, false, false, null]],
        377 => [[['_route' => 'app_api_notificationapi_markasread', '_controller' => 'App\\Controller\\Api\\NotificationApiController::markAsRead'], ['id'], ['PUT' => 0], null, false, false, null]],
        385 => [[['_route' => 'app_api_notificationapi_deletenotification', '_controller' => 'App\\Controller\\Api\\NotificationApiController::deleteNotification'], ['id'], ['DELETE' => 0], null, false, true, null]],
        399 => [[['_route' => 'app_api_notificationapi_getunreadcount', '_controller' => 'App\\Controller\\Api\\NotificationApiController::getUnreadCount'], [], ['GET' => 0], null, false, false, null]],
        431 => [[['_route' => 'app_api_reportapi_updatereportstatus', '_controller' => 'App\\Controller\\Api\\ReportApiController::updateReportStatus'], ['id'], ['PUT' => 0], null, false, false, null]],
        464 => [[['_route' => 'admin_users_edit', '_controller' => 'App\\Controller\\DashboardController::editUser'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        508 => [[['_route' => 'dashboard_users_update', '_controller' => 'App\\Controller\\DashboardController::updateUser'], ['id'], ['POST' => 0], null, false, true, null]],
        531 => [[['_route' => 'dashboard_users_delete', '_controller' => 'App\\Controller\\DashboardController::deleteUser'], ['id'], ['POST' => 0], null, false, true, null]],
        567 => [[['_route' => 'forum_category', '_controller' => 'App\\Controller\\ForumController::category'], ['id'], null, null, false, true, null]],
        597 => [[['_route' => 'forum_discussion', '_controller' => 'App\\Controller\\ForumController::discussion'], ['id'], null, null, false, true, null]],
        613 => [[['_route' => 'forum_edit_discussion', '_controller' => 'App\\Controller\\ForumController::editDiscussion'], ['id'], null, null, false, false, null]],
        627 => [[['_route' => 'forum_delete_discussion', '_controller' => 'App\\Controller\\ForumController::deleteDiscussion'], ['id'], ['POST' => 0], null, false, false, null]],
        648 => [[['_route' => 'forum_discussion_vote', '_controller' => 'App\\Controller\\ForumController::voteDiscussion'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        682 => [[['_route' => 'forum_edit_message', '_controller' => 'App\\Controller\\ForumController::editMessage'], ['id'], null, null, false, false, null]],
        696 => [[['_route' => 'forum_delete_message', '_controller' => 'App\\Controller\\ForumController::deleteMessage'], ['id'], ['POST' => 0], null, false, false, null]],
        709 => [[['_route' => 'forum_reply_message', '_controller' => 'App\\Controller\\ForumController::replyToMessage'], ['id'], ['POST' => 0], null, false, false, null]],
        740 => [[['_route' => 'forum_vote', '_controller' => 'App\\Controller\\ForumController::voteMessage'], ['type', 'id'], ['POST' => 0], null, false, true, null]],
        774 => [
            [['_route' => 'app_reset_password', '_controller' => 'App\\Controller\\SecurityController::resetPassword'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
