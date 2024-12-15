<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consult METAR</title>
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

        input {
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

        .metar-result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Consult METAR</h1>
    <form id="metarForm">
        <label for="icao">Airport ICAO Code</label>
        <input type="text" id="icao" name="icao" required><br><br>

        <button type="submit">Consult METAR</button>
    </form>

    <div id="metarResult" class="metar-result" style="display: none;"></div>

    <script>
        document.getElementById('metarForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const icao = document.getElementById('icao').value.toUpperCase();

            fetch(`https://avwx.rest/api/metar/${icao}?token="set your token from https://info.avwx.rest/ here"`)
                .then(response => response.json())
                .then(data => {
                    const metarResult = document.getElementById('metarResult');
                    if (data.error) {
                        metarResult.textContent = `Error: ${data.error}`;
                    } else {
                        metarResult.textContent = `METAR for ${icao}: ${data.raw}`;
                    }
                    metarResult.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching METAR:', error);
                    document.getElementById('metarResult').textContent = 'Error obtaining METAR';
                    document.getElementById('metarResult').style.display = 'block';
                });
        });
    </script>
</body>
</html>
