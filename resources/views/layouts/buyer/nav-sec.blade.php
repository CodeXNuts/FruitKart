<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)"  style="{{ request()->routeIs('buyer.home') || request()->routeIs('buyer.viewOrangeChart')  ? 'text-decoration:none;color:#6c757d!important' : '' }}">Home</a></li>
        <li class="breadcrumb-item" onclick="document.getElementById('logoutForm').submit();"><a href="javascript:void(0)">Log out</a></li>
        
    </ol>
</nav>

<form style="display: none" action="{{ route('buyer.logout') }}" method="POST" id="logoutForm">
    @csrf
</form>