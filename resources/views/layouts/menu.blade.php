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
    <a href="{{ route('spend') }}" class="nav-link">
    <i class="nav-icon fas fa-solid fa-comment-dollar"></i>
        <p>Gastos</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('balance') }}" class="nav-link">
        <i class="nav-icon fas fa-solid fa-coins"></i>
        <p>Saldo</p>
    </a>
</li>
@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('week') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Acompanhar</p>
    </a>
</li>
@endif

@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('shop') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Loja</p>
    </a>
</li>
@endif

@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('buscar_motos', ['loja' => Auth::user()->loja_id, 'fabricante' => 0]) }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Motos</p>
    </a>
</li>
@endif

@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('vendas') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Acompanhar Vendas</p>
    </a>
</li>
@endif

@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('vendedor') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Cadastro Vendedores</p>
    </a>
</li>
@endif