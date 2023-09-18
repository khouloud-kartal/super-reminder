<?php

    function my_autoloader($class)
    {

        $class_path = str_replace("\\", DIRECTORY_SEPARATOR, $class);           // Remplace les anti slash par des slash

        $class_path = str_replace("App", "src", $class_path);   // Remplace 'src' par 'app' pour utiliser 'app' dans les namespace

        $file = __DIR__ . DIRECTORY_SEPARATOR . $class_path . ".php";           // Définit le fichier à cibler


        if(file_exists($file)){                                 // Si le fichier existe    
            require_once $file;                                     // On le require_once
        }
    }

    spl_autoload_register("my_autoloader");                     // Applique la methode sur le fichier ciblé sans instancier la class