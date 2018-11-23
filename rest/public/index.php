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

function getConnection()
{
    $dbh = new PDO("pgsql:user=jvdwioghpjqleb dbname=d42v3gmecvlgdd ;password=ecb8e26902751ca156b5727322ab14f814d520244e2b6be875af2605cf6f4724;host=http://controldearticulos.herokuapp.com");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

// function getConnection()
// {
//     $dbh = new PDO("pgsql:user=postgres dbname=proyectofinal ;password=123");
//     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $dbh;
// }

// function getConnection()
// {
//     $dbh = new PDO("mysql:host=88.198.24.90;dbname=inventar_proyectofinal", "inventariosadsi", "SETQDnuHgv(_");
//     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $dbh;
// }

function login($response)
{
    $route        = $response->getAttribute('route');
    $args         = $route->getArguments();
    $numDocumento = $args['numDocumento'];
    $contra1      = $args['contra'];
    // $contrasenia  = hash('sha512', $contra1);

    $sql = "SELECT usuario.contraseniausuario, usuario.numdocumentousuario, usuario.nombreusuario, usuario.idprograma, rolusuario, novedad.idnovedad,fechanovedad, nombreambiente, tipoarticulo, tiponovedad, equipo.idequipo, jornadaficha

        FROM usuario
        LEFT OUTER JOIN novedad ON (usuario.numdocumentousuario=novedad.numdocumentousuario)
        LEFT OUTER JOIN articulonovedad on (articulonovedad.idnovedad=novedad.idnovedad)
        LEFT OUTER JOIN ficha ON (novedad.numeroficha=ficha.numeroficha)
        LEFT OUTER JOIN ambiente ON (ficha.idambiente=ambiente.idambiente)
        LEFT OUTER JOIN articulo ON(articulonovedad.idarticulo=articulo.idarticulo)
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

function loginActas($response)
{
    $route        = $response->getAttribute('route');
    $args         = $route->getArguments();
    $numDocumento = $args['numDocumento'];

    $sql = "SELECT aprendiz.nombreaprendiz, acta_responsabilidad.fechaacta, equipo.nombreequipo,
    aprendiz.numeroficha, ambiente.nombreambiente, numdocumentoinstructor, acta_responsabilidad.idacta
        FROM aprendiz
        LEFT OUTER JOIN acta_responsabilidad on (aprendiz.numdocumentoaprendiz=acta_responsabilidad.numdocumentoaprendiz)
        LEFT OUTER JOIN ficha ON (aprendiz.numeroficha=ficha.numeroficha)
        LEFT OUTER JOIN ambiente ON (ficha.idambiente=ambiente.idambiente)
        LEFT OUTER JOIN equipo ON(acta_responsabilidad.idequipo=equipo.idequipo)
        LEFT OUTER JOIN usuario ON(acta_responsabilidad.numdocumentoinstructor=usuario.numdocumentousuario)
        WHERE usuario.numdocumentousuario=$numDocumento";

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
    $sql         = "SELECT ficha.numeroficha, articulo.tipoarticulo,  articulo.idarticulo, equipo.nombreequipo, equipo.idequipo, ambiente.idambiente, ficha.idprograma, ambiente.nombreambiente, ficha.jornadaficha
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

function buscarArticulo($response)
{
    $route      = $response->getAttribute('route');
    $args       = $route->getArguments();
    $idAmbiente = $args['idArticulo'];
    $sql        = "SELECT idarticulo FROM articulonovedad where idarticulo= $idAmbiente";
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
function verificarActasEquipo($response)
{
    $route      = $response->getAttribute('route');
    $args       = $route->getArguments();
    $idAmbiente = $args['idEquipo'];
    $sql        = "SELECT nombreequipo, nombreaprendiz
    FROM acta_responsabilidad
    join equipo on (acta_responsabilidad.idequipo=equipo.idequipo)
    join aprendiz on (acta_responsabilidad.numdocumentoaprendiz=aprendiz.numdocumentoaprendiz)
     where acta_responsabilidad.idequipo= $idAmbiente";
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

function verificarActasAprendiz($response)
{
    $route      = $response->getAttribute('route');
    $args       = $route->getArguments();
    $idAmbiente = $args['numdocumentoaprendiz'];
    $sql        = "SELECT nombreequipo, nombreaprendiz
     FROM acta_responsabilidad
     join equipo on (acta_responsabilidad.idequipo=equipo.idequipo)
     join aprendiz on (acta_responsabilidad.numdocumentoaprendiz=aprendiz.numdocumentoaprendiz)
     where acta_responsabilidad.numdocumentoaprendiz= $idAmbiente";
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

function buscarFichaActas($response)
{
    $route      = $response->getAttribute('route');
    $args       = $route->getArguments();
    $idAmbiente = $args['numeroFicha'];
    $sql        = "SELECT numdocumentoaprendiz, nombreaprendiz, equipo.idequipo, nombreequipo, ficha.idprograma
    FROM aprendiz
    LEFT OUTER JOIN ficha on (aprendiz.numeroficha=ficha.numeroficha)
    LEFT OUTER JOIN ambiente on (ficha.idambiente=ambiente.idambiente)
    LEFT OUTER JOIN articulo on (articulo.idambiente=ambiente.idambiente)
    LEFT OUTER JOIN equipo on (equipo.idequipo=articulo.idequipo)
    where ficha.numeroficha= $idAmbiente";
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

function crearNovedad($request)
{
    // $emp = json_decode($request->getBody());
    $emp = $request->getParams();

    var_dump($emp["numdocumentousuario"]);

    $sql = "INSERT INTO novedad (numdocumentousuario, usuarionovedad, numeroficha, fechanovedad, articulo, estado) VALUES (:numdocumentousuario, :usuarionovedad, :numeroficha, :fechanovedad, :articulo, :estado)";
    try {
        $db   = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam('numdocumentousuario', $emp["numdocumentousuario"]);
        $stmt->bindParam(":usuarionovedad", $emp["usuarionovedad"]);
        $stmt->bindParam(":numeroficha", $emp["numeroficha"]);
        $stmt->bindParam(":fechanovedad", $emp["fechanovedad"]);
        $stmt->bindParam(":articulo", $emp["articulo"]);
        $stmt->bindParam(":estado", $emp["estado"]);
        $stmt->execute();
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function articuloNovedad($request)
{
    // $emp = json_decode($request->getBody());
    $emp = $request->getParams();

    $sql = "INSERT INTO articulonovedad (idarticulo, idnovedad, tiponovedad, observacionnovedad) VALUES (:idarticulo, :idnovedad, :tiponovedad, :observacionnovedad)";
    try {
        $db   = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":idarticulo", $emp["idarticulo"]);
        $stmt->bindParam(":idnovedad", $emp["idnovedad"]);
        $stmt->bindParam(":tiponovedad", $emp["tiponovedad"]);
        $stmt->bindParam(":observacionnovedad", $emp["observacionnovedad"]);
        $stmt->execute();
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function registrarActas($request)
{
    // $emp = json_decode($request->getBody());
    $emp = $request->getParams();

    $sql = "INSERT INTO acta_responsabilidad ( numdocumentoaprendiz, idequipo, fechaacta, numdocumentoinstructor ) VALUES (:numdocumentoaprendiz, :idequipo, :fechaacta, :numdocumentoinstructor)";
    try {
        $db   = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":numdocumentoaprendiz", $emp["numdocumentoaprendiz"]);
        $stmt->bindParam(":idequipo", $emp["idequipo"]);
        $stmt->bindParam(":fechaacta", $emp["fechaacta"]);
        $stmt->bindParam(":numdocumentoinstructor", $emp["numdocumentoinstructor"]);
        $stmt->execute();
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function buscarNovedad($response)
{

    $route = $response->getAttribute('route');
    $args  = $route->getArguments();

    $sql = "SELECT MAX(idnovedad) FROM novedad";

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
