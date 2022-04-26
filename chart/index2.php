<?php include 'Components/header.php' ?>
<body>
    <div class="chartMenu">
        <p>WWW.CHARTJS3.COM (Chart JS 3.7.1)</p>
    </div>

    <!-- Div padrão da biblioteca, serve para denderizar o gráfico -->
    <div class="chartCard">
        <div class="chartBox">
        <canvas id="myChart"></canvas>
        
        <?php 
          try {
              $sql = "SELECT * FROM admin.tesla";  // Query de consulta pasta.tabela
              $result = $conn->query($sql); // Aplicacao da Query.
              
              if($result->rowCount() > 0) { //Verifica se a tabela é vazia.
                  
                $dateArray = []; // Declarando Array vazio
                while ($row = $result->fetch()) { // Para  cada linha busca um resultado.
                  $dateArray[] = $row["date"];  
                  /*
                    Vejam, o loop vai durar um número de vezes igual a quantidade de linhas na tabela.
                    Para cada uma dessas linhas vamos pegar o elemento correspondente a 'date'
                    (que é uma coluna no bd) e vamos fazer um push no array.
                    $dateArray[] -> $dateArray[data1] -> $dateArray[data2, data1] ->  ... ->  até  o fim do loop. 
                  */
                }
                unset($result); //Limpa a variavel.
              } else {
                  echo "Nada encontrado por essa query";
              } 
          } catch(PDOException $e){
              die("Incapaz de executar o SQL" .  $e->getMessage());
          }
    
          // Fecha conexão
          unset($conn);
        ?>
    
        <!-- <?= print_r($dateArray); ?> -->

      </div>
    </div>

    

    <script>
    // setup 

    const dateArrayJS = <?php echo json_encode($dateArray); ?>; // Transforma o texto PHP em JS legivel.
    console.log(dateArrayJS);
    
    // map é  como se  criasse um array de assocação 
    const dateChartJS = dateArrayJS.map((day, index) => {
      let dayjs = new Date(day);
      console.log(dayjs);
      return dayjs.setHours(0,0,0,0);
    });

    const data = {
      labels: dateChartJS, // adicionamos os nossos elementos.
      datasets: [{
        label: 'Weekly Sales',
        data: [1, 2, 3, 4], // <- O quantitativo de alunos iria aqui. 
                                     // Mas é preciso uma fórmula para calcular o número de alunos por nível antes
        /* 
        data: [nivelChartJS[0]]
        */
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
          // Criamos um eixo x. Nesse exemplo usamos tempo e definimos o necessário.
          x: {
            type: 'time',
            time: {
              unit: 'day'
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    </script>

  </body>
</html>