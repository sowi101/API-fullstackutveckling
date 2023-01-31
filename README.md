# Projekt i Fullstack-utveckling med ramverk (DT193G)
I detta respitory finns ett API byggt i PHP med hjälp av ramverket Laravel som skapats för projektarbetet i kursen Fullstack-utveckling med ramverk på Mittuniversitetet. API:et kan användas för att hantera produkter för en handarbetesaffär. Det finns funktionalitet för CRUD, det vill säga skapa, läsa, uppdatera och radera, för produkter, kategorier och märken. För att kunna använda API:et behöver man registrera en användare. Det finns funktionalitet för att kunna registrera användare samt logga in och logga ut användare.

## Tabeller

| Tabellnamn| Fält |
| ----------- | ----------- |
| products | **id** (bigint(20)), **article** (int(11)), **name** (varchar(255)), **description** (longText), **price** (int(11)), **price** (int(11)), **category_id** (bigint(20)) FK (categories), **brand_id** (bigint(20)) FK (brands), **created_at** (timestamp), **created_at** (timestamp)|
| categories | **id** (bigint(20)), **name** (varchar(255)), **created_at** (timestamp), **created_at** (timestamp)|
| brands | **id** (bigint(20)), **name** (varchar(255)), **created_at** (timestamp), **created_at** (timestamp)|


## Klasser och metoder

### Produkt
#### Model: Product
- **article**: artikelnummer
- **name**: namn på produkt
- **description**: beskrivning av produkt
- **price**: pris på produkt
- **amount**: saldo för produkt
- **category_id**: kategori av produkt
- **brand_id**: märke på produkt

#### Controller: ProductController
- **index**: metod som hämtar alla produkter i databastabellen.
- **store**: metod som lagrar ett produktobjekt i databastabellen.
- **show**: metod hämtar en angiven rad i databastabellen.
- **update**: metod som uppdaterar en angiven rad i databastabellen.
- **destroy**: metod som tar bort en angiven rad i databastabellen.

### Kategori
#### Model: Category
- **name**: namn på kategori

#### Controller: CategoryController
- **index**: metod som hämtar alla kategorier i databastabellen.
- **store**: metod som lagrar ett kategoriobjekt i databastabellen.
- **show**: metod hämtar en angiven rad i databastabellen.
- **update**: metod som uppdaterar en angiven rad i databastabellen.
- **destroy**: metod som tar bort en angiven rad i databastabellen.
- **getProductsByCategory**: metod som hämtar alla produkter i en angiven kategori.


### Märke
#### Model: Brand
- **name**: namn på märke

#### Controller: BrandController
- **index**: metod som hämtar alla märken i databastabellen.
- **store**: metod som lagrar ett märkesobjekt i databastabellen.
- **show**: metod hämtar en angiven rad i databastabellen.
- **update**: metod som uppdaterar en angiven rad i databastabellen.
- **destroy**: metod som tar bort en angiven rad i databastabellen.
- **getProductsByBrand**: metod som hämtar alla produkter av ett angivet märke.


### Användare
#### Model: User
- **name**: namn på användare
- **email**: email för användare
- **password**: lösenord

#### Controller: AuthController
- **register**: metod som lagrar en ny användare i databastabellen.
- **login**: metod som kontrollerar inmatade inloggningsuppgifter mot användare i databastabellen och skapar token.
- **logout**: metod som loggar ut användare genom att förstöra token.

## Användning

### Produkt-API
| Metod | Ändpunkt | Beskrivning |
| ----------- | ----------- | ----------- |
| GET | /api/products | Hämtar alla produkter, hämtar även namn på kateogorier och märken från tabellerna categories och brands. |
| GET | /api/products/{id} | Hämtar produkt med angivet ID. |
| POST | /api/products | Lagrar ny produkt, ett produktobjekt måste skickas med. |
| PUT | /api/products/{id} | Uppdaterar existerande produkt med angivet ID, ett produktobjekt måste skickas med. |
| DELETE | /api/products/{id} | Raderar produkt med angivet ID. |

Ett produktobjekt skickas eller returneras på följande sätt:

```json
{
  "article": 10001,
  "name": "Soft Cotton",
  "description": "En beskrivande text...",
  "price": 35,
  "amount": 34,
  "category_id": 1,
  "brand_id": 1
}
```
### Kategori-API
| Metod | Ändpunkt | Beskrivning |
| ----------- | ----------- | ----------- |
| GET | /api/categories | Hämtar alla kategorier. |
| GET | /api/categories/{id} | Hämtar kategori med angivet ID. |
| GET | /api/categories/products/{id} | Hämtar alla produkter i en kategori med angivet ID. |
| POST | /api/categories | Lagrar ny kategori, ett kategoriobjekt måste skickas med. |
| PUT | /api/categories/{id} | Uppdaterar existerande kategori med angivet ID, ett kategoriobjekt måste skickas med. |
| DELETE | /api/categories/{id} | Raderar kategori med angivet ID. |

Ett kategoriobjekt skickas eller returneras på följande sätt:

```json
{
  "name": "Bomullsgarn",
}
```

### Märke-API
| Metod | Ändpunkt | Beskrivning |
| ----------- | ----------- | ----------- |
| GET | /api/brands | Hämtar alla märken. |
| GET | /api/brands/{id} | Hämtar märke med angivet ID. |
| GET | /api/brands/products/{id} | Hämtar alla produkter av ett märke med angivet ID. |
| POST | /api/brands | Lagrar nytt märke, ett märkesobjekt måste skickas med. |
| PUT | /api/brands/{id} | Uppdaterar existerande märke med angivet ID, ett märkesobjekt måste skickas med. |
| DELETE | /api/brands/{id} | Raderar märke med angivet ID. |

Ett märkesobjekt skickas eller returneras på följande sätt:

```json
{
  "name": "Järbo",
}
```

### Registrera användare
| Metod | Ändpunkt | Beskrivning |
| ----------- | ----------- | ----------- |
| POST | /api/register | Lagrar ny användare, ett användarobjekt måste skickas med. |

Ett användarobjekt skickas på följande sätt:

```json
{
  "name": "Anna Andersson",
  "email": "anna.anderson@live.com",
  "password": "hemligtlösenord"
}
```

### Logga in
| Metod | Ändpunkt | Beskrivning |
| ----------- | ----------- | ----------- |
| POST | /api/login | Kontrollerar inloggning, delar av ett användarobjekt måste skickas med, skapar token för användare.|

Ett användarobjekt skickas på följande sätt:

```json
{
  "email": "anna.anderson@live.com",
  "password": "hemligtlösenord"
}
```

### Logga ut
| Metod | Ändpunkt | Beskrivning |
| ----------- | ----------- | ----------- |
| POST | /api/logout | Raderar giltigt token för användare.|

## Övrigt
I APIet finns det även seeders skapade för att fylla tabellerna och enklare kunna testköra alla metoder. BrandSeeder och CategorySeeder måste köras innan ProductSeeder så att det finns kategorier och märken att koppla till produkterna.

## Om repositoriet
Skapat av Sofia Widholm 2022

Fullstackutveckling med ramverk, Webbutvecklingsprogrammet, Mittuniversitetet
