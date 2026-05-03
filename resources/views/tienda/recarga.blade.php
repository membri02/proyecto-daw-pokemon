@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="recarga-wrapper">
    <header class="recarga-header">
        <h1 class="titulo-pokemon">Banco Pokémon</h1>
        <p class="subtitulo">Adquiere Pokémonedas adicionales de forma segura con Google Pay</p>
        
        <div class="saldo-actual-badge">
            Saldo actual: <span id="saldoUsuario">{{ Auth::user()->monedas }}</span> 
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda">
        </div>
    </header>

    <div class="packs-grid">
        <!-- Pack Básico -->
        <div class="pack-card">
            <div class="pack-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/coin-case.png" alt="Pack Básico">
            </div>
            <h2>Pack Básico</h2>
            <div class="pack-amount">500 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda"></div>
            <div class="pack-price">0.00 €</div>
            <div class="gpay-container" data-amount="500"></div>
        </div>

        <!-- Pack Avanzado -->
        <div class="pack-card destacado">
            <div class="badge-popular">MÁS POPULAR</div>
            <div class="pack-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/nugget.png" alt="Pack Avanzado">
            </div>
            <h2>Pack Avanzado</h2>
            <div class="pack-amount">1200 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda"></div>
            <div class="pack-price">0.00 €</div>
            <div class="gpay-container" data-amount="1200"></div>
        </div>

        <!-- Pack Maestro -->
        <div class="pack-card">
            <div class="pack-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/big-nugget.png" alt="Pack Maestro">
            </div>
            <h2>Pack Maestro</h2>
            <div class="pack-amount">2500 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda"></div>
            <div class="pack-price">0.00 €</div>
            <div class="gpay-container" data-amount="2500"></div>
        </div>
    </div>

    <div class="tienda-action-bar" style="text-align: center; margin-top: 3rem;">
        <a class="btn-secondary-tcg" href="{{ route('tienda.index') }}">← Volver a la Tienda</a>
    </div>
</div>

<!-- Spinner Transición (Procesando Pago) -->
<div class="spinner-overlay" id="spinnerOverlay">
    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/master-ball.png" alt="Procesando" class="pokeball-spinner">
    <div class="spinner-text">PROCESANDO PAGO...</div>
</div>

<!-- Toast Notificación -->
<div id="toast-success" class="toast">
    <div class="toast-content">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Éxito">
        <span id="toast-message">¡Pago exitoso!</span>
    </div>
</div>

@vite(['resources/css/recarga.css'])
<!-- Google Pay SDK -->
<script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
<script>
    // Configuración base de Google Pay
    const baseRequest = {
        apiVersion: 2,
        apiVersionMinor: 0
    };

    const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];
    const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

    const baseCardPaymentMethod = {
        type: 'CARD',
        parameters: {
            allowedAuthMethods: allowedCardAuthMethods,
            allowedCardNetworks: allowedCardNetworks
        }
    };

    const cardPaymentMethod = Object.assign(
        {},
        baseCardPaymentMethod,
        {
            tokenizationSpecification: {
                type: 'PAYMENT_GATEWAY',
                parameters: {
                    'gateway': 'example', // Dummy gateway para TEST
                    'gatewayMerchantId': 'exampleGatewayMerchantId'
                }
            }
        }
    );

    let paymentsClient = null;

    function getGoogleIsReadyToPayRequest() {
        return Object.assign(
            {},
            baseRequest,
            { allowedPaymentMethods: [baseCardPaymentMethod] }
        );
    }

    function getGooglePaymentDataRequest(amountStr) {
        const paymentDataRequest = Object.assign({}, baseRequest);
        paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
        paymentDataRequest.transactionInfo = {
            totalPriceStatus: 'FINAL',
            totalPrice: amountStr,
            currencyCode: 'EUR',
            countryCode: 'ES'
        };
        // En TEST merchantId no es validado estrictamente, pero se recomienda proveer uno dummy
        paymentDataRequest.merchantInfo = {
            merchantName: 'Banco Pokémon TCG',
            merchantId: '12345678901234567890'
        };
        return paymentDataRequest;
    }

    function getGooglePaymentsClient() {
        if (paymentsClient === null) {
            paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
        }
        return paymentsClient;
    }

    function onGooglePayLoaded() {
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
            .then(function(response) {
                if (response.result) {
                    addGooglePayButtons();
                }
            })
            .catch(function(err) {
                console.error("Error isReadyToPay:", err);
            });
    }

    function addGooglePayButtons() {
        const containers = document.querySelectorAll('.gpay-container');
        containers.forEach(container => {
            const amountCoins = container.dataset.amount;
            const button = getGooglePaymentsClient().createButton({
                buttonColor: 'black',
                buttonType: 'buy',
                onClick: () => onGooglePaymentButtonClicked(amountCoins)
            });
            container.appendChild(button);
        });
    }

    function onGooglePaymentButtonClicked(amountCoins) {
        // En este entorno de prueba simulamos que el precio es 0.00
        const paymentDataRequest = getGooglePaymentDataRequest('0.00');
        const paymentsClient = getGooglePaymentsClient();
        
        paymentsClient.loadPaymentData(paymentDataRequest)
            .then(function(paymentData) {
                processPayment(paymentData, amountCoins);
            })
            .catch(function(err) {
                console.error("Pago cancelado o fallido:", err);
            });
    }

    function processPayment(paymentData, amountCoins) {
        // 1. Mostrar Spinner de "Procesando"
        const spinner = document.getElementById('spinnerOverlay');
        spinner.classList.add('active');

        // 2. Enviar datos al backend con Fetch y CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ route("tienda.procesar_pago") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                monedas: parseInt(amountCoins)
            })
        })
        .then(response => response.json())
        .then(data => {
            spinner.classList.remove('active');

            if (data.success) {
                // Actualizar saldo en la UI
                document.getElementById('saldoUsuario').innerText = data.monedas_actuales;
                
                // Mostrar Toast
                const toast = document.getElementById('toast-success');
                document.getElementById('toast-message').innerText = data.message;
                toast.classList.add('show');
                
                // Ocultar toast despues de 4 segundos
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 4000);
            } else {
                alert("Error al procesar pago: " + data.message);
            }
        })
        .catch(error => {
            spinner.classList.remove('active');
            console.error('Error en fetch:', error);
            alert('Ha ocurrido un error al conectar con el servidor.');
        });
    }
</script>
@endsection
