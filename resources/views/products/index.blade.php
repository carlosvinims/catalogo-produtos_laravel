@extends('layouts.app')

@section('title', 'Catálogo de Produtos - TechStore')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Catálogo de Produtos</h3>
        <p class="text-muted small mb-0">Consulte, filtre e gerencie os itens
            disponíveis no estoque.</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary shadowsm">
        <i class="bi bi-plus-lg me-1"></i> Novo Produto
    </a>
</div>

<!-- Card de Filtros e Pesquisa -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="{{ route('products.index') }}" method="GET" class="row g-2">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                            class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Buscar por nome do produto..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">Todas as Categorias</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100"><i
                        class="bi bi-funnel me-1"></i> Filtrar</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" title="Limpar Filtros"><i class="bi bi-x-lg"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Tabela de Produtos -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Imagem</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-4">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img-thumb border">
                            @else
                            <div class="product-img-thumb bg-light border d-flex align-items-center justify-content-center text-muted">
                                <i class="bi bi-image fs-4"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-bold text-dark d-block">{{$product->name }}</span>
                            <span class="text-muted small">#{{ $product->id }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $product->category->name ?? 'Sem Categoria' }}</span>
                        </td>
                        <td class="fw-semibold text-dark">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td>
                            @if($product->stock > 10)
                            <span class="badge bg-success-subtle text-success border border-success-subtle">{{ $product->stock }} un.</span>
                            @elseif($product->stock > 0)
                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">{{ $product->stock }}
                                un.</span>
                            @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Esgotado</span>
                            @endif
                        </td>
                        <td>
                            @if($product->is_active)
                            <span class="badge bg-primary rounded-pill">Ativo</span>
                            @else
                            <span class="badge bg-secondary rounded-pill">Inativo</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-secondary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja remover este produto do catálogo?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1 d-block mb-2 text-secondary"></i>
                            Nenhum produto encontrado para os filtros
                            selecionados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection