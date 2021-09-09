@extends('layouts.app')

@section('nav')
<div class="page-wrapper-top">
    <!-- BEGIN HEADER -->
    <div class="page-header">
        <!-- BEGIN HEADER TOP -->
        <div class="page-header-top">
            <div class="container">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index.html">
                        <img src="../assets/layouts/layout3/img/logo-default.jpg" alt="logo" class="logo-default">
                    </a>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler"></a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->

                        <!-- BEGIN INBOX DROPDOWN -->
                        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="circle">3</span>
                                <span class="corner"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>You have
                                        <strong>7 New</strong> Messages</h3>
                                    <a href="app_inbox.html">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                                    <span class="from"> Lisa Wong </span>
                                                                    <span class="time">Just Now </span>
                                                                </span>
                                                <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                                    <span class="from"> Richard Doe </span>
                                                                    <span class="time">16 mins </span>
                                                                </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                                    <span class="from"> Bob Nilson </span>
                                                                    <span class="time">2 hrs </span>
                                                                </span>
                                                <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                                    <span class="from"> Lisa Wong </span>
                                                                    <span class="time">40 mins </span>
                                                                </span>
                                                <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                                    <span class="from"> Richard Doe </span>
                                                                    <span class="time">46 mins </span>
                                                                </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="../assets/layouts/layout3/img/avatar9.jpg">
                                <span class="username username-hide-mobile">Nick</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>

                                    <a href="page_user_profile_1.html">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="app_calendar.html">
                                        <i class="icon-calendar"></i> My Calendar </a>
                                </li>
                                <li>
                                    <a href="app_inbox.html">
                                        <i class="icon-envelope-open"></i> My Inbox
                                        <span class="badge badge-danger"> 3 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="app_todo_2.html">
                                        <i class="icon-rocket"></i> My Tasks
                                        <span class="badge badge-success"> 7 </span>
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="page_user_lock_1.html">
                                        <i class="icon-lock"></i> Lock Screen </a>
                                </li>
                                <li>
                                    <a href="page_user_login_1.html">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->

                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
        </div>
        <!-- END HEADER TOP -->
        <!-- BEGIN HEADER MENU -->
        <div class="page-header-menu">
            <div class="container">
                <!-- BEGIN HEADER SEARCH BOX -->
                <form class="search-form" action="page_general_search.html" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="query">
                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                    </div>
                </form>




            <?php
            $activeDashboard     = '';
            $activeProfile       = '';
            $activeOpportunity   = '';
            $activeReport        = '';
            $activeMail          = '';
            $activeSettings      = '';
            $activeConsultant    = '';


            if(route('home') == Request::url()
                || route('businessnewsIndex') == Request::url()) {
                $activeDashboard = 'active';
            }
            if(route('viewingProfile') == Request::url()
                || route('indexContacts') == Request::url()
                || route('indexBilling') == Request::url()
                || route('indexPaymentHistory') == Request::url()
                || route('indexSocialAccounts') == Request::url()
                || route('deactivateAccountPage') == Request::url()
                || route('editProfile') == Request::url()
            ) {
                $activeProfile = 'active';
            }
            if(route('opportunityIndex') == Request::url()
                || route('opportunityExploreIndex') == Request::url()
            ) {
                $activeOpportunity = 'active';
            }
            if(route('reportIndex') == Request::url()) {
                $activeReport = 'active';
            }
            if(route('mailCompose') == Request::url()) {
                $activeMail = 'active';
            }
            if(route('sysIndex') == Request::url()
                || route('assignConsultants') == Request::url() ) {
                $activeSettings = 'active';
            }
            if(route('indexConsultantFAreport') == Request::url()) {
                $activeConsultant = 'active';
            }


            ?>



            <!-- END HEADER SEARCH BOX -->
                <!-- BEGIN MEGA MENU -->
                <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                <div class="hor-menu  ">
                    <ul class="nav navbar-nav">
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown active">

                            @guest
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    {{ config('app.name', 'Intellinz') }}
                                    <span class="arrow"></span>
                                </a>
                            @else
                                <a href="{{ url('/') }}">
                                    {{ config('app.name', 'Intellinz') }}
                                    <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li aria-haspopup="true" class=" active">
                                        <a href="index.html" class="nav-link  active">
                                            <i class="icon-bar-chart"></i> Dashboard
                                            <span class="badge badge-success">1</span>
                                        </a>
                                    </li>
                                    <li aria-haspopup="true" class=" ">
                                        <a href="dashboard_2.html" class="nav-link  ">
                                            <i class="icon-bulb"></i> Opportunities and News</a>
                                    </li>
                                </ul>
                        </li>
                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown  ">


                            <a class="<?php echo $activeProfile; ?>" href="{{ url('/profile/view') }}" style="color:white;">
                                Profile  <span class="arrow"></span>
                            </a>
                            <ul class="dropdown-menu pull-left">
                                <li aria-haspopup="true" class=" ">
                                    <a class="nav-link <?php echo $activeProfile; ?>" href="{{ url('/profile/view') }}"> View Profile</a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_mega_menu_light.html" class="nav-link  "> Contacts </a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_top_bar_light.html" class="nav-link  "> Billing</a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_fluid_page.html" class="nav-link  "> Payments History</a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_fluid_page.html" class="nav-link  "> Social Media Accounts</a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_fluid_page.html" class="nav-link  "> Deactivate Profile</a>
                                </li>
                            </ul>
                        </li>
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">

                            <a class="<?php echo $activeOpportunity; ?>" href="{{ url('/opportunity') }}" >
                                Opportunities
                                <span class="arrow"></span>
                            </a>

                            <ul class="dropdown-menu pull-left">
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_mega_menu_light.html" class="nav-link  "> My Opportunities </a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_top_bar_light.html" class="nav-link  "> Explore</a>
                                </li>
                            </ul>

                        </li>
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">


                            <a class="<?php echo $activeReport; ?>" href="{{ url('/reports') }}">
                                Report
                                <span class="arrow"></span>
                            </a>

                            <ul class="dropdown-menu pull-left">
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_mega_menu_light.html" class="nav-link  "> Report </a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_top_bar_light.html" class="nav-link  "> Ongoing Monitoring </a>
                                </li>
                                <li aria-haspopup="true" class=" ">
                                    <a href="layout_fluid_page.html" class="nav-link  "> Buy Tokens</a>
                                </li>
                            </ul>
                        </li>
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                            <a class="<?php echo $activeMail; ?>" href="{{ route('mailCompose') }}">
                                Mailbox
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                            <a class="<?php echo $activeConsultant; ?>" href="{{ url('/consultants') }}">
                                Consultant
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                            <a class="<?php echo $activeSettings; ?>" href="{{ url('/sysconfig') }}">
                                Settings
                            </a>
                        </li>
                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                            <a href="{{ url('/logout') }}" > <!-- I omit the float right style -->
                                Logout
                                <span class="arrow"></span>
                            </a>
                        </li>
                        @endguest
                    </ul>
                </div>
                <!-- END MEGA MENU -->
            </div>
        </div>
        <!-- END HEADER MENU -->

    </div>
    <!-- END HEADER -->
</div>
@endsection