<?php

/**
 * Функция получени всех продуктов
 * @return array
 */
function getProducts()
{
	$sql = "SELECT * FROM `products`";

	return getAssocResult($sql);
}

/**
 * Функция получает один продукт по его id
 * @param int $id
 * @return array|null
 */
function getProduct($id)
{
	//для безопасности превращаем id в число
	$id = (int) $id;

	$sql = "SELECT * FROM `products` WHERE `id` = $id";

	return show($sql);
}

/**
 * Функция генерации списка продуктов
 * @return string
 */
function renderProductList()
{
	//инициализируем результирующую строку
	$result = '';
	//получаем все изображения
	$products = getProducts();

	//для каждого изображения
	foreach ($products as $product) {
		//если изображение существует
		if(empty($product['image'])) {
			$product['image'] = 'img/no-image.jpeg';
		}
		$result .= render(TEMPLATES_DIR . 'productsListItem.tpl', $product);
	}
	return render(TEMPLATES_DIR . 'productsList.tpl', ['list' => $result]);
}

/**
 * Генерирует страницу корзины
 * @param array $cart
 * @return string
 */
function renderProductsCart($cart)
{
	if(empty($cart)) {
		return 'корзина пуста';
	}

	//получаем айдишники товаров
	$ids = array_keys($cart);

	//генерируем запрос
	$sql = "SELECT * FROM `products` WHERE `id` IN (" . implode(', ', $ids) . ")";
	$products = getAssocResult($sql);


	//инициализируем строку контента и сумму корзины
	$content = '';
	$cartSum = 0;
	foreach ($products as $product) {
		$count = $cart[$product['id']];
		$price = $product['price'];
		$productSum = $count * $price;
		//генерируем элемент корзины
		$content .= render(TEMPLATES_DIR . 'cartListItem.tpl', [
			'name' => $product['name'],
			'id' => $product['id'],
			'count' => $count,
			'price' => $price,
			'sum' => $productSum
		]);

		$cartSum += $productSum;
	}

	return render(TEMPLATES_DIR . 'cartList.tpl', [
		'content' => $content,
		'sum' => $cartSum
	]);
}

/**
 * @param int $id
 * @return string
 */
function showProduct($id)
{
	//для безопасности превращаем id в число
	//получаем товар
	$product = getProduct((int) $id);

	if(!$product) {
		return '404';
	}

	//возвращаем render шаблона
	return render(TEMPLATES_DIR . 'productPage.tpl', $product);
}

/**
 * Создание нового продукта
 * @param string $name
 * @param string $description
 * @param float $price
 * @param array $file
 * @return bool
 */
function insertProduct($name, $description, $price, $file)
{
	if($file) {
		$fileName = loadFile('image', 'img/');
	}


	//создаем соединение с БД
	$db = createConnection();
	//Избавляемся от всех инъекций в $title и $content
	$name = escapeString($db, $name);
	$description = escapeString($db, $description);
	$price = (float) $price;

	//генерируем SQL добавления в БД

	$sql = $file
		? "INSERT INTO `products`(`name`, `description`, `price`, `image`) VALUES ('$name', '$description', $price, '$fileName')"
		: "INSERT INTO `products`(`name`, `description`, `price`) VALUES ('$name', '$description', $price)";

	//выполняем запрос
	return execQuery($sql, $db);
}

/**
 * Генерирует страницу моих заказов
 * @return string
 */
function generateMyOrdersPage()
{
	//получаем id пользователя и и получаем все заказы пользователя
	$user_id = $_SESSION['login']['id'];
	$orders = getAssocResult("SELECT * FROM `orders` WHERE `user_id` = $user_id");

	$result = '';
	foreach ($orders as $order) {
		$order_id = $order['id'];

		//получаем продукты, которые есть в заказе
		$products = getAssocResult("
			SELECT * FROM `orders_products` as op
			JOIN `products` as p ON `p`.`id` = `op`.`product_id`
			WHERE `op`.`order_id` = $order_id
		");

		$content = '';
		$orderSum = 0;
		//генерируем элементы таблицы товаров в заказе
		foreach ($products as $product) {
			$count = $product['amount'];
			$price = $product['price'];
			$productSum = $count * $price;
			$content .= render(TEMPLATES_DIR . 'orderTableRow.tpl', [
				'name' => $product['name'],
				'id' => $product['id'],
				'count' => $count,
				'price' => $price,
				'sum' => $productSum
			]);
			$orderSum += $productSum;
		}

		$statuses = [
			0 => 'Заказ оформлен',
			1 => 'Заказ собирается',
			2 => 'Заказ готов',
			3 => 'Заказ завершен',
			4 => 'Заказ отменен',
		];

		//генерируем полную таблицу заказа
		$result .= render(TEMPLATES_DIR . 'orderTable.tpl', [
			'id' => $order_id,
			'content' => $content,
			'sum' => $orderSum,
			'status' => $statuses[$order['status']]
		]);
	}
	return $result;
}
