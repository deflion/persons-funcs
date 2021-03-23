<?

function getPartsFromFullname($fullName){
    $exploted = explode(" ",$fullName);
    $seporated = [
        'surname' => $exploted[0],
        'name' => $exploted[1],
        'patronomyc' => $exploted[2],
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

function getGenderFromName($fullName){
    $seporated = getPartsFromFullname($fullName);
    $gender = 0;
    
    
    // detedt gender by surname
    if (mb_substr($seporated["surname"],-2,2) == "ва"){
        $gender = -1;
    } elseif (mb_substr($seporated["surname"],-1,1) == "в"){
        $gender = 1;
    } else {
        $gender = 0;
    }
    
    // detect gender by name
    $genderName = mb_substr($seporated["name"],-1,1);

    if ($genderName == "a"){
        $gender = -1;
    } elseif ($genderName == "й" || $genderName == "н"){
        $gender = 1;
    } else {
        $gender = 0;
    }

    // detect gender by patronomyc
    if (mb_substr($seporated["patronomyc"],-3,3) == "вна"){
        $gender = -1;
    } elseif (mb_substr($seporated["patronomyc"],-2,2) == "ич"){
        $gender = 1;
    } else {
        $gender = 0;
    }

    if (($gender <=> 0) === 1){
        return "Male";
    } elseif (($gender <=> 0) === -1){
        return "Female";
    } else {
        return "undefined";
    }

}