<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<div class="sidebar__section__open custom-scrollbar">
    <div class="list__sidebar sidebar sidenav" id="mySidenav">
        <div>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        </div>
        <div class="main-logo">
            <a href="{{route('job.index')}}">
                <img src="{{asset('assets/images/hole-Logo-2.svg')}}" alt="img">
            </a>
        </div>
        <div class="ListDashboard">
            @if(auth()->user()->type == 'super_admin')
            <a active aria-current="page" href="{{route('adminprofile')}}" class="{{ request()->route()->getName() == 'adminprofile' ? 'active': '' }}">
                <li>
                    <span>Profile</span>
                </li>
            </a>
            @endif

            @if(auth()->user()->type == 'operative')
            <a active aria-current="page" href="{{route('operative.detail',['id'=>auth()->user()->id])}}" id="job" class="active">
                <li>
                    <span>Assigned Jobs</span>
                </li>
            </a>
            @endif


            @if(auth()->user()->type == 'super_admin')
            <a href="{{route('admin.index')}}" class="{{ request()->route()->getName() == 'admin.index' || request()->route()->getName() == 'admin.create' || request()->route()->getName() == 'admin.edit'  ? 'active': '' }}">
                <li>
                    <span>Manage Depots</span>
                </li>
            </a>

            <a href="{{route('admin.permission.index')}}" class="{{ request()->route()->getName() == 'admin.permission.index' ? 'active': '' }}">
                <li>
                    <span>Manage Roles</span>
                </li>
            </a>
            @endif

            @if(auth()->user()->type == 'admin' || auth()->user()->type == 'super_admin')

            @if(checkPermission("JobController"))
            <a aria-current="page" href="{{route('job.index')}}" class="{{ request()->route()->getName() == 'job.index' || request()->route()->getName() == 'job.create' || request()->route()->getName() == 'job.show' || request()->route()->getName() == 'job.edit'  ? 'active': '' }}">
                <li>
                    <span>Jobs</span>
                </li>
            </a>
            @endif

            @if(checkPermission("ClientController"))
            <a href="{{route('client.index')}}" class="{{ request()->route()->getName() == 'client.index' || request()->route()->getName() == 'client.create' || request()->route()->getName() == 'client.edit'  ? 'active': '' }}">
                <li>
                    <span>Clients</span>
                </li>
            </a>
            @endif

            @if(checkPermission("OperativeController"))
            <a href="{{route('operative.index')}}" class="{{ request()->route()->getName() == 'operative.index' || request()->route()->getName() == 'operative.create' || request()->route()->getName() == 'operative.edit' ? 'active': '' }}">
                <li>
                    <span>Operative</span>
                </li>
            </a>
            @endif

            @if(checkPermission("FormController"))
            <a href="{{route('form.index')}}" class="{{ request()->route()->getName() == 'form.index' || request()->route()->getName() == 'section.create' || request()->route()->getName() == 'form.create' || request()->route()->getName() == 'form.edit' ? 'active': '' }}">
                <li>
                    <span>Forms</span>
                </li>
            </a>
            @endif

            @if(checkPermission("StagesController"))
            <a href="{{route('stage.index')}}" class="{{ request()->route()->getName() == 'stage.index' ||  request()->route()->getName() == 'stage.create' || request()->route()->getName() == 'stage.edit' ? 'active': '' }}">
                <li>
                    <span>Stages</span>
                </li>
            </a>
            @endif

            @endif

            <div class="main-logout">
                <a href="#">
                    <li class="logout-list d-flex">
                        <img src="{{asset('assets/images/Logout.svg')}}" alt="img">
                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <span>Logout </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar_icon">
        <span onclick="openNav()" class="sidebaricon"><i class="fa-solid fa-bars"></i></span>
    </div>

</div>