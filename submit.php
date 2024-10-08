<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $style = htmlspecialchars($_POST['style']);
    $years = htmlspecialchars($_POST['years']);
    $experience = htmlspecialchars($_POST['experience']);

    $timestamp = date("Y-m-d_H-i-s");
    
    $dir = "survey/";
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true); 
    }

    $filename_txt = $dir . "survey_" . $timestamp . ".txt";
    $filename_json = $dir . "survey_" . $timestamp . ".json";

    $content_txt = "Ім'я: $name\nEmail: $email\nУлюблений стиль: $style\nСкільки років клієнт: $years\nДосвід: $experience\n";
    file_put_contents($filename_txt, $content_txt);

    $content_json = [
        'name' => $name,
        'email' => $email,
        'style' => $style,
        'years' => $years,
        'experience' => $experience,
    ];
    file_put_contents($filename_json, json_encode($content_json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    echo "Дякуємо за ваш відгук, $name! <br>";
    echo "Дата та час заповнення форми: " . date("Y-m-d H:i:s") . "<br>";
    echo "Ваші відповіді збережені.";
} else {
    echo "Будь ласка, заповніть форму.";
}
?>



