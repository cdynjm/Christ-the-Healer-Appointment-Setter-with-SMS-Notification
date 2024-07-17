<form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
    @csrf
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="nav-link text-dark font-weight-bold px-0">
        <i class="fa-solid fa-right-from-bracket me-1"></i>
        <span class="d-sm-inline d-none me-2">
    </a>
</form>