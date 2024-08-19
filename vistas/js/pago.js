/*SELECCIONAR METODO DE PAGO */
$("#nuevoMetodoPago").change(function(){
    var metodo = $(this).val();
    if(metodo == "Efectivo"){
        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");
        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            '<div class="col-xs-4" style="padding-right:0px">'+
                '<div class="input-group">'+
                '<input type="text" class="form-control" id="nuevoValorEfectivo" name="nuevoValorEfectivo" value="250.00" readonly>'+
                        '<span class="input-group-addon"><i class="fa fa-money"></i></span>'+
                '</div>'+
            '</div>'
        );
    }
});
