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
        return "Undefined";
    }

}

function getGenderDescription($array){

    $male = 0;
    $female = 0;
    $und = 0;

    foreach($array as $value){

        if (getGenderFromName($value["fullname"]) == "Male"){
            $male +=1;
        };

        if (getGenderFromName($value["fullname"]) == "Female"){
            $female +=1;
        }
        
        if (getGenderFromName($value["fullname"]) == "Undefined"){
            $und +=1;
        }
        
    }

    $sum = $male + $female + $und;
    $maleCheck =  round($male / $sum * 100,2);
    $femaleCheck = round($female / $sum * 100, 2);
    $undCheck = round($und / $sum  * 100,2);

    echo <<<HEREDOCLETTER
    Гендерный состав аудитории:<br>
    ---------------------------<br>
    Мужчины - $maleCheck%<br>
    Женщины - $femaleCheck%<br>
    Не удалось определить - $undCheck%<br>
    HEREDOCLETTER;

};