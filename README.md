# Simple Wordpress Woocomerce API

##### List all products 

List all products with variances

`
http://{{ _.hostname }}/index.php/wp-json/easy-rest/v1/products
`

```json
[
  {
    "product_id": 4076,
    "category_id": 278,
    "name": "Ovo Branco - Cookies and Cream - Vegano - Sem trigo",
    "description": "<strong>Creme de baunilha <\/strong>a base de <strong>castanha de caju <\/strong>com <strong>cookies de chocolate<\/strong><strong>. <\/strong>330g\n\nSem trigo. Sem traços de leite.",
    "price": "69.90",
    "type": "simple",
    "status": "publish"
  },
  {
    "product_id": 4068,
    "category_id": 278,
    "name": "Ovo Branco - Torta de Limão - Vegano - Sem trigo",
    "description": "<strong>Creme de limão<\/strong> a base de <strong>castanha de caju <\/strong>com <strong>biscoitinhos <\/strong>de limão<strong>. <\/strong>330g\n\nSem trigo. Sem traços de leite.",
    "price": "69.90",
    "type": "simple",
    "status": "publish"
  },
  {
    "product_id": 3997,
    "category_id": 278,
    "name": "Ovo Bolo de Cenoura - Vegano",
    "description": "Camadas de bolo de cenoura fofinho com com <strong>Ganache de chocolate 54%<\/strong> ou <strong>\"Nutella\" vegana The Boinas <\/strong>+ Gotas e Raspas de chocolate.<strong> <\/strong>330g",
    "price": "",
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
    ],
    "type": "variable",
    "status": "publish"
  }
]

```