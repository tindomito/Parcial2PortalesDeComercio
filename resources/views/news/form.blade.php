@csrf
<div class="mb-3">
    <label for="title" class="form-label">Título</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $news->title ?? '') }}">
    @error('title')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="date" class="form-label">Fecha</label>
    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', isset($news->date) ? $news->date->format('Y-m-d') : '') }}">
    @error('date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="summary" class="form-label">Resumen</label>
    <textarea name="summary" id="summary" class="form-control">{{ old('summary', $news->summary ?? '') }}</textarea>
    @error('summary')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="content" class="form-label">Contenido</label>
    <textarea name="content" id="content" class="form-control" rows="5">{{ old('content', $news->content ?? '') }}</textarea>
    @error('content')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Guardar</button>
