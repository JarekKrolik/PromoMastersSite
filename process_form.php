<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiadomość</title>
    <style>
        body {
            font-family: "Alegreya Sans", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .message-box {
            text-align: center;
            background-color: beige;
            border: 1px solid black;
            box-shadow: 3px 3px 3px black;
            padding: 2rem;
            border-radius: 8px;
        }

        .message-box p {
            font-size: 1.6rem;
            margin: 1rem 0;
        }

        .message-box button {
            cursor: pointer;
            margin: 1rem 0;
            text-transform: uppercase;
            font-size: 1.8rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            background-color: black;
            color: white;
            transition: 0.3s;
        }

        .message-box button:hover,
        .message-box button:focus {
            background-color: gray;
            color: black;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="message-box">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Pobierz dane z formularza
            $firstName = htmlspecialchars($_POST['first-name']);
            $lastName = htmlspecialchars($_POST['last-name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            // Adres e-mail do wysyłania wiadomości
            $to = "promoleaders@vp.pl";
            $subject = "Nowa wiadomość z formularza kontaktowego";
            $body = "Imię: $firstName\nNazwisko: $lastName\nEmail: $email\n\nWiadomość:\n$message";

            // Nagłówki wiadomości
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Return-Path: $email\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $headers .= "Content-Transfer-Encoding: 8bit\r\n";

            // Wyślij wiadomość na adres promoleaders@vp.pl
            if (mail($to, $subject, $body, $headers)) {
                echo "<p>Dziękujemy za twoją wiadomość, postaramy się odpowiedzieć najszybciej jak to będzie możliwe.</p>";
            } else {
                echo "<p>Wystąpił problem podczas wysyłania wiadomości.</p>";
            }
        } else {
            echo "<p>Nieprawidłowe żądanie.</p>";
        }
        ?>
        <button onclick="window.location.href='index.html#kontakt'">OK</button>
    </div>
</body>

</html>