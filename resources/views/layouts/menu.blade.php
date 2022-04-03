<!-- need to remove -->
<?php
    $permissao = Auth::user()->function ;
?>
@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@endif
@if( $permissao == "Administrator")
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
<li class="nav-item">
    <a href="{{ route('balance') }}" class="nav-link">
        <i class="nav-icon fas fa-solid fa-coins"></i>
        <p>Saldo</p>
    </a>
</li>