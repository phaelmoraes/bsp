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
@if( $permissao == "Administrator" || $permissao == "Collaborator")
<li class="nav-item">
    <a href="{{ route('consumers') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Clientes</p>
    </a>
</li>
@endif
@if( $permissao == "Administrator" || $permissao == "Collaborator")
<li class="nav-item">
    <a href="{{ route('loan') }}" class="nav-link">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>Empréstimos</p>
    </a>
</li>
@endif

@if( $permissao == "Administrator" || $permissao == "Collaborator")
<li class="nav-item">
    <a href="{{ route('spend') }}" class="nav-link">
    <i class="nav-icon fas fa-solid fa-comment-dollar"></i>
        <p>Gastos</p>
    </a>
</li>
@endif
@if( $permissao == "Administrator" || $permissao == "Collaborator")
<li class="nav-item">
    <a href="{{ route('balance') }}" class="nav-link">
        <i class="nav-icon fas fa-solid fa-coins"></i>
        <p>Saldo</p>
    </a>
</li>
@endif

@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('week') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Acompanhar</p>
    </a>
</li>
@endif

@if( $permissao == "AdministratorMotos" || $permissao == "Vendedor")
<li class="nav-item">
    <a href="{{ route('shop') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Cadastro de Motos</p>
    </a>
</li>
@endif

@if( $permissao == "AdministratorMotos" || $permissao == "Vendedor")
<li class="nav-item">
    <a href="{{ route('buscar_motos', ['loja' => Auth::user()->loja_id, 'fabricante' => 0]) }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Motos</p>
    </a>
</li>
@endif

@if( $permissao == "AdministratorMotos" || $permissao == "Vendedor")
<li class="nav-item">
    <a href="{{ route('vendas') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Vendas</p>
    </a>
</li>
@endif

@if( $permissao == "AdministratorMotos")
<li class="nav-item">
    <a href="{{ route('acompanhamento') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Acompanhamento</p>
    </a>
</li>
@endif

@if( $permissao == "AdministratorMotos")
<li class="nav-item">
    <a href="{{ route('vendedor') }}" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Cadastro Vendedores</p>
    </a>
</li>
@endif