@csrf
<div class="mb-3">
  <label for="title" class="form-label">Título</label>
  <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title ?? '') }}">
</div>
<div class="mb-3">
  <label for="description" class="form-label">Descrição</label>
  <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $book->description ?? '') }}</textarea>
</div>
<div class="mb-3">
  <label for="published_at" class="form-label">Publicado em</label>
  <input type="date" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', $book->published_at ?? '') }}">
</div>
<div class="mb-3">
  <label for="author_id" class="form-label">Autor</label>
  <select class="form-control" id="author_id" name="author_id">
    <option value="">Selecione</option>
    @foreach($authors as $author)
      <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
    @endforeach
  </select>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
