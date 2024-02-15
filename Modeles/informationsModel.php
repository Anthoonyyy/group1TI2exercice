<?php
// Notre fonction qui charge les informations
function getInformations(PDO $db):array
{
    $sql = "SELECT * FROM informations";
    $query = $db->query($sql);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $query->closeCursor();
    return $result;
}

// notre fonction qui insert dans informations
function addInformations(PDO $db, string $themail, string $themessage, string $thedate): bool|string
{
    
    $themail = filter_var($themail, FILTER_VALIDATE_EMAIL);
    $themessage = htmlspecialchars(strip_tags($themessage), ENT_QUOTES);
    $thedate = htmlspecialchars(strip_tags(trim($thedate)), ENT_QUOTES);

    
    if ( $themail === false || empty($themessage) || empty($thedate)) {
        return false;
    }
    
    $sql = "INSERT INTO informations ( themail, themessage, thedate) VALUES ('$themail', '$themessage', '$thedate')";
    try {
        
        $db->exec($sql);
        
        return true;
    } catch (Exception $e) {
        
        return $e->getMessage();
    }
}