@extends('layouts.app') 
 
@section('title', 'Cadastrar Produto - TechStore') 
 
@section('content') 
<div class="row justify-content-center"> 
    <div class="col-lg-8"> 
        <div class="d-flex justify-content-between align-items-center mb-4"> 
            <h3 class="fw-bold text-dark mb-0">Cadastrar Novo Produto</h3> 
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm"> 
                <i class="bi bi-arrow-left me-1"></i> Voltar 
            </a> 
        </div> 
 
        <div class="card border-0 shadow-sm"> 
            <div class="card-body p-4"> 
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"> 
                    @csrf 
                    <div class="row g-3"> 
                        <div class="col-12"> 
                            <label for="name" class="form-label fw-semi-bold">Nome do Produto <span class="text-danger">*</span></label> 
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Teclado Mecânico RGB Wireless"> 
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-md-6"> 
                            <label for="category_id" class="form-label fw-semibold">Categoria <span class="text-danger">*</span></label> 
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id"> 
                                <option value="" selected disabled>Selecione a categoria...</option> 
                                @foreach($categories as $category) 
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}> 
                                        {{ $category->name }} 
                                    </option> 
                                @endforeach 
                            </select> 
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-md-3"> 
                            <label for="price" class="form-label fw-semibold">Preço (R$) <span class="text-danger">*</span></label> 
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="0,00"> 
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-md-3"> 
                            <label for="stock" class="form-label fw-semibold">Estoque <span class="text-danger">*</span></label> 
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}"> 
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-12"> 
                            <label for="image" class="form-label fw-semibold">Imagem do Produto (Opcional)</label> 
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*"> 
                            <div class="form-text">Formatos aceitos: JPG, PNG, WEBP (Máx: 2MB).</div> 
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-12"> 
                            <label for="description" class="form-label fw-semibold">Descrição Detalhada <span class="text-danger">*</span></label> 
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Insira as especificações técnicas, características e detalhes do produto...">{{ old('description') }}</textarea> 
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-12"> 
                            <div class="form-check form-switch"> 
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}> 
                                <label class="form-check-label fw-semibold" for="is_active">Produto Ativo para Venda</label> 
                            </div> 
                        </div> 
 
                        <div class="col-12 text-end pt-3"> 
                            <a href="{{ route('products.index') }}" class="btn btn-light me-2">Cancelar</a> 
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i> Salvar Produto</button> 
                        </div> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection