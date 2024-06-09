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

            // Adres e-mail do wysłania wiadomości
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

            // Flagi do sprawdzenia statusu wysyłki
            $mainEmailSent = false;
            $confirmationEmailSent = false;

            // Wyślij wiadomość na adres promoleaders@vp.pl
            if (mail($to, $subject, $body, $headers)) {
                $mainEmailSent = true;
            }

            // Wyślij potwierdzenie na adres e-mail wpisany w formularzu
            $confirmSubject = "Potwierdzenie wysłania wiadomości";
            $confirmBody = "
            <html>
            <head>
                <meta charset='UTF-8'>
                <style>
                    body {
                        font-family: 'Alegreya Sans', sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        background-color: beige;
                        border: 1px solid black;
                        box-shadow: 3px 3px 3px black;
                        padding: 20px;
                        border-radius: 8px;
                        text-align: center;
                    }
                    h1 {
                        text-transform: uppercase;
                        font-size: 2.6rem;
                    }
                    p {
                        font-size: 1.6rem;
                    }
                    .highlight {
                        font-weight: bold;
                        text-transform: uppercase;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>Potwierdzenie wysłania wiadomości</h1>
                    <p>Dziękujemy za kontakt, <span class='highlight'>$firstName $lastName</span>.</p>
                    <p>Otrzymaliśmy Twoją wiadomość:</p>
                    <p>$message</p>
                </div>
            </body>
            </html>";

            // Dodanie nagłówków dla potwierdzenia
            $confirmHeaders = "From: $to\r\n";
            $confirmHeaders .= "Reply-To: $to\r\n";
            $confirmHeaders .= "Return-Path: $to\r\n";
            $confirmHeaders .= "MIME-Version: 1.0\r\n";
            $confirmHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";
            $confirmHeaders .= "Content-Transfer-Encoding: 8bit\r\n";

            if (mail($email, $confirmSubject, $confirmBody, $confirmHeaders)) {
                $confirmationEmailSent = true;
            }

            // Wyświetl komunikaty
            if ($mainEmailSent && $confirmationEmailSent) {
                echo "<p>Wiadomość została wysłana pomyślnie.</p>";
                echo "<p>Potwierdzenie zostało wysłane na Twój adres e-mail.</p>";
            } elseif ($mainEmailSent) {
                echo "<p>Wiadomość została wysłana pomyślnie.</p>";
                echo "<p>Wystąpił problem podczas wysyłania potwierdzenia.</p>";
            } elseif ($confirmationEmailSent) {
                echo "<p>Wystąpił problem podczas wysyłania wiadomości głównej.</p>";
                echo "<p>Potwierdzenie zostało wysłane na Twój adres e-mail.</p>";
            } else {
                echo "<p>Wystąpił problem podczas wysyłania wiadomości.</p>";
            }
        } else {
            echo "<p>Nieprawidłowe żądanie.</p>";
        }
        ?>
        <button onclick="window.location.href='index.html#contact'">OK</button>
    </div>
</body>

</html>