<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Number Guessing Game</title>
</head>
<body>
    <h1>Number Guessing Game</h1>
    
    <?php
    session_start();

    // If not set, initialize the session variables
    if (!isset($_SESSION['guess_count'])) {
        $_SESSION['guess_count'] = 0;
        $_SESSION['correct_number'] = rand(1, 100); // Random number between 1 and 100
    }

    // Handle "Give Up" button action
    if (isset($_POST['give_up'])) {
        echo "<p>The correct number was: {$_SESSION['correct_number']}</p>";
        // Reset the game
        $_SESSION['guess_count'] = 0;
        $_SESSION['correct_number'] = rand(1, 100);
        $_SESSION['last_number'] = null;
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num'])) {
        $number = $_POST["num"];
        $_SESSION['last_number'] = $number; // Store the last entered number
        $_SESSION['guess_count']++; // Increment guess counter

        // Display the multiplication table if the number is valid
        if ($number > 0) {
            echo "<h2>Multiplication table for $number</h2>";
            for ($i = 1; $i <= 12; $i++) {
                $result = $number * $i;
                echo "$number × $i = $result <br>";
            }
        } else {
            echo "<p>Please enter a positive integer.</p>";
        }

        // Display guess count
        echo "<p>You already guessed {$_SESSION['guess_count']} times.</p>";
    }
    ?>

    <form method="post" action="">
        <label for="num">Enter a number:</label>
        <input type="number" id="num" name="num" value="<?php if (isset($_SESSION['last_number'])) echo $_SESSION['last_number']; ?>" required>
        <input type="submit" value="Generate table">
        <button type="submit" name="give_up" value="1">Give up</button>
    </form>
</body>
</html>
