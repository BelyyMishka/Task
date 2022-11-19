<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
        <a href="{{ route('main') }}" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-4 text-uppercase text-primary">Task</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('main') }}" class="nav-item nav-link @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'main') active @endif">Home</a>
                <a href="{{ route('users.index') }}" class="nav-item nav-link @if(\Illuminate\Support\Facades\Request::is('users') || \Illuminate\Support\Facades\Request::is('users/*')) active @endif">Users</a>
                <a href="{{ route('books.index') }}" class="nav-item nav-link @if(\Illuminate\Support\Facades\Request::is('books') || \Illuminate\Support\Facades\Request::is('books/*')) active @endif">Books</a>
                <a href="{{ route('workers.index') }}" class="nav-item nav-link @if(\Illuminate\Support\Facades\Request::is('workers') || \Illuminate\Support\Facades\Request::is('workers/*')) active @endif">Workers</a>
                <a href="{{ route('specializations.index') }}" class="nav-item nav-link @if(\Illuminate\Support\Facades\Request::is('specializations') || \Illuminate\Support\Facades\Request::is('specializations/*')) active @endif">Specializations</a>
            </div>
        </div>
    </nav>
</div>
