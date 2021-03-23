<? include "persons.php"; ?>

<?    

    function getPartsFromFullname($fullName){
        $exploted = explode(" ",$fullName);
        $seporated = [
            'surmane' => $exploted[0],
            'name' => $exploted[1],
            'patronymic' => $exploted[2],
        ] ;

        return $seporated;

    };

    function getFullnameFromParts($surname, $name, $patronomyc){
        $fullName = [$surname, $name, $patronomyc];
        return implode(' ', $fullName);
    };


    print_r(getPartsFromFullname("Иванов Иван Иванович"));
    echo( getFullnameFromParts("Иванов", "Иван", "Иванович"));

?>