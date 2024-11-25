@if(Auth::check())
<div class="body-header sticky-md-top">
<div class="container-fluid">
        <div class="d-flex justify-content-between">
        <a class="navbar-brand d-flex align-items-center color-900" href="#">
            <img src="/assets/img/remedic-logo.png" alt="Image Description" style="width: 120px;">
        </a>

        <div class="menu-link flex-fill">
            <div class="dropdown menu-home">
                <a href="/admin/dashboard" class="btn btn-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="fill-muted" class="bi bi-house-door" viewBox="0 0 16 16">
					<ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255"></ellipse>
					<path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
					</svg>
					<span style="padding-left:6px;"> Dashboard</span>
				</a>
            </div>
            <div class="dropdown menu-pages">
                    <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="fill-muted" class="bi bi-files" viewBox="0 0 16 16">
                    <ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255"></ellipse>
                    <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
                    </svg>
                    <span style="padding-left:6px;">Masters</span></a>
                    <ul class="dropdown-menu p-2 shadow animation_delay">
                        <li class="dropdown-submenu">
                        <a href="#" data-bs-toggle="dropdown" class="dropdown-item d-flex dropdown-toggle after-none">
                        <span>Role Access Control</span>
                        <svg class="ms-auto" width="18" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255"></ellipse>
                        <path class="fill-primary" fill-rule="evenodd" clip-rule="evenodd" d="M0 4C0 3.88214 0.04515 3.76911 0.125518 3.68577C0.205885 3.60244 0.314887 3.55562 0.428544 3.55562H10.5362L7.83893 0.759566C7.75846 0.676123 7.71325 0.56295 7.71325 0.444943C7.71325 0.326937 7.75846 0.213764 7.83893 0.130321C7.9194 0.0468777 8.02854 2.78032e-09 8.14234 0C8.25614 -2.78032e-09 8.36528 0.0468777 8.44575 0.130321L11.8741 3.68538C11.914 3.72666 11.9457 3.7757 11.9673 3.82968C11.9889 3.88367 12 3.94155 12 4C12 4.05845 11.9889 4.11633 11.9673 4.17032C11.9457 4.2243 11.914 4.27334 11.8741 4.31462L8.44575 7.86968C8.36528 7.95312 8.25614 8 8.14234 8C8.02854 8 7.9194 7.95312 7.83893 7.86968C7.75846 7.78624 7.71325 7.67306 7.71325 7.55506C7.71325 7.43705 7.75846 7.32388 7.83893 7.24043L10.5362 4.44438H0.428544C0.314887 4.44438 0.205885 4.39756 0.125518 4.31423C0.04515 4.23089 0 4.11786 0 4V4Z"></path>
                        </svg>
                        </a>
                        <ul class="dropdown-menu border-0 p-2 shadow-lg animation_delay">
                            <li><a href="/admin/roles" class="dropdown-item">Manage Roles</a></li>
                            <li><a href="/admin/permissions/all" class="dropdown-item">Manage Permissions</a></li>
                            <li><a href="/admin/users" class="dropdown-item">Manager User</a></li>
                        </ul>
                        </li>

                                             
                        <li><a href="/admin/brands" class="dropdown-item"><span>Brand</span></a></li>
                        <li><a href="/admin/categories" class="dropdown-item"><span>Categories</span></a></li>
                        <li><a class="dropdown-item" href="/admin/departments"><span>Department</span></a></li>
                        
                        <li><a class="dropdown-item" href="/admin/amc-master"><span>AMC Master</span></a></li>
                        <li><a class="dropdown-item" href="/admin/discounts"><span>Discount Master</span></a></li>
                        <li class="dropdown-submenu">
                        <a href="#" data-bs-toggle="dropdown" class="dropdown-item d-flex dropdown-toggle after-none">
                        <span>Products</span>
                        <svg class="ms-auto" width="18" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255"></ellipse>
                        <path class="fill-primary" fill-rule="evenodd" clip-rule="evenodd" d="M0 4C0 3.88214 0.04515 3.76911 0.125518 3.68577C0.205885 3.60244 0.314887 3.55562 0.428544 3.55562H10.5362L7.83893 0.759566C7.75846 0.676123 7.71325 0.56295 7.71325 0.444943C7.71325 0.326937 7.75846 0.213764 7.83893 0.130321C7.9194 0.0468777 8.02854 2.78032e-09 8.14234 0C8.25614 -2.78032e-09 8.36528 0.0468777 8.44575 0.130321L11.8741 3.68538C11.914 3.72666 11.9457 3.7757 11.9673 3.82968C11.9889 3.88367 12 3.94155 12 4C12 4.05845 11.9889 4.11633 11.9673 4.17032C11.9457 4.2243 11.914 4.27334 11.8741 4.31462L8.44575 7.86968C8.36528 7.95312 8.25614 8 8.14234 8C8.02854 8 7.9194 7.95312 7.83893 7.86968C7.75846 7.78624 7.71325 7.67306 7.71325 7.55506C7.71325 7.43705 7.75846 7.32388 7.83893 7.24043L10.5362 4.44438H0.428544C0.314887 4.44438 0.205885 4.39756 0.125518 4.31423C0.04515 4.23089 0 4.11786 0 4V4Z"></path>
                        </svg>
                        </a>
                        <ul class="dropdown-menu border-0 p-2 shadow-lg animation_delay">
                            <li v-if="this.accessRole.indexOf('Create Products') !== -1"><a href="/admin/products/create" class="dropdown-item">Add New Product</a></li>
                            <li v-if="this.accessRole.indexOf('Update Products') !== -1"><a href="/admin/products" class="dropdown-item">Manage Products</a></li>
                            <li v-if="this.accessRole.indexOf('View Inventory') !== -1 || this.accessRole.indexOf('Update Inventory') !== -1"><a href="/admin/inventory" class="dropdown-item">Manage Inventory</a></li>
                        </ul>
                        </li>
                        <li v-if="this.accessRole.indexOf('Customers') !== -1"><a class="dropdown-item" href="/admin/customers"><span>Customers</span></a></li>
                        
                    </ul>
            </div>
            <div class="dropdown menu-orders">
                    <a class="btn btn-link" href="/admin/orders"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="fill-muted" class="bi bi-box" viewBox="0 0 16 16">
                    <ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255"></ellipse>
                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                    </svg>
                    <span style="padding-left:6px;"> Orders</span></a>
            </div>

            <div class="dropdown menu-amc">
                    <a class="btn btn-link" href="/admin/amc" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="fill-muted" class="bi bi-gear" viewBox="0 0 16 16">
                    <ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255"></ellipse>
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                    </svg>
                    <span style="padding-left:6px;"> AMC</span></a>
            </div>

            <div class="dropdown menu-reports">
                <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="fill-muted" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                    <ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255"></ellipse>
                    <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                    </svg>
                    <span style="padding-left:6px;">MIS Report</span></a>
                    <ul class="dropdown-menu p-2 shadow animation_delay">                        
                        <li><a class="dropdown-item" href="/admin/report/customer"><span>Customer Report</span></a></li>
                        <li><a class="dropdown-item" href="/admin/report/booking"><span>Booking Report</span></a></li>
                        <li><a class="dropdown-item" href="/admin/report/cancelled"><span>Cancelled Report</span></a></li>
                        <li><a class="dropdown-item" href="/admin/report/return"><span>Order Return Report</span></a></li>
                        <li><a class="dropdown-item" href="/admin/report/revenue"><span>Revenue Report</span></a></li>
                        <li><a class="dropdown-item" href="/admin/report/inventory"><span>Inventory Report</span></a></li>
                    </ul>
            </div>
            </div>  
            <ul class="navbar-right d-flex align-items-center mb-0 list-unstyled">
                <li class="d-none d-sm-inline-block">
                <div class="dropdown morphing scale-left">
                <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown">
                <svg width="20" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="fill-secondary" d="M16.589 11.8505C15.1096 12.3407 11.2811 11.5703 10.1035 10.3446C8.926 9.11893 8.62407 5.69285 9.52383 4.49635C10.4236 3.29985 13.926 2.68117 15.5021 3.16561C17.0782 3.65004 18.7992 5.9555 18.9804 7.40297C19.1615 8.85044 18.0685 11.3602 16.589 11.8505C15.1096 12.3407 11.2811 11.5703 10.1035 10.3446L16.589 11.8505Z"></path>
                <path class="fill-muted" d="M9 20C9.66304 20 10.2989 19.7366 10.7678 19.2678C11.2366 18.7989 11.5 18.163 11.5 17.5H6.5C6.5 18.163 6.76339 18.7989 7.23223 19.2678C7.70107 19.7366 8.33696 20 9 20ZM9 2.39749L8.00375 2.59874C6.8737 2.82899 5.85791 3.44262 5.12831 4.33577C4.39872 5.22892 4.00012 6.34673 4 7.49999C4 8.28499 3.8325 10.2462 3.42625 12.1775C3.22625 13.1362 2.95625 14.135 2.5975 15H15.4025C15.0437 14.135 14.775 13.1375 14.5737 12.1775C14.1675 10.2462 14 8.28499 14 7.49999C13.9996 6.34694 13.6009 5.22943 12.8713 4.33654C12.1417 3.44365 11.1261 2.8302 9.99625 2.59999L9 2.39624V2.39749ZM16.775 15C17.0538 15.5587 17.3762 16.0012 17.75 16.25H0.25C0.62375 16.0012 0.94625 15.5587 1.225 15C2.35 12.75 2.75 8.59999 2.75 7.49999C2.75 4.47499 4.9 1.94999 7.75625 1.37374C7.7388 1.19994 7.75798 1.0244 7.81254 0.858461C7.8671 0.69252 7.95584 0.539857 8.07303 0.410318C8.19022 0.280778 8.33325 0.177238 8.49292 0.106376C8.65258 0.0355132 8.82532 -0.00109863 9 -0.00109863C9.17468 -0.00109863 9.34742 0.0355132 9.50709 0.106376C9.66675 0.177238 9.80978 0.280778 9.92697 0.410318C10.0442 0.539857 10.1329 0.69252 10.1875 0.858461C10.242 1.0244 10.2612 1.19994 10.2437 1.37374C11.6566 1.66112 12.9267 2.42795 13.839 3.54437C14.7514 4.6608 15.2498 6.05821 15.25 7.49999C15.25 8.59999 15.65 12.75 16.775 15Z"></path>
                </svg>
                </a>
                <div class="dropdown-menu shadow-lg border-0 p-0 notifications" id="notifications">
                <div class="card">
                <div class="card-header">
                <h6 class="card-title mb-0">Notifications Center</h6>
                <span class="badge bg-primary">0</span>
                </div>
                <div class="card-body text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="#9399a1" class="bi bi-bell-slash-fill" viewBox="0 0 16 16">
                <path d="M5.164 14H15c-1.5-1-2-5.902-2-7 0-.264-.02-.523-.06-.776L5.164 14zm6.288-10.617A4.988 4.988 0 0 0 8.995 2.1a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 7c0 .898-.335 4.342-1.278 6.113l9.73-9.73zM10 15a2 2 0 1 1-4 0h4zm-9.375.625a.53.53 0 0 0 .75.75l14.75-14.75a.53.53 0 0 0-.75-.75L.625 15.625z"/>
                </svg>
                <div class="mb-0" style="margin-top:24px;">No new notification available</div>
                </div>
                <ul class="list-unstyled list-group list-group-custom mb-0 custom_scroll " style="height: 120px;">
                <!--<li class="list-group-item d-flex border-end-0 border-start-0">
                <div class="avatar"><i class="fa fa-thumbs-o-up fa-lg"></i></div>
                <div class="flex-grow-1 ms-2">
                <h6 class="mb-0 fw-light"><a href="#">7 New Feedback</a> <small class="float-end text-muted">Today</small></h6>
                <small>It will give a smart finishing to your site</small>
                </div>
                </li>-->
                </ul>
                <div class="card-body py-2">
                <a href="#" class="btn btn-link d-none">View all notifications</a>
                </div>
                </div>
                </div>
                </div>
                </li>

                <li>
                <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button" data-bs-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#9c78b5" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                </a>
                <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                <div class="card w240 overflow-hidden">
				@if(Auth::check())
                <div class="card-body">
				
                <h6 class="card-title mb-0">{{Auth::user()->name}}</h6>
                <p class="text-muted">{{Auth::user()->email}}</p>
                <a href="/admin-api/logout" class="btn bg-secondary text-light text-uppercase w-100">Logout</a>
                </div>
                <div class="list-group m-2">
                <a href="/admin/profile" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-user"></i>Profile &amp; account</a>
                <a href="/admin/feedback" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-gear"></i>Feedback</a>
                </div>
				@endif
                </div>
                </div>
                </div>
                </li>
            </ul>
        </div>   
    </div>
	</div>
        @endif