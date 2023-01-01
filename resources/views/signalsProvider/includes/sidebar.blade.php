
            <nav class="navbar bg-light navbar-light">
                <a href="/signalsProvider" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Gemtrust</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('dashboard/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 id="spName" class="mb-0"></h6>
                        <span>Signal Provider</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="/signalsProvider" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="/signalsProvider/sendSignal" class="nav-item nav-link"><i class="fa fa-box me-2"></i>Send Signal</a>
                    <a href="/signalsProvider/signals" class="nav-item nav-link"><i class="fa fa-box me-2"></i>View Signals</a>
                    
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-box me-2"></i></i>Signal Providers</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/signalsProvider" class="dropdown-item">View Signals Provider</a>
                            <a href="/admin/addSignalProvider" class="dropdown-item">Add Signal Provider</a>
                        </div>
                    </div> -->

                </div>
            </nav>