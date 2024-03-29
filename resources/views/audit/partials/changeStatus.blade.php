<!-- Modal -->
<div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-sm modal-default " role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Alerta</h4>
	      	</div>
	    	<div class="modal-body">
                <p>Se cambiara el estado de la auditoria</p>
		        <p>¿Esta seguro?</p>
	    	</div>
	      	<div class="modal-footer">
	        	{!! Form::open(['method' => 'put', 'route' => ['audit.update', $audit], 'id' =>'modalAuditForm']) !!}
					{!! Field::hidden('status', "null", ['id' => 'value_status']) !!}
	        		<button type="button" id="delete" class="btn btn-default delete" data-dismiss="modal">Cancelar</button>
	        		<button id="buttonStatus" type="submit" onclick="clikModal()" {!! Html::classes([
                            'btn',
                            'btn-primary' => $audit->status == 'Creado',
                            'btn-default' => $audit->status == 'Finalizado',
                            'btn-warning' => $audit->status == 'Finalizado',
                        ]) !!}>
                        @if ($audit->status == 'Creado')
                            Finalizar
                        @elseif ($audit->status == 'Finalizado')
                            Reabrir
                        @elseif ($audit->status == 'Finalizado')
                            Revertir
                        @endif
                        <i class="fa fa-angle-double-right"></i>

                    </button>
				{!! Form::close() !!}
	      	</div>
    	</div>
  	</div>
    <script>
function clikModal() {
    $('.delete').fadeOut(1);
    $('#buttonStatus').attr('disabled', 'disabled');
    $('#buttonStatus').text('Espere...')
    $('#modalAuditForm').submit();
};                   



</script>
</div>