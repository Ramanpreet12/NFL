<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'route_name' => 'admin/dashboard',
                'params' =>''
            ],

            'user' => [
                'icon' => 'users',
                'route_name' => 'admin/user',
                'params' => '',
                'title' => 'Users'
            ],
            // 'player' => [
            //     'icon' => 'users',
            //     'route_name' => 'admin/players',
            //     'params' => '',
            //     'title' => 'Players'
            // ],



            'winner' => [
                'icon' => 'star',
                'route_name' => 'winner.index',
                'params' => '',
                'title' => 'Winner'
            ],

            'team' => [
                'icon' => 'users',
                'route_name' => 'team.index',
                'params' => '',
                // [
                //     'layout' => 'side-menu'
                // ],
                'title' => 'Team'
            ],
            'payment' => [
                'icon' => 'dollar-sign',
                'route_name' => 'admin/payments',
                'params' => '',
                // [
                //     'layout' => 'side-menu'
                // ],
                'title' => 'Payments'
            ],
            'season' => [
                'icon' => 'cloud',
                'route_name' => 'season.index',
                'params' => '',
                // [
                //     'layout' => 'side-menu'
                // ],
                'title' => 'Season Management'
            ],
            'fixtures' => [
                'icon' => 'calendar',
                'route_name' => 'fixtures.index',
                'params' => '',
                'title' => 'Fixtures'
            ],

            'team_result' => [
                'icon' => 'settings',
                'route_name' => 'admin/teams/result',
                'params' => '',
                'title' => 'Teams Result'
            ],
            // 'score_board' => [
            //     'icon' => 'clipboard',
            //     'route_name' => 'admin/scores',
            //     'params' => '',
            //     'title' => 'Scores'
            // ],





            'contact' => [
                'icon' => 'phone',
                'route_name' => 'contact.index',
                'params' => '',
                // [
                //     'layout' => 'side-menu'
                // ],
                'title' => 'Contacts'
            ],




            'setting' => [
                'icon' => 'settings',
                'route_name' => 'admin/profile',
                'params' => '',
                'title' => 'Setting'
            ],

            // 'website-setting' => [
            //     'icon' => 'settings',
            //     'route_name' => 'admin/general',
            //     'params' => '',
            //     'title' => 'General'
            // ],

            'reviews' => [
                'icon' => 'star',
                'route_name' => 'reviews.index',
                'params' => '',
                // [
                //     'layout' => 'side-menu'
                // ],
                'title' => 'Reviews'
            ],

             'devider',
            'site_setting' => [
                'icon' => 'edit',
                'title' => 'Site Setting',
                'sub_menu' => [
                    'menu-setting' => [
                        'icon' => 'settings',
                        'route_name' => 'menu.index',
                        //'params' => 'section=news_section',
                        'params' => '',
                        'title' => 'Menu Setting'
                    ],

                    'general' => [
                        'icon' => '',
                        'route_name' => 'admin/general',
                        'params' =>'',
                        'title' => 'General'
                    ],
                    'banner' => [
                        'icon' => '',
                        'route_name' => 'banner.index',
                        'params' =>'',
                        'title' => 'Banner'
                    ],


                    'region' => [
                        'icon' => 'settings',
                        'route_name' => 'region.index',
                        'params' => '',
                        'title' => 'Region'
                    ],

                    // 'leaderboard' => [
                    //     'icon' => 'settings',
                    //     'route_name' => 'admin/leaderboard',
                    //     'params' => '',
                    //     'title' => 'Leaderboard'
                    // ],



                    'color-setting' => [
                        'icon' => 'settings',
                        'route_name' => 'admin/color_setting',
                        'params' => '',
                        'title' => 'Color Setting'
                    ],
                    'vacationPac' => [
                        'icon' => 'settings',
                        'route_name' => 'vacation.index',
                        'params' => '',
                        'title' => 'Vacation Pac'
                    ],

                    'news' => [
                        'icon' => 'settings',
                        'route_name' => 'news.index',
                        'params' => '',
                        //'params' => '',
                        'title' => 'News'
                    ],



                    // 'video-setting' => [
                    //     'icon' => 'settings',
                    //     'route_name' => 'videoSetting.index',
                    //     //'params' => 'section=news_section',
                    //     'params' => '',
                    //     'title' => 'Videos'
                    // ],

                    'match-result' => [
                        'icon' => '',
                        'route_name' => 'admin/match_result',
                        'params' =>'',
                        'title' => 'Match Result By Region'
                    ],

                    'match-fixture' => [
                        'icon' => '',
                        'route_name' => 'admin/match_fixture',
                        'params' =>'',
                        'title' => 'Match Fixture'
                    ],


                    'prize' => [
                        'icon' => 'award',
                        'route_name' => 'prize.index',
                        'params' => '',
                        // [
                        //     'layout' => 'side-menu'
                        // ],
                        'title' => 'Prize Management'
                    ],

                    'contact-page' => [
                        'icon' => 'phone',
                        'route_name' => 'admin/contact_page',
                        'params' => '',
                        'title' => 'Contact Page'
                    ],

                    'about-page' => [
                        'icon' => 'phone',
                        'route_name' => 'admin/about_page',
                        'params' => '',
                        'title' => 'About Page'
                    ],

                    'news_alert' => [
                        'icon' => 'phone',
                        'route_name' => 'admin/news_alerts',
                        'params' => '',
                        'title' => 'News Alerts'
                    ],


                    'privacy' => [
                        'icon' => 'phone',
                        'route_name' => 'admin/privacy',
                        'params' => '',
                        'title' => 'Privacy'
                    ],



                ]
            ],


        ];
    }
}
