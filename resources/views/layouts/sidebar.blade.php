<?php
$r = App\ConfigurationModel::where('user_id', Auth::id())->first();
echo $r->subscription_startdate;
?>
  <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

                        <li class="nav-item start active open">
                              <a href="{{ route('managesearch') }}" class="nav-link nav-toggle">
                                <i class="fa fa-search-plus"></i>
                                <span class="title">Manage</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>

                        </li>

                      <li class="nav-item start">
                          <?php
                          $usrID = Auth::id();
                          $allKW = App\CommonModel::getAllSearchKeywords($usrID);
                          $sessValue = (session('SELECTED_KW'))? session('SELECTED_KW') : '';
                          //echo $sessValue;
                          ?>
                          <center>
                            <form action="{{ route('SidebarSetSelection') }}" method="POST">
                             @csrf
                              <select id="allKeyWords" name="allKeyWords" class="form-control" onchange="this.form.submit()">
                                <option value=""></option>  
                                <?php foreach($allKW as $m){
                                  if($sessValue == $m){
                                  ?>
                                  <option selected value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                  <?php
                                  } else {
                                  ?>
                                  <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                <?php
                                      }
                                  }  ?>
                               </select>
                           </form>
                          </center>
                      </li>
                      <li class="nav-item start">
                      </li>

                      <li class="nav-item start">
                            <a href="{{ route('dashboard1') }}" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start active open">
                                    <a href="{{ route('dashboard1') }}" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">Dashboard 1 </span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            </ul>
                      </li>

                      <?php if($r->show_mentions == 1){ ?>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-diamond"></i>
                                <span class="title">Mentions</span>
                                <span class="arrow"></span>
                            </a>
                             <ul class="sub-menu">
                                <li class="nav-item start active open">
                                    <a href="{{ url('/mentions-link/tw') }}" class="nav-link ">
                                        <i class="fa fa-twitter"></i>
                                        <span class="title">Twitter <span class="badge badge-success"><?php echo App\TwitterModel::mentionsCount(); ?></span> </span>
                                        <span class="selected"></span>
                                    </a>
                                </li>


                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/fb') }}" class="nav-link ">
                                        <i class="fa fa-facebook"></i>
                                        <span class="title">Facebook <span class="badge badge-success"><?php //echo App\TwitterModel::mentionsCount(); ?></span> </span>

                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/yt') }}" class="nav-link ">
                                        <i class="fa fa-youtube"></i>
                                        <span class="title">Youtube <span class="badge badge-success"><?php echo App\YoutubeModel::mentionsCount(); ?></span> </span>

                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/gp') }}" class="nav-link ">
                                        <i class="fa fa-google-plus-square"></i>
                                        <span class="title">Google Plus <span class="badge badge-success"><?php //echo App\TwitterModel::mentionsCount(); ?></span> </span>

                                    </a>
                                </li>


                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/im') }}" class="nav-link ">
                                        <i class="fa fa-picture-o"></i>
                                        <span class="title">Images <span class="badge badge-success"><?php //echo App\TwitterModel::mentionsCount(); ?></span> </span>

                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/in') }}" class="nav-link ">
                                        <i class="fa fa-instagram"></i>
                                        <span class="title">Instagram <span class="badge badge-success"><?php //echo App\TwitterModel::mentionsCount(); ?></span> </span>

                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/nb') }}" class="nav-link ">
                                        <i class="fa fa-newspaper-o"></i>
                                        <span class="title">News & Blogs <span class="badge badge-success"><?php //echo App\TwitterModel::mentionsCount(); ?></span></span>

                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/we') }}" class="nav-link ">
                                        <i class="fa fa-globe"></i>
                                        <span class="title">The Web <span class="badge badge-success"><?php echo App\GoogleModel::mentionsCount(); ?></span></span>

                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/gp') }}" class="nav-link ">
                                        <i class="fa fa-weibo"></i>
                                        <span class="title">Weibo <span class="badge badge-success"><?php //echo App\GoogleModel::mentionsCount(); ?></span></span>

                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ url('/mentions-link/gp') }}" class="nav-link ">
                                        <i class="fa fa-bitcoin"></i>
                                        <span class="title">Baidu <span class="badge badge-success"><?php ///echo App\GoogleModel::mentionsCount(); ?></span></span>

                                    </a>
                                </li>

                            </ul>

                        </li>
                        <?php } ?>

                        <?php if($r->show_topics == 1){ ?>
                        <li class="nav-item  ">
                            <a href="{{ route('topics') }}" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Topics</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php if($r->show_ialerts == 1){ ?>
                        <li class="nav-item  ">
                            <a href="{{ route('ialerts') }}" class="nav-link nav-toggle">
                                <i class="fa fa-bell-o"></i>
                                <span class="title">iAlerts</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php if($r->show_reports == 1){ ?>
                        <li class="nav-item  ">
                            <a href="{{ route('reports') }}" class="nav-link nav-toggle">
                                <i class="icon-bulb"></i>
                                <span class="title">Reports</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <?php } ?>

                         <?php if($r->show_influencers == 1){ ?>
                        <li class="nav-item  ">
                            <a href="{{ route('influencers') }}" class="nav-link nav-toggle">
                                <i class="icon-briefcase"></i>
                                <span class="title">Influencers</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <?php } ?>

                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
