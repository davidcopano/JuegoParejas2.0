<?php
function shuffle_assoc($array) {
    $keys = array_keys($array);

    shuffle($keys);

    $new = "";

    foreach($keys as $key) {
        $new[$key] = $array[$key];
    }

    $array = $new;

    return true;
}

if(isset($_GET["d"]))
    {
        $archivos = scandir("images/cartas");

        // Necesario para que no muestre '.' y '..'

        array_shift($archivos);
        array_shift($archivos);

        $narchivos = count($archivos);

        shuffle($archivos);

        $dificultad = intval($_GET["d"]);

        $ncartas = 0;

        $longitud = 0;

        switch ($dificultad)
        {
            // Tamaño de 12 cartas (6 cartas con su pareja)
            case 1: {

                $ncartas = 6;

                $longitud = $narchivos - $ncartas;

                for($i = 0; $i < $longitud; $i++) {
                    array_pop($archivos);
                }
            }

            break;

            // Tamaño de 16 cartas (8 cartas con su pareja)
            case 2: {
                $ncartas = 8;

                $longitud = $narchivos - $ncartas;

                for($i = 0; $i < $longitud; $i++) {
                    array_pop($archivos);
                }
            }

            break;

            case 3: {
                $ncartas = 10;

                $longitud = $narchivos - $ncartas;

                for($i = 0; $i < $longitud; $i++) {
                    array_pop($archivos);
                }
            }

                break;
        }

        // Conversión a JSON

        $salida = "{\"imagenes\": [";

        for($i = 0; $i < count($archivos); $i++) {
            $salida .= "{ \"id\": " . ($i+1) . ", \"url\": " . "\"images/cartas/" . $archivos[$i] . "\"},";
        }

        $salida .= "]}";

        $salida = substr($salida, 0, -3);

        $salida .= "]}";

        echo($salida);
    }
    else {
        die("No tiene permiso para visualizar esta página.");
    }
