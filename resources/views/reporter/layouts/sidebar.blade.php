 <div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.png')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-light.png')}}" alt="" height="24">
                                </span>
                            </a>
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.png')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-dark.png')}}" alt="" height="24">
                                </span>
                            </a>
                        </div>

                        <ul id="side-menu">

                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="#sidebarDashboards" data-bs-toggle="collapse">
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarDashboards">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="index.html" class="tp-link">CRM</a>
                                        </li>
                                        <li>
                                            <a href="analytics.html" class="tp-link">Analytics</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce.html" class="tp-link">eCommerce</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarreport" data-bs-toggle="collapse">
                                    <i data-feather="home"></i>
                                    <span> Sample Test </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarreport">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('reporter.reports') }}" class="tp-link">Sampled Tests</a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarviewrep" data-bs-toggle="collapse">
                                    <i data-feather="home"></i>
                                    <span> Report </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarviewrep">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('reporter.viewreports') }}" class="tp-link">Pending Reports</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reporter.revoked') }}" class="tp-link">Revoked Reports</a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </li>

                        
                            

                            <li class="menu-title mt-2">Apps</li>
                
                            <li>
                                <a href="apps-todolist.html" class="tp-link">
                                    <i data-feather="columns"></i>
                                    <span> Todo List </span>
                                </a>
                            </li>


                        </ul>
            
                    </div>

                    <div class="clearfix"></div>

                </div>
            </div>
