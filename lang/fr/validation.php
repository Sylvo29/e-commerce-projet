<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'L attribut : le champ doit être accepté .' ,
    ' accepted _if ' => 'L attribut : le champ doit être accepté quand : autre est :valeur.' ,
    ' accepted _url ' => 'L attribut : Le champ doit être une URL valide .' ,
    ' after ' => 'L attribut : le champ doit être une date postérieure à :date.' ,
    ' after_or_equal ' => 'L attribut : le champ doit être une date postérieure ou égale à :date.' ,
    'alpha' => 'L attribut : le champ doit uniquement contenir des lettres .' ,
    ' alpha_dash ' => 'L attribut : le champ doit uniquement contenir lettres , chiffres , tirets et traits de soulignement .' ,
    ' alpha_num ' => "L'attribut : le champ doit uniquement contenir lettres et chiffres." ,
    ' array ' => 'L attribut : le champ doit être un tableau .' ,
    'ascii' => 'L attribut : le champ doit uniquement contenir des caractères alphanumériques à un octet personnages et symboles .' ,
    ' before ' => 'L attribut : le champ doit être une date antérieure à :date.' ,
    ' before_or_equal ' => 'L attribut : le champ doit être une date antérieure ou égale à :date.' ,
    ' between ' => [
        ' array ' => 'L attribut : le champ doit contenir entre :min et :max éléments.' ,
        'file' => 'L attribut : le champ doit être entre :min et :max kilo-octets .' ,
        ' numeric ' => 'L attribut : le champ doit être entre :min et :max.' ,
        'string' => 'L attribut : le champ doit être entre les caractères :min et :max .' ,
],
    ' boolean ' => 'L attribut : le champ doit être vrai ou faux.' ,
    ' can ' => 'L attribut : champ contient une valeur non autorisée .' ,
    ' confirmed ' => 'L attribut : la confirmation du champ ne correspond pas.' ,
    ' current_password ' => 'Le mot de passe est incorrect.' ,
    'date' => 'L attribut : le champ doit être une date valide .' ,
    ' date_equals ' => 'L attribut : le champ doit être une date égale à :date.' ,
    ' date_format ' => 'L attribut : le champ doit correspondre au format :format.' ,
    ' decimal ' => 'L attribut : le champ doit avoir : décimal décimales .' ,
    ' declined ' => 'L attribut : le champ doit être diminué .' ,
    ' declined_if ' => 'L attribut : le champ doit être diminué quand : autre est :valeur.' ,
    ' different ' => 'L attribut : champ et : autre doit être différent .' ,
    'digits' => 'L attribut : le champ doit être : chiffres chiffres .' ,
    ' digits_between ' => 'L attribut : le champ doit être entre les chiffres :min et :max.' ,
    'dimensions' => "L attribut : Le champ a des dimensions d'image non valides . ",
    'distinct' => 'L attribut : Le champ a une valeur en double.' ,
    ' doesnt_end_with ' => "L attribut : Le champ ne doit pas se terminer par l'un des éléments suivants : :values." ,
    ' doesnt_start_with ' => 'L attribut : le champ ne doit pas commencer avec l un des éléments suivants : :values.' ,
    'email' => 'L attribut : Le champ doit être une adresse e-mail valide .' ,
    ' ends_with ' => 'L attribut : Le champ doit se terminer par l un des éléments suivants : :values.' ,
    ' enum' => 'L attribut sélectionné : est invalide .' ,
    ' exists' => 'L attribut sélectionné : est invalide .' ,
    'extensions' => 'L attribut : Le champ doit avoir l une des extensions suivantes : :values.' ,
    'file' => 'L attribut : le champ doit être un fichier .' ,
    ' filled' => 'L attribut : le champ doit avoir une valeur.' ,
    'gt' => [
        ' array ' => 'L attribut : le champ doit contenir plus de : éléments de valeur.' ,
        'file' => 'L attribut : le champ doit être plus grand que :valeur kilo-octets .' ,
        ' numeric ' => 'L attribut : le champ doit être plus grand que :valeur.' ,
        'string' => 'L attribut : le champ doit être plus grand que :valeur caractères .' ,
],
    ' gte ' => [
        ' array ' => 'L attribut : le champ doit contenir :value items ou plus.' ,
        'file' => 'L attribut : le champ doit être plus grand supérieur ou égal à :value kilobytes .' ,
        ' numeric ' => 'L attribut : le champ doit être plus grand supérieur ou égal à :value.' ,
        'string' => 'L attribut : le champ doit être plus grand supérieur ou égal à : valeur caractères .' ,
],
    'hex_color ' => 'L attribut : le champ doit être valide hexadécimal couleur .' ,
    'image' => 'L attribut : le champ doit être une image.' ,
    'in' => 'L attribut sélectionné : est invalide .' ,
    'in_array ' => 'L attribut : le champ doit exister dans : autre .' ,
    'integer ' => 'L attribut : le champ doit être un entier .' ,
    'ip' => 'L attribut : Le champ doit être une adresse IP valide .' ,
    'ipv4' => 'L attribut : Le champ doit être une adresse IPv4 valide .' ,
    'ipv6' => 'L attribut : Le champ doit être une adresse IPv6 valide .' ,
    ' json' => 'L attribut : Le champ doit être une chaîne JSON valide .' ,
    ' lowercase' => 'L attribut : le champ doit être minuscule .' ,
    ' lt ' => [
        ' array ' => 'L attribut : le champ doit avoir moins que :éléments de valeur.' ,
        'file' => 'L attribut : le champ doit être moins que :valeur kilo-octets .' ,
        ' numeric ' => 'L attribut : le champ doit être moins que :valeur.' ,
        'string' => 'L attribut : le champ doit être moins que :valeur caractères .' ,
],
    ' lte ' => [
        ' array ' => 'L attribut : le champ ne doit pas contenir plus de :value items.' ,
        'file' => 'L attribut : le champ doit être moins supérieur ou égal à :value kilobytes .' ,
        ' numeric ' => 'L attribut : le champ doit être moins supérieur ou égal à :value.' ,
        'string' => 'L attribut : le champ doit être moins supérieur ou égal à : valeur caractères .' ,
],
    ' mac_address ' => 'L attribut : Le champ doit être une adresse MAC valide .' ,
    'maximum' => [
        ' array ' => 'L attribut : le champ ne doit pas contenir plus de :max éléments.' ,
        'file' => 'L attribut : le champ ne doit pas être plus grand que :max kilo-octets .' ,
        ' numeric ' => 'L attribut : le champ ne doit pas être plus grand que :max.' ,
        'string' => 'L attribut : le champ ne doit pas être plus grand que : maximum de caractères .' ,
],
    ' max_digits ' => 'L attribut : le champ ne doit pas contenir plus de :max chiffres.' ,
    'mimes' => 'L attribut : le champ doit être un fichier de type : :values.' ,
    ' mimetypes ' => 'L attribut : le champ doit être un fichier de type : :values.' ,
    'min' => [
        ' array ' => 'L attribut : le champ doit contenir au moins :min éléments.' ,
        'file' => 'L attribut : le champ doit être d au moins :min kilobytes .' ,
        ' numeric ' => 'L attribut : le champ doit être au moins :min.' ,
        'string' => 'L attribut : le champ doit contenir au moins :min caractères .' ,
],
    ' min_digits ' => 'L attribut : Le champ doit contenir au moins :min chiffres.' ,
    'missing' => 'L attribut : le champ doit être manquant .' ,
    'missing_if ' => 'L attribut : le champ doit être manquant quand : autre est :valeur.' ,
    'missing_unless ' => 'L attribut : le champ doit être manquant sauf : autre est :valeur.' ,
    ' missing_with ' => 'L attribut : le champ doit être manquant quand :values est présent .' ,
    ' missing_with_all ' => 'L attribut : le champ doit être manquant quand :les valeurs sont présentes .' ,
    ' multiple_of ' => 'L attribut : le champ doit être un multiple de :value.' ,
    ' not_in ' => 'L attribut sélectionné : est invalide .' ,
    ' not_regex ' => 'L attribut : le format du champ est invalide .' ,
    'numeric' => 'L attribut : le champ doit être un nombre .' ,
    ' mot de passe ' => [
        'letters' => 'L attribut : le champ doit contenir au moins une lettre .' ,
        'mixed' => 'L attribut : le champ doit contenir au moins une majuscule et une minuscule lettre .' ,
        ' numbers ' => 'L attribut : le champ doit contenir au moins un chiffre .' ,
        'symbols' => 'L attribut : le champ doit contenir au moins un symbole .' ,
        'uncompromised ' => "L attribut donné : est apparu dans une fuite de données . S'il te plaît choisissez un autre : attribut ." ,
],
    ' present ' => 'L attribut : le champ doit être présent .' ,
    ' present_if ' => 'L attribut : le champ doit être présent quand : autre est :valeur.' ,
    ' present_unless ' => 'L attribut : le champ doit être présent sauf : autre est :valeur.' ,
    ' present_with ' => 'L attribut : le champ doit être présent quand :values est présent .' ,
    ' present_with_all ' => 'L attribut : le champ doit être présent quand :les valeurs sont présentes .' ,
    'prohibited' => 'L attribut : champ est interdit .' ,
    'prohibited_if ' => 'L attribut : champ est interdit quand : autre est :valeur.' ,
    'prohibited_unless ' => 'L attribut : champ est interdit sauf : autre est dans :valeurs.' ,
    'prohibits' => 'L attribut : champ interdit : autre depuis être présent .' ,
    ' regex ' => 'L attribut : le format du champ est invalide .' ,
    'required'=> 'L attribut : champ est requis .' ,
    'required_array_keys ' => 'L attribut : Le champ doit contenir des entrées pour : valeurs.' ,
    'required_if ' => 'L attribut : champ est requis quand : autre est :valeur.' ,
    'required_if_accepted ' => 'L attribut : champ est requis quand : autre est accepté .' ,
    'required_unless ' => 'L attribut : champ est requis sauf : autre est dans :valeurs.' ,
    'required_with ' => 'L attribut : champ est requis quand :values est présent .' ,
    'required_with_all ' => 'L attribut : champ est requis quand :les valeurs sont présentes .' ,
    'required_without ' => "L attribut : champ est requis quand :values n'est pas présent ." ,
    ' required_without_all ' => "L attribut : champ est requis lorsqu'aucune des :valeurs n'est présente ." ,
    'same' => 'L attribut : le champ doit correspondre à : autre .' ,
    'size'=> [
        ' array ' => 'L attribut : le champ doit contenir :éléments de taille.' ,
        'file' => 'L attribut : le champ doit être :size kilobytes .' ,
        ' numeric ' => 'L attribut : le champ doit être :size.' ,
        'string' => 'L attribut : le champ doit être : taille de caractères . ' ,
],
    ' starts_with ' => "L attribut : le champ doit commencer avec l'un des éléments suivants : :values." ,
    'string' => 'L attribut : le champ doit être une chaîne.' ,
    ' timezone ' => 'L attribut : le champ doit être valide fuseau horaire .' ,
    'unique' => 'L attribut : a déjà été utilisé .' ,
    ' uploaded ' => 'L attribut : échec du téléchargement .' ,
    ' uppercase ' => 'L attribut : le champ doit être majuscule .' ,
    'url' => 'L attribut : Le champ doit être une URL valide .' ,
    ' ulid ' => 'L attribut : Le champ doit être un ULID valide .' ,
    ' uuid ' => 'L attribut : Le champ doit être un UUID valide . ',



    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
