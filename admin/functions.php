<?php include ("database.php");?>
<?php
$dropdown_verf = '';

if(!empty($_POST['selecteer_verf'])) {
    $dropdown_verf = $_POST['selecteer_verf'];

    $query = "SELECT kleuren.kleur_naam, $dropdown_verf.kleur_id AS id FROM kleuren,$dropdown_verf
         WHERE $dropdown_verf.kleur_id = kleuren.kleur_id
         ORDER BY $dropdown_verf.kleur_id";
    $result = mysqli_query($connection, $query);
    $output = "";
    while (($row = mysqli_fetch_array($result)) != null)
    {
       $output .= "<option value='".$row['id']."'> ".$row['kleur_naam']."</option>";
    }
    echo $output;
}

function encryptPass($password)
{
    // A higher "cost" is more secure but consumes more processing power
    $cost = 10;

    // Create a random salt
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

    // Prefix information about the hash so PHP knows how to verify it later.
    // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
    $salt = sprintf("$2a$%02d$", $cost) . $salt;

    // Value:
    // $2a$10$eImiTXuWVxfM37uY4JANjQ==

    // Hash the password with the salt
    $hash = crypt($password, $salt);
    // Value:
    // $2a$10$eImiTXuWVxfM37uY4JANjOL.oTxqp7WylW7FCzx2Lc7VLmdJIddZq

    return $hash;

}

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}
