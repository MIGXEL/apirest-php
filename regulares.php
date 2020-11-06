<?php
    $patron01 = "/^[0-9]{3}\-[0-9]{3}\-[0-9]{3}$/";                 // Teléfono
    $patron02 = "/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\-[a-zA-Z]$/";       // NIF
    $patron13 = "/^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i";    // E-Mail:
    $patron04 = "/^\d{2}\/\d{2}\/\d{4}$/";  // Fecha en formato 'dd/mm/yyyy'
    $patron05 = "/^gratis$/";               // La cadena es exáctamente 'gratis' en minúsculas
    $patron06 = "/gratis/";                 // La cadena contiene 'gratis' en minúsculas
    $patron07 = "/gratis/i";                // La cadena contiene 'gratis', en mayúsculas o minúsculas
    $patron08 = "/^[a-zA-Z\s]+$/";          // Sólo letras en mayúsculas/minúsculas, y espacios
    $patron09 = "/^[0-9]+$/";               // Sólo números. No se admite cadena vacía
    $patron10 = "/^[0-9]*$/";               // Sólo cadena vacía o números

    // Sólo letras en mayúsculas/minúsculas incluídas con tilde (no 'ñ' ni 'Ñ'), espacios y comillas simples. No admite cadena vacía:
    $patron11 = "/^[a-zA-ZáéíóúÁÉÍÓÚ]+$/";

    // Sólo letras en mayúsculas/minúsculas, acentuadas, con espacios y comillas simples. No admite cadena vacía:
    $patron12 = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s\']+$/";

    // Sólo cadenas vacías, o con números y/o letras en mayúsculas/minúsculas acentuadas,
    // También espacios, comillas simples, dos puntos, puntos, comas, punto y coma y guiones:
    $patron13 = "/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s\'\:\.\,\;-]*$/";

    // Sólo números y letras en mayúsculas/minúsculas acentuadas. No admite cadena vacía:
    $patron14 = "/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ]+$/";

    // Sólo números, letras en mayúsculas/minúsculas acentuadas, y espacios. No admite cadena vacía:
    $patron15 = "/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/";
?>