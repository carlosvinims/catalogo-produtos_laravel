@extends('layouts.app') 
 
@section('title', 'Editar Produto #' . $product->id) 
 
@section('content') 
<td>
    Preço bruto: {{ $product->price }}
</td>
<div class="row justify-content-center"> 
    <div class="col-lg-8"> 
        <div class="d-flex justify-content-between align-items-center mb-4"> 
            <h3 class="fw-bold text-dark mb-0">Editar Produto #{{ $product->id }}</h3> 
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm"> 
                <i class="bi bi-arrow-left me-1"></i> Voltar 
            </a> 
        </div> 
 
        <div class="card border-0 shadow-sm"> 
            <div class="card-body p-4"> 
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"> 
                    @csrf                    @method('PUT') 
                     
                    <div class="row g-3"> 
                        <div class="col-12"> 
                            <label for="name" class="form-label fw-semibold">Nome do Produto <span class="text-danger">*</span></label> 
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}"> 
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-md-6"> 
                            <label for="category_id" class="form-label fw-semibold">Categoria <span class="text-danger">*</span></label> 
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id"> 
                                @foreach($categories as $category) 
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}> 
                                        {{ $category->name }} 
                                    </option> 
                                @endforeach 
                            </select> 
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-md-3"> 
                            <label for="price" class="form-label fw-semibold">Preço (R$) <span class="text-danger">*</span></label> 
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}"> 
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-md-3"> 
                            <label for="stock" class="form-label fw-semibold">Estoque <span class="text-danger">*</span></label> 
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}"> 
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-12"> 
                            <label for="image" class="form-label fw-semibold">Substituir Imagem (Opcional)</label> 
                            @if($product->image) 
                                <div class="mb-2 d-flex align-items-center gap-3 p-2 border rounded bg-light"> 
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Imagem Atual" style="width: 60px; height: 60px; object-fit: cover;" class="rounded-border"> 
                                    <span class="small text-muted">Imagem cadastrada atualmente. Selecione um novo arquivo abaixo caso deseje substituíla.</span> 
                                </div> 
                            @endif 
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*"> 
                            <div class="form-text">Formatos aceitos: JPG, PNG, WEBP (Máx: 2MB).</div> 
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-12"> 
                            <label for="description" class="form-label fw-semibold">Descrição <span class="text-danger">*</span></label> 
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea> 
                            @error('description') <div class="invalidfeedback">{{ $message }}</div> @enderror 
                        </div> 
 
                        <div class="col-12"> 
                            <div class="form-check form-switch"> 
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}> 
                                <label class="form-check-label fw-semibold" for="is_active">Produto Ativo para Venda</label> 
                            </div> 
                        </div> 
 
                        <div class="col-12 text-end pt-3"> 
                            <a href="{{ route('products.index') }}" class="btn btn-light me-2">Cancelar</a> 
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Salvar Alterações</button> 
                        </div> 
                    </div> 
                </form> 
</div> 
</div> 
</div> 
</div> 
@endsection