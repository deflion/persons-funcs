<?

function getPartsFromFullname($fullName){
    $exploted = explode(" ",$fullName);
    $seporated = [
        'surname' => $exploted[0],
        'name' => $exploted[1],
        'patronymic' => $exploted[2],
    ] ;

    return $seporated;

};

function getFullnameFromParts($surname, $name, $patronomyc){
    $fullName = [$surname, $name, $patronomyc];
    return implode(' ', $fullName);
};

function getShortName($fullName){
    $seporated = getPartsFromFullname($fullName);
    $shortName = $seporated["name"].' '.mb_substr($seporated["surname"],0,1).".";

    return $shortName;
}