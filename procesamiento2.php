<?php
session_start();

// Definir las funciones
function agregarProducto($producto, $cantidad, $nombre, $modelo, $precio) {
    $productos = [
        'nombre' => $nombre,
        'cantidad' => $cantidad,
        'modelo' => $modelo,
        'precio' => $precio
    ];

    $nuevosProductos = [];
    foreach($producto as $productos){
        $nuevosProductos [] = $productos;
    }
    $nuevosProductos [] = $producto;
    return $nuevosProductos;
}

function buscarProductosPorModelos($producto, $modelo) {
    foreach ($producto as $modelos) {
        if ($modelos['modelo'] == $modelo) {
            return "Modelos Disponibles " . $modelos['modelo'] . "<br>";
        }
    }
    return "Modelo no encontrado.<br>";
}

function mostrarModelo($productos) {
    $result = '';
    foreach ($productos as $product) {
        $result .= "Nombre: " . $nombre['nombre'] . ", Cantidades: " . $cantidad['cantidad'] .  "Moedelo: " . $precio['precio']. "<br>";
    }
    return $result;
}

function actualizarProductos($producto, $modelo, $cantidad, $precio, $nombre) {
    foreach ($producto as &$product) {
        if ($product['modelo'] == $modelo) {
            $product['nombre'] = $nombre;
            $product['cantidad'] = $cantidad;
            $product['precio'] = $precio;

            break;
        }
    }
    return $producto;
}

function caluclarValorTotal($producto) {

    $total = 0;

    foreach ($producto as $product){

        $total + $product ['cantidad'] * $product ['precio']; 
    }

    return $total;
}

function filtrarProductosPorValor($producto) {

    $valor ;
    $productoFiltrados = [];
    
    foreach($producto as $product){
        if ($producto ['precio'] > $valor){
            $productoFiltrados []=  $product;
        }
    }
    return $productoFiltrados;
}

function listarModelosDisponibles($producto) {

    $modelos = [];

    foreach ($producto as $product){
        $modelos [] = $product ['modelo'];
    }
    return $modelos;
}

function caluclarValorPromedio($producto) { 
    
    $total = caluclarValorPromedio($producto);

    $cantidadProductos = $contarElementos;

    if ($cantidadProductos == 0){
        return 0;
    }

    return $total / $cantidadProductos;

}

function mostrarProductos($producto) { 
    
    $result = '';
    foreach ($producto as $product){
        $result = "Nombre: " . $producto ['nombre'] . ", Cantidad: " . $producto ['cantidad'] . ", Modelo: " . $producto ['modelo'] . ", Precio: " . $producto['precio'];
    }
}



// Inicializar el array de usuarios en la sesión
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

$productos = $_SESSION['predouctos'];
$resultado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $modelo = $_POST['modelo'] ?? '';

    
    switch ($accion) {
        case 'agregar':
            $usuarios = agregarProducto($productos, $nombre, $cantidad, $modelo, $precio);
            $resultado = "Producto agregado correctamente.<br>";
            break;
        
        case 'buscar':
            $resultado = buscarProductosPorModelos($productos, $modelo). "<br>";
            break;
        
        case 'mostrar':
            $resultado = mostrarModelo($productos). "<br>";
            break;
        
        case 'actualizar':
            $productos = actualizarProductos($productos, $modelo, $precio, $cantidad);
            $resultado = "Producto actualizado correctamente.<br>";
            break;

        case 'limpiar':
            $_SESSION['productos'] = [];
            $resultado = "Resultados limpiados correctamente.<br>";
            session_destroy();
            break;

        case 'caluclar':
            $resultado =  "El valor total es: " . caluclarValorTotal($precio). "<br>";
            break;
            
            
        case 'caluclarPromedio':
            $resultado = "Valor Promedio: " . caluclarValorPromedio($producto) . "<br>";
            


        case 'filtrar':
            $valor = $_POST['valor'];
            $productoFiltrados = filtrarProductosPorValor($producto, $valor);
            $resultado = mostrarProductos($productoFiltrados) . "<br>";

            break;

        case 'listar':
       $modelos = listarModelosDisponibles($producto);
       $resultado = "Modelos Disponibles: " . implode ($modelos) . "<br>";
            break;

        

        default:
            $resultado = "Acción no válida.";
    }

    $_SESSION['producto'] = $producto;
    $_SESSION['resultado'] = $resultado;
}

// Redirigir de vuelta a index.php
header("Location: formulario.php");
exit();
?>