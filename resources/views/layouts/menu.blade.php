<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<?php
    $id = Auth::user()->function ;
?>
@if( $id == "Administrator")
<li class="nav-item">
    <a href="{{ route('collaborators') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Colaboradores</p>
    </a>
</li>
@endif
<li class="nav-item">
    <a href="{{ route('consumers') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Clientes</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('loan') }}" class="nav-link">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>Empréstimos</p>
    </a>
</li>

