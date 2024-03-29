<!-- Modal -->
<div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-sm modal-default " role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">Alerta</h4>
	      	</div>
	    	<div class="modal-body">
                <p>Se cambiara el estado del Pedido</p>
		        <p>¿Esta seguro?</p>
	    	</div>
	      	<div class="modal-footer">
	        	{!! Form::open(['method' => 'put', 'route' => ['orders.updateStatus', $order, 'id' =>'modalOrderForm'],'id' =>'modalOrderForm']) !!}
					{!! Field::hidden('status', null, ['id' => 'value_status']) !!}
	        		<button type="button" id="delete" class="delete btn btn-default" data-dismiss="modal">Cancelar</button>
	        		<button id="buttonStatus" onclick="clikModal() " {!! Html::classes([
                            'buttonStatus btn ',
                            'btn-primary' => $order->status == 'Creado',
                            'btn-success' => $order->status == 'Solicitado',
                            'btn-warning' => $order->status == 'Ingresado',
                        ]) !!}>
                        @if ($order->status == 'Creado')
                            Solicitar
                        @elseif ($order->status == 'Solicitado')
                            Ingresar
                        @elseif ($order->status == 'Ingresado')
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
    $('#modalOrderForm').submit();
};                   



</script>
</div>
