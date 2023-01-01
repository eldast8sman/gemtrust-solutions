
            <nav class="navbar bg-light navbar-light">
                <a href="/admin" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Gemtrust</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('dashboard/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 id="adminName" class="mb-0"></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="/admin" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Administrator</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/admins" class="dropdown-item">View Admin</a>
                            <a href="/admin/registerAdmin" class="dropdown-item">Add Admin</a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Partners</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/partners" class="dropdown-item">View Partners</a>
                            <a href="/admin/addPartner" class="dropdown-item">Add Partner</a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-box me-2"></i></i>Packages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/packages" class="dropdown-item">View Packages</a>
                            <a href="/admin/addPackage" class="dropdown-item">Add Package</a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-box me-2"></i></i>Sections</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/sections" class="dropdown-item">View Sections</a>
                            <a href="/admin/addSection" class="dropdown-item">Add Section</a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-box me-2"></i></i>Articles</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/articles" class="dropdown-item">View Articles</a>
                            <a href="/admin/addArticle" class="dropdown-item">Add Article</a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-box me-2"></i></i>Signal Providers</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/signalsProvider" class="dropdown-item">View Signals Provider</a>
                            <a href="/admin/addSignalProvider" class="dropdown-item">Add Signal Provider</a>
                            <a href="/admin/signals" class="dropdown-item">View Signals</a>
                        </div>
                    </div>

                </div>
            </nav>