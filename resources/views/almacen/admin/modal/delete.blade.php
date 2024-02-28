<div id="deleteAdminModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-danger">
                <h4 class="modal-title" id="fill-danger-modalLabel">¿Estas seguro?
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <p>
                    ¿Deseas borrar el usuario <span class="font-weight-bold" id="nombre-admin"></span>?
                </p>
            </div>
            <form id="deleteForm" action="{{ url('') }}" method="post">
                @csrf
                @method('delete')
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button form="deleteForm" type="submit" class="btn btn-danger">Eliminar usuario</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
    // Funcionalidad para borrar módulos
    const deleteModal = document.getElementById('deleteAdminModal');
    const nombreAdmin = document.getElementById('nombre-admin');
    const formDelete = document.getElementById('deleteForm');

    deleteModal.addEventListener('show.bs.modal', event => {
        let nombre = event.relatedTarget.dataset.nombre;
        let url = event.relatedTarget.dataset.url;

        nombreAdmin.innerText = nombre;
        formDelete.action = url;
    });
</script>
