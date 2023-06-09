<?php
include __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get form input values
    $passLength = $_GET['pass_length'];
    $repetitiveChars = isset($_GET['repetitive_chars']);
    $includeLetters = isset($_GET['include_letters']);
    $includeNumbers = isset($_GET['include_numbers']);
    $includeSymbols = isset($_GET['include_symbols']);

    if ($repetitiveChars || $includeLetters || $includeNumbers || $includeSymbols) {
        // If inputs are valid generate the password
        try {
            $isValidInput = true;
            $generatedPassword = generatePassword($passLength, $repetitiveChars, $includeLetters, $includeNumbers, $includeSymbols);
        } catch (Exception $e) {
            echo $e;
        }
    } else {
         $isValidInput = false;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Generator</title>
</head>
<body>
    <div style="height: 100vh;" class="container d-flex flex-column justify-content-center align-items-center">

        <!-- TODO FIX SO IT DIPLAYS ALERT IF INPUT IS NOT VALID -->

        <?php if (!$isValidInput && $_SERVER['REQUEST_METHOD'] === 'GET'): ?>
            <div class="alert alert-danger" role="alert">
                Invalid input! Please check your form values.
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form method="GET" class="row w-50 g-4 rounded-3 p-4 bg-secondary-subtle">

            <div class="col-6 d-flex justify-content-end">
                <label for="pass-length" class="mt-2">Password length:</label>
            </div>
            <div class="col-6">
                <input type="number" min="5" value="15" class="form-control" id="pass-length" name="pass_length" aria-describedby="passHelp">
                <div id="passHelp" class="form-text">Min length: 5</div>
            </div>

            <div class="col-6 d-flex align-items-center text-end">
                <p>Contains one or more repetitive character:</p>
            </div>
            <div class="col-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="repetitive_chars" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="repetitive_chars" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        No
                    </label>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <p>Contains: </p>
            </div>
            <div class="col-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="include_letters" id="letters-check" checked>
                    <label class="form-check-label" for="letters-check">
                        Letters
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="include_numbers" id="nums-check">
                    <label class="form-check-label" for="nums-check">
                        Numbers
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="include_symbols" id="chars-check">
                    <label class="form-check-label" for="chars-check">
                        Symbols
                    </label>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-around">
                <button type="submit" class="btn btn-primary w-25 p-0">Generate Password</button>
                <button type="reset" class="ms-1 btn btn-warning w-25 p-1">Reset</button>
            </div>
        </form>

        <div class="row mt-3 p-4 rounded-3 bg-secondary-subtle text-center">
            <h5>Generated password: </h5>
                <?php
                if (isset($generatedPassword)) {
                    echo "<h4 class=\"text-success\">$generatedPassword</h4>";
                }
                ?>
        </div>
    </div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>

</body>
</html>