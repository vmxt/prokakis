<?php 
$r = App\User::find(Auth::id());
?>
   <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index.html">
                    <!--    <img src="../assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /> -->
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->

                 <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>


                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">

                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{ asset('public/assets/layouts/layout2/img/avatar.png') }}" />
                                    <span class="username username-hide-on-mobile"> <?php //username ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-default">
                                    <?php if($r->user_type == 5){ ?>
                                    <li>
                                        <a href="{{ route('GetListAccounts') }}">
                                            <i class="icon-user"></i> Accounts Preferences </a>
                                    </li>
                                    <?php } ?>
                                    <li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> Change Password </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-key"></i> Log Out </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                            </form>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->

                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
