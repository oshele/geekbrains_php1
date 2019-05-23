<h2>{{NAME}}</h2>

            <div class="product-top">
                <div class="product-image">
                    <a href="../{{IMAGE}}" target="_blank" class="description"><img src="../{{IMAGE}}" alt="photo"></a>
                </div>
                <div class="product-description">
                    <h3>Цена товара: {{PRICE}}</h3>
                    
                    <a href="#" class="buy">Купить</a>
                    <a href="updateProduct.php?id={{ID}}" class="buy">Редактировать</a>
	                <a href="deleteProduct.php?id={{ID}}" class="buy">Удалить</a>
                </div>
            </div>
            <div>
            <h3>Описание товара</h3>
            {{DESCRIPTION}}
            </div>