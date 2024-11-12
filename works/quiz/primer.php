
<?php
    $conn = new mysqli("localhost", "046397785_kot", "kotbanan", "www-eva-net_study");
    if($conn->connect_error){
        die("РћС€РёР±РєР°: " . $conn->connect_error);
    }
    
    $number = 0;
    $answer = 0;
    
    $isJson = false;
    
    
    if(isset($_GET['number'])){
         if(isset($_GET['answer'])){ 
      
            $isJson = true;
          $sql = "SELECT * FROM questions WHERE is_del = 0 ";
        }  else {
          $sql = "SELECT * FROM questions WHERE is_del = 0 AND id = ".intval($_GET['number']); 
        }
        

    } else {
          $sql = "SELECT * FROM questions WHERE is_del = 0";
    }
    
  
    
    $result = $conn->query($sql);
    
    if(isset($result)){
        
        if($isJson){
            
            echo json_encode($result->fetch_assoc());
        } else {
            
                echo '<!DOCTYPE html> <html> <head> <title>KOT BANAN</title> <meta charset="utf-8" /> </head> <body> <h2>РЎРїРёСЃРѕРє РІРѕРїСЂРѕСЃРѕРІ</h2>';
               $rowsCount = $result->num_rows; // РєРѕР»РёС‡РµСЃС‚РІРѕ РїРѕР»СѓС‡РµРЅРЅС‹С… СЃС‚СЂРѕРє
                echo "<p>РџРѕР»СѓС‡РµРЅРѕ РѕР±СЉРµРєС‚РѕРІ: $rowsCount</p>";
                echo "<table><tr><th>image</th><th>Title</th><th>question</th><th>question</th><th>question</th><th>question</th></tr>";
                foreach($result as $row){
                    echo "<tr>";
                        echo "<td><img src='" . $row["image"] . "' width='100' height='100'></td>";
                        echo "<td>" . $row["title"] . "</td>";
                        if($row["answer"] == 0) echo "<td class='right'>" . $row["question_1"] . "</td>"; else echo "<td>" . $row["question_1"] . "</td>";
                         if($row["answer"] == 1) echo "<td class='right'>" . $row["question_2"] . "</td>"; else echo "<td>" . $row["question_2"] . "</td>";
                         if($row["answer"] == 2) echo "<td class='right'>" . $row["question_3"] . "</td>"; else echo "<td>" . $row["question_3"] . "</td>";
                         if($row["answer"] == 3) echo "<td class='right'>" . $row["question_4"] . "</td>"; else echo "<td>" . $row["question_4"] . "</td>";
                        
                    echo "</tr>";
                }
                echo "</table>";
                $result->free();
                
                echo '</body></html>';
        }
     
    } else{
        echo "РћС€РёР±РєР°: " . $conn->error;
    }
    
    $conn->close();
    
    ?>