<x-layout>
    <x-slot:title>
        Scanner
    </x-slot:title>

    <div class="container text-center">
        <h2 class="lg:hidden py-6 text-xl font-bold">Scan Ticket</h2>

        <!-- The element where the camera feed will appear -->
        <div id="reader" style="width: 300px; margin: auto;"></div>

        <!-- Show scanned result here -->
        <div id="qr-result" class="mt-3 text-lg font-bold"></div>

        <!-- Scan Again button -->
        <button id="scan-again-btn" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hidden">Scan Again</button>
    </div>

    <!-- QR code scanner script -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    @isset($ticket)
    <div>
        <p>{{ $ticket->user->name }}</p>
    </div>
    @endisset

    <script>
        let scanner;

        function onScanSuccess(decodedText, decodedResult) {
            // Stop scanning immediately
            scanner.clear();

            // Send scanned code to backend
            fetch('scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: decodedText })
            })
                .then(async (res) => {
                    const data = await res.json();
                    const qrResultDiv = document.getElementById('qr-result');

                    // Remove old color classes
                    qrResultDiv.classList.remove('text-green-600', 'text-red-600', 'text-yellow-600');

                    if (res.status === 200) {
                        qrResultDiv.classList.add('text-green-600');
                        qrResultDiv.innerText = `${data.message}`;
                    } else if (res.status === 409) {
                        qrResultDiv.classList.add('text-yellow-600');
                        qrResultDiv.innerText = `${data.message}`;
                    } else {
                        qrResultDiv.classList.add('text-red-600');
                        qrResultDiv.innerText = `${data.message}`;
                    }

                    // Show "Scan Again" button
                    document.getElementById('scan-again-btn').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Network error:', error);
                    document.getElementById('qr-result').classList.add('text-red-600');
                    document.getElementById('qr-result').innerText = `❌ Network Error`;
                    document.getElementById('scan-again-btn').classList.remove('hidden');
                });
        }

        function startScanner() {
            scanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
            scanner.render(onScanSuccess);
        }

        // Start scanner on page load
        startScanner();

        // Restart scan on button click
        document.getElementById('scan-again-btn').addEventListener('click', () => {
            document.getElementById('scan-again-btn').classList.add('hidden');
            document.getElementById('qr-result').innerText = '';
            startScanner();
        });
    </script>
</x-layout>
