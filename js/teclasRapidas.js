let modalInstance;

window.addEventListener('keydown', function (event) {
    let modalAbierto = document.getElementById('miModal') && document.getElementById('miModal').classList.contains('show');

    if (modalAbierto) {
        if (event.key === 'F1') {
            event.preventDefault();
            document.getElementById('confirmarModal').click();
        }
        if (event.key === 'F2') {
            event.preventDefault();
            document.getElementById('cancelarModal').click();
        }
    } else {
        if (event.key === 'F1') {
            event.preventDefault();
            document.querySelector('input[type="submit"][value="Registrar Venta"]').click();
        }
        if (event.key === 'F2') {
            event.preventDefault();
            document.getElementById('cancelar').click();
        }
        if (event.key === 'F3') {
            event.preventDefault();
            document.getElementById('regresar').click();
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    let miModal = document.getElementById('miModal');

    if (miModal) {
        miModal.addEventListener('shown.bs.modal', function () {
            document.getElementById('pagoCliente').focus();
        });
    }

    document.addEventListener('keydown', function (event) {
        let modalAbierto = document.getElementById('miModal') && document.getElementById('miModal').classList.contains('show');
        if (modalAbierto && event.key === 'Enter') {
            let focusable = document.querySelectorAll('#miModal input:not([type=hidden]):not([disabled]), #miModal button');
            let index = Array.prototype.indexOf.call(focusable, document.activeElement);

            if (index > -1 && index < focusable.length - 1) {
                event.preventDefault();
                focusable[index + 1].focus();
            }
        }
    });

    document.querySelector('input[type="submit"][value="Registrar Venta"]').addEventListener('click', function (event) {
        event.preventDefault();
        let total = parseFloat(document.getElementById('total_general_input').value);
        document.getElementById('totalPagarModal').innerText = total.toFixed(2);

        modalInstance = new bootstrap.Modal(document.getElementById('miModal'));
        modalInstance.show();
    });

    document.getElementById('pagoCliente').addEventListener('input', calcularCambio);
    document.getElementById('descuentoPorcentaje').addEventListener('input', calcularCambio);
    document.getElementById('ivaPorcentaje').addEventListener('input', calcularCambio);

    document.getElementById('confirmarModal').addEventListener('click', function () {
        document.getElementById('descuentoInput').value = document.getElementById('descuentoPorcentaje').value;
        document.getElementById('ivaInput').value = document.getElementById('ivaPorcentaje').value;
        document.getElementById('pagoInput').value = document.getElementById('pagoCliente').value;
        document.getElementById('enviar_ventas').submit();
    });

    document.getElementById('cancelarModal').addEventListener('click', function () {
        if (modalInstance) {
            modalInstance.hide();
        }
    });
});

function calcularCambio() {
    let total = parseFloat(document.getElementById('total_general_input').value);
    let descuento = parseFloat(document.getElementById('descuentoPorcentaje').value) || 0;
    let iva = parseFloat(document.getElementById('ivaPorcentaje').value) || 0;
    let pago = parseFloat(document.getElementById('pagoCliente').value) || 0;

    let totalConDescuento = total - (total * (descuento / 100));
    let totalConIVA = totalConDescuento + (totalConDescuento * (iva / 100));

    let cambio = pago - totalConIVA;

    document.getElementById('cambioCliente').innerText = cambio >= 0 ? cambio.toFixed(2) : "Pago insuficiente";
}