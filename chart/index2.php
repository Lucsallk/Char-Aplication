<?php include 'Components/header.php' ?>
<body>
  <!-- Div padrão da biblioteca, serve para denderizar o gráfico -->

  <?php 
    try{
      $sql =  "SELECT * FROM admin.barchart";
      $result =  $conn->query($sql);
      if($result->rowCount() > 0){
        while($row = $result->fetch()) {
            echo $row["revenue"];
        }
      unset($result);
      } else {
        echo "No records matching query.";
      }
    } catch(PDOException $e){
      die("Error: $sql nao executado" .  $e->getMessage());
    }

    unset($conn);
  ?>
  
  
  <script>
  // setup 

  
  </script>

  </body>
</html>