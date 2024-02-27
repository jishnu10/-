<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save'])) {
        // Validate input
        if (!empty($_POST['textInput'])) {
            $text = $_POST['textInput'];

            // Generate random directory name
            $randomDirectoryName = generateRandomString(8);
            $domain = "www.myweb12.com";
            $url = $domain . "/" . $randomDirectoryName;

            // Create directory if not exists
            $directory = "./" . $randomDirectoryName;
            if (!is_dir($directory)) {
                mkdir($directory);
            }

            // Save text to a file
            $file = fopen($directory . "/saved_text.txt", "w");
            if ($file) {
                fwrite($file, $text);
                fclose($file);
                echo "Text saved successfully.<br>";
                echo "URL: <a href='" . $url . "'>" . $url . "</a>";
            } else {
                echo "Error: Unable to save text.";
            }
        } else {
            echo "Error: Text input is empty.";
        }
    } else {
        echo "Error: Form submission failed.";
    }
} else {
    echo "Error: Access denied.";
}

function generateRandomString($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
