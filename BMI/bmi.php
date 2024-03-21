<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/bmi.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <title>Body Mass Index</title>
</head>
<body>
<div class="container">
        <div class="calculator1">
            <h2>Metric BMI Calculator</h2>
            <form action="" method="post">
                <div class="input-group">
                    <label for="weight-metric">Weight (kg):</label>
                    <input type="text" id="weight-metric" name="weight-metric" required>
                </div>
                <div class="input-group">
                    <label for="height-metric">Height (m):</label>
                    <input type="text" id="height-metric" name="height-metric" required>
                </div>
                <button type="submit" name="submit-metric">Calculate BMI</button>
            </form>

            <?php
            if (isset($_POST['submit-metric'])) {
                $weightMetric = $_POST['weight-metric'];
                $heightMetric = $_POST['height-metric'];
                $bmiMetric = calculateBMI($weightMetric, $heightMetric);
                echo "<div class='result'>Your BMI is: " . number_format($bmiMetric, 1) . "</div>";
            }

            function calculateBMI($weight, $height) {
                if ($height > 3) {
                    $height /= 100;
                }
                return $weight / ($height * $height);
            }
            ?>
        </div>

        <div class="calculator2">
            <h2>Imperial BMI Calculator</h2>
            <form action="" method="post">
                <div class="input-group">
                    <label for="weight-imperial">Weight (lbs):</label>
                    <input type="text" id="weight-imperial" name="weight-imperial" required>
                </div>
                <div class="input-group">
                    <label for="height-feet">Height (ft):</label>
                    <input type="text" id="height-feet" name="height-feet" required>
                </div>
                <div class="input-group">
                    <label for="height-inches">Height (in):</label>
                    <input type="text" id="height-inches" name="height-inches" required>
                </div>
                <button type="submit" name="submit-imperial">Calculate BMI</button>
            </form>

            <?php
            if (isset($_POST['submit-imperial'])) {
                $weightImperial = $_POST['weight-imperial'];
                $heightFeet = $_POST['height-feet'];
                $heightInches = $_POST['height-inches'];
                $heightImperial = ($heightFeet * 12) + $heightInches;
                $bmiImperial = calculateBMIImperial($weightImperial, $heightImperial);
                echo "<div class='result'>Your BMI is: " . number_format($bmiImperial, 1) . "</div>";
            }

            function calculateBMIImperial($weight, $height) {
                return ($weight / ($height * $height)) * 703;
            }
            ?>
        </div>
    </div>
</body>
</html>