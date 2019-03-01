<?php

/**
 * Функция шаблонизатора. Получает шаблон из файла и заменяет ключи типа {{KEY}} на значение
 * @param string $file - путь к файлу с шаблоном
 * @param array $variables - массив подставляемых значений
 * @return string
 */
function render($file, $variables = [])
{
	//если файл не существует, выкидываем ошибку
	if (!is_file($file)) {
		echo 'Template file "' . $file . '" not found';
		exit();
	}

	//если файл пустой, выкидываем ошибку
	if (filesize($file) === 0) {
		echo 'Template file "' . $file . '" is empty';
		exit();
	}

	//получаем содержимое шаблона
	$templateContent = file_get_contents($file);

	//если переменны не заданны, возвращаем шаблон как есть
	if (empty($variables)) {
		return $templateContent;
	}

	//проходимся по всем переменным
	foreach ($variables as $key => $value) {
		//преобразуе ключ из key в {{KEY}}
		$key = '{{' . strtoupper($key) . '}}';

		//заменяем все ключи в шаблоне
		$templateContent = str_replace($key, $value, $templateContent);
	}

	//возвращаем получившийся шаблон
	return $templateContent;
}
