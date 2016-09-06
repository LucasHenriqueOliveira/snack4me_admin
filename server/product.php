<?php 

$resposta = array();
$produtos = array();
$concessions = array();

try{
	$id_event = $_REQUEST['id_event'];
	$categoria = [];
	
	include_once('conexao.php');
	include('class/Product.php');
  include('class/TypeProduct.php');
	include('class/Event.php');
	
	$query = $con->prepare('SELECT p.product_category_id, c.category_name_pt, c.category_name_en, c.category_name_es FROM product p INNER JOIN category c ON p.product_category_id = c.category_id
	        WHERE product_event_id = ? AND product_inventory_current > 0 GROUP BY c.category_id');
  $query->execute(array($id_event));
  $num_rows = $query->rowCount();
  $query->setFetchMode(PDO::FETCH_CLASS, 'Product');

  if($num_rows > 0){

    while ($row = $query->fetch()) {
      $category['pt'] = $row->getCategoryNamePT();
      $category['en'] = $row->getCategoryNameEN();
      $category['es'] = $row->getCategoryNameES();
      $categoria['id'] = $row->getProductCategoryId();
      $categoria['name'] = $category;

      $query2 = $con->prepare('SELECT * FROM product WHERE product_event_id = ? AND product_inventory_current > 0 AND product_category_id = ? AND product_active = 1');
      $query2->execute(array($id_event, $row->getProductCategoryId()));
      $num_rows2 = $query2->rowCount();
      $query2->setFetchMode(PDO::FETCH_CLASS, 'Product');

      if($num_rows2 > 0) {
        while ($row2 = $query2->fetch()) {
          $product['pt'] = $row2->getProductNamePT();
          $product['en'] = $row2->getProductNameEN();
          $product['es'] = $row2->getProductNameES();

          $desc['pt'] = $row2->getProductDescPT();
          $desc['en'] = $row2->getProductDescEN();
          $desc['es'] = $row2->getProductDescES();

          $produto['id'] = $row2->getProductId();
          $produto['number'] = $row2->getProductNumber();
          $produto['hour_initial'] = substr($row2->getProductHourInitial(),0,5);
          $produto['hour_final'] = substr($row2->getProductHourFinal(),0,5);
          $produto['name'] = $product;
          $produto['image'] = $row2->getProductImage();
          $produto['price'] = $row2->getProductPrice();
          $produto['complement'] = $row2->getProductComplement();
          $produto['desc'] = $desc;

          $query3 = $con->prepare('SELECT * FROM type_product WHERE type_product_product_id = ? AND type_product_active = 1');
          $query3->execute(array($row2->getProductId()));
          $num_rows3 = $query3->rowCount();
          $query3->setFetchMode(PDO::FETCH_CLASS, 'TypeProduct');

          if($num_rows3 > 0) {
              while ($row3 = $query3->fetch()) {
                  $type_product['pt'] = $row3->getTypeProductNamePT();
                  $type_product['en'] = $row3->getTypeProductNameEN();
                  $type_product['es'] = $row3->getTypeProductNameES();

                  $tipo_produto['id'] = $row3->getTypeProductId();
                  $tipo_produto['name'] = $type_product;
                  $tipo_produtos[] = $tipo_produto;
              }
          }

          $produto['type'] = $tipo_produtos;
          $produtos[] = $produto;
          unset($tipo_produtos);
        }
        $categoria['products'] = $produtos;
        unset($produtos);
      }

      $categorias[] = $categoria;
    }


    $query = $con->prepare('SELECT event_tax_service FROM event WHERE event_id = ?');
    $query->execute(array($id_event));
    $num_rows = $query->rowCount();
    $query->setFetchMode(PDO::FETCH_CLASS, 'Event');

    if($num_rows > 0){
      $row = $query->fetch();
      $tax_service = $row->getEventTaxService();
    }

    $resposta["error"] = false;
    $resposta["products"] = $categorias;
    $resposta["tax_service"] = $tax_service;
  }
} catch (Exception $e){

	$resposta["error"] = true;
	$resposta["message"] = $e->getMessage();
}
echo json_encode($resposta);