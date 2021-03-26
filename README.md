# Simple Wordpress Woocomerce API

##### List all products 

List all products with variances

```
GET
http://{{ _.hostname }}/wp-json/easy-rest/v1/products
```

Response
```json
[
  {
    "product_id": 4068,
    "category_id": 278,
    "name": "Ovo Branco - Torta de Limão - Vegano - Sem trigo",
    "description": "<strong>Creme de limão<\/strong> a base de <strong>castanha de caju <\/strong>com <strong>biscoitinhos <\/strong>de limão<strong>. <\/strong>330g\n\nSem trigo. Sem traços de leite.",
    "price": "69.90",
    "type": "simple",
    "status": "publish",
    "image_url_100x100": "http:\/\/localhost\/wp-content\/uploads\/2021\/03\/SAVE_20210322_142818-100x100.jpg",
    "image_url": "http:\/\/localhost\/wp-content\/uploads\/2021\/03\/SAVE_20210322_142818.jpg"
  },
  {
    "product_id": 3997,
    "category_id": 278,
    "name": "Ovo Bolo de Cenoura - Vegano",
    "description": "Camadas de bolo de cenoura fofinho com com <strong>Ganache de chocolate 54%<\/strong> ou <strong>\"Nutella\" vegana The Boinas <\/strong>+ Gotas e Raspas de chocolate.<strong> <\/strong>330g",
    "price": "",
    "type": "variable",
    "status": "publish",
    "image_url_100x100": "http:\/\/localhost\/wp-content\/uploads\/2021\/03\/OVO_PASCOA_VEGANO_CENOURA_2-scaled-100x100.jpg",
    "image_url": "http:\/\/localhost\/wp-content\/uploads\/2021\/03\/OVO_PASCOA_VEGANO_CENOURA_2-scaled.jpg",
    "variations": [
      {
        "variation_id": 3999,
        "price": 83,
        "variation_text": "nutellaveg"
      },
      {
        "variation_id": 4000,
        "price": 68,
        "variation_text": "ganache"
      }
    ]
  }
]

```

```
GET
http://{{ _.hostname }}/wp-json/easy-rest/v1/products
```

Request

```json
{
	"phone": "(88) 99878-9877"
}
```


Response

```json
[
  {
    "date_created": "2021-03-05T23:54:52+00:00",
    "order_id": 8910,
    "order_key": "wc_order_DasdakPze4E9s",
    "billing_email": "rafaelaborsatto@gmail.com",
    "billing_first_name": "Cliente Nome",
    "billing_last_name": "CLIENTE",
    "billing_address_1": "Avenida Eng dos Campos",
    "billing_address_2": "",
    "billing_city": "São José dos Campos",
    "billing_state": "",
    "billing_postcode": "00000-000",
    "billing_country": "BR",
    "billing_phone": "(88) 99878-9877",
    "shipping_first_name": "",
    "shipping_last_name": "",
    "shipping_address_1": "",
    "shipping_address_2": "",
    "shipping_city": "",
    "shipping_state": "",
    "shipping_postcode": "",
    "shipping_country": "",
    "payment_method": "bacs",
    "payment_method_title": "PIX \/ Transferência bancária"
  }
]
```