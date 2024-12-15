<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight planner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Flight planner</h1>
    <form id="flightPlanForm">
        <label for="departure">Departing Airport (ICAO):</label>
        <input type="text" id="departure" name="departure" required><br><br>

        <label for="arrival">Arriving Airport (ICAO):</label>
        <input type="text" id="arrival" name="arrival" required><br><br>

        <label for="airlineCode">Airline ICAO:</label>
        <input type="text" id="airlineCode" name="airlineCode" value="Your ICAO" readonly><br><br>

        <label for="callsign">Callsign:</label>
        <input type="text" id="callsign" name="callsign" required><br><br>

        <label for="aircraft">Airplane:</label>
        <select id="aircraft" name="aircraft" required>
            <option value="AT76">ATR 72-600 (AT76)</option>
            <option value="B38M">Boeing 737 MAX 8 (B38M)</option>
            <option value="B738">Boeing 737-800 (B738)</option>
            <option value="A20N">Airbus A320-251N (A20N)</option>
            <option value="B737">Boeing 737-700 (B737)</option>
        </select><br><br>

        <button type="submit">Planificar Vuelo</button>
    </form>

    <script>
        document.getElementById('flightPlanForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario por defecto

            const departure = document.getElementById('departure').value.toUpperCase();
            const arrival = document.getElementById('arrival').value.toUpperCase();
            const airlineCode = document.getElementById('airlineCode').value;
            const callsign = document.getElementById('callsign').value;
            const aircraft = document.getElementById('aircraft').value;

            // Validar los códigos ICAO si es necesario
            if (departure.length === 4 && arrival.length === 4 && callsign && aircraft) {
                // Crear la URL para redirigir a SimBrief
                const simBriefUrl = `https://www.simbrief.com/system/dispatch.php?type=generate&orig=${departure}&dest=${arrival}&airline=${airlineCode}&fltnum=${callsign}&type=${aircraft}`;

                // Redirigir a la URL de SimBrief
                window.location.href = simBriefUrl;
            } else {
                alert('Por favor ingrese códigos ICAO válidos, un callsign y seleccione un avión.');
            }
        });
    </script>
</body>
</html>
