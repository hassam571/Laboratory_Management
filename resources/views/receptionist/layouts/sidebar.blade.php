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
                                <a href="#sidetestrefpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Test</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidetestrefpanal">
                                    <ul class="nav-second-level">
                                     
                                  
                                        <li>
                                            <a href="{{ route('testsave.showForm') }}" class="tp-link">Add Test</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('receptionist.customers') }}" class="tp-link">Accepted Reports</a>
                                        </li>
                                        {{-- <li>    
                                            <a href="{{ route('receptionist.customers.revoked') }}" class="tp-link">Revoked Reports</a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidestockrefpanal" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Stock</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidestockrefpanal">
                                    <ul class="nav-second-level">
                                     
                                  
                                        <li>
                                            <a href="{{ route('stock.create') }}" class="tp-link">Add Stock</a>
                                        </li>
                                        <li>
                                            {{-- <a href="{{ route('admin.referral.index') }}" class="tp-link">View Test Ranges</a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidedebit" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Debit</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidedebit">
                                    <ul class="nav-second-level">
                                     
                                  
                                        <li>
                                            <a href="{{ route('debit.create') }}" class="tp-link">Add Stock</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('debit.index') }}" class="tp-link">View Stock</a>
                                        </li>
                                        <li>
                                            {{-- <a href="{{ route('admin.referral.index') }}" class="tp-link">View Test Ranges</a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidecredit" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span>Credit</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidecredit">
                                    <ul class="nav-second-level">
                                     
                                  
                                        <li>
                                            <a href="{{ route('credit.create') }}" class="tp-link">Add credit</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('credit.index') }}" class="tp-link">View credit</a>
                                        </li>
                                        <li>
                                            {{-- <a href="{{ route('admin.referral.index') }}" class="tp-link">View Test Ranges</a> --}}
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
