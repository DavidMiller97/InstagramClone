<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@if(!isset($likesUsers)) {{__('Eliminar imagen')}} @else {{__('Le han dado me gusta')}} @endif</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if(isset($likesUsers))
            <div class="w-100" id="user-likes">

            </div>
          @else
            {{__('Si eliminas esta imagen nunca podras recuperarla, ¿Estas seguro que deseas eliminarla?')}} 
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          @if(!isset($likesUsers))
            <a href="{{ route('imagen.delete', [$imagen->imagen_id]) }}" class="btn btn-danger">Borrar</a>
          @endif
        </div>
      </div>
    </div>
  </div>