<?php

//base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//Arreglo con mensaje de errores
$errores = [];

//Ejecutar el codigo despues de que el usuario enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $titulo = $_POST['titulo'];
  $precio = $_POST['precio'];
  $descripcion = $_POST['descripcion'];
  $habitaciones = $_POST['habitaciones'];
  $wc = $_POST['wc'];
  $estacionamiento = $_POST['estacionamiento'];
  $vendedores_id = $_POST['vendedor'];

  if (!$titulo) {
    $errores[] = "Debes añadir un titulo";
  }

  if (!$precio) {
    $errores[] = "El precio es obligatorio";
  }

  if (strlen($descripcion) < 50) {
    $errores[] = "La descripcion es obligatorio y debe tener al menos 50 caracteres";
  }

  if (!$habitaciones) {
    $errores[] = "El numero de habitaciones es obligatorio";
  }

  if (!$wc) {
    $errores[] = "El numero de baños es obligatorio";
  }

  if (!$estacionamiento) {
    $errores[] = "El numero de estacionamiento es obligatorio";
  }

  if (!$vendedores_id) {
    $errores[] = "Elige un verdedor";
  }

  //echo "<pre>";
  //var_dump($errores);
  //echo "</pre>";

  //Revisar que el arreglo de errores este vacio
  if (empty($errores)) {

    //Inserta en la base de datos
    $query = "INSERT INTO propiedades(titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) 
    VALUES ('$titulo','$precio','$descripcion','$habitaciones','$wc','$estacionamiento','$vendedores_id')";

    //echo $query;

    $resultado = mysqli_query($db, $query);

    if ($resultado) {
      echo "Insertado correctamente";
    }
  }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Crear</h1>
  <a href="/admin" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error) :  ?>
    <div class="alerta error">
      <?php echo $error;  ?>
    </div>
  <?php endforeach;  ?>

  <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
    <fieldset>
      <legend>Informacion general</legend>

      <label for="titulo">Titulo:</label>
      <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

      <label for="imagen">Imagen:</label>
      <input type="file" id="imagen" accept="image/jpeg, image/png">

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion"></textarea>

    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for="habitaciones">Habitaciones:</label>
      <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejemplo 3" min="1" max="5">

      <label for="wc">Baños:</label>
      <input type="number" id="wc" name="wc" placeholder="Ejemplo 3" min="1" max="5">

      <label for="estacionamiento">Estacionamiento:</label>
      <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo 3" min="1" max="5">

    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>
      <select name="vendedor">
        <option value="">--selecione</option>
        <option value="1">German</option>
        <option value="2">Karen</option>
      </select>
    </fieldset>

    <input type="submit" value="Crear Propiedad" class="boton boton-verde">

  </form>
</main>

<?php
incluirTemplate('footer');
?>