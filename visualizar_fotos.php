<?php
include("conexao.php");


$sql_fotos = "select caminho_foto from tb_foto_pet";
$sql_Result = $conexao->query( $sql_fotos);

if ($sql_Result->num_rows > 0) {
    echo " <h1> Galeria de fotos de Pet salvas </h1>";
    echo " <div style='display: flex; flex-wrap:wrap;'>";

    while ($row = $sql_Result->fetch_assoc()) {
        $caminho_foto = $row['caminho_foto'];
        echo " <div style='margin: 10px;'>
            <img src='fotos/$caminho_foto'
            style='width=125px; height= 150px;'>
            </div>";
    }
    echo "</div>";
} else
   echo " <p> Nenhuma foto encontrada! </p>";

   $conexao->close();
   ?>
