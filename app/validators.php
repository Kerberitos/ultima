<?php

Validator::extend('alpha_spaces', function($attribute, $value, $parameters)
{
    return preg_match('/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/', $value);
    
});