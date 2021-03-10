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