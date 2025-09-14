<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apache2 Hostname is </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            color: #333;
            flex-direction: column;
            text-align: center;
            line-height: 1.6;
        }
        .container {
            background-color: #fff;
            padding: 2.5em;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            width: 90%;
            box-sizing: border-box;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 0.5em;
            font-size: 2em;
        }
        p {
            font-size: 1.1em;
            color: #555;
        }
        .greeting {
            font-size: 1.4em;
            color: #3498db;
            font-weight: bold;
            margin-top: 0;
        }
        .hostname {
            font-weight: bold;
            color: #e74c3c;
            word-break: break-all;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="greeting" id="greetingMessage"></p>
        <h1>Welcome to Your Apache2 Server!</h1>
        <p>This page is being served by the machine with the hostname:</p>
        <p class="hostname"><strong><?php echo gethostname(); ?></strong></p>
    </div>

    <script>
        function getGreeting() {
            const date = new Date();
            const hour = date.getHours();
            let greeting;

            if (hour < 12) {
                greeting = "Good morning!";
            } else if (hour < 18) {
                greeting = "Good afternoon!";
            } else {
                greeting = "Good evening!";
            }
            document.getElementById("greetingMessage").textContent = greeting;
        }
        
        // Run the function when the page loads
        getGreeting();
    </script>
</body>

</html>
