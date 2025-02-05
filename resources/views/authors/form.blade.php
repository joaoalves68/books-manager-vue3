@csrf
<div class="mb-3">
  <label for="name" class="form-label">Nome</label>
  <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $author->name ?? '') }}">
</div>
<div class="mb-3">
  <label for="state" class="form-label">Estado</label>
  <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $author->state ?? '') }}">
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
