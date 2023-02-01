<?php

session_start();

$api_url = "https://netzwelt-devtest.azurewebsites.net/Territories/All";
$json = file_get_contents($api_url);
$data = json_decode($json, true);
$places = $data["data"];



//plans
//6. push to github




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
</head>

<style>
    *{
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

    body{
        background: #e3edf7;
    }

    body::-webkit-scrollbar {
        width: 0.1em;
        background-color: #fff;
    }
 
    body::-webkit-scrollbar-thumb {
        background-color: #000000;
    }
 
    body::-webkit-scrollbar-thumb:hover {
        background-color: #555555;
    }

    button{
        text-align: center;
        font-weight: 500;
        font-size: 15px;
        height: 40px;
        width: 120px;
        border: 1px solid #8c7aa2;
        background-color: #8c7aa2;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        position: absolute;
        top: 1%;
        left: 46%;
    }

    h2{
        margin: 60px auto;
        width: 600px;
        text-align: center;
    }

    p{
        margin: -37px auto;
        width: 600px;
        text-align: center;
    }

    .accordion{
        margin: 60px auto;
        width: 600px;
    }

    .accordion li{
        list-style: none;
        width: 100%;
        margin: 20px;
        padding: 10px;
        border-radius: 8px;
        background: #8c7aa2;
        box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
                    -6px -6px 10px -1px rgba(255, 255, 255, 0.25);
    }

    .accordion li label{
        color: #fff;
        display: flex;
        align-items: center;
        padding: 10px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    input[type="checkbox"]{
        display: none;
    }

    .accordion .content{          
        padding: 0 10px;
        line-height: 26px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 1.5s, padding 0.5s;
    }

    .accordion input[type="checkbox"]:checked + label + .content{
        max-height: none;
        padding: 10px 10px 20px;
    }
</style>


<body>
<?php

if(isset($_SESSION['status'])){
    ?>
    <a href="logout.php"><button>Logout</button></a>
    <h2>Territories</h2>
    <p>Here are the list of territories</p> 
    <?php 
}
else{
    header('location: login.php');
    exit();
}

?>
    
    <ul class="accordion">
            <?php 
            foreach($places as $region){
                if($region["parent"] == null){
            ?>      
                    <li>
                        <input type="checkbox" id="<?php echo $region["id"]; ?>">
                        <label for="<?php echo $region["id"]; ?>"><?php echo $region["name"]; ?></label>
                        <ul class="content">
            <?php
                        foreach($places as $place){
                            if($place["parent"] == $region["id"]){
                        ?>      
                                 
                                <li style="width: 90%;">
                                <input type="checkbox" id="<?php echo $place["id"]; ?>">
                                <label for="<?php echo $place["id"]; ?>"><?php echo $place["name"]; ?></label>
                                <ul class="content">
                        <?php
                                    foreach($places as $subplace){
                                        if($subplace["parent"] == $place["id"]){
                                    ?>
                                                <li style="width: 90%;" >
                                                    <input type="checkbox" id="<?php echo $subplace["id"]; ?>">
                                                    <label for="<?php echo $subplace["id"]; ?>"><?php echo $subplace["name"]; ?></label>
                                                </li>
                                    <?php
                                        }
                                    }
                        ?>
                                </ul>
                                </li>
                            
                        <?php
                            }                      
                        }
                ?>
                        </ul>
                    </li>      
                <?php 
                }
            }
            ?>       
    </ul>
</body>
</html>       