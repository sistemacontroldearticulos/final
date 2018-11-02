<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// function getConnection()
// {
//     $dbh = new PDO("pgsql:user=jvdwioghpjqleb dbname=d42v3gmecvlgdd ;password=ecb8e26902751ca156b5727322ab14f814d520244e2b6be875af2605cf6f4724;host=ec2-23-21-171-249.compute-1.amazonaws.com");
//     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $dbh;
// }

function getConnection()
{
    $dbh = new PDO("pgsql:user=postgres dbname=proyectofinal ;password=123");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function login($response)
{
    $route        = $response->getAttribute('route');
    $args         = $route->getArguments();
    $numDocumento = $args['numDocumento'];
    $contra1      = $args['contra'];
    // $contrasenia  = hash('sha512', $contra1);

    $sql = "SELECT usuario.contraseniausuario, usuario.numdocumentousuario, usuario.nombreusuario, usuario.idprograma, rolusuario, novedad.idnovedad,fechanovedad, nombreambiente, tipoarticulo, tiponovedad, equipo.idequipo, jornadaficha
FROM usuario
JOIN novedad ON (usuario.numdocumentousuario=novedad.numdocumentousuario)
JOIN articulonovedad on (articulonovedad.idnovedad=novedad.idnovedad)
JOIN ficha ON (novedad.numeroficha=ficha.numeroficha)
JOIN ambiente ON (ficha.idambiente=ambiente.idambiente)
JOIN articulo ON(articulonovedad.idarticulo=articulo.idarticulo)
LEFT OUTER JOIN equipo ON(articulo.idequipo=equipo.idequipo)
WHERE usuario.numdocumentousuario=$numDocumento AND usuario.contraseniausuario='$contra1'";

    try {
        $stmt    = getConnection()->query($sql);
        $usuario = array();
        $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
        // $arreglo        = (array) $usuario;
        // $retorno        = array_map('utf8', $arreglo);
        $arrayCrudo     = json_encode($usuario);
        $JsonSinSlash   = str_replace("\/", "/", $arrayCrudo);
        $ArrayRespuesta = json_decode($JsonSinSlash, true);
        return $JsonSinSlash;
        $db = null;

    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function buscarFicha($response)
{
    $route       = $response->getAttribute('route');
    $args        = $route->getArguments();
    $numeroFicha = $args['numeroFicha'];
    $sql         = "SELECT ficha.numeroficha, articulo.tipoarticulo,  articulo.idarticulo, equipo.idequipo, ambiente.idambiente
    FROM ficha

    join ambiente on (ficha.idambiente=ambiente.idambiente)
    join articulo on (articulo.idambiente=ambiente.idambiente)
    left join equipo on (articulo.idequipo=equipo.idequipo)
    where numeroficha= $numeroFicha";
    try {
        $stmt      = getConnection()->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db        = null;
        $arreglo   = (array) $productos;
        $retorno   = array_map('utf8', $arreglo);
        return json_encode($retorno);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function Ficha($response)
{
    $route = $response->getAttribute('route');
    $args  = $route->getArguments();

    $sql = "SELECT * from ficha";
    try {
        $stmt      = getConnection()->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db        = null;
        $arreglo   = (array) $productos;
        $retorno   = array_map('utf8', $arreglo);
        return json_encode($retorno);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function buscarAmbiente($response)
{
    $route      = $response->getAttribute('route');
    $args       = $route->getArguments();
    $idAmbiente = $args['idAmbiente'];
    $sql        = "SELECT nombreambiente FROM ambiente where idambiente= $idAmbiente";
    try {
        $stmt      = getConnection()->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db        = null;
        $arreglo   = (array) $productos;
        $retorno   = array_map('utf8', $arreglo);
        return json_encode($retorno);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function crearNovedad($request) {
    $emp = json_decode($request->getBody());
    
    $sql = "INSERT INTO novedad (numdocumentousuario, usuarionovedad, numeroficha, fechanovedad, articulo, estado) VALUES (:numdocumentousuario, :usuarionovedad, :numeroficha, :fechanovedad, :articulo, :estado)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":numdocumentousuario", $emp->numdocumentousuario);
        $stmt->bindParam(":usuarionovedad", $emp->nombreusuario);
        $stmt->bindParam(":numerofcha", $emp->numeroficha);
        $stmt->bindParam(":fechanovedad ", $emp->fechanovedad);
        $stmt->bindParam(":articulo", $emp->articulo);
        $stmt->bindParam(":estado", $emp->estado);
        $stmt->execute();
        echo json_encode($emp);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function utf8($arreglo)
{
    $arreglo2;
    foreach ($arreglo as $key => $value) {
        $arreglo2[$key] = utf8_encode($value);
    }
    return $arreglo2;
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app      = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
