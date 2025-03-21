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

                            <li class="menu-title">Pages</li>

                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> User Management </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{route('admin.users.create')}}" class="tp-link">Add Users</a>
                                        </li>
                            
                                        <li>
                                            <a href="{{route('admin.users.index')}}" class="tp-link">Users List</a>
                                        </li>
                            
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarLc" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> Loyalty Card </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarLc">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{route('admin.lc.pending')}}" class="tp-link">Pending LC Users</a>
                                        </li>
                            
                                        <li>
                                            <a href="{{route('admin.lc.aloted')}}" class="tp-link">Aloted LC users</a>
                                        </li>
                            
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>External Panel</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarpanal">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.external.add') }}" class="tp-link">Add Panel</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.external.view') }}" class="tp-link">View Panel</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li>
                                <a href="#sidestafpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Staff Panel</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidestafpanal">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.staff.add') }}" class="tp-link">Add Panel</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.staff.view') }}" class="tp-link">View Panel</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="#sidetestpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Test</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidetestpanal">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.test.create') }}" class="tp-link">Add Test</a>
                                        </li>
                                       
                                        <li>
                                            <a href="{{ route('admin.test.index') }}" class="tp-link">View Test</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidetestcatpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Test Category</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidetestcatpanal">
                                    <ul class="nav-second-level">
                                     
                                        <li>
                                            <a href="{{ route('admin.testcategory.create') }}" class="tp-link">Add Test Category</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.testcategory.index') }}" class="tp-link">View Test Category</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidetestranpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Test Ranges</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidetestranpanal">
                                    <ul class="nav-second-level">
                                     
                                  
                                        <li>
                                            <a href="{{ route('admin.testrange.create') }}" class="tp-link">Add Test Ranges</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.testrange.index') }}" class="tp-link">View Test Ranges</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidetestrefpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Referral</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidetestrefpanal">
                                    <ul class="nav-second-level">
                                     
                                  
                                        <li>
                                            <a href="{{ route('admin.referral.create') }}" class="tp-link">Add Referral</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.referral.index') }}" class="tp-link">View Referral</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidereport" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Report</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidereport">
                                    <ul class="nav-second-level">
                                     
                                  
                                        <li>
                                            <a href="{{ route('admin.revoked') }}" class="tp-link">View Revoke</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.pending') }}" class="tp-link">View Pending</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.accepted') }}" class="tp-link">View Accepted</a>
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
