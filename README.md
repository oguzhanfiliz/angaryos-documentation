# Angaryos Genel Mantığı
**Genel amaçlı yazılım angaryalarından kurtarmak üzere hazırlanmış bir framework'tür angaryos.**

Başlık ve açıklama kısmı düzenlenecektir.


---

## Framwork Hakkında Öğrenilen Bilgiler.
- #### Tablo yapısı
- #### Kolonlar.

---
### Tablo Yapısı

Framework'u aslında herşeyini dizi veya json olarak nitelendirebilirsiniz. Yazılım dilinde eğer birşeyi dinamik hale getirmek istiyorsanız çoğu şeyin başında diziler gelecektir.

Örnek bir senaryoda çok ufak çaplı bir web sitesinin oluşacağı veritabanı tabloları şunlardan ibarettir. 

| Tablo Adı | Açıklama |
| ----------- | ----------- |
| Settings | Ayar kısmı |
| Products | Ürünler kısmı |
| Gallery | Galeri kısmı |

> Buraları anlaşılabilir olması açısından sade ve kısa tutuyorum.

Bu senaryoda sabit tablolarımız var sitemizin arka planında düzenleyebilceğimiz ve veritabanında tutabileceğimiz bilgiler 3 adet tablodan oluşmakta. 
Bu tabloları çoğaltmak istediğimizde naparız ? Bir sql kodu yazıp create yaparız yada bir phpmyadmin,pgadmin vs... tarzı yönetim araçlarıyla tablo oluştururuz değil mi ? Aslında frameworkumuzdede yapacağımız şey aynısı sadece alışılagelmişin dışında bir veritabanı yönetim aracı olması.
  >Tabiki herşey bu aşamada bu kadar gözükecektir. 

Peki ben bu tabloları bir dizide tutsaydım ve şu hali alsaydı. 
```
array(
 "0" => "Settings",
 "1" => "Products",
 "2" => "Gallerry"
)
```

Peki bu listeye yeni bir tablo eklemek istediğinizde yapmanız gereken şey nedir ? tabiki diziye yeni bir eleman eklemek. Tamam bu diziye eleman ekledik ama altta çalışan mekanizma nedir ? 

Sql create kodu . Dizinin her elemanını foreach ile dönüp teker teker bu tabloları oluşturacaktır...

---


### Kolonlar
Products tablosunu ele alıcak olursak. 
| id | name | category |  price | image_url |
| ----------- | ----------- | ----------- | ----------- | ----------- |
| 1 | abc | abc | 11 | 1.png | 

Şeklinde bir tablomuz olduğunu varsayarsak bunu oluştururken create komutunun içerisinde bizim kolonlarımızı belirtmezmiyiz. Peki bunlarıda dizi haline dönüştürüp backendden gelen veriyi create fonksiyonuna yazsaydık. 

Easy phpmyadmin.... ;) 


---


### Helpers Kullanımı

- **onload Helpers**
- **custom Helpers**

#### Onload Helpers

`backend/app/helpers.php`

Sayfa yüklendiğinde aktif olan helpers'lar burada yer alır. bu helpersları istediğiniz sayfada mvc mantığındaki helperslar gibi kullanabilirsiniz

#### Custom helpers
`bakcend/app/HelperFunctions`
içerisinde kendi yazmış olduğunuz custom helpers'lar bulunmaktadır. bunlar excel'den veri okuma gibi spesifik işlerde işinize yarayacak ancak her sayfa yüklenişinde hızınızı yavaşlatacak helperlardır.


#### Custom Helpers kullanımı

> eğer helpers.php'ye bakacak olursanız helper adında bir fonksiyon göreceksiniz. bu fonksiyon içerisine aldığı ilk parametreyi replace ederek bizim HelperFunction klasöründe alarar ve include eder. yani ilk parametrede gönderdiğiniz HelperFunction içine yazdığınız helper'ı kullanabilir hale gelirsiniz. 2. parametre ise custom helper'ınıze göndereceğiniz parametredir bu excel örneğinde dosya yolu olabilir. 

Gelin beraber excel örneğine bakalım HelperFunction klasörünün içerisinde 
*get_data_from_excel_file* adlı helper'im mevcut bunu kullanırken şunu yapmamız yeterli 

``` helper('get_data_from_excel_file', '/var/www/public/genclik.xlsx');```

1. parametre **HelperFunction** içerisinde bulunan helper dosyamızın yolu 2.si ise excel helper'i olduğu için public klasörüne attığımız excel dosyası. isterseniz birde görsel ile zenginleştirelim.

``` 
        $data = helper('get_data_from_excel_file', '/var/www/public/genclik.xlsx');

        dd($data);
```

çıktısına göz atalım. 


![helper](images/helper.png)

herhangi bir excelde bulunan datayı bu şekilde aktarıp kullanabilirsiniz.








### Kurulumda Karşılaşılanlar
**Veritabanı başlamaması**
İçerideki datalar oluşmamış olacağından seeder işlemi yapmanız gerekir 

```https://url:9000 ```

portundan erişebileceğiniz portainer bulunmkatadır.

> Portainer için ayrıca bakınız(Docker)

Buradan laravel container'ını bulup bash'e girmeniz gerekiyor. Bu işlemi işletim sisteminize ssh bağlantısı yaparak container'ınızın bash'ıne girmeniz mümkün buda sizin docker kullanımınıza kalmış bir durumdur.

Laravel bash'inde 

```php artisan db:seed ```

komutunuzu çalıştırın.

Seed işlemi laravelin bir komutudur farkettiğiniz üzere artisan ile tetiklenmekte. Laravel üzerinde seeder'lar veritabanı oluşturduğu esnada içeri örnek datalar basmaktadır. 

***!!! Bütün datalarınızı sileceği için çalışan sistemde denemeyiniz.***

**Postgres İzinleri**
postgresql 777 izinlerine sahip değil bundan dolayı hata aldım. postgres klasörünün izinlerini değiştirmeyin değiştirirseniz silip docker'ın tekrar yüklemesini bekleyin.

**Log Hatası**

 Eğer küçük bir sunucuda çalışıyorsanız rabbitmq elasticsearch kapatmanız gerekecektir.
Fremawork buralara hata yazmak istediğinden dolayı messagelibrary hatasıyla karşılaşacaksınız. bu hatayı yakalamak içinde. GeneralController içindeki apiden test alınız. aldıgınız testte https://url/api/v1/public/test urlinden kontrol edebilirsiniz. burası GeneralController içindeki test fonksiyonunda yer alan kodları size gösterecektir. burada error handlingi aktif etmek için 
  ```
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  ```
kodlarını kullanabilirsiniz. 

MessageLibrary içerisinde aldığınız hata 130. satırları işaret ettiğinde yapıcağınız işlem

.env içerisindeki 
```
LOG_CHANNEL=daily 
```

olarak düzeltmektir.